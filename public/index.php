<?php

session_start();

// Generate a CSRF token for protecting form submissions - security
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

require_once __DIR__ . '/../app/Controllers/ContactController.php';

// Initialise the controller and handle database connection failures
try 
{
    $controller = new ContactController();
} 
catch (RuntimeException $exception) {
    error_log($exception->getMessage());

    http_response_code(500);

    exit(
        'Something went wrong while processing your request. '
        . 'Please try again later'
    );
}

// Determine the requested URL path
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Handle the submissions page
if ($path === '/contacts') {

    if ($method !== 'GET') {
        http_response_code(405);

        header('Allow: GET');

        exit('Method not allowed.');
    }

    $contacts = $controller->index();

    require_once __DIR__ . '/../app/Views/contacts.php';

    exit;
}

// The contact form only supports GET & POST requests
if (
    $path === '/' &&
    !in_array($method, ['GET', 'POST'], true)
) {
    http_response_code(405);

    header('Allow: GET, POST');

    exit('Method not allowed.');
}

// Return a 404 response for unknown routes
if ($path !== '/') {
    http_response_code(404);

    exit('Page not found.');
}

// Initialise form state
$data = [];
$errors = [];
$success = false;

// Retrieve and clear the success flash message
if (isset($_SESSION['success'])) {
    $success = $_SESSION['success'];

    unset($_SESSION['success']);
}

// Process contact form submissions
if ($method === 'POST') {

    // Verify the submitted CSRF token before processing user input
    $submittedToken = $_POST['csrf_token'] ?? '';
    $sessionToken = $_SESSION['csrf_token'] ?? '';

    if (
        empty($sessionToken) ||
        empty($submittedToken) ||
        !hash_equals($sessionToken, $submittedToken)
    ) {
        http_response_code(403);

        exit('Invalid CSRF token.');
    }

    $result = $controller->store($_POST);

    $data = $result['data'];
    $errors = $result['errors'];

    /* Redirect after a successful submission to prevent duplicate 
    submissions when the browser page is refreshed */
    
    if ($result['success']) {
        $_SESSION['success'] = 'Your message has been sent successfully!';

        header('Location: /');

        exit;
    }
}

// Display the contact form
require_once __DIR__ . '/../app/Views/contact.php';
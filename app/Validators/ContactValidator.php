<?php

// Validates all contact form input before it is saved to the database
class ContactValidator
{
    public function validate(array $data): array
    {
        $errors = [];

        // Full Name validation
        $name = trim($data['name'] ?? '');

        if ($name === '') {
            $errors['name'] = 'Name is required.';
        } elseif (mb_strlen($name) < 2) {
            $errors['name'] = 'Name must be at least 2 characters';
        } elseif (mb_strlen($name) > 100) {
            $errors['name'] = 'Name must not exceed 100 characters';
        }

        // Email validation
        $email = trim($data['email'] ?? '');

        if ($email === '') {
            $errors['email'] = 'Email is required.';
        } elseif (mb_strlen($email) > 255) {
            $errors['email'] = 'Email must not exceed 255 characters.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Please enter a valid email address';
        }

        // SA phone number validation
$phone = trim($data['phone'] ?? '');

if ($phone === '') {
    $errors['phone'] = 'Phone number is required.';
} else {
    // Remove common formatting characters before validating the number.
    $normalizedPhone = preg_replace('/[\s\-().]/', '', $phone);

    // Accept 9-digit numbers after +27 or standard 10-digit local numbers.
    if (
        !preg_match('/^[1-9][0-9]{8}$/', $normalizedPhone) &&
        !preg_match('/^0[1-9][0-9]{8}$/', $normalizedPhone)
    ) {
        $errors['phone'] = 'Please enter a valid South African phone number.';
    }
}

        // Message validation
        $message = trim($data['message'] ?? '');

        if ($message === '') {
            $errors['message'] = 'Message is required.';
        } elseif (mb_strlen($message) > 2000) {
            $errors['message'] = 'Message must not exceed 2000 characters';
        }

        return $errors;
    }
}
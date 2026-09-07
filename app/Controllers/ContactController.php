<?php

require_once __DIR__ . '/../Config/Database.php';

require_once __DIR__ . '/../Models/Contact.php';

require_once __DIR__ . '/../Validators/ContactValidator.php';

class ContactController
{
    private Contact $contact;
    private ContactValidator $validator;

    public function __construct()
    {
        try {
            $database = new Database();

            $this->contact = new Contact(
                $database->getConnection()
            );

            $this->validator = new ContactValidator();
        } catch (PDOException $exception) {
            // Log the technical error without exposing database details to the end user
            error_log($exception->getMessage());

            throw new RuntimeException(
                'Unable to connect to the database.'
            );
        }
    }

    public function index(): array
    {
        return $this->contact->getAll();
    }

    public function store(array $data): array
    {
        // Validate the submitted form data before saving anything
        $errors = $this->validator->validate($data);

        if (!empty($errors)) {
            return [
                'success' => false,
                'errors' => $errors,
                'data' => $data,
            ];
        }

        // Store valid phone numbers in a consistent international format
        
        $phone = $this->normalizePhone($data['phone']);

        $success = $this->contact->create(
            trim($data['name']),
            trim($data['email']),
            $phone,
            trim($data['message'])
        );

        return [
            'success' => $success,
            'errors' => [],
            'data' => [],
        ];
    }

    private function normalizePhone(string $phone): string
{
    // Remove common formatting characters.
    $phone = preg_replace('/[\s\-().]/', '', trim($phone));

    // Convert a local 10 digit number to +27 format.
    if (str_starts_with($phone, '0')) {
        return '+27' . substr($phone, 1);
    }

    // Add the +27 country code to a 9 digit number.
    return '+27' . $phone;
}

}
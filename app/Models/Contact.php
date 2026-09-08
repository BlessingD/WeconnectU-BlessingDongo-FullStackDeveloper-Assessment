<?php

// Handles database operations for contact submissions

class Contact
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getAll(): array
    {
        $statement = $this->connection->query(
            'SELECT id, name, email, phone, message, created_at
             FROM contacts
             ORDER BY created_at DESC'
        );

        return $statement->fetchAll();
    }

 
    public function create(string $name, string $email,string $phone,string $message
                          ): bool {
    $sql = 'INSERT INTO contacts (name, email, phone, message)
            VALUES (:name, :email, :phone, :message)';

    $statement = $this->connection->prepare($sql);

    return $statement->execute([
        ':name' => $name,
        ':email' => $email,
        ':phone' => $phone,
        ':message' => $message,
    ]);
}

}
<?php
class Contact
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function save(string $name, string $email, string $subject, string $message): bool
    {
        $createdAt = date('Y-m-d H:i:s');
        $stmt = $this->db->prepare('INSERT INTO contacts (name, email, subject, message, status, created_at) VALUES (:name, :email, :subject, :message, :status, :created_at)');
        return $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':subject' => $subject,
            ':message' => $message,
            ':status' => 'new',
            ':created_at' => $createdAt,
        ]);
    }

    public function getAll(): array
    {
        $stmt = $this->db->query('SELECT * FROM contacts ORDER BY created_at DESC');
        return $stmt->fetchAll();
    }
}

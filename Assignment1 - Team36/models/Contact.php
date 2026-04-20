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

    public function getPaged(int $limit, int $offset): array
    {
        $stmt = $this->db->prepare('SELECT * FROM contacts ORDER BY created_at DESC LIMIT :limit OFFSET :offset');
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function countAll(): int
    {
        $stmt = $this->db->query('SELECT COUNT(*) FROM contacts');
        return (int) $stmt->fetchColumn();
    }

    public function updateStatus(int $id, string $status): bool
    {
        $allowed = ['new', 'read', 'replied'];
        if (!in_array($status, $allowed, true)) {
            return false;
        }

        $stmt = $this->db->prepare('UPDATE contacts SET status = :status WHERE id = :id');
        return $stmt->execute([':status' => $status, ':id' => $id]);
    }
}

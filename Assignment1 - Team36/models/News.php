<?php
class News
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAll(): array
    {
        $stmt = $this->db->query('SELECT * FROM news ORDER BY created_at DESC');
        return $stmt->fetchAll();
    }

    public function getById(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM news WHERE id = :id LIMIT 1');
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch();
        return $result === false ? null : $result;
    }

    public function create(string $title, string $content): bool
    {
        $stmt = $this->db->prepare('INSERT INTO news (title, content, created_at) VALUES (:title, :content, NOW())');
        return $stmt->execute([
            ':title' => $title,
            ':content' => $content,
        ]);
    }
}

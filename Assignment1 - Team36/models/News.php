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

    public function searchPaged(string $keyword, int $limit, int $offset): array
    {
        $kw = '%' . $keyword . '%';
        $stmt = $this->db->prepare(
            'SELECT * FROM news
             WHERE title LIKE :kw OR content LIKE :kw
             ORDER BY created_at DESC
             LIMIT :limit OFFSET :offset'
        );
        $stmt->bindValue(':kw', $kw, PDO::PARAM_STR);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function countSearch(string $keyword): int
    {
        $kw = '%' . $keyword . '%';
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM news WHERE title LIKE :kw OR content LIKE :kw');
        $stmt->execute([':kw' => $kw]);
        return (int) $stmt->fetchColumn();
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
        $createdAt = date('Y-m-d H:i:s');
        $stmt = $this->db->prepare('INSERT INTO news (title, content, created_at) VALUES (:title, :content, :created_at)');
        return $stmt->execute([
            ':title' => $title,
            ':content' => $content,
            ':created_at' => $createdAt,
        ]);
    }
}

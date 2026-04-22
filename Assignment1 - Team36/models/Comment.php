<?php
class Comment
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function create(int $userId, string $targetType, int $targetId, int $rating, string $content): bool
    {
        if (!in_array($targetType, ['product', 'news'], true)) {
            return false;
        }
        if ($targetId <= 0 || $rating < 1 || $rating > 5 || trim($content) === '') {
            return false;
        }

        $stmt = $this->db->prepare(
            'INSERT INTO comments (user_id, target_type, target_id, rating, content, status, created_at)
             VALUES (:user_id, :target_type, :target_id, :rating, :content, :status, :created_at)'
        );

        return $stmt->execute([
            ':user_id' => $userId,
            ':target_type' => $targetType,
            ':target_id' => $targetId,
            ':rating' => $rating,
            ':content' => trim($content),
            ':status' => 'approved',
            ':created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function getApprovedByTarget(string $targetType, int $targetId): array
    {
        if (!in_array($targetType, ['product', 'news'], true) || $targetId <= 0) {
            return [];
        }

        $stmt = $this->db->prepare(
            'SELECT c.*, u.name AS user_name
             FROM comments c
             INNER JOIN users u ON u.id = c.user_id
             WHERE c.target_type = :target_type AND c.target_id = :target_id AND c.status = :status
             ORDER BY c.created_at DESC'
        );
        $stmt->execute([
            ':target_type' => $targetType,
            ':target_id' => $targetId,
            ':status' => 'approved',
        ]);

        return $stmt->fetchAll();
    }

    public function getPagedForAdmin(int $limit, int $offset): array
    {
        $stmt = $this->db->prepare(
            'SELECT c.*, u.name AS user_name, u.email AS user_email
             FROM comments c
             INNER JOIN users u ON u.id = c.user_id
             ORDER BY c.created_at DESC
             LIMIT :limit OFFSET :offset'
        );
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function countAll(): int
    {
        $stmt = $this->db->query('SELECT COUNT(*) FROM comments');
        return (int) $stmt->fetchColumn();
    }

    public function updateStatus(int $id, string $status): bool
    {
        if ($id <= 0 || !in_array($status, ['approved', 'hidden'], true)) {
            return false;
        }

        $stmt = $this->db->prepare('UPDATE comments SET status = :status WHERE id = :id');
        return $stmt->execute([':status' => $status, ':id' => $id]);
    }

    public function deleteById(int $id): bool
    {
        if ($id <= 0) {
            return false;
        }

        $stmt = $this->db->prepare('DELETE FROM comments WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }
}

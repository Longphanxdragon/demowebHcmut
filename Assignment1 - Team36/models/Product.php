<?php
class Product
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAll(): array
    {
        $stmt = $this->db->query('SELECT * FROM products ORDER BY created_at DESC');
        return $stmt->fetchAll();
    }

    public function searchPaged(string $keyword, int $limit, int $offset): array
    {
        $kw = '%' . $keyword . '%';
        $stmt = $this->db->prepare(
            'SELECT * FROM products
             WHERE title LIKE :kw OR description LIKE :kw
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
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM products WHERE title LIKE :kw OR description LIKE :kw');
        $stmt->execute([':kw' => $kw]);
        return (int) $stmt->fetchColumn();
    }

    public function getById(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM products WHERE id = :id LIMIT 1');
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch();
        return $result === false ? null : $result;
    }

    public function create(string $title, string $description, float $price, string $imagePath): bool
    {
        $createdAt = date('Y-m-d H:i:s');
        $stmt = $this->db->prepare('INSERT INTO products (title, description, price, image_path, created_at) VALUES (:title, :description, :price, :image_path, :created_at)');
        return $stmt->execute([
            ':title' => $title,
            ':description' => $description,
            ':price' => $price,
            ':image_path' => $imagePath,
            ':created_at' => $createdAt,
        ]);
    }

    public function update(int $id, string $title, string $description, float $price, string $imagePath): bool
    {
        if ($id <= 0) {
            return false;
        }

        $stmt = $this->db->prepare(
            'UPDATE products
             SET title = :title,
                 description = :description,
                 price = :price,
                 image_path = :image_path
             WHERE id = :id'
        );

        return $stmt->execute([
            ':id' => $id,
            ':title' => $title,
            ':description' => $description,
            ':price' => $price,
            ':image_path' => $imagePath,
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM products WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }
}

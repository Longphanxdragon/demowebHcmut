<?php
class User
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function register(string $name, string $email, string $password): bool
    {
        if ($this->getByEmail($email)) {
            return false;
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $createdAt = date('Y-m-d H:i:s');
        $stmt = $this->db->prepare('INSERT INTO users (name, email, password, role, status, created_at) VALUES (:name, :email, :password, :role, :status, :created_at)');
        return $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => $hash,
            ':role' => 'member',
            ':status' => 'active',
            ':created_at' => $createdAt,
        ]);
    }

    public function login(string $email, string $password): ?array
    {
        $user = $this->getByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            unset($user['password']);
            return $user;
        }
        return null;
    }

    public function getByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
        $stmt->execute([':email' => $email]);
        $result = $stmt->fetch();
        return $result === false ? null : $result;
    }

    public function getById(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE id = :id LIMIT 1');
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch();
        return $result === false ? null : $result;
    }

    public function getAll(): array
    {
        $stmt = $this->db->query('SELECT id, name, email, role, status, created_at FROM users ORDER BY created_at DESC');
        return $stmt->fetchAll();
    }

    public function updateStatus(int $id, string $status): bool
    {
        $stmt = $this->db->prepare('UPDATE users SET status = :status WHERE id = :id');
        return $stmt->execute([':status' => $status, ':id' => $id]);
    }
}

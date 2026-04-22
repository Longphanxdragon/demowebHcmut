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

    public function getPaged(int $limit, int $offset): array
    {
        $stmt = $this->db->prepare('SELECT id, name, email, role, status, created_at FROM users ORDER BY created_at DESC LIMIT :limit OFFSET :offset');
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function countAll(): int
    {
        $stmt = $this->db->query('SELECT COUNT(*) FROM users');
        return (int) $stmt->fetchColumn();
    }

    public function updateStatus(int $id, string $status): bool
    {
        if (!in_array($status, ['active', 'blocked'], true)) {
            return false;
        }
        $stmt = $this->db->prepare('UPDATE users SET status = :status WHERE id = :id');
        return $stmt->execute([':status' => $status, ':id' => $id]);
    }

    public function resetPasswordByAdmin(int $id, string $newPassword): bool
    {
        if (strlen($newPassword) < 6) {
            return false;
        }

        $newHash = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare('UPDATE users SET password = :password WHERE id = :id');
        return $stmt->execute([
            ':password' => $newHash,
            ':id' => $id,
        ]);
    }

    public function deleteById(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM users WHERE id = :id AND role != :role');
        return $stmt->execute([
            ':id' => $id,
            ':role' => 'admin',
        ]);
    }

    public function updateProfile(int $id, string $name, string $avatar): bool
    {
        $stmt = $this->db->prepare('UPDATE users SET name = :name, avatar = :avatar WHERE id = :id');
        return $stmt->execute([
            ':name' => $name,
            ':avatar' => $avatar,
            ':id' => $id,
        ]);
    }

    public function updatePassword(int $id, string $oldPassword, string $newPassword): bool
    {
        $stmt = $this->db->prepare('SELECT password FROM users WHERE id = :id LIMIT 1');
        $stmt->execute([':id' => $id]);
        $hash = $stmt->fetchColumn();

        if (!$hash || !password_verify($oldPassword, $hash)) {
            return false;
        }

        $newHash = password_hash($newPassword, PASSWORD_DEFAULT);
        $update = $this->db->prepare('UPDATE users SET password = :password WHERE id = :id');
        return $update->execute([
            ':password' => $newHash,
            ':id' => $id,
        ]);
    }
}

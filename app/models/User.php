<?php

namespace App\Models;

use Core\Model;
use PDO;

class User extends Model
{

    private ?int $id = null;
    private string $email = '';
    private ?string $password = null;
    private ?string $profilePic = null;
    private ?string $role = null;
    private ?string $status = null;
    private ?string $createdAt = null;
    private ?string $updatedAt = null;
    private string $name = '';

    protected static string $table = 'users'; // Define table name

    public function __construct(?int $id = null, string $email = '', string $name = '')
    {
        if ($id !== null) {
            $this->id = $id;
        }
        $this->email = $email;
        $this->name = $name;
    }

    // getters
    function getId(): ?int
    {
        return $this->id;
    }
    function getName(): string
    {
        return $this->name;
    }
    function getEmail(): string
    {
        return $this->email;
    }
    // setters 
    function setName(string $name): void
    {
        $this->name = $name;
    }
    function setEmail(string $email): void
    {

        $this->email = $email;
    }

    // ------------------------
    // static methodes
    // ------------------------
    public static function getAll(): array
    {
        $stmt = self::db()->query("SELECT * FROM " . self::$table);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    static public function getUserById($id): ?array
    {
        $sql = "SELECT * FROM " . self::$table . " WHERE id = :id limit 1";
        $stmt = self::db()->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public static function create(array $data): self
    {
        try {
            $user = new self(null, $data['email'], $data['name']);
            if ($user->insert()) {
                return $user;
            }
            return null;
        } catch (\Exception $e) {
            return null;
        }
    }
    public function save(): bool
    {
        return $this->id ? $this->update() : $this->insert();
    }
    private function insert(): bool
    {
        $sql = "INSERT INTO " . self::$table . " (name, email, created_at) VALUES (:name, :email, NOW())";
        $stmt = self::db()->prepare($sql);
        $success = $stmt->execute([
            ':name' => $this->name,
            ':email' => $this->email
        ]);

        if ($success) {
            $this->id = (int)self::db()->lastInsertId();
        }

        return $success;
    }

    private function update(): bool
    {
        $sql = "UPDATE " . self::$table . " SET name = :name, email = :email WHERE id = :id";
        $stmt = self::db()->prepare($sql);
        return $stmt->execute([
            ':id' => $this->id,
            ':name' => $this->name,
            ':email' => $this->email
        ]);
    }

    static public function findByEmail(string $email): ?array
    {
        $sql = "SELECT * FROM " . self::$table . " WHERE email = :email";
        $stmt = self::db()->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
    static public function deleteUser($id)
    {
        $sql = "DELETE FROM " . self::$table . " WHERE id = :id";
        $stmt = self::db()->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}

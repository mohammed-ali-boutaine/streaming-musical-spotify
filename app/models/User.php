<?php

namespace App\Models;

use Core\Model;
use PDO;

class User extends Model
{

    private ?int $id = null;
    private string $email = '';
    private ?string $password = null;
    private string $username = '';
    private ?string $role = "user";
    private ?string $profilePic = null;
    private ?string $status = null;
    private ?string $createdAt = null;
    private ?string $updatedAt = null;

    protected static string $table = 'users'; // Define table name

    public function __construct($id = null, string $email = '', string $username = '',string $password ='',string $role="user",string $profilePic = null)
    {
        if ($id !== null) {
            $this->id = $id;
        }
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
        $this->profilePic = $profilePic;

        // $this->password = password_hash($password,PASSWORD_BCRYPT);
    }

    // getters
    function getId(): ?int
    {
        return $this->id;
    }
    function getPassword()
    {
        return $this->password;
    }
    function getUsername(): string
    {
        return $this->username;
    }
    function getEmail(): string
    {
        return $this->email;
    }
    function getRole(){
        return $this->role;
    }
    public function getProfilePic(): ?string
    {
        return $this->profilePic;
    }
    // setters 
    function setUsername(string $username): void
    {
        $this->username = $username;
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


    public function save(): bool
    {
        return $this->id ? $this->update() : $this->insert();
    }
    private function insert(): bool
    {
        $sql = "INSERT INTO " . self::$table . " (username, email,password, created_at) VALUES (:username, :email,:password, NOW())";
        $stmt = self::db()->prepare($sql);
        $success = $stmt->execute([
            ':username' => $this->username,
            ':email' => $this->email,
            ':password' => $this->password

        ]);

        if ($success) {
            $this->id = (int)self::db()->lastInsertId();
            return true;
        }

        return false;
    }

    private function update(): bool
    {
        $sql = "UPDATE " . self::$table . " SET name = :name, email = :email WHERE id = :id";
        $stmt = self::db()->prepare($sql);
        return $stmt->execute([
            ':id' => $this->id,
            ':name' => $this->username,
            ':email' => $this->email
        ]);
    }

    static public function findByEmail(string $email)
    {
        $sql = "SELECT * FROM " . self::$table . " WHERE email = :email";
        $stmt = self::db()->prepare($sql);
        $stmt->execute([':email' => $email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC) ?: null;

        return $result ?: false;
    }


    static public function deleteUser($id)
    {
        $sql = "DELETE FROM " . self::$table . " WHERE id = :id";
        $stmt = self::db()->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}

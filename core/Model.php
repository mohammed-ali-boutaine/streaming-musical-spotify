<?php


namespace Core;

use PDO;
use PDOException;
use RuntimeException;

class Model
{
    private static ?PDO $instance = null;
    protected static string $table = '';


    protected static function db()
    {
        if (self::$instance === null) {
            self::$instance = self::connect();
        }
        return self::$instance;
    }

    private static function connect(): PDO
    {
        $driver = $_ENV['DB_DRIVER'] ?? 'pgsql';
        $host = $_ENV['DB_HOST'] ;
        $dbname = $_ENV['DB_NAME'] ;
        $username = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASSWORD'] ;
        $dsn = "$driver:host=$host;dbname=$dbname";

        try {
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (\Exception $e) {
            throw new RuntimeException("Database connection error: " . $e->getMessage());
        }
    }


    public static function all(): array
    {
        $stmt = self::db()->query("SELECT * FROM " . static::$table);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Find a record by ID
    public static function find(int $id): ?array
    {
        $stmt = self::db()->prepare("SELECT * FROM " . static::$table . " WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    // Delete a record
    public static function delete(int $id): bool
    {
        $stmt = self::db()->prepare("DELETE FROM " . static::$table . " WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}

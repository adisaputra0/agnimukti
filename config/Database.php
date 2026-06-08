<?php

class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname   = "db_agnimukti";

    public function connect() {
        try {
            $pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4",
                $this->username,
                $this->password
            );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;
        } catch (PDOException $e) {
            die("Koneksi database gagal: " . $e->getMessage());
        }
    }
}

?>
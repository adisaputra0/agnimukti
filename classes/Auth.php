<?php

require_once __DIR__ . '/../config/Database.php';

class Auth {
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }
    public function register($nama, $username, $password, $no_telepon = null, $alamat = null) {
        try {
        //Cek username sudah dipakai atau belum
        $query = "SELECT id_user FROM users WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return [
                "status" => false,
                "message" => "Username sudah digunakan"
            ];
        }

        // Cek input kosong
        if (empty($nama) || empty($username) || empty($password)) {
        return [
            "status" => false,
            "message" => "Semua field wajib diisi"
            ];
        }

        // Validasi minimal password 
        if (strlen($password) < 6) {
            return [
                "status" => false,
                "message" => "Password minimal 6 karakter"
            ];
        }

        //Hash password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        //Insert user baru
        $query = "INSERT INTO users 
        (nama, username, password, role, no_telepon, alamat)
        VALUES
        (:nama, :username, :password, :role, :no_telepon, :alamat)";

        $stmt = $this->conn->prepare($query);

        // role default = pemohon
        $role = "pemohon";

        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':no_telepon', $no_telepon);
        $stmt->bindParam(':alamat', $alamat);

        $stmt->execute();

        return [
            "status" => true,
            "message" => "Registrasi berhasil"
        ];

    } catch (PDOException $e) {
        return [
            "status" => false,
            "message" => "Error: " . $e->getMessage()
        ];
    }
    }
    public function login($username, $password) {
        try {
        //Cek input kosong
        if (empty($username) || empty($password)) {
            return [
                "status" => false,
                "message" => "Username dan password wajib diisi"
            ];
        }

        //cari user berdasarkan username
        $query = "SELECT * FROM users WHERE username = :username LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        //Cek user ada atau tidak
        if (!$user) {
            return [
                "status" => false,
                "message" => "Username tidak ditemukan"
            ];
        }

        //validasi password
        if (!password_verify($password, $user['password'])) {
            return [
                "status" => false,
                "message" => "Password salah"
            ];
        }

        //Buat session
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['user'] = [
            "id_user" => $user['id_user'],
            "nama" => $user['nama'],
            "username" => $user['username'],
            "role" => $user['role'],
            "foto_url" => $user['foto_url']
        ];

        return [
            "status" => true,
            "message" => "Login berhasil",
            "data" => $_SESSION['user']
        ];

    } catch (PDOException $e) {
        return [
            "status" => false,
            "message" => "Error: " . $e->getMessage()
        ];
    }
    }
    public function logout() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    unset($_SESSION['user']);
    session_destroy();

    return [
        "status" => true,
        "message" => "Logout berhasil"
    ];
    }
    public function checkLogin() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['user'])) {
        return [
            "status" => true,
            "message" => "User sudah login",
            "data" => $_SESSION['user']
        ];
    }

    return [
        "status" => false,
        "message" => "User belum login"
    ];
    }
}

?>
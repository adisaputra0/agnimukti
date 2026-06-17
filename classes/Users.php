<?php

require_once __DIR__ . '/../config/Database.php';

class Users {
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }
    public function getAll() {
    $query = "SELECT * FROM users";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function create($nama, $username, $password, $role, $no_telepon, $alamat) {
    
    // Cek username(double apa gak)
    $check = $this->conn->prepare(
    "SELECT id_user FROM users WHERE username = ?"
    );

    $check->execute([$username]);

    if ($check->rowCount() > 0) {
        return false;
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $query = "
    INSERT INTO users 
    (nama, username, password, role, no_telepon, alamat)
    VALUES (?, ?, ?, ?, ?, ?)
    ";

    $stmt = $this->conn->prepare($query);

    return $stmt->execute([
        $nama,
        $username,
        $hashedPassword,
        $role,
        $no_telepon,
        $alamat
    ]);

    }


    public function update($id_user, $nama, $username, $password, $role, $no_telepon, $alamat) {
    
    // Cek username dipake apa gak
    $check = $this->conn->prepare(
        "SELECT id_user FROM users 
        WHERE username = ? AND id_user != ?"
    );

    $check->execute([
        $username,
        $id_user
    ]);

    if ($check->rowCount() > 0) {
        return false;
    }

    if (!empty($password)) {

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $query = "
        UPDATE users 
        SET nama = ?, 
            username = ?, 
            password = ?, 
            role = ?, 
            no_telepon = ?, 
            alamat = ?
        WHERE id_user = ?
    ";

    $params = [
        $nama,
        $username,
        $hashedPassword,
        $role,
        $no_telepon,
        $alamat,
        $id_user
    ];

    } else {
        
        $query = "
            UPDATE users 
            SET nama = ?, 
                username = ?, 
                role = ?, 
                no_telepon = ?, 
                alamat = ?
            WHERE id_user = ?
        ";

        $params = [
            $nama,
            $username,
            $role,
            $no_telepon,
            $alamat,
            $id_user
        ];
    }

    $stmt = $this->conn->prepare($query);

    return $stmt->execute($params);
    }
    public function delete($id_user) {

    $query = "DELETE FROM users WHERE id_user = ?";

    $stmt = $this->conn->prepare($query);

    return $stmt->execute([$id_user]);
    }
}

?>
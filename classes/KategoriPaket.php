<?php

require_once __DIR__ . '/../config/Database.php';

class KategoriPaket {
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }
    public function getAll() {
        try {
        $query = "SELECT * FROM kategori_paket ORDER BY id_kategori DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return [
            "status" => true,
            "message" => "Data kategori berhasil diambil",
            "data" => $data
        ];

        } catch (PDOException $e) {
            return [
                "status" => false,
                "message" => $e->getMessage()
            ];
        }
    }
    public function create($nama_kategori, $deskripsi) {
        try {
        if (empty($nama_kategori)) {
            return [
                "status" => false,
                "message" => "Nama kategori wajib diisi"
            ];
        }

        $query = "INSERT INTO kategori_paket (nama_kategori, deskripsi)
        VALUES (:nama_kategori, :deskripsi)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nama_kategori', $nama_kategori);
        $stmt->bindParam(':deskripsi', $deskripsi);

        $stmt->execute();

        return [
            "status" => true,
            "message" => "Kategori berhasil ditambahkan"
        ];

        } catch (PDOException $e) {
            return [
                "status" => false,
                "message" => $e->getMessage()
            ];
        }
    }
    public function update($id_kategori, $nama_kategori, $deskripsi) {
        try {
        $query = "UPDATE kategori_paket 
                SET nama_kategori = :nama_kategori,
                    deskripsi = :deskripsi
                WHERE id_kategori = :id_kategori";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id_kategori', $id_kategori);
        $stmt->bindParam(':nama_kategori', $nama_kategori);
        $stmt->bindParam(':deskripsi', $deskripsi);

        $stmt->execute();

        return [
            "status" => true,
            "message" => "Kategori berhasil diupdate"
        ];

        } catch (PDOException $e) {
            return [
                "status" => false,
                "message" => $e->getMessage()
            ];
        }
    }
    public function delete($id_kategori) {
        try {
        $query = "DELETE FROM kategori_paket WHERE id_kategori = :id_kategori";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id_kategori', $id_kategori);
        $stmt->execute();

        return [
            "status" => true,
            "message" => "Kategori berhasil dihapus"
        ];

        } catch (PDOException $e) {
            return [
                "status" => false,
                "message" => $e->getMessage()
            ];
        }
    }
}

?>
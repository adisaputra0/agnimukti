<?php

require_once __DIR__ . '/../config/Database.php';

class PaketLayanan
{
    private $conn;
    private $table = "paket_layanan";

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Ambil semua paket
    public function getAll()
    {
        $sql = "SELECT 
                    p.id_paket,
                    p.id_kategori,
                    k.nama_kategori,
                    p.nama_paket,
                    p.harga,
                    p.fasilitas
                FROM paket_layanan p
                JOIN kategori_paket k
                    ON p.id_kategori = k.id_kategori
                ORDER BY p.id_paket DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil paket berdasarkan ID
    public function getById($id)
    {
        $sql = "SELECT * FROM {$this->table}
                WHERE id_paket = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Tambah paket
    public function create($id_kategori, $nama_paket, $harga, $fasilitas)
    {
        $sql = "INSERT INTO {$this->table}
                (
                    id_kategori,
                    nama_paket,
                    harga,
                    fasilitas
                )
                VALUES
                (
                    :id_kategori,
                    :nama_paket,
                    :harga,
                    :fasilitas
                )";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':id_kategori' => $id_kategori,
            ':nama_paket' => $nama_paket,
            ':harga' => $harga,
            ':fasilitas' => $fasilitas
        ]);
    }

    // Update paket
    public function update($id_paket, $id_kategori, $nama_paket, $harga, $fasilitas)
    {
        $sql = "UPDATE {$this->table}
                SET
                    id_kategori = :id_kategori,
                    nama_paket = :nama_paket,
                    harga = :harga,
                    fasilitas = :fasilitas
                WHERE id_paket = :id_paket";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':id_paket' => $id_paket,
            ':id_kategori' => $id_kategori,
            ':nama_paket' => $nama_paket,
            ':harga' => $harga,
            ':fasilitas' => $fasilitas
        ]);
    }

    // Hapus paket
    public function delete($id_paket)
    {
        $sql = "DELETE FROM {$this->table}
                WHERE id_paket = :id_paket";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':id_paket' => $id_paket
        ]);
    }
}
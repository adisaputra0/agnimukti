<?php

require_once __DIR__ . '/../config/Database.php';

class Pembayaran
{
    private $conn;
    private $table = "pembayaran";

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Ambil semua pembayaran
    public function getAll()
    {
        $sql = "SELECT
                    p.id_pembayaran,
                    p.id_pendaftaran,
                    d.kode_pendaftaran,
                    d.nama_almarhum,
                    p.tanggal_bayar,
                    p.total_bayar,
                    p.metode_pembayaran,
                    p.status_pembayaran
                FROM pembayaran p
                JOIN pendaftaran d
                    ON p.id_pendaftaran = d.id_pendaftaran
                ORDER BY p.id_pembayaran DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil pembayaran berdasarkan ID
    public function getById($id)
    {
        $sql = "SELECT *
                FROM {$this->table}
                WHERE id_pembayaran = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Tambah pembayaran
    public function create(
        $id_pendaftaran,
        $tanggal_bayar,
        $total_bayar,
        $metode_pembayaran,
        $status_pembayaran
    ) {
        $sql = "INSERT INTO {$this->table}
                (
                    id_pendaftaran,
                    tanggal_bayar,
                    total_bayar,
                    metode_pembayaran,
                    status_pembayaran
                )
                VALUES
                (
                    :id_pendaftaran,
                    :tanggal_bayar,
                    :total_bayar,
                    :metode_pembayaran,
                    :status_pembayaran
                )";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':id_pendaftaran' => $id_pendaftaran,
            ':tanggal_bayar' => $tanggal_bayar,
            ':total_bayar' => $total_bayar,
            ':metode_pembayaran' => $metode_pembayaran,
            ':status_pembayaran' => $status_pembayaran
        ]);
    }

    // Update pembayaran
    public function update(
        $id_pembayaran,
        $id_pendaftaran,
        $tanggal_bayar,
        $total_bayar,
        $metode_pembayaran,
        $status_pembayaran
    ) {
        $sql = "UPDATE {$this->table}
                SET
                    id_pendaftaran = :id_pendaftaran,
                    tanggal_bayar = :tanggal_bayar,
                    total_bayar = :total_bayar,
                    metode_pembayaran = :metode_pembayaran,
                    status_pembayaran = :status_pembayaran
                WHERE id_pembayaran = :id_pembayaran";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':id_pembayaran' => $id_pembayaran,
            ':id_pendaftaran' => $id_pendaftaran,
            ':tanggal_bayar' => $tanggal_bayar,
            ':total_bayar' => $total_bayar,
            ':metode_pembayaran' => $metode_pembayaran,
            ':status_pembayaran' => $status_pembayaran
        ]);
    }

    // Hapus pembayaran
    public function delete($id_pembayaran)
    {
        $sql = "DELETE FROM {$this->table}
                WHERE id_pembayaran = :id_pembayaran";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':id_pembayaran' => $id_pembayaran
        ]);
    }

    // Ambil semua pembayaran berdasarkan user
    public function getByUser($id_user)
    {
        $sql = "SELECT
                    p.id_pembayaran,
                    p.id_pendaftaran,
                    d.kode_pendaftaran,
                    d.nama_almarhum,
                    p.tanggal_bayar,
                    p.total_bayar,
                    p.metode_pembayaran,
                    p.status_pembayaran

                FROM pembayaran p

                JOIN pendaftaran d
                    ON p.id_pendaftaran = d.id_pendaftaran

                WHERE d.id_user = :id_user

                ORDER BY p.id_pembayaran DESC";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ':id_user' => $id_user
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
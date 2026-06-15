<?php

require_once __DIR__ . '/../config/Database.php';

class Pendaftaran
{
    private $conn;
    private $table = "pendaftaran";

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Ambil semua data pendaftaran
    public function getAll()
    {
        $sql = "SELECT
                    p.id_pendaftaran,
                    p.kode_pendaftaran,
                    p.nama_almarhum,
                    p.tanggal_lahir,
                    p.tanggal_meninggal,
                    p.tanggal_daftar,
                    p.status,
                    p.catatan,

                    u.id_user,
                    u.nama AS nama_pemohon,

                    pl.id_paket,
                    pl.nama_paket,
                    pl.harga

                FROM pendaftaran p

                JOIN users u
                    ON p.id_user = u.id_user

                JOIN paket_layanan pl
                    ON p.id_paket = pl.id_paket

                ORDER BY p.id_pendaftaran DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil berdasarkan ID
    public function getById($id)
    {
        $sql = "SELECT *
                FROM {$this->table}
                WHERE id_pendaftaran = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Tambah pendaftaran
    public function create(
        $kode_pendaftaran,
        $id_user,
        $id_paket,
        $nama_almarhum,
        $tanggal_lahir,
        $tanggal_meninggal,
        $tanggal_daftar,
        $catatan
    ) {
        $sql = "INSERT INTO {$this->table}
                (
                    kode_pendaftaran,
                    id_user,
                    id_paket,
                    nama_almarhum,
                    tanggal_lahir,
                    tanggal_meninggal,
                    tanggal_daftar,
                    catatan
                )
                VALUES
                (
                    :kode_pendaftaran,
                    :id_user,
                    :id_paket,
                    :nama_almarhum,
                    :tanggal_lahir,
                    :tanggal_meninggal,
                    :tanggal_daftar,
                    :catatan
                )";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':kode_pendaftaran' => $kode_pendaftaran,
            ':id_user' => $id_user,
            ':id_paket' => $id_paket,
            ':nama_almarhum' => $nama_almarhum,
            ':tanggal_lahir' => $tanggal_lahir,
            ':tanggal_meninggal' => $tanggal_meninggal,
            ':tanggal_daftar' => $tanggal_daftar,
            ':catatan' => $catatan
        ]);
    }

    // Update pendaftaran
    public function update(
        $id_pendaftaran,
        $id_user,
        $id_paket,
        $nama_almarhum,
        $tanggal_lahir,
        $tanggal_meninggal,
        $tanggal_daftar,
        $status,
        $catatan
    ) {
        $sql = "UPDATE {$this->table}
                SET
                    id_user = :id_user,
                    id_paket = :id_paket,
                    nama_almarhum = :nama_almarhum,
                    tanggal_lahir = :tanggal_lahir,
                    tanggal_meninggal = :tanggal_meninggal,
                    tanggal_daftar = :tanggal_daftar,
                    status = :status,
                    catatan = :catatan
                WHERE id_pendaftaran = :id_pendaftaran";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':id_pendaftaran' => $id_pendaftaran,
            ':id_user' => $id_user,
            ':id_paket' => $id_paket,
            ':nama_almarhum' => $nama_almarhum,
            ':tanggal_lahir' => $tanggal_lahir,
            ':tanggal_meninggal' => $tanggal_meninggal,
            ':tanggal_daftar' => $tanggal_daftar,
            ':status' => $status,
            ':catatan' => $catatan
        ]);
    }

    // Hapus pendaftaran
    public function delete($id_pendaftaran)
    {
        $sql = "DELETE FROM {$this->table}
                WHERE id_pendaftaran = :id_pendaftaran";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':id_pendaftaran' => $id_pendaftaran
        ]);
    }

    // Generate kode otomatis
    public function generateKode()
    {
        $sql = "SELECT MAX(id_pendaftaran) AS terakhir
                FROM pendaftaran";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $nomor = ($row['terakhir'] ?? 0) + 1;

        return "KRM" . str_pad($nomor, 3, "0", STR_PAD_LEFT);
    }

    // Update status saja
    public function updateStatus($id_pendaftaran, $status)
    {
        $sql = "UPDATE pendaftaran
                SET status = :status
                WHERE id_pendaftaran = :id";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':status' => $status,
            ':id' => $id_pendaftaran
        ]);
    }
}
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
    
    public function getUserById($id_user)
    {
        try {
            $query = "SELECT * FROM users WHERE id_user = :id_user LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_user', $id_user);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                return [
                    "status" => false,
                    "message" => "User tidak ditemukan"
                ];
            }

            unset($user['password']);

            return [
                "status" => true,
                "data" => $user
            ];

        } catch (PDOException $e) {
            return [
                "status" => false,
                "message" => "Error: " . $e->getMessage()
            ];
        }
    }
    public function updateProfile(
        $id_user,
        $nama,
        $username,
        $no_telepon = null,
        $alamat = null,
        $fileGambar = null
    ) {
        try {
            // 1. Cek apakah username sudah digunakan oleh user lain
            $check = $this->conn->prepare("
                SELECT id_user
                FROM users
                WHERE username = :username
                AND id_user != :id_user
            ");

            $check->bindParam(':username', $username);
            $check->bindParam(':id_user', $id_user);
            $check->execute();

            if ($check->rowCount() > 0) {
                return [
                    "status" => false,
                    "message" => "Username sudah digunakan"
                ];
            }

            // 2. Ambil data lama sebagai fallback foto jika tidak ada upload baru
            $currentUserData = $this->getUserById($id_user);
            $foto_url = $currentUserData['data']['foto_url'] ?? null;

            // 3. Proses upload foto profil (jika ada file yang di-upload)
            if ($fileGambar && $fileGambar['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $fileGambar['tmp_name'];
                $fileName = $fileGambar['name'];
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                
                // Validasi ekstensi gambar
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                if (!in_array($fileExtension, $allowedExtensions)) {
                    return [
                        "status" => false,
                        "message" => "Format gambar tidak didukung (Gunakan JPG, JPEG, PNG, WEBP, atau GIF)."
                    ];
                }

                // Berikan nama unik
                $newFileName = 'avatar_' . $id_user . '_' . time() . '.' . $fileExtension;

                // Tentukan direktori penyimpanan relatif terhadap file Users.php ini
                // Sesuaikan tingkat keluar folder (../) dengan struktur aslimu
                $uploadFileDir = __DIR__ . '/../public/assets/uploads/';
                
                // Buat folder jika belum ada
                if (!is_dir($uploadFileDir)) {
                    mkdir($uploadFileDir, 0755, true);
                }
                
                $dest_path = $uploadFileDir . $newFileName;
                
                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    // Opsional: Hapus file foto lama di server agar tidak memakan ruang (jika bukan foto default)
                    if ($foto_url && file_exists(__DIR__ . '/../' . str_replace('../', '', $foto_url))) {
                        // unlink(__DIR__ . '/../' . str_replace('../', '', $foto_url));
                    }

                    // Simpan path relatif untuk kebutuhan tag <img src="..."> di client
                    $foto_url = '../assets/uploads/' . $newFileName;
                } else {
                    return [
                        "status" => false,
                        "message" => "Gagal memindahkan file gambar ke folder server."
                    ];
                }
            }

            // 4. Eksekusi Update ke Database
            $query = "
                UPDATE users
                SET
                    nama = :nama,
                    username = :username,
                    no_telepon = :no_telepon,
                    alamat = :alamat,
                    foto_url = :foto_url
                WHERE id_user = :id_user
            ";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':nama', $nama);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':no_telepon', $no_telepon);
            $stmt->bindParam(':alamat', $alamat);
            $stmt->bindParam(':foto_url', $foto_url);
            $stmt->bindParam(':id_user', $id_user);

            $stmt->execute();

            // Sync ke session jika user yang sedang login merubah datanya sendiri
            if (
                session_status() === PHP_SESSION_ACTIVE &&
                isset($_SESSION['user']) &&
                $_SESSION['user']['id_user'] == $id_user
            ) {
                $_SESSION['user']['nama'] = $nama;
                $_SESSION['user']['username'] = $username;
                $_SESSION['user']['foto_url'] = $foto_url;
            }

            return [
                "status" => true,
                "message" => "Profil berhasil diperbarui"
            ];

        } catch (PDOException $e) {
            return [
                "status" => false,
                "message" => "Error: " . $e->getMessage()
            ];
        }
    }
    public function updatePassword(
        $id_user,
        $old_password,
        $new_password,
        $confirm_password
    )
    {
        try {

            if (
                empty($old_password) ||
                empty($new_password) ||
                empty($confirm_password)
            ) {
                return [
                    "status" => false,
                    "message" => "Semua field password wajib diisi"
                ];
            }

            if ($new_password !== $confirm_password) {
                return [
                    "status" => false,
                    "message" => "Konfirmasi password tidak cocok"
                ];
            }

            if (strlen($new_password) < 6) {
                return [
                    "status" => false,
                    "message" => "Password minimal 6 karakter"
                ];
            }

            $query = "SELECT password FROM users WHERE id_user = :id_user";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_user', $id_user);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                return [
                    "status" => false,
                    "message" => "User tidak ditemukan"
                ];
            }

            if (!password_verify($old_password, $user['password'])) {
                return [
                    "status" => false,
                    "message" => "Password lama salah"
                ];
            }

            $hashedPassword = password_hash(
                $new_password,
                PASSWORD_BCRYPT
            );

            $update = $this->conn->prepare("
                UPDATE users
                SET password = :password
                WHERE id_user = :id_user
            ");

            $update->bindParam(':password', $hashedPassword);
            $update->bindParam(':id_user', $id_user);
            $update->execute();

            return [
                "status" => true,
                "message" => "Password berhasil diperbarui"
            ];

        } catch (PDOException $e) {
            return [
                "status" => false,
                "message" => "Error: " . $e->getMessage()
            ];
        }
    }
}

?>
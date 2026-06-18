<?php
require_once __DIR__ . '/../classes/Auth.php';

// =========================================================================
// LOGIKA BACKEND REGISTER
// =========================================================================
$auth = new Auth();
$alertMessage = "";
$alertStatus = null; // true untuk sukses, false untuk gagal

// Redirect jika user terdeteksi sudah login
$check = $auth->checkLogin();
if ($check['status']) {
    if($check["data"]["role"] == "pemohon"){
        header("Location: user");
    }else{
        header("Location: admin");
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    // Opsional field tambahan
    $no_telepon = !empty($_POST['no_telepon']) ? trim($_POST['no_telepon']) : null;
    $alamat = !empty($_POST['alamat']) ? trim($_POST['alamat']) : null;

    $result = $auth->register($nama, $username, $password, $no_telepon, $alamat);
    
    $alertStatus = $result['status'];
    $alertMessage = $result['message'];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-[#E8DDD0] flex items-center justify-center min-h-screen p-4">

    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md border border-[#BFC3B1]">

        <h1 class="text-3xl font-bold text-center mb-6 text-[#2B221D]">
            Daftar
        </h1>

        <?php if ($alertStatus !== null): ?>
            <?php if ($alertStatus === true): ?>
                <div class="mb-5 p-4 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm">
                    <p class="font-semibold"><?= htmlspecialchars($alertMessage); ?></p>
                    <p class="text-xs mt-1 text-emerald-600">Mengalihkan ke halaman login dalam 3 detik...</p>
                </div>
                <script>
                    setTimeout(function() {
                        window.location.href = 'login.php';
                    }, 3000);
                </script>
            <?php else: ?>
                <div class="mb-5 p-4 rounded-lg bg-rose-50 border border-rose-200 text-rose-800 text-sm font-medium">
                    <?= htmlspecialchars($alertMessage); ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <form action="" method="POST" class="space-y-4">

            <div>
                <label class="block mb-1.5 font-medium text-sm text-[#2B221D]">
                    Nama Lengkap <span class="text-rose-500">*</span>
                </label>
                <input
                    type="text"
                    name="nama"
                    required
                    value="<?= isset($_POST['nama']) && !$alertStatus ? htmlspecialchars($_POST['nama']) : ''; ?>"
                    placeholder="Masukkan nama lengkap Anda"
                    class="w-full border border-[#BFC3B1] rounded-lg px-4 py-2 text-sm text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#B86E4B] focus:border-[#B86E4B] bg-white">
            </div>

            <div>
                <label class="block mb-1.5 font-medium text-sm text-[#2B221D]">
                    Username <span class="text-rose-500">*</span>
                </label>
                <input
                    type="text"
                    name="username"
                    required
                    value="<?= isset($_POST['username']) && !$alertStatus ? htmlspecialchars($_POST['username']) : ''; ?>"
                    placeholder="Masukkan username"
                    class="w-full border border-[#BFC3B1] rounded-lg px-4 py-2 text-sm text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#B86E4B] focus:border-[#B86E4B] bg-white">
            </div>

            <div>
                <label class="block mb-1.5 font-medium text-sm text-[#2B221D]">
                    Password <span class="text-rose-500">*</span>
                </label>
                <input
                    type="password"
                    name="password"
                    required
                    placeholder="Minimal 6 karakter"
                    class="w-full border border-[#BFC3B1] rounded-lg px-4 py-2 text-sm text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#B86E4B] focus:border-[#B86E4B] bg-white">
            </div>

            <div class="pt-2">
                <button
                    type="submit"
                    class="w-full bg-[#5B4636] text-white py-2.5 rounded-lg hover:bg-[#4A392C] transition duration-300 font-medium text-sm shadow-sm cursor-pointer">
                    Daftar Akun
                </button>
            </div>

            <div class="text-center pt-2 border-t border-[#F5F1EC]">
                <p class="text-xs text-[#5B4636]">
                    Sudah punya akun?
                    <a href="login.php" class="font-semibold text-[#B86E4B] hover:underline ml-1">
                        Masuk di sini
                    </a>
                </p>
            </div>

        </form>

    </div>

</body>
</html>
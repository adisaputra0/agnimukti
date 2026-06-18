<?php
require_once __DIR__ . '/../classes/Auth.php';

// =========================================================================
// LOGIKA BACKEND LOGIN
// =========================================================================
$auth = new Auth();
$alertMessage = "";
$alertStatus = null; // true untuk sukses, false untuk gagal

// Cek apakah user sudah login, jika ya langsung lempar ke dashboard
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
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $result = $auth->login($username, $password);
    
    $alertStatus = $result['status'];
    $alertMessage = $result['message'];

    if ($alertStatus === true) {
        if($result["data"]["role"] == "pemohon"){
            header("Location: user");
        }else{
            header("Location: admin");
        }
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-[#E8DDD0] flex items-center justify-center min-h-screen p-4">

    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md border border-[#BFC3B1]">

        <h1 class="text-3xl font-bold text-center mb-6 text-[#2B221D]">
            Masuk
        </h1>

        <?php if ($alertStatus === false): ?>
            <div class="mb-5 p-4 rounded-lg bg-rose-50 border border-rose-200 text-rose-800 text-sm font-medium">
                <?= htmlspecialchars($alertMessage); ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="space-y-5">

            <div>
                <label class="block mb-2 font-medium text-sm text-[#2B221D]">
                    Username
                </label>
                <input
                    type="text"
                    name="username"
                    required
                    value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>"
                    placeholder="Masukkan username"
                    class="w-full border border-[#BFC3B1] rounded-lg px-4 py-2 text-sm text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#B86E4B] focus:border-[#B86E4B] bg-white">
            </div>

            <div>
                <label class="block mb-2 font-medium text-sm text-[#2B221D]">
                    Password
                </label>
                <input
                    type="password"
                    name="password"
                    required
                    placeholder="Masukkan password"
                    class="w-full border border-[#BFC3B1] rounded-lg px-4 py-2 text-sm text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#B86E4B] focus:border-[#B86E4B] bg-white">
            </div>

            <div class="pt-2">
                <button
                    type="submit"
                    class="w-full bg-[#5B4636] text-white py-2.5 rounded-lg hover:bg-[#4A392C] transition duration-300 font-medium text-sm shadow-sm cursor-pointer">
                    Masuk
                </button>
            </div>

            <div class="text-center pt-2 border-t border-[#F5F1EC]">
                <p class="text-xs text-[#5B4636]">
                    Belum punya akun?
                    <a href="register.php" class="font-semibold text-[#B86E4B] hover:underline ml-1">
                        Daftar di sini
                    </a>
                </p>
            </div>

        </form>

    </div>

</body>
</html>
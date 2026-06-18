<?php
    require_once __DIR__ . '/../../classes/Auth.php';

    // =========================================================================
    // LOGIKA BACKEND LOGIN & LOGOUT
    // =========================================================================
    $auth = new Auth();
    $alertMessage = "";

    // Fitur proses logout jika parameter action ditekan
    if (isset($_GET['action']) && $_GET['action'] === 'logout') {
        $auth->logout();
        header("Location: ../login.php");
        exit;
    }

    // Cek apakah user sudah login, jika ya pastikan dia adalah pemohon/user biasa
    $authUser = $auth->checkLogin();
    if (!$authUser['status']) {
        header("Location: ../login.php");
        exit;
    }
    
    // Set halaman default ke beranda pemohon
    $currentPage = $_GET['page'] ?? 'beranda';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agnimukti - Pemohon</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <link rel="shortcut icon" href="../assets/logo.png" type="image/x-icon">
</head>
<body class="bg-[#F7F4F0] min-h-screen flex flex-col md:flex-row">

    <header class="md:hidden flex items-center justify-between px-4 py-3 bg-[#E8DDD0] border-b border-[#BFC3B1] sticky top-0 z-50">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-[#BFC3B1] flex items-center justify-center">
                <img src="../assets/logo.png" alt="Logo" class="w-full h-full">
            </div>
            <div>
                <p class="text-sm font-semibold text-[#2B221D] leading-tight">Agnimukti</p>
            </div>
        </div>
        <button id="menuBtn" class="text-[#5B4636] p-1 focus:outline-none" aria-label="Toggle Menu">
            <i class="ti ti-menu-2 text-2xl" id="menuIcon"></i>
        </button>
    </header>

    <div id="sidebarOverlay" class="fixed inset-0 bg-black/40 z-30 hidden md:hidden transition-opacity duration-300 opacity-0"></div>

    <aside id="sidebar" class="w-64 min-h-screen bg-[#E8DDD0] border-r border-[#BFC3B1] flex flex-col fixed top-0 left-0 z-40 transition-transform duration-300 -translate-x-full md:translate-x-0">

        <div class="px-6 py-5 border-b border-[#BFC3B1] flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-[#BFC3B1] flex items-center justify-center">
                    <img src="../assets/logo.png" alt="Logo" class="w-full h-full">
                </div>
                <div>
                    <p class="text-sm font-semibold text-[#2B221D] leading-tight">Agnimukti</p>
                    <p class="text-xs text-[#5B4636]">Portal Pemohon</p>
                </div>
            </div>
            <button id="closeBtn" class="md:hidden text-[#5B4636] hover:text-[#B86E4B]">
                <i class="ti ti-x text-xl"></i>
            </button>
        </div>

        <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
            <p class="text-xs text-[#5B4636] uppercase tracking-wider px-3 mb-2">Menu Utama</p>

            <a href="?page=beranda" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-colors
            <?= $currentPage == 'beranda' ? 'bg-[#BFC3B1] text-[#5B4636] font-medium' : 'text-[#5B4636] hover:bg-[#D8D2C6]'; ?>">
                <i class="ti ti-smart-home text-lg" aria-hidden="true"></i>
                Beranda
            </a>

            <a href="?page=daftar-paket" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-colors
            <?= $currentPage == 'daftar-paket' ? 'bg-[#BFC3B1] text-[#5B4636] font-medium' : 'text-[#5B4636] hover:bg-[#D8D2C6]'; ?>">
                <i class="ti ti-packages text-lg" aria-hidden="true"></i>
                Daftar Paket Layanan
            </a>

            <a href="?page=pendaftaran" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-colors
            <?= $currentPage == 'pendaftaran' ? 'bg-[#BFC3B1] text-[#5B4636] font-medium' : 'text-[#5B4636] hover:bg-[#D8D2C6]'; ?>">
                <i class="ti ti-file-plus text-lg" aria-hidden="true"></i>
                Pendaftaran Kremasi
            </a>

            <a href="?page=riwayat" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-colors
            <?= $currentPage == 'riwayat' ? 'bg-[#BFC3B1] text-[#5B4636] font-medium' : 'text-[#5B4636] hover:bg-[#D8D2C6]'; ?>">
                <i class="ti ti-history text-lg" aria-hidden="true"></i>
                Riwayat Pendaftaran
            </a>

            <a href="?page=pembayaran" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-colors
            <?= $currentPage == 'pembayaran' ? 'bg-[#BFC3B1] text-[#5B4636] font-medium' : 'text-[#5B4636] hover:bg-[#D8D2C6]'; ?>">
                <i class="ti ti-credit-card text-lg" aria-hidden="true"></i>
                Status Pembayaran
            </a>

            <div class="pt-4">
                <p class="text-xs text-[#5B4636] uppercase tracking-wider px-3 mb-2">Akun Saya</p>
                <a href="?page=settings" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-colors
                <?= $currentPage == 'settings' ? 'bg-[#BFC3B1] text-[#5B4636] font-medium' : 'text-[#5B4636] hover:bg-[#D8D2C6]'; ?>">
                    <i class="ti ti-user-circle text-lg" aria-hidden="true"></i>
                    Profil Saya
                </a>
            </div>
        </nav>

        <div class="px-4 py-4 border-t border-[#BFC3B1]">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-[#BFC3B1] flex items-center justify-center text-[#2B221D] font-semibold text-sm overflow-hidden">
                    <img 
                        src="<?= !empty($authUser['data']['foto_url']) ? $authUser['data']['foto_url'] : '../assets/user.jpg'; ?>" 
                        alt="User" 
                        class="w-full h-full object-cover"
                    >
                </div>

                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-[#2B221D] truncate"><?= htmlspecialchars($authUser['data']['nama']) ?></p>
                    <p class="text-xs text-[#5B4636] truncate">Pemohon</p>
                </div>

                <a href="?action=logout" onclick="return confirm('Apakah Anda yakin ingin keluar dari sistem?')" class="text-[#5B4636] hover:text-[#B86E4B] transition-colors" title="Keluar">
                    <i class="ti ti-logout text-lg" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </aside>

    <div class="flex-1 flex flex-col min-h-screen w-full md:ml-64 overflow-hidden">

        <main class="flex-1">
            <?php
                $routes = [
                    'beranda'       => 'pages/beranda.php',
                    'daftar-paket'  => 'pages/daftar-paket.php',
                    'pendaftaran'   => 'pages/pendaftaran.php',
                    'riwayat'       => 'pages/riwayat.php',
                    'pembayaran'    => 'pages/pembayaran.php',
                    'settings'        => 'pages/settings.php'
                ];

                if (isset($routes[$currentPage])) {
                    // Cek apakah filenya ada sebelum di-include agar tidak error 500
                    if (file_exists($routes[$currentPage])) {
                        include $routes[$currentPage];
                    } else {
                        echo "<div class='p-6'><p class='text-sm text-red-600 font-mono'>File [{$routes[$currentPage]}] belum dibuat.</p></div>";
                    }
                } else {
                    include 'pages/404.php';
                }
            ?>
        </main>

        <footer class="border-t border-[#BFC3B1] px-6 py-4 bg-[#E8DDD0]">
            <p class="text-xs text-[#5B4636] text-center">
                &copy; 2026 Agnimukti. Semua hak dilindungi.
            </p>
        </footer>

    </div>

    <script>
        const menuBtn = document.getElementById('menuBtn');
        const closeBtn = document.getElementById('closeBtn');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            
            if (sidebar.classList.contains('-translate-x-full')) {
                overlay.classList.add('hidden');
                overlay.classList.remove('opacity-100');
            } else {
                overlay.classList.remove('hidden');
                setTimeout(() => overlay.classList.add('opacity-100'), 10);
            }
        }

        menuBtn.addEventListener('click', toggleSidebar);
        closeBtn.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);
    </script>
</body>
</html>
<?php
    $currentPage = $_GET['page'] ?? 'dashboard';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agnimukti</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <link rel="shortcut icon" href="../assets/logo.png" type="image/x-icon">
</head>
<body class="bg-[#F7F4F0] min-h-screen flex flex-col md:flex-row">

    <header class="md:hidden flex items-center justify-between px-4 py-3 bg-[#E8DDD0] border-b border-[#BFC3B1] sticky top-0 z-50">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-[#BFC3B1] flex items-center justify-center">
                <img src="../assets/logo.png" alt="" class="w-full h-full">
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
                    <img src="../assets/logo.png" alt="" class="w-full h-full">
                </div>
                <div>
                    <p class="text-sm font-semibold text-[#2B221D] leading-tight">Agnimukti</p>
                    <p class="text-xs text-[#5B4636]">Kremasi Bali</p>
                </div>
            </div>
            <button id="closeBtn" class="md:hidden text-[#5B4636] hover:text-[#B86E4B]">
                <i class="ti ti-x text-xl"></i>
            </button>
        </div>

        <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
            <p class="text-xs text-[#5B4636] uppercase tracking-wider px-3 mb-2">Menu Utama</p>

            <a href="?page=dashboard" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm
            <?= $currentPage == 'dashboard'
                ? 'bg-[#BFC3B1] text-[#5B4636] font-medium'
                : 'text-[#5B4636] hover:bg-[#D8D2C6]'; ?>
            ">
                <i class="ti ti-layout-dashboard text-lg" aria-hidden="true"></i>
                Dashboard
            </a>

            <a href="?page=users" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-colors
            <?= $currentPage == 'users'
                ? 'bg-[#BFC3B1] text-[#5B4636] font-medium'
                : 'text-[#5B4636] hover:bg-[#D8D2C6]'; ?>
            ">
                <i class="ti ti-users text-lg" aria-hidden="true"></i>
                Pengguna
            </a>

            <a href="?page=categories" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-colors
            <?= $currentPage == 'categories'
                ? 'bg-[#BFC3B1] text-[#5B4636] font-medium'
                : 'text-[#5B4636] hover:bg-[#D8D2C6]'; ?>
            ">
                <i class="ti ti-package text-lg" aria-hidden="true"></i>
                Kategori Paket
            </a>

            <a href="?page=services" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-colors
            <?= $currentPage == 'services'
                ? 'bg-[#BFC3B1] text-[#5B4636] font-medium'
                : 'text-[#5B4636] hover:bg-[#D8D2C6]'; ?>
            ">
                <i class="ti ti-packages text-lg" aria-hidden="true"></i>
                Paket Layanan
            </a>

            <a href="?page=registration" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-colors
            <?= $currentPage == 'registration'
                ? 'bg-[#BFC3B1] text-[#5B4636] font-medium'
                : 'text-[#5B4636] hover:bg-[#D8D2C6]'; ?>
            ">
                <i class="ti ti-clipboard-list text-lg" aria-hidden="true"></i>
                Pendaftaran
            </a>

            <a href="?page=payment" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-colors
            <?= $currentPage == 'payment'
                ? 'bg-[#BFC3B1] text-[#5B4636] font-medium'
                : 'text-[#5B4636] hover:bg-[#D8D2C6]'; ?>
            ">
                <i class="ti ti-credit-card text-lg" aria-hidden="true"></i>
                Pembayaran
            </a>

            <div class="pt-4">
                <p class="text-xs text-[#5B4636] uppercase tracking-wider px-3 mb-2">Pengaturan</p>

                <a href="?page=settings" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-colors
                <?= $currentPage == 'settings'
                    ? 'bg-[#BFC3B1] text-[#5B4636] font-medium'
                    : 'text-[#5B4636] hover:bg-[#D8D2C6]'; ?>
                ">
                    <i class="ti ti-settings text-lg" aria-hidden="true"></i>
                    Pengaturan
                </a>
            </div>
        </nav>

        <div class="px-4 py-4 border-t border-[#BFC3B1]">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-[#BFC3B1] flex items-center justify-center text-[#5B4636] font-semibold text-sm">
                    A
                </div>

                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-[#2B221D] truncate">Administrator</p>
                    <p class="text-xs text-[#5B4636] truncate">Super Admin</p>
                </div>

                <a href="#" class="text-[#5B4636] hover:text-[#B86E4B] transition-colors">
                    <i class="ti ti-logout text-lg" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </aside>

    <div class="flex-1 flex flex-col min-h-screen w-full md:ml-64 overflow-hidden">

        <main class="flex-1">
            <?php
                $routes = [
                    'dashboard' => 'pages/dashboard.php',
                    'users'     => 'pages/users.php',
                    'services'  => 'pages/services.php',
                    'categories'  => 'pages/categories.php',
                    'registration'  => 'pages/registration.php',
                    'payment'  => 'pages/payment.php',
                    'settings'  => 'pages/settings.php'
                ];

                if (isset($routes[$currentPage])) {
                    include $routes[$currentPage];
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
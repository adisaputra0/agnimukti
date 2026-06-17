<?php
    $currentPage = $_GET['page'] ?? 'dashboard';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
</head>
<body>
    <!-- Sidebar -->
    <aside id="sidebar" class="w-64 min-h-screen bg-[#E8DDD0] border-r border-[#BFC3B1] flex flex-col fixed top-0 left-0 z-40 transition-transform duration-300">

        <!-- Logo -->
        <div class="px-6 py-5 border-b border-[#BFC3B1]">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-[#BFC3B1] flex items-center justify-center">
                    <!-- <i class="ti ti-flame text-[#B86E4B] text-xl" aria-hidden="true"></i> -->
                    <img src="../assets/logo.png" alt="" class="w-full h-full">
                </div>
                <div>
                    <p class="text-sm font-semibold text-[#2B221D] leading-tight">Agnimukti</p>
                    <p class="text-xs text-[#5B4636]">Kremasi Bali</p>
                </div>
            </div>
        </div>

        <!-- Nav -->
        <nav class="flex-1 px-3 py-4 space-y-1">
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

            <a href="?page=services" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-colors
            <?= $currentPage == 'services'
                ? 'bg-[#BFC3B1] text-[#5B4636] font-medium'
                : 'text-[#5B4636] hover:bg-[#D8D2C6]'; ?>
            ">
                <i class="ti ti-package text-lg" aria-hidden="true"></i>
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

        <!-- User Info -->
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

    <!-- Main Content -->
    <div class="flex-1 ml-64 flex flex-col min-h-screen">

        <!-- Content -->
        <?php
            $routes = [
                'dashboard' => 'pages/dashboard.php',
                'users'     => 'pages/users.php',
                'services'  => 'pages/services.php',
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

        <!-- Footer -->
        <footer class="border-t border-[#BFC3B1] px-6 py-4 bg-[#E8DDD0]">
            <p class="text-xs text-[#5B4636] text-center">
                &copy; 2026 Agnimukti. Semua hak dilindungi.
            </p>
        </footer>

    </div>
</body>
</html>
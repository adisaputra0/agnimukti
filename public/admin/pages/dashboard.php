<?php
// Impor semua kelas model yang dibutuhkan
require_once __DIR__ . '/../../../classes/Users.php';
require_once __DIR__ . '/../../../classes/PaketLayanan.php';
require_once __DIR__ . '/../../../classes/Pendaftaran.php';
require_once __DIR__ . '/../../../classes/Pembayaran.php';

// Inisialisasi Objek Model
$userModel = new Users();
$paketModel = new PaketLayanan();
$pendaftaranModel = new Pendaftaran();
$pembayaranModel = new Pembayaran();

// Tarik data mentah dari database
$listUser = $userModel->getAll();
$listPaket = $paketModel->getAll();
$listPendaftaran = $pendaftaranModel->getAll();
$listPembayaran = $pembayaranModel->getAll();

// ==========================================
// KONSOLIDASI & HITUNG STATISTIK (DINAMIS)
// ==========================================
$totalPendaftaran = count($listPendaftaran);
$totalPaket = count($listPaket);

// Menghitung jumlah Pemohon & Admin secara dinamis berdasarkan database
$totalPemohon = 0;
$totalAdmin = 0;

foreach ($listUser as $user) {
    if (isset($user['role']) && strtolower($user['role']) === 'admin') {
        $totalAdmin++;
    } else {
        $totalPemohon++;
    }
}
// Pencegahan jika field 'role' belum didefinisikan di DB, berikan fallback standard
if ($totalPemohon === 0 && $totalAdmin === 0) {
    $totalPemohon = count($listUser);
    $totalAdmin = 1; 
}

// Urutkan atau batasi data terbaru jika diperlukan (opsional, mengambil data teratas)
$pendaftaranTerbaru = array_slice($listPendaftaran, 0, 5); 
$pembayaranTerbaru = array_slice($listPembayaran, 0, 5);

?>

<!-- Topbar -->
<header class="bg-[#E8DDD0] border-b border-[#BFC3B1] px-6 py-4 flex items-center justify-between sticky top-0 z-30">
    <div>
        <h1 class="text-lg font-semibold text-[#2B221D]">Dashboard</h1>
        <p class="text-xs text-[#5B4636]">Selamat datang kembali</p>
    </div>
    <div class="flex items-center gap-3">
        <button class="relative text-[#5B4636] hover:text-[#2B221D] p-2 rounded-lg hover:bg-[#D8D2C6] transition-colors">
            <i class="ti ti-bell text-xl" aria-hidden="true"></i>
            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-[#B86E4B] rounded-full"></span>
        </button>
    </div>
</header>

<!-- Page Body -->
<main class="flex-1 p-6 space-y-6 bg-[#F5F1EC]/30">
    <!-- Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 <?=$authUser['data']['role'] == 'super_admin'? 'xl:grid-cols-4':''?>">

        <?php if (($authUser['data']['role'] ?? '') === 'super_admin'): ?>
            <!-- Total Admin -->
            <div class="bg-white rounded-xl border border-[#BFC3B1] p-5">
                <div class="flex items-center justify-between mb-4">
                    <p class="text-sm text-[#5B4636]">Total Admin</p>
                    <div class="w-10 h-10 rounded-lg bg-[#E8DDD0] flex items-center justify-center">
                        <i class="ti ti-shield-check text-[#B86E4B] text-xl" aria-hidden="true"></i>
                    </div>
                </div>
                <p class="text-3xl font-semibold text-[#2B221D]"><?= $totalAdmin; ?></p>
                <p class="text-xs text-[#5B4636] mt-1">Admin aktif</p>
            </div>

            <!-- Total Paket -->
            <div class="bg-white rounded-xl border border-[#BFC3B1] p-5">
                <div class="flex items-center justify-between mb-4">
                    <p class="text-sm text-[#5B4636]">Total Paket</p>
                    <div class="w-10 h-10 rounded-lg bg-[#E8DDD0] flex items-center justify-center">
                        <i class="ti ti-package text-[#5B4636] text-xl" aria-hidden="true"></i>
                    </div>
                </div>
                <p class="text-3xl font-semibold text-[#2B221D]"><?= $totalPaket; ?></p>
                <p class="text-xs text-[#5B4636] mt-1">Paket layanan tersedia</p>
            </div>
        <?php endif; ?>

        <!-- Total Pemohon -->
        <div class="bg-white rounded-xl border border-[#BFC3B1] p-5">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-[#5B4636]">Total Pemohon</p>
                <div class="w-10 h-10 rounded-lg bg-[#E8DDD0] flex items-center justify-center">
                    <i class="ti ti-users text-[#5B4636] text-xl" aria-hidden="true"></i>
                </div>
            </div>
            <p class="text-3xl font-semibold text-[#2B221D]"><?= $totalPemohon; ?></p>
            <p class="text-xs text-[#5B4636] mt-1">Pengguna terdaftar</p>
        </div>

        <!-- Total Pendaftaran -->
        <div class="bg-white rounded-xl border border-[#BFC3B1] p-5">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-[#5B4636]">Total Pendaftaran</p>
                <div class="w-10 h-10 rounded-lg bg-[#E8DDD0] flex items-center justify-center">
                    <i class="ti ti-clipboard-list text-[#B86E4B] text-xl" aria-hidden="true"></i>
                </div>
            </div>
            <p class="text-3xl font-semibold text-[#2B221D]"><?= $totalPendaftaran; ?></p>
            <p class="text-xs text-[#5B4636] mt-1">Pendaftaran masuk</p>
        </div>

    </div>

    <!-- Tables Row -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

        <!-- Tabel Pendaftaran Terbaru -->
        <div class="bg-white rounded-xl border border-[#BFC3B1]">
            <div class="px-5 py-4 border-b border-[#D8D2C6] flex items-center justify-between">
                <h2 class="text-sm font-semibold text-[#2B221D]">Pendaftaran Terbaru</h2>
                <a href="?page=registration" class="text-xs text-[#B86E4B] hover:underline">Lihat semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-[#F5F1EC] text-left text-xs text-[#5B4636] uppercase tracking-wide border-b border-[#D8D2C6]">
                            <th class="px-5 py-3 font-medium">Kode</th>
                            <th class="px-5 py-3 font-medium">Almarhum</th>
                            <th class="px-5 py-3 font-medium">Status</th>
                            <th class="px-5 py-3 font-medium">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#D8D2C6]">
                        <?php if (empty($pendaftaranTerbaru)): ?>
                        <tr>
                            <td colspan="4" class="px-5 py-6 text-center text-xs text-[#5B4636]">Belum ada berkas pendaftaran masuk.</td>
                        </tr>
                        <?php else: ?>
                        <?php foreach ($pendaftaranTerbaru as $pendaftaran): ?>
                        <tr class="hover:bg-[#F5F1EC] transition-colors">
                            <td class="px-5 py-3 font-mono text-xs font-semibold text-[#2B221D]"><?= htmlspecialchars($pendaftaran['kode_pendaftaran']); ?></td>
                            <td class="px-5 py-3 text-[#2B221D] font-medium"><?= htmlspecialchars($pendaftaran['nama_almarhum']); ?></td>
                            <td class="px-5 py-3">
                                <?php 
                                $statusClass = "bg-[#E8DDD0] text-[#B86E4B]";
                                if ($pendaftaran['status'] === 'Diproses') $statusClass = "bg-[#5B4636]/10 text-[#5B4636]";
                                if ($pendaftaran['status'] === 'Selesai') $statusClass = "bg-[#BFC3B1]/30 text-[#2B221D]";
                                ?>
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium <?= $statusClass; ?>">
                                    <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                                    <?= htmlspecialchars($pendaftaran['status']); ?>
                                </span>
                            </td>
                            <td class="px-5 py-3 text-[#5B4636] text-xs"><?= date('d M Y', strtotime($pendaftaran['tanggal_daftar'])); ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tabel Pembayaran Terbaru -->
        <div class="bg-white rounded-xl border border-[#BFC3B1]">
            <div class="px-5 py-4 border-b border-[#D8D2C6] flex items-center justify-between">
                <h2 class="text-sm font-semibold text-[#2B221D]">Status Pembayaran</h2>
                <a href="?page=payment" class="text-xs text-[#B86E4B] hover:underline">Lihat semua</a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-[#F5F1EC] text-left text-xs text-[#5B4636] uppercase tracking-wide border-b border-[#D8D2C6]">
                            <th class="px-5 py-3 font-medium">Kode Pendaftaran</th>
                            <th class="px-5 py-3 font-medium">Total</th>
                            <th class="px-5 py-3 font-medium">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#D8D2C6]">
                        <?php if (empty($pembayaranTerbaru)): ?>
                        <tr>
                            <td colspan="4" class="px-5 py-6 text-center text-xs text-[#5B4636]">Belum ada riwayat transaksi pembayaran.</td>
                        </tr>
                        <?php else: ?>
                        <?php foreach ($pembayaranTerbaru as $pembayaran): ?>
                        <tr class="hover:bg-[#F5F1EC] transition-colors">
                            <td class="px-5 py-3 font-mono text-xs font-semibold text-[#5B4636]">
                                <?php 
                                // Relasi pencarian kode pendaftaran agar valid di view
                                $kodePendaftaran = 'KRM-ERR';
                                foreach($listPendaftaran as $p) {
                                    if($p['id_pendaftaran'] == $pembayaran['id_pendaftaran']) {
                                        $kodePendaftaran = $p['kode_pendaftaran'];
                                        break;
                                    }
                                }
                                echo htmlspecialchars($kodePendaftaran);
                                ?>
                            </td>
                            <td class="px-5 py-3 text-[#2B221D] font-semibold">Rp <?= number_format($pembayaran['total_bayar'], 0, ',', '.'); ?></td>
                            <td class="px-5 py-3">
                                <?php 
                                $payStatusClass = "bg-[#E8DDD0] text-[#B86E4B]";
                                if ($pembayaran['status_pembayaran'] === 'Lunas') $payStatusClass = "bg-[#BFC3B1]/40 text-[#2B221D]";
                                if ($pembayaran['status_pembayaran'] === 'Gagal') $payStatusClass = "bg-red-50 text-red-600";
                                ?>
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium <?= $payStatusClass; ?>">
                                    <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                                    <?= htmlspecialchars($pembayaran['status_pembayaran']); ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <?php if (($authUser['data']['role'] ?? '') === 'super_admin'): ?>
        <!-- Paket Layanan Dinamis -->
        <div class="bg-white rounded-xl border border-[#BFC3B1]">
            <div class="px-5 py-4 border-b border-[#D8D2C6] flex items-center justify-between">
                <h2 class="text-sm font-semibold text-[#2B221D]">Paket Layanan</h2>
                <a href="?page=services" class="text-xs text-[#B86E4B] hover:underline">Kelola paket</a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 p-5">
                <?php if(empty($listPaket)): ?>
                    <p class="text-xs text-[#5B4636] col-span-full text-center py-4">Belum ada paket layanan terdaftar di database.</p>
                <?php else: ?>
                    <?php foreach($listPaket as $paket): ?>
                    <div class="bg-white border border-[#BFC3B1] rounded-lg p-4 hover:border-[#B86E4B] transition-all hover:shadow-sm">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <!-- Badge dinamis berdasarkan harga atau deskripsi (contoh: jika di atas 5jt Premium) -->
                                <span class="text-xs font-medium bg-[#E8DDD0] text-[#5B4636] px-2 py-0.5 rounded-full">
                                    <?= ($paket['harga'] >= 5000000) ? 'Premium' : 'Standar'; ?>
                                </span>
                                <p class="text-sm font-semibold text-[#2B221D] mt-2"><?= htmlspecialchars($paket['nama_paket']); ?></p>
                            </div>
                            <i class="<?= ($paket['harga'] >= 7000000) ? 'ti ti-crown' : 'ti ti-flame'; ?> text-[#B86E4B] text-xl" aria-hidden="true"></i>
                        </div>
                        <!-- Deskripsi paket dinamis -->
                        <p class="text-xs text-[#5B4636] mb-3 line-clamp-2 h-8"><?= htmlspecialchars($paket['deskripsi'] ?? 'Fasilitas kremasi lengkap dan terpercaya.'); ?></p>
                        <p class="text-base font-bold text-[#B86E4B]">Rp <?= number_format($paket['harga'], 0, ',', '.'); ?></p>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</main>
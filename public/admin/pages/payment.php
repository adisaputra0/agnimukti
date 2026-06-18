<?php
require_once __DIR__ . '/../../../classes/Pembayaran.php'; 
require_once __DIR__ . '/../../../classes/Pendaftaran.php'; 

$pembayaranModel = new Pembayaran();
$pendaftaranModel = new Pendaftaran();

// Handle POST actions (CRUD)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'tambah') {
        $pembayaranModel->create(
            $_POST['id_pendaftaran'],
            $_POST['tanggal_bayar'],
            $_POST['total_bayar'],
            $_POST['metode_pembayaran'],
            $_POST['status_pembayaran']
        );
    } elseif ($action === 'edit') {
        $pembayaranModel->update(
            $_POST['id_pembayaran'],
            $_POST['id_pendaftaran'],
            $_POST['tanggal_bayar'],
            $_POST['total_bayar'],
            $_POST['metode_pembayaran'],
            $_POST['status_pembayaran']
        );
    } elseif ($action === 'hapus') {
        $pembayaranModel->delete($_POST['id_pembayaran']);
    }

    echo "<script>
    window.location='?page=payment';
    </script>";
    exit;
}

// Fetch data utama dan data relasi pendaftaran
$allData = $pembayaranModel->getAll();
$listPendaftaran = $pendaftaranModel->getAll();

// Search filter (ID Pembayaran, Kode Pendaftaran, atau Nama Almarhum)
$search = $_GET['search'] ?? '';
$filtered = $allData;
if ($search !== '') {
    $filtered = array_values(array_filter($allData, fn($p) =>
        stripos((string)$p['id_pembayaran'], $search) !== false ||
        stripos($p['kode_pendaftaran'] ?? '', $search) !== false ||
        stripos($p['nama_almarhum'] ?? '', $search) !== false
    ));
}

// Pagination
$perPage       = 10;
$totalAll      = count($allData);
$totalFiltered = count($filtered);
$totalPages    = max(1, ceil($totalFiltered / $perPage));
$currentPage   = max(1, min((int)($_GET['page'] ?? 1), $totalPages));
$offset        = ($currentPage - 1) * $perPage;
$pageData      = array_slice($filtered, $offset, $perPage);

// Hitung Statistik Otomatis Berdasarkan Data Nyata
$totalPendapatanLunas = 0;
$perluVerifikasiDana  = 0;
$belumBayarDana       = 0;
$transaksiTertundaCount = 0;

foreach ($allData as $p) {
    if ($p['status_pembayaran'] === 'Lunas') {
        $totalPendapatanLunas += (int)$p['total_bayar'];
    } elseif ($p['status_pembayaran'] === 'Belum Bayar') {
        $belumBayarDana += (int)$p['total_bayar'];
    }
}
?>

<header class="bg-[#E8DDD0] border-b border-[#BFC3B1] px-6 py-4 flex items-center justify-between sticky top-0 z-30">
    <div>
        <h1 class="text-lg font-semibold text-[#2B221D]">Dashboard Pembayaran</h1>
        <p class="text-xs text-[#5B4636]">Pantau arus kas, verifikasi transaksi masuk, dan kelola status tagihan</p>
    </div>
    <div class="flex items-center gap-3">
        <button class="relative text-[#5B4636] hover:text-[#2B221D] p-2 rounded-lg hover:bg-[#D8D2C6] transition-colors">
            <i class="ti ti-bell text-xl" aria-hidden="true"></i>
            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-[#B86E4B] rounded-full"></span>
        </button>
    </div>
</header>

<main class="flex-1 p-6 space-y-6 bg-[#F5F1EC]/30">

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        
        <div class="bg-white rounded-xl border border-[#BFC3B1] p-5">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-[#5B4636]">Pendapatan (Lunas)</p>
                <div class="w-10 h-10 rounded-lg bg-[#BFC3B1]/20 flex items-center justify-center border border-[#BFC3B1]">
                    <i class="ti ti-wallet text-[#5B4636] text-xl"></i>
                </div>
            </div>
            <p class="text-2xl font-bold text-[#2B221D]">Rp <?= number_format($totalPendapatanLunas, 0, ',', '.') ?></p>
            <p class="text-xs text-[#5B4636] mt-1">Dana bersih masuk</p>
        </div>

        <!-- <div class="bg-white rounded-xl border border-[#BFC3B1] p-5">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-[#5B4636]">Perlu Verifikasi</p>
                <div class="w-10 h-10 rounded-lg bg-[#B86E4B]/10 flex items-center justify-center border border-[#B86E4B]/30">
                    <i class="ti ti-receipt-refund text-[#B86E4B] text-xl"></i>
                </div>
            </div>
            <p class="text-2xl font-bold text-[#2B221D]">Rp <?= number_format($perluVerifikasiDana, 0, ',', '.') ?></p>
            <p class="text-xs text-[#B86E4B] mt-1"><?= $transaksiTertundaCount ?> Transaksi tertunda</p>
        </div> -->

        <div class="bg-white rounded-xl border border-[#BFC3B1] p-5">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-[#5B4636]">Belum Bayar</p>
                <div class="w-10 h-10 rounded-lg bg-[#2B221D]/5 flex items-center justify-center border border-[#2B221D]/20">
                    <i class="ti ti-clock-cancel text-[#2B221D]/70 text-xl"></i>
                </div>
            </div>
            <p class="text-2xl font-bold text-[#2B221D]">Rp <?= number_format($belumBayarDana, 0, ',', '.') ?></p>
            <p class="text-xs text-[#5B4636]/80 mt-1">Semua invoice terbit</p>
        </div>

        <div class="bg-white rounded-xl border border-[#BFC3B1] p-5">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-[#5B4636]">Total Transaksi</p>
                <div class="w-10 h-10 rounded-lg bg-[#E8DDD0] flex items-center justify-center">
                    <i class="ti ti-receipt text-[#5B4636] text-xl"></i>
                </div>
            </div>
            <p class="text-2xl font-bold text-[#2B221D]"><?= $totalAll ?></p>
            <p class="text-xs text-[#5B4636] mt-1">Invoice tercatat</p>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-[#BFC3B1]">

        <div class="px-5 py-4 border-b border-[#D8D2C6] flex flex-col sm:flex-row sm:items-center gap-3 justify-between">
            <h2 class="text-sm font-semibold text-[#2B221D]">Daftar Invoice & Pembayaran</h2>
            <div class="flex items-center gap-2">
                <form method="GET" class="flex items-center gap-2">
                    <div class="relative">
                        <i class="ti ti-search absolute left-3 top-1/2 -translate-y-1/2 text-[#5B4636] text-sm" aria-hidden="true"></i>
                        <input
                            type="text"
                            name="search"
                            value="<?= htmlspecialchars($search) ?>"
                            placeholder="Cari ID / Kode Pendaftaran..."
                            class="pl-8 pr-4 py-1.5 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] placeholder-[#5B4636]/60 focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B] w-60"
                        >
                    </div>
                    <button type="submit" class="hidden"></button>
                </form>
                <button onclick="document.getElementById('modalTambah').classList.remove('hidden')" class="flex items-center gap-1.5 px-3 py-1.5 bg-[#B86E4B] hover:bg-[#B86E4B]/90 text-white text-sm rounded-lg transition-colors shadow-sm">
                    <i class="ti ti-plus text-base" aria-hidden="true"></i>
                    Tambah Data
                </button>
                <button class="flex items-center gap-1.5 px-3 py-1.5 border border-[#BFC3B1] text-[#5B4636] hover:bg-[#F5F1EC] hover:text-[#2B221D] text-sm rounded-lg transition-colors">
                    <i class="ti ti-printer text-base" aria-hidden="true"></i>
                    Cetak Laporan
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-[#F5F1EC] text-left text-xs text-[#5B4636] uppercase tracking-wide border-b border-[#D8D2C6]">
                        <th class="px-5 py-3 font-medium">No</th>
                        <th class="px-5 py-3 font-medium">ID Transaksi</th>
                        <th class="px-5 py-3 font-medium">Registrasi / Pemohon</th>
                        <th class="px-5 py-3 font-medium">Metode</th>
                        <th class="px-5 py-3 font-medium">Tanggal Bayar</th>
                        <th class="px-5 py-3 font-medium">Total Tagihan</th>
                        <th class="px-5 py-3 font-medium">Status</th>
                        <th class="px-5 py-3 font-medium text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#D8D2C6]">

                    <?php foreach ($pageData as $i => $pembayaran): ?>
                    <tr class="hover:bg-[#F5F1EC] transition-colors">
                        <td class="px-5 py-4 text-[#5B4636] text-xs"><?= $offset + $i + 1 ?></td>
                        <td class="px-5 py-4">
                            <span class="font-mono text-xs font-semibold text-[#2B221D]">#INV-<?= str_pad($pembayaran['id_pembayaran'], 3, '0', STR_PAD_LEFT) ?></span>
                        </td>
                        <td class="px-5 py-4">
                            <div>
                                <p class="font-medium text-[#2B221D]"><?= htmlspecialchars($pembayaran['kode_pendaftaran'] ?? '-') ?></p>
                                <p class="text-xs text-[#5B4636]"><?= htmlspecialchars($pembayaran['nama_almarhum'] ?? 'Tidak Diketahui') ?></p>
                            </div>
                        </td>
                        <td class="px-5 py-4">
                            <?php if (stripos($pembayaran['metode_pembayaran'], 'Transfer') !== false): ?>
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-xs font-medium bg-[#E8DDD0] text-[#2B221D]">
                                    <i class="ti ti-building-bank text-xs"></i> <?= htmlspecialchars($pembayaran['metode_pembayaran']) ?>
                                </span>
                            <?php else: ?>
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-xs font-medium bg-[#BFC3B1]/40 text-[#2B221D]">
                                    <i class="ti ti-qrcode text-xs"></i> <?= htmlspecialchars($pembayaran['metode_pembayaran']) ?>
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="px-5 py-4 text-[#5B4636] text-xs">
                            <?= $pembayaran['tanggal_bayar'] ? date('d M Y', strtotime($pembayaran['tanggal_bayar'])) : '-' ?>
                        </td>
                        <td class="px-5 py-4 font-semibold <?= $pembayaran['status_pembayaran'] === 'Lunas' ? 'text-[#B86E4B]' : 'text-[#2B221D]' ?>">
                            Rp <?= number_format($pembayaran['total_bayar'], 0, ',', '.') ?>
                        </td>
                        <td class="px-5 py-4">
                            <?php if ($pembayaran['status_pembayaran'] === 'Lunas'): ?>
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-[#BFC3B1]/30 text-[#5B4636] border border-[#BFC3B1]">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#5B4636]"></span>
                                    Lunas
                                </span>
                            <?php else: ?>
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-[#2B221D]/5 text-[#2B221D]/70 border border-[#2B221D]/20">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#2B221D]/50"></span>
                                    Belum Bayar
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex items-center justify-center gap-1.5">
                                <button onclick='openModalVerifikasi(<?= json_encode($pembayaran) ?>)' 
                                    class="px-2.5 py-1 bg-[#B86E4B] hover:bg-[#2B221D] text-white rounded text-xs font-medium transition-colors shadow-sm">
                                    Verifikasi
                                </button>
                                <form method="POST" onsubmit="return confirm('Hapus data pembayaran ini?')" style="display:inline">
                                    <input type="hidden" name="action" value="hapus">
                                    <input type="hidden" name="id_pembayaran" value="<?= $pembayaran['id_pembayaran'] ?>">
                                    <button type="submit" class="p-1.5 rounded-lg text-[#B86E4B] hover:bg-[#B86E4B]/10 transition-colors" title="Hapus">
                                        <i class="ti ti-trash text-base"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                    <?php if (empty($pageData)): ?>
                    <tr>
                        <td colspan="8" class="px-5 py-8 text-center text-sm text-[#5B4636]">Tidak ada data pembayaran ditemukan.</td>
                    </tr>
                    <?php endif; ?>

                </tbody>
            </table>
        </div>

        <div class="px-5 py-4 border-t border-[#D8D2C6] flex items-center justify-between">
            <p class="text-xs text-[#5B4636]">Menampilkan <?= count($pageData) ?> dari <?= $totalFiltered ?> data pembayaran</p>
            <div class="flex items-center gap-1">
                <a href="?<?= http_build_query(array_merge($_GET, ['page' => max(1, $currentPage - 1)])) ?>"
                    class="px-3 py-1.5 text-xs text-[#5B4636] border border-[#BFC3B1] rounded-lg hover:bg-[#F5F1EC] <?= $currentPage <= 1 ? 'opacity-40 pointer-events-none' : '' ?>">
                    <i class="ti ti-chevron-left" aria-hidden="true"></i>
                </a>
                
                <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                <a href="?<?= http_build_query(array_merge($_GET, ['page' => $p])) ?>"
                    class="px-3 py-1.5 text-xs rounded-lg <?= $p === $currentPage ? 'bg-[#B86E4B] text-white' : 'text-[#5B4636] border border-[#BFC3B1] hover:bg-[#F5F1EC]' ?>">
                    <?= $p ?>
                </a>
                <?php endfor; ?>

                <a href="?<?= http_build_query(array_merge($_GET, ['page' => min($totalPages, $currentPage + 1)])) ?>"
                    class="px-3 py-1.5 text-xs text-[#5B4636] border border-[#BFC3B1] rounded-lg hover:bg-[#F5F1EC] <?= $currentPage >= $totalPages ? 'opacity-40 pointer-events-none' : '' ?>">
                    <i class="ti ti-chevron-right" aria-hidden="true"></i>
                </a>
            </div>
        </div>

    </div>
</main>

<div id="modalTambah" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-[#2B221D]/40 backdrop-blur-sm">
    <div class="bg-white rounded-xl border border-[#BFC3B1] w-full max-w-md mx-4 shadow-xl">
        <div class="px-6 py-4 border-b border-[#D8D2C6] flex items-center justify-between bg-[#F5F1EC] rounded-t-xl">
            <h3 class="text-sm font-semibold text-[#2B221D]">Tambah Data Pembayaran</h3>
            <button onclick="document.getElementById('modalTambah').classList.add('hidden')" class="text-[#5B4636] hover:text-[#2B221D]">
                <i class="ti ti-x text-lg"></i>
            </button>
        </div>
        <form method="POST">
            <input type="hidden" name="action" value="tambah">
            <div class="px-6 py-5 space-y-4">
                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Berkas Pendaftaran</label>
                    <select name="id_pendaftaran" required class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-white text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B]">
                        <option value="" disabled selected>-- Pilih Berkas Pendaftaran --</option>
                        <?php foreach ($listPendaftaran as $pendaftaran): ?>
                            <option value="<?= $pendaftaran['id_pendaftaran'] ?>">
                                <?= htmlspecialchars($pendaftaran['kode_pendaftaran']) ?> - <?= htmlspecialchars($pendaftaran['nama_almarhum']) ?> (Rp <?= number_format($pendaftaran['harga'], 0, ',', '.') ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Tanggal Bayar</label>
                    <input type="date" name="tanggal_bayar" required class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-white text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B]">
                </div>
                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Total Bayar</label>
                    <input type="number" name="total_bayar" required class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-white text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B]">
                </div>
                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Metode Pembayaran</label>
                    <select name="metode_pembayaran" class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B]">
                        <option value="Transfer">Transfer</option>
                        <option value="QRIS">QRIS</option>
                        <option value="Tunai">Tunai</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Status</label>
                    <select name="status_pembayaran" class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B]">
                        <option value="Lunas">Lunas</option>
                        <option value="Belum Bayar">Belum Bayar</option>
                    </select>
                </div>
            </div>
            <div class="px-6 py-4 border-t border-[#D8D2C6] flex justify-end gap-2 bg-[#F5F1EC] rounded-b-xl">
                <button type="button" onclick="document.getElementById('modalTambah').classList.add('hidden')" class="px-4 py-2 text-sm text-[#5B4636] border border-[#BFC3B1] rounded-lg hover:bg-[#D8D2C6] transition-colors">Batal</button>
                <button type="submit" class="px-4 py-2 text-sm bg-[#B86E4B] hover:bg-[#2B221D] text-white rounded-lg transition-colors shadow-sm font-medium">Simpan Data</button>
            </div>
        </form>
    </div>
</div>

<div id="modalVerifikasi" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-[#2B221D]/40 backdrop-blur-sm">
    <div class="bg-white rounded-xl border border-[#BFC3B1] w-full max-w-md mx-4 shadow-xl">
        <div class="px-6 py-4 border-b border-[#D8D2C6] flex items-center justify-between bg-[#F5F1EC] rounded-t-xl">
            <h3 class="text-sm font-semibold text-[#2B221D]">Validasi & Edit Pembayaran</h3>
            <button onclick="document.getElementById('modalVerifikasi').classList.add('hidden')" class="text-[#5B4636] hover:text-[#2B221D]">
                <i class="ti ti-x text-lg"></i>
            </button>
        </div>

        <form method="POST">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="id_pembayaran" id="md-id-pembayaran">
            <input type="hidden" name="id_pendaftaran" id="md-id-pendaftaran">
            <input type="hidden" name="tanggal_bayar" id="md-tanggal-bayar">
            <input type="hidden" name="total_bayar" id="md-total-bayar">
            <input type="hidden" name="metode_pembayaran" id="md-metode-bayar">

            <div class="px-6 py-5 space-y-4">
                
                <div class="bg-[#F5F1EC] p-4 rounded-lg border border-[#D8D2C6] space-y-2.5">
                    <div class="flex justify-between text-xs">
                        <span class="text-[#5B4636]">Kode Pendaftaran:</span>
                        <span id="md-txt-kode" class="font-mono font-bold text-[#2B221D]">-</span>
                    </div>
                    <div class="flex justify-between text-xs">
                        <span class="text-[#5B4636]">Nama Pemohon:</span>
                        <span id="md-txt-nama" class="font-medium text-[#2B221D]">-</span>
                    </div>
                    <div class="flex justify-between text-xs">
                        <span class="text-[#5B4636]">Metode Bayar:</span>
                        <span id="md-txt-metode" class="font-medium text-[#2B221D]">-</span>
                    </div>
                    <div class="border-t border-[#D8D2C6] pt-2 flex justify-between text-sm">
                        <span class="font-medium text-[#2B221D]">Total Dibayar:</span>
                        <span id="md-txt-total" class="font-bold text-[#B86E4B]">-</span>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Aksi Tindakan Admin</label>
                    <select name="status_pembayaran" id="md-status-pembayaran" class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B]">
                        <option value="Lunas">Verifikasi & Sahkan Berkas (Lunas)</option>
                        <option value="Belum Bayar">Belum Bayar</option>
                    </select>
                </div>

                <div class="p-3 bg-[#B86E4B]/10 rounded-lg border border-[#B86E4B]/20 flex gap-2">
                    <i class="ti ti-info-circle text-[#B86E4B] text-lg shrink-0"></i>
                    <p class="text-[11px] text-[#5B4636] leading-relaxed">
                        Pastikan mutasi dana bernilai sama telah masuk ke rekening / e-wallet sistem Agnini Mukti sebelum mengubah status menjadi <strong class="text-[#2B221D]">Lunas</strong>.
                    </p>
                </div>
            </div>

            <div class="px-6 py-4 border-t border-[#D8D2C6] flex justify-end gap-2 bg-[#F5F1EC] rounded-b-xl">
                <button type="button" onclick="document.getElementById('modalVerifikasi').classList.add('hidden')"
                    class="px-4 py-2 text-sm text-[#5B4636] border border-[#BFC3B1] rounded-lg hover:bg-[#D8D2C6] transition-colors">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 text-sm bg-[#B86E4B] hover:bg-[#2B221D] text-white rounded-lg transition-colors shadow-sm font-medium">
                    Konfirmasi Valid
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModalVerifikasi(data) {
        // Set values ke field input form hidden untuk di POST kembali
        document.getElementById('md-id-pembayaran').value = data.id_pembayaran;
        document.getElementById('md-id-pendaftaran').value = data.id_pendaftaran;
        document.getElementById('md-tanggal-bayar').value = data.tanggal_bayar;
        document.getElementById('md-total-bayar').value = data.total_bayar;
        document.getElementById('md-metode-bayar').value = data.metode_pembayaran;
        document.getElementById('md-status-pembayaran').value = data.status_pembayaran;

        // Set visual teks di dalam modal box detail rincian data
        document.getElementById('md-txt-kode').innerText = data.kode_pendaftaran ?? 'N/A';
        document.getElementById('md-txt-nama').innerText = data.nama_almarhum ?? 'Tidak Diketahui';
        document.getElementById('md-txt-metode').innerText = data.metode_pembayaran;
        
        // Format Rupiah untuk visual teks modal rincian dana
        const formattedTotal = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(data.total_bayar);
        document.getElementById('md-txt-total').innerText = formattedTotal;

        // Buka modal
        document.getElementById('modalVerifikasi').classList.remove('hidden');
    }
</script>
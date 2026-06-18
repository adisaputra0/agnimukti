<?php
require_once __DIR__ . '/../../../classes/Users.php';
require_once __DIR__ . '/../../../classes/PaketLayanan.php';
require_once __DIR__ . '/../../../classes/Pendaftaran.php';
require_once __DIR__ . '/../../../classes/Pembayaran.php';

// Buat instance dari masing-masing model
$pendaftaranModel = new Pendaftaran();
$userModel = new Users();
$paketModel = new PaketLayanan();
$pembayaranModel = new Pembayaran();

// Ambil data pendukung awal untuk kebutuhan pencarian nominal paket
$listPaket = $paketModel->getAll();
$listUser = $userModel->getAll();

// ==========================================
// HANDLING CRUD OPERATIONS
// ==========================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Tambah Pendaftaran (Create) + Otomatis Tambah Pembayaran
    if (isset($_POST['action']) && $_POST['action'] === 'create') {
        $kode_pendaftaran = $pendaftaranModel->generateKode(); // Generate otomatis agar konsisten
        $id_user = $_POST['id_user'];
        $id_paket = $_POST['id_paket'];
        $nama_almarhum = $_POST['nama_almarhum'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $tanggal_meninggal = $_POST['tanggal_meninggal'];
        $tanggal_daftar = $_POST['tanggal_daftar'];
        $catatan = $_POST['catatan'];

        // Eksekusi Simpan Pendaftaran
        $pendaftaranModel->create(
            $kode_pendaftaran,
            $id_user,
            $id_paket,
            $nama_almarhum,
            $tanggal_lahir,
            $tanggal_meninggal,
            $tanggal_daftar,
            $catatan
        );

        // Cari nominal harga paket berdasarkan id_paket yang dipilih user
        $total_bayar = 0;
        foreach ($listPaket as $paket) {
            if ($paket['id_paket'] == $id_paket) {
                $total_bayar = $paket['harga'];
                break;
            }
        }

        // Ambil kembali riwayat pendaftaran terbaru untuk mendapatkan id_pendaftaran yang barusan dibuat
        $riwayatTerbaru = $pendaftaranModel->getAll();
        $id_pendaftaran_baru = null;
        foreach ($riwayatTerbaru as $row) {
            if ($row['kode_pendaftaran'] === $kode_pendaftaran) {
                $id_pendaftaran_baru = $row['id_pendaftaran'];
                break;
            }
        }

        // Jika id_pendaftaran ditemukan, langsung buat data pembayaran default
        if ($id_pendaftaran_baru) {
            $tanggal_bayar = date('Y-m-d H:i:s');
            $metode_pembayaran = 'Tunai'; // Default value
            $status_pembayaran = 'Belum Bayar'; // Default value

            $pembayaranModel->create(
                $id_pendaftaran_baru,
                $tanggal_bayar,
                $total_bayar,
                $metode_pembayaran,
                $status_pembayaran
            );
        }

        echo "<script>
        window.location='?page=registration';
        </script>";
        exit;
    }

    // 2. Ubah / Validasi Status Pendaftaran (Update)
    if (isset($_POST['action']) && $_POST['action'] === 'update') {
        $id_pendaftaran = $_POST['id_pendaftaran'];
        $status = $_POST['status'];
        $id_paket = $_POST['id_paket'];
        $catatan = $_POST['catatan'];

        // Mengambil data lama terlebih dahulu agar data spesifik jenazah tidak hilang/berubah saat update status
        $dataLama = $pendaftaranModel->getById($id_pendaftaran);
        if ($dataLama) {
            $pendaftaranModel->update(
                $id_pendaftaran,
                $dataLama['id_user'],
                $id_paket, // Menggunakan input paket baru jika diubah admin
                $dataLama['nama_almarhum'],
                $dataLama['tanggal_lahir'],
                $dataLama['tanggal_meninggal'],
                $dataLama['tanggal_daftar'],
                $status, // Status baru
                $catatan // Catatan baru
            );
        }
        echo "<script>
        window.location='?page=registration';
        </script>";
        exit;
    }

    // 3. Hapus Pendaftaran (Delete)
    if (isset($_POST['action']) && $_POST['action'] === 'delete') {
        $id_pendaftaran = $_POST['id_pendaftaran'];
        $pendaftaranModel->delete($id_pendaftaran);
        echo "<script>
        window.location='?page=registration';
        </script>";
        exit;
    }
}

// Ambil semua data riwayat pendaftaran untuk ditampilkan di tabel view
$riwayatPendaftaran = $pendaftaranModel->getAll();

// Menghitung status statistik secara dinamis dari database
$totalDaftar = count($riwayatPendaftaran);
$menunggu = 0;
$diproses = 0;
$selesai = 0;

foreach ($riwayatPendaftaran as $row) {
    if ($row['status'] == 'Menunggu') $menunggu++;
    elseif ($row['status'] == 'Diproses') $diproses++;
    elseif ($row['status'] == 'Selesai') $selesai++;
}

// Generate kode registrasi otomatis untuk form pendaftaran baru
$kodeOtomatis = $pendaftaranModel->generateKode();
?>

<header class="bg-[#E8DDD0] border-b border-[#BFC3B1] px-6 py-4 flex items-center justify-between sticky top-0 z-30">
    <div>
        <h1 class="text-lg font-semibold text-[#2B221D]">Pendaftaran Kremasi</h1>
        <p class="text-xs text-[#5B4636]">Kelola dan pantau seluruh berkas pendaftaran pelayanan</p>
    </div>
    <div class="flex items-center gap-3">
        <button class="relative text-[#5B4636] hover:text-[#2B221D] p-2 rounded-lg hover:bg-[#D8D2C6] transition-colors">
            <i class="ti ti-bell text-xl" aria-hidden="true"></i>
            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-[#B86E4B] rounded-full"></span>
        </button>
    </div>
</header>

<main class="flex-1 p-6 space-y-6 bg-[#F5F1EC]/30">

    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl border border-[#BFC3B1] p-5">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-[#5B4636]">Total Daftar</p>
                <div class="w-10 h-10 rounded-lg bg-[#E8DDD0] flex items-center justify-center">
                    <i class="ti ti-file-text text-[#5B4636] text-xl"></i>
                </div>
            </div>
            <p class="text-3xl font-semibold text-[#2B221D]"><?= $totalDaftar; ?></p>
            <p class="text-xs text-[#5B4636] mt-1">Keseluruhan permohonan</p>
        </div>

        <div class="bg-white rounded-xl border border-[#BFC3B1] p-5">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-[#5B4636]">Menunggu</p>
                <div class="w-10 h-10 rounded-lg bg-[#B86E4B]/10 flex items-center justify-center border border-[#B86E4B]/30">
                    <i class="ti ti-clock text-[#B86E4B] text-xl"></i>
                </div>
            </div>
            <p class="text-3xl font-semibold text-[#2B221D]"><?= $menunggu; ?></p>
            <p class="text-xs text-[#B86E4B] mt-1">Perlu konfirmasi jadwal</p>
        </div>

        <div class="bg-white rounded-xl border border-[#BFC3B1] p-5">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-[#5B4636]">Diproses</p>
                <div class="w-10 h-10 rounded-lg bg-[#5B4636]/10 flex items-center justify-center border border-[#5B4636]/30">
                    <i class="ti ti-refresh text-[#5B4636] text-xl"></i>
                </div>
            </div>
            <p class="text-3xl font-semibold text-[#2B221D]"><?= $diproses; ?></p>
            <p class="text-xs text-[#5B4636] mt-1">Sedang dalam pelaksanaan</p>
        </div>

        <div class="bg-white rounded-xl border border-[#BFC3B1] p-5">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-[#5B4636]">Selesai</p>
                <div class="w-10 h-10 rounded-lg bg-[#BFC3B1]/20 flex items-center justify-center border border-[#BFC3B1]">
                    <i class="ti ti-circle-check text-[#5B4636] text-xl"></i>
                </div>
            </div>
            <p class="text-3xl font-semibold text-[#2B221D]"><?= $selesai; ?></p>
            <p class="text-xs text-[#5B4636]/80 mt-1">Upacara telah selesai</p>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-[#BFC3B1]">

        <div class="px-5 py-4 border-b border-[#D8D2C6] flex flex-col sm:flex-row sm:items-center gap-3 justify-between">
            <h2 class="text-sm font-semibold text-[#2B221D]">Riwayat Permohonan Pendaftaran</h2>
            <div class="flex items-center gap-2">
                <div class="relative">
                    <i class="ti ti-search absolute left-3 top-1/2 -translate-y-1/2 text-[#5B4636] text-sm" aria-hidden="true"></i>
                    <input
                        type="text"
                        placeholder="Cari kode / almarhum..."
                        class="pl-8 pr-4 py-1.5 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] placeholder-[#5B4636]/60 focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B] w-56"
                    >
                </div>
                <button onclick="document.getElementById('modalTambahPendaftaran').classList.remove('hidden')"
                    class="flex items-center gap-1.5 px-3 py-1.5 bg-[#B86E4B] hover:bg-[#2B221D] text-white text-sm rounded-lg transition-colors shadow-sm font-medium">
                    <i class="ti ti-plus text-base" aria-hidden="true"></i>
                    Daftar Baru
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-[#F5F1EC] text-left text-xs text-[#5B4636] uppercase tracking-wide border-b border-[#D8D2C6]">
                        <th class="px-5 py-3 font-medium">No</th>
                        <th class="px-5 py-3 font-medium">Dokumen</th>
                        <th class="px-5 py-3 font-medium">Pemohon</th>
                        <th class="px-5 py-3 font-medium">Almarhum / Almarhumah</th>
                        <th class="px-5 py-3 font-medium">Paket Layanan</th>
                        <th class="px-5 py-3 font-medium">Status</th>
                        <th class="px-5 py-3 font-medium text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#D8D2C6]">

                    <?php if (empty($riwayatPendaftaran)): ?>
                    <tr>
                        <td colspan="7" class="px-5 py-8 text-center text-sm text-[#5B4636]">Belum ada data pendaftaran.</td>
                    </tr>
                    <?php else: ?>
                    <?php $no = 1; foreach ($riwayatPendaftaran as $index => $pendaftaran): ?>
                    <tr class="hover:bg-[#F5F1EC] transition-colors">
                        <td class="px-5 py-3.5 text-[#5B4636] text-xs"><?= $no++; ?></td>
                        <td class="px-5 py-4">
                            <div>
                                <span class="font-mono text-xs font-semibold px-2 py-0.5 rounded bg-[#E8DDD0] text-[#2B221D]"><?= htmlspecialchars($pendaftaran['kode_pendaftaran']); ?></span>
                                <p class="text-[11px] text-[#5B4636] mt-1">Daftar: <?= date('d M Y', strtotime($pendaftaran['tanggal_daftar'])); ?></p>
                            </div>
                        </td>
                        <td class="px-5 py-4">
                            <div>
                                <p class="font-medium text-[#2B221D]"><?= htmlspecialchars($pendaftaran['nama_pemohon']); ?></p>
                                <p class="text-xs text-[#5B4636]"><?= isset($pendaftaran['no_telepon']) ? htmlspecialchars($pendaftaran['no_telepon']) : '-'; ?></p>
                            </div>
                        </td>
                        <td class="px-5 py-4">
                            <div>
                                <p class="font-medium text-[#2B221D]"><?= htmlspecialchars($pendaftaran['nama_almarhum']); ?></p>
                                <p class="text-xs text-[#5B4636]">Wafat: <?= $pendaftaran['tanggal_meninggal'] ? date('d M Y', strtotime($pendaftaran['tanggal_meninggal'])) : '-'; ?></p>
                            </div>
                        </td>
                        <td class="px-5 py-4 text-[#2B221D]">
                            <p class="font-medium"><?= htmlspecialchars($pendaftaran['nama_paket']); ?></p>
                            <p class="text-xs text-[#B86E4B] font-semibold">Rp <?= number_format($pendaftaran['harga'], 0, ',', '.'); ?></p>
                        </td>
                        <td class="px-5 py-4">
                            <?php 
                            $statusClass = "bg-[#B86E4B]/10 text-[#B86E4B] border-[#B86E4B]/20";
                            $dotClass = "bg-[#B86E4B]";
                            
                            if ($pendaftaran['status'] == 'Diproses') {
                                $statusClass = "bg-[#5B4636]/10 text-[#5B4636] border-[#5B4636]/20";
                                $dotClass = "bg-[#5B4636]";
                            } elseif ($pendaftaran['status'] == 'Selesai') {
                                $statusClass = "bg-[#BFC3B1]/20 text-[#5B4636] border-[#BFC3B1]";
                                $dotClass = "bg-[#5B4636]";
                            } elseif ($pendaftaran['status'] == 'Dibatalkan') {
                                $statusClass = "bg-red-50 text-red-600 border-red-200";
                                $dotClass = "bg-red-600";
                            }
                            ?>
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium <?= $statusClass; ?> border">
                                <span class="w-1.5 h-1.5 rounded-full <?= $dotClass; ?>"></span>
                                <?= htmlspecialchars($pendaftaran['status']); ?>
                            </span>
                        </td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center justify-center gap-2">
                                <button onclick="openEdit(<?= htmlspecialchars(json_encode($pendaftaran)); ?>)" class="p-1.5 rounded-lg text-[#5B4636] hover:bg-[#E8DDD0] transition-colors" title="Edit">
                                    <i class="ti ti-edit text-base" aria-hidden="true"></i>
                                </button>
                                <form action="" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berkas pendaftaran ini?');" style="display:inline;">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id_pendaftaran" value="<?= $pendaftaran['id_pendaftaran']; ?>">
                                    <button type="submit" class="p-1.5 rounded-lg text-[#B86E4B] hover:bg-[#B86E4B]/10 transition-colors" title="Hapus">
                                        <i class="ti ti-trash text-base" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>

                </tbody>
            </table>
        </div>

        <div class="px-5 py-4 border-t border-[#D8D2C6] flex items-center justify-between">
            <p class="text-xs text-[#5B4636]">Menampilkan <?= $totalDaftar; ?> dari <?= $totalDaftar; ?> pendaftaran</p>
            <div class="flex items-center gap-1">
                <button class="px-3 py-1.5 text-xs text-[#5B4636] border border-[#BFC3B1] rounded-lg hover:bg-[#F5F1EC] disabled:opacity-40" disabled>
                    <i class="ti ti-chevron-left" aria-hidden="true"></i>
                </button>
                <button class="px-3 py-1.5 text-xs bg-[#B86E4B] text-white rounded-lg font-medium">1</button>
                <button class="px-3 py-1.5 text-xs text-[#5B4636] border border-[#BFC3B1] rounded-lg hover:bg-[#F5F1EC] disabled:opacity-40" disabled>
                    <i class="ti ti-chevron-right" aria-hidden="true"></i>
                </button>
            </div>
        </div>

    </div>
</main>

<div id="modalTambahPendaftaran" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-[#2B221D]/40 backdrop-blur-sm">
    <div class="bg-white rounded-xl border border-[#BFC3B1] w-full max-w-xl mx-4 shadow-xl">
        <form action="" method="POST">
            <input type="hidden" name="action" value="create">
            
            <div class="px-6 py-4 border-b border-[#D8D2C6] flex items-center justify-between bg-[#F5F1EC] rounded-t-xl">
                <h3 class="text-sm font-semibold text-[#2B221D]">Formulir Pendaftaran Kremasi Baru</h3>
                <button type="button" onclick="document.getElementById('modalTambahPendaftaran').classList.add('hidden')" class="text-[#5B4636] hover:text-[#2B221D] transition-colors">
                    <i class="ti ti-x text-lg"></i>
                </button>
            </div>

            <div class="px-6 py-5 space-y-4 max-h-[70vh] overflow-y-auto">
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Pilih Pemohon (User)</label>
                        <select name="id_user" required class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B]">
                            <option value="">Pilih Pemohon</option>
                            <?php foreach($listUser as $user): ?>
                                <option value="<?= $user['id_user']; ?>"><?= htmlspecialchars($user['nama']); ?> (<?= htmlspecialchars($user['no_telepon'] ?? ''); ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Pilih Paket Layanan</label>
                        <select name="id_paket" required class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B]">
                            <option value="">Pilih Paket Layanan</option>
                            <?php foreach($listPaket as $paket): ?>
                                <option value="<?= $paket['id_paket']; ?>"><?= htmlspecialchars($paket['nama_paket']); ?> - Rp <?= number_format($paket['harga'], 0, ',', '.'); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="border-t border-[#D8D2C6] pt-3">
                    <h4 class="text-xs font-semibold text-[#2B221D] uppercase tracking-wider mb-3">Data Jenazah / Almarhum</h4>
                </div>

                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Nama Almarhum / Almarhumah</label>
                    <input type="text" name="nama_almarhum" required placeholder="Masukkan nama lengkap"
                        class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] placeholder-[#5B4636]/50 focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B]">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" required
                            class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B]">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Tanggal Meninggal</label>
                        <input type="date" name="tanggal_meninggal" required
                            class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B]">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Tanggal Pelaksanaan / Daftar</label>
                        <input type="date" name="tanggal_daftar" value="<?= date('Y-m-d'); ?>" required
                            class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B]">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Kode Registrasi (Otomatis)</label>
                        <input type="text" value="<?= $kodeOtomatis; ?>" disabled
                            class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#E8DDD0]/50 text-[#5B4636] font-mono font-semibold cursor-not-allowed">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Catatan Khusus</label>
                    <textarea name="catatan" rows="3" placeholder="Contoh: Upacara adat jam 10 pagi, titip balok es, dsb."
                        class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] placeholder-[#5B4636]/50 focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B] resize-none"></textarea>
                </div>
            </div>

            <div class="px-6 py-4 border-t border-[#D8D2C6] flex justify-end gap-2 bg-[#F5F1EC] rounded-b-xl">
                <button type="button" onclick="document.getElementById('modalTambahPendaftaran').classList.add('hidden')"
                    class="px-4 py-2 text-sm text-[#5B4636] border border-[#BFC3B1] rounded-lg hover:bg-[#D8D2C6] transition-colors">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 text-sm bg-[#B86E4B] hover:bg-[#2B221D] text-white rounded-lg transition-colors shadow-sm font-medium">
                    Simpan Berkas
                </button>
            </div>
        </form>
    </div>
</div>

<div id="modalEdit" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-[#2B221D]/40 backdrop-blur-sm">
    <div class="bg-white rounded-xl border border-[#BFC3B1] w-full max-w-xl mx-4 shadow-xl">
        <form action="" method="POST">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id_pendaftaran" id="editIdPendaftaran">
            
            <div class="px-6 py-4 border-b border-[#D8D2C6] flex items-center justify-between bg-[#F5F1EC] rounded-t-xl">
                <h3 class="text-sm font-semibold text-[#2B221D]">Kelola / Validasi Pendaftaran <span id="editKodePendaftaran" class="font-mono text-[#B86E4B]">KRM001</span></h3>
                <button type="button" onclick="document.getElementById('modalEdit').classList.add('hidden')" class="text-[#5B4636] hover:text-[#2B221D] transition-colors">
                    <i class="ti ti-x text-lg"></i>
                </button>
            </div>

            <div class="px-6 py-5 space-y-4 max-h-[70vh] overflow-y-auto">
                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Status Pendaftaran Pelayanan</label>
                    <select name="status" id="editStatus" class="w-full px-3 py-2 text-sm border border-[#B86E4B] bg-[#B86E4B]/10 font-medium text-[#2B221D] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30">
                        <option value="Menunggu">Menunggu Konfirmasi</option>
                        <option value="Diproses">Diproses / Pelaksanaan</option>
                        <option value="Selesai">Selesai</option>
                        <option value="Dibatalkan">Dibatalkan</option>
                    </select>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 bg-[#F5F1EC] p-3 rounded-lg border border-[#D8D2C6]">
                    <div>
                        <p class="text-[11px] text-[#5B4636]">Nama Almarhum</p>
                        <p id="editNamaAlmarhum" class="text-sm font-semibold text-[#2B221D]">-</p>
                    </div>
                    <div>
                        <p class="text-[11px] text-[#5B4636]">Pemohon / Keluarga</p>
                        <p id="editNamaPemohon" class="text-sm font-semibold text-[#2B221D]">-</p>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Penyesuaian Paket Layanan</label>
                    <select name="id_paket" id="editIdPaket" class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B]">
                        <?php foreach($listPaket as $paket): ?>
                            <option value="<?= $paket['id_paket']; ?>"><?= htmlspecialchars($paket['nama_paket']); ?> - Rp <?= number_format($paket['harga'], 0, ',', '.'); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Catatan/Instruksi Admin</label>
                    <textarea name="catatan" id="editCatatan" rows="3" class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B] resize-none"></textarea>
                </div>
            </div>

            <div class="px-6 py-4 border-t border-[#D8D2C6] flex justify-end gap-2 bg-[#F5F1EC] rounded-b-xl">
                <button type="button" onclick="document.getElementById('modalEdit').classList.add('hidden')"
                    class="px-4 py-2 text-sm text-[#5B4636] border border-[#BFC3B1] rounded-lg hover:bg-[#D8D2C6] transition-colors">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 text-sm bg-[#B86E4B] hover:bg-[#2B221D] text-white rounded-lg transition-colors shadow-sm font-medium">
                    Simpan Perubahan Status
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEdit(data) {
        // Memetakan data dari baris tabel ke dalam field modal secara dinamis
        if (data) {
            document.getElementById('editIdPendaftaran').value = data.id_pendaftaran;
            document.getElementById('editKodePendaftaran').innerText = data.kode_pendaftaran;
            document.getElementById('editStatus').value = data.status;
            document.getElementById('editNamaAlmarhum').innerText = data.nama_almarhum;
            document.getElementById('editNamaPemohon').innerText = data.nama_pemohon;
            document.getElementById('editIdPaket').value = data.id_paket;
            document.getElementById('editCatatan').value = data.catatan || '';
        }
        document.getElementById('modalEdit').classList.remove('hidden');
    }
</script>
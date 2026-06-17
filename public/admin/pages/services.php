<?php
require_once __DIR__ . '/../../../classes/KategoriPaket.php';
require_once __DIR__ . '/../../../classes/PaketLayanan.php';

// =========================================================================
// INISIALISASI & LOGIKA BACKEND HALAMAN
// =========================================================================
$paketModel = new PaketLayanan();
$kategoriModel = new KategoriPaket();

// Ambil data kategori pendukung untuk di-looping pada elemen <select> modal
$resKategori = $kategoriModel->getAll();
$kategori_list = ($resKategori['status']) ? $resKategori['data'] : [];

// Handle Request Form Tindakan Paket Layanan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'create') {
            $paketModel->create(
                $_POST['id_kategori'],
                $_POST['nama_paket'],
                $_POST['harga'],
                $_POST['fasilitas']
            );
            echo "<script>
            window.location='?page=services';
            </script>";
            exit;
        } elseif ($_POST['action'] === 'update') {
            $paketModel->update(
                $_POST['id_paket'],
                $_POST['id_kategori'],
                $_POST['nama_paket'],
                $_POST['harga'],
                $_POST['fasilitas']
            );
            echo "<script>
            window.location='?page=services';
            </script>";
            exit;
        } elseif ($_POST['action'] === 'delete') {
            $paketModel->delete($_POST['id_paket']);
            echo "<script>
            window.location='?page=services';
            </script>";
            exit;
        }
    }
}

// Ambil data utama Paket Layanan untuk ditaruh ke tabel dan komponen statistik
$daftar_paket = $paketModel->getAll();

// Logika Kalkulasi Statistik Dinamis
$total_paket = count($daftar_paket);
$kategori_unik = array_unique(array_column($daftar_paket, 'nama_kategori'));
$total_kategori = count($kategori_list); // Menghitung seluruh kategori terdaftar di database

$harga_tertinggi = 0;
$nama_paket_tertinggi = '-';
foreach ($daftar_paket as $p) {
    if ($p['harga'] > $harga_tertinggi) {
        $harga_tertinggi = $p['harga'];
        $nama_paket_tertinggi = $p['nama_paket'];
    }
}
$format_harga_tertinggi = $harga_tertinggi > 0 ? 'Rp ' . number_format($harga_tertinggi, 0, ',', '.') : 'Rp 0';
?>

<header class="bg-[#E8DDD0] border-b border-[#BFC3B1] px-6 py-4 flex items-center justify-between sticky top-0 z-30">
    <div>
        <h1 class="text-lg font-semibold text-[#2B221D]">Paket Layanan</h1>
        <p class="text-xs text-[#5B4636]">Kelola seluruh paket layanan kremasi</p>
    </div>
    <div class="flex items-center gap-3">
        <button class="relative text-[#5B4636] hover:text-[#2B221D] p-2 rounded-lg hover:bg-[#D8D2C6] transition-colors">
            <i class="ti ti-bell text-xl" aria-hidden="true"></i>
            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-[#B86E4B] rounded-full"></span>
        </button>
        <div class="w-9 h-9 rounded-full bg-[#BFC3B1] flex items-center justify-center text-[#2B221D] font-semibold text-sm">A</div>
    </div>
</header>

<main class="flex-1 p-6 space-y-6">

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        
        <div class="bg-white rounded-xl border border-[#BFC3B1] p-5">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-[#5B4636]">Total Paket</p>
                <div class="w-10 h-10 rounded-lg bg-[#E8DDD0] flex items-center justify-center">
                    <i class="ti ti-package text-[#5B4636] text-xl"></i>
                </div>
            </div>
            <p class="text-3xl font-semibold text-[#2B221D]"><?= $total_paket; ?></p>
            <p class="text-xs text-[#5B4636] mt-1">Paket layanan tersedia</p>
        </div>

        <div class="bg-white rounded-xl border border-[#BFC3B1] p-5">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-[#5B4636]">Kategori</p>
                <div class="w-10 h-10 rounded-lg bg-[#E8DDD0] flex items-center justify-center">
                    <i class="ti ti-category text-[#B86E4B] text-xl"></i>
                </div>
            </div>
            <p class="text-3xl font-semibold text-[#2B221D]"><?= $total_kategori; ?></p>
            <p class="text-xs text-[#5B4636] mt-1"><?= count($kategori_unik) > 0 ? implode(', ', $kategori_unik) : 'Belum ada paket aktif'; ?></p>
        </div>

        <div class="bg-white rounded-xl border border-[#BFC3B1] p-5">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-[#5B4636]">Harga Tertinggi</p>
                <div class="w-10 h-10 rounded-lg bg-[#E8DDD0] flex items-center justify-center">
                    <i class="ti ti-crown text-[#B86E4B] text-xl"></i>
                </div>
            </div>
            <p class="text-3xl font-semibold text-[#2B221D]"><?= $format_harga_tertinggi; ?></p>
            <p class="text-xs text-[#5B4636] mt-1"><?= htmlspecialchars($nama_paket_tertinggi); ?></p>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-[#BFC3B1]">

        <div class="px-5 py-4 border-b border-[#D8D2C6] flex flex-col sm:flex-row sm:items-center gap-3 justify-between">
            <h2 class="text-sm font-semibold text-[#2B221D]">Daftar Paket Layanan</h2>
            <div class="flex items-center gap-2">
                <div class="relative">
                    <i class="ti ti-search absolute left-3 top-1/2 -translate-y-1/2 text-[#5B4636] text-sm" aria-hidden="true"></i>
                    <input
                        type="text"
                        id="searchLayanan"
                        placeholder="Cari paket..."
                        class="pl-8 pr-4 py-1.5 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] placeholder-[#5B4636]/60 focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B] w-48"
                        onkeyup="searchTable()"
                    >
                </div>
                <button onclick="document.getElementById('modalTambah').classList.remove('hidden')"
                    class="flex items-center gap-1.5 px-3 py-1.5 bg-[#B86E4B] hover:bg-[#B86E4B]/90 text-white text-sm rounded-lg transition-colors shadow-sm">
                    <i class="ti ti-plus text-base" aria-hidden="true"></i>
                    Tambah
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm" id="tablePaket">
                <thead>
                    <tr class="bg-[#F5F1EC] text-left text-xs text-[#5B4636] uppercase tracking-wide border-b border-[#D8D2C6]">
                        <th class="px-5 py-3 font-medium">No</th>
                        <th class="px-5 py-3 font-medium">Paket</th>
                        <th class="px-5 py-3 font-medium">Kategori</th>
                        <th class="px-5 py-3 font-medium">Fasilitas</th>
                        <th class="px-5 py-3 font-medium">Harga</th>
                        <th class="px-5 py-3 font-medium text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#D8D2C6]">
                    <?php if (empty($daftar_paket)): ?>
                    <tr>
                        <td colspan="6" class="px-5 py-8 text-center text-[#5B4636]/70 italic">Belum ada data paket layanan.</td>
                    </tr>
                    <?php else: ?>
                        <?php $no = 1; foreach ($daftar_paket as $paket): ?>
                        <tr class="hover:bg-[#F5F1EC] transition-colors row-paket">
                            <td class="px-5 py-3.5 text-[#5B4636] text-xs"><?= $no++; ?></td>
                            <td class="px-5 py-4">
                                <div>
                                    <p class="font-medium text-[#2B221D] nama-paket-text"><?= htmlspecialchars($paket['nama_paket']); ?></p>
                                    <p class="text-xs text-[#5B4636] font-mono mt-0.5">ID: PKT-<?= str_pad($paket['id_paket'], 3, '0', STR_PAD_LEFT); ?></p>
                                </div>
                            </td>
                            <td class="px-5 py-4">
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium bg-[#E8DDD0] text-[#5B4636]">
                                    <?= htmlspecialchars($paket['nama_kategori']); ?>
                                </span>
                            </td>
                            <td class="px-5 py-4 text-[#5B4636] max-w-xs">
                                <?= nl2br(htmlspecialchars($paket['fasilitas'] ?? '')); ?>
                            </td>
                            <td class="px-5 py-4 font-semibold text-[#B86E4B]">
                                Rp <?= number_format($paket['harga'], 0, ',', '.'); ?>
                            </td>
                            <td class="px-5 py-3.5">
                                <div class="flex items-center justify-center gap-2">
                                    <button onclick="openEdit(<?= htmlspecialchars(json_encode($paket)); ?>)" class="p-1.5 rounded-lg text-[#5B4636] hover:bg-[#E8DDD0] transition-colors" title="Edit">
                                        <i class="ti ti-edit text-base" aria-hidden="true"></i>
                                    </button>
                                    <button onclick="confirmDelete(<?= $paket['id_paket']; ?>, '<?= htmlspecialchars($paket['nama_paket'], ENT_QUOTES); ?>')" class="p-1.5 rounded-lg text-[#B86E4B] hover:bg-[#B86E4B]/10 transition-colors" title="Hapus">
                                        <i class="ti ti-trash text-base" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="px-5 py-4 border-t border-[#D8D2C6] flex items-center justify-between">
            <p class="text-xs text-[#5B4636]">Menampilkan <?= count($daftar_paket); ?> paket layanan</p>
            <div class="flex items-center gap-1">
                <button class="px-3 py-1.5 text-xs text-[#5B4636] border border-[#BFC3B1] rounded-lg hover:bg-[#F5F1EC] disabled:opacity-40" disabled>
                    <i class="ti ti-chevron-left" aria-hidden="true"></i>
                </button>
                <button class="px-3 py-1.5 text-xs bg-[#B86E4B] text-white rounded-lg">1</button>
                <button class="px-3 py-1.5 text-xs text-[#5B4636] border border-[#BFC3B1] rounded-lg hover:bg-[#F5F1EC]" disabled>
                    <i class="ti ti-chevron-right" aria-hidden="true"></i>
                </button>
            </div>
        </div>

    </div>
</main>

<div id="modalTambah" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-[#2B221D]/40 backdrop-blur-sm">
    <div class="bg-white rounded-xl border border-[#BFC3B1] w-full max-w-lg mx-4 shadow-xl">
        <form action="" method="POST">
            <input type="hidden" name="action" value="create">
            <div class="px-6 py-4 border-b border-[#D8D2C6] flex items-center justify-between bg-[#F5F1EC] rounded-t-xl">
                <h3 class="text-sm font-semibold text-[#2B221D]">Tambah Paket Layanan</h3>
                <button type="button" onclick="document.getElementById('modalTambah').classList.add('hidden')" class="text-[#5B4636] hover:text-[#2B221D]">
                    <i class="ti ti-x text-lg"></i>
                </button>
            </div>

            <div class="px-6 py-5 space-y-4">
                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Kategori Paket</label>
                    <select name="id_kategori" required class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-white text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B]">
                        <option value="">Pilih Kategori</option>
                        <?php foreach($kategori_list as $kat): ?>
                            <option value="<?= $kat['id_kategori']; ?>"><?= htmlspecialchars($kat['nama_kategori']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Nama Paket</label>
                    <input type="text" name="nama_paket" required placeholder="Masukkan nama paket"
                        class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-white text-[#2B221D] placeholder-[#5B4636]/50 focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B]">
                </div>

                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Harga Paket</label>
                    <input type="number" name="harga" required placeholder="Masukkan harga paket"
                        class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-white text-[#2B221D] placeholder-[#5B4636]/50 focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B]">
                </div>

                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Fasilitas</label>
                    <textarea name="fasilitas" rows="4" placeholder="Masukkan fasilitas paket"
                        class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-white text-[#2B221D] placeholder-[#5B4636]/50 focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B] resize-none"></textarea>
                </div>
            </div>

            <div class="px-6 py-4 border-t border-[#D8D2C6] flex justify-end gap-2 bg-[#F5F1EC] rounded-b-xl">
                <button type="button" onclick="document.getElementById('modalTambah').classList.add('hidden')"
                    class="px-4 py-2 text-sm text-[#5B4636] border border-[#BFC3B1] rounded-lg hover:bg-[#D8D2C6] transition-colors">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 text-sm bg-[#B86E4B] hover:bg-[#B86E4B]/90 text-white rounded-lg transition-colors shadow-sm">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<div id="modalEdit" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-[#2B221D]/40 backdrop-blur-sm">
    <div class="bg-white rounded-xl border border-[#BFC3B1] w-full max-w-lg mx-4 shadow-lg">
        <form action="" method="POST">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id_paket" id="edit_id_paket">
            <div class="px-6 py-4 border-b border-[#D8D2C6] flex items-center justify-between bg-[#F5F1EC] rounded-t-xl">
                <h3 class="text-sm font-semibold text-[#2B221D]">Edit Paket Layanan</h3>
                <button type="button" onclick="document.getElementById('modalEdit').classList.add('hidden')" class="text-[#5B4636] hover:text-[#2B221D]">
                    <i class="ti ti-x text-lg"></i>
                </button>
            </div>

            <div class="px-6 py-5 space-y-4">
                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Kategori Paket</label>
                    <select name="id_kategori" id="edit_id_kategori" required class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-white text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B]">
                        <?php foreach($kategori_list as $kat): ?>
                            <option value="<?= $kat['id_kategori']; ?>"><?= htmlspecialchars($kat['nama_kategori']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Nama Paket</label>
                    <input type="text" name="nama_paket" id="edit_nama_paket" required class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-white text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B]">
                </div>

                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Harga Paket</label>
                    <input type="number" name="harga" id="edit_harga" required class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-white text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B]">
                </div>

                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Fasilitas</label>
                    <textarea name="fasilitas" id="edit_fasilitas" rows="4" class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-white text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B] resize-none"></textarea>
                </div>
            </div>

            <div class="px-6 py-4 border-t border-[#D8D2C6] flex justify-end gap-2 bg-[#F5F1EC] rounded-b-xl">
                <button type="button" onclick="document.getElementById('modalEdit').classList.add('hidden')"
                    class="px-4 py-2 text-sm text-[#5B4636] border border-[#BFC3B1] rounded-lg hover:bg-[#D8D2C6] transition-colors">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 text-sm bg-[#B86E4B] hover:bg-[#B86E4B]/90 text-white rounded-lg transition-colors shadow-sm">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<form id="formHapus" action="" method="POST" class="hidden">
    <input type="hidden" name="action" value="delete">
    <input type="hidden" name="id_paket" id="hapus_id_paket">
</form>

<script>
    // Membuka modal edit dengan parsing data row objek terpilih
    function openEdit(paket) {
        document.getElementById('edit_id_paket').value = paket.id_paket;
        document.getElementById('edit_id_kategori').value = paket.id_kategori;
        document.getElementById('edit_nama_paket').value = paket.nama_paket;
        document.getElementById('edit_harga').value = parseInt(paket.harga);
        document.getElementById('edit_fasilitas').value = paket.fasilitas;
        
        document.getElementById('modalEdit').classList.remove('hidden');
    }

    // Penanganan konfirmasi delete native browser
    function confirmDelete(id, nama) {
        if(confirm("Apakah Anda yakin ingin menghapus paket \"" + nama + "\"?")) {
            document.getElementById('hapus_id_paket').value = id;
            document.getElementById('formHapus').submit();
        }
    }

    // Fitur pencarian klien sisi tabel (Client-side Search)
    function searchTable() {
        let input = document.getElementById("searchLayanan").value.toLowerCase();
        let rows = document.getElementsByClassName("row-paket");
        
        for (let i = 0; i < rows.length; i++) {
            let namaPaket = rows[i].querySelector(".nama-paket-text").textContent.toLowerCase();
            if (namaPaket.includes(input)) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }
</script>
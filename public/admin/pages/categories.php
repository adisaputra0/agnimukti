<?php
require_once __DIR__ . '/../../../classes/KategoriPaket.php';

$kategoriModel = new KategoriPaket();

// Handle POST actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'tambah') {
        $kategoriModel->create(
            $_POST['nama_kategori'],
            $_POST['deskripsi']
        );
    } elseif ($action === 'edit') {
        $kategoriModel->update(
            $_POST['id_kategori'],
            $_POST['nama_kategori'],
            $_POST['deskripsi']
        );
    } elseif ($action === 'hapus') {
        $kategoriModel->delete($_POST['id_kategori']);
    }

    echo "<script>
    window.location='?page=categories';
    </script>";
    exit;
}

// Fetch data
$result   = $kategoriModel->getAll();
$allData  = $result['status'] ? $result['data'] : [];

// Search filter
$search = $_GET['search'] ?? '';
$filtered = $allData;
if ($search !== '') {
    $filtered = array_values(array_filter($allData, fn($k) =>
        stripos($k['nama_kategori'], $search) !== false ||
        stripos($k['deskripsi'] ?? '', $search) !== false
    ));
}

// Pagination
$perPage     = 10;
$totalAll    = count($allData);
$totalFiltered = count($filtered);
$totalPages  = max(1, ceil($totalFiltered / $perPage));
$currentPage = max(1, min((int)($_GET['page'] ?? 1), $totalPages));
$offset      = ($currentPage - 1) * $perPage;
$pageData    = array_slice($filtered, $offset, $perPage);

// Stats
$totalKategori = $totalAll;
$latest        = !empty($allData) ? $allData[0] : null; // ORDER BY DESC, jadi index 0 = terbaru
?>

<header class="bg-[#E8DDD0] border-b border-[#BFC3B1] px-6 py-4 flex items-center justify-between sticky top-0 z-30">
    <div>
        <h1 class="text-lg font-semibold text-[#2B221D]">Kategori Paket</h1>
        <p class="text-xs text-[#5B4636]">Kelola seluruh kategori paket layanan</p>
    </div>
    <div class="flex items-center gap-3">
        <button class="relative text-[#5B4636] hover:text-[#2B221D] p-2 rounded-lg hover:bg-[#D8D2C6] transition-colors">
            <i class="ti ti-bell text-xl"></i>
            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-[#B86E4B] rounded-full"></span>
        </button>
    </div>
</header>

<main class="flex-1 p-6 space-y-6">

    <!-- Statistik -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

        <div class="bg-white rounded-xl border border-[#BFC3B1] p-5">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-[#5B4636]">Total Kategori</p>
                <div class="w-10 h-10 rounded-lg bg-[#E8DDD0] flex items-center justify-center">
                    <i class="ti ti-category text-[#5B4636] text-xl"></i>
                </div>
            </div>
            <p class="text-3xl font-semibold text-[#2B221D]"><?= $totalKategori ?></p>
            <p class="text-xs text-[#5B4636] mt-1">Kategori tersedia</p>
        </div>

        <div class="bg-white rounded-xl border border-[#BFC3B1] p-5">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-[#5B4636]">Kategori Aktif</p>
                <div class="w-10 h-10 rounded-lg bg-[#E8DDD0] flex items-center justify-center">
                    <i class="ti ti-check text-[#B86E4B] text-xl"></i>
                </div>
            </div>
            <p class="text-3xl font-semibold text-[#2B221D]"><?= $totalKategori ?></p>
            <p class="text-xs text-[#5B4636] mt-1">Seluruh kategori aktif</p>
        </div>

        <div class="bg-white rounded-xl border border-[#BFC3B1] p-5">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-[#5B4636]">Kategori Terbaru</p>
                <div class="w-10 h-10 rounded-lg bg-[#E8DDD0] flex items-center justify-center">
                    <i class="ti ti-clock text-[#B86E4B] text-xl"></i>
                </div>
            </div>
            <p class="text-lg font-semibold text-[#2B221D]"><?= $latest ? htmlspecialchars($latest['nama_kategori']) : '-' ?></p>
            <p class="text-xs text-[#5B4636] mt-1">Ditambahkan terbaru</p>
        </div>

    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl border border-[#BFC3B1]">

        <div class="px-5 py-4 border-b border-[#D8D2C6] flex flex-col sm:flex-row sm:items-center gap-3 justify-between">
            <h2 class="text-sm font-semibold text-[#2B221D]">Daftar Kategori Paket</h2>

            <div class="flex items-center gap-2">
                <form method="GET" class="flex items-center gap-2">
                    <div class="relative">
                        <i class="ti ti-search absolute left-3 top-1/2 -translate-y-1/2 text-[#5B4636] text-sm"></i>
                        <input
                            type="text"
                            name="search"
                            value="<?= htmlspecialchars($search) ?>"
                            placeholder="Cari kategori..."
                            class="pl-8 pr-4 py-1.5 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] placeholder-[#5B4636]/60 focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B] w-48">
                    </div>
                    <button type="submit" class="hidden"></button>
                </form>

                <button
                    onclick="document.getElementById('modalTambah').classList.remove('hidden')"
                    class="flex items-center gap-1.5 px-3 py-1.5 bg-[#B86E4B] hover:bg-[#B86E4B]/90 text-white text-sm rounded-lg transition-colors shadow-sm">
                    <i class="ti ti-plus text-base"></i>
                    Tambah
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-[#F5F1EC] text-left text-xs text-[#5B4636] uppercase tracking-wide border-b border-[#D8D2C6]">
                        <th class="px-5 py-3 font-medium">No</th>
                        <th class="px-5 py-3 font-medium">Kategori</th>
                        <th class="px-5 py-3 font-medium">Deskripsi</th>
                        <th class="px-5 py-3 font-medium">Dibuat</th>
                        <th class="px-5 py-3 font-medium text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-[#D8D2C6]">

                    <?php foreach ($pageData as $i => $kategori): ?>
                    <tr class="hover:bg-[#F5F1EC] transition-colors">
                        <td class="px-5 py-3.5 text-[#5B4636] text-xs"><?= $offset + $i + 1 ?></td>

                        <td class="px-5 py-4">
                            <div>
                                <p class="font-medium text-[#2B221D]"><?= htmlspecialchars($kategori['nama_kategori']) ?></p>
                                <p class="text-xs text-[#5B4636] font-mono mt-0.5">
                                    ID: <?= str_pad($kategori['id_kategori'], 3, '0', STR_PAD_LEFT) ?>
                                </p>
                            </div>
                        </td>

                        <td class="px-5 py-4 text-[#5B4636]">
                            <?= htmlspecialchars($kategori['deskripsi'] ?? '-') ?>
                        </td>

                        <td class="px-5 py-4 text-[#5B4636]">
                            <?= $kategori['created_at'] ? date('d M Y', strtotime($kategori['created_at'])) : '-' ?>
                        </td>

                        <td class="px-5 py-3.5">
                            <div class="flex items-center justify-center gap-2">
                                <button onclick="openEdit(<?= htmlspecialchars(json_encode($kategori)) ?>)"
                                    class="p-1.5 rounded-lg text-[#5B4636] hover:bg-[#E8DDD0] transition-colors">
                                    <i class="ti ti-edit text-base"></i>
                                </button>

                                <form method="POST" onsubmit="return confirm('Hapus kategori ini?')" style="display:inline">
                                    <input type="hidden" name="action" value="hapus">
                                    <input type="hidden" name="id_kategori" value="<?= $kategori['id_kategori'] ?>">
                                    <button type="submit" class="p-1.5 rounded-lg text-[#B86E4B] hover:bg-[#B86E4B]/10 transition-colors">
                                        <i class="ti ti-trash text-base"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                    <?php if (empty($pageData)): ?>
                    <tr>
                        <td colspan="5" class="px-5 py-8 text-center text-sm text-[#5B4636]">Tidak ada data kategori.</td>
                    </tr>
                    <?php endif; ?>

                </tbody>
            </table>
        </div>

        <div class="px-5 py-4 border-t border-[#D8D2C6] flex items-center justify-between">
            <p class="text-xs text-[#5B4636]">Menampilkan <?= count($pageData) ?> dari <?= $totalFiltered ?> kategori</p>

            <div class="flex items-center gap-1">
                <a href="?<?= http_build_query(array_merge($_GET, ['page' => max(1, $currentPage - 1)])) ?>"
                    class="px-3 py-1.5 text-xs text-[#5B4636] border border-[#BFC3B1] rounded-lg hover:bg-[#F5F1EC] <?= $currentPage <= 1 ? 'opacity-40 pointer-events-none' : '' ?>">
                    <i class="ti ti-chevron-left"></i>
                </a>

                <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                <a href="?<?= http_build_query(array_merge($_GET, ['page' => $p])) ?>"
                    class="px-3 py-1.5 text-xs rounded-lg <?= $p === $currentPage ? 'bg-[#B86E4B] text-white' : 'text-[#5B4636] border border-[#BFC3B1] hover:bg-[#F5F1EC]' ?>">
                    <?= $p ?>
                </a>
                <?php endfor; ?>

                <a href="?<?= http_build_query(array_merge($_GET, ['page' => min($totalPages, $currentPage + 1)])) ?>"
                    class="px-3 py-1.5 text-xs text-[#5B4636] border border-[#BFC3B1] rounded-lg hover:bg-[#F5F1EC] <?= $currentPage >= $totalPages ? 'opacity-40 pointer-events-none' : '' ?>">
                    <i class="ti ti-chevron-right"></i>
                </a>
            </div>
        </div>

    </div>

</main>

<!-- Modal Tambah -->
<div id="modalTambah" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-[#2B221D]/40 backdrop-blur-sm">
    <div class="bg-white rounded-xl border border-[#BFC3B1] w-full max-w-lg mx-4 shadow-xl">

        <div class="px-6 py-4 border-b border-[#D8D2C6] flex items-center justify-between bg-[#F5F1EC] rounded-t-xl">
            <h3 class="text-sm font-semibold text-[#2B221D]">Tambah Kategori Paket</h3>
            <button onclick="document.getElementById('modalTambah').classList.add('hidden')"
                class="text-[#5B4636] hover:text-[#2B221D]">
                <i class="ti ti-x text-lg"></i>
            </button>
        </div>

        <form method="POST">
            <input type="hidden" name="action" value="tambah">
            <div class="px-6 py-5 space-y-4">
                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Nama Kategori</label>
                    <input
                        type="text"
                        name="nama_kategori"
                        placeholder="Masukkan nama kategori"
                        class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-white text-[#2B221D]">
                </div>
                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Deskripsi</label>
                    <textarea rows="4"
                        name="deskripsi"
                        placeholder="Masukkan deskripsi kategori"
                        class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-white text-[#2B221D] resize-none"></textarea>
                </div>
            </div>

            <div class="px-6 py-4 border-t border-[#D8D2C6] flex justify-end gap-2 bg-[#F5F1EC] rounded-b-xl">
                <button type="button" onclick="document.getElementById('modalTambah').classList.add('hidden')"
                    class="px-4 py-2 text-sm text-[#5B4636] border border-[#BFC3B1] rounded-lg hover:bg-[#D8D2C6]">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 text-sm bg-[#B86E4B] text-white rounded-lg">
                    Simpan
                </button>
            </div>
        </form>

    </div>
</div>

<!-- Modal Edit -->
<div id="modalEdit" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-[#2B221D]/40 backdrop-blur-sm">
    <div class="bg-white rounded-xl border border-[#BFC3B1] w-full max-w-lg mx-4 shadow-xl">

        <div class="px-6 py-4 border-b border-[#D8D2C6] flex items-center justify-between bg-[#F5F1EC] rounded-t-xl">
            <h3 class="text-sm font-semibold text-[#2B221D]">Edit Kategori Paket</h3>
            <button onclick="document.getElementById('modalEdit').classList.add('hidden')"
                class="text-[#5B4636] hover:text-[#2B221D]">
                <i class="ti ti-x text-lg"></i>
            </button>
        </div>

        <form method="POST">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="id_kategori" id="editIdKategori">
            <div class="px-6 py-5 space-y-4">
                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Nama Kategori</label>
                    <input
                        type="text"
                        name="nama_kategori"
                        id="editNamaKategori"
                        class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-white text-[#2B221D]">
                </div>
                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Deskripsi</label>
                    <textarea rows="4"
                        name="deskripsi"
                        id="editDeskripsi"
                        class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-white text-[#2B221D] resize-none"></textarea>
                </div>
            </div>

            <div class="px-6 py-4 border-t border-[#D8D2C6] flex justify-end gap-2 bg-[#F5F1EC] rounded-b-xl">
                <button type="button" onclick="document.getElementById('modalEdit').classList.add('hidden')"
                    class="px-4 py-2 text-sm text-[#5B4636] border border-[#BFC3B1] rounded-lg hover:bg-[#D8D2C6]">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 text-sm bg-[#B86E4B] text-white rounded-lg">
                    Simpan Perubahan
                </button>
            </div>
        </form>

    </div>
</div>

<script>
function openEdit(kategori) {
    document.getElementById('editIdKategori').value    = kategori.id_kategori;
    document.getElementById('editNamaKategori').value  = kategori.nama_kategori;
    document.getElementById('editDeskripsi').value     = kategori.deskripsi ?? '';
    document.getElementById('modalEdit').classList.remove('hidden');
}
</script>
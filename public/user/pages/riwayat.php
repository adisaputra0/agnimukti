<?php
require_once __DIR__ . '/../../../classes/Pendaftaran.php';

$pendaftaranModel = new Pendaftaran();
// Ambil seluruh data pendaftaran milik user yang sedang login
$dataPendaftaran = $pendaftaranModel->getByUser($authUser['data']['id_user']);

// Tangkap filter status jika ada (untuk kebutuhan interaksi filter)
$statusFilter = isset($_GET['status']) ? strtolower($_GET['status']) : 'semua';

// Lakukan penyaringan data jika filter aktif
if ($statusFilter !== 'semua') {
    $dataPendaftaran = array_filter($dataPendaftaran, function($item) use ($statusFilter) {
        return strtolower($item['status']) === $statusFilter;
    });
}
?>

<header class="bg-[#E8DDD0] border-b border-[#BFC3B1] px-6 py-4 flex items-center justify-between sticky top-0 z-30">
    <div>
        <h1 class="text-lg font-semibold text-[#2B221D]">Riwayat Pengajuan Kremasi</h1>
        <p class="text-xs text-[#5B4636]">Pantau dan cek status berkas pendaftaran Anda yang terdaftar di sistem</p>
    </div>
</header>

<div class="p-6 space-y-4">

    <div class="flex flex-wrap items-center gap-2 text-xs">
        <span class="text-[#5B4636] font-medium mr-1">Filter Status:</span>
        
        <a href="?page=riwayat&status=semua" 
           class="px-3 py-1.5 rounded-lg border font-medium transition-all <?= $statusFilter === 'semua' ? 'bg-[#2B221D] text-white border-[#2B221D]' : 'bg-white text-[#5B4636] border-[#BFC3B1] hover:bg-gray-50' ?>">
            Semua
        </a>
        
        <a href="?page=riwayat&status=menunggu" 
           class="px-3 py-1.5 rounded-lg border font-medium transition-all <?= $statusFilter === 'menunggu' ? 'bg-[#2B221D] text-white border-[#2B221D]' : 'bg-white text-[#5B4636] border-[#BFC3B1] hover:bg-gray-50' ?>">
            Menunggu
        </a>
        
        <a href="?page=riwayat&status=diproses" 
           class="px-3 py-1.5 rounded-lg border font-medium transition-all <?= $statusFilter === 'diproses' ? 'bg-[#2B221D] text-white border-[#2B221D]' : 'bg-white text-[#5B4636] border-[#BFC3B1] hover:bg-gray-50' ?>">
            Diproses
        </a>
        
        <a href="?page=riwayat&status=selesai" 
           class="px-3 py-1.5 rounded-lg border font-medium transition-all <?= $statusFilter === 'selesai' ? 'bg-[#2B221D] text-white border-[#2B221D]' : 'bg-white text-[#5B4636] border-[#BFC3B1] hover:bg-gray-50' ?>">
            Selesai
        </a>
    </div>

    <div class="bg-white rounded-xl border border-[#BFC3B1] overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="border-b border-[#D8D2C6] text-[#5B4636] bg-[#F5F1EC] font-semibold">
                        <th class="p-4 w-28">Kode</th>
                        <th class="p-4">Data Almarhum</th>
                        <th class="p-4">Paket & Rincian Biaya</th>
                        <th class="p-4">Tanggal Rencana</th>
                        <th class="p-4 w-32">Status Berkas</th>
                        <th class="p-4 w-20 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#F5F1EC]">
                    <?php if (!empty($dataPendaftaran)): ?>
                        <?php foreach ($dataPendaftaran as $row): ?>
                            <tr class="hover:bg-[#F5F1EC]/10 transition-colors text-[#2B221D]">
                                <td class="p-4 font-mono font-bold text-[#B86E4B] vertical-align-top">
                                    <?= htmlspecialchars($row['kode_pendaftaran']) ?>
                                </td>
                                
                                <td class="p-4">
                                    <div class="font-semibold text-sm text-[#2B221D]"><?= htmlspecialchars($row['nama_almarhum']) ?></div>
                                    <div class="text-[11px] text-[#5B4636] mt-0.5">
                                        Lahir: <?= date('d M Y', strtotime($row['tanggal_lahir'])) ?> <span class="mx-1">•</span> Wafat: <?= date('d M Y', strtotime($row['tanggal_meninggal'])) ?>
                                    </div>
                                </td>
                                
                                <td class="p-4">
                                    <div class="font-medium"><?= htmlspecialchars($row['nama_paket']) ?></div>
                                    <div class="text-[11px] font-semibold text-[#5B4636] mt-0.5">
                                        Rp <?= number_format($row['harga'], 0, ',', '.') ?>
                                    </div>
                                </td>
                                
                                <td class="p-4 text-[#5B4636] font-medium">
                                    <?= date('d F Y', strtotime($row['tanggal_daftar'])) ?>
                                </td>
                                
                                <td class="p-4">
                                    <?php 
                                        $status = strtolower($row['status']);
                                        $badge = 'bg-rose-50 text-rose-700 border-rose-200'; // Default menunggu
                                        if ($status === 'diproses') $badge = 'bg-amber-50 text-amber-700 border-amber-200';
                                        if ($status === 'selesai') $badge = 'bg-emerald-50 text-emerald-700 border-emerald-200';
                                    ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold border <?= $badge ?>">
                                        <?php if($status === 'diproses'): ?>
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mr-1.5 animate-pulse"></span>
                                        <?php endif; ?>
                                        <?= ucfirst($status) ?>
                                    </span>
                                </td>
                                
                                <td class="p-4 text-center">
                                    <a href="?page=riwayat-detail&id=<?= $row['id_pendaftaran'] ?>" 
                                       class="inline-flex items-center justify-center p-2 text-[#5B4636] hover:text-[#B86E4B] bg-[#F5F1EC]/60 hover:bg-[#E8DDD0] rounded-lg transition-colors border border-[#BFC3B1]/40" 
                                       title="Lihat Detail Berkas">
                                        <i class="ti ti-eye text-base"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="p-12 text-center text-[#5B4636]/70">
                                <div class="w-12 h-12 rounded-full bg-[#F5F1EC] flex items-center justify-center text-[#BFC3B1] mx-auto mb-3">
                                    <i class="ti ti-file-analytics text-2xl"></i>
                                </div>
                                <h3 class="text-sm font-semibold text-[#2B221D]">Tidak Ada Riwayat Pendaftaran</h3>
                                <p class="text-xs text-[#5B4636] max-w-sm mx-auto mt-1">Berkas pendaftaran dengan kategori status ini tidak ditemukan atau Anda belum pernah melakukan pengajuan berkas.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="text-[11px] text-[#5B4636] flex items-center gap-1.5 px-2">
        <i class="ti ti-info-circle text-sm text-[#B86E4B]"></i>
        <span>Klik ikon mata (<i class="ti ti-eye"></i>) pada baris tabel untuk meninjau catatan dari admin serta riwayat dokumen cetak nota kontribusi.</span>
    </div>

</div>
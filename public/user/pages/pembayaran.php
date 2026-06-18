<?php
require_once __DIR__ . '/../../../classes/Pembayaran.php';

$pembayaranModel = new Pembayaran();
// Ambil data transaksi pembayaran khusus milik user yang login
$dataPembayaran = $pembayaranModel->getByUser($authUser['data']['id_user']);

// Tangkap filter status jika ada
$statusFilter = isset($_GET['status']) ? strtolower($_GET['status']) : 'semua';

// Lakukan penyaringan array jika filter aktif
if ($statusFilter !== 'semua') {
    $dataPembayaran = array_filter($dataPembayaran, function($item) use ($statusFilter) {
        return strtolower($item['status_pembayaran']) === $statusFilter;
    });
}
?>

<header class="bg-[#E8DDD0] border-b border-[#BFC3B1] px-6 py-4 flex items-center justify-between sticky top-0 z-30">
    <div>
        <h1 class="text-lg font-semibold text-[#2B221D]">Status Pembayaran</h1>
        <p class="text-xs text-[#5B4636]">Pantau riwayat transaksi, kontribusi kontan, dan validasi invoice Anda</p>
    </div>
</header>

<div class="p-6 space-y-4">

    <div class="flex flex-wrap items-center gap-2 text-xs">
        <span class="text-[#5B4636] font-medium mr-1">Status Transaksi:</span>
        
        <a href="?page=pembayaran&status=semua" 
           class="px-3 py-1.5 rounded-lg border font-medium transition-all <?= $statusFilter === 'semua' ? 'bg-[#2B221D] text-white border-[#2B221D]' : 'bg-white text-[#5B4636] border-[#BFC3B1] hover:bg-gray-50' ?>">
            Semua
        </a>
        
        <a href="?page=pembayaran&status=lunas" 
           class="px-3 py-1.5 rounded-lg border font-medium transition-all <?= $statusFilter === 'lunas' ? 'bg-[#2B221D] text-white border-[#2B221D]' : 'bg-white text-[#5B4636] border-[#BFC3B1] hover:bg-gray-50' ?>">
            Lunas
        </a>
        
        <a href="?page=pembayaran&status=pending" 
           class="px-3 py-1.5 rounded-lg border font-medium transition-all <?= $statusFilter === 'pending' ? 'bg-[#2B221D] text-white border-[#2B221D]' : 'bg-white text-[#5B4636] border-[#BFC3B1] hover:bg-gray-50' ?>">
            Pending
        </a>
        
        <a href="?page=pembayaran&status=gagal" 
           class="px-3 py-1.5 rounded-lg border font-medium transition-all <?= $statusFilter === 'gagal' ? 'bg-[#2B221D] text-white border-[#2B221D]' : 'bg-white text-[#5B4636] border-[#BFC3B1] hover:bg-gray-50' ?>">
            Gagal
        </a>
    </div>

    <div class="bg-white rounded-xl border border-[#BFC3B1] overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="border-b border-[#D8D2C6] text-[#5B4636] bg-[#F5F1EC] font-semibold">
                        <th class="p-4 w-32">Kode Pengajuan</th>
                        <th class="p-4">Data Almarhum</th>
                        <th class="p-4">Tanggal Bayar</th>
                        <th class="p-4">Metode</th>
                        <th class="p-4">Jumlah Kontribusi</th>
                        <th class="p-4 w-32">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#F5F1EC]">
                    <?php if (!empty($dataPembayaran)): ?>
                        <?php foreach ($dataPembayaran as $row): ?>
                            <tr class="hover:bg-[#F5F1EC]/10 transition-colors text-[#2B221D]">
                                
                                <td class="p-4 font-mono font-bold text-[#B86E4B]">
                                    <?= htmlspecialchars($row['kode_pendaftaran']) ?>
                                </td>
                                
                                <td class="p-4 font-medium text-[#2B221D]">
                                    <?= htmlspecialchars($row['nama_almarhum']) ?>
                                </td>
                                
                                <td class="p-4 text-[#5B4636]">
                                    <?= $row['tanggal_bayar'] ? date('d M Y', strtotime($row['tanggal_bayar'])) : '<span class="text-gray-400 italic">Belum dibayar</span>' ?>
                                </td>
                                
                                <td class="p-4 font-medium text-[#5B4636]">
                                    <span class="px-2 py-1 rounded bg-[#F5F1EC] border border-[#BFC3B1]/30 uppercase text-[10px]">
                                        <?= htmlspecialchars($row['metode_pembayaran'] ?? 'N/A') ?>
                                    </span>
                                </td>
                                
                                <td class="p-4 font-bold text-[#2B221D]">
                                    Rp <?= number_format($row['total_bayar'], 0, ',', '.') ?>
                                </td>
                                
                                <td class="p-4">
                                    <?php 
                                        $statusBayar = strtolower($row['status_pembayaran']);
                                        
                                        // Mapping style berkas kalem
                                        if ($statusBayar === 'lunas') {
                                            $badgeClass = 'bg-emerald-50 text-emerald-700 border-emerald-200';
                                        } elseif ($statusBayar === 'pending') {
                                            $badgeClass = 'bg-amber-50 text-amber-700 border-amber-200';
                                        } else {
                                            $badgeClass = 'bg-rose-50 text-rose-700 border-rose-200';
                                        }
                                    ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold border <?= $badgeClass ?>">
                                        <?= ucfirst($statusBayar) ?>
                                    </span>
                                </td>
                                
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="p-12 text-center text-[#5B4636]/70">
                                <div class="w-12 h-12 rounded-full bg-[#F5F1EC] flex items-center justify-center text-[#BFC3B1] mx-auto mb-3">
                                    <i class="ti ti-receipt-off text-2xl"></i>
                                </div>
                                <h3 class="text-sm font-semibold text-[#2B221D]">Belum Ada Data Transaksi</h3>
                                <p class="text-xs text-[#5B4636] max-w-sm mx-auto mt-1">Data tagihan baru akan diterbitkan atau divalidasi setelah berkas pendaftaran Anda disetujui/diproses oleh tim admin.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="text-[11px] text-[#5B4636] flex items-start gap-2 px-2">
        <i class="ti ti-message-circle text-sm text-[#B86E4B] mt-0.5"></i>
        <span>
            Untuk melakukan pembayaran, silakan hubungi Admin terlebih dahulu melalui WhatsApp. 
            Pembayaran dapat dilakukan melalui <strong class="text-[#B86E4B]">QRIS</strong> atau 
            <strong class="text-[#B86E4B]">Tunai</strong>. Setelah pembayaran dikonfirmasi, status transaksi akan diperbarui oleh admin.
        </span>
    </div>
    <div class="px-2 mt-3">
        <a href="https://wa.me/6283847406501"
        target="_blank"
        class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-[#B86E4B] border border-[#B86E4B] hover:bg-[#B86E4B]/90 text-white text-xs font-medium transition">
            <i class="ti ti-brand-whatsapp"></i>
            Hubungi Admin Pembayaran
        </a>
    </div>

</div>
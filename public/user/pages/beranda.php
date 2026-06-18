<?php
require_once __DIR__ . '/../../../classes/Pendaftaran.php';

$pendaftaranModel = new Pendaftaran();
$dataPendaftaran = $pendaftaranModel->getByUser($authUser['data']['id_user']);

$jumlahMenunggu = 0;
$jumlahDiproses = 0;
$jumlahSelesai = 0;

foreach ($dataPendaftaran as $pendaftaran) {
    switch (strtolower($pendaftaran['status'])) {
        case 'menunggu':
            $jumlahMenunggu++;
            break;
        case 'diproses':
            $jumlahDiproses++;
            break;
        case 'selesai':
            $jumlahSelesai++;
            break;
    }
}

// Ambil maksimal 3 data pendaftaran terbaru untuk tabel aktivitas
$aktivitasTerakhir = array_slice($dataPendaftaran, 0, 3);
?>

<header class="bg-[#E8DDD0] border-b border-[#BFC3B1] px-6 py-4 flex items-center justify-between sticky top-0 z-30">
    <div>
        <h1 class="text-lg font-semibold text-[#2B221D]">Selamat Datang, <?= htmlspecialchars($authUser['data']['nama'] ?? 'Pemohon') ?></h1>
        <p class="text-xs text-[#5B4636]">Berikut ringkasan pengajuan kremasi Anda secara real-time</p>
    </div>
</header>

<div class="p-6 space-y-6">    
    
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-white p-4 rounded-xl border border-[#BFC3B1] flex items-center gap-4 shadow-sm">
            <div class="w-10 h-10 rounded-lg bg-[#E8DDD0] flex items-center justify-center text-[#2B221D] shrink-0">
                <i class="ti ti-clipboard-list text-xl"></i>
            </div>
            <div>
                <p class="text-xs text-[#5B4636] font-medium">Total Daftar</p>
                <p class="text-xl font-bold text-[#2B221D] mt-0.5"><?= count($dataPendaftaran) ?></p>
            </div>
        </div>

        <div class="bg-white p-4 rounded-xl border border-[#BFC3B1] flex items-center gap-4 shadow-sm">
            <div class="w-10 h-10 rounded-lg  bg-[#E8DDD0] flex items-center justify-center">
                <i class="ti ti-hourglass text-xl"></i>
            </div>
            <div>
                <p class="text-xs text-[#5B4636] font-medium">Menunggu</p>
                <p class="text-xl font-bold mt-0.5"><?= $jumlahMenunggu ?></p>
            </div>
        </div>
        
        <div class="bg-white p-4 rounded-xl border border-[#BFC3B1] flex items-center gap-4 shadow-sm">
            <div class="w-10 h-10 rounded-lg bg-[#E8DDD0] flex items-center justify-center">
                <i class="ti ti-loader text-xl"></i>
            </div>
            <div>
                <p class="text-xs text-[#5B4636] font-medium">Diproses</p>
                <p class="text-xl font-bold mt-0.5"><?= $jumlahDiproses ?></p>
            </div>
        </div>

        <div class="bg-white p-4 rounded-xl border border-[#BFC3B1] flex items-center gap-4 shadow-sm">
            <div class="w-10 h-10 rounded-lg bg-[#E8DDD0] flex items-center justify-center">
                <i class="ti ti-circle-check text-xl"></i>
            </div>
            <div>
                <p class="text-xs text-[#5B4636] font-medium">Selesai</p>
                <p class="text-xl font-bold mt-0.5"><?= $jumlahSelesai ?></p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="lg:col-span-2 space-y-4">
            <div class="bg-white rounded-xl border border-[#BFC3B1] overflow-hidden shadow-sm">
                <div class="px-5 py-4 border-b border-[#D8D2C6] bg-[#F5F1EC] flex justify-between items-center">
                    <div>
                        <h3 class="text-sm font-semibold text-[#2B221D]">Pendaftaran Terakhir</h3>
                        <p class="text-[11px] text-[#5B4636]">3 riwayat pengajuan dokumen kremasi terbaru Anda</p>
                    </div>
                    <a href="?page=riwayat" class="text-xs font-semibold text-[#B86E4B] hover:underline flex items-center gap-1">
                        Lihat Semua <i class="ti ti-chevron-right"></i>
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead>
                            <tr class="border-b border-[#D8D2C6] text-[#5B4636] bg-[#F5F1EC]/40 font-medium">
                                <th class="p-4">Kode</th>
                                <th class="p-4">Nama Almarhum</th>
                                <th class="p-4">Paket Layanan</th>
                                <th class="p-4">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#F5F1EC]">
                            <?php if (!empty($aktivitasTerakhir)): ?>
                                <?php foreach ($aktivitasTerakhir as $row): ?>
                                    <tr class="hover:bg-[#F5F1EC]/20 transition-colors text-[#2B221D]">
                                        <td class="p-4 font-mono font-semibold text-[#B86E4B]"><?= htmlspecialchars($row['kode_pendaftaran']) ?></td>
                                        <td class="p-4 font-medium"><?= htmlspecialchars($row['nama_almarhum']) ?></td>
                                        <td class="p-4 text-[#5B4636]"><?= htmlspecialchars($row['nama_paket']) ?></td>
                                        <td class="p-4">
                                            <?php 
                                                $status = strtolower($row['status']);
                                                $badge = 'bg-rose-50 text-rose-700 border-rose-200';
                                                if ($status === 'diproses') $badge = 'bg-amber-50 text-amber-700 border-amber-200';
                                                if ($status === 'selesai') $badge = 'bg-emerald-50 text-emerald-700 border-emerald-200';
                                            ?>
                                            <span class="px-2 py-0.5 rounded text-[10px] font-semibold border <?= $badge ?>">
                                                <?= ucfirst($status) ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="p-8 text-center text-[#5B4636]/70">
                                        <i class="ti ti-file-off text-3xl block mb-2 text-[#BFC3B1]"></i>
                                        Belum ada riwayat pengajuan pendaftaran.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="space-y-4">
            <div class="bg-white rounded-xl border border-[#BFC3B1] p-5 space-y-4 shadow-sm">
                <div class="border-b border-[#D8D2C6] pb-3">
                    <h3 class="text-sm font-semibold text-[#2B221D]">Panduan Prosedur Pemohon</h3>
                    <p class="text-[11px] text-[#5B4636]">Ikuti tahapan berikut untuk mempermudah verifikasi berkas</p>
                </div>
                
                <div class="space-y-4 relative before:absolute before:top-2 before:bottom-2 before:left-3.5 before:w-0.5 before:bg-[#D8D2C6]">
                    
                    <div class="flex gap-3 relative">
                        <div class="w-7 h-7 rounded-full bg-[#B86E4B] text-white flex items-center justify-center text-xs font-bold shrink-0 z-10 shadow-sm">1</div>
                        <div>
                            <h4 class="text-xs font-semibold text-[#2B221D]">Pilih Paket Layanan</h4>
                            <p class="text-[11px] text-[#5B4636] mt-0.5">Tinjau fasilitas upacara pada menu <span class="font-medium text-[#B86E4B]">Daftar Paket Layanan</span>.</p>
                        </div>
                    </div>
                    
                    <div class="flex gap-3 relative">
                        <div class="w-7 h-7 rounded-full bg-[#E8DDD0] text-[#2B221D] flex items-center justify-center text-xs font-bold shrink-0 z-10 shadow-sm">2</div>
                        <div>
                            <h4 class="text-xs font-semibold text-[#2B221D]">Isi Form Pendaftaran</h4>
                            <p class="text-[11px] text-[#5B4636] mt-0.5">Input data akurat almarhum & simpan untuk mendapatkan Kode Registrasi unik (`KRM`).</p>
                        </div>
                    </div>

                    <div class="flex gap-3 relative">
                        <div class="w-7 h-7 rounded-full bg-[#E8DDD0] text-[#2B221D] flex items-center justify-center text-xs font-bold shrink-0 z-10 shadow-sm">3</div>
                        <div>
                            <h4 class="text-xs font-semibold text-[#2B221D]">Validasi & Pembayaran</h4>
                            <p class="text-[11px] text-[#5B4636] mt-0.5">Pantau halaman ini secara berkala sampai status berubah menjadi 'Diproses'.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
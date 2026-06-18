<?php
// Pastikan file model paket sudah di-require di index utama atau di sini
require_once __DIR__ . '/../../../classes/PaketLayanan.php'; 

$paketModel = new PaketLayanan();
$dataPaket = $paketModel->getAll();
?>

<header class="bg-[#E8DDD0] border-b border-[#BFC3B1] px-6 py-4 flex items-center justify-between sticky top-0 z-30">
    <div>
        <h1 class="text-lg font-semibold text-[#2B221D]">Pilihan Paket Layanan</h1>
        <p class="text-xs text-[#5B4636]">Pilih paket akomodasi kremasi yang sesuai dengan kebutuhan upacara Anda</p>
    </div>
</header>

<div class="p-6 space-y-6">

    <div class="bg-white p-4 rounded-xl border border-[#BFC3B1] flex items-start gap-3 shadow-sm">
        <div class="w-8 h-8 rounded-lg bg-[#E8DDD0] flex items-center justify-center text-[#B86E4B] shrink-0 mt-0.5">
            <i class="ti ti-info-circle text-lg"></i>
        </div>
        <div class="text-xs">
            <h4 class="font-semibold text-[#2B221D]">Mengenai Komponen Paket</h4>
            <p class="text-[#5B4636] mt-0.5 leading-relaxed">Seluruh paket di bawah ini sudah mencakup pelayanan dasar kremasi. Anda dapat menekan tombol <strong class="text-[#B86E4B]">Pilih Paket</strong> untuk langsung diarahkan ke pengisian formulir data almarhum dengan paket terkait.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        <?php if (!empty($dataPaket)): ?>
            <?php foreach ($dataPaket as $paket): ?>
                <div class="bg-white rounded-xl border border-[#BFC3B1] flex flex-col justify-between overflow-hidden shadow-sm hover:shadow-md transition-all group">
                    
                    <div class="p-5 space-y-4">
                        <div class="space-y-1">
                            <span class="px-2 py-0.5 rounded bg-[#E8DDD0] text-[#2B221D] text-[10px] font-bold uppercase tracking-wider border border-[#BFC3B1]/40">
                                <?= htmlspecialchars($paket['nama_kategori']) ?>
                            </span>
                            <h3 class="text-base font-bold text-[#2B221D] pt-1 group-hover:text-[#B86E4B] transition-colors">
                                <?= htmlspecialchars($paket['nama_paket']) ?>
                            </h3>
                        </div>

                        <div class="border-y border-[#F5F1EC] py-3">
                            <p class="text-[10px] text-[#5B4636] uppercase tracking-wide font-medium">Biaya Kontribusi</p>
                            <p class="text-2xl font-bold text-[#2B221D] mt-0.5">
                                <span class="text-sm font-semibold text-[#5B4636]">Rp</span> 
                                <?= number_format($paket['harga'], 0, ',', '.') ?>
                            </p>
                        </div>

                        <div class="space-y-2.5">
                            <p class="text-xs font-semibold text-[#2B221D]">Fasilitas Termasuk:</p>
                            <ul class="space-y-2">
                                <?php 
                                    // Memecah string fasilitas berdasarkan koma atau baris baru agar menjadi list rapi
                                    $delimiter = (strpos($paket['fasilitas'], "\n") !== false) ? "\n" : ",";
                                    $listFasilitas = explode($delimiter, $paket['fasilitas']);
                                    
                                    foreach ($listFasilitas as $fasilitas): 
                                        $fasilitasClean = trim($fasilitas);
                                        if (empty($fasilitasClean)) continue;
                                ?>
                                    <li class="flex items-start gap-2.5 text-xs text-[#5B4636]">
                                        <div class="w-4 h-4 rounded-full bg-emerald-50 border border-emerald-200 flex items-center justify-center text-emerald-600 shrink-0 mt-0.5">
                                            <i class="ti ti-check text-[10px] stroke-[3]"></i>
                                        </div>
                                        <span class="leading-tight"><?= htmlspecialchars($fasilitasClean) ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>

                    <div class="p-5 bg-[#F5F1EC]/40 border-t border-[#F5F1EC]">
                        <a href="?page=pendaftaran&id_paket=<?= $paket['id_paket'] ?>" 
                           class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 bg-white hover:bg-[#B86E4B] border border-[#BFC3B1] hover:border-[#B86E4B] text-[#2B221D] hover:text-white text-xs font-semibold rounded-lg shadow-sm transition-all">
                            Pilih Paket Layanan
                            <i class="ti ti-arrow-right text-sm"></i>
                        </a>
                    </div>

                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-full bg-white rounded-xl border border-[#BFC3B1] p-12 text-center">
                <div class="w-12 h-12 rounded-full bg-[#F5F1EC] flex items-center justify-center text-[#5B4636] mx-auto mb-3">
                    <i class="ti ti-package-off text-2xl"></i>
                </div>
                <h3 class="text-sm font-semibold text-[#2B221D]">Layanan Belum Tersedia</h3>
                <p class="text-xs text-[#5B4636] max-w-sm mx-auto mt-1">Saat ini opsi paket layanan sedang diperbarui oleh admin. Silakan kembali beberapa saat lagi.</p>
            </div>
        <?php endif; ?>
    </div>

</div>
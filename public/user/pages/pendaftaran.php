<?php
require_once __DIR__ . '/../../../classes/PaketLayanan.php';
require_once __DIR__ . '/../../../classes/Pendaftaran.php';

$paketModel = new PaketLayanan();
$pendaftaranModel = new Pendaftaran();

// Ambil semua paket untuk dropdown pilihan jika user tidak lewat halaman paket
$dataPaket = $paketModel->getAll();

// Cek apakah ada parameter id_paket dari halaman sebelumnya
$idPaketTerpilih = $_GET['id_paket'] ?? null;
$paketTerpilihDetail = null;

if ($idPaketTerpilih) {
    // Cari detail paket yang dipilih untuk ringkasan di kolom kanan
    foreach ($dataPaket as $p) {
        if ($p['id_paket'] == $idPaketTerpilih) {
            $paketTerpilihDetail = $p;
            break;
        }
    }
}

// Otomatis generate kode pendaftaran baru untuk kebutuhan tampilan/hidden input
$kodeOtomatis = $pendaftaranModel->generateKode();
?>

<header class="bg-[#E8DDD0] border-b border-[#BFC3B1] px-6 py-4 flex items-center justify-between sticky top-0 z-30">
    <div>
        <h1 class="text-lg font-semibold text-[#2B221D]">Formulir Pendaftaran Kremasi</h1>
        <p class="text-xs text-[#5B4636]">Lengkapi data almarhum dan berkas pendukung dengan sebenar-benarnya</p>
    </div>
</header>

<div class="p-6">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        
        <div class="lg:col-span-2 bg-white rounded-xl border border-[#BFC3B1] overflow-hidden shadow-sm">
            <div class="px-5 py-4 border-b border-[#D8D2C6] bg-[#F5F1EC]">
                <h3 class="text-sm font-semibold text-[#2B221D]">Data Manunggal / Almarhum</h3>
                <p class="text-[11px] text-[#5B4636]">Pastikan ejaan nama sesuai dengan Akta Kematian atau KTP</p>
            </div>

            <form action="proses/pendaftaran.php?action=store" method="POST" class="p-5 space-y-4">
                <input type="hidden" name="id_user" value="<?= $authUser['data']['id_user'] ?>">
                <input type="hidden" name="kode_pendaftaran" value="<?= $kodeOtomatis ?>">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1 sm:col-span-2">
                        <label class="text-xs font-medium text-[#5B4636]">Kode Pendaftaran (Otomatis)</label>
                        <input type="text" class="w-full text-xs font-mono font-semibold bg-[#F5F1EC] text-[#B86E4B] border border-[#BFC3B1] px-3 py-2 rounded-lg cursor-not-allowed" value="<?= $kodeOtomatis ?>" readonly>
                    </div>

                    <div class="space-y-1 sm:col-span-2">
                        <label for="id_paket" class="text-xs font-medium text-[#5B4636]">Paket Layanan Kremasi <span class="text-rose-500">*</span></label>
                        <select name="id_paket" id="id_paket" required onchange="updateRingkasanPaket(this)" class="w-full text-xs text-[#2B221D] bg-white border border-[#BFC3B1] focus:border-[#B86E4B] focus:ring-1 focus:ring-[#B86E4B] px-3 py-2 rounded-lg outline-none transition-colors">
                            <option value="">-- Pilih Paket Layanan --</option>
                            <?php foreach ($dataPaket as $paket): ?>
                                <option value="<?= $paket['id_paket'] ?>" 
                                        data-harga="<?= number_format($paket['harga'], 0, ',', '.') ?>" 
                                        data-kategori="<?= htmlspecialchars($paket['nama_kategori']) ?>"
                                        data-fasilitas="<?= htmlspecialchars($paket['fasilitas']) ?>"
                                        <?= $idPaketTerpilih == $paket['id_paket'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($paket['nama_paket']) ?> — Rp <?= number_format($paket['harga'], 0, ',', '.') ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="space-y-1 sm:col-span-2">
                        <label for="nama_almarhum" class="text-xs font-medium text-[#5B4636]">Nama Lengkap Almarhum / Almarhumah <span class="text-rose-500">*</span></label>
                        <input type="text" name="nama_almarhum" id="nama_almarhum" required placeholder="Contoh: I Wayan Sudarta" class="w-full text-xs text-[#2B221D] bg-white border border-[#BFC3B1] focus:border-[#B86E4B] focus:ring-1 focus:ring-[#B86E4B] px-3 py-2 rounded-lg outline-none transition-colors">
                    </div>

                    <div class="space-y-1">
                        <label for="tanggal_lahir" class="text-xs font-medium text-[#5B4636]">Tanggal Lahir <span class="text-rose-500">*</span></label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" required class="w-full text-xs text-[#2B221D] bg-white border border-[#BFC3B1] focus:border-[#B86E4B] focus:ring-1 focus:ring-[#B86E4B] px-3 py-2 rounded-lg outline-none transition-colors">
                    </div>

                    <div class="space-y-1">
                        <label for="tanggal_meninggal" class="text-xs font-medium text-[#5B4636]">Tanggal Wafat <span class="text-rose-500">*</span></label>
                        <input type="date" name="tanggal_meninggal" id="tanggal_meninggal" required class="w-full text-xs text-[#2B221D] bg-white border border-[#BFC3B1] focus:border-[#B86E4B] focus:ring-1 focus:ring-[#B86E4B] px-3 py-2 rounded-lg outline-none transition-colors">
                    </div>

                    <div class="space-y-1 sm:col-span-2">
                        <label for="tanggal_daftar" class="text-xs font-medium text-[#5B4636]">Rencana Tanggal Pelaksanaan Kremasi <span class="text-rose-500">*</span></label>
                        <input type="date" name="tanggal_daftar" id="tanggal_daftar" required value="<?= date('Y-m-d') ?>" class="w-full text-xs text-[#2B221D] bg-white border border-[#BFC3B1] focus:border-[#B86E4B] focus:ring-1 focus:ring-[#B86E4B] px-3 py-2 rounded-lg outline-none transition-colors">
                    </div>

                    <div class="space-y-1 sm:col-span-2">
                        <label for="catatan" class="text-xs font-medium text-[#5B4636]">Catatan Tambahan Khusus (Opsional)</label>
                        <textarea name="catatan" id="catatan" rows="3" placeholder="Contoh: Keluarga request kremasi pagi pukul 08:00 WITA atau detail sarana upacara bawaan..." class="w-full text-xs text-[#2B221D] bg-white border border-[#BFC3B1] focus:border-[#B86E4B] focus:ring-1 focus:ring-[#B86E4B] px-3 py-2 rounded-lg outline-none transition-colors resize-none"></textarea>
                    </div>
                </div>

                <div class="pt-2 border-t border-[#F5F1EC] flex justify-end gap-3">
                    <button type="reset" class="px-4 py-2 bg-white border border-[#BFC3B1] text-xs font-semibold text-[#5B4636] rounded-lg hover:bg-gray-50 transition-colors">Reset Form</button>
                    <button type="submit" class="px-5 py-2 bg-[#B86E4B] border border-[#B86E4B] hover:bg-[#B86E4B]/90 text-xs font-semibold text-white rounded-lg shadow-sm transition-colors flex items-center gap-1">
                        <i class="ti ti-device-floppy"></i> Ajukan Pendaftaran
                    </button>
                </div>
            </form>
        </div>

        <div class="space-y-4">
            <div class="bg-white rounded-xl border border-[#BFC3B1] overflow-hidden shadow-sm">
                <div class="px-5 py-4 border-b border-[#D8D2C6] bg-[#F5F1EC]">
                    <h3 class="text-sm font-semibold text-[#2B221D]">Ringkasan Biaya & Layanan</h3>
                </div>
                
                <div class="p-5 space-y-4 text-xs">
                    <div id="box-info-kosong" class="<?= $paketTerpilihDetail ? 'hidden' : '' ?> text-center py-6 text-[#5B4636]/70">
                        <i class="ti ti-package text-3xl block mb-2 text-[#BFC3B1]"></i>
                        Silakan tentukan paket pada dropdown formulir untuk memetakan rincian biaya.
                    </div>

                    <div id="detail-ringkasan-paket" class="<?= !$paketTerpilihDetail ? 'hidden' : '' ?> space-y-4">
                        <div>
                            <span id="label-kategori" class="px-2 py-0.5 rounded bg-[#E8DDD0] text-[#2B221D] text-[10px] font-bold uppercase tracking-wider">
                                <?= $paketTerpilihDetail ? htmlspecialchars($paketTerpilihDetail['nama_kategori']) : '' ?>
                            </span>
                            <h4 id="label-nama-paket" class="text-base font-bold text-[#2B221D] mt-1.5">
                                <?= $paketTerpilihDetail ? htmlspecialchars($paketTerpilihDetail['nama_paket']) : '' ?>
                            </h4>
                        </div>

                        <div class="bg-[#F5F1EC]/60 border border-[#BFC3B1]/40 p-3 rounded-lg flex items-center justify-between">
                            <span class="font-medium text-[#5B4636]">Estimasi Biaya:</span>
                            <span class="font-bold text-[#2B221D] text-sm">
                                Rp <span id="label-harga"><?= $paketTerpilihDetail ? number_format($paketTerpilihDetail['harga'], 0, ',', '.') : '0' ?></span>
                            </span>
                        </div>

                        <div class="space-y-2">
                            <p class="font-semibold text-[#2B221D]">Fasilitas Utama:</p>
                            <div id="container-fasilitas" class="text-[11px] text-[#5B4636] leading-relaxed bg-[#F5F1EC]/20 p-2.5 rounded-lg border border-[#F5F1EC] max-h-40 overflow-y-auto">
                                <?php 
                                if ($paketTerpilihDetail) {
                                    echo nl2br(htmlspecialchars($paketTerpilihDetail['fasilitas']));
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
function updateRingkasanPaket(selectElement) {
    const boxKosong = document.getElementById('box-info-kosong');
    const boxDetail = document.getElementById('detail-ringkasan-paket');
    
    if (selectElement.value === "") {
        boxKosong.classList.remove('hidden');
        boxDetail.classList.add('hidden');
        return;
    }
    
    // Ambil data-attribute dari option terpilih
    const selectedOption = selectElement.options[selectElement.selectedIndex];
    const harga = selectedOption.getAttribute('data-harga');
    const kategori = selectedOption.getAttribute('data-kategori');
    const namaPaket = selectedOption.text.split(' — ')[0]; // Ambil nama paketnya saja sebelum tanda pisah harga
    const fasilitas = selectedOption.getAttribute('data-fasilitas');
    
    // Inject data ke DOM Ringkasan di sebelah kanan
    document.getElementById('label-kategori').innerText = kategori;
    document.getElementById('label-nama-paket').innerText = namaPaket;
    document.getElementById('label-harga').innerText = harga;
    
    // Format list fasilitas (mengganti koma atau newline dengan break line html)
    const fasilitasFormatted = fasilitas.replace(/,/g, '<br>• ').replace(/\n/g, '<br>• ');
    document.getElementById('container-fasilitas').innerHTML = '• ' + fasilitasFormatted;
    
    // Tampilkan panel ringkasan
    boxKosong.add('hidden');
    boxDetail.classList.remove('hidden');
}
</script>
<?php

require_once __DIR__ . '/../classes/PaketLayanan.php';
require_once __DIR__ . '/../classes/KategoriPaket.php';

$paketObj = new PaketLayanan();
$kategoriObj = new KategoriPaket();

// Ambil semua paket
$result = $paketObj->getAll();

$daftar_paket = [];

foreach ($result as $paket) {

    $kategori = $kategoriObj->getById($paket['id_kategori']);

    $paket['nama_kategori'] = $kategori['status']
        ? $kategori['data']['nama_kategori']
        : 'Umum';

    $daftar_paket[] = $paket;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paket Layanan – AgniMukti</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body class="bg-[#F4EFE8] text-[#2B221D] font-[Inter,sans-serif]">

    <?php include './header.php'; ?>

    <!-- ══════════════ HERO — background_1.png ══════════════ -->
    <section class="relative overflow-hidden bg-cover bg-center" style="background-image:linear-gradient(rgba(43,34,29,.72), rgba(91,70,54,.8)), url('./assets/background_5.png')">
        <div class="max-w-4xl mx-auto px-6 py-28 text-center">
            <span class="inline-block text-[#B86E4B] text-[0.7rem] font-semibold tracking-[0.18em] uppercase mb-5">
                Layanan Kremasi
            </span>
            <h1 class="font-[Cormorant_Garamond,serif] text-5xl md:text-6xl font-semibold leading-tight text-[#E8DDD0] mb-6">
                Penghormatan Terakhir<br class="hidden md:block">
                <em class="font-normal text-[#B86E4B]">yang Layak untuk Almarhum</em>
            </h1>
            <p class="text-sm md:text-base leading-relaxed text-[#BFC3B1] max-w-xl mx-auto mb-10">
                AgniMukti menyediakan paket layanan kremasi yang dirancang dengan penuh hormat, transparansi harga, dan kemudahan administrasi untuk keluarga yang berduka.
            </p>
            <a href="#daftar-paket"
               class="inline-block bg-[#B86E4B] hover:bg-[#a05c3a] text-white text-sm font-semibold tracking-wide py-3 px-8 rounded-sm transition-colors">
                Lihat Semua Paket
            </a>
        </div>
    </section>


    <!-- ══════════════ LIST PAKET ══════════════ -->
    <section id="daftar-paket" class="bg-[#F4EFE8]">
        <div class="max-w-6xl mx-auto px-6 py-24">

            <!-- Heading -->
            <div class="text-center mb-16">
                <span class="inline-block text-[#B86E4B] text-[0.7rem] font-semibold tracking-[0.18em] uppercase mb-3">
                    Pilihan Paket
                </span>
                <h2 class="font-[Cormorant_Garamond,serif] text-4xl font-semibold text-[#2B221D]">
                    Temukan Paket yang Sesuai
                </h2>
                <!-- flame divider -->
                <div class="flex items-center gap-4 max-w-[200px] mx-auto mt-6 mb-0">
                    <span class="flex-1 h-px bg-[#BFC3B1]"></span>
                    <svg width="18" height="22" viewBox="0 0 18 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 0C9 0 2 8 2 13C2 17.418 5.134 21 9 21C12.866 21 16 17.418 16 13C16 8 9 0 9 0Z" fill="#B86E4B" fill-opacity=".8"/>
                        <path d="M9 7C9 7 5.5 12 5.5 14.5C5.5 16.433 7.067 18 9 18C10.933 18 12.5 16.433 12.5 14.5C12.5 12 9 7 9 7Z" fill="#E8DDD0"/>
                    </svg>
                    <span class="flex-1 h-px bg-[#BFC3B1]"></span>
                </div>
            </div>

            <!-- Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <?php if (!empty($daftar_paket)): ?>

                    <?php
                    $counter = 1;
                    foreach ($daftar_paket as $paket):

                        $nomor_paket = str_pad($counter, 2, '0', STR_PAD_LEFT);

                        // Paket kedua dijadikan featured
                        $is_populer = ($counter == 2);

                        $fasilitas = array_filter(
                            array_map('trim', explode(',', $paket['fasilitas']))
                        );
                    ?>

                        <div class="relative <?= $is_populer
                            ? 'bg-[#2B221D] border border-[#B86E4B]'
                            : 'bg-white border border-[#E8DDD0]' ?>
                            p-8 rounded-sm hover:-translate-y-1 hover:shadow-lg transition-all duration-300">

                            <?php if ($is_populer): ?>
                                <span class="absolute -top-px right-6 bg-[#B86E4B] text-white text-[0.65rem] font-semibold tracking-[0.12em] uppercase px-3 py-1 rounded-b">
                                    Terpopuler
                                </span>
                            <?php endif; ?>

                            <span class="inline-block text-[#B86E4B] text-[0.7rem] font-semibold tracking-[0.18em] uppercase mb-2">
                                <?= htmlspecialchars($paket['nama_kategori']) ?> • Paket <?= $nomor_paket ?>
                            </span>

                            <h3 class="font-[Cormorant_Garamond,serif] text-3xl font-semibold <?= $is_populer ? 'text-[#E8DDD0]' : 'text-[#5B4636]' ?> mb-1">
                                <?= htmlspecialchars($paket['nama_paket']) ?>
                            </h3>

                            <p class="text-xs leading-relaxed <?= $is_populer ? 'text-[#E8DDD0]/60' : 'text-[#5B4636]/70' ?> mb-6">
                                Paket layanan kremasi yang dirancang untuk memberikan pelayanan terbaik kepada keluarga.
                            </p>

                            <div class="mb-6 pb-6 <?= $is_populer ? 'border-b border-[#E8DDD0]/20' : 'border-b border-[#E8DDD0]' ?>">
                                <span class="font-[Cormorant_Garamond,serif] text-4xl font-semibold <?= $is_populer ? 'text-[#E8DDD0]' : 'text-[#2B221D]' ?>">
                                    Rp <?= number_format($paket['harga'], 0, ',', '.') ?>
                                </span>
                            </div>

                            <ul class="space-y-3 text-sm <?= $is_populer ? 'text-[#E8DDD0]' : 'text-[#2B221D]' ?> mb-8">

                                <?php foreach ($fasilitas as $item): ?>
                                    <li class="flex items-start gap-2">
                                        <span class="text-[#B86E4B]">✦</span>
                                        <?= htmlspecialchars($item) ?>
                                    </li>
                                <?php endforeach; ?>

                            </ul>

                            <a href="./register.php?id_paket=<?= $paket['id_paket'] ?>"
                                class="block w-full text-center
                                <?= $is_populer
                                    ? 'bg-[#B86E4B] hover:bg-[#a05c3a] text-white'
                                    : 'border border-[#5B4636] text-[#5B4636] hover:bg-[#5B4636] hover:text-[#E8DDD0]' ?>
                                text-sm font-medium tracking-wide py-3 px-6 rounded-sm transition-colors">

                                Pilih Paket
                            </a>

                        </div>

                    <?php
                        $counter++;
                    endforeach;
                    ?>

                <?php else: ?>

                    <div class="col-span-3 text-center py-10 text-[#5B4636]">
                        Belum ada paket layanan tersedia.
                    </div>

                <?php endif; ?>

            </div>
        </div>
    </section>


    <!-- ══════════════ PERBANDINGAN ══════════════ -->
    <section id="perbandingan" class="bg-[#E8DDD0]">
        <div class="max-w-5xl mx-auto px-6 py-24">

            <!-- Heading -->
            <div class="text-center mb-14">
                <span class="inline-block text-[#B86E4B] text-[0.7rem] font-semibold tracking-[0.18em] uppercase mb-3">
                    Perbandingan
                </span>
                <h2 class="font-[Cormorant_Garamond,serif] text-4xl font-semibold text-[#2B221D]">
                    Detail Fitur Setiap Paket
                </h2>
                <p class="text-sm mt-3 max-w-md mx-auto text-[#5B4636]">
                    Bandingkan fitur antar paket agar keluarga dapat memilih layanan yang paling sesuai.
                </p>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full bg-white border-collapse rounded-sm overflow-hidden shadow-sm">
                    <thead>
                        <tr>
                            <th class="bg-[#F4EFE8] text-[#5B4636] font-semibold text-sm text-left px-5 py-4 border-b border-[#E8DDD0] min-w-[200px]">
                                Fitur Layanan
                            </th>
                            <th class="bg-[#2B221D] text-[#E8DDD0] text-center px-5 py-4 border-b border-[#E8DDD0] min-w-[130px]">
                                <div class="font-[Cormorant_Garamond,serif] text-lg font-semibold">Paket Pitra Pradana</div>
                                <div class="text-xs opacity-70 font-normal mt-1">Rp 3 Jt</div>
                            </th>
                            <th class="bg-[#B86E4B] text-white text-center px-5 py-4 border-b border-[#E8DDD0] min-w-[130px]">
                                <div class="font-[Cormorant_Garamond,serif] text-lg font-semibold">Paket Yadnya Madya</div>
                                <div class="text-xs opacity-80 font-normal mt-1">Rp 4 Jt</div>
                                <div class="text-xs font-semibold mt-1 text-yellow-200">★ Terpopuler</div>
                            </th>
                            <th class="bg-[#2B221D] text-[#E8DDD0] text-center px-5 py-4 border-b border-[#E8DDD0] min-w-[130px]">
                                <div class="font-[Cormorant_Garamond,serif] text-lg font-semibold">Paket Pitra Utama</div>
                                <div class="text-xs opacity-70 font-normal mt-1">Rp 6 Jt</div>
                            </th>
                            <th class="bg-[#2B221D] text-[#E8DDD0] text-center px-5 py-4 border-b border-[#E8DDD0] min-w-[130px]">
                                <div class="font-[Cormorant_Garamond,serif] text-lg font-semibold">Paket Agni Mukti Utama</div>
                                <div class="text-xs opacity-70 font-normal mt-1">Rp 8 Jt</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-[#E8DDD0]">
                            <td class="bg-[#F4EFE8] text-[#5B4636] font-medium text-sm px-5 py-4">
                                Jenis Layanan Kremasi
                            </td>
                            <td class="text-center px-5 py-4">Standar</td>
                            <td class="text-center px-5 py-4">Standar</td>
                            <td class="text-center px-5 py-4">Premium</td>
                            <td class="text-center px-5 py-4">VIP</td>
                        </tr>

                        <tr class="border-b border-[#E8DDD0]">
                            <td class="bg-[#F4EFE8] text-[#5B4636] font-medium text-sm px-5 py-4">
                                Tempat Abu
                            </td>
                            <td class="text-center px-5 py-4">Sederhana</td>
                            <td class="text-center px-5 py-4">Keluarga</td>
                            <td class="text-center px-5 py-4">Premium</td>
                            <td class="text-center px-5 py-4">Premium</td>
                        </tr>

                        <tr class="border-b border-[#E8DDD0]">
                            <td class="bg-[#F4EFE8] text-[#5B4636] font-medium text-sm px-5 py-4">
                                Sertifikat Kremasi
                            </td>
                            <td class="text-center text-[#B86E4B] px-5 py-4">✦</td>
                            <td class="text-center text-[#B86E4B] px-5 py-4">✦</td>
                            <td class="text-center text-[#B86E4B] px-5 py-4">✦</td>
                            <td class="text-center text-[#B86E4B] px-5 py-4">✦</td>
                        </tr>

                        <tr class="border-b border-[#E8DDD0]">
                            <td class="bg-[#F4EFE8] text-[#5B4636] font-medium text-sm px-5 py-4">
                                Penanganan Jenazah
                            </td>
                            <td class="text-center text-[#B86E4B] px-5 py-4">✦</td>
                            <td class="text-center text-[#B86E4B] px-5 py-4">✦</td>
                            <td class="text-center px-5 py-4">Prioritas</td>
                            <td class="text-center px-5 py-4">Prioritas</td>
                        </tr>

                        <tr class="border-b border-[#E8DDD0]">
                            <td class="bg-[#F4EFE8] text-[#5B4636] font-medium text-sm px-5 py-4">
                                Ruang Tunggu Keluarga
                            </td>
                            <td class="text-center text-[#BFC3B1] px-5 py-4">–</td>
                            <td class="text-center text-[#B86E4B] px-5 py-4">✦</td>
                            <td class="text-center px-5 py-4">Eksklusif</td>
                            <td class="text-center px-5 py-4">VIP</td>
                        </tr>

                        <tr class="border-b border-[#E8DDD0]">
                            <td class="bg-[#F4EFE8] text-[#5B4636] font-medium text-sm px-5 py-4">
                                Dokumentasi Foto
                            </td>
                            <td class="text-center text-[#BFC3B1] px-5 py-4">–</td>
                            <td class="text-center px-5 py-4">Dasar</td>
                            <td class="text-center px-5 py-4">Profesional</td>
                            <td class="text-center px-5 py-4">Profesional</td>
                        </tr>

                        <tr class="border-b border-[#E8DDD0]">
                            <td class="bg-[#F4EFE8] text-[#5B4636] font-medium text-sm px-5 py-4">
                                Dokumentasi Video
                            </td>
                            <td class="text-center text-[#BFC3B1] px-5 py-4">–</td>
                            <td class="text-center text-[#BFC3B1] px-5 py-4">–</td>
                            <td class="text-center px-5 py-4">Video Singkat</td>
                            <td class="text-center px-5 py-4">Video Lengkap</td>
                        </tr>

                        <tr class="border-b border-[#E8DDD0]">
                            <td class="bg-[#F4EFE8] text-[#5B4636] font-medium text-sm px-5 py-4">
                                Konsultasi Keluarga / Prosesi
                            </td>
                            <td class="text-center px-5 py-4">Administrasi</td>
                            <td class="text-center px-5 py-4">Prosesi</td>
                            <td class="text-center px-5 py-4">Keluarga</td>
                            <td class="text-center px-5 py-4">Pendampingan Penuh</td>
                        </tr>

                        <tr class="border-b border-[#E8DDD0]">
                            <td class="bg-[#F4EFE8] text-[#5B4636] font-medium text-sm px-5 py-4">
                                Pengantaran Abu
                            </td>
                            <td class="text-center text-[#BFC3B1] px-5 py-4">–</td>
                            <td class="text-center text-[#BFC3B1] px-5 py-4">–</td>
                            <td class="text-center text-[#BFC3B1] px-5 py-4">–</td>
                            <td class="text-center text-[#B86E4B] px-5 py-4">✦</td>
                        </tr>

                        <tr class="border-b border-[#E8DDD0]">
                            <td class="bg-[#F4EFE8] text-[#5B4636] font-medium text-sm px-5 py-4">
                                Konsumsi Keluarga
                            </td>
                            <td class="text-center text-[#BFC3B1] px-5 py-4">–</td>
                            <td class="text-center text-[#BFC3B1] px-5 py-4">–</td>
                            <td class="text-center text-[#BFC3B1] px-5 py-4">–</td>
                            <td class="text-center text-[#B86E4B] px-5 py-4">✦</td>
                        </tr>

                        <tr>
                            <td class="bg-[#F4EFE8] text-[#5B4636] font-bold text-sm px-5 py-4">
                                Total Harga
                            </td>
                            <td class="text-center font-bold text-sm text-[#2B221D] px-5 py-4">
                                Rp 3.000.000
                            </td>
                            <td class="text-center font-bold text-sm text-[#2B221D] px-5 py-4">
                                Rp 4.000.000
                            </td>
                            <td class="text-center font-bold text-sm text-[#2B221D] px-5 py-4">
                                Rp 6.000.000
                            </td>
                            <td class="text-center font-bold text-sm text-[#B86E4B] px-5 py-4">
                                Rp 8.000.000
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <p class="text-center text-xs mt-5 text-[#5B4636]/60">
                Harga belum termasuk biaya transportasi jenazah. Hubungi kami untuk informasi lebih lanjut.
            </p>
        </div>
    </section>


    <!-- ══════════════ CTA — backgound_4.png ══════════════ -->
    <section class="relative bg-cover bg-center" style="background-image:linear-gradient(rgba(91,70,54,.82), rgba(43,34,29,.85)), url('./assets/backgound_4.png')">
        <div class="max-w-2xl mx-auto px-6 py-20 text-center">
            <span class="inline-block text-[#E8DDD0]/60 text-[0.7rem] font-semibold tracking-[0.18em] uppercase mb-4">
                Mulai Sekarang
            </span>
            <h2 class="font-[Cormorant_Garamond,serif] text-4xl font-semibold text-[#E8DDD0] mb-4">
                Kami Siap Membantu Keluarga Anda
            </h2>
            <p class="text-sm leading-relaxed text-[#E8DDD0]/70 mb-10">
                Daftar sekarang dan dapatkan bantuan administrasi kremasi secara online — cepat, transparan, dan penuh hormat.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="./register.php"
                   class="inline-block bg-[#B86E4B] hover:bg-[#a05c3a] text-white text-sm font-semibold tracking-wide py-3 px-8 rounded-sm transition-colors">
                    Daftar Layanan
                </a>
                <a href="https://wa.me/62895410558960"
                   class="inline-block border border-[#E8DDD0] text-[#E8DDD0] hover:bg-[#E8DDD0] hover:text-[#2B221D] text-sm font-medium tracking-wide py-3 px-8 rounded-sm transition-colors">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </section>


    <?php include './footer.php'; ?>

    <script>
        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(a => {
            a.addEventListener('click', e => {
                e.preventDefault();
                const t = document.querySelector(a.getAttribute('href'));
                if (t) t.scrollIntoView({ behavior: 'smooth' });
            });
        });
    </script>

</body>
</html>
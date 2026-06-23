<?php

require_once __DIR__ . '/../classes/PaketLayanan.php';
require_once __DIR__ . '/../classes/KategoriPaket.php';
$paketObj = new PaketLayanan();
$kategoriObj = new KategoriPaket();

// Mengambil data secara spesifik menggunakan getById untuk ID 1, 2, dan 3
$id_target = [1, 2, 3];
$daftar_paket = [];

foreach ($id_target as $id) {
    $data_paket = $paketObj->getById($id);
    if ($data_paket) {
        // Ambil data kategori berdasarkan id_kategori yang ada di dalam paket
        $kategori_info = $kategoriObj->getById($data_paket['id_kategori']);
        
        // Jika kategori ditemukan, sisipkan nama kategorinya ke dalam array paket
        if ($kategori_info['status']) {
            $data_paket['nama_kategori'] = $kategori_info['data']['nama_kategori'];
        } else {
            $data_paket['nama_kategori'] = 'Umum'; // Fallback jika tidak ditemukan
        }
        
        $daftar_paket[] = $data_paket;
    }
}
?>

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgniMukti — Sistem Informasi Krematorium Digital</title>
    <meta name="description" content="AgniMukti adalah sistem informasi krematorium berbasis web yang membantu keluarga mengelola layanan kremasi secara digital, transparan, dan penuh hormat.">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,500;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                    primary:    { DEFAULT: '#5B4636', dark: '#3E3024', light: '#7A6049' },
                    secondary:  { DEFAULT: '#E8DDD0', dark: '#DCCDBA' },
                    accent:     { DEFAULT: '#B86E4B', dark: '#9C5639', light: '#D08F6C' },
                    supporting: { DEFAULT: '#BFC3B1', dark: '#A2A892' },
                    ink:        { DEFAULT: '#2B221D', muted: '#6B5D52' },
                    },
                    fontFamily: {
                    serif: ['"Cormorant Garamond"', 'serif'],
                    sans:  ['"Plus Jakarta Sans"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    },
                    boxShadow: {
                    soft: '0 24px 60px -24px rgba(43,34,29,0.30)',
                    card: '0 1px 2px rgba(43,34,29,0.06), 0 12px 32px -16px rgba(43,34,29,0.18)',
                    },
                    borderRadius: {
                    '4xl': '2rem',
                    },
                },
            },
        };
    </script>

    <style>
        html { scroll-behavior: smooth; }
        body { font-feature-settings: "ss01" on, "liga" on; }
        ::selection { background-color: #B86E4B; color: #fff; }

        @keyframes breathe { 0%, 100% { transform: scale(1); } 50% { transform: scale(1.045); } }
        @keyframes spin-slow { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
        @keyframes spin-slow-rev { from { transform: rotate(360deg); } to { transform: rotate(0deg); } }
        @keyframes fade-up { from { opacity: 0; transform: translateY(18px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes twinkle { 0%, 100% { opacity: .35; } 50% { opacity: 1; } }

        .animate-breathe   { animation: breathe 5s ease-in-out infinite; transform-origin: center; }
        .animate-spin-slow { animation: spin-slow 70s linear infinite; transform-origin: center; }
        .animate-spin-slow-rev { animation: spin-slow-rev 90s linear infinite; transform-origin: center; }
        .animate-twinkle   { animation: twinkle 3.2s ease-in-out infinite; }
        .animate-fade-up   { animation: fade-up .9s cubic-bezier(.16,1,.3,1) both; }
        .delay-1 { animation-delay: .12s; }
        .delay-2 { animation-delay: .24s; }
        .delay-3 { animation-delay: .36s; }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
            animation-duration: .001ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: .001ms !important;
            scroll-behavior: auto !important;
            }
        }
    </style>
    
</head>

<body class="bg-secondary text-ink font-sans antialiased">

    <!-- ============================================================ -->
    <!-- ICON SPRITE (kumpulan ikon garis kustom, dipakai via <use>)   -->
    <!-- ============================================================ -->
    <svg class="hidden" aria-hidden="true">
    <defs>
        <symbol id="icon-menu" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"><line x1="3.5" y1="6.5" x2="20.5" y2="6.5"/><line x1="3.5" y1="12" x2="20.5" y2="12"/><line x1="3.5" y1="17.5" x2="20.5" y2="17.5"/></g></symbol>
        <symbol id="icon-close" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"><line x1="6" y1="6" x2="18" y2="18"/><line x1="18" y1="6" x2="6" y2="18"/></g></symbol>
        <symbol id="icon-flame" viewBox="0 0 24 24"><path fill="currentColor" d="M12 2.5c0 0-5.5 6.3-5.5 11.5 0 3.8 2.5 7 5.5 7s5.5-3.2 5.5-7c0-2.4-1.2-4.2-2.5-5.7.2 1.7-.8 3-2 3 .3-2.3-.2-5.3-3-8.8-1.2 2.6-1 4-1 4z"/></symbol>
        <symbol id="icon-sparkle" viewBox="0 0 24 24"><path fill="currentColor" d="M12 2l1.7 7.3L21 11l-7.3 1.7L12 20l-1.7-7.3L3 11l7.3-1.7L12 2z"/></symbol>
        <symbol id="icon-doc" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M7 3.2h6.5L18 7.7V20a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4.2a1 1 0 0 1 1-1Z"/><path d="M13.4 3.2V7.7H18"/><path d="M9 13l2 2 4-4.2"/></g></symbol>
        <symbol id="icon-bell" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M18.2 8.4a6.2 6.2 0 1 0-12.4 0c0 7.1-2.8 8.9-2.8 8.9h18s-2.8-1.8-2.8-8.9Z"/><path d="M13.9 20.8a2.1 2.1 0 0 1-3.8 0"/></g></symbol>
        <symbol id="icon-shield" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2.6 19.5 6v6c0 5-3.2 8.4-7.5 9.4C7.7 20.4 4.5 17 4.5 12V6L12 2.6Z"/><path d="M8.8 12.2l2.2 2.2 4.2-4.4"/></g></symbol>
        <symbol id="icon-heart" viewBox="0 0 24 24"><path fill="currentColor" d="M12 20.8s-7.4-4.5-9.8-9.3C.7 7.7 2.9 4 6.6 4c2 0 3.5 1.2 4.4 2.7C11.9 5.2 13.4 4 15.4 4c3.7 0 5.9 3.7 4.4 7.5-2.4 4.8-7.8 9.3-7.8 9.3Z"/></symbol>
        <symbol id="icon-leaf" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M10.8 20.6c-4-1-6.9-4.8-6.9-9.6C3.9 6.4 7.7 3.4 12.6 3.4c4.9 0 7.7 2.9 7.7 7.7 0 4.9-3.9 8.7-9.5 9.5Z"/><path d="M10.8 20.6c0-6.9 2.9-11.7 8.7-14.6"/></g></symbol>
        <symbol id="icon-users" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="8" r="3"/><path d="M3.3 20c0-3.4 2.6-6 5.7-6s5.7 2.6 5.7 6"/><circle cx="17.2" cy="9.2" r="2.3"/><path d="M15.3 14.3c2.6.4 4.6 2.7 4.6 5.7"/></g></symbol>
        <symbol id="icon-pin" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21.5s7.2-6.8 7.2-12.5a7.2 7.2 0 1 0-14.4 0c0 5.7 7.2 12.5 7.2 12.5Z"/><circle cx="12" cy="9" r="2.6"/></g></symbol>
        <symbol id="icon-phone" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" d="M5.2 4h3l1.7 4.3-2.4 1.6a12.4 12.4 0 0 0 6.2 6.2l1.6-2.4 4.3 1.7v3a1.8 1.8 0 0 1-1.9 1.8C9.8 19.8 4.2 14.2 3.4 6.9 3.3 5.4 4 4 5.2 4Z"/></symbol>
        <symbol id="icon-mail" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5.2" width="18" height="13.6" rx="2"/><path d="M3.4 6.6 12 13l8.6-6.4"/></g></symbol>
        <symbol id="icon-clock" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7.2V12l3.4 2"/></g></symbol>
        <symbol id="icon-arrow" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="12" x2="19.5" y2="12"/><path d="M13.5 6l6 6-6 6"/></g></symbol>
    </defs>
    </svg>

 
 

    <!-- ============================================================ -->
    <!-- NAVBAR                                                        -->
    <!-- ============================================================ -->
    <?php include 'header.php'; ?>
    

    <main id="konten">

        <!-- ============================================================ -->
        <!-- HERO                                                          -->
        <!-- ============================================================ -->
        <section class="relative overflow-hidden">
            <img src="assets\pura_1.png"
            class="absolute inset-0 h-full w-full object-cover opacity-80">

            <div class="max-w-7xl mx-auto px-6 lg:px-10 pt-14 pb-20 lg:pt-20 lg:pb-28 relative">
                <div class="grid lg:grid-cols-2 gap-14 lg:gap-10 items-center">

                    
        
                    <!-- Text -->
                    <div class="animate-fade-up">
                        <span class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-[0.2em] text-accent">
                            <svg class="w-3.5 h-3.5"><use href="#icon-flame"/></svg>
                            Sistem Informasi Krematorium Digital
                        </span>
                        <h1 class="mt-5 font-serif font-semibold text-4xl sm:text-5xl lg:text-[3.4rem] leading-[1.1] text-ink">
                            Mendampingi Perjalanan Terakhir dengan Tenang &amp; Penuh Hormat
                        </h1>
                        <p class="mt-6 text-base sm:text-lg text-ink-muted leading-relaxed max-w-xl">
                            AgniMukti membantu keluarga mengelola seluruh proses layanan kremasi secara digital — mulai dari administrasi dokumen, penjadwalan, hingga pemantauan status secara real-time. Satu sistem yang menjaga setiap langkah tetap tenang dan bermartabat.
                        </p>

                        <div class="mt-8 flex flex-wrap items-center gap-4">
                            <a href="#paket" class="inline-flex items-center justify-center gap-2 rounded-full bg-accent px-7 py-3.5 text-sm font-semibold text-white shadow-soft hover:bg-accent-dark transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-accent focus-visible:ring-offset-2 focus-visible:ring-offset-secondary">
                                Lihat Paket Layanan
                                <svg class="w-4 h-4"><use href="#icon-arrow"/></svg>
                            </a>
                            <a href="#kontak" class="inline-flex items-center justify-center gap-2 rounded-full border-2 border-primary/25 px-7 py-3.5 text-sm font-semibold text-primary hover:border-primary hover:bg-primary/5 transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 focus-visible:ring-offset-secondary">
                                Hubungi Kami
                            </a>
                        </div>

                        <div class="mt-9 flex flex-wrap items-center gap-x-6 gap-y-2 text-sm text-ink-muted">
                            <span class="inline-flex items-center gap-2"><svg class="w-4 h-4 text-accent"><use href="#icon-sparkle"/></svg>Proses Bermartabat</span>
                            <span class="inline-flex items-center gap-2"><svg class="w-4 h-4 text-accent"><use href="#icon-sparkle"/></svg>Administrasi Resmi &amp; Lengkap</span>
                            <span class="inline-flex items-center gap-2"><svg class="w-4 h-4 text-accent"><use href="#icon-sparkle"/></svg>Status Real-Time</span>
                        </div>
                    </div>
                </div> 
            </div> 
        </section>

        <!-- ============================================================ -->
        <!-- TENTANG KAMI                                                  -->
        <!-- ============================================================ -->
        <section id="tentang" class="bg-white">
            <div class="max-w-7xl mx-auto px-6 lg:px-10 py-20 lg:py-28">
                <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">

                    <div>
                        <span class="text-xs font-bold uppercase tracking-[0.2em] text-accent">Tentang Kami</span>
                        <h2 class="mt-4 font-serif font-semibold text-3xl sm:text-4xl lg:text-[2.6rem] leading-tight text-ink">
                        Melayani dengan Hati, Mendampingi dengan Profesional
                        </h2>
                        <p class="mt-6 text-base sm:text-lg text-ink-muted leading-relaxed">
                        AgniMukti hadir untuk menyederhanakan proses layanan kremasi bagi keluarga yang sedang berduka. Melalui sistem digital yang transparan, setiap tahapan — mulai dari administrasi, penjadwalan, hingga pelaksanaan — berjalan rapi, bermartabat, dan mudah dipantau langsung oleh keluarga.
                        </p>

                        <div class="mt-7 flex flex-wrap gap-3">
                            <span class="inline-flex items-center gap-1.5 rounded-full border border-primary/15 bg-secondary/60 px-4 py-1.5 text-sm font-semibold text-primary">
                                <svg class="w-3.5 h-3.5 text-accent"><use href="#icon-sparkle"/></svg>Transparan
                            </span>
                            <span class="inline-flex items-center gap-1.5 rounded-full border border-primary/15 bg-secondary/60 px-4 py-1.5 text-sm font-semibold text-primary">
                                <svg class="w-3.5 h-3.5 text-accent"><use href="#icon-sparkle"/></svg>Profesional
                            </span>
                            <span class="inline-flex items-center gap-1.5 rounded-full border border-primary/15 bg-secondary/60 px-4 py-1.5 text-sm font-semibold text-primary">
                                <svg class="w-3.5 h-3.5 text-accent"><use href="#icon-sparkle"/></svg>Penuh Empati
                            </span>
                        </div>

                        <a href="tentang.php" class="mt-9 inline-flex items-center gap-2 rounded-full bg-primary px-7 py-3.5 text-sm font-semibold text-white shadow-soft hover:bg-primary-dark transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 focus-visible:ring-offset-white">
                        Selengkapnya Tentang Kami
                        <svg class="w-4 h-4"><use href="#icon-arrow"/></svg>
                        </a>
                    </div>

                    <!-- Quote card -->
                    <div class="relative rounded-4xl bg-primary p-10 sm:p-12 shadow-soft overflow-hidden">

                        <img src="assets\pura_2.png" class= "absolute right-0 top-0 h-full w-full opacity-70">

                        <svg class="absolute -bottom-8 -right-6 w-44 h-44 text-white/5" aria-hidden="true"><use href="#icon-flame"/></svg>
                        <svg class="w-8 h-8 text-accent-light relative"><use href="#icon-flame"/></svg>
                        <p class="relative mt-6 font-serif italic text-2xl sm:text-3xl leading-snug text-[#FFFFFF]">
                        "Agni menyucikan, Mukti membebaskan."
                        </p>
                        <p class="relative mt-5 text-sm sm:text-base text-[#FFFFFF]/80 leading-relaxed">
                        Dua makna yang menjadi dasar setiap layanan kami — proses yang murni, dan kepergian yang tenang.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================================ -->
        <!-- MENGAPA MEMILIH KAMI                                          -->
        <!-- ============================================================ -->
        <section class="bg-supporting/15">
            <div class="max-w-7xl mx-auto px-6 lg:px-10 py-20 lg:py-28">
                <div class="max-w-2xl mx-auto text-center">
                    <span class="text-xs font-bold uppercase tracking-[0.2em] text-accent">Mengapa Memilih Kami</span>
                    <h2 class="mt-4 font-serif font-semibold text-3xl sm:text-4xl lg:text-[2.6rem] leading-tight text-ink">
                        Kepercayaan Keluarga adalah Prioritas Kami
                    </h2>
                    <p class="mt-5 text-base sm:text-lg text-ink-muted leading-relaxed">
                        Kami memahami momen ini bukan sekadar proses administratif, melainkan bagian dari penghormatan terakhir bagi yang terkasih.
                    </p>
                </div>

                <div class="mt-14 grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

                    <div class="rounded-3xl bg-white p-7 shadow-card hover:-translate-y-1 transition-transform">
                        <span class="grid place-items-center w-12 h-12 rounded-2xl bg-accent/10 text-accent"><svg class="w-6 h-6"><use href="#icon-doc"/></svg></span>
                        <h3 class="mt-5 font-serif font-semibold text-xl text-ink">Administrasi Digital Terpadu</h3>
                        <p class="mt-2.5 text-sm text-ink-muted leading-relaxed">Pengurusan dokumen resmi dilakukan secara digital sehingga lebih cepat dan tanpa proses berbelit.</p>
                    </div>

                    <div class="rounded-3xl bg-white p-7 shadow-card hover:-translate-y-1 transition-transform">
                        <span class="grid place-items-center w-12 h-12 rounded-2xl bg-accent/10 text-accent"><svg class="w-6 h-6"><use href="#icon-bell"/></svg></span>
                        <h3 class="mt-5 font-serif font-semibold text-xl text-ink">Notifikasi Status Real-Time</h3>
                        <p class="mt-2.5 text-sm text-ink-muted leading-relaxed">Keluarga dapat memantau setiap tahapan layanan kapan pun dibutuhkan, tanpa harus menunggu kabar.</p>
                    </div>

                    <div class="rounded-3xl bg-white p-7 shadow-card hover:-translate-y-1 transition-transform">
                        <span class="grid place-items-center w-12 h-12 rounded-2xl bg-accent/10 text-accent"><svg class="w-6 h-6"><use href="#icon-heart"/></svg></span>
                        <h3 class="mt-5 font-serif font-semibold text-xl text-ink">Proses yang Bermartabat</h3>
                        <p class="mt-2.5 text-sm text-ink-muted leading-relaxed">Setiap tahapan layanan dijalankan dengan kehati-hatian dan penghormatan penuh bagi almarhum.</p>
                    </div>

                    <div class="rounded-3xl bg-white p-7 shadow-card hover:-translate-y-1 transition-transform">
                        <span class="grid place-items-center w-12 h-12 rounded-2xl bg-accent/10 text-accent"><svg class="w-6 h-6"><use href="#icon-shield"/></svg></span>
                        <h3 class="mt-5 font-serif font-semibold text-xl text-ink">Tim Berpengalaman</h3>
                        <p class="mt-2.5 text-sm text-ink-muted leading-relaxed">Didampingi oleh petugas yang profesional dan terlatih di setiap langkah proses.</p>
                    </div>

                    <div class="rounded-3xl bg-white p-7 shadow-card hover:-translate-y-1 transition-transform">
                        <span class="grid place-items-center w-12 h-12 rounded-2xl bg-accent/10 text-accent"><svg class="w-6 h-6"><use href="#icon-users"/></svg></span>
                        <h3 class="mt-5 font-serif font-semibold text-xl text-ink">Ruang Tunggu Keluarga</h3>
                        <p class="mt-2.5 text-sm text-ink-muted leading-relaxed">Fasilitas yang nyaman dan tenang bagi keluarga yang menunggu selama proses berlangsung.</p>
                    </div>

                    <div class="rounded-3xl bg-white p-7 shadow-card hover:-translate-y-1 transition-transform">
                        <span class="grid place-items-center w-12 h-12 rounded-2xl bg-accent/10 text-accent"><svg class="w-6 h-6"><use href="#icon-leaf"/></svg></span>
                        <h3 class="mt-5 font-serif font-semibold text-xl text-ink">Pilihan Paket Fleksibel</h3>
                        <p class="mt-2.5 text-sm text-ink-muted leading-relaxed">Tersedia beberapa pilihan paket layanan yang dapat disesuaikan dengan kebutuhan keluarga.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================================ -->
        <!-- PAKET                                                         -->
        <!-- ============================================================ -->
        <section id="paket" class="bg-secondary">
            <div class="max-w-7xl mx-auto px-6 lg:px-10 py-20 lg:py-28">
                <div class="max-w-2xl mx-auto text-center">
                    <span class="text-xs font-bold uppercase tracking-[0.2em] text-accent">Paket Layanan</span>
                    <h2 class="mt-4 font-serif font-semibold text-3xl sm:text-4xl lg:text-[2.6rem] leading-tight text-ink">
                        Pilih Paket Sesuai Kebutuhan Keluarga
                    </h2>
                    <p class="mt-5 text-base sm:text-lg text-ink-muted leading-relaxed">
                        Setiap paket dirancang untuk memberikan pendampingan yang sesuai, tanpa mengurangi rasa hormat dalam prosesnya.
                    </p>
                </div>

                <div class="mt-14 grid lg:grid-cols-3 gap-6 lg:gap-7 items-start">
                    <?php 
                    if (!empty($daftar_paket)): 
                        $counter = 1;
                        foreach ($daftar_paket as $paket): 
                            $nomor_paket = str_pad($counter, 2, '0', STR_PAD_LEFT);
                            $is_populer = ($paket['nama_paket'] === 'Madya' || $paket['id_paket'] == 2); 

                            // Pecah fasilitas berdasarkan koma
                            $fasilitas_list = array_filter(array_map('trim', explode(',', $paket['fasilitas'])));
                    ?>
                            
                            <div class="<?= $is_populer ? 'relative rounded-4xl bg-primary p-9 shadow-soft h-full lg:-translate-y-3' : 'rounded-4xl bg-white p-9 shadow-card h-full' ?>">
                                
                                <?php if ($is_populer): ?>
                                    <span class="absolute top-7 right-7 rounded-full bg-accent px-3.5 py-1 text-[11px] font-bold uppercase tracking-wider text-white">Terpopuler</span>
                                <?php endif; ?>

                                <span class="text-xs font-bold uppercase tracking-[0.2em] <?= $is_populer ? 'text-accent-light' : 'text-accent' ?>">
                                    <?= htmlspecialchars($paket['nama_kategori']) ?> • Paket <?= $nomor_paket ?>
                                </span>
                                
                                <h3 class="mt-2 font-serif font-semibold text-3xl <?= $is_populer ? 'text-secondary' : 'text-ink' ?>">
                                    <?= htmlspecialchars($paket['nama_paket']) ?>
                                </h3>
                                
                                <p class="mt-2 text-lg font-bold <?= $is_populer ? 'text-white' : 'text-accent' ?>">
                                    Rp <?= number_format($paket['harga'], 0, ',', '.') ?>
                                </p>

                                <div class="mt-5 h-px <?= $is_populer ? 'bg-white/10' : 'bg-primary/10' ?>"></div>
                                
                                <ul class="mt-6 space-y-3.5 text-sm font-medium <?= $is_populer ? 'text-secondary' : 'text-ink' ?>">
                                    <?php foreach ($fasilitas_list as $fs): ?>
                                        <li class="flex items-start gap-2.5">
                                            <svg class="w-4 h-4 mt-0.5 shrink-0 <?= $is_populer ? 'text-accent-light' : 'text-accent' ?>">
                                                <use href="#icon-sparkle"/>
                                            </svg>
                                            <?= htmlspecialchars($fs) ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                    <?php 
                        $counter++;
                        endforeach; 
                    else:
                    ?>
                        <div class="col-span-3 text-center py-10 text-ink-muted">
                            Gagal memuat paket layanan (ID 1, 2, 3 tidak ditemukan).
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="mt-14 w-full text-center">
                    <a href="paket.php" class="inline-flex items-center gap-2 rounded-full bg-accent px-8 py-3.5 text-sm font-semibold text-white shadow-soft hover:bg-accent-dark transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-accent focus-visible:ring-offset-2 focus-visible:ring-offset-secondary">
                        Lihat Semua Paket &amp; Harga
                        <svg class="w-4 h-4"><use href="#icon-arrow"/></svg>
                    </a>
                </div>
            </div>
        </section>

        <!-- ============================================================ -->
        <!-- KONTAK                                                        -->
        <!-- ============================================================ -->
        <section id="kontak" class="bg-white">
            <div class="max-w-7xl mx-auto px-6 lg:px-10 py-20 lg:py-28">
                <div class="max-w-2xl mx-auto text-center">
                    <span class="text-xs font-bold uppercase tracking-[0.2em] text-accent">Kontak</span>
                    <h2 class="mt-4 font-serif font-semibold text-3xl sm:text-4xl lg:text-[2.6rem] leading-tight text-ink">
                        Kami Siap Membantu Anda
                    </h2>
                    <p class="mt-5 text-base sm:text-lg text-ink-muted leading-relaxed">
                        Tim kami siap memberikan informasi dan pendampingan kapan pun Anda membutuhkan.
                    </p>
                </div>

                <div class="mt-14 grid sm:grid-cols-2 lg:grid-cols-4 gap-5">

                    <div class="rounded-3xl border border-primary/10 bg-secondary/40 p-7">
                        <span class="grid place-items-center w-11 h-11 rounded-xl bg-primary text-secondary"><svg class="w-5 h-5"><use href="#icon-pin"/></svg></span>
                        <h3 class="mt-5 font-semibold text-ink">Alamat</h3>
                        <p class="mt-1.5 text-sm text-ink-muted leading-relaxed">Jl. Mahendradatta No. 88,<br>Denpasar, Bali 80119</p>
                    </div>

                    <div class="rounded-3xl border border-primary/10 bg-secondary/40 p-7">
                        <span class="grid place-items-center w-11 h-11 rounded-xl bg-primary text-secondary"><svg class="w-5 h-5"><use href="#icon-phone"/></svg></span>
                        <h3 class="mt-5 font-semibold text-ink">Telepon</h3>
                        <p class="mt-1.5 text-sm text-ink-muted leading-relaxed">WA: +62 812-3456-7890</p>
                    </div>

                    <div class="rounded-3xl border border-primary/10 bg-secondary/40 p-7">
                        <span class="grid place-items-center w-11 h-11 rounded-xl bg-primary text-secondary"><svg class="w-5 h-5"><use href="#icon-mail"/></svg></span>
                        <h3 class="mt-5 font-semibold text-ink">Email</h3>
                        <p class="mt-1.5 text-sm text-ink-muted leading-relaxed">agnimukti@gmail.com</p>
                    </div>

                    <div class="rounded-3xl border border-primary/10 bg-secondary/40 p-7">
                        <span class="grid place-items-center w-11 h-11 rounded-xl bg-primary text-secondary"><svg class="w-5 h-5"><use href="#icon-clock"/></svg></span>
                        <h3 class="mt-5 font-semibold text-ink">Jam Operasional</h3>
                        <p class="mt-1.5 text-sm text-ink-muted leading-relaxed">Senin – Sabtu: 08.00–17.00 WITA<br>Layanan Darurat: 24 Jam</p>
                    </div>
                </div>

            </div>
        </section>

        <!-- ============================================================ -->
        <!-- CTA                                                           -->
        <!-- ============================================================ -->
        <section class="bg-secondary">
            <div class="max-w-7xl mx-auto mt-20 px-6 lg:px-10 pb-20 lg:pb-28">
                
                <div class="relative overflow-hidden rounded-4xl bg-[#5B4636] px-8 py-16 sm:px-16 sm:py-20 text-center">
                    <img src="assets\pura_3.png" class="absolute right-0 top-0 h-full w-full opacity-40" >

                    <div class="pointer-events-none absolute -top-16 -left-10 w-64 h-64 rounded-full bg-accent/20 blur-3xl"></div>
                    <div class="pointer-events-none absolute -bottom-20 -right-10 w-72 h-72 rounded-full bg-supporting/10 blur-3xl"></div>

                    <svg class="relative mx-auto w-9 h-9 text-accent-light"><use href="#icon-flame"/></svg>
                    <h2 class="relative mt-6 font-serif font-semibold text-3xl sm:text-4xl lg:text-[2.6rem] leading-tight text-[#FFFFFF] max-w-2xl mx-auto">
                        Hadirkan Ketenangan di Setiap Langkah Perpisahan
                    </h2>
                    <p class="relative mt-5 text-base sm:text-lg text-[#FFFFFF]/90 max-w-xl mx-auto leading-relaxed">
                        Hubungi tim AgniMukti untuk konsultasi layanan kremasi yang sesuai dengan kebutuhan keluarga Anda.
                    </p>
                    <a href="https://wa.me/62895410558960" class="relative mt-9 inline-flex items-center gap-2 rounded-full bg-accent px-8 py-3.5 text-sm font-semibold text-white shadow-soft hover:bg-accent-dark transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-accent-light focus-visible:ring-offset-2 focus-visible:ring-offset-primary">
                        Hubungi Kami Sekarang
                        <svg class="w-4 h-4"><use href="#icon-arrow"/></svg>
                    </a>
                </div>
            </div>
        </section>

    </main>

    <!-- ============================================================ -->
    <!-- FOOTER                                                        -->
    <!-- ============================================================ -->
    <?php include './footer.php'; ?>

</body>
</html>

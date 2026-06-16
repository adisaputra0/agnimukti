<!-- Topbar -->
<header class="bg-[#E8DDD0] border-b border-[#BFC3B1] px-6 py-4 flex items-center justify-between sticky top-0 z-30">
    <div>
        <h1 class="text-lg font-semibold text-[#2B221D]">Dashboard</h1>
        <p class="text-xs text-[#5B4636]">Selamat datang kembali, Administrator</p>
    </div>
    <div class="flex items-center gap-3">
        <button class="relative text-[#5B4636] hover:text-[#2B221D] p-2 rounded-lg hover:bg-[#D8D2C6] transition-colors">
            <i class="ti ti-bell text-xl" aria-hidden="true"></i>
            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-[#B86E4B] rounded-full"></span>
        </button>
        <div class="w-9 h-9 rounded-full bg-[#BFC3B1] flex items-center justify-center text-[#5B4636] font-semibold text-sm">
            A
        </div>
    </div>
</header>

<!-- Page Body -->
<main class="flex-1 p-6 space-y-6">

    <!-- Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">

        <!-- Total Admin -->
        <div class="bg-white rounded-xl border border-[#BFC3B1] p-5">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-[#5B4636]">Total Admin</p>
                <div class="w-10 h-10 rounded-lg bg-[#E8DDD0] flex items-center justify-center">
                    <i class="ti ti-shield-check text-[#B86E4B] text-xl" aria-hidden="true"></i>
                </div>
            </div>
            <p class="text-3xl font-semibold text-[#2B221D]">1</p>
            <p class="text-xs text-[#5B4636] mt-1">Super admin aktif</p>
        </div>

        <!-- Total Pemohon -->
        <div class="bg-white rounded-xl border border-[#BFC3B1] p-5">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-[#5B4636]">Total Pemohon</p>
                <div class="w-10 h-10 rounded-lg bg-[#E8DDD0] flex items-center justify-center">
                    <i class="ti ti-users text-[#5B4636] text-xl" aria-hidden="true"></i>
                </div>
            </div>
            <p class="text-3xl font-semibold text-[#2B221D]">2</p>
            <p class="text-xs text-[#5B4636] mt-1">Pengguna terdaftar</p>
        </div>

        <!-- Total Paket -->
        <div class="bg-white rounded-xl border border-[#BFC3B1] p-5">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-[#5B4636]">Total Paket</p>
                <div class="w-10 h-10 rounded-lg bg-[#E8DDD0] flex items-center justify-center">
                    <i class="ti ti-package text-[#5B4636] text-xl" aria-hidden="true"></i>
                </div>
            </div>
            <p class="text-3xl font-semibold text-[#2B221D]">6</p>
            <p class="text-xs text-[#5B4636] mt-1">Paket layanan tersedia</p>
        </div>

        <!-- Total Pendaftaran -->
        <div class="bg-white rounded-xl border border-[#BFC3B1] p-5">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-[#5B4636]">Total Pendaftaran</p>
                <div class="w-10 h-10 rounded-lg bg-[#E8DDD0] flex items-center justify-center">
                    <i class="ti ti-clipboard-list text-[#B86E4B] text-xl" aria-hidden="true"></i>
                </div>
            </div>
            <p class="text-3xl font-semibold text-[#2B221D]">2</p>
            <p class="text-xs text-[#5B4636] mt-1">Pendaftaran masuk</p>
        </div>

    </div>

    <!-- Tables Row -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

        <!-- Tabel Pendaftaran Terbaru -->
        <div class="bg-white rounded-xl border border-[#BFC3B1]">
            <div class="px-5 py-4 border-b border-[#D8D2C6] flex items-center justify-between">
                <h2 class="text-sm font-semibold text-[#2B221D]">Pendaftaran Terbaru</h2>
                <a href="#" class="text-xs text-[#B86E4B] hover:underline">Lihat semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-[#F5F1EC] text-left text-xs text-[#5B4636] uppercase tracking-wide">
                            <th class="px-5 py-3 font-medium">Kode</th>
                            <th class="px-5 py-3 font-medium">Almarhum</th>
                            <th class="px-5 py-3 font-medium">Status</th>
                            <th class="px-5 py-3 font-medium">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#D8D2C6]">
                        <tr class="hover:bg-[#F5F1EC] transition-colors">
                            <td class="px-5 py-3 font-mono text-xs text-[#5B4636]">KRM001</td>
                            <td class="px-5 py-3 text-[#2B221D]">I Wayan Sudarma</td>
                            <td class="px-5 py-3">
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-[#E8DDD0] text-[#B86E4B]">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#B86E4B]"></span>
                                    Menunggu
                                </span>
                            </td>
                            <td class="px-5 py-3 text-[#5B4636] text-xs">02 Jun 2026</td>
                        </tr>

                        <tr class="hover:bg-[#F5F1EC] transition-colors">
                            <td class="px-5 py-3 font-mono text-xs text-[#5B4636]">KRM002</td>
                            <td class="px-5 py-3 text-[#2B221D]">Ni Ketut Arini</td>
                            <td class="px-5 py-3">
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-[#BFC3B1] text-[#5B4636]">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#5B4636]"></span>
                                    Diproses
                                </span>
                            </td>
                            <td class="px-5 py-3 text-[#5B4636] text-xs">06 Jun 2026</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tabel Pembayaran Terbaru -->
        <div class="bg-white rounded-xl border border-[#BFC3B1]">
            <div class="px-5 py-4 border-b border-[#D8D2C6] flex items-center justify-between">
                <h2 class="text-sm font-semibold text-[#2B221D]">Status Pembayaran</h2>
                <a href="#" class="text-xs text-[#B86E4B] hover:underline">Lihat semua</a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-[#F5F1EC] text-left text-xs text-[#5B4636] uppercase tracking-wide">
                            <th class="px-5 py-3 font-medium">Kode</th>
                            <th class="px-5 py-3 font-medium">Total</th>
                            <th class="px-5 py-3 font-medium">Metode</th>
                            <th class="px-5 py-3 font-medium">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#D8D2C6]">
                        <tr class="hover:bg-[#F5F1EC] transition-colors">
                            <td class="px-5 py-3 font-mono text-xs text-[#5B4636]">KRM001</td>
                            <td class="px-5 py-3 text-[#2B221D] font-medium">Rp 3.000.000</td>
                            <td class="px-5 py-3 text-[#5B4636] text-xs">Transfer</td>
                            <td class="px-5 py-3">
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-[#E8DDD0] text-[#B86E4B]">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#B86E4B]"></span>
                                    Menunggu Verifikasi
                                </span>
                            </td>
                        </tr>

                        <tr class="hover:bg-[#F5F1EC] transition-colors">
                            <td class="px-5 py-3 font-mono text-xs text-[#5B4636]">KRM002</td>
                            <td class="px-5 py-3 text-[#2B221D] font-medium">Rp 6.000.000</td>
                            <td class="px-5 py-3 text-[#5B4636] text-xs">QRIS</td>
                            <td class="px-5 py-3">
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-[#BFC3B1] text-[#2B221D]">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#5B4636]"></span>
                                    Lunas
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Paket Layanan -->
    <div class="bg-white rounded-xl border border-[#BFC3B1]">
        <div class="px-5 py-4 border-b border-[#D8D2C6] flex items-center justify-between">
            <h2 class="text-sm font-semibold text-[#2B221D]">Paket Layanan</h2>
            <a href="#" class="text-xs text-[#B86E4B] hover:underline">Kelola paket</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 p-5">

            <div class="border border-[#BFC3B1] rounded-lg p-4 hover:border-[#B86E4B] transition-colors">
                <div class="flex items-start justify-between mb-2">
                    <div>
                        <span class="text-xs bg-[#E8DDD0] text-[#5B4636] px-2 py-0.5 rounded-full">Standar</span>
                        <p class="text-sm font-medium text-[#2B221D] mt-2">Paket Kremasi Standar</p>
                    </div>
                    <i class="ti ti-flame text-[#B86E4B] text-xl" aria-hidden="true"></i>
                </div>
                <p class="text-xs text-[#5B4636] mb-3">Kremasi, sertifikat kremasi, tempat abu sederhana</p>
                <p class="text-base font-semibold text-[#B86E4B]">Rp 3.000.000</p>
            </div>

            <div class="border border-[#BFC3B1] rounded-lg p-4 hover:border-[#B86E4B] transition-colors">
                <div class="flex items-start justify-between mb-2">
                    <div>
                        <span class="text-xs bg-[#E8DDD0] text-[#5B4636] px-2 py-0.5 rounded-full">Standar</span>
                        <p class="text-sm font-medium text-[#2B221D] mt-2">Paket Kremasi Keluarga</p>
                    </div>
                    <i class="ti ti-flame text-[#B86E4B] text-xl" aria-hidden="true"></i>
                </div>
                <p class="text-xs text-[#5B4636] mb-3">Kremasi, ruang tunggu keluarga, tempat abu</p>
                <p class="text-base font-semibold text-[#B86E4B]">Rp 4.000.000</p>
            </div>

            <div class="border border-[#BFC3B1] rounded-lg p-4 hover:border-[#B86E4B] transition-colors">
                <div class="flex items-start justify-between mb-2">
                    <div>
                        <span class="text-xs bg-[#BFC3B1] text-[#5B4636] px-2 py-0.5 rounded-full">Premium</span>
                        <p class="text-sm font-medium text-[#2B221D] mt-2">Paket Kremasi Lengkap</p>
                    </div>
                    <i class="ti ti-flame text-[#B86E4B] text-xl" aria-hidden="true"></i>
                </div>
                <p class="text-xs text-[#5B4636] mb-3">Kremasi, dokumentasi foto, tempat abu premium</p>
                <p class="text-base font-semibold text-[#B86E4B]">Rp 6.000.000</p>
            </div>

            <div class="border border-[#BFC3B1] rounded-lg p-4 hover:border-[#B86E4B] transition-colors">
                <div class="flex items-start justify-between mb-2">
                    <div>
                        <span class="text-xs bg-[#BFC3B1] text-[#5B4636] px-2 py-0.5 rounded-full">Premium</span>
                        <p class="text-sm font-medium text-[#2B221D] mt-2">Paket Kremasi VIP</p>
                    </div>
                    <i class="ti ti-crown text-[#B86E4B] text-xl" aria-hidden="true"></i>
                </div>
                <p class="text-xs text-[#5B4636] mb-3">Kremasi VIP, dokumentasi foto & video, pengantaran abu</p>
                <p class="text-base font-semibold text-[#B86E4B]">Rp 8.000.000</p>
            </div>

            <div class="border border-[#BFC3B1] rounded-lg p-4 hover:border-[#B86E4B] transition-colors">
                <div class="flex items-start justify-between mb-2">
                    <div>
                        <span class="text-xs bg-[#E8DDD0] text-[#5B4636] px-2 py-0.5 rounded-full">Tambahan</span>
                        <p class="text-sm font-medium text-[#2B221D] mt-2">Dokumentasi Foto & Video</p>
                    </div>
                    <i class="ti ti-camera text-[#B86E4B] text-xl" aria-hidden="true"></i>
                </div>
                <p class="text-xs text-[#5B4636] mb-3">Dokumentasi selama prosesi kremasi</p>
                <p class="text-base font-semibold text-[#B86E4B]">Rp 500.000</p>
            </div>

            <div class="border border-[#BFC3B1] rounded-lg p-4 hover:border-[#B86E4B] transition-colors">
                <div class="flex items-start justify-between mb-2">
                    <div>
                        <span class="text-xs bg-[#E8DDD0] text-[#5B4636] px-2 py-0.5 rounded-full">Tambahan</span>
                        <p class="text-sm font-medium text-[#2B221D] mt-2">Pengantaran Abu</p>
                    </div>
                    <i class="ti ti-truck-delivery text-[#B86E4B] text-xl" aria-hidden="true"></i>
                </div>
                <p class="text-xs text-[#5B4636] mb-3">Layanan pengantaran abu ke alamat keluarga</p>
                <p class="text-base font-semibold text-[#B86E4B]">Rp 750.000</p>
            </div>

        </div>
    </div>

</main>
<!-- Topbar -->
<header class="bg-[#E8DDD0] border-b border-[#BFC3B1] px-6 py-4 flex items-center justify-between sticky top-0 z-30">
    <div>
        <h1 class="text-lg font-semibold text-[#2B221D]">Dashboard Pembayaran</h1>
        <p class="text-xs text-[#5B4636]">Pantau arus kas, verifikasi transaksi masuk, dan kelola status tagihan</p>
    </div>
    <div class="flex items-center gap-3">
        <button class="relative text-[#5B4636] hover:text-[#2B221D] p-2 rounded-lg hover:bg-[#D8D2C6] transition-colors">
            <i class="ti ti-bell text-xl" aria-hidden="true"></i>
            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-[#B86E4B] rounded-full"></span>
        </button>
        <div class="w-9 h-9 rounded-full bg-[#BFC3B1] flex items-center justify-center text-[#2B221D] font-semibold text-sm">A</div>
    </div>
</header>

<!-- Page Body -->
<main class="flex-1 p-6 space-y-6 bg-[#F5F1EC]/30">

    <!-- Stat Cards Keuangan: Diselaraskan dengan Palet Bumi -->
    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
        
        <!-- Total Pendapatan Lunas -->
        <div class="bg-white rounded-xl border border-[#BFC3B1] p-5">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-[#5B4636]">Pendapatan (Lunas)</p>
                <div class="w-10 h-10 rounded-lg bg-[#BFC3B1]/20 flex items-center justify-center border border-[#BFC3B1]">
                    <i class="ti ti-wallet text-[#5B4636] text-xl"></i>
                </div>
            </div>
            <p class="text-2xl font-bold text-[#2B221D]">Rp 6.000.000</p>
            <p class="text-xs text-[#5B4636] mt-1">Dana bersih masuk</p>
        </div>

        <!-- Menunggu Verifikasi -->
        <div class="bg-white rounded-xl border border-[#BFC3B1] p-5">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-[#5B4636]">Perlu Verifikasi</p>
                <div class="w-10 h-10 rounded-lg bg-[#B86E4B]/10 flex items-center justify-center border border-[#B86E4B]/30">
                    <i class="ti ti-receipt-refund text-[#B86E4B] text-xl"></i>
                </div>
            </div>
            <p class="text-2xl font-bold text-[#2B221D]">Rp 3.000.000</p>
            <p class="text-xs text-[#B86E4B] mt-1">1 Transaksi tertunda</p>
        </div>

        <!-- Belum Bayar -->
        <div class="bg-white rounded-xl border border-[#BFC3B1] p-5">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-[#5B4636]">Belum Bayar</p>
                <div class="w-10 h-10 rounded-lg bg-[#2B221D]/5 flex items-center justify-center border border-[#2B221D]/20">
                    <i class="ti ti-clock-cancel text-[#2B221D]/70 text-xl"></i>
                </div>
            </div>
            <p class="text-2xl font-bold text-[#2B221D]">Rp 0</p>
            <p class="text-xs text-[#5B4636]/80 mt-1">Semua invoice terbit</p>
        </div>

        <!-- Total Invoice -->
        <div class="bg-white rounded-xl border border-[#BFC3B1] p-5">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-[#5B4636]">Total Transaksi</p>
                <div class="w-10 h-10 rounded-lg bg-[#E8DDD0] flex items-center justify-center">
                    <i class="ti ti-receipt text-[#5B4636] text-xl"></i>
                </div>
            </div>
            <p class="text-2xl font-bold text-[#2B221D]">2</p>
            <p class="text-xs text-[#5B4636] mt-1">Invoice tercatat</p>
        </div>
    </div>

    <!-- Tabel Pembayaran -->
    <div class="bg-white rounded-xl border border-[#BFC3B1]">

        <!-- Toolbar -->
        <div class="px-5 py-4 border-b border-[#D8D2C6] flex flex-col sm:flex-row sm:items-center gap-3 justify-between">
            <h2 class="text-sm font-semibold text-[#2B221D]">Daftar Invoice & Pembayaran</h2>
            <div class="flex items-center gap-2">
                <!-- Search -->
                <div class="relative">
                    <i class="ti ti-search absolute left-3 top-1/2 -translate-y-1/2 text-[#5B4636] text-sm" aria-hidden="true"></i>
                    <input
                        type="text"
                        placeholder="Cari ID / Kode Pendaftaran..."
                        class="pl-8 pr-4 py-1.5 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] placeholder-[#5B4636]/60 focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B] w-60"
                    >
                </div>
                <!-- Filter Cetak -->
                <button class="flex items-center gap-1.5 px-3 py-1.5 border border-[#BFC3B1] text-[#5B4636] hover:bg-[#F5F1EC] hover:text-[#2B221D] text-sm rounded-lg transition-colors">
                    <i class="ti ti-printer text-base" aria-hidden="true"></i>
                    Cetak Laporan
                </button>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-[#F5F1EC] text-left text-xs text-[#5B4636] uppercase tracking-wide border-b border-[#D8D2C6]">
                        <th class="px-5 py-3 font-medium">No</th>
                        <th class="px-5 py-3 font-medium">ID Transaksi</th>
                        <th class="px-5 py-3 font-medium">Registrasi / Pemohon</th>
                        <th class="px-5 py-3 font-medium">Metode</th>
                        <th class="px-5 py-3 font-medium">Tanggal Bayar</th>
                        <th class="px-5 py-3 font-medium">Total Tagihan</th>
                        <th class="px-5 py-3 font-medium">Status</th>
                        <th class="px-5 py-3 font-medium text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#D8D2C6]">

                    <!-- Transaksi 1 (Menunggu Verifikasi) -->
                    <tr class="hover:bg-[#F5F1EC] transition-colors">
                        <td class="px-5 py-4 text-[#5B4636] text-xs">1</td>
                        <td class="px-5 py-4">
                            <span class="font-mono text-xs font-semibold text-[#2B221D]">#INV-001</span>
                        </td>
                        <td class="px-5 py-4">
                            <div>
                                <p class="font-medium text-[#2B221D]">KRM001</p>
                                <p class="text-xs text-[#5B4636]">I Made Wijaya</p>
                            </div>
                        </td>
                        <td class="px-5 py-4">
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-xs font-medium bg-[#E8DDD0] text-[#2B221D]">
                                <i class="ti ti-building-bank text-xs"></i> Transfer
                            </span>
                        </td>
                        <td class="px-5 py-4 text-[#5B4636] text-xs">
                            02 Jun 2026
                        </td>
                        <td class="px-5 py-4 font-semibold text-[#2B221D]">
                            Rp 3.000.000
                        </td>
                        <td class="px-5 py-4">
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-[#B86E4B]/10 text-[#B86E4B] border border-[#B86E4B]/20">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#B86E4B]"></span>
                                Menunggu Verifikasi
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button onclick="openModalVerifikasi('KRM001', 'I Made Wijaya', 'Transfer', 'Rp 3.000.000')" 
                                    class="px-2.5 py-1 bg-[#B86E4B] hover:bg-[#2B221D] text-white rounded text-xs font-medium transition-colors shadow-sm">
                                    Verifikasi
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Transaksi 2 (Lunas) -->
                    <tr class="hover:bg-[#F5F1EC] transition-colors">
                        <td class="px-5 py-4 text-[#5B4636] text-xs">2</td>
                        <td class="px-5 py-4">
                            <span class="font-mono text-xs font-semibold text-[#2B221D]">#INV-002</span>
                        </td>
                        <td class="px-5 py-4">
                            <div>
                                <p class="font-medium text-[#2B221D]">KRM002</p>
                                <p class="text-xs text-[#5B4636]">Ni Luh Sari</p>
                            </div>
                        </td>
                        <td class="px-5 py-4">
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-xs font-medium bg-[#BFC3B1]/40 text-[#2B221D]">
                                <i class="ti ti-qrcode text-xs"></i> QRIS
                            </span>
                        </td>
                        <td class="px-5 py-4 text-[#5B4636] text-xs">
                            06 Jun 2026
                        </td>
                        <td class="px-5 py-4 font-semibold text-[#B86E4B]">
                            Rp 6.000.000
                        </td>
                        <td class="px-5 py-4">
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-[#BFC3B1]/30 text-[#5B4636] border border-[#BFC3B1]">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#5B4636]"></span>
                                Lunas
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex items-center justify-center">
                                <button class="p-1.5 rounded-lg text-[#5B4636] hover:bg-[#E8DDD0] transition-colors" title="Cetak Nota">
                                    <i class="ti ti-download text-base" aria-hidden="true"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-5 py-4 border-t border-[#D8D2C6] flex items-center justify-between">
            <p class="text-xs text-[#5B4636]">Menampilkan 2 dari 2 data pembayaran</p>
            <div class="flex items-center gap-1">
                <button class="px-3 py-1.5 text-xs text-[#5B4636] border border-[#BFC3B1] rounded-lg hover:bg-[#F5F1EC] disabled:opacity-40" disabled>
                    <i class="ti ti-chevron-left" aria-hidden="true"></i>
                </button>
                <button class="px-3 py-1.5 text-xs bg-[#B86E4B] text-white rounded-lg font-medium">1</button>
                <button class="px-3 py-1.5 text-xs text-[#5B4636] border border-[#BFC3B1] rounded-lg hover:bg-[#F5F1EC]" disabled>
                    <i class="ti ti-chevron-right" aria-hidden="true"></i>
                </button>
            </div>
        </div>

    </div>
</main>

<!-- ================================ -->
<!-- Modal Konfirmasi / Verifikasi Pembayaran -->
<!-- ================================ -->
<div id="modalVerifikasi" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-[#2B221D]/40 backdrop-blur-sm">
    <div class="bg-white rounded-xl border border-[#BFC3B1] w-full max-w-md mx-4 shadow-xl">
        <div class="px-6 py-4 border-b border-[#D8D2C6] flex items-center justify-between bg-[#F5F1EC] rounded-t-xl">
            <h3 class="text-sm font-semibold text-[#2B221D]">Validasi Pembayaran Masuk</h3>
            <button onclick="document.getElementById('modalVerifikasi').classList.add('hidden')" class="text-[#5B4636] hover:text-[#2B221D]">
                <i class="ti ti-x text-lg"></i>
            </button>
        </div>

        <div class="px-6 py-5 space-y-4">
            
            <!-- Rincian Data Transaksi -->
            <div class="bg-[#F5F1EC] p-4 rounded-lg border border-[#D8D2C6] space-y-2.5">
                <div class="flex justify-between text-xs">
                    <span class="text-[#5B4636]">Kode Pendaftaran:</span>
                    <span id="md-kode" class="font-mono font-bold text-[#2B221D]">KRM001</span>
                </div>
                <div class="flex justify-between text-xs">
                    <span class="text-[#5B4636]">Nama Pemohon:</span>
                    <span id="md-nama" class="font-medium text-[#2B221D]">I Made Wijaya</span>
                </div>
                <div class="flex justify-between text-xs">
                    <span class="text-[#5B4636]">Metode Bayar:</span>
                    <span id="md-metode" class="font-medium text-[#2B221D]">Transfer</span>
                </div>
                <div class="border-t border-[#D8D2C6] pt-2 flex justify-between text-sm">
                    <span class="font-medium text-[#2B221D]">Total Dibayar:</span>
                    <span id="md-total" class="font-bold text-[#B86E4B]">Rp 3.000.000</span>
                </div>
            </div>

            <!-- Update Status Dropdown -->
            <div>
                <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Aksi Tindakan Admin</label>
                <select class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B]">
                    <option value="Menunggu Verifikasi">Tetap Tangguhkan (Menunggu)</option>
                    <option value="Lunas" selected>Verifikasi & Sahkan Berkas (Lunas)</option>
                    <option value="Belum Bayar">Tolak Transaksi / Batalkan</option>
                </select>
            </div>

            <!-- Box Peringatan diselaraskan ke nuansa Terracotta/Cokelat -->
            <div class="p-3 bg-[#B86E4B]/10 rounded-lg border border-[#B86E4B]/20 flex gap-2">
                <i class="ti ti-info-circle text-[#B86E4B] text-lg shrink-0"></i>
                <p class="text-[11px] text-[#5B4636] leading-relaxed">
                    Pastikan mutasi dana bernilai sama telah masuk ke rekening / e-wallet sistem Agnini Mukti sebelum mengubah status menjadi <strong class="text-[#2B221D]">Lunas</strong>.
                </p>
            </div>
        </div>

        <div class="px-6 py-4 border-t border-[#D8D2C6] flex justify-end gap-2 bg-[#F5F1EC] rounded-b-xl">
            <button onclick="document.getElementById('modalVerifikasi').classList.add('hidden')"
                class="px-4 py-2 text-sm text-[#5B4636] border border-[#BFC3B1] rounded-lg hover:bg-[#D8D2C6] transition-colors">
                Batal
            </button>
            <button class="px-4 py-2 text-sm bg-[#B86E4B] hover:bg-[#2B221D] text-white rounded-lg transition-colors shadow-sm font-medium">
                Konfirmasi Valid
            </button>
        </div>
    </div>
</div>

<script>
    function openModalVerifikasi(kode, nama, metode, total) {
        document.getElementById('md-kode').innerText = kode;
        document.getElementById('md-nama').innerText = nama;
        document.getElementById('md-metode').innerText = metode;
        document.getElementById('md-total').innerText = total;
        document.getElementById('modalVerifikasi').classList.remove('hidden');
    }
</script>
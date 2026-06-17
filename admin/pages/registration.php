<header class="bg-[#E8DDD0] border-b border-[#BFC3B1] px-6 py-4 flex items-center justify-between sticky top-0 z-30">
    <div>
        <h1 class="text-lg font-semibold text-[#2B221D]">Pendaftaran Kremasi</h1>
        <p class="text-xs text-[#5B4636]">Kelola dan pantau seluruh berkas pendaftaran pelayanan</p>
    </div>
    <div class="flex items-center gap-3">
        <button class="relative text-[#5B4636] hover:text-[#2B221D] p-2 rounded-lg hover:bg-[#D8D2C6] transition-colors">
            <i class="ti ti-bell text-xl" aria-hidden="true"></i>
            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-[#B86E4B] rounded-full"></span>
        </button>
        <div class="w-9 h-9 rounded-full bg-[#BFC3B1] flex items-center justify-center text-[#2B221D] font-semibold text-sm">A</div>
    </div>
</header>

<main class="flex-1 p-6 space-y-6 bg-[#F5F1EC]/30">

    <!-- STATS CARDS: Diselaraskan dengan Palet Utama -->
    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
        <!-- Total Daftar -->
        <div class="bg-white rounded-xl border border-[#BFC3B1] p-5">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-[#5B4636]">Total Daftar</p>
                <div class="w-10 h-10 rounded-lg bg-[#E8DDD0] flex items-center justify-center">
                    <i class="ti ti-file-text text-[#5B4636] text-xl"></i>
                </div>
            </div>
            <p class="text-3xl font-semibold text-[#2B221D]">2</p>
            <p class="text-xs text-[#5B4636] mt-1">Keseluruhan permohonan</p>
        </div>

        <!-- Menunggu -->
        <div class="bg-white rounded-xl border border-[#BFC3B1] p-5">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-[#5B4636]">Menunggu</p>
                <div class="w-10 h-10 rounded-lg bg-[#B86E4B]/10 flex items-center justify-center border border-[#B86E4B]/30">
                    <i class="ti ti-clock text-[#B86E4B] text-xl"></i>
                </div>
            </div>
            <p class="text-3xl font-semibold text-[#2B221D]">1</p>
            <p class="text-xs text-[#B86E4B] mt-1">Perlu konfirmasi jadwal</p>
        </div>

        <!-- Diproses -->
        <div class="bg-white rounded-xl border border-[#BFC3B1] p-5">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-[#5B4636]">Diproses</p>
                <div class="w-10 h-10 rounded-lg bg-[#5B4636]/10 flex items-center justify-center border border-[#5B4636]/30">
                    <i class="ti ti-refresh text-[#5B4636] text-xl"></i>
                </div>
            </div>
            <p class="text-3xl font-semibold text-[#2B221D]">1</p>
            <p class="text-xs text-[#5B4636] mt-1">Sedang dalam pelaksanaan</p>
        </div>

        <!-- Selesai -->
        <div class="bg-white rounded-xl border border-[#BFC3B1] p-5">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-[#5B4636]">Selesai</p>
                <div class="w-10 h-10 rounded-lg bg-[#BFC3B1]/20 flex items-center justify-center border border-[#BFC3B1]">
                    <i class="ti ti-circle-check text-[#5B4636] text-xl"></i>
                </div>
            </div>
            <p class="text-3xl font-semibold text-[#2B221D]">0</p>
            <p class="text-xs text-[#5B4636]/80 mt-1">Upacara telah selesai</p>
        </div>
    </div>

    <!-- TABLE CONTAINER -->
    <div class="bg-white rounded-xl border border-[#BFC3B1]">

        <div class="px-5 py-4 border-b border-[#D8D2C6] flex flex-col sm:flex-row sm:items-center gap-3 justify-between">
            <h2 class="text-sm font-semibold text-[#2B221D]">Riwayat Permohonan Pendaftaran</h2>
            <div class="flex items-center gap-2">
                <div class="relative">
                    <i class="ti ti-search absolute left-3 top-1/2 -translate-y-1/2 text-[#5B4636] text-sm" aria-hidden="true"></i>
                    <input
                        type="text"
                        placeholder="Cari kode / almarhum..."
                        class="pl-8 pr-4 py-1.5 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] placeholder-[#5B4636]/60 focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B] w-56"
                    >
                </div>
                <button onclick="document.getElementById('modalTambahPendaftaran').classList.remove('hidden')"
                    class="flex items-center gap-1.5 px-3 py-1.5 bg-[#B86E4B] hover:bg-[#2B221D] text-white text-sm rounded-lg transition-colors shadow-sm font-medium">
                    <i class="ti ti-plus text-base" aria-hidden="true"></i>
                    Daftar Baru
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-[#F5F1EC] text-left text-xs text-[#5B4636] uppercase tracking-wide border-b border-[#D8D2C6]">
                        <th class="px-5 py-3 font-medium">No</th>
                        <th class="px-5 py-3 font-medium">Dokumen</th>
                        <th class="px-5 py-3 font-medium">Pemohon</th>
                        <th class="px-5 py-3 font-medium">Almarhum / Almarhumah</th>
                        <th class="px-5 py-3 font-medium">Paket Layanan</th>
                        <th class="px-5 py-3 font-medium">Status</th>
                        <th class="px-5 py-3 font-medium text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#D8D2C6]">

                    <!-- Baris 1: Status Menunggu -->
                    <tr class="hover:bg-[#F5F1EC] transition-colors">
                        <td class="px-5 py-3.5 text-[#5B4636] text-xs">1</td>
                        <td class="px-5 py-4">
                            <div>
                                <span class="font-mono text-xs font-semibold px-2 py-0.5 rounded bg-[#E8DDD0] text-[#2B221D]">KRM001</span>
                                <p class="text-[11px] text-[#5B4636] mt-1">Daftar: 02 Jun 2026</p>
                            </div>
                        </td>
                        <td class="px-5 py-4">
                            <div>
                                <p class="font-medium text-[#2B221D]">I Made Wijaya</p>
                                <p class="text-xs text-[#5B4636]">081111111111</p>
                            </div>
                        </td>
                        <td class="px-5 py-4">
                            <div>
                                <p class="font-medium text-[#2B221D]">I Wayan Sudarma</p>
                                <p class="text-xs text-[#5B4636]">Wafat: 01 Jun 2026</p>
                            </div>
                        </td>
                        <td class="px-5 py-4 text-[#2B221D]">
                            <p class="font-medium">Paket Kremasi Standar</p>
                            <p class="text-xs text-[#B86E4B] font-semibold">Rp 3.000.000</p>
                        </td>
                        <td class="px-5 py-4">
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-[#B86E4B]/10 text-[#B86E4B] border border-[#B86E4B]/20">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#B86E4B]"></span>
                                Menunggu
                            </span>
                        </td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center justify-center gap-2">
                                <button onclick="openEdit()" class="p-1.5 rounded-lg text-[#5B4636] hover:bg-[#E8DDD0] transition-colors" title="Edit">
                                    <i class="ti ti-edit text-base" aria-hidden="true"></i>
                                </button>
                                <button class="p-1.5 rounded-lg text-[#B86E4B] hover:bg-[#B86E4B]/10 transition-colors" title="Hapus">
                                    <i class="ti ti-trash text-base" aria-hidden="true"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Baris 2: Status Diproses -->
                    <tr class="hover:bg-[#F5F1EC] transition-colors">
                        <td class="px-5 py-3.5 text-[#5B4636] text-xs">2</td>
                        <td class="px-5 py-4">
                            <div>
                                <span class="font-mono text-xs font-semibold px-2 py-0.5 rounded bg-[#E8DDD0] text-[#2B221D]">KRM002</span>
                                <p class="text-[11px] text-[#5B4636] mt-1">Daftar: 06 Jun 2026</p>
                            </div>
                        </td>
                        <td class="px-5 py-4">
                            <div>
                                <p class="font-medium text-[#2B221D]">Ni Luh Sari</p>
                                <p class="text-xs text-[#5B4636]">082222222222</p>
                            </div>
                        </td>
                        <td class="px-5 py-4">
                            <div>
                                <p class="font-medium text-[#2B221D]">Ni Ketut Arini</p>
                                <p class="text-xs text-[#5B4636]">Wafat: 05 Jun 2026</p>
                            </div>
                        </td>
                        <td class="px-5 py-4 text-[#2B221D]">
                            <p class="font-medium">Paket Kremasi Lengkap</p>
                            <p class="text-xs text-[#B86E4B] font-semibold">Rp 6.000.000</p>
                        </td>
                        <td class="px-5 py-4">
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-[#5B4636]/10 text-[#5B4636] border border-[#5B4636]/20">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#5B4636]"></span>
                                Diproses
                            </span>
                        </td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center justify-center gap-2">
                                <button onclick="openEdit()" class="p-1.5 rounded-lg text-[#5B4636] hover:bg-[#E8DDD0] transition-colors" title="Edit">
                                    <i class="ti ti-edit text-base" aria-hidden="true"></i>
                                </button>
                                <button class="p-1.5 rounded-lg text-[#B86E4B] hover:bg-[#B86E4B]/10 transition-colors" title="Hapus">
                                    <i class="ti ti-trash text-base" aria-hidden="true"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

        <div class="px-5 py-4 border-t border-[#D8D2C6] flex items-center justify-between">
            <p class="text-xs text-[#5B4636]">Menampilkan 2 dari 2 pendaftaran</p>
            <div class="flex items-center gap-1">
                <button class="px-3 py-1.5 text-xs text-[#5B4636] border border-[#BFC3B1] rounded-lg hover:bg-[#F5F1EC] disabled:opacity-40" disabled>
                    <i class="ti ti-chevron-left" aria-hidden="true"></i>
                </button>
                <button class="px-3 py-1.5 text-xs bg-[#B86E4B] text-white rounded-lg font-medium">1</button>
                <button class="px-3 py-1.5 text-xs text-[#5B4636] border border-[#BFC3B1] rounded-lg hover:bg-[#F5F1EC] disabled:opacity-40" disabled>
                    <i class="ti ti-chevron-right" aria-hidden="true"></i>
                </button>
            </div>
        </div>

    </div>
</main>

<!-- MODAL TAMBAH PENDAFTARAN -->
<div id="modalTambahPendaftaran" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-[#2B221D]/40 backdrop-blur-sm">
    <div class="bg-white rounded-xl border border-[#BFC3B1] w-full max-w-xl mx-4 shadow-xl">
        <div class="px-6 py-4 border-b border-[#D8D2C6] flex items-center justify-between bg-[#F5F1EC] rounded-t-xl">
            <h3 class="text-sm font-semibold text-[#2B221D]">Formulir Pendaftaran Kremasi Baru</h3>
            <button onclick="document.getElementById('modalTambahPendaftaran').classList.add('hidden')" class="text-[#5B4636] hover:text-[#2B221D] transition-colors">
                <i class="ti ti-x text-lg"></i>
            </button>
        </div>

        <div class="px-6 py-5 space-y-4 max-h-[70vh] overflow-y-auto">
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Pilih Pemohon (User)</label>
                    <select class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B]">
                        <option value="">Pilih Pemohon</option>
                        <option value="2">I Made Wijaya (081111111111)</option>
                        <option value="3">Ni Luh Sari (082222222222)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Pilih Paket Layanan</label>
                    <select class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B]">
                        <option value="">Pilih Paket Layanan</option>
                        <option value="1">Paket Kremasi Standar - Rp 3.000.000</option>
                        <option value="2">Paket Kremasi Keluarga - Rp 4.000.000</option>
                        <option value="3">Paket Kremasi Lengkap - Rp 6.000.000</option>
                        <option value="4">Paket Kremasi VIP - Rp 8.000.000</option>
                    </select>
                </div>
            </div>

            <div class="border-t border-[#D8D2C6] pt-3">
                <h4 class="text-xs font-semibold text-[#2B221D] uppercase tracking-wider mb-3">Data Jenazah / Almarhum</h4>
            </div>

            <div>
                <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Nama Almarhum / Almarhumah</label>
                <input type="text" placeholder="Masukkan nama lengkap"
                    class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] placeholder-[#5B4636]/50 focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B]">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Tanggal Lahir</label>
                    <input type="date"
                        class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B]">
                </div>
                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Tanggal Meninggal</label>
                    <input type="date"
                        class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B]">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Tanggal Pelaksanaan / Daftar</label>
                    <input type="date" value="2026-06-16"
                        class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B]">
                </div>
                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Kode Registrasi (Otomatis)</label>
                    <input type="text" value="KRM003" disabled
                        class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#E8DDD0]/50 text-[#5B4636] font-mono font-semibold cursor-not-allowed">
                </div>
            </div>

            <div>
                <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Catatan Khusus</label>
                <textarea rows="3" placeholder="Contoh: Upacara adat jam 10 pagi, titip balok es, dsb."
                    class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] placeholder-[#5B4636]/50 focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B] resize-none"></textarea>
            </div>
        </div>

        <div class="px-6 py-4 border-t border-[#D8D2C6] flex justify-end gap-2 bg-[#F5F1EC] rounded-b-xl">
            <button onclick="document.getElementById('modalTambahPendaftaran').classList.add('hidden')"
                class="px-4 py-2 text-sm text-[#5B4636] border border-[#BFC3B1] rounded-lg hover:bg-[#D8D2C6] transition-colors">
                Batal
            </button>
            <button class="px-4 py-2 text-sm bg-[#B86E4B] hover:bg-[#2B221D] text-white rounded-lg transition-colors shadow-sm font-medium">
                Simpan Berkas
            </button>
        </div>
    </div>
</div>

<!-- MODAL EDIT / VALIDASI -->
<div id="modalEdit" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-[#2B221D]/40 backdrop-blur-sm">
    <div class="bg-white rounded-xl border border-[#BFC3B1] w-full max-w-xl mx-4 shadow-xl">
        <div class="px-6 py-4 border-b border-[#D8D2C6] flex items-center justify-between bg-[#F5F1EC] rounded-t-xl">
            <h3 class="text-sm font-semibold text-[#2B221D]">Kelola / Validasi Pendaftaran <span class="font-mono text-[#B86E4B]">KRM001</span></h3>
            <button onclick="document.getElementById('modalEdit').classList.add('hidden')" class="text-[#5B4636] hover:text-[#2B221D] transition-colors">
                <i class="ti ti-x text-lg"></i>
            </button>
        </div>

        <div class="px-6 py-5 space-y-4 max-h-[70vh] overflow-y-auto">
            <div>
                <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Status Pendaftaran Pelayanan</label>
                <!-- Select Box Status disesuaikan dengan warna bumi -->
                <select class="w-full px-3 py-2 text-sm border border-[#B86E4B] bg-[#B86E4B]/10 font-medium text-[#2B221D] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30">
                    <option value="Menunggu" selected>Menunggu Konfirmasi</option>
                    <option value="Diproses">Diproses / Pelaksanaan</option>
                    <option value="Selesai">Selesai</option>
                    <option value="Dibatalkan">Dibatalkan</option>
                </select>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 bg-[#F5F1EC] p-3 rounded-lg border border-[#D8D2C6]">
                <div>
                    <p class="text-[11px] text-[#5B4636]">Nama Almarhum</p>
                    <p class="text-sm font-semibold text-[#2B221D]">I Wayan Sudarma</p>
                </div>
                <div>
                    <p class="text-[11px] text-[#5B4636]">Pemohon / Keluarga</p>
                    <p class="text-sm font-semibold text-[#2B221D]">I Made Wijaya</p>
                </div>
            </div>

            <div>
                <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Penyesuaian Paket Layanan</label>
                <select class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B]">
                    <option value="1" selected>Paket Kremasi Standar - Rp 3.000.000</option>
                    <option value="2">Paket Kremasi Keluarga - Rp 4.000.000</option>
                    <option value="3">Paket Kremasi Lengkap - Rp 6.000.000</option>
                    <option value="4">Paket Kremasi VIP - Rp 8.000.000</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Catatan/Instruksi Admin</label>
                <textarea rows="3" class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B] resize-none">Menunggu konfirmasi jadwal koordinasi balok es dan sulinggih.</textarea>
            </div>
        </div>

        <div class="px-6 py-4 border-t border-[#D8D2C6] flex justify-end gap-2 bg-[#F5F1EC] rounded-b-xl">
            <button onclick="document.getElementById('modalEdit').classList.add('hidden')"
                class="px-4 py-2 text-sm text-[#5B4636] border border-[#BFC3B1] rounded-lg hover:bg-[#D8D2C6] transition-colors">
                Batal
            </button>
            <button class="px-4 py-2 text-sm bg-[#B86E4B] hover:bg-[#2B221D] text-white rounded-lg transition-colors shadow-sm font-medium">
                Simpan Perubahan Status
            </button>
        </div>
    </div>
</div>

<script>
    function openEdit() {
        document.getElementById('modalEdit').classList.remove('hidden');
    }
</script>
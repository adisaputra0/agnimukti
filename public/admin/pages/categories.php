<header class="bg-[#E8DDD0] border-b border-[#BFC3B1] px-6 py-4 flex items-center justify-between sticky top-0 z-30">
    <div>
        <h1 class="text-lg font-semibold text-[#2B221D]">Kategori Paket</h1>
        <p class="text-xs text-[#5B4636]">Kelola seluruh kategori paket layanan</p>
    </div>
    <div class="flex items-center gap-3">
        <button class="relative text-[#5B4636] hover:text-[#2B221D] p-2 rounded-lg hover:bg-[#D8D2C6] transition-colors">
            <i class="ti ti-bell text-xl"></i>
            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-[#B86E4B] rounded-full"></span>
        </button>
        <div class="w-9 h-9 rounded-full bg-[#BFC3B1] flex items-center justify-center text-[#2B221D] font-semibold text-sm">
            A
        </div>
    </div>
</header>

<main class="flex-1 p-6 space-y-6">

    <!-- Statistik -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

        <div class="bg-white rounded-xl border border-[#BFC3B1] p-5">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-[#5B4636]">Total Kategori</p>
                <div class="w-10 h-10 rounded-lg bg-[#E8DDD0] flex items-center justify-center">
                    <i class="ti ti-category text-[#5B4636] text-xl"></i>
                </div>
            </div>
            <p class="text-3xl font-semibold text-[#2B221D]">5</p>
            <p class="text-xs text-[#5B4636] mt-1">Kategori tersedia</p>
        </div>

        <div class="bg-white rounded-xl border border-[#BFC3B1] p-5">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-[#5B4636]">Kategori Aktif</p>
                <div class="w-10 h-10 rounded-lg bg-[#E8DDD0] flex items-center justify-center">
                    <i class="ti ti-check text-[#B86E4B] text-xl"></i>
                </div>
            </div>
            <p class="text-3xl font-semibold text-[#2B221D]">5</p>
            <p class="text-xs text-[#5B4636] mt-1">Seluruh kategori aktif</p>
        </div>

        <div class="bg-white rounded-xl border border-[#BFC3B1] p-5">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-[#5B4636]">Kategori Terbaru</p>
                <div class="w-10 h-10 rounded-lg bg-[#E8DDD0] flex items-center justify-center">
                    <i class="ti ti-clock text-[#B86E4B] text-xl"></i>
                </div>
            </div>
            <p class="text-lg font-semibold text-[#2B221D]">Pelayanan Adat</p>
            <p class="text-xs text-[#5B4636] mt-1">Ditambahkan terbaru</p>
        </div>

    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl border border-[#BFC3B1]">

        <div class="px-5 py-4 border-b border-[#D8D2C6] flex flex-col sm:flex-row sm:items-center gap-3 justify-between">
            <h2 class="text-sm font-semibold text-[#2B221D]">Daftar Kategori Paket</h2>

            <div class="flex items-center gap-2">

                <div class="relative">
                    <i class="ti ti-search absolute left-3 top-1/2 -translate-y-1/2 text-[#5B4636] text-sm"></i>
                    <input
                        type="text"
                        placeholder="Cari kategori..."
                        class="pl-8 pr-4 py-1.5 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] placeholder-[#5B4636]/60 focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B] w-48">
                </div>

                <button
                    onclick="document.getElementById('modalTambah').classList.remove('hidden')"
                    class="flex items-center gap-1.5 px-3 py-1.5 bg-[#B86E4B] hover:bg-[#B86E4B]/90 text-white text-sm rounded-lg transition-colors shadow-sm">
                    <i class="ti ti-plus text-base"></i>
                    Tambah
                </button>

            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-[#F5F1EC] text-left text-xs text-[#5B4636] uppercase tracking-wide border-b border-[#D8D2C6]">
                        <th class="px-5 py-3 font-medium">No</th>
                        <th class="px-5 py-3 font-medium">Kategori</th>
                        <th class="px-5 py-3 font-medium">Deskripsi</th>
                        <th class="px-5 py-3 font-medium">Dibuat</th>
                        <th class="px-5 py-3 font-medium text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-[#D8D2C6]">

                    <tr class="hover:bg-[#F5F1EC] transition-colors">
                        <td class="px-5 py-3.5 text-[#5B4636] text-xs">1</td>

                        <td class="px-5 py-4">
                            <div>
                                <p class="font-medium text-[#2B221D]">Kremasi</p>
                                <p class="text-xs text-[#5B4636] font-mono mt-0.5">
                                    ID: KTG001
                                </p>
                            </div>
                        </td>

                        <td class="px-5 py-4 text-[#5B4636]">
                            Layanan kremasi lengkap dengan berbagai pilihan paket.
                        </td>

                        <td class="px-5 py-4 text-[#5B4636]">
                            20 Mei 2026
                        </td>

                        <td class="px-5 py-3.5">
                            <div class="flex items-center justify-center gap-2">
                                <button onclick="openEdit()"
                                    class="p-1.5 rounded-lg text-[#5B4636] hover:bg-[#E8DDD0] transition-colors">
                                    <i class="ti ti-edit text-base"></i>
                                </button>

                                <button
                                    class="p-1.5 rounded-lg text-[#B86E4B] hover:bg-[#B86E4B]/10 transition-colors">
                                    <i class="ti ti-trash text-base"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr class="hover:bg-[#F5F1EC] transition-colors">
                        <td class="px-5 py-3.5 text-[#5B4636] text-xs">2</td>

                        <td class="px-5 py-4">
                            <div>
                                <p class="font-medium text-[#2B221D]">Ngaben</p>
                                <p class="text-xs text-[#5B4636] font-mono mt-0.5">
                                    ID: KTG002
                                </p>
                            </div>
                        </td>

                        <td class="px-5 py-4 text-[#5B4636]">
                            Pelaksanaan upacara Ngaben sesuai adat Bali.
                        </td>

                        <td class="px-5 py-4 text-[#5B4636]">
                            22 Mei 2026
                        </td>

                        <td class="px-5 py-3.5">
                            <div class="flex items-center justify-center gap-2">
                                <button onclick="openEdit()"
                                    class="p-1.5 rounded-lg text-[#5B4636] hover:bg-[#E8DDD0] transition-colors">
                                    <i class="ti ti-edit text-base"></i>
                                </button>

                                <button
                                    class="p-1.5 rounded-lg text-[#B86E4B] hover:bg-[#B86E4B]/10 transition-colors">
                                    <i class="ti ti-trash text-base"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

        <div class="px-5 py-4 border-t border-[#D8D2C6] flex items-center justify-between">
            <p class="text-xs text-[#5B4636]">Menampilkan 2 dari 5 kategori</p>

            <div class="flex items-center gap-1">
                <button class="px-3 py-1.5 text-xs text-[#5B4636] border border-[#BFC3B1] rounded-lg hover:bg-[#F5F1EC] disabled:opacity-40" disabled>
                    <i class="ti ti-chevron-left"></i>
                </button>

                <button class="px-3 py-1.5 text-xs bg-[#B86E4B] text-white rounded-lg">1</button>

                <button class="px-3 py-1.5 text-xs text-[#5B4636] border border-[#BFC3B1] rounded-lg hover:bg-[#F5F1EC]">
                    2
                </button>

                <button class="px-3 py-1.5 text-xs text-[#5B4636] border border-[#BFC3B1] rounded-lg hover:bg-[#F5F1EC]">
                    <i class="ti ti-chevron-right"></i>
                </button>
            </div>
        </div>

    </div>

</main>

<!-- Modal Tambah -->
<div id="modalTambah" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-[#2B221D]/40 backdrop-blur-sm">
    <div class="bg-white rounded-xl border border-[#BFC3B1] w-full max-w-lg mx-4 shadow-xl">

        <div class="px-6 py-4 border-b border-[#D8D2C6] flex items-center justify-between bg-[#F5F1EC] rounded-t-xl">
            <h3 class="text-sm font-semibold text-[#2B221D]">Tambah Kategori Paket</h3>

            <button onclick="document.getElementById('modalTambah').classList.add('hidden')"
                class="text-[#5B4636] hover:text-[#2B221D]">
                <i class="ti ti-x text-lg"></i>
            </button>
        </div>

        <div class="px-6 py-5 space-y-4">

            <div>
                <label class="block text-xs font-medium text-[#5B4636] mb-1.5">
                    Nama Kategori
                </label>

                <input
                    type="text"
                    placeholder="Masukkan nama kategori"
                    class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-white text-[#2B221D]">
            </div>

            <div>
                <label class="block text-xs font-medium text-[#5B4636] mb-1.5">
                    Deskripsi
                </label>

                <textarea rows="4"
                    placeholder="Masukkan deskripsi kategori"
                    class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-white text-[#2B221D] resize-none"></textarea>
            </div>

        </div>

        <div class="px-6 py-4 border-t border-[#D8D2C6] flex justify-end gap-2 bg-[#F5F1EC] rounded-b-xl">
            <button onclick="document.getElementById('modalTambah').classList.add('hidden')"
                class="px-4 py-2 text-sm text-[#5B4636] border border-[#BFC3B1] rounded-lg hover:bg-[#D8D2C6]">
                Batal
            </button>

            <button class="px-4 py-2 text-sm bg-[#B86E4B] text-white rounded-lg">
                Simpan
            </button>
        </div>

    </div>
</div>

<!-- Modal Edit -->
<div id="modalEdit" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-[#2B221D]/40 backdrop-blur-sm">
    <div class="bg-white rounded-xl border border-[#BFC3B1] w-full max-w-lg mx-4 shadow-xl">

        <div class="px-6 py-4 border-b border-[#D8D2C6] flex items-center justify-between bg-[#F5F1EC] rounded-t-xl">
            <h3 class="text-sm font-semibold text-[#2B221D]">Edit Kategori Paket</h3>

            <button onclick="document.getElementById('modalEdit').classList.add('hidden')"
                class="text-[#5B4636] hover:text-[#2B221D]">
                <i class="ti ti-x text-lg"></i>
            </button>
        </div>

        <div class="px-6 py-5 space-y-4">

            <div>
                <label class="block text-xs font-medium text-[#5B4636] mb-1.5">
                    Nama Kategori
                </label>

                <input
                    type="text"
                    value="Kremasi"
                    class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-white text-[#2B221D]">
            </div>

            <div>
                <label class="block text-xs font-medium text-[#5B4636] mb-1.5">
                    Deskripsi
                </label>

                <textarea rows="4"
                    class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-white text-[#2B221D] resize-none">Layanan kremasi lengkap dengan berbagai pilihan paket.</textarea>
            </div>

        </div>

        <div class="px-6 py-4 border-t border-[#D8D2C6] flex justify-end gap-2 bg-[#F5F1EC] rounded-b-xl">
            <button onclick="document.getElementById('modalEdit').classList.add('hidden')"
                class="px-4 py-2 text-sm text-[#5B4636] border border-[#BFC3B1] rounded-lg hover:bg-[#D8D2C6]">
                Batal
            </button>

            <button class="px-4 py-2 text-sm bg-[#B86E4B] text-white rounded-lg">
                Simpan Perubahan
            </button>
        </div>

    </div>
</div>

<script>
function openEdit() {
    document.getElementById('modalEdit').classList.remove('hidden');
}
</script>

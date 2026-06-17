<header class="bg-[#E8DDD0] border-b border-[#BFC3B1] px-6 py-4 flex items-center justify-between sticky top-0 z-30">
    <div>
        <h1 class="text-lg font-semibold text-[#2B221D]">Pengguna</h1>
        <p class="text-xs text-[#5B4636]">Kelola data pengguna sistem</p>
    </div>
    <div class="flex items-center gap-3">
        <button class="relative text-[#5B4636] hover:text-[#2B221D] p-2 rounded-lg hover:bg-[#D8D2C6] transition-colors">
            <i class="ti ti-bell text-xl" aria-hidden="true"></i>
            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-[#B86E4B] rounded-full"></span>
        </button>
        <div class="w-9 h-9 rounded-full bg-[#BFC3B1] flex items-center justify-center text-[#5B4636] font-semibold text-sm">A</div>
    </div>
</header>

<main class="flex-1 p-6 space-y-6">

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white rounded-xl border border-[#BFC3B1] p-5">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-[#5B4636]">Total Pengguna</p>
                <div class="w-10 h-10 rounded-lg bg-[#E8DDD0] flex items-center justify-center">
                    <i class="ti ti-users text-[#5B4636] text-xl" aria-hidden="true"></i>
                </div>
            </div>
            <p class="text-3xl font-semibold text-[#2B221D]">3</p>
            <p class="text-xs text-[#5B4636] mt-1">Semua role</p>
        </div>
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
        <div class="bg-white rounded-xl border border-[#BFC3B1] p-5">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-[#5B4636]">Total Pemohon</p>
                <div class="w-10 h-10 rounded-lg bg-[#E8DDD0] flex items-center justify-center">
                    <i class="ti ti-user text-[#5B4636] text-xl" aria-hidden="true"></i>
                </div>
            </div>
            <p class="text-3xl font-semibold text-[#2B221D]">2</p>
            <p class="text-xs text-[#5B4636] mt-1">Pengguna terdaftar</p>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-[#BFC3B1]">

        <div class="px-5 py-4 border-b border-[#D8D2C6] flex flex-col sm:flex-row sm:items-center gap-3 justify-between">
            <h2 class="text-sm font-semibold text-[#2B221D]">Daftar Pengguna</h2>
            <div class="flex items-center gap-2">
                <div class="relative">
                    <i class="ti ti-search absolute left-3 top-1/2 -translate-y-1/2 text-[#5B4636] text-sm" aria-hidden="true"></i>
                    <input
                        type="text"
                        placeholder="Cari pengguna..."
                        class="pl-8 pr-4 py-1.5 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#D8D2C6] focus:border-[#B86E4B] w-48 placeholder-[#5B4636]/60"
                    >
                </div>
                <select class="text-sm border border-[#BFC3B1] rounded-lg px-3 py-1.5 bg-[#F5F1EC] focus:outline-none focus:ring-2 focus:ring-[#D8D2C6] text-[#5B4636]">
                    <option value="">Semua Role</option>
                    <option value="super_admin">Super Admin</option>
                    <option value="admin">Admin</option>
                    <option value="pemohon">Pemohon</option>
                </select>
                <button onclick="document.getElementById('modalTambah').classList.remove('hidden')"
                    class="flex items-center gap-1.5 px-3 py-1.5 bg-[#B86E4B] hover:bg-[#2B221D] text-white text-sm rounded-lg transition-colors">
                    <i class="ti ti-plus text-base" aria-hidden="true"></i>
                    Tambah
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-[#F5F1EC] text-left text-xs text-[#5B4636] uppercase tracking-wide">
                        <th class="px-5 py-3 font-medium">No</th>
                        <th class="px-5 py-3 font-medium">Pengguna</th>
                        <th class="px-5 py-3 font-medium">Username</th>
                        <th class="px-5 py-3 font-medium">Role</th>
                        <th class="px-5 py-3 font-medium">No. Telepon</th>
                        <th class="px-5 py-3 font-medium">Alamat</th>
                        <th class="px-5 py-3 font-medium">Terdaftar</th>
                        <th class="px-5 py-3 font-medium text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#D8D2C6]">

                    <tr class="hover:bg-[#F5F1EC] transition-colors">
                        <td class="px-5 py-3.5 text-[#5B4636] text-xs">1</td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-[#E8DDD0] flex items-center justify-center text-[#2B221D] font-semibold text-xs shrink-0">A</div>
                                <span class="font-medium text-[#2B221D]">Administrator</span>
                            </div>
                        </td>
                        <td class="px-5 py-3.5 font-mono text-xs text-[#5B4636]">admin</td>
                        <td class="px-5 py-3.5">
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-[#E8DDD0] text-[#B86E4B]">
                                <i class="ti ti-shield-check text-xs" aria-hidden="true"></i>
                                Super Admin
                            </span>
                        </td>
                        <td class="px-5 py-3.5 text-[#5B4636] text-xs">081234567890</td>
                        <td class="px-5 py-3.5 text-[#5B4636] text-xs">Denpasar, Bali</td>
                        <td class="px-5 py-3.5 text-[#5B4636] text-xs">-</td>
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

                    <tr class="hover:bg-[#F5F1EC] transition-colors">
                        <td class="px-5 py-3.5 text-[#5B4636] text-xs">2</td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-[#BFC3B1] flex items-center justify-center text-[#5B4636] font-semibold text-xs shrink-0">M</div>
                                <span class="font-medium text-[#2B221D]">I Made Wijaya</span>
                            </div>
                        </td>
                        <td class="px-5 py-3.5 font-mono text-xs text-[#5B4636]">madewijaya</td>
                        <td class="px-5 py-3.5">
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-[#BFC3B1] text-[#5B4636]">
                                <i class="ti ti-user text-xs" aria-hidden="true"></i>
                                Pemohon
                            </span>
                        </td>
                        <td class="px-5 py-3.5 text-[#5B4636] text-xs">081111111111</td>
                        <td class="px-5 py-3.5 text-[#5B4636] text-xs">Denpasar, Bali</td>
                        <td class="px-5 py-3.5 text-[#5B4636] text-xs">-</td>
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

                    <tr class="hover:bg-[#F5F1EC] transition-colors">
                        <td class="px-5 py-3.5 text-[#5B4636] text-xs">3</td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-[#BFC3B1] flex items-center justify-center text-[#2B221D] font-semibold text-xs shrink-0">N</div>
                                <span class="font-medium text-[#2B221D]">Ni Luh Sari</span>
                            </div>
                        </td>
                        <td class="px-5 py-3.5 font-mono text-xs text-[#5B4636]">niluhsari</td>
                        <td class="px-5 py-3.5">
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-[#BFC3B1] text-[#2B221D]">
                                <i class="ti ti-user text-xs" aria-hidden="true"></i>
                                Pemohon
                            </span>
                        </td>
                        <td class="px-5 py-3.5 text-[#5B4636] text-xs">082222222222</td>
                        <td class="px-5 py-3.5 text-[#5B4636] text-xs">Badung, Bali</td>
                        <td class="px-5 py-3.5 text-[#5B4636] text-xs">-</td>
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
            <p class="text-xs text-[#5B4636]">Menampilkan 3 dari 3 pengguna</p>
            <div class="flex items-center gap-1">
                <button class="px-3 py-1.5 text-xs text-[#5B4636] border border-[#BFC3B1] rounded-lg hover:bg-[#F5F1EC] disabled:opacity-40" disabled>
                    <i class="ti ti-chevron-left" aria-hidden="true"></i>
                </button>
                <button class="px-3 py-1.5 text-xs bg-[#B86E4B] text-white rounded-lg">1</button>
                <button class="px-3 py-1.5 text-xs text-[#5B4636] border border-[#BFC3B1] rounded-lg hover:bg-[#F5F1EC] disabled:opacity-40" disabled>
                    <i class="ti ti-chevron-right" aria-hidden="true"></i>
                </button>
            </div>
        </div>

    </div>
</main>

<div id="modalTambah" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-[#2B221D]/40 backdrop-blur-xs">
    <div class="bg-white rounded-xl border border-[#BFC3B1] w-full max-w-md mx-4 shadow-lg">
        <div class="px-6 py-4 border-b border-[#D8D2C6] flex items-center justify-between">
            <h3 class="text-sm font-semibold text-[#2B221D]">Tambah Pengguna</h3>
            <button onclick="document.getElementById('modalTambah').classList.add('hidden')" class="text-[#5B4636] hover:text-[#2B221D] transition-colors">
                <i class="ti ti-x text-lg" aria-hidden="true"></i>
            </button>
        </div>
        <div class="px-6 py-5 space-y-4">
            <div>
                <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Nama Lengkap</label>
                <input type="text" placeholder="Masukkan nama lengkap" class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#D8D2C6] focus:border-[#B86E4B]">
            </div>
            <div>
                <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Username</label>
                <input type="text" placeholder="Masukkan username" class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#D8D2C6] focus:border-[#B86E4B]">
            </div>
            <div>
                <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Password</label>
                <div class="relative">
                    <input type="password" id="passInput" placeholder="Masukkan password" class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#D8D2C6] focus:border-[#B86E4B] pr-10">
                    <button type="button" onclick="togglePass('passInput', this)" class="absolute right-3 top-1/2 -translate-y-1/2 text-[#5B4636] hover:text-[#2B221D]">
                        <i class="ti ti-eye text-base" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <div>
                <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Role</label>
                <select class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#5B4636] focus:outline-none focus:ring-2 focus:ring-[#D8D2C6] focus:border-[#B86E4B]">
                    <option value="">Pilih role</option>
                    <option value="super_admin">Super Admin</option>
                    <option value="admin">Admin</option>
                    <option value="pemohon">Pemohon</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-[#5B4636] mb-1.5">No. Telepon</label>
                <input type="text" placeholder="Contoh: 081234567890" class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#D8D2C6] focus:border-[#B86E4B]">
            </div>
            <div>
                <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Alamat</label>
                <textarea rows="2" placeholder="Masukkan alamat" class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#D8D2C6] focus:border-[#B86E4B] resize-none"></textarea>
            </div>
        </div>
        <div class="px-6 py-4 border-t border-[#D8D2C6] flex justify-end gap-2">
            <button onclick="document.getElementById('modalTambah').classList.add('hidden')" class="px-4 py-2 text-sm text-[#5B4636] border border-[#BFC3B1] rounded-lg hover:bg-[#F5F1EC] transition-colors">
                Batal
            </button>
            <button class="px-4 py-2 text-sm bg-[#B86E4B] hover:bg-[#2B221D] text-white rounded-lg transition-colors">
                Simpan
            </button>
        </div>
    </div>
</div>

<div id="modalEdit" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-[#2B221D]/40 backdrop-blur-xs">
    <div class="bg-white rounded-xl border border-[#BFC3B1] w-full max-w-md mx-4 shadow-lg">
        <div class="px-6 py-4 border-b border-[#D8D2C6] flex items-center justify-between">
            <h3 class="text-sm font-semibold text-[#2B221D]">Edit Pengguna</h3>
            <button onclick="document.getElementById('modalEdit').classList.add('hidden')" class="text-[#5B4636] hover:text-[#2B221D] transition-colors">
                <i class="ti ti-x text-lg" aria-hidden="true"></i>
            </button>
        </div>
        <div class="px-6 py-5 space-y-4">
            <div>
                <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Nama Lengkap</label>
                <input type="text" value="I Made Wijaya" class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#D8D2C6] focus:border-[#B86E4B]">
            </div>
            <div>
                <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Username</label>
                <input type="text" value="madewijaya" class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#D8D2C6] focus:border-[#B86E4B]">
            </div>
            <div>
                <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Password Baru <span class="text-[#5B4636]/60 font-normal">(kosongkan jika tidak diubah)</span></label>
                <div class="relative">
                    <input type="password" id="passEdit" placeholder="Password baru" class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#D8D2C6] focus:border-[#B86E4B] pr-10">
                    <button type="button" onclick="togglePass('passEdit', this)" class="absolute right-3 top-1/2 -translate-y-1/2 text-[#5B4636] hover:text-[#2B221D]">
                        <i class="ti ti-eye text-base" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <div>
                <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Role</label>
                <select class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#5B4636] focus:outline-none focus:ring-2 focus:ring-[#D8D2C6] focus:border-[#B86E4B]">
                    <option value="super_admin">Super Admin</option>
                    <option value="admin">Admin</option>
                    <option value="pemohon" selected>Pemohon</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-[#5B4636] mb-1.5">No. Telepon</label>
                <input type="text" value="081111111111" class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#D8D2C6] focus:border-[#B86E4B]">
            </div>
            <div>
                <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Alamat</label>
                <textarea rows="2" class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#D8D2C6] focus:border-[#B86E4B] resize-none">Denpasar, Bali</textarea>
            </div>
        </div>
        <div class="px-6 py-4 border-t border-[#D8D2C6] flex justify-end gap-2">
            <button onclick="document.getElementById('modalEdit').classList.add('hidden')" class="px-4 py-2 text-sm text-[#5B4636] border border-[#BFC3B1] rounded-lg hover:bg-[#F5F1EC] transition-colors">
                Batal
            </button>
            <button class="px-4 py-2 text-sm bg-[#B86E4B] hover:bg-[#2B221D] text-white rounded-lg transition-colors">
                Simpan Perubahan
            </button>
        </div>
    </div>
</div>

<script>
    function openEdit() {
        document.getElementById('modalEdit').classList.remove('hidden');
    }
    function togglePass(inputId, btn) {
        const input = document.getElementById(inputId);
        const icon = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('ti-eye', 'ti-eye-off');
        } else {
            input.type = 'password';
            icon.classList.replace('ti-eye-off', 'ti-eye');
        }
    }
</script>
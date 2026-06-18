<!-- Topbar -->
<header class="bg-[#E8DDD0] border-b border-[#BFC3B1] px-6 py-4 flex items-center justify-between sticky top-0 z-30">
    <div>
        <h1 class="text-lg font-semibold text-[#2B221D]">Pengaturan Profil</h1>
        <p class="text-xs text-[#5B4636]">Kelola informasi data diri, akun, dan keamanan kata sandi Anda</p>
    </div>
    <div class="flex items-center gap-3">
        <button class="relative text-[#5B4636] hover:text-[#2B221D] p-2 rounded-lg hover:bg-[#D8D2C6] transition-colors">
            <i class="ti ti-bell text-xl" aria-hidden="true"></i>
            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-[#B86E4B] rounded-full"></span>
        </button>
    </div>
</header>

<!-- Page Body -->
<main class="flex-1 p-6 max-w-3xl mx-auto w-full space-y-6">
    
    <!-- Card 1: Informasi Pribadi & Ringkasan Profil -->
    <div class="bg-white rounded-xl border border-[#BFC3B1]">
        <div class="px-5 py-4 border-b border-[#D8D2C6] bg-[#F5F1EC] rounded-t-xl">
            <h3 class="text-sm font-semibold text-[#2B221D]">Informasi Pribadi</h3>
            <p class="text-[11px] text-[#5B4636]">Perbarui detail avatar dan informasi dasar akun Anda di bawah ini</p>
        </div>
        
        <div class="p-5 space-y-6">
            <!-- Bagian Ringkasan Profil / Avatar Sederhana -->
            <div class="flex flex-col sm:flex-row items-center gap-5 p-4 bg-[#F5F1EC]/60 rounded-lg border border-[#D8D2C6]">
                <input type="file" name="image" id="image" class="hidden">
                <label for="image" class="relative w-20 h-20 shrink-0">
                    <div class="w-full h-full rounded-full bg-[#E8DDD0] border-2 border-[#B86E4B] flex items-center justify-center text-[#2B221D] font-bold text-2xl shadow-sm">
                        A
                    </div>
                    <button class="absolute bottom-0 right-0 w-7 h-7 rounded-full bg-[#B86E4B] hover:bg-[#B86E4B]/90 text-white flex items-center justify-center border-2 border-white transition-colors shadow" title="Ubah Foto">
                        <i class="ti ti-camera text-xs"></i>
                    </button>
                </label>
                <div class="text-center sm:text-left space-y-1">
                    <div class="flex flex-col sm:flex-row sm:items-center gap-1.5">
                        <h2 class="text-base font-semibold text-[#2B221D]">Administrator</h2>
                        <span class="w-fit mx-auto sm:mx-0 px-2 py-0.5 rounded text-[10px] font-semibold bg-[#BFC3B1]/50 text-[#2B221D] border border-[#BFC3B1]">Super Admin</span>
                    </div>
                    <p class="text-xs text-[#5B4636] font-mono">@admin</p>
                    <p class="text-[11px] text-[#5B4636]">
                        <i class="ti ti-calendar-time mr-1" aria-hidden="true"></i> Terdaftar sejak: <span class="font-medium text-[#2B221D]">16 Juni 2026</span>
                    </p>
                </div>
            </div>

            <!-- Input Form Field -->
            <div class="space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Nama Lengkap</label>
                        <input type="text" value="Administrator"
                            class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-white text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B]">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Username (Unik)</label>
                        <input type="text" value="admin" disabled
                            class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#5B4636] font-mono cursor-not-allowed">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Nomor Telepon/WhatsApp</label>
                    <input type="text" value="081234567890"
                        class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-white text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B]">
                </div>

                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Alamat Tempat Tinggal</label>
                    <textarea rows="3" class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-white text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B] resize-none">Denpasar, Bali</textarea>
                </div>
            </div>
        </div>
        
        <div class="px-5 py-3 border-t border-[#D8D2C6] flex justify-end bg-[#F5F1EC]/50 rounded-b-xl">
            <button class="px-4 py-1.5 bg-[#B86E4B] hover:bg-[#B86E4B]/90 text-white text-xs font-medium rounded-lg transition-colors shadow-sm">
                Simpan Perubahan
            </button>
        </div>
    </div>

    <!-- Card 2: Ubah Password -->
    <div class="bg-white rounded-xl border border-[#BFC3B1]">
        <div class="px-5 py-4 border-b border-[#D8D2C6] bg-[#F5F1EC] rounded-t-xl">
            <h3 class="text-sm font-semibold text-[#2B221D]">Ubah Kata Sandi</h3>
            <p class="text-[11px] text-[#5B4636]">Amankan akun Anda dengan melakukan kombinasi password baru berkala</p>
        </div>
        
        <div class="p-5 space-y-4">
            <div>
                <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Kata Sandi Saat Ini</label>
                <div class="relative">
                    <input type="password" placeholder="••••••••"
                        class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-white text-[#2B221D] placeholder-[#5B4636]/40 focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B]">
                    <button type="button" class="toggle-password absolute right-3 top-1/2 -translate-y-1/2 text-[#5B4636] hover:text-[#2B221D]">
                        <i class="ti ti-eye text-sm"></i>
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Kata Sandi Baru</label>
                    <div class="relative">
                        <input type="password" placeholder="Minimal 6 karakter"
                            class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-white text-[#2B221D] placeholder-[#5B4636]/40 focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B]">
                        <button type="button" class="toggle-password absolute right-3 top-1/2 -translate-y-1/2 text-[#5B4636] hover:text-[#2B221D]">
                            <i class="ti ti-eye text-sm"></i>
                        </button>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Konfirmasi Kata Sandi Baru</label>
                    <div class="relative">
                        <input type="password" placeholder="Ulangi kata sandi baru"
                            class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-white text-[#2B221D] placeholder-[#5B4636]/40 focus:outline-none focus:ring-2 focus:ring-[#B86E4B]/30 focus:border-[#B86E4B]">
                        <button type="button" class="toggle-password absolute right-3 top-1/2 -translate-y-1/2 text-[#5B4636] hover:text-[#2B221D]">
                            <i class="ti ti-eye text-sm"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="px-5 py-3 border-t border-[#D8D2C6] flex justify-end bg-[#F5F1EC]/50 rounded-b-xl">
            <button class="px-4 py-1.5 bg-[#B86E4B] hover:bg-[#B86E4B]/90 text-white text-xs font-medium rounded-lg transition-colors shadow-sm">
                Perbarui Sandi
            </button>
        </div>
    </div>

</main>

<script>
document.querySelectorAll('.toggle-password').forEach(button => {
    button.addEventListener('click', function () {
        const input = this.parentElement.querySelector('input');
        const icon = this.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('ti-eye');
            icon.classList.add('ti-eye-off');
        } else {
            input.type = 'password';
            icon.classList.remove('ti-eye-off');
            icon.classList.add('ti-eye');
        }
    });
});
</script>
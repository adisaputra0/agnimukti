<?php
require_once __DIR__ . '/../../../classes/Users.php';

$usersModel = new Users();

// Handle POST actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'tambah') {
        $usersModel->create(
            $_POST['nama'],
            $_POST['username'],
            $_POST['password'],
            $_POST['role'],
            $_POST['no_telepon'],
            $_POST['alamat']
        );
    } elseif ($action === 'edit') {
        $usersModel->update(
            $_POST['id_user'],
            $_POST['nama'],
            $_POST['username'],
            $_POST['password'],
            $_POST['role'],
            $_POST['no_telepon'],
            $_POST['alamat']
        );
    } elseif ($action === 'hapus') {
        $usersModel->delete($_POST['id_user']);
    }
    echo "<script>
    window.location='?page=users';
    </script>";
    exit;
}

// Fetch data
$users = $usersModel->getAll();

// Filter & Search Logic
$search = $_GET['search'] ?? '';
$filterRole = $_GET['role'] ?? '';

if ($search !== '') {
    $users = array_filter($users, fn($u) =>
        stripos($u['nama'], $search) !== false ||
        stripos($u['username'], $search) !== false
    );
}
if ($filterRole !== '') {
    $users = array_filter($users, fn($u) => $u['role'] === $filterRole);
}
$users = array_values($users);

// Stats
$allUsers   = $usersModel->getAll();
$totalUsers = count($allUsers);
$totalAdmin = count(array_filter($allUsers, fn($u) => in_array($u['role'], ['super_admin', 'admin'])));
$totalPemohon = count(array_filter($allUsers, fn($u) => $u['role'] === 'pemohon'));
?>

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
            <p class="text-3xl font-semibold text-[#2B221D]"><?= $totalUsers ?></p>
            <p class="text-xs text-[#5B4636] mt-1">Semua role</p>
        </div>
        <div class="bg-white rounded-xl border border-[#BFC3B1] p-5">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-[#5B4636]">Total Admin</p>
                <div class="w-10 h-10 rounded-lg bg-[#E8DDD0] flex items-center justify-center">
                    <i class="ti ti-shield-check text-[#B86E4B] text-xl" aria-hidden="true"></i>
                </div>
            </div>
            <p class="text-3xl font-semibold text-[#2B221D]"><?= $totalAdmin ?></p>
            <p class="text-xs text-[#5B4636] mt-1">Super admin aktif</p>
        </div>
        <div class="bg-white rounded-xl border border-[#BFC3B1] p-5">
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm text-[#5B4636]">Total Pemohon</p>
                <div class="w-10 h-10 rounded-lg bg-[#E8DDD0] flex items-center justify-center">
                    <i class="ti ti-user text-[#5B4636] text-xl" aria-hidden="true"></i>
                </div>
            </div>
            <p class="text-3xl font-semibold text-[#2B221D]"><?= $totalPemohon ?></p>
            <p class="text-xs text-[#5B4636] mt-1">Pengguna terdaftar</p>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-[#BFC3B1]">

        <div class="px-5 py-4 border-b border-[#D8D2C6] flex flex-col sm:flex-row sm:items-center gap-3 justify-between">
            <h2 class="text-sm font-semibold text-[#2B221D]">Daftar Pengguna</h2>
            
            <form method="GET" action="" class="flex items-center gap-2">
                <input type="hidden" name="page" value="users">
                
                <div class="relative">
                    <i class="ti ti-search absolute left-3 top-1/2 -translate-y-1/2 text-[#5B4636] text-sm" aria-hidden="true"></i>
                    <input
                        type="text"
                        name="search"
                        value="<?= htmlspecialchars($search) ?>"
                        placeholder="Cari pengguna..."
                        class="pl-8 pr-4 py-1.5 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#D8D2C6] focus:border-[#B86E4B] w-48 placeholder-[#5B4636]/60"
                    >
                </div>
                
                <select name="role" onchange="this.form.submit()" class="text-sm border border-[#BFC3B1] rounded-lg px-3 py-1.5 bg-[#F5F1EC] focus:outline-none focus:ring-2 focus:ring-[#D8D2C6] text-[#5B4636]">
                    <option value="">Semua Role</option>
                    <option value="super_admin" <?= $filterRole === 'super_admin' ? 'selected' : '' ?>>Super Admin</option>
                    <option value="admin" <?= $filterRole === 'admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="pemohon" <?= $filterRole === 'pemohon' ? 'selected' : '' ?>>Pemohon</option>
                </select>

                <!-- <button type="submit" class="px-3 py-1.5 bg-[#B86E4B] hover:bg-[#2B221D] text-white text-sm rounded-lg transition-colors">
                    Cari
                </button> -->

                <?php if ($search !== '' || $filterRole !== ''): ?>
                    <!-- <a href="?page=users" class="px-3 py-1.5 border border-[#BFC3B1] text-[#5B4636] text-sm rounded-lg hover:bg-[#F5F1EC] transition-colors">
                        Reset
                    </a> -->
                <?php endif; ?>
            </form>
            
            <?php if (($authUser['data']['role'] ?? '') === 'super_admin'): ?>
                <button onclick="document.getElementById('modalTambah').classList.remove('hidden')"
                    class="flex items-center gap-1.5 px-3 py-1.5 bg-[#B86E4B] hover:bg-[#2B221D] text-white text-sm rounded-lg transition-colors">
                    <i class="ti ti-plus text-base" aria-hidden="true"></i>
                    Tambah
                </button>
            <?php endif; ?>
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
                        
                        <?php if (($authUser['data']['role'] ?? '') === 'super_admin'): ?>
                            <th class="px-5 py-3 font-medium text-center">Aksi</th>
                        <?php endif;?>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#D8D2C6]">

                    <?php if (count($users) === 0): ?>
                        <tr>
                            <td colspan="8" class="px-5 py-8 text-center text-[#5B4636]/70">
                                <i class="ti ti-search text-2xl block mb-1"></i>
                                Pengguna tidak ditemukan.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($users as $i => $user): ?>
                        <?php
                            $initial = strtoupper(mb_substr($user['nama'], 0, 1));
                            $isAdmin = in_array($user['role'], ['super_admin', 'admin']);
                            $avatarBg = $isAdmin ? 'bg-[#E8DDD0]' : 'bg-[#BFC3B1]';
                            $avatarText = $isAdmin ? 'text-[#2B221D]' : 'text-[#5B4636]';
                            $roleLabel = match($user['role']) {
                                'super_admin' => 'Super Admin',
                                'admin'       => 'Admin',
                                default       => 'Pemohon',
                            };
                            $roleBadgeBg   = $isAdmin ? 'bg-[#E8DDD0]' : 'bg-[#BFC3B1]';
                            $roleBadgeText = $isAdmin ? 'text-[#B86E4B]' : 'text-[#5B4636]';
                            $roleIcon      = $isAdmin ? 'ti-shield-check' : 'ti-user';
                            $terdaftar = !empty($user['created_at']) ? date('d/m/Y', strtotime($user['created_at'])) : '-';
                        ?>
                        <tr class="hover:bg-[#F5F1EC] transition-colors">
                            <td class="px-5 py-3.5 text-[#5B4636] text-xs"><?= $i + 1 ?></td>
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full <?= $avatarBg ?> flex items-center justify-center <?= $avatarText ?> font-semibold text-xs shrink-0"><?= $initial ?></div>
                                    <span class="font-medium text-[#2B221D]"><?= htmlspecialchars($user['nama']) ?></span>
                                </div>
                            </td>
                            <td class="px-5 py-3.5 font-mono text-xs text-[#5B4636]"><?= htmlspecialchars($user['username']) ?></td>
                            <td class="px-5 py-3.5">
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium <?= $roleBadgeBg ?> <?= $roleBadgeText ?>">
                                    <i class="ti <?= $roleIcon ?> text-xs" aria-hidden="true"></i>
                                    <?= $roleLabel ?>
                                </span>
                            </td>
                            <td class="px-5 py-3.5 text-[#5B4636] text-xs"><?= htmlspecialchars($user['no_telepon'] ?? '-') ?></td>
                            <td class="px-5 py-3.5 text-[#5B4636] text-xs"><?= htmlspecialchars($user['alamat'] ?? '-') ?></td>
                            <td class="px-5 py-3.5 text-[#5B4636] text-xs"><?= $terdaftar ?></td>
                            <?php if (($authUser['data']['role'] ?? '') === 'super_admin'): ?>
                                <td class="px-5 py-3.5">
                                    <div class="flex items-center justify-center gap-2">
                                        <button onclick="openEdit(<?= htmlspecialchars(json_encode($user)) ?>)" class="p-1.5 rounded-lg text-[#5B4636] hover:bg-[#E8DDD0] transition-colors" title="Edit">
                                            <i class="ti ti-edit text-base" aria-hidden="true"></i>
                                        </button>
                                        <form method="POST" onsubmit="return confirm('Hapus pengguna ini?')" style="display:inline">
                                            <input type="hidden" name="action" value="hapus">
                                            <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
                                            <button type="submit" class="p-1.5 rounded-lg text-[#B86E4B] hover:bg-[#B86E4B]/10 transition-colors" title="Hapus">
                                                <i class="ti ti-trash text-base" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            <?php endif;?>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </tbody>
            </table>
        </div>

        <div class="px-5 py-4 border-t border-[#D8D2C6] flex items-center justify-between">
            <p class="text-xs text-[#5B4636]">Menampilkan <?= count($users) ?> dari <?= $totalUsers ?> pengguna</p>
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
        <form method="POST">
            <input type="hidden" name="action" value="tambah">
            <div class="px-6 py-5 space-y-4">
                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Nama Lengkap</label>
                    <input type="text" name="nama" required placeholder="Masukkan nama lengkap" class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#D8D2C6] focus:border-[#B86E4B]">
                </div>
                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Username</label>
                    <input type="text" name="username" required placeholder="Masukkan username" class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#D8D2C6] focus:border-[#B86E4B]">
                </div>
                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Password</label>
                    <div class="relative">
                        <input type="password" id="passInput" name="password" required placeholder="Masukkan password" class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#D8D2C6] focus:border-[#B86E4B] pr-10">
                        <button type="button" onclick="togglePass('passInput', this)" class="absolute right-3 top-1/2 -translate-y-1/2 text-[#5B4636] hover:text-[#2B221D]">
                            <i class="ti ti-eye text-base" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Role</label>
                    <select name="role" required class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#5B4636] focus:outline-none focus:ring-2 focus:ring-[#D8D2C6] focus:border-[#B86E4B]">
                        <option value="">Pilih role</option>
                        <option value="super_admin">Super Admin</option>
                        <option value="admin">Admin</option>
                        <option value="pemohon">Pemohon</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">No. Telepon</label>
                    <input type="text" name="no_telepon" placeholder="Contoh: 081234567890" class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#D8D2C6] focus:border-[#B86E4B]">
                </div>
                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Alamat</label>
                    <textarea rows="2" name="alamat" placeholder="Masukkan alamat" class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#D8D2C6] focus:border-[#B86E4B] resize-none"></textarea>
                </div>
            </div>
            <div class="px-6 py-4 border-t border-[#D8D2C6] flex justify-end gap-2">
                <button type="button" onclick="document.getElementById('modalTambah').classList.add('hidden')" class="px-4 py-2 text-sm text-[#5B4636] border border-[#BFC3B1] rounded-lg hover:bg-[#F5F1EC] transition-colors">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 text-sm bg-[#B86E4B] hover:bg-[#2B221D] text-white rounded-lg transition-colors">
                    Simpan
                </button>
            </div>
        </form>
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
        <form method="POST">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="id_user" id="editIdUser">
            <div class="px-6 py-5 space-y-4">
                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Nama Lengkap</label>
                    <input type="text" name="nama" id="editNama" required class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#D8D2C6] focus:border-[#B86E4B]">
                </div>
                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Username</label>
                    <input type="text" name="username" id="editUsername" required class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#D8D2C6] focus:border-[#B86E4B]">
                </div>
                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Password Baru <span class="text-[#5B4636]/60 font-normal">(kosongkan jika tidak diubah)</span></label>
                    <div class="relative">
                        <input type="password" id="passEdit" name="password" placeholder="Password baru" class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#D8D2C6] focus:border-[#B86E4B] pr-10">
                        <button type="button" onclick="togglePass('passEdit', this)" class="absolute right-3 top-1/2 -translate-y-1/2 text-[#5B4636] hover:text-[#2B221D]">
                            <i class="ti ti-eye text-base" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Role</label>
                    <select name="role" id="editRole" required class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#5B4636] focus:outline-none focus:ring-2 focus:ring-[#D8D2C6] focus:border-[#B86E4B]">
                        <option value="super_admin">Super Admin</option>
                        <option value="admin">Admin</option>
                        <option value="pemohon">Pemohon</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">No. Telepon</label>
                    <input type="text" name="no_telepon" id="editNoTelepon" class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#D8D2C6] focus:border-[#B86E4B]">
                </div>
                <div>
                    <label class="block text-xs font-medium text-[#5B4636] mb-1.5">Alamat</label>
                    <textarea rows="2" name="alamat" id="editAlamat" class="w-full px-3 py-2 text-sm border border-[#BFC3B1] rounded-lg bg-[#F5F1EC] text-[#2B221D] focus:outline-none focus:ring-2 focus:ring-[#D8D2C6] focus:border-[#B86E4B] resize-none"></textarea>
                </div>
            </div>
            <div class="px-6 py-4 border-t border-[#D8D2C6] flex justify-end gap-2">
                <button type="button" onclick="document.getElementById('modalEdit').classList.add('hidden')" class="px-4 py-2 text-sm text-[#5B4636] border border-[#BFC3B1] rounded-lg hover:bg-[#F5F1EC] transition-colors">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 text-sm bg-[#B86E4B] hover:bg-[#2B221D] text-white rounded-lg transition-colors">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEdit(user) {
        document.getElementById('editIdUser').value    = user.id_user;
        document.getElementById('editNama').value      = user.nama;
        document.getElementById('editUsername').value  = user.username;
        document.getElementById('editRole').value      = user.role;
        document.getElementById('editNoTelepon').value = user.no_telepon ?? '';
        document.getElementById('editAlamat').value    = user.alamat ?? '';
        document.getElementById('passEdit').value      = '';
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
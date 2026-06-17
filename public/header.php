<?php
/**
 * AgniMukti - Navbar Component
 * 
 * Cara penggunaan / Usage:
 * <?php include 'components/navbar.php'; ?>
 * 
 * Pastikan Tailwind CSS sudah di-load di halaman utama.
 * Ganti $currentPage sesuai halaman aktif:
 *   'beranda', 'tentang', 'paket', 'kontak'
 */

// Tentukan halaman aktif dari file pemanggil (opsional)
// Contoh: $currentPage = 'beranda'; (definisikan sebelum include)
if (!isset($currentPage)) {
    $currentPage = '';
}

$navLinks = [
    ['label' => 'Beranda',    'href' => 'index.php',   'key' => 'beranda'],
    ['label' => 'Tentang Kami','href' => 'tentang.php', 'key' => 'tentang'],
    ['label' => 'Paket',      'href' => 'paket.php',   'key' => 'paket'],
    ['label' => 'Kontak',     'href' => 'kontak.php',  'key' => 'kontak'],
];
?>

<!-- ===== AGNIMUKTI NAVBAR ===== -->
<style>
  :root {
    --earth-brown:   #5B4636;
    --sandstone:     #E8DDD0;
    --terracotta:    #B86E4B;
    --sage-mist:     #BFC3B1;
    --dark-walnut:   #2B221D;
  }

  /* Navbar base */
  #agni-navbar {
    background-color: var(--dark-walnut);
    border-bottom: 1px solid rgba(191, 110, 75, 0.25);
    position: sticky;
    top: 0;
    z-index: 50;
    transition: box-shadow 0.3s ease;
  }
  #agni-navbar.scrolled {
    box-shadow: 0 4px 24px rgba(43, 34, 29, 0.55);
  }

  /* Logo */
  .agni-logo-icon {
    width: 36px;
    height: 36px;
    background: linear-gradient(135deg, var(--terracotta) 0%, #d4874f 100%);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }
  .agni-logo-text-main {
    font-family: 'Georgia', 'Times New Roman', serif;
    font-size: 1.2rem;
    font-weight: 700;
    letter-spacing: 0.04em;
    color: var(--sandstone);
  }
  .agni-logo-text-sub {
    font-size: 0.6rem;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: var(--sage-mist);
    line-height: 1;
  }

  /* Nav link */
  .agni-nav-link {
    font-size: 0.875rem;
    font-weight: 500;
    letter-spacing: 0.04em;
    color: var(--sage-mist);
    text-decoration: none;
    padding: 0.35rem 0.1rem;
    position: relative;
    transition: color 0.25s ease;
  }
  .agni-nav-link::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 0;
    height: 1.5px;
    background: var(--terracotta);
    transition: width 0.3s ease;
  }
  .agni-nav-link:hover,
  .agni-nav-link.active {
    color: var(--sandstone);
  }
  .agni-nav-link:hover::after,
  .agni-nav-link.active::after {
    width: 100%;
  }

  /* CTA button */
  .agni-cta-btn {
    background-color: var(--terracotta);
    color: var(--sandstone);
    font-size: 0.82rem;
    font-weight: 600;
    letter-spacing: 0.06em;
    padding: 0.5rem 1.2rem;
    border-radius: 6px;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: background-color 0.25s ease, transform 0.15s ease;
    white-space: nowrap;
  }
  .agni-cta-btn:hover {
    background-color: #c47a56;
    transform: translateY(-1px);
  }

  /* Mobile hamburger */
  .agni-hamburger {
    background: none;
    border: none;
    cursor: pointer;
    padding: 0.25rem;
    display: none;
  }
  .agni-hamburger span {
    display: block;
    width: 22px;
    height: 2px;
    background: var(--sandstone);
    margin: 5px 0;
    transition: all 0.3s ease;
    border-radius: 2px;
  }
  .agni-hamburger.open span:nth-child(1) {
    transform: translateY(7px) rotate(45deg);
  }
  .agni-hamburger.open span:nth-child(2) {
    opacity: 0;
  }
  .agni-hamburger.open span:nth-child(3) {
    transform: translateY(-7px) rotate(-45deg);
  }

  /* Mobile menu */
  #agni-mobile-menu {
    display: none;
    background-color: var(--dark-walnut);
    border-top: 1px solid rgba(91, 70, 54, 0.4);
    padding: 1rem 1.25rem 1.25rem;
  }
  #agni-mobile-menu.open {
    display: block;
  }
  .agni-mobile-link {
    display: block;
    font-size: 0.9rem;
    font-weight: 500;
    color: var(--sage-mist);
    text-decoration: none;
    padding: 0.65rem 0;
    border-bottom: 1px solid rgba(91, 70, 54, 0.3);
    letter-spacing: 0.03em;
    transition: color 0.2s ease;
  }
  .agni-mobile-link:last-of-type {
    border-bottom: none;
  }
  .agni-mobile-link:hover,
  .agni-mobile-link.active {
    color: var(--sandstone);
  }

  @media (max-width: 768px) {
    .agni-hamburger { display: block; }
    .agni-desktop-menu { display: none !important; }
  }
</style>

<nav id="agni-navbar" role="navigation" aria-label="Navigasi utama AgniMukti">
  <div style="max-width: 1200px; margin: 0 auto; padding: 0 1.5rem;">
    <div style="display: flex; align-items: center; justify-content: space-between; height: 64px;">

      <!-- ── Logo ── -->
      <a href="index.php" style="display:flex; align-items:center; gap:0.65rem; text-decoration:none;">
        <div class="agni-logo-icon" aria-hidden="true">
          <!-- Api / flame icon -->
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 2C12 2 8 7 8 12C8 14.21 9.79 16 12 16C14.21 16 16 14.21 16 12C16 10 14 7 12 2Z" fill="#fff" opacity="0.9"/>
            <path d="M12 16C10.34 16 9 17.34 9 19C9 20.66 10.34 22 12 22C13.66 22 15 20.66 15 19C15 17.34 13.66 16 12 16Z" fill="#fff" opacity="0.6"/>
          </svg>
        </div>
        <div>
          <div class="agni-logo-text-main">AgniMukti</div>
          <div class="agni-logo-text-sub">Krematorium Digital</div>
        </div>
      </a>

      <!-- ── Desktop Menu ── -->
      <div class="agni-desktop-menu" style="display:flex; align-items:center; gap:2rem;">
        <?php foreach ($navLinks as $link): ?>
          <a
            href="<?= htmlspecialchars($link['href']) ?>"
            class="agni-nav-link<?= ($currentPage === $link['key']) ? ' active' : '' ?>"
            <?= ($currentPage === $link['key']) ? 'aria-current="page"' : '' ?>
          >
            <?= htmlspecialchars($link['label']) ?>
          </a>
        <?php endforeach; ?>
      </div>

      <!-- ── Desktop CTA + Hamburger ── -->
      <div style="display:flex; align-items:center; gap:1rem;">
        <a href="register.php" class="agni-cta-btn" style="display:none;" id="agni-register-btn">Daftar</a>
        <a href="login.php" class="agni-cta-btn" id="agni-login-btn">Masuk</a>
        <button
          class="agni-hamburger"
          id="agni-hamburger"
          aria-expanded="false"
          aria-controls="agni-mobile-menu"
          aria-label="Buka menu navigasi"
        >
          <span></span>
          <span></span>
          <span></span>
        </button>
      </div>

    </div>
  </div>

  <!-- ── Mobile Menu ── -->
  <div id="agni-mobile-menu" role="menu">
    <?php foreach ($navLinks as $link): ?>
      <a
        href="<?= htmlspecialchars($link['href']) ?>"
        class="agni-mobile-link<?= ($currentPage === $link['key']) ? ' active' : '' ?>"
        role="menuitem"
        <?= ($currentPage === $link['key']) ? 'aria-current="page"' : '' ?>
      >
        <?= htmlspecialchars($link['label']) ?>
      </a>
    <?php endforeach; ?>
    <div style="margin-top:1rem; display:flex; flex-direction:column; gap:0.6rem;">
      <a href="login.php" class="agni-cta-btn" style="text-align:center;">Masuk</a>
      <a href="register.php" class="agni-cta-btn" style="text-align:center; background:transparent; border:1.5px solid var(--terracotta); color:var(--sandstone);">Daftar</a>
    </div>
  </div>
</nav>

<script>
  (function () {
    const hamburger  = document.getElementById('agni-hamburger');
    const mobileMenu = document.getElementById('agni-mobile-menu');
    const navbar     = document.getElementById('agni-navbar');

    // Toggle mobile menu
    hamburger.addEventListener('click', function () {
      const isOpen = mobileMenu.classList.toggle('open');
      hamburger.classList.toggle('open', isOpen);
      hamburger.setAttribute('aria-expanded', isOpen);
      hamburger.setAttribute('aria-label', isOpen ? 'Tutup menu navigasi' : 'Buka menu navigasi');
    });

    // Close menu on outside click
    document.addEventListener('click', function (e) {
      if (!navbar.contains(e.target)) {
        mobileMenu.classList.remove('open');
        hamburger.classList.remove('open');
        hamburger.setAttribute('aria-expanded', 'false');
      }
    });

    // Scroll shadow effect
    window.addEventListener('scroll', function () {
      navbar.classList.toggle('scrolled', window.scrollY > 10);
    }, { passive: true });
  })();
</script>
<!-- ===== /AGNIMUKTI NAVBAR ===== -->
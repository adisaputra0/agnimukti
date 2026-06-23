<?php
/**
 * AgniMukti - Footer Component
 * 
 * Cara penggunaan / Usage:
 * <?php include 'components/footer.php'; ?>
 */
?>

<!-- ===== AGNIMUKTI FOOTER ===== -->
<style>
  /* Sacred Earth palette (sama dengan navbar) */
  :root {
    --earth-brown:  #5B4636;
    --sandstone:    #E8DDD0;
    --terracotta:   #B86E4B;
    --sage-mist:    #BFC3B1;
    --dark-walnut:  #2B221D;
  }

  #agni-footer {
    background-color: var(--dark-walnut);
    border-top: 1px solid rgba(91, 70, 54, 0.45);
    font-family: Georgia, 'Times New Roman', serif;
    color: var(--sage-mist);
  }

  /* ── Top strip: nav columns + newsletter ── */
  .agni-footer-top {
    max-width: 1200px;
    margin: 0 auto;
    padding: 3.5rem 1.5rem 2.5rem;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3rem;
    align-items: start;
  }

  /* Left: logo + nav columns */
  .agni-footer-left {
    display: grid;
    grid-template-columns: 180px repeat(2, 1fr);
    gap: 2rem;
  }

  /* Logo block */
  .agni-footer-logo-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, var(--terracotta) 0%, #d4874f 100%);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 0.75rem;
  }
  .agni-footer-logo-name {
    font-size: 1.15rem;
    font-weight: 700;
    letter-spacing: 0.05em;
    color: var(--sandstone);
    margin: 0 0 0.2rem;
  }
  .agni-footer-logo-tagline {
    font-size: 0.65rem;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: var(--sage-mist);
    font-family: sans-serif;
  }
  .agni-footer-logo-desc {
    margin-top: 1rem;
    font-size: 0.78rem;
    line-height: 1.7;
    color: rgba(191, 195, 177, 0.7);
    font-family: sans-serif;
    max-width: 150px;
  }

  /* Nav column */
  .agni-footer-col h4 {
    font-size: 0.7rem;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: var(--terracotta);
    margin: 0 0 1rem;
    font-family: sans-serif;
    font-weight: 600;
  }
  .agni-footer-col ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    gap: 0.55rem;
  }
  .agni-footer-col ul li a {
    font-size: 0.82rem;
    color: var(--sage-mist);
    text-decoration: none;
    font-family: sans-serif;
    letter-spacing: 0.02em;
    transition: color 0.2s ease;
  }
  .agni-footer-col ul li a:hover {
    color: var(--sandstone);
  }

  /* ── Right: Newsletter ── */
  .agni-footer-newsletter {
    background: rgba(91, 70, 54, 0.18);
    border: 1px solid rgba(184, 110, 75, 0.2);
    border-radius: 12px;
    padding: 2rem 1.75rem;
  }
  .agni-footer-newsletter h3 {
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--sandstone);
    margin: 0 0 0.5rem;
    letter-spacing: 0.02em;
  }
  .agni-footer-newsletter p {
    font-size: 0.8rem;
    color: rgba(191, 195, 177, 0.8);
    margin: 0 0 1.5rem;
    line-height: 1.6;
    font-family: sans-serif;
  }
  .agni-footer-form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.75rem;
    margin-bottom: 0.75rem;
  }
  .agni-footer-field label {
    display: block;
    font-size: 0.62rem;
    letter-spacing: 0.16em;
    text-transform: uppercase;
    color: var(--terracotta);
    margin-bottom: 0.4rem;
    font-family: sans-serif;
    font-weight: 600;
  }
  .agni-footer-field input {
    width: 100%;
    background: rgba(43, 34, 29, 0.7);
    border: 1px solid rgba(91, 70, 54, 0.6);
    border-radius: 6px;
    padding: 0.6rem 0.85rem;
    font-size: 0.8rem;
    color: var(--sandstone);
    font-family: sans-serif;
    outline: none;
    box-sizing: border-box;
    transition: border-color 0.2s ease;
  }
  .agni-footer-field input::placeholder {
    color: rgba(191, 195, 177, 0.4);
    font-style: italic;
  }
  .agni-footer-field input:focus {
    border-color: var(--terracotta);
  }
  .agni-footer-submit {
    width: 100%;
    background: var(--terracotta);
    color: var(--sandstone);
    font-size: 0.78rem;
    font-weight: 700;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    border: none;
    border-radius: 6px;
    padding: 0.7rem 1rem;
    cursor: pointer;
    transition: background-color 0.25s ease, transform 0.15s ease;
    font-family: sans-serif;
    margin-top: 0.25rem;
  }
  .agni-footer-submit:hover {
    background: #c47a56;
    transform: translateY(-1px);
  }

  /* ── Divider ── */
  .agni-footer-divider {
    max-width: 1200px;
    margin: 0 auto;
    border: none;
    border-top: 1px solid rgba(91, 70, 54, 0.35);
  }

  /* ── Bottom strip: socials + copyright ── */
  .agni-footer-bottom {
    max-width: 1200px;
    margin: 0 auto;
    padding: 1.5rem 1.5rem 2rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1.25rem;
  }
  .agni-footer-socials {
    display: flex;
    gap: 0.75rem;
  }
  .agni-social-btn {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    border: 1px solid rgba(91, 70, 54, 0.55);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--sage-mist);
    text-decoration: none;
    transition: border-color 0.2s ease, color 0.2s ease, background 0.2s ease;
  }
  .agni-social-btn:hover {
    border-color: var(--terracotta);
    color: var(--sandstone);
    background: rgba(184, 110, 75, 0.12);
  }
  .agni-footer-copy {
    font-size: 0.72rem;
    color: rgba(191, 195, 177, 0.5);
    font-family: sans-serif;
    letter-spacing: 0.04em;
    text-align: center;
  }

  /* ── Responsive ── */
  @media (max-width: 900px) {
    .agni-footer-top {
      grid-template-columns: 1fr;
      gap: 2rem;
    }
    .agni-footer-left {
      grid-template-columns: 1fr 1fr;
    }
    .agni-footer-left > .agni-footer-logo-block {
      grid-column: 1 / -1;
    }
  }
  @media (max-width: 560px) {
    .agni-footer-left {
      grid-template-columns: 1fr;
    }
    .agni-footer-form-row {
      grid-template-columns: 1fr;
    }
  }
</style>

<footer id="agni-footer" role="contentinfo">

  <!-- ── Top: Logo + Nav + Newsletter ── -->
  <div class="agni-footer-top">

    <!-- Left side -->
    <div class="agni-footer-left">

      <!-- Logo block -->
      <div class="agni-footer-logo-block">
        <div class="w-8 h-8 rounded-lg bg-[#BFC3B1] flex items-center justify-center">
          <img src="./assets/logo.png" alt="Logo" class="w-full h-full">
        </div>
        <p class="agni-footer-logo-name">AgniMukti</p>
        <p class="agni-footer-logo-tagline">Krematorium Digital</p>
        <p class="agni-footer-logo-desc">
          Pelayanan kremasi yang profesional, transparan, dan penuh penghormatan.
        </p>
      </div>

      <!-- Nav column 1 -->
      <div class="agni-footer-col">
        <h4>Layanan</h4>
        <ul>
          <li><a href="paket.php">Paket Kremasi</a></li>
          <li><a href="paket.php#perbandingan">Perbandingan Paket</a></li>
          <li><a href="index.php#fasilitas">Fasilitas</a></li>
          <li><a href="index.php#jadwal">Jadwal Kremasi</a></li>
        </ul>
      </div>

      <!-- Nav column 2 -->
      <div class="agni-footer-col">
        <h4>Informasi</h4>
        <ul>
          <li><a href="tentang.php">Tentang Kami</a></li>
          <li><a href="tentang.php#tim">Tim Kami</a></li>
          <li><a href="https://wa.me/62895410558960">Hubungi Kami</a></li>
          <li><a href="login.php">Masuk Akun</a></li>
        </ul>
      </div>

    </div>

    <!-- Right side: Newsletter -->
    <div class="agni-footer-newsletter">
      <h3>Jangan Lewatkan</h3>
      <p>
        Dapatkan informasi terbaru mengenai layanan, jadwal, dan panduan kremasi langsung ke email Anda.
      </p>
      <div class="agni-footer-form-row">
        <div class="agni-footer-field">
          <label for="footer-email">Alamat Email <span style="color:var(--terracotta)">*</span></label>
          <input
            type="email"
            id="footer-email"
            name="email"
            placeholder="contoh@email.com"
            autocomplete="email"
          >
        </div>
        <div class="agni-footer-field">
          <label for="footer-name">Nama Lengkap</label>
          <input
            type="text"
            id="footer-name"
            name="name"
            placeholder="Nama Anda"
            autocomplete="name"
          >
        </div>
      </div>
      <button type="button" class="agni-footer-submit" onclick="agniSubscribe()">
        Berlangganan
      </button>
      <p style="font-size:0.68rem; color:rgba(191,195,177,0.45); margin:0.75rem 0 0; font-family:sans-serif;">
        Kami menghormati privasi Anda. Tidak ada spam.
      </p>
    </div>

  </div>

  <!-- ── Divider ── -->
  <hr class="agni-footer-divider">

  <!-- ── Bottom: Socials + Copyright ── -->
  <div class="agni-footer-bottom">
    <div class="agni-footer-socials" aria-label="Media sosial AgniMukti">

      <!-- Facebook -->
      <a href="#" class="agni-social-btn" aria-label="Facebook AgniMukti">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor">
          <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
        </svg>
      </a>

      <!-- Instagram -->
      <a href="#" class="agni-social-btn" aria-label="Instagram AgniMukti">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
          <circle cx="12" cy="12" r="4"/>
          <circle cx="17.5" cy="6.5" r="0.5" fill="currentColor" stroke="none"/>
        </svg>
      </a>

      <!-- WhatsApp -->
      <a href="#" class="agni-social-btn" aria-label="WhatsApp AgniMukti">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor">
          <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/>
        </svg>
      </a>

      <!-- YouTube -->
      <a href="#" class="agni-social-btn" aria-label="YouTube AgniMukti">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor">
          <path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 0 0 1.46 6.42 29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58A2.78 2.78 0 0 0 3.41 19.6C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.95A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58zM9.75 15.02V8.98L15.5 12l-5.75 3.02z"/>
        </svg>
      </a>

    </div>

    <p class="agni-footer-copy">
      &copy; <?= date('Y') ?> AgniMukti &mdash; Sistem Informasi Krematorium. Seluruh hak cipta dilindungi.
    </p>
  </div>

</footer>

<script>
function agniSubscribe() {
  const email = document.getElementById('footer-email').value.trim();
  const name  = document.getElementById('footer-name').value.trim();

  if (!email) {
    alert('Mohon masukkan alamat email Anda.');
    document.getElementById('footer-email').focus();
    return;
  }
  if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
    alert('Format email tidak valid.');
    document.getElementById('footer-email').focus();
    return;
  }

  // Ganti bagian ini dengan fetch() ke endpoint PHP-mu
  alert('Terima kasih, ' + (name || 'Anda') + '! Anda telah berlangganan informasi AgniMukti.');
  document.getElementById('footer-email').value = '';
  document.getElementById('footer-name').value  = '';
}
</script>
<!-- ===== /AGNIMUKTI FOOTER ===== -->
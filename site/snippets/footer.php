  </div><!-- #container -->
</main>

<footer class="footer-band">
  <div class="wrap-fluid">
    <div class="cta" aria-label="Site note">
      <span class="cta__logo"><?php snippet('logo') ?></span>
      <p>Made with ❤️ and ☕️ (and 🚫🤖) in the South Downs, Sussex-by-the-sea 🌊.</p>
    </div>

    <div class="footer">
      <nav class="footer__links" aria-label="Footer">
        <a href="<?= url('rss') ?>" data-hover-tone="rss">🍊 RSS Feed</a>
        <span aria-hidden="true">//</span>
        <a href="<?= url('colophon') ?>" data-hover-tone="colophon">ℹ️ Colophon</a>
        <span aria-hidden="true">//</span>
        <a href="<?= url('reads') ?>" data-hover-tone="reading">📚 Reading</a>
        <span aria-hidden="true">//</span>
        <a href="<?= url('bikes') ?>" data-hover-tone="bikes">🚲 Bikes</a>
      </nav>
      <p class="footer__copyright">© <?= date('Y') ?> How Might We Ltd</p>
    </div>
  </div>
</footer>
<script src="<?= url('assets/js/site-2026.js') ?>"></script>
</body>
</html>

<?php
/**
 * Global site footer component
 * Reusable footer to be included on all pages
 */

$scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
$currentDir = dirname($scriptName);
$assetBase = (strpos($currentDir, '/admin') !== false) ? '../' : './';
?>
<footer class="site-footer">
  <div class="container_dashboard">
    <!-- <div class="site-footer__contact"> -->
      <form class="site-footer__contact mb-1" method="post" action="<?= htmlspecialchars($assetBase) ?>contact.php">
        <P>Kontaktformular</P>
          <!-- <legend data-translate="footer.contact.title">Kontaktformular</legend> -->
          <div class="site-footer__data">
            <div class="site-footer__data--item">
              <label for="footer-contact-name" data-translate="footer.contact.name">Name</label>
              <input type="text" id="footer-contact-name" name="name" required autocomplete="name" />
            </div>
            <div class="site-footer__data--item">
              <label for="footer-contact-email" data-translate="footer.contact.email">E-Mail</label>
              <input type="email" id="footer-contact-email" name="email" required autocomplete="email" v>
            </div>
        </div>
          <div class="">
            <label for="footer-contact-message" data-translate="footer.contact.message">Nachricht</label>
            <textarea maxlength="2000" id="footer-contact-message" name="message" rows="3" required></textarea>
          </div>
          <div class="">
            <button type="submit" class="btn btn--main" data-translate="footer.contact.send">Absenden</button>
        </div>
      </form>
        <div class="site-footer__content">
      <div class="site-footer__left">
        <span class="site-footer__copyright">&copy; <?= date('Y') ?> Patrick Kaserer</span>
        <span class="site-footer__rights" data-translate="footer.rights">Alle Rechte vorbehalten</span>
      </div>
      <div class="site-footer__right">
        <a class="site-footer__icon-link" href="https://www.linkedin.com/in/patrick-kaserer/" aria-label="LinkedIn" target="_blank" rel="noopener">
          <img class="site-footer__icon" src="<?= htmlspecialchars($assetBase) ?>assets/img/linkedin_logo.png" alt="LinkedIn" />
        </a>
        <a class="site-footer__icon-link" href="https://www.xing.com/profile/Patrick_Kaserer" aria-label="Xing" target="_blank" rel="noopener">
          <img class="site-footer__icon" src="<?= htmlspecialchars($assetBase) ?>assets/img/xing_logo.png" alt="Xing" />
        </a>
        <a class="site-footer__icon-link" href="https://github.com/pKaserr" aria-label="GitHub" target="_blank" rel="noopener">
          <img class="site-footer__icon" src="<?= htmlspecialchars($assetBase) ?>assets/img/github_logo.png" alt="GitHub" />
        </a>
        <a class="site-footer__icon-link" href="mailto:kaserer.patrick@gmail.com" aria-label="E-Mail">
          <img class="site-footer__icon" src="<?= htmlspecialchars($assetBase) ?>assets/img/mail.png" alt="E-Mail" />
        </a>
      </div>
    </div>
  </div>
</footer>

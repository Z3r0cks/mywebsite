<?php
/**
 * Global site footer component
 * Reusable footer to be included on all pages
 */

$scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
$assetBase = (strpos($scriptName, '/admin/') !== false) ? '../' : './';
?>
<footer class="site-footer">
  <div class="container">
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
        <a class="site-footer__icon-link" href="https://github.com/Z3r0cks" aria-label="GitHub" target="_blank" rel="noopener">
          <img class="site-footer__icon" src="<?= htmlspecialchars($assetBase) ?>assets/img/github_logo.png" alt="GitHub" />
        </a>
        <a class="site-footer__icon-link" href="mailto:mail@patrick-kaserer.de" aria-label="E-Mail">
          <img class="site-footer__icon" src="<?= htmlspecialchars($assetBase) ?>assets/img/mail.png" alt="E-Mail" />
        </a>
      </div>
    </div>
  </div>
</footer>


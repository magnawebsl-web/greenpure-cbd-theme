</main><!-- /#main-content -->

<!-- ══════════════════════════════════
     NEWSLETTER SECTION
══════════════════════════════════ -->
<section class="newsletter-section">
    <div class="container">
        <div class="newsletter-section__inner">
            <div class="newsletter-section__content">
                <div class="newsletter-icon">🌿</div>
                <h2>Rejoignez la communauté GreenPure</h2>
                <p>Recevez <strong>-10% sur votre première commande</strong>, nos guides CBD exclusifs et les dernières nouveautés.</p>
            </div>
            <form class="newsletter-form js-newsletter-form" novalidate>
                <div class="newsletter-form__group">
                    <input type="email" name="email" placeholder="Votre adresse email" class="newsletter-form__input" required>
                    <button type="submit" class="btn btn--gold btn--lg">
                        <span class="btn-text">Je m'inscris</span>
                        <span class="btn-loader" hidden>...</span>
                    </button>
                </div>
                <p class="newsletter-form__legal">Pas de spam. Désabonnement en 1 clic.</p>
                <div class="newsletter-form__message" role="alert" aria-live="polite"></div>
                <?php wp_nonce_field('greenpure_nonce', 'newsletter_nonce'); ?>
            </form>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════
     FOOTER PRINCIPAL
══════════════════════════════════ -->
<footer class="site-footer" role="contentinfo">

    <div class="site-footer__main">
        <div class="container">
            <div class="site-footer__grid">

                <!-- Colonne 1 : À propos -->
                <div class="footer-col footer-col--brand">
                    <div class="footer-logo">
                        <svg width="36" height="36" viewBox="0 0 48 48" fill="none">
                            <path d="M24 4C13 4 4 13 4 24s9 20 20 20 20-9 20-20S35 4 24 4z" fill="#52B788"/>
                            <path d="M24 12c-1 5-4 9-8 11 2 3 5 5 8 5s6-2 8-5c-4-2-7-6-8-11z" fill="#B7E4C7"/>
                        </svg>
                        <strong><?php bloginfo('name'); ?></strong>
                    </div>
                    <p class="footer-about"><?php bloginfo('description'); ?> Tous nos produits CBD sont issus de l'agriculture biologique européenne et certifiés par des laboratoires indépendants.</p>
                    <div class="footer-certifs">
                        <span class="certif-badge">🌱 Bio</span>
                        <span class="certif-badge">🔬 Certifié labo</span>
                        <span class="certif-badge">🇪🇺 Made in EU</span>
                        <span class="certif-badge">⚡ THC &lt; 0.3%</span>
                    </div>
                    <div class="footer-social">
                        <a href="#" class="social-link" aria-label="Instagram">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/></svg>
                        </a>
                        <a href="#" class="social-link" aria-label="Facebook">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="social-link" aria-label="TikTok">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.5 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 0 0-.79-.05 6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.33-6.34V8.69a8.18 8.18 0 0 0 4.79 1.52V6.76a4.85 4.85 0 0 1-1.02-.07z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Colonne 2 : Produits -->
                <div class="footer-col">
                    <h3 class="footer-col__title">Nos Produits</h3>
                    <?php if ( is_active_sidebar('footer-col-2') ): ?>
                        <?php dynamic_sidebar('footer-col-2'); ?>
                    <?php else: ?>
                    <ul class="footer-links">
                        <li><a href="<?php echo esc_url(home_url('/boutique/huiles-cbd')); ?>">Huiles CBD</a></li>
                        <li><a href="<?php echo esc_url(home_url('/boutique/fleurs-cbd')); ?>">Fleurs CBD</a></li>
                        <li><a href="<?php echo esc_url(home_url('/boutique/gummies-cbd')); ?>">Gummies CBD</a></li>
                        <li><a href="<?php echo esc_url(home_url('/boutique/cosmetiques-cbd')); ?>">Cosmétiques CBD</a></li>
                        <li><a href="<?php echo esc_url(home_url('/boutique/infusions-cbd')); ?>">Infusions CBD</a></li>
                        <li><a href="<?php echo esc_url(home_url('/boutique/vape-cbd')); ?>">Vape & E-liquides</a></li>
                        <?php if ( class_exists('WooCommerce') ): ?>
                        <li><a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>">Toute la boutique</a></li>
                        <?php endif; ?>
                    </ul>
                    <?php endif; ?>
                </div>

                <!-- Colonne 3 : Informations -->
                <div class="footer-col">
                    <h3 class="footer-col__title">Informations</h3>
                    <?php if ( is_active_sidebar('footer-col-3') ): ?>
                        <?php dynamic_sidebar('footer-col-3'); ?>
                    <?php else: ?>
                    <ul class="footer-links">
                        <li><a href="<?php echo esc_url(home_url('/notre-histoire')); ?>">Notre histoire</a></li>
                        <li><a href="<?php echo esc_url(home_url('/qualite-cbd')); ?>">Notre qualité</a></li>
                        <li><a href="<?php echo esc_url(home_url('/rapports-laboratoire')); ?>">Rapports de labo</a></li>
                        <li><a href="<?php echo esc_url(home_url('/blog')); ?>">Blog CBD</a></li>
                        <li><a href="<?php echo esc_url(home_url('/faq')); ?>">FAQ</a></li>
                        <li><a href="<?php echo esc_url(home_url('/contact')); ?>">Contact</a></li>
                        <li><a href="<?php echo esc_url(home_url('/programme-fidelite')); ?>">Programme fidélité</a></li>
                    </ul>
                    <?php endif; ?>
                </div>

                <!-- Colonne 4 : Contact & Confiance -->
                <div class="footer-col">
                    <h3 class="footer-col__title">Service Client</h3>
                    <ul class="footer-contact">
                        <li>
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.27h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.9a16 16 0 0 0 5.9 5.9l.92-.93a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 21.99 17z"/></svg>
                            <span>Lun-Sam 9h-18h</span>
                        </li>
                        <li>
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            <a href="mailto:contact@greenpure-cbd.com">contact@greenpure-cbd.com</a>
                        </li>
                    </ul>
                    <div class="footer-trust">
                        <div class="trust-item">
                            <span class="trust-icon">🔒</span>
                            <span>Paiement sécurisé</span>
                        </div>
                        <div class="trust-item">
                            <span class="trust-icon">🚚</span>
                            <span>Livraison rapide</span>
                        </div>
                        <div class="trust-item">
                            <span class="trust-icon">↩️</span>
                            <span>Retour 14 jours</span>
                        </div>
                        <div class="trust-item">
                            <span class="trust-icon">⭐</span>
                            <span>4.9/5 avis clients</span>
                        </div>
                    </div>
                    <div class="payment-methods">
                        <img src="<?php echo GREENPURE_URI; ?>/assets/images/payment-visa.svg" alt="Visa" width="40" loading="lazy">
                        <img src="<?php echo GREENPURE_URI; ?>/assets/images/payment-mc.svg" alt="Mastercard" width="40" loading="lazy">
                        <img src="<?php echo GREENPURE_URI; ?>/assets/images/payment-paypal.svg" alt="PayPal" width="40" loading="lazy">
                        <img src="<?php echo GREENPURE_URI; ?>/assets/images/payment-applepay.svg" alt="Apple Pay" width="40" loading="lazy">
                    </div>
                </div>

            </div><!-- /.site-footer__grid -->
        </div><!-- /.container -->
    </div><!-- /.site-footer__main -->

    <!-- Footer Bottom -->
    <div class="site-footer__bottom">
        <div class="container">
            <div class="site-footer__bottom-inner">
                <p class="footer-copy">
                    &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Tous droits réservés.
                </p>
                <nav class="footer-legal-nav" aria-label="Liens légaux">
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'legal',
                        'container'      => false,
                        'menu_class'     => 'footer-legal-links',
                        'fallback_cb'    => function() {
                            echo '<ul class="footer-legal-links">';
                            echo '<li><a href="' . esc_url(home_url('/mentions-legales')) . '">Mentions légales</a></li>';
                            echo '<li><a href="' . esc_url(home_url('/politique-de-confidentialite')) . '">Confidentialité</a></li>';
                            echo '<li><a href="' . esc_url(home_url('/cgv')) . '">CGV</a></li>';
                            echo '<li><a href="' . esc_url(home_url('/cookies')) . '">Cookies</a></li>';
                            echo '</ul>';
                        },
                    ]);
                    ?>
                </nav>
                <p class="footer-disclaimer">Les produits CBD ne sont pas des médicaments. Non destinés aux mineurs.</p>
            </div>
        </div>
    </div>

</footer>

<!-- Cookie Banner -->
<div id="cookie-banner" class="cookie-banner" role="region" aria-label="Gestion des cookies" hidden>
    <div class="container">
        <div class="cookie-banner__inner">
            <div class="cookie-banner__text">
                <strong>🍪 Cookies</strong> — Nous utilisons des cookies pour améliorer votre expérience et analyser notre trafic.
                <a href="<?php echo esc_url(home_url('/cookies')); ?>">En savoir plus</a>
            </div>
            <div class="cookie-banner__actions">
                <button class="btn btn--outline btn--sm js-cookie-decline">Refuser</button>
                <button class="btn btn--primary btn--sm js-cookie-accept">Accepter</button>
            </div>
        </div>
    </div>
</div>

<!-- Back to top -->
<button class="back-to-top js-back-to-top" aria-label="Retour en haut">
    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <polyline points="18 15 12 9 6 15"/>
    </svg>
</button>

<?php wp_footer(); ?>
</body>
</html>

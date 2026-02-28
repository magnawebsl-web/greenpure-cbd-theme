<?php
/**
 * GreenPure CBD — Détection de langue européenne automatique
 * Détecte la langue via : 1) cookie, 2) Accept-Language header, 3) IP géolocalisation (optionnel)
 * Langues supportées : fr, en, de, nl, es, it, pt, pl
 */

if ( ! defined('ABSPATH') ) exit;

/* ──────────────────────────────────────
   CONSTANTES
────────────────────────────────────── */
define('GREENPURE_LANG_COOKIE', 'greenpure_lang');
define('GREENPURE_LANG_DEFAULT', 'fr');

/* Langues européennes supportées avec pays associés */
$GLOBALS['greenpure_lang_map'] = [
    'fr' => [
        'name'     => 'Français',
        'flag'     => '🇫🇷',
        'countries'=> ['FR', 'BE', 'CH', 'LU', 'MC'],
        'locale'   => 'fr_FR',
        'strings'  => [
            'add_to_cart'       => 'Ajouter au panier',
            'buy_now'           => 'Acheter maintenant',
            'free_shipping'     => 'Livraison gratuite dès 49€',
            'shipping_24h'      => 'Expédition sous 24h',
            'secure_payment'    => 'Paiement sécurisé 100%',
            'certified_thc'     => 'Certifiés < 0,3% THC',
            'age_title'         => 'Confirmation d\'âge requise',
            'age_text'          => 'Nos produits CBD sont réservés aux personnes majeures.',
            'age_question'      => 'Avez-vous <strong>18 ans ou plus</strong> ?',
            'age_yes'           => 'Oui, j\'ai 18 ans ou plus',
            'age_no'            => 'Non, je suis mineur(e)',
            'age_legal'         => 'En entrant sur ce site, vous confirmez avoir pris connaissance de nos',
            'age_legal_link'    => 'Mentions légales',
            'newsletter_title'  => 'Rejoignez la communauté GreenPure',
            'newsletter_sub'    => 'Recevez nos offres exclusives, conseils CBD et nouveautés',
            'newsletter_btn'    => 'S\'inscrire',
            'newsletter_ph'     => 'Votre adresse email',
            'view_all'          => 'Voir tout',
            'our_products'      => 'Nos produits',
            'new_badge'         => 'Nouveau',
            'sale_badge'        => 'Promo',
            'in_stock'          => 'En stock',
            'out_of_stock'      => 'Rupture de stock',
            'qty'               => 'Quantité',
            'product_info'      => 'Informations produit',
            'shipping_returns'  => 'Livraison & retours',
            'lab_report'        => 'Certificat d\'analyse',
            'cookie_text'       => 'Nous utilisons des cookies pour améliorer votre expérience.',
            'cookie_accept'     => 'Accepter',
            'cookie_decline'    => 'Refuser',
            'search_ph'         => 'Rechercher un produit...',
            'my_account'        => 'Mon compte',
            'login'             => 'Connexion',
            'logout'            => 'Déconnexion',
            'cart'              => 'Panier',
            'shop'              => 'Boutique',
        ],
    ],
    'en' => [
        'name'     => 'English',
        'flag'     => '🇬🇧',
        'countries'=> ['GB', 'IE', 'MT', 'CY'],
        'locale'   => 'en_GB',
        'strings'  => [
            'add_to_cart'       => 'Add to cart',
            'buy_now'           => 'Buy now',
            'free_shipping'     => 'Free shipping from €49',
            'shipping_24h'      => 'Ships within 24h',
            'secure_payment'    => '100% secure payment',
            'certified_thc'     => 'Certified < 0.3% THC',
            'age_title'         => 'Age Verification Required',
            'age_text'          => 'Our CBD products are reserved for adults.',
            'age_question'      => 'Are you <strong>18 or older</strong>?',
            'age_yes'           => 'Yes, I am 18 or older',
            'age_no'            => 'No, I am a minor',
            'age_legal'         => 'By entering this site, you confirm you have read our',
            'age_legal_link'    => 'Legal Notice',
            'newsletter_title'  => 'Join the GreenPure Community',
            'newsletter_sub'    => 'Receive exclusive offers, CBD tips and new arrivals',
            'newsletter_btn'    => 'Subscribe',
            'newsletter_ph'     => 'Your email address',
            'view_all'          => 'View all',
            'our_products'      => 'Our products',
            'new_badge'         => 'New',
            'sale_badge'        => 'Sale',
            'in_stock'          => 'In stock',
            'out_of_stock'      => 'Out of stock',
            'qty'               => 'Quantity',
            'product_info'      => 'Product information',
            'shipping_returns'  => 'Shipping & returns',
            'lab_report'        => 'Lab report (COA)',
            'cookie_text'       => 'We use cookies to improve your experience.',
            'cookie_accept'     => 'Accept',
            'cookie_decline'    => 'Decline',
            'search_ph'         => 'Search for a product...',
            'my_account'        => 'My account',
            'login'             => 'Login',
            'logout'            => 'Logout',
            'cart'              => 'Cart',
            'shop'              => 'Shop',
        ],
    ],
    'de' => [
        'name'     => 'Deutsch',
        'flag'     => '🇩🇪',
        'countries'=> ['DE', 'AT', 'LI'],
        'locale'   => 'de_DE',
        'strings'  => [
            'add_to_cart'       => 'In den Warenkorb',
            'buy_now'           => 'Jetzt kaufen',
            'free_shipping'     => 'Kostenloser Versand ab 49€',
            'shipping_24h'      => 'Versand innerhalb 24h',
            'secure_payment'    => '100% sichere Zahlung',
            'certified_thc'     => 'Zertifiziert < 0,3% THC',
            'age_title'         => 'Altersverifikation erforderlich',
            'age_text'          => 'Unsere CBD-Produkte sind nur für Erwachsene.',
            'age_question'      => 'Sind Sie <strong>18 Jahre oder älter</strong>?',
            'age_yes'           => 'Ja, ich bin 18 oder älter',
            'age_no'            => 'Nein, ich bin minderjährig',
            'age_legal'         => 'Mit dem Betreten bestätigen Sie unsere',
            'age_legal_link'    => 'Rechtliche Hinweise',
            'newsletter_title'  => 'Treten Sie der GreenPure Community bei',
            'newsletter_sub'    => 'Erhalten Sie exklusive Angebote, CBD-Tipps und Neuheiten',
            'newsletter_btn'    => 'Anmelden',
            'newsletter_ph'     => 'Ihre E-Mail-Adresse',
            'view_all'          => 'Alle anzeigen',
            'our_products'      => 'Unsere Produkte',
            'new_badge'         => 'Neu',
            'sale_badge'        => 'Angebot',
            'in_stock'          => 'Auf Lager',
            'out_of_stock'      => 'Ausverkauft',
            'qty'               => 'Menge',
            'product_info'      => 'Produktinformation',
            'shipping_returns'  => 'Versand & Rücksendung',
            'lab_report'        => 'Analysezertifikat',
            'cookie_text'       => 'Wir verwenden Cookies, um Ihr Erlebnis zu verbessern.',
            'cookie_accept'     => 'Akzeptieren',
            'cookie_decline'    => 'Ablehnen',
            'search_ph'         => 'Produkt suchen...',
            'my_account'        => 'Mein Konto',
            'login'             => 'Anmelden',
            'logout'            => 'Abmelden',
            'cart'              => 'Warenkorb',
            'shop'              => 'Shop',
        ],
    ],
    'nl' => [
        'name'     => 'Nederlands',
        'flag'     => '🇳🇱',
        'countries'=> ['NL', 'BE'],
        'locale'   => 'nl_NL',
        'strings'  => [
            'add_to_cart'       => 'Toevoegen aan winkelwagen',
            'buy_now'           => 'Nu kopen',
            'free_shipping'     => 'Gratis verzending vanaf €49',
            'shipping_24h'      => 'Verzending binnen 24u',
            'secure_payment'    => '100% veilig betalen',
            'certified_thc'     => 'Gecertificeerd < 0,3% THC',
            'age_title'         => 'Leeftijdsverificatie vereist',
            'age_text'          => 'Onze CBD-producten zijn uitsluitend voor volwassenen.',
            'age_question'      => 'Bent u <strong>18 jaar of ouder</strong>?',
            'age_yes'           => 'Ja, ik ben 18 of ouder',
            'age_no'            => 'Nee, ik ben minderjarig',
            'age_legal'         => 'Door het betreden bevestigt u onze',
            'age_legal_link'    => 'Juridische kennisgeving',
            'newsletter_title'  => 'Word lid van de GreenPure Community',
            'newsletter_sub'    => 'Ontvang exclusieve aanbiedingen en CBD-tips',
            'newsletter_btn'    => 'Inschrijven',
            'newsletter_ph'     => 'Uw e-mailadres',
            'view_all'          => 'Alles bekijken',
            'our_products'      => 'Onze producten',
            'new_badge'         => 'Nieuw',
            'sale_badge'        => 'Aanbieding',
            'in_stock'          => 'Op voorraad',
            'out_of_stock'      => 'Uitverkocht',
            'qty'               => 'Aantal',
            'product_info'      => 'Productinformatie',
            'shipping_returns'  => 'Verzending & retour',
            'lab_report'        => 'Analysecertificaat',
            'cookie_text'       => 'We gebruiken cookies om uw ervaring te verbeteren.',
            'cookie_accept'     => 'Accepteren',
            'cookie_decline'    => 'Weigeren',
            'search_ph'         => 'Zoek een product...',
            'my_account'        => 'Mijn account',
            'login'             => 'Inloggen',
            'logout'            => 'Uitloggen',
            'cart'              => 'Winkelwagen',
            'shop'              => 'Winkel',
        ],
    ],
    'es' => [
        'name'     => 'Español',
        'flag'     => '🇪🇸',
        'countries'=> ['ES'],
        'locale'   => 'es_ES',
        'strings'  => [
            'add_to_cart'       => 'Añadir al carrito',
            'buy_now'           => 'Comprar ahora',
            'free_shipping'     => 'Envío gratis desde 49€',
            'shipping_24h'      => 'Envío en 24h',
            'secure_payment'    => 'Pago 100% seguro',
            'certified_thc'     => 'Certificado < 0,3% THC',
            'age_title'         => 'Verificación de edad requerida',
            'age_text'          => 'Nuestros productos CBD están reservados para adultos.',
            'age_question'      => '¿Tiene <strong>18 años o más</strong>?',
            'age_yes'           => 'Sí, tengo 18 o más',
            'age_no'            => 'No, soy menor de edad',
            'age_legal'         => 'Al entrar, confirma haber leído nuestro',
            'age_legal_link'    => 'Aviso legal',
            'newsletter_title'  => 'Únase a la comunidad GreenPure',
            'newsletter_sub'    => 'Reciba ofertas exclusivas, consejos CBD y novedades',
            'newsletter_btn'    => 'Suscribirse',
            'newsletter_ph'     => 'Su dirección de email',
            'view_all'          => 'Ver todo',
            'our_products'      => 'Nuestros productos',
            'new_badge'         => 'Nuevo',
            'sale_badge'        => 'Oferta',
            'in_stock'          => 'En stock',
            'out_of_stock'      => 'Agotado',
            'qty'               => 'Cantidad',
            'product_info'      => 'Información del producto',
            'shipping_returns'  => 'Envío y devoluciones',
            'lab_report'        => 'Certificado de análisis',
            'cookie_text'       => 'Usamos cookies para mejorar su experiencia.',
            'cookie_accept'     => 'Aceptar',
            'cookie_decline'    => 'Rechazar',
            'search_ph'         => 'Buscar un producto...',
            'my_account'        => 'Mi cuenta',
            'login'             => 'Iniciar sesión',
            'logout'            => 'Cerrar sesión',
            'cart'              => 'Carrito',
            'shop'              => 'Tienda',
        ],
    ],
    'it' => [
        'name'     => 'Italiano',
        'flag'     => '🇮🇹',
        'countries'=> ['IT', 'SM', 'VA'],
        'locale'   => 'it_IT',
        'strings'  => [
            'add_to_cart'       => 'Aggiungi al carrello',
            'buy_now'           => 'Acquista ora',
            'free_shipping'     => 'Spedizione gratuita da 49€',
            'shipping_24h'      => 'Spedizione in 24h',
            'secure_payment'    => 'Pagamento 100% sicuro',
            'certified_thc'     => 'Certificato < 0,3% THC',
            'age_title'         => 'Verifica dell\'età richiesta',
            'age_text'          => 'I nostri prodotti CBD sono riservati agli adulti.',
            'age_question'      => 'Ha <strong>18 anni o più</strong>?',
            'age_yes'           => 'Sì, ho 18 anni o più',
            'age_no'            => 'No, sono minorenne',
            'age_legal'         => 'Entrando nel sito, conferma di aver letto la nostra',
            'age_legal_link'    => 'Nota legale',
            'newsletter_title'  => 'Unisciti alla community GreenPure',
            'newsletter_sub'    => 'Ricevi offerte esclusive, consigli CBD e novità',
            'newsletter_btn'    => 'Iscriviti',
            'newsletter_ph'     => 'Il tuo indirizzo email',
            'view_all'          => 'Vedi tutto',
            'our_products'      => 'I nostri prodotti',
            'new_badge'         => 'Nuovo',
            'sale_badge'        => 'Offerta',
            'in_stock'          => 'Disponibile',
            'out_of_stock'      => 'Esaurito',
            'qty'               => 'Quantità',
            'product_info'      => 'Informazioni prodotto',
            'shipping_returns'  => 'Spedizione e resi',
            'lab_report'        => 'Certificato di analisi',
            'cookie_text'       => 'Utilizziamo i cookie per migliorare la tua esperienza.',
            'cookie_accept'     => 'Accetta',
            'cookie_decline'    => 'Rifiuta',
            'search_ph'         => 'Cerca un prodotto...',
            'my_account'        => 'Il mio account',
            'login'             => 'Accedi',
            'logout'            => 'Esci',
            'cart'              => 'Carrello',
            'shop'              => 'Negozio',
        ],
    ],
];

/* ──────────────────────────────────────
   DÉTECTEUR DE LANGUE
────────────────────────────────────── */

/**
 * Retourne le code de langue actif (fr, en, de, nl, es, it)
 * Priorité : 1) Cookie manuel, 2) Accept-Language header, 3) Défaut FR
 */
function greenpure_get_lang() {
    static $lang_cache = null;
    if ( $lang_cache !== null ) return $lang_cache;

    $supported = array_keys($GLOBALS['greenpure_lang_map']);

    // 1. Cookie — préférence manuelle du visiteur
    if ( isset($_COOKIE[GREENPURE_LANG_COOKIE]) ) {
        $cookie_lang = sanitize_key($_COOKIE[GREENPURE_LANG_COOKIE]);
        if ( in_array($cookie_lang, $supported, true) ) {
            $lang_cache = $cookie_lang;
            return $lang_cache;
        }
    }

    // 2. Accept-Language header
    $accept = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : '';

    if ( $accept ) {
        // Parser "fr-FR,fr;q=0.9,en-US;q=0.8,en;q=0.7,de;q=0.6"
        $langs_weighted = [];
        preg_match_all('/([a-zA-Z]{2,3})(?:-[a-zA-Z]{2,4})?(?:;q=([0-9.]+))?/', $accept, $matches, PREG_SET_ORDER);

        foreach ( $matches as $m ) {
            $code   = strtolower(substr($m[1], 0, 2));
            $weight = isset($m[2]) && $m[2] !== '' ? (float) $m[2] : 1.0;
            if ( ! isset($langs_weighted[$code]) || $langs_weighted[$code] < $weight ) {
                $langs_weighted[$code] = $weight;
            }
        }

        arsort($langs_weighted);

        foreach ( array_keys($langs_weighted) as $code ) {
            if ( in_array($code, $supported, true) ) {
                $lang_cache = $code;
                return $lang_cache;
            }
        }
    }

    // 3. Défaut
    $lang_cache = GREENPURE_LANG_DEFAULT;
    return $lang_cache;
}

/**
 * Récupère une chaîne traduite dans la langue active
 *
 * @param string $key    Clé de traduction (ex: 'add_to_cart')
 * @param string $lang   Code langue (optionnel, détecté auto)
 * @return string
 */
function greenpure_t( $key, $lang = null ) {
    if ( ! $lang ) $lang = greenpure_get_lang();
    $map = $GLOBALS['greenpure_lang_map'];
    if ( isset($map[$lang]['strings'][$key]) ) return $map[$lang]['strings'][$key];
    // Fallback vers FR
    if ( isset($map['fr']['strings'][$key]) ) return $map['fr']['strings'][$key];
    return $key;
}

/**
 * Génère le HTML du sélecteur de langue pour le header
 * @return string
 */
function greenpure_lang_switcher_html() {
    $lang    = greenpure_get_lang();
    $map     = $GLOBALS['greenpure_lang_map'];

    ob_start();
    ?>
    <div class="lang-switcher" id="lang-switcher-wrap">
        <button class="lang-switcher__current" id="lang-switcher-btn" aria-expanded="false" aria-haspopup="listbox">
            <span class="lang-flag"><?php echo $map[$lang]['flag']; ?></span>
            <span class="lang-code"><?php echo strtoupper($lang); ?></span>
            <svg width="10" height="10" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
        </button>
        <ul class="lang-switcher__dropdown" role="listbox" aria-label="Choisir une langue">
            <?php foreach ( $map as $code => $data ) : ?>
            <li role="option" aria-selected="<?php echo $code === $lang ? 'true' : 'false'; ?>">
                <a href="<?php echo esc_url( add_query_arg('set_lang', $code) ); ?>"
                   class="lang-option<?php echo $code === $lang ? ' is-active' : ''; ?>"
                   data-lang="<?php echo esc_attr($code); ?>">
                    <span class="lang-flag"><?php echo $data['flag']; ?></span>
                    <span><?php echo esc_html($data['name']); ?></span>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php
    return ob_get_clean();
}

/* ──────────────────────────────────────
   HOOK — Définir la langue via URL (?set_lang=de)
   & passer les traductions au JS
────────────────────────────────────── */
function greenpure_handle_lang_switch() {
    if ( isset($_GET['set_lang']) ) {
        $requested = sanitize_key($_GET['set_lang']);
        $supported = array_keys($GLOBALS['greenpure_lang_map']);
        if ( in_array($requested, $supported, true) ) {
            setcookie(GREENPURE_LANG_COOKIE, $requested, time() + 365 * DAY_IN_SECONDS, '/', '', is_ssl(), true);
            wp_safe_redirect( remove_query_arg('set_lang') );
            exit;
        }
    }
}
add_action('init', 'greenpure_handle_lang_switch');

/**
 * Injecter les traductions JS et la langue active dans greenpureData
 */
function greenpure_localize_lang() {
    $lang    = greenpure_get_lang();
    $map     = $GLOBALS['greenpure_lang_map'];
    $strings = $map[$lang]['strings'] ?? [];

    wp_localize_script('greenpure-main', 'greenpureLang', [
        'current' => $lang,
        'strings' => $strings,
    ]);
}
add_action('wp_enqueue_scripts', 'greenpure_localize_lang', 20);

/* ──────────────────────────────────────
   HOOK — Ajouter data-lang au <body>
────────────────────────────────────── */
function greenpure_body_lang_class( $classes ) {
    $classes[] = 'lang-' . greenpure_get_lang();
    return $classes;
}
add_filter('body_class', 'greenpure_body_lang_class');

/* ──────────────────────────────────────
   CSS inline — Lang switcher
────────────────────────────────────── */
function greenpure_lang_switcher_css() {
    ?>
    <style id="greenpure-lang-css">
    .lang-switcher{position:relative;}
    .lang-switcher__current{display:flex;align-items:center;gap:5px;padding:6px 10px;border-radius:20px;border:1.5px solid rgba(255,255,255,.25);background:rgba(255,255,255,.08);color:inherit;cursor:pointer;font-size:.8rem;font-weight:600;transition:background .2s;}
    .lang-switcher__current:hover{background:rgba(255,255,255,.15);}
    .lang-flag{font-size:1rem;line-height:1;}
    .lang-code{font-size:.75rem;font-weight:700;letter-spacing:.05em;}
    .lang-switcher__dropdown{position:absolute;top:calc(100% + 8px);right:0;min-width:150px;background:#fff;border-radius:12px;box-shadow:0 12px 40px rgba(0,0,0,.15);border:1px solid rgba(0,0,0,.06);padding:6px;z-index:9999;opacity:0;transform:translateY(-8px) scale(.98);pointer-events:none;transition:opacity .2s,transform .2s;list-style:none;}
    .lang-switcher--open .lang-switcher__dropdown{opacity:1;transform:translateY(0) scale(1);pointer-events:all;}
    .lang-option{display:flex;align-items:center;gap:8px;padding:8px 12px;border-radius:8px;font-size:.88rem;font-weight:500;color:#1B2C22;text-decoration:none;transition:background .15s;}
    .lang-option:hover,.lang-option.is-active{background:#F0F7F4;color:#2D6A4F;}
    .lang-option.is-active{font-weight:700;}
    /* Topbar sombre → couleurs adaptées */
    .topbar .lang-switcher__dropdown{top:calc(100% + 4px);}
    </style>
    <?php
}
add_action('wp_head', 'greenpure_lang_switcher_css', 5);

/* JS inline pour toggle du sélecteur */
function greenpure_lang_switcher_js() {
    ?>
    <script>
    (function(){
        document.addEventListener('DOMContentLoaded',function(){
            var btn=document.getElementById('lang-switcher-btn');
            var wrap=document.getElementById('lang-switcher-wrap');
            if(!btn||!wrap) return;
            btn.addEventListener('click',function(e){
                e.stopPropagation();
                var open=wrap.classList.toggle('lang-switcher--open');
                btn.setAttribute('aria-expanded',open?'true':'false');
            });
            document.addEventListener('click',function(){
                wrap.classList.remove('lang-switcher--open');
                btn.setAttribute('aria-expanded','false');
            });
        });
    })();
    </script>
    <?php
}
add_action('wp_footer', 'greenpure_lang_switcher_js');

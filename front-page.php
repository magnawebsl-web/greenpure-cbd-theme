<?php get_header(); ?>

<!-- ══════════════════════════════════════════════════
     SECTION 1 — HERO
══════════════════════════════════════════════════ -->
<section class="hero" aria-label="Section principale">
    <div class="hero__bg" aria-hidden="true"></div>
    <!-- Formes décoratives animées -->
    <div class="hero__shapes" aria-hidden="true">
        <div class="hero__shape hero__shape--1"></div>
        <div class="hero__shape hero__shape--2"></div>
        <div class="hero__shape hero__shape--3"></div>
    </div>
    <div id="particles" class="hero__particles" aria-hidden="true"></div>
    <div class="container">
        <div class="hero__inner">
            <div class="hero__content hero__content--animated">
                <span class="hero__eyebrow">
                    <svg width="8" height="8" viewBox="0 0 8 8" fill="#F4CC6A"><circle cx="4" cy="4" r="4"/></svg>
                    Certifié &lt; 0,3% THC • Agriculture Biologique
                </span>
                <h1 class="hero__title">
                    <span class="line">Le CBD</span>
                    <span class="line"><em>qui change</em></span>
                    <span class="line">votre vie</span>
                </h1>
                <p class="hero__subtitle">
                    Découvrez notre gamme premium de produits CBD 100% naturels.
                    Huiles, gummies, fleurs — formulés pour votre bien-être,
                    testés par des laboratoires indépendants.
                </p>
                <div class="hero__actions">
                    <?php if ( class_exists('WooCommerce') ): ?>
                    <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="btn btn--gold btn--lg">
                        Découvrir nos produits
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                    <?php endif; ?>
                    <a href="#bestsellers" class="btn btn--outline-white btn--lg">Nos bestsellers</a>
                </div>
                <div class="hero__trust">
                    <div class="hero__trust-item">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                        Livraison offerte dès 49€
                    </div>
                    <div class="hero__trust-item">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                        Satisfait ou remboursé 14j
                    </div>
                    <div class="hero__trust-item">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                        4.9/5 — 2 000+ avis vérifiés
                    </div>
                </div>
            </div>
            <div class="hero__visual hero__visual--animated">
                <div class="hero__product-showcase">
                    <div class="showcase-glow"></div>
                    <div class="showcase-rings">
                        <div class="ring ring--1"></div>
                        <div class="ring ring--2"></div>
                        <div class="ring ring--3"></div>
                    </div>
                    <?php
                    // Afficher produit vedette WooCommerce ou placeholder
                    if ( class_exists('WooCommerce') ) {
                        $featured = wc_get_products(['limit' => 1, 'featured' => true, 'status' => 'publish']);
                        if ( $featured ) {
                            $prod = $featured[0];
                            echo '<a href="' . esc_url($prod->get_permalink()) . '" class="showcase-product">';
                            echo $prod->get_image('greenpure-product', ['class' => 'showcase-img', 'loading' => 'eager']);
                            echo '<div class="showcase-badge"><span>' . esc_html($prod->get_name()) . '</span><strong>' . $prod->get_price_html() . '</strong></div>';
                            echo '</a>';
                        } else {
                            echo '<div class="showcase-product-static">
                                <img src="' . esc_url(GREENPURE_URI . '/assets/images/products-premium/borea_huile_cbd_luxe.png') . '"
                                     alt="Huile CBD Premium Boréa CBD"
                                     class="showcase-img"
                                     width="340" height="340"
                                     loading="eager">
                                <div class="showcase-badge">
                                    <span>Huile CBD Full Spectrum</span>
                                    <strong>34,90 €</strong>
                                </div>
                            </div>';
                        }
                    }
                    ?>
                    <!-- Floating badges -->
                    <div class="floating-badge floating-badge--1">
                        <span class="fb-icon">🌿</span>
                        <span class="fb-text">100% Bio</span>
                    </div>
                    <div class="floating-badge floating-badge--2">
                        <span class="fb-icon">🔬</span>
                        <span class="fb-text">Certifié labo</span>
                    </div>
                    <div class="floating-badge floating-badge--3">
                        <span class="fb-stars">★★★★★</span>
                        <span class="fb-text">2000+ avis</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="hero__scroll-hint">
        <span>Défiler</span>
        <div class="scroll-line"></div>
    </div>
</section>

<!-- ══════════════════════════════════════════════════
     SECTION 2 — BANDE DE CONFIANCE
══════════════════════════════════════════════════ -->
<section class="trust-bar">
    <div class="container">
        <div class="trust-bar__grid">
            <div class="trust-bar__item">
                <div class="trust-bar__icon">🚚</div>
                <div class="trust-bar__text">
                    <strong>Livraison Express</strong>
                    <span>Expédié sous 24h • Gratuit dès 49€</span>
                </div>
            </div>
            <div class="trust-bar__item">
                <div class="trust-bar__icon">🔬</div>
                <div class="trust-bar__text">
                    <strong>Certifié Laboratoire</strong>
                    <span>Rapports disponibles pour chaque produit</span>
                </div>
            </div>
            <div class="trust-bar__item">
                <div class="trust-bar__icon">🌱</div>
                <div class="trust-bar__text">
                    <strong>100% Agriculture Bio</strong>
                    <span>Chanvre européen cultivé sans pesticides</span>
                </div>
            </div>
            <div class="trust-bar__item">
                <div class="trust-bar__icon">↩️</div>
                <div class="trust-bar__text">
                    <strong>Satisfait ou Remboursé</strong>
                    <span>14 jours pour changer d'avis</span>
                </div>
            </div>
            <div class="trust-bar__item">
                <div class="trust-bar__icon">🔒</div>
                <div class="trust-bar__text">
                    <strong>Paiement Sécurisé</strong>
                    <span>SSL • Visa • Mastercard • PayPal</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════════
     SECTION 3 — CATÉGORIES
══════════════════════════════════════════════════ -->
<section class="categories-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-eyebrow">Notre gamme complète</span>
            <h2 class="section-title">Trouvez votre produit CBD idéal</h2>
            <p class="section-subtitle">Du bien-être quotidien au soin naturel, nos produits s'adaptent à vos besoins.</p>
        </div>
        <div class="categories-grid" data-aos="fade-up" data-aos-delay="100">
            <?php
            /* SVG illustrations inline par catégorie */
            $cat_svgs = [
                'huiles-cbd'    => ['bg'=>'#1a3a2a','grad'=>'#2D6A4F,#52B788','svg'=>'<path d="M14 2H10C9 2 8 2.5 8 3.5V5H7C6 5 5 6 5 7v1c0 3 2 5 4 6v5H8v2h8v-2h-1v-5c2-1 4-3 4-6V7c0-1-1-2-2-2h-1V3.5C16 2.5 15 2 14 2zM9 5h6v1H9V5zm5.5 12h-3v-4.3C13 13 14.5 11.5 15 10H9c.5 1.5 2 3 3.5 2.7V17H10v-4C8.5 12 7 10 7 8V7h10v1c0 2-1.5 4-3 5v4z" fill="white"/>'],
                'fleurs-cbd'    => ['bg'=>'#2d1b4e','grad'=>'#6B3FA0,#9B59B6','svg'=>'<path d="M12 2c-1 3-3 5-6 5 1 3 3 5 6 5s5-2 6-5c-3 0-5-2-6-5z" fill="white"/><path d="M12 12c-1 3-3 5-6 5 1 2 3 4 6 4s5-2 6-4c-3 0-5-2-6-5z" fill="rgba(255,255,255,0.6)"/><line x1="12" y1="12" x2="12" y2="21" stroke="white" stroke-width="1.5"/>'],
                'gummies-cbd'   => ['bg'=>'#6b3a00','grad'=>'#D4700A,#F39C12','svg'=>'<circle cx="8" cy="8" r="4.5" fill="white"/><circle cx="16" cy="8" r="4.5" fill="rgba(255,255,255,0.7)"/><circle cx="8" cy="16" r="4.5" fill="rgba(255,255,255,0.7)"/><circle cx="16" cy="16" r="4.5" fill="rgba(255,255,255,0.5)"/>'],
                'cosmetiques'   => ['bg'=>'#5a0a2a','grad'=>'#C2185B,#E91E63','svg'=>'<path d="M12 2a5 5 0 0 1 5 5c0 2-1 3.5-2.5 4.5V20a2.5 2.5 0 0 1-5 0v-8.5C8 10.5 7 9 7 7a5 5 0 0 1 5-5z" fill="white"/><ellipse cx="12" cy="7" rx="2.5" ry="3" fill="rgba(255,255,255,0.4)"/>'],
                'infusions-cbd' => ['bg'=>'#0d2b0d','grad'=>'#2E7D32,#4CAF50','svg'=>'<path d="M6 4h12l-1.5 10H7.5L6 4z" fill="rgba(255,255,255,0.4)"/><path d="M7.5 14s0 5 4.5 5 4.5-5 4.5-5H7.5z" fill="white"/><path d="M10 4c0-1.5 1-2.5 2-2.5s2 1 2 2.5" fill="none" stroke="white" stroke-width="1.5"/><path d="M17 8c1 0 3 .5 3 2.5S18 13 17 13" fill="none" stroke="white" stroke-width="1.5"/>'],
                'capsules-cbd'  => ['bg'=>'#012b4a','grad'=>'#0277BD,#0288D1','svg'=>'<ellipse cx="12" cy="12" rx="5" ry="9" fill="none" stroke="white" stroke-width="1.5"/><line x1="7" y1="12" x2="17" y2="12" stroke="white" stroke-width="1.5"/><ellipse cx="12" cy="8" rx="5" ry="4" fill="rgba(255,255,255,0.5)"/>'],
                'e-liquides'    => ['bg'=>'#1a2530','grad'=>'#37474F,#546E7A','svg'=>'<rect x="9" y="2" width="6" height="3" rx="1.5" fill="white"/><rect x="8" y="5" width="8" height="14" rx="2" fill="rgba(255,255,255,0.7)"/><path d="M11 9c0 2 1 3 1 5" fill="none" stroke="white" stroke-width="1.5" stroke-linecap="round"/>'],
                'hash-cbd'      => ['bg'=>'#2a1500','grad'=>'#795548,#A1887F','svg'=>'<rect x="5" y="7" width="14" height="10" rx="2" fill="white"/><rect x="8" y="10" width="8" height="1.5" rx=".75" fill="rgba(120,80,40,0.6)"/><rect x="8" y="13" width="8" height="1.5" rx=".75" fill="rgba(120,80,40,0.6)"/>'],
                'packs'         => ['bg'=>'#0a2a3a','grad'=>'#00695C,#26A69A','svg'=>'<rect x="5" y="11" width="6" height="8" rx="1" fill="white"/><rect x="13" y="8" width="6" height="11" rx="1" fill="rgba(255,255,255,0.8)"/><rect x="8" y="5" width="5" height="6" rx="1" fill="rgba(255,255,255,0.6)"/>'],
                'pet-cbd'       => ['bg'=>'#1a3040','grad'=>'#0277BD,#4FC3F7','svg'=>'<path d="M8 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm8 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4zM4 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm16 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4zM6 14c0-3.3 2.7-6 6-6s6 2.7 6 6c0 3-1 5-3 6H9c-2-1-3-3-3-6z" fill="white"/>'],
                'concentres'    => ['bg'=>'#2a0a3a','grad'=>'#7B1FA2,#BA68C8','svg'=>'<rect x="9" y="2" width="6" height="10" rx="3" fill="white"/><path d="M8 12h8l-1 9H9l-1-9z" fill="rgba(255,255,255,0.7)"/>'],
                'cbn'           => ['bg'=>'#1a2a1a','grad'=>'#388E3C,#66BB6A','svg'=>'<circle cx="12" cy="12" r="8" fill="none" stroke="white" stroke-width="1.5"/><path d="M9 12h6M12 9v6" stroke="white" stroke-width="2"/><circle cx="12" cy="12" r="3" fill="rgba(255,255,255,0.4)"/>'],
            ];

            if ( class_exists('WooCommerce') ) {
                $cats = get_terms(['taxonomy' => 'product_cat', 'hide_empty' => false, 'exclude' => [get_option('default_product_cat')], 'number' => 12, 'orderby' => 'count', 'order' => 'DESC']);
                if ( !empty($cats) && !is_wp_error($cats) ) {
                    foreach ( $cats as $cat ) {
                        $thumb_id  = get_term_meta($cat->term_id, 'thumbnail_id', true);
                        $link      = get_term_link($cat);
                        $cfg       = $cat_svgs[$cat->slug] ?? ['bg'=>'#1a3a2a','grad'=>'#2D6A4F,#52B788','svg'=>'<circle cx="12" cy="12" r="8" fill="rgba(255,255,255,0.5)"/>'];
                        ?>
                        <a href="<?php echo esc_url($link); ?>" class="category-card">
                            <div class="category-card__image">
                                <?php if ( $thumb_id ) : ?>
                                    <?php echo wp_get_attachment_image($thumb_id, 'greenpure-product', false, ['loading' => 'lazy', 'alt' => esc_attr($cat->name)]); ?>
                                <?php else : ?>
                                    <div class="category-card__svg-bg" style="background:linear-gradient(135deg,<?php echo esc_attr($cfg['grad']); ?>);">
                                        <svg width="80" height="80" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <?php echo $cfg['svg']; ?>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                                <div class="category-card__overlay"></div>
                            </div>
                            <div class="category-card__content">
                                <h3><?php echo esc_html($cat->name); ?></h3>
                                <span class="cat-count"><?php echo esc_html($cat->count); ?> produit<?php echo $cat->count > 1 ? 's' : ''; ?></span>
                                <span class="cat-arrow">→</span>
                            </div>
                        </a>
                        <?php
                    }
                } else {
                    // Catégories statiques fallback
                    $static_cats = [
                        ['name' => 'Huiles CBD', 'slug' => 'huiles-cbd', 'img' => 'huile-cbd-10.svg', 'count' => 17],
                        ['name' => 'Fleurs CBD', 'slug' => 'fleurs-cbd', 'img' => 'fleur-indoor.svg', 'count' => 15],
                        ['name' => 'Gummies CBD', 'slug' => 'gummies-cbd', 'img' => 'gummies-fruits.svg', 'count' => 10],
                        ['name' => 'Cosmétiques', 'slug' => 'cosmetiques', 'img' => 'creme-cbd.svg', 'count' => 9],
                        ['name' => 'Infusions CBD', 'slug' => 'infusions-cbd', 'img' => 'infusion-cbd.svg', 'count' => 8],
                        ['name' => 'Capsules CBD', 'slug' => 'capsules-cbd', 'img' => 'capsules-cbd.svg', 'count' => 8],
                        ['name' => 'E-Liquides', 'slug' => 'e-liquides', 'img' => 'eliquide-cbd.svg', 'count' => 10],
                        ['name' => 'Hash CBD', 'slug' => 'hash-cbd', 'img' => 'hash-cbd.svg', 'count' => 5],
                    ];
                    foreach ($static_cats as $cat):
                    ?>
                    <a href="<?php echo esc_url(class_exists('WooCommerce') ? get_permalink(wc_get_page_id('shop')) : home_url('/boutique/' . $cat['slug'])); ?>" class="category-card">
                        <div class="category-card__image">
                            <div class="category-card__svg-wrap">
                                <img src="<?php echo esc_url(GREENPURE_URI . '/assets/images/products/' . $cat['img']); ?>"
                                     alt="<?php echo esc_attr($cat['name']); ?>"
                                     width="160" height="160" loading="lazy">
                            </div>
                            <div class="category-card__overlay"></div>
                        </div>
                        <div class="category-card__content">
                            <h3><?php echo esc_html($cat['name']); ?></h3>
                            <span class="cat-count"><?php echo esc_html($cat['count']); ?> produits</span>
                            <span class="cat-arrow">→</span>
                        </div>
                    </a>
                    <?php endforeach;
                }
            }
            ?>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════════
     SECTION 4 — BESTSELLERS
══════════════════════════════════════════════════ -->
<section class="bestsellers-section" id="bestsellers">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-eyebrow">Les plus aimés</span>
            <h2 class="section-title">Bestsellers du moment</h2>
            <p class="section-subtitle">Les produits plébiscités par notre communauté de plus de 50 000 clients satisfaits.</p>
        </div>

        <!-- Filtres produits -->
        <div class="product-filters" data-aos="fade-up" data-aos-delay="50">
            <button class="filter-btn active" data-filter="all">Tous</button>
            <button class="filter-btn" data-filter="huiles-cbd">Huiles CBD</button>
            <button class="filter-btn" data-filter="fleurs-cbd">Fleurs</button>
            <button class="filter-btn" data-filter="gummies-cbd">Gummies</button>
            <button class="filter-btn" data-filter="cosmetiques">Cosmétiques</button>
            <button class="filter-btn" data-filter="hash-cbd">Hash</button>
            <button class="filter-btn" data-filter="capsules-cbd">Capsules</button>
            <button class="filter-btn" data-filter="packs">Packs</button>
        </div>

        <div class="products-grid products-grid--4" data-aos="fade-up" data-aos-delay="100">
            <?php
            if ( class_exists('WooCommerce') ) {
                $args = [
                    'post_type'      => 'product',
                    'posts_per_page' => 8,
                    'meta_key'       => 'total_sales',
                    'orderby'        => 'meta_value_num',
                    'order'          => 'DESC',
                    'post_status'    => 'publish',
                ];
                $products = new WP_Query($args);
                if ( $products->have_posts() ) {
                    while ( $products->have_posts() ) {
                        $products->the_post();
                        global $product;
                        ?>
                        <div class="product-card" data-category="<?php echo esc_attr(implode(' ', wp_get_post_terms(get_the_ID(), 'product_cat', ['fields' => 'slugs']))); ?>">
                            <?php do_action('woocommerce_before_shop_loop_item'); ?>
                            <div class="product-card__image">
                                <a href="<?php echo esc_url($product->get_permalink()); ?>">
                                    <?php echo $product->get_image('greenpure-product', ['class' => 'product-card__img', 'loading' => 'lazy']); ?>
                                    <?php if ( $product->is_on_sale() ): ?>
                                        <span class="product-badge product-badge--sale">
                                            -<?php echo round((($product->get_regular_price() - $product->get_sale_price()) / $product->get_regular_price()) * 100); ?>%
                                        </span>
                                    <?php endif; ?>
                                </a>
                                <div class="product-card__actions">
                                    <button class="product-card__wishlist" aria-label="Ajouter aux favoris">
                                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                                    </button>
                                    <a href="<?php echo esc_url($product->get_permalink()); ?>" class="product-card__quickview" aria-label="Aperçu rapide">
                                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                    </a>
                                </div>
                            </div>
                            <div class="product-card__body">
                                <?php $cbd = get_post_meta(get_the_ID(), '_cbd_concentration', true); ?>
                                <?php if ($cbd): ?><span class="product-card__tag"><?php echo esc_html($cbd); ?></span><?php endif; ?>
                                <h3 class="product-card__title">
                                    <a href="<?php echo esc_url($product->get_permalink()); ?>"><?php the_title(); ?></a>
                                </h3>
                                <div class="product-card__rating">
                                    <?php echo wc_get_rating_html($product->get_average_rating(), $product->get_review_count()); ?>
                                    <span class="rating-count">(<?php echo $product->get_review_count(); ?>)</span>
                                </div>
                                <div class="product-card__footer">
                                    <div class="product-card__price"><?php echo $product->get_price_html(); ?></div>
                                    <?php woocommerce_template_loop_add_to_cart(); ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    wp_reset_postdata();
                } else {
                    // Produits démo
                    $demo_products = [
                        ['name' => 'Huile CBD Full Spectrum 10%', 'price' => '34,90', 'rating' => 5, 'reviews' => 487, 'tag' => '10% CBD', 'badge' => 'Bestseller', 'img' => 'huile-cbd-10.svg'],
                        ['name' => 'Huile CBD Broad Spectrum 20%', 'price' => '54,90', 'rating' => 5, 'reviews' => 312, 'tag' => '20% CBD', 'badge' => 'Premium', 'img' => 'huile-cbd-20.svg'],
                        ['name' => 'Gummies CBD Relaxation', 'price' => '24,90', 'rating' => 4, 'reviews' => 203, 'tag' => '25mg/gummy', 'badge' => 'Nouveau', 'img' => 'gummies-fruits.svg'],
                        ['name' => 'Fleurs CBD OG Kush', 'price' => '12,90', 'rating' => 5, 'reviews' => 156, 'tag' => '15% CBD', 'badge' => null, 'img' => 'fleur-indoor.svg'],
                        ['name' => 'Crème CBD Anti-Douleur', 'price' => '28,90', 'rating' => 4, 'reviews' => 98, 'tag' => '500mg CBD', 'badge' => null, 'img' => 'creme-cbd.svg'],
                        ['name' => 'Huile CBD Sommeil 15%', 'price' => '44,90', 'rating' => 5, 'reviews' => 271, 'tag' => '15% CBD', 'badge' => 'Coup de ♥', 'img' => 'huile-sommeil.svg'],
                        ['name' => 'Infusion CBD Relaxante', 'price' => '16,90', 'rating' => 4, 'reviews' => 134, 'tag' => 'Bio', 'badge' => null, 'img' => 'infusion-cbd.svg'],
                        ['name' => 'Capsules CBD 30mg', 'price' => '39,90', 'rating' => 5, 'reviews' => 89, 'tag' => '30mg/caps', 'badge' => null, 'img' => 'capsules-cbd.svg'],
                    ];
                    foreach ($demo_products as $p):
                        $sale = rand(0,1);
                        $orig = $sale ? number_format((float)str_replace(',','.',$p['price']) * 1.2, 2, ',', '') : null;
                    ?>
                    <div class="product-card">
                        <div class="product-card__image">
                            <img src="<?php echo esc_url(GREENPURE_URI . '/assets/images/products/' . $p['img']); ?>" alt="<?php echo esc_attr($p['name']); ?>" class="product-card__img" width="300" height="300" loading="lazy">
                            <?php if ($p['badge']): ?>
                                <span class="product-badge product-badge--featured"><?php echo esc_html($p['badge']); ?></span>
                            <?php endif; ?>
                            <?php if ($sale): ?>
                                <span class="product-badge product-badge--sale">-20%</span>
                            <?php endif; ?>
                            <div class="product-card__actions">
                                <button class="product-card__wishlist" aria-label="Favoris">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                                </button>
                            </div>
                        </div>
                        <div class="product-card__body">
                            <span class="product-card__tag"><?php echo esc_html($p['tag']); ?></span>
                            <h3 class="product-card__title"><a href="#"><?php echo esc_html($p['name']); ?></a></h3>
                            <div class="product-card__rating">
                                <span class="stars-static" data-rating="<?php echo esc_attr($p['rating']); ?>">★★★★★</span>
                                <span class="rating-count">(<?php echo esc_html($p['reviews']); ?>)</span>
                            </div>
                            <div class="product-card__footer">
                                <div class="product-card__price">
                                    <?php if ($sale): ?><del><?php echo esc_html($orig); ?> €</del> <?php endif; ?>
                                    <ins><?php echo esc_html($p['price']); ?> €</ins>
                                </div>
                                <button class="btn btn--cart btn--sm">Ajouter</button>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;
                }
                ?>
        </div><!-- /.products-grid -->
        <div class="section-cta" data-aos="fade-up">
            <?php if ( class_exists('WooCommerce') ): ?>
            <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="btn btn--outline btn--lg">
                Voir tous nos produits
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
            <?php else: ?>
            <a href="<?php echo esc_url(home_url('/boutique')); ?>" class="btn btn--outline btn--lg">Voir tous nos produits →</a>
            <?php endif; ?>
        </div>
        <?php } // fin du if class_exists WooCommerce ?>
    </div><!-- /.container -->
</section>

<!-- ══════════════════════════════════════════════════
     SECTION 5 — POURQUOI NOUS
══════════════════════════════════════════════════ -->
<section class="why-section">
    <div class="why-section__bg"></div>
    <div class="container">
        <div class="why-section__inner">
            <div class="why-section__visual" data-aos="fade-right">
                <div class="why-image-stack">
                    <div class="why-img why-img--main">
                        <div class="why-img-placeholder">
                            <div class="hemp-field-illustration">
                                <div class="hf-sky"></div>
                                <div class="hf-hills"></div>
                                <div class="hf-plants">
                                    <?php for($i=0;$i<7;$i++): ?>
                                    <div class="hf-plant" style="--delay:<?php echo $i*0.1; ?>s;--h:<?php echo 60+rand(0,40); ?>px"></div>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="why-stat why-stat--1">
                        <strong>50 000+</strong>
                        <span>clients satisfaits</span>
                    </div>
                    <div class="why-stat why-stat--2">
                        <strong>4.9/5</strong>
                        <span>note moyenne</span>
                    </div>
                    <div class="why-stat why-stat--3">
                        <strong>100%</strong>
                        <span>bio européen</span>
                    </div>
                </div>
            </div>
            <div class="why-section__content" data-aos="fade-left">
                <span class="section-eyebrow">Notre engagement</span>
                <h2 class="section-title">Pourquoi choisir CBD Borea ?</h2>
                <p class="why-section__intro">Depuis 2019, nous sélectionnons les meilleures variétés de chanvre bio européen pour vous offrir des produits CBD d'exception, traçables de la graine au flacon.</p>
                <div class="why-features">
                    <div class="why-feature">
                        <div class="why-feature__icon">🌱</div>
                        <div class="why-feature__text">
                            <h3>Chanvre 100% Bio</h3>
                            <p>Cultivé sans pesticides ni OGM en Union Européenne, dans le respect de l'environnement.</p>
                        </div>
                    </div>
                    <div class="why-feature">
                        <div class="why-feature__icon">🔬</div>
                        <div class="why-feature__text">
                            <h3>Certifié par laboratoire indépendant</h3>
                            <p>Chaque lot est analysé par un laboratoire accrédité ISO. Rapports disponibles en ligne.</p>
                        </div>
                    </div>
                    <div class="why-feature">
                        <div class="why-feature__icon">⚗️</div>
                        <div class="why-feature__text">
                            <h3>Extraction CO2 supercritique</h3>
                            <p>Méthode d'extraction premium pour préserver tous les cannabinoïdes et terpènes naturels.</p>
                        </div>
                    </div>
                    <div class="why-feature">
                        <div class="why-feature__icon">⚡</div>
                        <div class="why-feature__text">
                            <h3>THC &lt; 0,3% garanti</h3>
                            <p>Totalement légal en France et dans l'Union Européenne. Zéro effet psychoactif.</p>
                        </div>
                    </div>
                </div>
                <a href="<?php echo esc_url(home_url('/notre-qualite')); ?>" class="btn btn--primary btn--lg">
                    En savoir plus sur notre qualité
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════════
     SECTION 6 — BANNIÈRE PROMO
══════════════════════════════════════════════════ -->
<section class="promo-banner">
    <div class="container">
        <div class="promo-banner__inner" data-aos="zoom-in">
            <div class="promo-banner__content">
                <span class="promo-banner__label">Offre spéciale</span>
                <h2>-15% sur votre première commande</h2>
                <p>Utilisez le code <strong>BIENVENUE15</strong> à la caisse. Offre valable une seule fois.</p>
                <a href="<?php echo class_exists('WooCommerce') ? esc_url(get_permalink(wc_get_page_id('shop'))) : esc_url(home_url('/boutique')); ?>" class="btn btn--white btn--lg">
                    J'en profite maintenant
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>
            <div class="promo-banner__timer" id="promo-timer">
                <div class="timer-block"><span class="timer-num" id="timer-h">23</span><span class="timer-label">h</span></div>
                <div class="timer-sep">:</div>
                <div class="timer-block"><span class="timer-num" id="timer-m">59</span><span class="timer-label">min</span></div>
                <div class="timer-sep">:</div>
                <div class="timer-block"><span class="timer-num" id="timer-s">00</span><span class="timer-label">sec</span></div>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════════
     SECTION 7 — TÉMOIGNAGES
══════════════════════════════════════════════════ -->
<section class="testimonials-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-eyebrow">Ils nous font confiance</span>
            <h2 class="section-title">Ce que disent nos clients</h2>
            <div class="global-rating">
                <div class="global-rating__stars">★★★★★</div>
                <strong>4.9/5</strong>
                <span>basé sur 2 000+ avis vérifiés</span>
            </div>
        </div>
        <div class="testimonials-slider js-testimonials-slider" data-aos="fade-up" data-aos-delay="100">
            <div class="testimonials-slider__track">
            <?php
            $testimonials = get_posts(['post_type' => 'testimonial', 'posts_per_page' => 6, 'post_status' => 'publish']);
            if ( $testimonials ) {
                foreach ( $testimonials as $t ):
                    $rating  = get_post_meta($t->ID, '_rating', true) ?: 5;
                    $product = get_post_meta($t->ID, '_product', true);
                    setup_postdata($t);
                    ?>
                    <div class="testimonial-card testimonial">
                        <div class="testimonial-card__stars"><?php echo str_repeat('★', intval($rating)) . str_repeat('☆', 5 - intval($rating)); ?></div>
                        <blockquote class="testimonial-card__quote"><?php echo wp_kses_post($t->post_content); ?></blockquote>
                        <div class="testimonial-card__author">
                            <?php if ( has_post_thumbnail($t->ID) ): ?>
                                <?php echo get_the_post_thumbnail($t->ID, [48,48], ['class' => 'testimonial-avatar']); ?>
                            <?php else: ?>
                                <div class="testimonial-avatar testimonial-avatar--default" aria-hidden="true"><?php echo mb_substr(get_the_title($t->ID), 0, 1); ?></div>
                            <?php endif; ?>
                            <div>
                                <strong><?php echo esc_html(get_the_title($t->ID)); ?></strong>
                                <?php if ($product): ?><span>À propos de : <?php echo esc_html($product); ?></span><?php endif; ?>
                                <span class="verified-badge">✓ Achat vérifié</span>
                            </div>
                        </div>
                    </div>
                    <?php
                endforeach;
                wp_reset_postdata();
            } else {
                // Témoignages démo
                $demos = [
                    ['name' => 'Sophie M.', 'rating' => 5, 'product' => 'Huile CBD 10%', 'text' => 'J\'ai enfin trouvé quelque chose qui m\'aide vraiment à dormir. L\'huile 10% a changé mes nuits. Je ne peux plus m\'en passer !'],
                    ['name' => 'Thomas R.', 'rating' => 5, 'product' => 'Gummies CBD', 'text' => 'Les gummies sont délicieux et efficaces pour gérer mon anxiété au quotidien. Qualité parfaite, livraison ultra rapide. Je recommande à 100%.'],
                    ['name' => 'Marie-Claire B.', 'rating' => 5, 'product' => 'Huile CBD 20%', 'text' => 'Depuis que j\'utilise l\'huile 20% pour mes douleurs chroniques, ma qualité de vie a vraiment changé. Sceptique au départ, convertie définitivement !'],
                    ['name' => 'Julien K.', 'rating' => 5, 'product' => 'Crème CBD', 'text' => 'La crème CBD est incroyable pour les douleurs musculaires après le sport. Je l\'applique après chaque entraînement. Très bonne absorption.'],
                    ['name' => 'Isabelle D.', 'rating' => 4, 'product' => 'Infusion CBD', 'text' => 'L\'infusion du soir est devenue mon rituel relaxation. Le goût est excellent et les effets apaisants sont bien là. Très bonne qualité.'],
                    ['name' => 'Pierre L.', 'rating' => 5, 'product' => 'Fleurs CBD', 'text' => 'Fleurs de très bonne qualité, taux de CBD élevé et arômes incroyables. Le service client est réactif et très professionnel. Top !'],
                ];
                foreach ($demos as $d):
                ?>
                <div class="testimonial-card testimonial">
                    <div class="testimonial-card__stars"><?php echo str_repeat('★', $d['rating']); ?></div>
                    <blockquote class="testimonial-card__quote">"<?php echo esc_html($d['text']); ?>"</blockquote>
                    <div class="testimonial-card__author">
                        <div class="testimonial-avatar testimonial-avatar--default" aria-hidden="true"><?php echo mb_substr($d['name'], 0, 1); ?></div>
                        <div>
                            <strong><?php echo esc_html($d['name']); ?></strong>
                            <span>À propos de : <?php echo esc_html($d['product']); ?></span>
                            <span class="verified-badge">✓ Achat vérifié</span>
                        </div>
                    </div>
                </div>
                <?php endforeach;
            }
            ?>
            </div><!-- /.testimonials-slider__track -->
        </div>
        <div class="slider-controls">
            <button class="slider-btn slider-btn--prev slider-prev js-prev" aria-label="Avis précédent">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
            </button>
            <div class="slider-dots js-dots"></div>
            <button class="slider-btn slider-btn--next slider-next js-next" aria-label="Avis suivant">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
            </button>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════════
     SECTION 8 — PROCESSUS / HOW IT WORKS
══════════════════════════════════════════════════ -->
<section class="process-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-eyebrow">Notre processus</span>
            <h2 class="section-title">De la plante à votre porte</h2>
        </div>
        <div class="process-steps" data-aos="fade-up" data-aos-delay="100">
            <div class="process-step">
                <div class="process-step__number">01</div>
                <div class="process-step__icon">🌾</div>
                <h3>Culture Bio</h3>
                <p>Sélection rigoureuse de semences certifiées, cultivées sans pesticides en Europe.</p>
                <div class="process-line"></div>
            </div>
            <div class="process-step">
                <div class="process-step__number">02</div>
                <div class="process-step__icon">⚗️</div>
                <h3>Extraction CO2</h3>
                <p>Extraction supercritique au CO2 pour préserver tous les bienfaits du chanvre.</p>
                <div class="process-line"></div>
            </div>
            <div class="process-step">
                <div class="process-step__number">03</div>
                <div class="process-step__icon">🔬</div>
                <h3>Analyse Laboratoire</h3>
                <p>Chaque lot est analysé par un laboratoire accrédité ISO indépendant en Europe.</p>
                <div class="process-line"></div>
            </div>
            <div class="process-step">
                <div class="process-step__number">04</div>
                <div class="process-step__icon">📦</div>
                <h3>Emballage Éco</h3>
                <p>Conditionnement dans des emballages 100% recyclables, expédition sous 24h.</p>
                <div class="process-line" style="display:none"></div>
            </div>
        </div>
        <div class="section-cta" data-aos="fade-up">
            <a href="<?php echo esc_url(home_url('/rapports-laboratoire')); ?>" class="btn btn--outline">
                Voir nos rapports de laboratoire
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
            </a>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════════
     SECTION 9 — FAQ
══════════════════════════════════════════════════ -->
<section class="faq-section">
    <div class="container">
        <div class="faq-section__inner">
            <div class="section-header section-header--left" data-aos="fade-right">
                <span class="section-eyebrow">Questions fréquentes</span>
                <h2 class="section-title">Tout ce que vous voulez savoir sur le CBD</h2>
                <a href="<?php echo esc_url(home_url('/faq')); ?>" class="btn btn--outline">Voir toutes les FAQ</a>
            </div>
            <div class="faq-list" data-aos="fade-left">
                <?php
                $faqs = get_posts(['post_type' => 'faq', 'posts_per_page' => 6, 'post_status' => 'publish']);
                if ( $faqs ) {
                    foreach ( $faqs as $i => $faq ):
                    ?>
                    <div class="faq-item js-faq-item <?php echo $i === 0 ? 'is-open' : ''; ?>">
                        <button class="faq-item__question" aria-expanded="<?php echo $i === 0 ? 'true' : 'false'; ?>">
                            <?php echo esc_html($faq->post_title); ?>
                            <svg class="faq-icon" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
                        </button>
                        <div class="faq-item__answer"><?php echo wp_kses_post($faq->post_content); ?></div>
                    </div>
                    <?php endforeach;
                    wp_reset_postdata();
                } else {
                    $demo_faqs = [
                        ['q' => 'Le CBD est-il légal en France ?', 'a' => 'Oui, le CBD est totalement légal en France depuis la décision du Conseil d\'État de novembre 2022. Les produits à base de chanvre avec un taux de THC inférieur à 0,3% peuvent être légalement vendus et consommés.'],
                        ['q' => 'Le CBD peut-il me faire planer ?', 'a' => 'Non. Le CBD (cannabidiol) n\'a aucun effet psychoactif. Contrairement au THC, il ne crée pas d\'euphorie ni d\'altération de la perception. Tous nos produits contiennent moins de 0,3% de THC.'],
                        ['q' => 'Quels sont les bienfaits du CBD ?', 'a' => 'De nombreuses études suggèrent que le CBD peut contribuer à la relaxation, améliorer la qualité du sommeil, réduire le stress et l\'anxiété, et aider à soulager certaines douleurs. Chaque personne réagit différemment.'],
                        ['q' => 'Comment choisir la concentration de CBD ?', 'a' => 'Pour les débutants, nous recommandons de commencer par une concentration de 5-10%. Augmentez progressivement selon vos besoins. Pour des effets plus puissants, optez pour 15-30%. Consultez notre guide ou notre service client.'],
                        ['q' => 'Combien de temps avant de ressentir les effets ?', 'a' => 'Cela dépend du mode de consommation. Sublingual (sous la langue) : 15-45 min. Ingestion (gummies, capsules) : 1-2h. Application cutanée : 30-60 min. Les effets durent généralement 4-8 heures.'],
                        ['q' => 'Puis-je utiliser le CBD si je prends des médicaments ?', 'a' => 'Si vous prenez des médicaments, il est conseillé de consulter votre médecin avant d\'utiliser des produits CBD. Le CBD peut interagir avec certains médicaments métabolisés par le foie.'],
                    ];
                    foreach ( $demo_faqs as $i => $faq ):
                    ?>
                    <div class="faq-item js-faq-item <?php echo $i === 0 ? 'is-open' : ''; ?>">
                        <button class="faq-item__question" aria-expanded="<?php echo $i === 0 ? 'true' : 'false'; ?>">
                            <?php echo esc_html($faq['q']); ?>
                            <svg class="faq-icon" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
                        </button>
                        <div class="faq-item__answer"><p><?php echo esc_html($faq['a']); ?></p></div>
                    </div>
                    <?php endforeach;
                }
                ?>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════════
     SECTION 10 — BLOG
══════════════════════════════════════════════════ -->
<section class="blog-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-eyebrow">Notre blog</span>
            <h2 class="section-title">Tout savoir sur le CBD</h2>
            <p class="section-subtitle">Articles rédigés par des experts pour vous aider à mieux comprendre le CBD et ses bénéfices.</p>
        </div>
        <div class="blog-grid" data-aos="fade-up" data-aos-delay="100">
            <?php
            $posts = get_posts(['posts_per_page' => 3, 'post_status' => 'publish', 'ignore_sticky_posts' => true]);
            if ( $posts ) {
                foreach ( $posts as $post ):
                    setup_postdata($post);
                    ?>
                    <article class="blog-card">
                        <a href="<?php the_permalink(); ?>" class="blog-card__image">
                            <?php if ( has_post_thumbnail() ): ?>
                                <?php the_post_thumbnail('greenpure-blog', ['loading' => 'lazy', 'class' => 'blog-card__img']); ?>
                            <?php else: ?>
                                <div class="blog-card__img-placeholder"></div>
                            <?php endif; ?>
                            <span class="blog-card__category"><?php the_category(', '); ?></span>
                        </a>
                        <div class="blog-card__body">
                            <div class="blog-card__meta">
                                <time datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date('d M Y'); ?></time>
                                <span>·</span>
                                <span><?php echo ceil(str_word_count(get_the_content()) / 200); ?> min de lecture</span>
                            </div>
                            <h3 class="blog-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <p class="blog-card__excerpt"><?php echo greenpure_excerpt(18); ?></p>
                            <a href="<?php the_permalink(); ?>" class="blog-card__link">Lire la suite →</a>
                        </div>
                    </article>
                    <?php
                endforeach;
                wp_reset_postdata();
            } else {
                $demo_posts = [
                    ['title' => 'Huile CBD : guide complet pour débutants', 'cat' => 'Guide', 'read' => '8', 'excerpt' => 'Tout ce que vous devez savoir pour commencer avec l\'huile CBD : dosage, administration, effets attendus et conseils de nos experts.'],
                    ['title' => 'CBD et sommeil : ce que dit la science', 'cat' => 'Recherche', 'read' => '6', 'excerpt' => 'Des études récentes confirment le potentiel du CBD pour améliorer la qualité du sommeil. On vous explique comment et pourquoi.'],
                    ['title' => 'Full Spectrum vs Broad Spectrum vs Isolat', 'cat' => 'Explication', 'read' => '5', 'excerpt' => 'Quelle différence entre ces trois types de CBD ? Lequel choisir selon vos besoins ? Notre guide complet vous aide à décider.'],
                ];
                foreach ($demo_posts as $p):
                ?>
                <article class="blog-card">
                    <div class="blog-card__image">
                        <div class="blog-card__img-placeholder"></div>
                        <span class="blog-card__category"><?php echo esc_html($p['cat']); ?></span>
                    </div>
                    <div class="blog-card__body">
                        <div class="blog-card__meta">
                            <time>15 Jan 2025</time>
                            <span>·</span>
                            <span><?php echo esc_html($p['read']); ?> min de lecture</span>
                        </div>
                        <h3 class="blog-card__title"><a href="#"><?php echo esc_html($p['title']); ?></a></h3>
                        <p class="blog-card__excerpt"><?php echo esc_html($p['excerpt']); ?></p>
                        <a href="#" class="blog-card__link">Lire la suite →</a>
                    </div>
                </article>
                <?php endforeach;
            }
            ?>
        </div>
        <div class="section-cta" data-aos="fade-up">
            <a href="<?php echo esc_url(home_url('/blog')); ?>" class="btn btn--outline btn--lg">Voir tous nos articles</a>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════════
     SECTION 11 — BADGES DE CONFIANCE
══════════════════════════════════════════════════ -->
<section class="certifications-section">
    <div class="container">
        <div class="certifications-grid" data-aos="fade-up">
            <div class="cert-item">
                <div class="cert-item__icon">🌱</div>
                <strong>Agriculture Biologique</strong>
                <span>Certification EU Bio</span>
            </div>
            <div class="cert-item">
                <div class="cert-item__icon">🔬</div>
                <strong>Analysé en laboratoire</strong>
                <span>ISO 17025 accrédité</span>
            </div>
            <div class="cert-item">
                <div class="cert-item__icon">🇪🇺</div>
                <strong>Made in Europe</strong>
                <span>Chanvre européen certifié</span>
            </div>
            <div class="cert-item">
                <div class="cert-item__icon">♻️</div>
                <strong>Emballage éco-responsable</strong>
                <span>100% recyclable</span>
            </div>
            <div class="cert-item">
                <div class="cert-item__icon">✅</div>
                <strong>THC &lt; 0,3%</strong>
                <span>Légal & contrôlé</span>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════════
     SECTION 12 — PACKS & COFFRETS SPOTLIGHT
══════════════════════════════════════════════════ -->
<section class="packs-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-eyebrow">Offres groupées</span>
            <h2 class="section-title">Packs & Coffrets CBD — Économisez jusqu'à 30%</h2>
            <p class="section-subtitle">Nos coffrets sont conçus pour maximiser les effets du CBD grâce à une synergie de produits complémentaires.</p>
        </div>
        <div class="packs-grid" data-aos="fade-up" data-aos-delay="100">
            <div class="pack-card pack-card--featured">
                <div class="pack-card__badge">Bestseller</div>
                <div class="pack-card__icon">
                    <svg width="60" height="60" viewBox="0 0 60 60" fill="none"><rect x="8" y="28" width="18" height="24" rx="3" fill="#52B788"/><rect x="34" y="20" width="18" height="32" rx="3" fill="#2D6A4F"/><rect x="18" y="12" width="14" height="18" rx="3" fill="#B7E4C7"/></svg>
                </div>
                <h3>Pack Sommeil Profond</h3>
                <p>Huile CBD 15% + Mélatonine, Gummies Sommeil, Infusion Lavande</p>
                <div class="pack-card__savings"><span>-15€</span> par rapport aux achats séparés</div>
                <div class="pack-card__price"><span class="pack-old">84,70 €</span> <strong>69,90 €</strong></div>
                <?php if ( class_exists('WooCommerce') ): ?>
                <?php
                $pack_id = wc_get_product_id_by_sku('GP-PKS-SOM');
                if ($pack_id): ?>
                <a href="<?php echo esc_url(get_permalink($pack_id)); ?>" class="btn btn--primary btn--full">Voir ce pack</a>
                <?php else: ?>
                <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="btn btn--primary btn--full">Voir les packs</a>
                <?php endif; ?>
                <?php endif; ?>
            </div>
            <div class="pack-card">
                <div class="pack-card__icon">
                    <svg width="60" height="60" viewBox="0 0 60 60" fill="none"><rect x="8" y="28" width="18" height="24" rx="3" fill="#0288D1"/><rect x="34" y="20" width="18" height="32" rx="3" fill="#0277BD"/><rect x="18" y="12" width="14" height="18" rx="3" fill="#B3E5FC"/></svg>
                </div>
                <h3>Pack Sport Recovery</h3>
                <p>Huile Sport 10%, Crème Anti-Douleur 500mg, Baume Muscles 300mg</p>
                <div class="pack-card__savings"><span>-15€</span> par rapport aux achats séparés</div>
                <div class="pack-card__price"><span class="pack-old">104,70 €</span> <strong>79,90 €</strong></div>
                <?php if ( class_exists('WooCommerce') ): ?>
                <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="btn btn--outline btn--full">Voir ce pack</a>
                <?php endif; ?>
            </div>
            <div class="pack-card">
                <div class="pack-card__icon">
                    <svg width="60" height="60" viewBox="0 0 60 60" fill="none"><rect x="8" y="28" width="18" height="24" rx="3" fill="#C2185B"/><rect x="34" y="20" width="18" height="32" rx="3" fill="#E91E63"/><rect x="18" y="12" width="14" height="18" rx="3" fill="#FFD6E7"/></svg>
                </div>
                <h3>Coffret Luxe Cadeau</h3>
                <p>Huile 20%, Gummies Anti-Stress, Sérum Anti-Âge, Infusion. Coffret bois gravé.</p>
                <div class="pack-card__savings"><span>-15€</span> par rapport aux achats séparés</div>
                <div class="pack-card__price"><span class="pack-old">149,60 €</span> <strong>99,90 €</strong></div>
                <?php if ( class_exists('WooCommerce') ): ?>
                <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="btn btn--outline btn--full">Offrir ce coffret</a>
                <?php endif; ?>
            </div>
            <div class="pack-card">
                <div class="pack-card__icon">
                    <svg width="60" height="60" viewBox="0 0 60 60" fill="none"><rect x="8" y="28" width="18" height="24" rx="3" fill="#2D6A4F"/><rect x="34" y="20" width="18" height="32" rx="3" fill="#52B788"/><rect x="18" y="12" width="14" height="18" rx="3" fill="#B7E4C7"/></svg>
                </div>
                <h3>Pack Découverte</h3>
                <p>Huile 5%, 3 variétés de fleurs, Gummies Relaxation. Parfait pour débuter.</p>
                <div class="pack-card__savings"><span>-10€</span> par rapport aux achats séparés</div>
                <div class="pack-card__price"><span class="pack-old">59,60 €</span> <strong>49,90 €</strong></div>
                <?php if ( class_exists('WooCommerce') ): ?>
                <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="btn btn--outline btn--full">Commencer ici</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════════
     SECTION 13 — PRESSE & MÉDIAS
══════════════════════════════════════════════════ -->
<section class="press-section">
    <div class="container">
        <p class="press-section__label" data-aos="fade-up">Parlé dans les médias</p>
        <div class="press-logos" data-aos="fade-up" data-aos-delay="50">
            <div class="press-logo">
                <svg width="120" height="40" viewBox="0 0 120 40"><text x="10" y="28" font-family="Georgia,serif" font-size="18" font-weight="bold" fill="#999">Le Monde</text></svg>
            </div>
            <div class="press-logo">
                <svg width="120" height="40" viewBox="0 0 120 40"><text x="10" y="28" font-family="Arial,sans-serif" font-size="16" font-weight="700" fill="#999">FIGARO</text></svg>
            </div>
            <div class="press-logo">
                <svg width="120" height="40" viewBox="0 0 120 40"><text x="5" y="28" font-family="Georgia,serif" font-size="14" font-weight="bold" fill="#999">L'Express</text></svg>
            </div>
            <div class="press-logo">
                <svg width="120" height="40" viewBox="0 0 120 40"><text x="10" y="28" font-family="Arial,sans-serif" font-size="15" font-weight="700" fill="#999">ELLE</text></svg>
            </div>
            <div class="press-logo">
                <svg width="120" height="40" viewBox="0 0 120 40"><text x="5" y="28" font-family="Arial,sans-serif" font-size="13" font-weight="700" fill="#999">Forbes FR</text></svg>
            </div>
            <div class="press-logo">
                <svg width="120" height="40" viewBox="0 0 120 40"><text x="5" y="28" font-family="Arial,sans-serif" font-size="13" font-weight="700" fill="#999">Capital</text></svg>
            </div>
        </div>
        <div class="press-quotes" data-aos="fade-up" data-aos-delay="100">
            <blockquote class="press-quote">
                <p>"CBD Borea se distingue par une transparence exemplaire et une qualité de CBD parmi les meilleures du marché européen."</p>
                <cite>— Le Monde Santé</cite>
            </blockquote>
            <blockquote class="press-quote">
                <p>"La référence française du CBD premium. Des produits rigoureusement testés, une traçabilité totale de la graine au flacon."</p>
                <cite>— Forbes France</cite>
            </blockquote>
            <blockquote class="press-quote">
                <p>"Avec plus de 100 références CBD, CBD Borea s'impose comme le leader européen de la vente de cannabidiol en ligne."</p>
                <cite>— Capital Magazine</cite>
            </blockquote>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════════
     SECTION 14 — NEWSLETTER
══════════════════════════════════════════════════ -->
<section class="newsletter-section">
    <div class="container">
        <div class="newsletter-section__inner" data-aos="fade-up">
            <div class="newsletter-section__content">
                <span class="section-eyebrow">Newsletter</span>
                <h2>-10% sur votre première commande</h2>
                <p>Inscrivez-vous et recevez immédiatement un code de réduction de 10% + nos guides exclusifs sur le CBD.</p>
                <ul class="newsletter-perks">
                    <li><svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Code promo -10% immédiat</li>
                    <li><svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Accès aux ventes privées</li>
                    <li><svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Guides & conseils experts CBD</li>
                    <li><svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Désinscription en 1 clic</li>
                </ul>
            </div>
            <div class="newsletter-section__form">
                <form class="newsletter-form js-newsletter-form" method="post">
                    <?php wp_nonce_field('greenpure_newsletter', 'nonce'); ?>
                    <div class="newsletter-form__field">
                        <label for="nl-name" class="sr-only">Votre prénom</label>
                        <input type="text" id="nl-name" name="name" placeholder="Votre prénom" autocomplete="given-name">
                    </div>
                    <div class="newsletter-form__field">
                        <label for="nl-email" class="sr-only">Votre email</label>
                        <input type="email" id="nl-email" name="email" placeholder="Votre adresse email" required autocomplete="email">
                    </div>
                    <button type="submit" class="btn btn--primary btn--full btn--lg">
                        Recevoir mon code -10%
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </button>
                    <p class="newsletter-form__legal">En vous inscrivant, vous acceptez notre <a href="<?php echo esc_url(get_privacy_policy_url()); ?>">politique de confidentialité</a>. Désinscription à tout moment.</p>
                    <div class="newsletter-form__success" style="display:none">
                        <svg width="40" height="40" fill="none" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="#52B788" stroke-width="2"/><path d="M9 12l2 2 4-4" stroke="#52B788" stroke-width="2"/></svg>
                        <p>Merci ! Votre code <strong>BIENVENUE10</strong> a été envoyé par email.</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>

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
            <div class="hero__content" data-aos="fade-right">
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
            <div class="hero__visual" data-aos="fade-left">
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
                            echo '<div class="showcase-placeholder">
                                <div class="showcase-bottle">
                                    <div class="bottle-body"></div>
                                    <div class="bottle-label">CBD<br><small>10%</small></div>
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
            if ( class_exists('WooCommerce') ) {
                $cats = get_terms(['taxonomy' => 'product_cat', 'hide_empty' => false, 'exclude' => [get_option('default_product_cat')], 'number' => 6]);
                if ( !empty($cats) && !is_wp_error($cats) ) {
                    foreach ( $cats as $cat ) {
                        $thumb_id  = get_term_meta($cat->term_id, 'thumbnail_id', true);
                        $thumb_url = $thumb_id ? wp_get_attachment_image_url($thumb_id, 'greenpure-product') : GREENPURE_URI . '/assets/images/cat-placeholder.jpg';
                        $link      = get_term_link($cat);
                        ?>
                        <a href="<?php echo esc_url($link); ?>" class="category-card">
                            <div class="category-card__image">
                                <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr($cat->name); ?>" loading="lazy" width="300" height="300">
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
                    // Catégories statiques de démonstration
                    $demo_cats = [
                        ['name' => 'Huiles CBD',       'icon' => '💧', 'count' => 12, 'slug' => 'huiles-cbd'],
                        ['name' => 'Fleurs CBD',       'icon' => '🌸', 'count' => 8,  'slug' => 'fleurs-cbd'],
                        ['name' => 'Gummies CBD',      'icon' => '🍬', 'count' => 6,  'slug' => 'gummies-cbd'],
                        ['name' => 'Cosmétiques CBD',  'icon' => '✨', 'count' => 10, 'slug' => 'cosmetiques-cbd'],
                        ['name' => 'Infusions CBD',    'icon' => '🍵', 'count' => 5,  'slug' => 'infusions-cbd'],
                        ['name' => 'Vape & E-liquides','icon' => '💨', 'count' => 7,  'slug' => 'vape-cbd'],
                    ];
                    foreach ($demo_cats as $cat):
                    ?>
                    <a href="<?php echo esc_url(home_url('/boutique/' . $cat['slug'])); ?>" class="category-card">
                        <div class="category-card__image category-card__image--demo">
                            <div class="cat-demo-icon"><?php echo $cat['icon']; ?></div>
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
            <button class="filter-btn" data-filter="huiles">Huiles CBD</button>
            <button class="filter-btn" data-filter="fleurs">Fleurs</button>
            <button class="filter-btn" data-filter="gummies">Gummies</button>
            <button class="filter-btn" data-filter="cosmetiques">Cosmétiques</button>
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
                        ['name' => 'Huile CBD Full Spectrum 10%', 'price' => '34,90', 'rating' => 5, 'reviews' => 487, 'tag' => '10% CBD', 'badge' => 'Bestseller'],
                        ['name' => 'Huile CBD Broad Spectrum 20%', 'price' => '54,90', 'rating' => 5, 'reviews' => 312, 'tag' => '20% CBD', 'badge' => 'Premium'],
                        ['name' => 'Gummies CBD Relaxation', 'price' => '24,90', 'rating' => 4, 'reviews' => 203, 'tag' => '25mg/gummy', 'badge' => 'Nouveau'],
                        ['name' => 'Fleurs CBD OG Kush', 'price' => '12,90', 'rating' => 5, 'reviews' => 156, 'tag' => '15% CBD', 'badge' => null],
                        ['name' => 'Crème CBD Anti-Douleur', 'price' => '28,90', 'rating' => 4, 'reviews' => 98, 'tag' => '500mg CBD', 'badge' => null],
                        ['name' => 'Huile CBD Sommeil 15%', 'price' => '44,90', 'rating' => 5, 'reviews' => 271, 'tag' => '15% CBD', 'badge' => 'Coup de ♥'],
                        ['name' => 'Infusion CBD Relaxante', 'price' => '16,90', 'rating' => 4, 'reviews' => 134, 'tag' => 'Bio', 'badge' => null],
                        ['name' => 'Capsules CBD 30mg', 'price' => '39,90', 'rating' => 5, 'reviews' => 89, 'tag' => '30mg/caps', 'badge' => null],
                    ];
                    foreach ($demo_products as $p):
                        $sale = rand(0,1);
                        $orig = $sale ? number_format((float)str_replace(',','.',$p['price']) * 1.2, 2, ',', '') : null;
                    ?>
                    <div class="product-card">
                        <div class="product-card__image">
                            <div class="product-card__img-placeholder">
                                <div class="placeholder-bottle"></div>
                            </div>
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
                <h2 class="section-title">Pourquoi choisir GreenPure ?</h2>
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

<?php get_footer(); ?>

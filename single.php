<?php get_header(); ?>

<?php while ( have_posts() ): the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?> itemscope itemtype="https://schema.org/Article">

    <!-- Hero article -->
    <div class="single-post__hero">
        <div class="container">
            <div class="post-meta-top">
                <?php the_breadcrumb(); ?>
                <div class="post-categories">
                    <?php the_category(' &bull; '); ?>
                </div>
            </div>
            <h1 class="single-post__title" itemprop="headline"><?php the_title(); ?></h1>
            <div class="post-meta">
                <div class="post-author" itemprop="author" itemscope itemtype="https://schema.org/Person">
                    <?php echo get_avatar(get_the_author_meta('email'), 40, '', '', ['class' => 'post-author__avatar']); ?>
                    <div>
                        <span class="post-author__name" itemprop="name"><?php the_author(); ?></span>
                        <time class="post-author__date" datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished">
                            <?php echo get_the_date('d F Y'); ?>
                        </time>
                    </div>
                </div>
                <div class="post-meta__right">
                    <span class="read-time">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        <?php echo ceil(str_word_count(get_the_content()) / 200); ?> min de lecture
                    </span>
                    <div class="post-share">
                        <span>Partager :</span>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" class="share-btn share-btn--fb" target="_blank" rel="noopener" aria-label="Partager sur Facebook">f</a>
                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" class="share-btn share-btn--tw" target="_blank" rel="noopener" aria-label="Partager sur Twitter">𝕏</a>
                    </div>
                </div>
            </div>
        </div>
        <?php if ( has_post_thumbnail() ): ?>
        <div class="single-post__featured-image">
            <?php the_post_thumbnail('greenpure-hero', ['itemprop' => 'image', 'loading' => 'eager']); ?>
        </div>
        <?php endif; ?>
    </div>

    <!-- Content -->
    <div class="container">
        <div class="single-post__layout">
            <div class="single-post__content entry-content" itemprop="articleBody">
                <?php the_content(); ?>
                <?php
                wp_link_pages([
                    'before' => '<div class="page-links"><span>' . __('Pages :', 'greenpure-cbd') . '</span>',
                    'after'  => '</div>',
                ]);
                ?>
            </div>
            <!-- Sidebar sticky -->
            <aside class="single-post__sidebar">
                <!-- Table des matières (générée par JS) -->
                <div class="sidebar-widget toc-widget js-toc" aria-label="Table des matières">
                    <h3 class="widget__title">Sommaire</h3>
                    <div class="toc-list js-toc-list"></div>
                </div>
                <!-- CTA produit -->
                <?php if ( class_exists('WooCommerce') ): ?>
                <div class="sidebar-widget sidebar-cta">
                    <p class="sidebar-cta__label">🌿 Nos produits CBD certifiés</p>
                    <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="btn btn--primary btn--full">Découvrir la boutique</a>
                    <ul class="sidebar-cta__trust">
                        <li>✓ Livraison sous 24h</li>
                        <li>✓ Certifié laboratoire</li>
                        <li>✓ -10% code BIENVENUE10</li>
                    </ul>
                </div>
                <?php endif; ?>
                <!-- Newsletter -->
                <div class="sidebar-widget sidebar-newsletter">
                    <h3 class="widget__title">Guide CBD gratuit</h3>
                    <p>Recevez notre guide complet du CBD + 10% de réduction.</p>
                    <form class="js-newsletter-form sidebar-nl-form">
                        <input type="email" name="email" placeholder="Votre email" class="newsletter-form__input" required>
                        <button type="submit" class="btn btn--primary btn--full">Recevoir le guide</button>
                    </form>
                </div>
            </aside>
        </div>
    </div>

    <!-- Tags -->
    <?php if ( has_tag() ): ?>
    <div class="container">
        <div class="post-tags">
            <strong>Tags :</strong>
            <?php the_tags('<span class="tag-link">', '</span><span class="tag-link">', '</span>'); ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Author box -->
    <div class="container">
        <div class="author-box">
            <?php echo get_avatar(get_the_author_meta('email'), 80, '', '', ['class' => 'author-box__avatar']); ?>
            <div class="author-box__content">
                <strong class="author-box__name"><?php the_author(); ?></strong>
                <p class="author-box__bio"><?php the_author_meta('description'); ?></p>
                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="author-box__link">Voir tous ses articles →</a>
            </div>
        </div>
    </div>

    <!-- Related posts -->
    <?php
    $tags     = wp_get_post_tags(get_the_ID(), ['fields' => 'ids']);
    $cats     = wp_get_post_categories(get_the_ID());
    $related  = get_posts([
        'posts_per_page'      => 3,
        'post__not_in'        => [get_the_ID()],
        'category__in'        => $cats,
        'ignore_sticky_posts' => true,
    ]);
    if ( $related ): ?>
    <section class="related-posts">
        <div class="container">
            <h2 class="related-posts__title">Articles similaires</h2>
            <div class="blog-grid blog-grid--3">
                <?php foreach ( $related as $p ):
                    setup_postdata($p);
                    ?>
                    <article class="blog-card">
                        <a href="<?php echo esc_url(get_permalink($p)); ?>" class="blog-card__image">
                            <?php echo get_the_post_thumbnail($p, 'greenpure-blog', ['loading' => 'lazy', 'class' => 'blog-card__img']); ?>
                        </a>
                        <div class="blog-card__body">
                            <h3 class="blog-card__title"><a href="<?php echo esc_url(get_permalink($p)); ?>"><?php echo esc_html(get_the_title($p)); ?></a></h3>
                            <a href="<?php echo esc_url(get_permalink($p)); ?>" class="blog-card__link">Lire →</a>
                        </div>
                    </article>
                <?php endforeach; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Comments -->
    <?php if ( comments_open() || get_comments_number() ): ?>
    <div class="container">
        <div class="comments-wrapper">
            <?php comments_template(); ?>
        </div>
    </div>
    <?php endif; ?>

</article>

<?php endwhile; ?>

<?php get_footer(); ?>

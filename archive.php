<?php get_header(); ?>

<div class="page-wrapper">
    <div class="container">
        <div class="shop-layout">

            <!-- Sidebar -->
            <aside class="shop-sidebar" id="shop-sidebar" aria-label="Filtres et navigation">
                <?php if ( is_active_sidebar('sidebar-shop') ): ?>
                    <?php dynamic_sidebar('sidebar-shop'); ?>
                <?php else: ?>
                    <!-- Widget catégories -->
                    <div class="widget sidebar-widget">
                        <h3 class="widget__title">Catégories</h3>
                        <ul class="sidebar-cats">
                            <?php
                            $cats = get_categories(['hide_empty' => false]);
                            foreach ( $cats as $cat ):
                            ?>
                            <li class="<?php echo is_category($cat) ? 'current-cat' : ''; ?>">
                                <a href="<?php echo esc_url(get_category_link($cat)); ?>">
                                    <?php echo esc_html($cat->name); ?>
                                    <span>(<?php echo esc_html($cat->count); ?>)</span>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <!-- Widget archives -->
                    <div class="widget sidebar-widget">
                        <h3 class="widget__title">Archives</h3>
                        <ul class="sidebar-archives">
                            <?php wp_get_archives(['type' => 'monthly', 'format' => 'html', 'show_post_count' => true]); ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </aside>

            <!-- Content -->
            <div class="shop-content">
                <header class="archive-header">
                    <h1 class="archive-header__title">
                        <?php
                        if ( is_category() ) {
                            single_cat_title();
                        } elseif ( is_tag() ) {
                            echo 'Tag : '; single_tag_title();
                        } elseif ( is_author() ) {
                            echo 'Articles de '; the_author();
                        } elseif ( is_date() ) {
                            echo get_the_date('F Y');
                        } else {
                            _e( 'Archives', 'greenpure-cbd' );
                        }
                        ?>
                    </h1>
                    <?php if ( is_category() && category_description() ): ?>
                        <div class="archive-header__desc"><?php echo category_description(); ?></div>
                    <?php endif; ?>
                </header>

                <?php if ( have_posts() ): ?>
                <div class="blog-grid blog-grid--archive">
                    <?php while ( have_posts() ): the_post(); ?>
                        <?php get_template_part('template-parts/content/content', 'archive'); ?>
                    <?php endwhile; ?>
                </div>
                <div class="pagination-wrap">
                    <?php
                    the_posts_pagination([
                        'mid_size'  => 2,
                        'prev_text' => '← Précédent',
                        'next_text' => 'Suivant →',
                    ]);
                    ?>
                </div>
                <?php else: ?>
                <div class="no-results">
                    <h2>Aucun article trouvé</h2>
                    <p>Essayez une autre recherche ou revenez à l'<a href="<?php echo esc_url(home_url('/')); ?>">accueil</a>.</p>
                </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>

<?php get_footer(); ?>

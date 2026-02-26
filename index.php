<?php get_header(); ?>

<div class="container">
    <?php if ( have_posts() ): ?>
        <div class="blog-grid blog-grid--archive">
            <?php while ( have_posts() ): the_post(); ?>
                <?php get_template_part('template-parts/content/content', get_post_format()); ?>
            <?php endwhile; ?>
        </div>
        <div class="pagination-wrap">
            <?php the_posts_pagination(['prev_text' => '← Précédent', 'next_text' => 'Suivant →', 'mid_size' => 2]); ?>
        </div>
    <?php else: ?>
        <div class="no-results">
            <h1>Aucun contenu trouvé</h1>
            <p><a href="<?php echo esc_url(home_url('/')); ?>">Retour à l'accueil</a></p>
        </div>
    <?php endif; ?>
</div>

<?php get_footer(); ?>

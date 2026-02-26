<?php get_header(); ?>

<?php while ( have_posts() ): the_post(); ?>

<div class="page-hero">
    <div class="container">
        <?php if ( function_exists('yoast_breadcrumb') ) yoast_breadcrumb('<nav class="breadcrumb">','</nav>'); ?>
        <h1 class="page-hero__title"><?php the_title(); ?></h1>
    </div>
    <?php if ( has_post_thumbnail() ): ?>
        <div class="page-hero__image"><?php the_post_thumbnail('greenpure-banner', ['loading' => 'eager']); ?></div>
    <?php endif; ?>
</div>

<div class="container">
    <div class="page-content entry-content">
        <?php the_content(); ?>
        <?php wp_link_pages(['before' => '<div class="page-links">', 'after' => '</div>']); ?>
    </div>
</div>

<?php endwhile; ?>

<?php get_footer(); ?>

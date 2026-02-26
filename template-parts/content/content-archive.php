<?php
/**
 * Template part: contenu article archive/blog
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('blog-card'); ?>>
    <a href="<?php the_permalink(); ?>" class="blog-card__image" tabindex="-1" aria-hidden="true">
        <?php if ( has_post_thumbnail() ): ?>
            <?php the_post_thumbnail('greenpure-blog', ['loading' => 'lazy', 'class' => 'blog-card__img']); ?>
        <?php else: ?>
            <div class="blog-card__img-placeholder"></div>
        <?php endif; ?>
        <span class="blog-card__category"><?php the_category(', '); ?></span>
    </a>
    <div class="blog-card__body">
        <div class="blog-card__meta">
            <time datetime="<?php the_date('c'); ?>"><?php the_date('d M Y'); ?></time>
            <span>·</span>
            <span><?php echo ceil(str_word_count(get_the_content()) / 200); ?> min</span>
        </div>
        <h2 class="blog-card__title h3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <p class="blog-card__excerpt"><?php echo greenpure_excerpt(20); ?></p>
        <a href="<?php the_permalink(); ?>" class="blog-card__link">
            Lire la suite
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
    </div>
</article>

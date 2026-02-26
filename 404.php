<?php get_header(); ?>

<section class="hero hero--404" style="min-height:70vh;padding:120px 0;">
  <div class="hero__bg"></div>
  <div class="container" style="position:relative;z-index:1;text-align:center;">
    <div style="font-size:120px;font-family:var(--font-heading);font-weight:900;color:rgba(82,183,136,0.2);line-height:1;margin-bottom:0;">404</div>
    <h1 style="font-family:var(--font-heading);font-size:clamp(28px,4vw,48px);color:#fff;margin-bottom:16px;">Page introuvable</h1>
    <p style="font-size:17px;color:rgba(255,255,255,0.7);max-width:480px;margin:0 auto 40px;">
      La page que vous cherchez n'existe pas ou a été déplacée.
      Explorez notre boutique CBD ou revenez à l'accueil.
    </p>
    <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap;">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn--primary btn--lg">Retour à l'accueil</a>
      <?php if (class_exists('WooCommerce')): ?>
      <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="btn btn--ghost btn--lg">Voir la boutique</a>
      <?php endif; ?>
    </div>
    <div style="margin-top:48px;">
      <?php get_search_form(); ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>

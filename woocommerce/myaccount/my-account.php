<?php
/**
 * GreenPure CBD — Page Mon Compte
 */
defined('ABSPATH') || exit;

get_header();
?>

<div class="myaccount-page">
    <div class="myaccount-page__hero">
        <div class="container">
            <h1 class="myaccount-page__title">
                <?php
                if ( is_user_logged_in() ) {
                    $user = wp_get_current_user();
                    printf(
                        esc_html__('Bonjour, %s', 'greenpure-cbd'),
                        '<span>' . esc_html($user->display_name) . '</span>'
                    );
                } else {
                    esc_html_e('Mon Compte', 'greenpure-cbd');
                }
                ?>
            </h1>
        </div>
    </div>

    <div class="container">
        <div class="myaccount-layout">

            <!-- Navigation latérale -->
            <nav class="myaccount-nav">
                <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
                <a href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>"
                   class="myaccount-nav__link<?php echo wc_is_current_account_menu_item($endpoint) ? ' is-active' : ''; ?>">
                    <?php
                    $icons = [
                        'dashboard'       => '<svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>',
                        'orders'          => '<svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>',
                        'downloads'       => '<svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>',
                        'edit-address'    => '<svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>',
                        'edit-account'    => '<svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>',
                        'customer-logout' => '<svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>',
                    ];
                    echo $icons[$endpoint] ?? '<svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/></svg>';
                    echo esc_html($label);
                    ?>
                </a>
                <?php endforeach; ?>
            </nav>

            <!-- Contenu -->
            <div class="myaccount-content">
                <?php
                do_action('woocommerce_account_content');
                ?>
            </div>

        </div>
    </div>
</div>

<?php get_footer(); ?>

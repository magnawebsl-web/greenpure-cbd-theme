<?php
/**
 * GreenPure CBD — Dashboard Mon Compte
 */
defined('ABSPATH') || exit;

$allowed_html = ['a' => ['href' => true]];
?>

<div class="myaccount-dashboard">

    <div class="dashboard-welcome">
        <p><?php
            printf(
                wp_kses(
                    /* translators: 1: user display name 2: logout url 3: my account url */
                    __('Bonjour %1$s (<a href="%2$s">Déconnexion</a>)', 'greenpure-cbd'),
                    $allowed_html
                ),
                '<strong>' . esc_html(wp_get_current_user()->display_name) . '</strong>',
                esc_url(wc_logout_url()),
                esc_url(wc_get_page_permalink('myaccount'))
            );
        ?></p>
        <p><?php
            printf(
                wp_kses(
                    __('Depuis votre espace client, vous pouvez consulter vos <a href="%1$s">commandes récentes</a>, gérer vos <a href="%2$s">adresses de livraison et de facturation</a> et <a href="%3$s">modifier votre mot de passe et les détails de votre compte</a>.', 'greenpure-cbd'),
                    $allowed_html
                ),
                esc_url(wc_get_account_endpoint_url('orders')),
                esc_url(wc_get_account_endpoint_url('edit-address')),
                esc_url(wc_get_account_endpoint_url('edit-account'))
            );
        ?></p>
    </div>

    <div class="dashboard-cards">
        <?php
        $cards = [
            [
                'icon'  => '<svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>',
                'title' => __('Mes commandes', 'greenpure-cbd'),
                'desc'  => __('Suivez et gérez vos commandes', 'greenpure-cbd'),
                'url'   => wc_get_account_endpoint_url('orders'),
                'color' => 'green',
            ],
            [
                'icon'  => '<svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>',
                'title' => __('Mes adresses', 'greenpure-cbd'),
                'desc'  => __('Gérez vos adresses de livraison', 'greenpure-cbd'),
                'url'   => wc_get_account_endpoint_url('edit-address'),
                'color' => 'gold',
            ],
            [
                'icon'  => '<svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>',
                'title' => __('Mon profil', 'greenpure-cbd'),
                'desc'  => __('Mettez à jour vos informations', 'greenpure-cbd'),
                'url'   => wc_get_account_endpoint_url('edit-account'),
                'color' => 'purple',
            ],
        ];

        foreach ( $cards as $card ) :
        ?>
        <a href="<?php echo esc_url($card['url']); ?>" class="dashboard-card dashboard-card--<?php echo esc_attr($card['color']); ?>">
            <div class="dashboard-card__icon"><?php echo $card['icon']; ?></div>
            <div class="dashboard-card__body">
                <strong class="dashboard-card__title"><?php echo esc_html($card['title']); ?></strong>
                <span class="dashboard-card__desc"><?php echo esc_html($card['desc']); ?></span>
            </div>
            <svg class="dashboard-card__arrow" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <polyline points="9 18 15 12 9 6"/>
            </svg>
        </a>
        <?php endforeach; ?>
    </div>

</div>

<?php do_action('woocommerce_account_dashboard'); ?>

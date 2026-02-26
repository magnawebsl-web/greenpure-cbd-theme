<?php
/**
 * GreenPure CBD — Formulaire de recherche
 */
$unique_id = esc_attr( uniqid( 'search-form-' ) );
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label for="<?php echo $unique_id; ?>" class="sr-only"><?php _e( 'Rechercher :', 'greenpure-cbd' ); ?></label>
    <input
        type="search"
        id="<?php echo $unique_id; ?>"
        class="search-field"
        placeholder="<?php echo esc_attr_x( 'Rechercher des produits CBD...', 'placeholder', 'greenpure-cbd' ); ?>"
        value="<?php echo get_search_query(); ?>"
        name="s"
        autocomplete="off"
    />
    <button type="submit" class="search-submit">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
        </svg>
        <span class="sr-only"><?php _e( 'Rechercher', 'greenpure-cbd' ); ?></span>
    </button>
</form>

<?php
/**
 * Core functions
 */
// Start session on init hook.
// See https://stackoverflow.com/a/16119876
add_action( 'init', 'trb_start_session' );
function trb_start_session() {
    if (session_status() === PHP_SESSION_NONE && ! session_id()) {
        session_start();
    }
}

/**
 * Shows a message to users.
 *
 * @param string $text
 * @param string $type
 *   'success' | 'error' | 'info'
 *
 * @return void
 */
function set_trb_message(string $text, string $type = 'info'): void {
    $messages = get_transient('messages');
    if (! $messages) {
        $messages = [];
    }
    $message_i = (object) ['text' => $text, 'type' => $type];
    $messages[] = $message_i;
    set_transient( 'messages', $messages  );
}

add_post_type_support( 'page', 'excerpt' );
add_theme_support( 'post-thumbnails' );
remove_action( 'wp_head', 'wp_generator' );

/**
 * Hide password-protected posts from every front-end listing / feed / array.
 *
 * The blog listings, "load more" AJAX feeds (blog_filter_load_function,
 * load_cate_posts, home_page_load_function) and RSS feeds are built all over
 * the theme with wp_get_recent_posts() / get_posts() / WP_Query. Those default
 * to suppress_filters=true, so a pre_get_posts hook never reaches them — but
 * the core `has_password` query var is honoured regardless of suppress_filters,
 * and the `parse_query` action fires even for suppressed queries. Setting
 * has_password to false appends `post_password = ''` to the WHERE clause, which
 * excludes protected posts from every listing in a single place rather than
 * having to patch each scattered query array.
 *
 * Guards:
 *  - Real wp-admin screens are left alone (but admin-ajax front-end feeds, where
 *    is_admin() is also true, are NOT skipped — hence the wp_doing_ajax() check).
 *  - REST requests are skipped so the block editor still sees protected posts.
 *  - Singular queries are skipped so a protected post's own page still renders
 *    its password form.
 *  - Queries that already set has_password explicitly are respected.
 */
add_action( 'parse_query', 'trb_hide_password_protected_from_listings' );
function trb_hide_password_protected_from_listings( $query ) {
    if ( is_admin() && ! wp_doing_ajax() ) {
        return;
    }
    if ( defined( 'REST_REQUEST' ) && REST_REQUEST ) {
        return;
    }
    if ( $query->is_singular() ) {
        return;
    }
    if ( null === $query->get( 'has_password', null ) ) {
        $query->set( 'has_password', false );
    }
}
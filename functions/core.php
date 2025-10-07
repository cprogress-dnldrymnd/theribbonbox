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
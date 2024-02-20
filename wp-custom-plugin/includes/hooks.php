<?php

function display_custom_button() {
    global $post;
    
    if (has_shortcode($post->post_content, 'custom_shortcode')) {
        echo '<div class="custom-button-container"><button class="custom-button">Commencez ici</button></div>';
    }
}
add_action('wp_footer', 'display_custom_button');

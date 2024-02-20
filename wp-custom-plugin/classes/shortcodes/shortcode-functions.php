<?php

function custom_shortcode_function($atts) {
    
    return '<div class="custom-button-container"><button class="custom-button">Commencez ici</button></div>';
}
add_shortcode('custom_shortcode', 'custom_shortcode_function');

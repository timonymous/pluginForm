<?php
add_action('wp_ajax_handle_custom_form_submission', 'handle_form_submission');
add_action('wp_ajax_nopriv_handle_custom_form_submission', 'handle_form_submission');

function handle_form_submission() {
    
    wp_send_json_success('Message de succès ou données à renvoyer');
}

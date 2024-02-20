<?php
/*
Plugin Name: Timothe
Description: Plugin Timothe.
Version: 1.0.0
Author: Timothe
Author URI: #
Text Domain: wp-custom-plugin
*/

register_activation_hook(__FILE__, 'custom_plugin_activate');

function custom_plugin_activate() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'custom_data';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        name varchar(255) NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

function custom_plugin_enqueue_scripts() {
    wp_enqueue_script('custom-plugin-script', plugin_dir_url(__FILE__) . 'script.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'custom_plugin_enqueue_scripts');

// Traitement du formulaire
add_action('wp_ajax_handle_custom_form_submission', 'handle_custom_form_submission');
function handle_custom_form_submission() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'custom_data';

    $name = $_POST['name'];
    $wpdb->insert(
        $table_name,
        array(
            'name' => $name,
        )
    );

    wp_die();
}

function load_font_awesome() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'load_font_awesome');

function load_less_compiler() {
    wp_enqueue_script('less-js', 'https://cdnjs.cloudflare.com/ajax/libs/less.js/3.12.2/less.min.js', array(), '3.12.2', true);
}
add_action('wp_enqueue_scripts', 'load_less_compiler');


function load_plugin_js() {
    wp_enqueue_script('less-js', 'https://cdnjs.cloudflare.com/ajax/libs/less.js/3.12.2/less.min.js', array(), '3.12.2', true);
    wp_enqueue_script('handlebars', 'https://cdn.jsdelivr.net/npm/handlebars/dist/handlebars.min.js', array(), '4.0.12', true);
    wp_enqueue_script('plugin-script', plugin_dir_url(__FILE__) . 'assets/js/script.js', array('jquery'), '1.0', true);
    wp_localize_script('plugin-script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'load_plugin_js');


function load_plugin_less() {
    $less_file_url = plugin_dir_url(__FILE__) . 'assets/less/style.less';
    wp_enqueue_style('plugin-style-less', $less_file_url);
    wp_add_inline_script('less-js', 'less = { env: "development" };', 'before');
}
add_action('wp_enqueue_scripts', 'load_plugin_less');


require_once plugin_dir_path(__FILE__) . 'classes/helpers/helper-functions.php';
require_once plugin_dir_path(__FILE__) . 'classes/main/admin_index.php';
require_once plugin_dir_path(__FILE__) . 'classes/main/admin_front_index.php';
require_once plugin_dir_path(__FILE__) . 'classes/shortcodes/shortcode-functions.php';
require_once plugin_dir_path(__FILE__) . 'classes/views/shortcode-view.php';
require_once plugin_dir_path(__FILE__) . 'classes/crud/crud-functions.php';
require_once plugin_dir_path(__FILE__) . 'includes/hooks.php';

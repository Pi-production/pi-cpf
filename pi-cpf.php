<?php
/**
 * Plugin Name: PI Custom Post Fields
 * Description: Centralized PI-CFP functionality for custom posts.
 * Version: 1.0
 * Author: Your Name
 */

if (!defined('ABSPATH')) exit;

// Include meta-box.php
include plugin_dir_path(__FILE__) . 'meta-box.php';

// Enqueue centralized JS/CSS
function pi_cpf_enqueue_assets() {
    $base_url = 'https://dev.pubinteractive.ca/pi-cpf/assets/';

    wp_enqueue_script_module('pi-meta-router', $base_url . 'pi-meta-router.js', [], null, true);
    wp_enqueue_script_module('pi-meta', $base_url . 'pi-meta.js', [], null, true);
    wp_enqueue_script_module('pi-meta-json', $base_url . 'pi-meta-json.js', [], null, true);
    wp_enqueue_style('pi-meta-style', $base_url . 'pi-meta.css', [], null);
}
add_action('wp_enqueue_scripts', 'pi_cpf_enqueue_assets');
add_action('admin_enqueue_scripts', 'pi_cpf_enqueue_assets');
<?php
/*
Plugin Name: Pi CPF
Plugin URI: https://github.com/Pi-production/pi-cpf
Description: A all-in-one builder by PubInteractive.
Version: 1.0.0
Author: PubInteractive
Author URI: https://pubinteractive.ca
License: GPL2
*/

require plugin_dir_path(__FILE__) . 'plugin-update-checker/plugin-update-checker.php';

$updateChecker = Puc_v4_Factory::buildUpdateChecker(
    'https://github.com/Pi-production/pi-cpf/', // Your repo URL
    __FILE__,                                   // Path to this plugin file
    'pi-cpf'                                    // Plugin slug (folder name)
);

// Optional: use a specific branch
$updateChecker->setBranch('main');

if (!defined('ABSPATH')) exit;

// Include meta-box.php
include plugin_dir_path(__FILE__) . 'meta-box.php';

function pi_cpf_enqueue_assets() {
    $plugin_url = plugin_dir_url(__FILE__);

    wp_enqueue_script_module('pi-meta-router', $plugin_url . 'assets/pi-meta-router.js', [], null, true);
    wp_enqueue_script_module('pi-meta', $plugin_url . 'assets/pi-meta.js', [], null, true);
    wp_enqueue_script_module('pi-meta-json', $plugin_url . 'assets/pi-meta-json.js', [], null, true);
    wp_enqueue_style('pi-meta-style', $plugin_url . 'assets/pi-meta.css', [], null);
}
add_action('wp_enqueue_scripts', 'pi_cpf_enqueue_assets');
add_action('admin_enqueue_scripts', 'pi_cpf_enqueue_assets');
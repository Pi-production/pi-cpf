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
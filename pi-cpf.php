<?php
/*
Plugin Name: Pi CPF
Plugin URI: https://github.com/Pi-production/pi-cpf
Description: An all-in-one builder by PubInteractive.
Version: 1.0.2
Author: PubInteractive
Author URI: https://pubinteractive.ca
License: GPL2
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

// -----------------------
// Load Plugin Update Checker safely
// -----------------------
$update_checker_path = plugin_dir_path(__FILE__) . 'plugin-update-checker/plugin-update-checker.php';

if (file_exists($update_checker_path)) {
    require $update_checker_path;

    if (class_exists('\YahnisElsts\PluginUpdateChecker\v5p6\PucFactory')) {
        // Build update checker
        $updateChecker = \YahnisElsts\PluginUpdateChecker\v5p6\PucFactory::buildUpdateChecker(
            'https://github.com/Pi-production/pi-cpf', // GitHub repo URL (no trailing slash)
            __FILE__,                                   // This plugin file
            'pi-cpf'                                    // Plugin slug (folder name)
        );

        $updateChecker->setBranch('main'); // Optional: branch

        error_log('PUC loaded successfully');

        // Optional: debug remote version (for dev purposes)
        add_action('init', function() use ($updateChecker) {
            $installed_version = $updateChecker->getInstalledVersion();
            error_log('PUC installed version: ' . $installed_version);

            // v5.6: get remote version safely
            $remote_info = $updateChecker->getVcsApi()->getInfo();
            if (is_array($remote_info)) {
                $latest_version = isset($remote_info['version']) ? $remote_info['version'] : '(unknown)';
                error_log('PUC detected latest remote version: ' . $latest_version);
            } else {
                error_log('PUC could not fetch remote info: ' . print_r($remote_info, true));
            }
        });

    } else {
        error_log('PUC loaded but class not found!');
    }
} else {
    error_log('PUC NOT loaded!');
}


// -----------------------
// Include meta-box.php
// -----------------------
include plugin_dir_path(__FILE__) . 'meta-box.php';


// -----------------------
// Enqueue JS/CSS assets
// -----------------------
function pi_cpf_enqueue_assets() {
    $plugin_url = plugin_dir_url(__FILE__);

    wp_enqueue_script_module('pi-meta-router', $plugin_url . 'assets/pi-meta-router.js', [], null, true);
    wp_enqueue_script_module('pi-meta', $plugin_url . 'assets/pi-meta.js', [], null, true);
    wp_enqueue_script_module('pi-meta-json', $plugin_url . 'assets/pi-meta-json.js', [], null, true);
    wp_enqueue_style('pi-meta-style', $plugin_url . 'assets/pi-meta.css', [], null);
}
add_action('wp_enqueue_scripts', 'pi_cpf_enqueue_assets');
add_action('admin_enqueue_scripts', 'pi_cpf_enqueue_assets');
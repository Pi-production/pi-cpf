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

$update_checker_path = plugin_dir_path(__FILE__) . 'plugin-update-checker/plugin-update-checker.php';

if (file_exists($update_checker_path)) {
    require_once $update_checker_path;

    if (class_exists('\YahnisElsts\PluginUpdateChecker\v5p6\PucFactory')) {
        $updateChecker = \YahnisElsts\PluginUpdateChecker\v5p6\PucFactory::buildUpdateChecker(
            'https://github.com/Pi-production/pi-cpf', // GitHub repo
            __FILE__,
            'pi-cpf' // Plugin slug
        );

        // Optional: use branch
        // $updateChecker->setBranch('main');

        error_log('PUC loaded successfully');

        // DEBUG: log installed and remote version
        add_action('admin_init', function() use ($updateChecker) {
            // Force WP to fetch fresh plugin update info
            delete_site_transient('update_plugins');
            error_log('Transient for plugin updates cleared.');

            $installed_version = $updateChecker->getInstalledVersion();
            error_log('PUC installed version: ' . $installed_version);

            $remote_info = $updateChecker->getUpdateData(); // returns array or null
            if ($remote_info) {
                error_log('PUC remote info array: ' . print_r($remote_info, true));
                $latest_version = isset($remote_info['version']) ? $remote_info['version'] : '(unknown)';
                error_log('PUC sees latest version: ' . $latest_version);
            } else {
                error_log('PUC could not fetch remote info. Likely no valid tag detected.');
            }
        });

    } else {
        error_log('PUC class not found!');
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
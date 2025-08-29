<?php
/*
Plugin Name: Pi CPF
Plugin URI: https://github.com/Pi-production/pi-cpf
Description: An all-in-one builder by PubInteractive.
Version: 1.0.3
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
        add_action('admin_init', function() {
            $repo_owner = 'Pi-production';
            $repo_name  = 'pi-cpf';
            $api_url    = "https://api.github.com/repos/$repo_owner/$repo_name/tags";
        
            $response = wp_remote_get($api_url, [
                'headers' => [
                    'User-Agent' => 'WordPress-PUC-Debug' // GitHub requires a user agent
                ],
                'timeout' => 15,
            ]);
        
            if (is_wp_error($response)) {
                error_log('GitHub connection test failed: ' . $response->get_error_message());
                return;
            }
        
            $code = wp_remote_retrieve_response_code($response);
            $body = wp_remote_retrieve_body($response);
        
            error_log('GitHub connection test HTTP code: ' . $code);
            error_log('GitHub tags response snippet: ' . substr($body, 0, 300));
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
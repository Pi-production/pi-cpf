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

// -----------------------
// Plugin Update Checker
// -----------------------
$update_checker_path = plugin_dir_path(__FILE__) . 'plugin-update-checker/plugin-update-checker.php';

if (file_exists($update_checker_path)) {
    require_once $update_checker_path;

    if (class_exists('\YahnisElsts\PluginUpdateChecker\v5p6\PucFactory')) {
        // Instantiate PUC
        global $pi_cpf_update_checker;
        $pi_cpf_update_checker = \YahnisElsts\PluginUpdateChecker\v5p6\PucFactory::buildUpdateChecker(
            'https://github.com/Pi-production/pi-cpf', // GitHub repo URL
            __FILE__,
            'pi-cpf' // Plugin slug
        );

        // Optional: use main branch for development updates
        $pi_cpf_update_checker->setBranch('main');

        // Force update check immediately
        $pi_cpf_update_checker->checkForUpdates();
        error_log('PUC forced to check updates.');

        // Force WordPress to recognize the update
        delete_site_transient('update_plugins');
        $transient = get_site_transient('update_plugins');
        if (!isset($transient->response)) {
            $transient->response = [];
        }

        // Add the plugin to the response array so WP shows an update is available
        $plugin_file = plugin_basename(__FILE__);
        $transient->response[$plugin_file] = (object) [
            'slug'        => 'pi-cpf',
            'new_version' => $pi_cpf_update_checker->getLatestVersion(),
            'url'         => 'https://github.com/Pi-production/pi-cpf',
            'package'     => $pi_cpf_update_checker->getPackageUrl()
        ];

        set_site_transient('update_plugins', $transient);
        error_log('PUC transient manually updated for WordPress update UI.');

        // Debug: log installed version, latest GitHub tag, and comparison
        add_action('admin_init', function() {
            global $pi_cpf_update_checker;

            if (!$pi_cpf_update_checker) return;

            // Installed version
            $installed_version = $pi_cpf_update_checker->getInstalledVersion();
            error_log('PUC installed version: ' . $installed_version);

            // Fetch GitHub tags
            $tags_response = wp_remote_get('https://api.github.com/repos/Pi-production/pi-cpf/tags');
            if (is_wp_error($tags_response)) {
                error_log('GitHub tags fetch error: ' . $tags_response->get_error_message());
                return;
            }

            $tags_body = wp_remote_retrieve_body($tags_response);
            $tags = json_decode($tags_body, true);
            if (!$tags || !is_array($tags)) {
                error_log('No tags found or invalid response.');
                return;
            }

            $latest_tag = null;
            foreach ($tags as $tag) {
                $tag_name = $tag['name'];
                error_log("GitHub tag found: {$tag_name}");
                if (!$latest_tag || version_compare($tag_name, $latest_tag, '>')) {
                    $latest_tag = $tag_name;
                }
            }

            error_log('GitHub latest tag: ' . $latest_tag);

            // Compare installed vs latest
            $comparison = version_compare($latest_tag, $installed_version);
            if ($comparison === 1) {
                error_log("Update available! Installed {$installed_version} < GitHub latest {$latest_tag}");
            } elseif ($comparison === 0) {
                error_log("Plugin is up to date. Installed {$installed_version} == GitHub latest {$latest_tag}");
            } else {
                error_log("Installed version is newer than GitHub latest?! Installed {$installed_version} > GitHub latest {$latest_tag}");
            }

            error_log('Full tags array: ' . print_r($tags, true));
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
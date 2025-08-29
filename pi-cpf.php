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
        $updateChecker->setBranch('main');

        error_log('PUC loaded successfully');

        // DEBUG: log installed and remote version
        add_action('admin_init', function() use ($updateChecker) {
            $installed_version = $updateChecker->getInstalledVersion();
            error_log('PUC installed version: ' . $installed_version);
        
            // Fetch GitHub tags directly
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
        
            // Find the "latest" tag by version_compare
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
        
            // Optional: log the entire tags array for reference
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
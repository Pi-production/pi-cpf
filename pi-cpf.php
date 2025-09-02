<?php
/*
Plugin Name: Pi CPF
Plugin URI: https://github.com/Pi-production/pi-cpf
Description: An all-in-one builder by PubInteractive.
Version: 1.0.8
Author: PubInteractive
Author URI: https://pubinteractive.ca
License: GPL2
*/

require 'plugin-update-checker/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$myUpdateChecker = PucFactory::buildUpdateChecker(
	'https://github.com/Pi-production/pi-cpf/blob/main/plugin.json',
	__FILE__, //Full path to the main plugin file or functions.php.
	'pi-cpf'
);

//Set the branch that contains the stable release.
$myUpdateChecker->setBranch('main');

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
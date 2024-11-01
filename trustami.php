<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://app.trustami.com/
 * @since             1.0.0
 * @package           Trustami
 *
 * @wordpress-plugin
 * Plugin Name:       Trustami Badge for Customer Reviews and Google Stars
 * Plugin URI:        https://app.trustami.com/manuals/WooCommerce?lang=en
 * Description:       Trustami plugin for WooCommerce. Trustami - One badge for all your customer reviews. Trustami collects, analyzes and presents a users’ distributed social media data in a standardized and user-friendly format to fill the need for trust in online interactions. Trustami enables users to collect ratings and reviews from all networks and show a trust badge.
 * Version:           1.0.9
 * Author:            Trustami GmbH
 * Author URI:        https://www.trustami.com/en
 * License:           GPLv3
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       trustami-badge-for-customer-reviews-and-google-stars
 * Domain Path:       /languages/
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-trustami-activator.php
 */
function activate_trustami() {
    require_once plugin_dir_path(__FILE__) . 'includes/class-trustami-activator.php';
    Trustami_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-trustami-deactivator.php
 */
function deactivate_trustami() {
    require_once plugin_dir_path(__FILE__) . 'includes/class-trustami-deactivator.php';
    Trustami_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_trustami');
register_deactivation_hook(__FILE__, 'deactivate_trustami');

/**
 * The code adds an admin url to the Plugins page
 */
function trustami_plugin_actions($links) {
    $settings_link = '<a href="' . admin_url( 'admin.php?page=wc-settings&tab=trustami_settings_tab' ) . '">' . __('Settings', 'trustami-badge-for-customer-reviews-and-google-stars'). '</a>';
    array_unshift( $links, $settings_link );
    return $links;
}

add_filter('plugin_action_links_'.plugin_basename( __FILE__ ), 'trustami_plugin_actions');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-trustami.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_trustami() {
    $plugin = new Trustami();
    $plugin->run();
}

run_trustami();
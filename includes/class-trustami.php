<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.trustami.com
 * @since      1.0.0
 *
 * @package    Trustami
 * @subpackage Trustami/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Trustami
 * @subpackage Trustami/includes
 * @author     Trustami GmbH <https://www.trustami.com>
 */
class Trustami {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Trustami_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'Trustami Badge for Customer Reviews and Google Stars';
		$this->version = '1.0.9';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->add_trustami_settings_tab();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Trustami_Loader. Orchestrates the hooks of the plugin.
	 * - Trustami_i18n. Defines internationalization functionality.
	 * - Trustami_Admin. Defines all hooks for the admin area.
	 * - Trustami_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-trustami-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-trustami-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-trustami-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-trustami-public.php';

		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-trustami-settings-tab.php';

		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/widgets/class-trustami-widget-container.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/widgets/class-trustami-widget-badge.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/widgets/class-trustami-widget-box.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/widgets/class-trustami-widget-sticker.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/widgets/class-trustami-widget-button.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/widgets/class-trustami-widget-social.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/widgets/class-trustami-widget-duo.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/widgets/class-trustami-widget-text.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/widgets/class-trustami-widget-shopauskunft.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/widgets/class-trustami-widget-stars.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/widgets/class-trustami-widget-comments.php';

		$this->loader = new Trustami_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Trustami_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Trustami_i18n();

		$this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Trustami_Admin($this->get_plugin_name(), $this->get_version());

		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Trustami_Public($this->get_plugin_name(), $this->get_version());

		$this->loader->add_action('get_footer', $plugin_public, 'returnTrustamiFooterCnt');
		$this->loader->add_action('get_header', $plugin_public, 'returnTrustamiHeaderCnt');
		$this->loader->add_filter('woocommerce_short_description',$plugin_public, 'returnTrustamiCategoryCnt');

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Trustami_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	function add_trustami_settings_tab() {
		WC_Trustami_Settings_Tab::init();
	}

}

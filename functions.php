<?php

/**
 * Theme functions and definitions
 *
 * @package CoffeeStore
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

require_once get_template_directory() . '/includes/class-tgm-plugin-activation.php';

require_once get_template_directory() . '/includes/update-functions.php';

add_action('tgmpa_register', 'coffee_store__register_required_plugins');
function coffee_store__register_required_plugins()
{
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		array(
			'name'      => 'Elementor',
			'slug'      => 'elementor',
			'required'  => true,
		),

		array(
			'name'         => 'PRO Elements',
			'slug'         => 'pro-elements',
			'source'       => 'https://github.com/proelements/proelements/releases/download/v3.6.4/pro-elements.zip',
			'required'     => true,
		),
	);

	$config = array(
		'id'           => 'coffee-store',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);


	tgmpa($plugins, $config);
}

define('COFFEE_STORE_VERSION', '1.0.3');

if (!isset($content_width)) {
	$content_width = 800; // Pixels.
}

if (!function_exists('coffee_store_setup')) {
	/**
	 * Set up theme support.
	 *
	 * @return void
	 */
	function coffee_store_setup()
	{
		if (is_admin()) {
			coffee_maybe_update_theme_version_in_db();
		}

		$hook_result = apply_filters_deprecated('coffee_store_theme_load_textdomain', [true], '2.0', 'coffee_store_load_textdomain');
		if (apply_filters('coffee_store_load_textdomain', $hook_result)) {
			load_theme_textdomain('coffee-store', get_template_directory() . '/languages');
		}

		$hook_result = apply_filters_deprecated('coffee_store_theme_register_menus', [true], '2.0', 'coffee_store_register_menus');
		if (apply_filters('coffee_store_register_menus', $hook_result)) {
			register_nav_menus(['menu-1' => __('Header', 'coffee-store')]);
			register_nav_menus(['menu-2' => __('Footer', 'coffee-store')]);
		}

		$hook_result = apply_filters_deprecated('coffee_store_theme_add_theme_support', [true], '2.0', 'coffee_store_add_theme_support');
		if (apply_filters('coffee_store_add_theme_support', $hook_result)) {
			add_theme_support('post-thumbnails');
			add_theme_support('automatic-feed-links');
			add_theme_support('title-tag');
			add_theme_support(
				'html5',
				[
					'search-form',
					'comment-form',
					'comment-list',
					'gallery',
					'caption',
				]
			);
			add_theme_support(
				'custom-logo',
				[
					'height'      => 100,
					'width'       => 350,
					'flex-height' => true,
					'flex-width'  => true,
				]
			);

			/*
			 * Editor Style.
			 */
			add_editor_style('classic-editor.css');

			/*
			 * Gutenberg wide images.
			 */
			add_theme_support('align-wide');

			/*
			 * WooCommerce.
			 */
			$hook_result = apply_filters_deprecated('coffee_store_theme_add_woocommerce_support', [true], '2.0', 'coffee_store_add_woocommerce_support');
			if (apply_filters('coffee_store_add_woocommerce_support', $hook_result)) {
				// WooCommerce in general.
				add_theme_support('woocommerce');
				// Enabling WooCommerce product gallery features (are off by default since WC 3.0.0).
				// zoom.
				add_theme_support('wc-product-gallery-zoom');
				// lightbox.
				add_theme_support('wc-product-gallery-lightbox');
				// swipe.
				add_theme_support('wc-product-gallery-slider');
			}
		}
	}
}
add_action('after_setup_theme', 'coffee_store_setup');

function coffee_maybe_update_theme_version_in_db()
{
	$theme_version_option_name = 'coffee_theme_version';
	// The theme version saved in the database.
	$coffee_theme_db_version = get_option($theme_version_option_name);

	// If the 'coffee_theme_version' option does not exist in the DB, or the version needs to be updated, do the update.
	if (!$coffee_theme_db_version || version_compare($coffee_theme_db_version, COFFEE_STORE_VERSION, '<')) {
		update_option($theme_version_option_name, COFFEE_STORE_VERSION);
	}
}

if (!function_exists('coffee_store_scripts_styles')) {
	/**
	 * Theme Scripts & Styles.
	 *
	 * @return void
	 */
	function coffee_store_scripts_styles()
	{
		$enqueue_basic_style = apply_filters_deprecated('coffee_store_theme_enqueue_style', [true], '2.0', 'coffee_store_enqueue_style');
		$min_suffix          = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';

		if (apply_filters('coffee_store_enqueue_style', $enqueue_basic_style)) {
			wp_enqueue_style(
				'coffee-store',
				get_template_directory_uri() . '/style' . $min_suffix . '.css',
				[],
				COFFEE_STORE_VERSION
			);
		}

		if (apply_filters('coffee_store_enqueue_theme_style', true)) {
			wp_enqueue_style(
				'coffee-store-theme-style',
				get_template_directory_uri() . '/theme' . $min_suffix . '.css',
				[],
				COFFEE_STORE_VERSION
			);
		}
	}
}
add_action('wp_enqueue_scripts', 'coffee_store_scripts_styles');

if (!function_exists('coffee_store_register_elementor_locations')) {
	/**
	 * Register Elementor Locations.
	 *
	 * @param ElementorPro\Modules\ThemeBuilder\Classes\Locations_Manager $elementor_theme_manager theme manager.
	 *
	 * @return void
	 */
	function coffee_store_register_elementor_locations($elementor_theme_manager)
	{
		$hook_result = apply_filters_deprecated('coffee_store_theme_register_elementor_locations', [true], '2.0', 'coffee_store_register_elementor_locations');
		if (apply_filters('coffee_store_register_elementor_locations', $hook_result)) {
			$elementor_theme_manager->register_all_core_location();
		}
	}
}
add_action('elementor/theme/register_locations', 'coffee_store_register_elementor_locations');

if (!function_exists('coffee_store_content_width')) {
	/**
	 * Set default content width.
	 *
	 * @return void
	 */
	function coffee_store_content_width()
	{
		$GLOBALS['content_width'] = apply_filters('coffee_store_content_width', 800);
	}
}
add_action('after_setup_theme', 'coffee_store_content_width', 0);

if (is_admin()) {
	require get_template_directory() . '/includes/admin-functions.php';
}

/**
 * If Elementor is installed and active, we can load the Elementor-specific Settings & Features
 */

// Allow active/inactive via the Experiments
require get_template_directory() . '/includes/elementor-functions.php';

/**
 * Include customizer registration functions
 */
function coffee_register_customizer_functions()
{
	if (coffee_header_footer_experiment_active() && is_customize_preview()) {
		require get_template_directory() . '/includes/customizer-functions.php';
	}
}
add_action('init', 'coffee_register_customizer_functions');

if (!function_exists('coffee_store_check_hide_title')) {
	/**
	 * Check hide title.
	 *
	 * @param bool $val default value.
	 *
	 * @return bool
	 */
	function coffee_store_check_hide_title($val)
	{
		if (defined('ELEMENTOR_VERSION')) {
			$current_doc = Elementor\Plugin::instance()->documents->get(get_the_ID());
			if ($current_doc && 'yes' === $current_doc->get_settings('hide_title')) {
				$val = false;
			}
		}
		return $val;
	}
}
add_filter('coffee_store_page_title', 'coffee_store_check_hide_title');

/**
 * Wrapper function to deal with backwards compatibility.
 */
if (!function_exists('coffee_store_body_open')) {
	function coffee_store_body_open()
	{
		if (function_exists('wp_body_open')) {
			wp_body_open();
		} else {
			do_action('wp_body_open');
		}
	}
}

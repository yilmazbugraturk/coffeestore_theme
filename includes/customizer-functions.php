<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Register Customizer controls which add Elementor deeplinks
 *
 * @return void
 */
add_action( 'customize_register', 'coffee_customizer_register' );
function coffee_customizer_register( $wp_customize ) {
	require get_template_directory() . '/includes/customizer/elementor-upsell.php';

	$wp_customize->add_section(
		'coffee_theme_options',
		[
			'title' => __( 'Header &amp; Footer', 'coffee-store' ),
			'capability' => 'edit_theme_options',
		]
	);

	$wp_customize->add_setting(
		'coffee-store-header-footer',
		[
			'sanitize_callback' => false,
			'transport' => 'refresh',
		]
	);

	$wp_customize->add_control(
		new HelloElementor\Includes\Customizer\Elementor_Upsell(
			$wp_customize,
			'coffee-store-header-footer',
			[
				'section' => 'coffee_theme_options',
				'priority' => 20,
			]
		)
	);
}


/**
 * Enqueue Customiser CSS
 *
 * @return string HTML to use in the customizer panel
 */
add_action( 'admin_enqueue_scripts', 'coffee_customizer_print_styles' );
function coffee_customizer_print_styles() {

	$min_suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_style(
		'coffee-store-customizer',
		get_template_directory_uri() . '/customizer' . $min_suffix . '.css',
		[],
		COFFEE_STORE_VERSION
	);
}

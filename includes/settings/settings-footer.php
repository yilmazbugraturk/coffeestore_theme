<?php

namespace HelloElementor\Includes\Settings;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Tab_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Settings_Footer extends Tab_Base {

	public function get_id() {
		return 'coffee-settings-footer';
	}

	public function get_title() {
		return __( 'Footer', 'coffee-store' );
	}

	public function get_icon() {
		return 'eicon-footer';
	}

	public function get_help_url() {
		return '';
	}

	public function get_group() {
		return 'theme-style';
	}

	protected function register_tab_controls() {

		$this->start_controls_section(
			'coffee_footer_section',
			[
				'tab' => 'coffee-settings-footer',
				'label' => __( 'Footer', 'coffee-store' ),
			]
		);

		$this->add_control(
			'coffee_footer_logo_display',
			[
				'type' => Controls_Manager::SWITCHER,
				'label' => __( 'Site Logo', 'coffee-store' ),
				'default' => 'yes',
				'label_on' => __( 'Show', 'coffee-store' ),
				'label_off' => __( 'Hide', 'coffee-store' ),
				'selector' => '.site-footer .site-branding',
			]
		);

		$this->add_control(
			'coffee_footer_tagline_display',
			[
				'type' => Controls_Manager::SWITCHER,
				'label' => __( 'Tagline', 'coffee-store' ),
				'default' => 'yes',
				'label_on' => __( 'Show', 'coffee-store' ),
				'label_off' => __( 'Hide', 'coffee-store' ),
				'selector' => '.site-footer .site-description',
			]
		);

		$this->add_control(
			'coffee_footer_menu_display',
			[
				'type' => Controls_Manager::SWITCHER,
				'label' => __( 'Menu', 'coffee-store' ),
				'default' => 'yes',
				'label_on' => __( 'Show', 'coffee-store' ),
				'label_off' => __( 'Hide', 'coffee-store' ),
				'selector' => '.site-footer .site-navigation',
			]
		);

		$this->add_control(
			'coffee_footer_copyright_display',
			[
				'type' => Controls_Manager::SWITCHER,
				'label' => __( 'Copyright', 'coffee-store' ),
				'default' => 'yes',
				'label_on' => __( 'Show', 'coffee-store' ),
				'label_off' => __( 'Hide', 'coffee-store' ),
				'selector' => '.site-footer .copyright',
			]
		);

		$this->add_control(
			'coffee_footer_layout',
			[
				'type' => Controls_Manager::SELECT,
				'label' => __( 'Layout', 'coffee-store' ),
				'options' => [
					'default' => __( 'Default', 'coffee-store' ),
					'inverted' => __( 'Inverted', 'coffee-store' ),
					'stacked' => __( 'Centered', 'coffee-store' ),
				],
				'selector' => '.site-footer',
				'default' => 'default',
			]
		);

		$this->add_control(
			'coffee_footer_width',
			[
				'type' => Controls_Manager::SELECT,
				'label' => __( 'Width', 'coffee-store' ),
				'options' => [
					'boxed' => __( 'Boxed', 'coffee-store' ),
					'full-width' => __( 'Full Width', 'coffee-store' ),
				],
				'selector' => '.site-footer',
				'default' => 'boxed',
			]
		);

		$this->add_responsive_control(
			'coffee_footer_custom_width',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => __( 'Content Width', 'coffee-store' ),
				'size_units' => [
					'%',
					'px',
				],
				'range' => [
					'px' => [
						'max' => 2000,
						'step' => 1,
					],
					'%' => [
						'max' => 100,
						'step' => 1,
					],
				],
				'condition' => [
					'coffee_footer_width' => 'boxed',
				],
				'selectors' => [
					'.site-footer .footer-inner' => 'width: {{SIZE}}{{UNIT}}; max-width: 100%;',
				],
			]
		);

		$this->add_responsive_control(
			'coffee_footer_gap',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => __( 'Gap', 'coffee-store' ),
				'size_units' => [
					'%',
					'px',
				],
				'range' => [
					'px' => [
						'max' => 2000,
						'step' => 1,
					],
					'%' => [
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'.site-footer' => 'padding-right: {{SIZE}}{{UNIT}}; padding-left: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'coffee_footer_layout!' => 'stacked',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'coffee_footer_background',
				'label' => __( 'Background', 'coffee-store' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '.site-footer',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'coffee_footer_logo_section',
			[
				'tab' => 'coffee-settings-footer',
				'label' => __( 'Site Logo', 'coffee-store' ),
				'condition' => [
					'coffee_footer_logo_display!' => '',
				],
			]
		);

		$this->add_control(
			'coffee_footer_logo_type',
			[
				'label' => __( 'Type', 'coffee-store' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'logo',
				'options' => [
					'logo' => __( 'Logo', 'coffee-store' ),
					'title' => __( 'Title', 'coffee-store' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'coffee_footer_logo_width',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => __( 'Logo Width', 'coffee-store' ),
				'description' => sprintf( __( 'Go to <a href="%s">Site Identity</a> to manage your site\'s logo', 'coffee-store' ), wp_nonce_url( 'customize.php?autofocus[section]=title_tagline' ) ),
				'size_units' => [
					'%',
					'px',
					'vh',
				],
				'range' => [
					'px' => [
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'max' => 100,
						'step' => 1,
					],
				],
				'condition' => [
					'coffee_footer_logo_display' => 'yes',
					'coffee_footer_logo_type' => 'logo',
				],
				'selectors' => [
					'.site-footer .site-branding .site-logo img' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'coffee_footer_title_color',
			[
				'label' => __( 'Text Color', 'coffee-store' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'coffee_footer_logo_display' => 'yes',
					'coffee_footer_logo_type' => 'title',
				],
				'selectors' => [
					'.site-footer h4.site-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'coffee_footer_title_typography',
				'label' => __( 'Typography', 'coffee-store' ),
				'condition' => [
					'coffee_footer_logo_display' => 'yes',
					'coffee_footer_logo_type' => 'title',
				],
				'selector' => '.site-footer h4.site-title',

			]
		);

		$this->add_control(
			'coffee_footer_title_link',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => sprintf( __( 'Go to <a href="%s">Site Identity</a> to manage your site\'s title and tagline', 'coffee-store' ), wp_nonce_url( 'customize.php?autofocus[section]=title_tagline' ) ),
				'content_classes' => 'elementor-control-field-description',
				'condition' => [
					'coffee_footer_logo_display' => 'yes',
					'coffee_footer_logo_type' => 'title',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'coffee_footer_tagline',
			[
				'tab' => 'coffee-settings-footer',
				'label' => __( 'Tagline', 'coffee-store' ),
				'condition' => [
					'coffee_footer_tagline_display' => 'yes',
				],
			]
		);

		$this->add_control(
			'coffee_footer_tagline_color',
			[
				'label' => __( 'Text Color', 'coffee-store' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'coffee_footer_tagline_display' => 'yes',
				],
				'selectors' => [
					'.site-footer .site-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'coffee_footer_tagline_typography',
				'label' => __( 'Typography', 'coffee-store' ),
				'condition' => [
					'coffee_footer_tagline_display' => 'yes',
				],
				'selector' => '.site-footer .site-description',
			]
		);

		$this->add_control(
			'coffee_footer_tagline_link',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => sprintf( __( 'Go to <a href="%s">Site Identity</a> to manage your site\'s title and tagline', 'coffee-store' ), wp_nonce_url( 'customize.php?autofocus[section]=title_tagline' ) ),
				'content_classes' => 'elementor-control-field-description',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'coffee_footer_menu_tab',
			[
				'tab' => 'coffee-settings-footer',
				'label' => __( 'Menu', 'coffee-store' ),
				'condition' => [
					'coffee_footer_menu_display' => 'yes',
				],
			]
		);

		$available_menus = wp_get_nav_menus();

		$menus = [ '0' => __( '— Select a Menu —', 'coffee-store' ) ];
		foreach ( $available_menus as $available_menu ) {
			$menus[ $available_menu->term_id ] = $available_menu->name;
		}

		if ( 1 === count( $menus ) ) {
			$this->add_control(
				'coffee_footer_menu_notice',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => '<strong>' . __( 'There are no menus in your site.', 'coffee-store' ) . '</strong><br>' . sprintf( __( 'Go to <a href="%s" target="_blank">Menus screen</a> to create one.', 'coffee-store' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
					'separator' => 'after',
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				]
			);
		} else {
			$this->add_control(
				'coffee_footer_menu',
				[
					'label' => __( 'Menu', 'coffee-store' ),
					'type' => Controls_Manager::SELECT,
					'options' => $menus,
					'default' => array_keys( $menus )[0],
					'description' => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'coffee-store' ), admin_url( 'nav-menus.php' ) ),
				]
			);

			$this->add_control(
				'coffee_footer_menu_warning',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => __( 'Changes will be reflected in the preview only after the page reloads.', 'coffee-store' ),
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				]
			);

			$this->add_control(
				'coffee_footer_menu_color',
				[
					'label' => __( 'Color', 'coffee-store' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'footer .footer-inner .site-navigation a' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'coffee_footer_menu_typography',
					'label' => __( 'Typography', 'coffee-store' ),
					'selector' => 'footer .footer-inner .site-navigation a',
				]
			);
		}

		$this->end_controls_section();

		$this->start_controls_section(
			'coffee_footer_copyright_section',
			[
				'tab' => 'coffee-settings-footer',
				'label' => __( 'Copyright', 'coffee-store' ),
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'coffee_footer_copyright_display',
							'operator' => '=',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$this->add_control(
			'coffee_footer_copyright_text',
			[
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'All rights reserved', 'coffee-store' ),
			]
		);

		$this->add_control(
			'coffee_footer_copyright_color',
			[
				'label' => __( 'Text Color', 'coffee-store' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'coffee_footer_copyright_display' => 'yes',
				],
				'selectors' => [
					'.site-footer .copyright p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'coffee_footer_copyright_typography',
				'label' => __( 'Typography', 'coffee-store' ),
				'condition' => [
					'coffee_footer_copyright_display' => 'yes',
				],
				'selector' => '.site-footer .copyright p',
			]
		);

		$this->end_controls_section();
	}

	public function on_save( $data ) {
		// Save chosen footer menu to the WP settings.
		if ( isset( $data['settings']['coffee_footer_menu'] ) ) {
			$menu_id = $data['settings']['coffee_footer_menu'];
			$locations = get_theme_mod( 'nav_menu_locations' );
			$locations['menu-2'] = (int) $menu_id;
			set_theme_mod( 'nav_menu_locations', $locations );
		}
	}

	public function get_additional_tab_content() {
		if ( ! defined( 'ELEMENTOR_PRO_VERSION' ) ) {
			return sprintf( '
				<div class="coffee-store elementor-nerd-box">
					<img src="%4$s" class="elementor-nerd-box-icon">
					<div class="elementor-nerd-box-message">
						<p class="elementor-panel-heading-title elementor-nerd-box-title">%1$s</p>
						<p>%2$s</p>
					</div>
					<a class="elementor-button elementor-button-default elementor-nerd-box-link" target="_blank" href="https://elementor.com/pro/?utm_source=panel-widgets&amp;utm_campaign=gopro&amp;utm_medium=wp-dash&amp;utm_term=helloelementor">%3$s</a>
				</div>
				',
				__( 'Create a custom footer with multiple options', 'coffee-store' ),
				__( 'Upgrade to Elementor Pro and enjoy free design and many more features', 'coffee-store' ),
				__( 'Go Pro', 'coffee-store' ),
				get_template_directory_uri() . '/assets/images/go-pro.svg'
			);
		} else {
			return sprintf( '
				<div class="coffee-store elementor-nerd-box">
					<img src="%4$s" class="elementor-nerd-box-icon">
					<div class="elementor-nerd-box-message">
						<p class="elementor-panel-heading-title elementor-nerd-box-title">%1$s</p>
						<p class="elementor-nerd-box-message">%2$s</p>
					</div>
					<a class="elementor-button elementor-button-success elementor-nerd-box-link" target="_blank" href="%5$s">%3$s</a>
				</div>
				',
				__( 'Create a custom footer with the new Theme Builder', 'coffee-store' ),
				__( 'With the new Theme Builder you can jump directly into each part of your site', 'coffee-store' ),
				__( 'Create Footer', 'coffee-store' ),
				get_template_directory_uri() . '/assets/images/go-pro.svg',
				get_admin_url( null, 'admin.php?page=elementor-app#/site-editor/templates/footer' )
			);
		}
	}
}

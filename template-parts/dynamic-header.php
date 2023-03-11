<?php
/**
 * The template for displaying header.
 *
 * @package CoffeeStore
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! coffee_get_header_display() ) {
	return;
}

$is_editor = isset( $_GET['elementor-preview'] );
$site_name = get_bloginfo( 'name' );
$tagline   = get_bloginfo( 'description', 'display' );
$header_nav_menu = wp_nav_menu( [
	'theme_location' => 'menu-1',
	'fallback_cb' => false,
	'echo' => false,
] );
?>
<header id="site-header" class="site-header dynamic-header <?php echo esc_attr( coffee_get_header_layout_class() ); ?>" role="banner">
	<div class="header-inner">
		<div class="site-branding show-<?php echo coffee_store_get_setting( 'coffee_header_logo_type' ); ?>">
			<?php if ( has_custom_logo() && ( 'title' !== coffee_store_get_setting( 'coffee_header_logo_type' ) || $is_editor ) ) : ?>
				<div class="site-logo <?php echo coffee_show_or_hide( 'coffee_header_logo_display' ); ?>">
					<?php the_custom_logo(); ?>
				</div>
			<?php endif;

			if ( $site_name && ( 'logo' !== coffee_store_get_setting( 'coffee_header_logo_type' ) || $is_editor ) ) : ?>
				<h1 class="site-title <?php echo coffee_show_or_hide( 'coffee_header_logo_display' ); ?>">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( 'Home', 'coffee-store' ); ?>" rel="home">
						<?php echo esc_html( $site_name ); ?>
					</a>
				</h1>
			<?php endif;

			if ( $tagline && ( coffee_store_get_setting( 'coffee_header_tagline_display' ) || $is_editor ) ) : ?>
				<p class="site-description <?php echo coffee_show_or_hide( 'coffee_header_tagline_display' ); ?> ">
					<?php echo esc_html( $tagline ); ?>
				</p>
			<?php endif; ?>
		</div>

		<?php if ( $header_nav_menu ) : ?>
			<nav class="site-navigation <?php echo coffee_show_or_hide( 'coffee_header_menu_display' ); ?>" role="navigation">
				<?php echo $header_nav_menu; ?>
			</nav>
			<div class="site-navigation-toggle-holder <?php echo coffee_show_or_hide( 'coffee_header_menu_display' ); ?>">
				<div class="site-navigation-toggle">
					<i class="eicon-menu-bar"></i>
					<span class="elementor-screen-only">Menu</span>
				</div>
			</div>
			<nav class="site-navigation-dropdown <?php echo coffee_show_or_hide( 'coffee_header_menu_display' ); ?>" role="navigation">
				<?php echo $header_nav_menu; ?>
			</nav>
		<?php endif; ?>
	</div>
</header>

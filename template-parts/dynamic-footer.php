<?php
/**
 * The template for displaying footer.
 *
 * @package CoffeeStore
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$is_editor = isset( $_GET['elementor-preview'] );
$site_name = get_bloginfo( 'name' );
$tagline   = get_bloginfo( 'description', 'display' );
$footer_class = did_action( 'elementor/loaded' ) ? esc_attr( coffee_get_footer_layout_class() ) : '';
$footer_nav_menu = wp_nav_menu( [
	'theme_location' => 'menu-2',
	'fallback_cb' => false,
	'echo' => false,
] );
?>
<footer id="site-footer" class="site-footer dynamic-footer <?php echo $footer_class; ?>" role="contentinfo">
	<div class="footer-inner">
		<div class="site-branding show-<?php echo coffee_store_get_setting( 'coffee_footer_logo_type' ); ?>">
			<?php if ( has_custom_logo() && ( 'title' !== coffee_store_get_setting( 'coffee_footer_logo_type' ) || $is_editor ) ) : ?>
				<div class="site-logo <?php echo coffee_show_or_hide( 'coffee_footer_logo_display' ); ?>">
					<?php the_custom_logo(); ?>
				</div>
			<?php endif;

			if ( $site_name && ( 'logo' !== coffee_store_get_setting( 'coffee_footer_logo_type' ) ) || $is_editor ) : ?>
				<h4 class="site-title <?php echo coffee_show_or_hide( 'coffee_footer_logo_display' ); ?>">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( 'Home', 'coffee-store' ); ?>" rel="home">
						<?php echo esc_html( $site_name ); ?>
					</a>
				</h4>
			<?php endif;

			if ( $tagline || $is_editor ) : ?>
				<p class="site-description <?php echo coffee_show_or_hide( 'coffee_footer_tagline_display' ); ?>">
					<?php echo esc_html( $tagline ); ?>
				</p>
			<?php endif; ?>
		</div>

		<?php if ( $footer_nav_menu ) : ?>
			<nav class="site-navigation <?php echo coffee_show_or_hide( 'coffee_footer_menu_display' ); ?>" role="navigation">
				<?php echo $footer_nav_menu; ?>
			</nav>
		<?php endif; ?>

		<?php if ( '' !== coffee_store_get_setting( 'coffee_footer_copyright_text' ) || $is_editor ) : ?>
			<div class="copyright <?php echo coffee_show_or_hide( 'coffee_footer_copyright_display' ); ?>">
				<p><?php echo coffee_store_get_setting( 'coffee_footer_copyright_text' ); ?></p>
			</div>
		<?php endif; ?>
	</div>
</footer>

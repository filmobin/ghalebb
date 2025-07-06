<?php
/**
 * Cross-sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cross-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( $cross_sells && dina_opt( 'show_cross_sells' ) ) : ?>

	<div class="cross-sells product-block">
		<?php
		$heading = apply_filters( 'woocommerce_product_cross_sells_products_heading', __( 'You may be interested in', 'dina-kala' ) );

		if ( $heading ) :
			?>
			<h2>
			<i class="fal fa-bags-shopping" aria-hidden="true"></i>
            <?php echo dina_opt( 'cross_sells_title' ); ?>	
			</h2>
		<?php endif; ?>

		<?php
        $carousel_options = '';
        $carousel_options .= dina_opt( 'mobile_single_col' ) ? ' data-mcol="1"' : ' data-mcol="2"'; 
        $carousel_options .= dina_opt( 'show_arrows' ) ? ' data-itemnavs="true"' : ' data-itemnavs="false"'; 
        $carousel_options .= dina_opt( 'prod_loop' ) ? ' data-itemloop="true"' : ' data-itemloop="false"'; 
        $carousel_options .= dina_opt( 'auto_play' ) ? ' data-itemplay="true"' : ' data-itemplay="false"'; 
        //$carousel_options .= 'yes' === $settings['pause_over' ) ? ' data-itemover="true"' : ' data-itemover="false"'; 
        $carousel_options .= ! empty ( dina_opt( 'pcount' ) ) ? ' data-itemscount="'. dina_opt( 'pcount' ) .'"' : ' data-itemscount="5"';
        //$carousel_options .= ! empty ( $settings['slide_by' ) ) ? ' data-item-slideby="'. $settings['slide_by' ) .'"' : ' data-item-slideby="1"';
        $carousel_options .= ' data-dir="'. dina_rtl() .'"';
    	?>

		<div class="owl-carousel" <?php echo $carousel_options; ?>>

		<?php //woocommerce_product_loop_start(); ?>

			<?php foreach ( $cross_sells as $cross_sell ) : ?>

				<?php
					$post_object = get_post( $cross_sell->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

					//wc_get_template_part( 'content', 'product' );
				?>

				<?php 
                    global $product;
                    $in_stock = $product->is_in_stock();
                ?>

				<div class="item">
					<?php get_template_part( 'includes/content-product' ); ?>
				</div>

			<?php endforeach; ?>

		<?php //woocommerce_product_loop_end(); ?>
		</div>

	</div>
	<?php
endif;

wp_reset_postdata();

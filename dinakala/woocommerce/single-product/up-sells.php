<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     9.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

if ( $upsells && dina_opt( 'show_up_sells' ) ) : ?>

<div class="product-block<?php if ( dina_opt( 'prod_navs' ) == 'sttwo' ) { ?> nav-type-two<?php } ?> related dina-related-product block">
    <div class="block-title">
        <span class="block-title-con">
            <i class="fal fa-bags-shopping" aria-hidden="true"></i>
            <?php echo dina_opt( 'up_sells_title' ); ?>
        </span>
    </div>
    
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

			<?php foreach ( $upsells as $upsell ) : ?>

				<?php
				$post_object = get_post( $upsell->get_id() );
				setup_postdata( $GLOBALS['post'] = $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found
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
<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 9.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Check if the product is a valid WooCommerce product and ensure its visibility before proceeding.
if ( ! is_a( $product, WC_Product::class ) || ! $product->is_visible() ) {
	return;
}
?>

<?php 
	if ( dina_opt( 'product_col' ) == 2) {
		$pclasses = 'col-6';
	}
	elseif ( dina_opt( 'product_col' ) == 3) {
		$pclasses = 'col-md-4 col-6';
	}
	elseif ( dina_opt( 'product_col' ) == 4) {
		$pclasses = 'col-md-3 col-6';
	}
	elseif ( dina_opt( 'product_col' ) == 5) {
		$pclasses = 'col-p-5 col-md-3 col-6';
	}
	if ( dina_opt( 'mobile_single_col' ) ) {
		$pclasses .= ' mobile-single-col';
	}
?>


<li class="<?php echo $pclasses; ?> mini-product-con type-product">

<?php get_template_part( 'includes/content-product' ); ?>

</li>
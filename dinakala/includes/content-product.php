<?php
/*
Theme Designed By: Meysam Hosseinkhani
Email: Meysam98@Gmail.com
Author Website: i-design.ir
*/
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
    exit;

global $product;
?>

<div <?php dina_mini_product_classes(); ?>>

	<?php do_action( 'dina_before_shop_loop_item' ); ?>

		<?php pr_img() ?>

		<div class="dina-product-detail">

			<?php do_action( 'dina_before_shop_loop_item_title' ); ?>

			<?php if ( is_archive() ) { ?>
				<<?php echo dina_opt( 'product_title_tag_archive' ); ?> class="product-title">
			<?php } else { ?>
				<<?php echo dina_opt( 'product_title_tag_home' ); ?> class="product-title">
			<?php } ?>
			
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="product-link" target="<?php echo dina_link_target(); ?>">
					<?php the_title(); ?>
				</a>
			
			<?php if ( is_archive() ) { ?>
				</<?php echo dina_opt( 'product_title_tag_archive' ); ?>>
			<?php } else { ?>
				</<?php echo dina_opt( 'product_title_tag_home' ); ?>>
			<?php } ?>

			<?php
			do_action( 'dina_after_shop_loop_item_title' ); ?>
			
		</div>

	<?php

	do_action( 'dina_after_shop_loop_item' );

	if ( dina_opt( 'enable_woo_hook' ) ) {
		do_action( 'woocommerce_after_shop_loop_item' );
	}
	
	?>
</div>
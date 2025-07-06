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
<tr class="dina-product-table-item <?php echo dina_price_status( $product->get_id() ) ?>">

    <?php if ( $args['show_thumb'] ) { ?>
    <td class="dina-align-center">
        <a href="<?php the_permalink(); ?>" target="<?php echo dina_link_target(); ?>" title="<?php the_title_attribute(); ?>">
        <?php 
            if ( has_post_thumbnail() ) {
                the_post_thumbnail( 'thumbnail' );          
            } else {
                prod_default_thumb();
            }
        ?>
        </a>
    </td>
    <?php } ?>

    <?php if ( $args['show_sku'] ) { ?>
    <td class="dina-product-table-sku dina-align-center">
        <?php echo $product->get_sku() ?>
    </td>
    <?php } ?>

    <?php if ( $args['show_title'] ) { ?>
    <td>
        <div class="dina-product-table-title">
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" target="<?php echo dina_link_target(); ?>">
                <?php the_title(); ?>
            </a>
        </div>
    </td>
    <?php } ?>

    <?php if ( $args['show_price'] && ! dina_opt( 'product_catalog_price_mode' ) ) { ?>
    <td class="dina-align-center">
        <div class="dina-product-table-price">
            <?php
            if ( $product->is_in_stock() ) {
                woocommerce_template_single_price();
            } else { ?>
                <span class="nstock">
                    <?php echo dina_outofstock_text(); ?>
                </span>
            <?php } ?>
        </div>
    </td>
    <?php } ?>

    <?php if ( $args['show_desc'] ) { ?>
    <td>
        <div class="dina-product-table-desc">
            <?php echo strip_tags( get_the_excerpt() ); ?>
        </div>
    </td>
    <?php } ?>

    <?php if ( $args['show_attr'] && ! empty( $args['product_attrs'] ) ) {
        foreach ( $args['product_attrs'] as $product_attr ) { ?>
    <td class="dina-align-center">
        <?php echo $product->get_attribute( 'pa_' . $product_attr ) ?>
    </td>
    <?php } } ?>

    <?php if ( $args['show_rating'] ) { ?>
    <td class="dina-align-center">
        <div class="dina-product-table-rating">
            <?php dina_product_rating() ?>
        </div>
    </td>
    <?php } ?>

    <?php if ( $args['show_quick_view'] ) {
        add_action( 'wp_footer', 'dina_quick_view_modal' ); ?>
    <td class="dina-align-center">
        <div class="dina-product-table-quick-view">
            <span class="btn btn-outline-info dina-ptqv-btn quick-view-btn" data-toggle="tooltip" data-placement="top" title="<?php _e( 'Quick View', 'dina-kala' ); ?>" data-dina-product-id="<?php echo $product->get_id(); ?>">
                <i class="fal fa-eye" aria-hidden="true"></i>
            </span>
        </div>
    </td>
    <?php } ?>

    <?php if ( $args['show_add_cart'] && ! dina_opt( 'product_catalog_mode' ) ) { ?>
    <td class="dina-align-center">
        <div class="dina-product-table-add-cart mini-product">
        <?php dina_add_to_cart( true ) ?>
        </div>
    </td>
    <?php } ?>

</tr>
<?php
/**
 * Search results are contained within a div.searchwp-live-search-results
 * which you can style accordingly as you would any other element on your site
 *
 * Some base styles are output in wp_footer that do nothing but position the
 * results container and apply a default transition, you can disable that by
 * adding the following to your theme's functions.php:
 *
 * add_filter( 'searchwp_live_search_base_styles', '__return_false' );
 *
 * There is a separate stylesheet that is also enqueued that applies the default
 * results theme (the visual styles) but you can disable that too by adding
 * the following to your theme's functions.php:
 *
 * wp_dequeue_style( 'searchwp-live-search' );
 *
 * You can use ~/searchwp-live-search/assets/styles/style.css as a guide to customize
 */
?>

<?php

if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post();
    global $post;
    if ( !is_object( $post) ) 
    return; ?>
		<?php $post_type = get_post_type(); ?>
		<div class="searchwp-live-search-result" role="option" id="" aria-selected="false">
			<p><a href="<?php echo esc_url( get_permalink() ); ?>">
                <span class="re-img">
                    <?php if ( has_post_thumbnail() ) :
                        the_post_thumbnail( 'thumbnail' );
                    else: 
                        prod_default_thumb();
                    endif; ?>
                </span>
                <span class="re-desc">
                    <span class="re-title"><?php the_title(); ?></span>
                    <?php if ( $post_type == 'product' ) {
                        global $product;
                        do_action( 'dina_before_ajax_search_cat' ); ?>
                        <span class="re-subtitle">
                            <?php
                                $primary_cat_id = class_exists( 'WPSEO_Options' ) ? get_post_meta( get_the_id(), '_yoast_wpseo_primary_product_cat', true ) : get_post_meta( get_the_id(), 'rank_math_primary_product_cat', true );
                                if ( $primary_cat_id ) {
                                    $category      = get_term( $primary_cat_id, 'product_cat' );
                                    $category_name = $category->name;
                                } else {
                                    $i = 0;
                                    foreach( ( wp_get_object_terms( get_the_id(), 'product_cat' ) ) as $category ) {
                                        if ( $i != 0 )
                                            break;
                                        $category_name = $category->name;
                                        $i++;
                                    }
                                }

                                if ( isset( $category_name ) ) 
                                    echo __( 'Category: ', 'dina-kala' ) . $category_name;
                            ?>
                        </span>
                        <?php
                        do_action( 'dina_before_ajax_search_price' );
                        $in_stock = $product->is_in_stock(); ?>
                        <?php if ( $in_stock ) { ?>
                            <span class="re-price">
                            <?php echo $product->get_price_html(); ?>
                            </span>
                        <?php } else { ?>
                            <span class="re-nstock">
                                <?php echo dina_outofstock_text(); ?>
                            </span>
                        <?php } ?>
                    <?php } ?>
                </span>
			</a></p>
		</div>
    <?php endwhile; ?>

<button type="submit" class="search-result-more">
<?php _e( 'View All Result', 'dina-kala' ) ?>
<i class="fal fa-chevron-left" aria-hidden="true"></i>
</button>

<?php else : ?>
	<p class="searchwp-live-search-no-results" role="option">
        <?php if ( dina_opt( 'search_others' ) ) {
            _e( 'No result found!', 'dina-kala' );
        } else {
            _e( 'No product found!', 'dina-kala' );
        } ?>
	</p>
<?php endif; ?>
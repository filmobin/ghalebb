<?php
/*
Theme Designed By: Meysam Hosseinkhani
Email: Meysam98@Gmail.com
Author Website: i-design.ir
*/
   // Exit if accessed directly
   if ( ! defined( 'ABSPATH' ) )
    exit;
get_header();
?>

<div class="container">
<?php if ( dina_opt( 'show_bread' ) ) { dina_breadcrumb(); } 
if ( dina_opt( 'show_head_banner' ) ) { dina_header_banner(); } ?>
<article class="row bread-row">
    <div class="col-12 alert alert-warning alert-dismissible anot" role="alert">
        <strong><span class="fal fa-bell" aria-hidden="true">
            </span> <?php _e( 'Page Not Found! Use the search to find the product or article you want.', 'dina-kala' ) ?></strong>
    </div>

    <div class="col-12 alert alert-light">
       <h5 style="margin-bottom:0"><span class="fal fa-info-circle" aria-hidden="true"></span> <?php _e( 'You might like to see the following!', 'dina-kala' ) ?></h5 style="margin-bottom:0">
    </div>
    <div class="row not-row">

        <section class="col-md-4 col-12">
            <div class="shadow-box wid-content">
                <div class="wid-title">
                <h3><?php _e( 'Latest Products', 'dina-kala' ) ?></h3>
                </div>
                <ul class="latest-posts">
                    <?php

                    $args = array(
                        'posts_per_page' => 5,
                        'post_type'      => 'product',
                        'post_status'    => 'publish',
                        'order'          => 'DESC',
                        'tax_query'      => array(
                            'relation' => 'AND',
                            array(
                                'taxonomy' => 'product_visibility',
                                'field'    => 'name',
                                'terms'    => 'exclude-from-catalog',
                                'operator' => 'NOT IN',
                            ),
                        )
                    );

                    $posts = get_posts( $args );

                    foreach( $posts as $post ) {
                        setup_postdata( $post );
                        global $product;
                        ?>
                            <li>
                                <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" target="<?php echo dina_link_target(); ?>">
                                    <span class="post-image">
                                    <?php if ( has_post_thumbnail() ) :
                                        the_post_thumbnail( 'thumbnail' );
                                    else: 
                                        prod_default_thumb();
                                    endif; ?>
                                    </span>
                                    <span class="w-post-title">
                                        <?php the_title();?>
                                    </span>
                                    <?php
                                    $in_stock = $product->is_in_stock();
                                    if ( $in_stock ) {
                                    ?>
                                        <span class="w-prod-desc">
                                            <?php echo $product->get_price_html(); ?>
                                        </span>
                                    <?php } else { ?>
                                        <span class="w-prod-desc nstock">
                                            <?php echo dina_outofstock_text(); ?>
                                        </span>
                                    <?php } ?>
                                </a>
                            </li>
                        <?php
                    } ?>
                </ul>
            </div>
        </section>

        <section class="col-md-4 col-12">
            <div class="shadow-box wid-content">
                <div class="wid-title">
                <h3><?php _e( 'Random Products', 'dina-kala' ) ?></h3>
                </div>
                <ul class="latest-posts">
                    <?php

                    $args = array(
                        'posts_per_page' => 5,
                        'post_type'      => 'product',
                        'post_status'    => 'publish',
                        'orderby'        => 'rand',
                        'tax_query'      => array(
                            'relation' => 'AND',
                            array(
                                'taxonomy' => 'product_visibility',
                                'field'    => 'name',
                                'terms'    => 'exclude-from-catalog',
                                'operator' => 'NOT IN',
                            ),
                        )
                    );

                    $posts = get_posts( $args );

                    foreach( $posts as $post ) {
                        setup_postdata( $post );
                        global $product;
                        ?>
                            <li>
                                <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" target="<?php echo dina_link_target(); ?>">
                                    <span class="post-image">
                                    <?php if ( has_post_thumbnail() ) :
                                        the_post_thumbnail( 'thumbnail' );
                                    else: 
                                        prod_default_thumb();
                                    endif; ?>
                                    </span>
                                    <span class="w-post-title">
                                        <?php the_title();?>
                                    </span>
                                    <?php
                                    $in_stock = $product->is_in_stock();
                                    if ( $in_stock ) {
                                    ?>
                                        <span class="w-prod-desc">
                                            <?php echo $product->get_price_html(); ?>
                                        </span>
                                    <?php } else { ?>
                                        <span class="w-prod-desc nstock">
                                            <?php echo dina_outofstock_text(); ?>
                                        </span>
                                    <?php } ?>
                                </a>
                            </li>
                        <?php
                    } ?>
                </ul>
            </div>
        </section>

        <section class="col-md-4 col-12">
            <div class="shadow-box wid-content">
                <div class="wid-title">
                <h3><?php _e( 'Latest Posts', 'dina-kala' ) ?></h3>
                </div>
                <ul class="latest-posts">
                    <?php
                $posts = get_posts( 'orderby=date&numberposts=5' );
                
                foreach( $posts as $post )
                    { ?>
                    <li>
                        <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                        <span href="#" class="post-image">
                            <?php if ( has_post_thumbnail() ) :
                                the_post_thumbnail( 'thumbnail' );
                            else: 
                                prod_default_thumb();
                            endif; ?>
                        </span>
                        <span class="w-post-title">
                            <?php the_title();?>
                        </span>
                        <span class="w-post-desc">
                                <?php echo get_jdate_publish_time(); ?>
                            </span>
                        </a>
                    </li>
                    <?php
                } ?>
                </ul>
            </div>
        </section>
        
</div>
</article>
</div>

<?php
get_footer(); ?>
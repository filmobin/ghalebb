<?php

//Dina post bottom banner
function dina_post_top_banner() {
    if ( ! dina_opt( 'show_post_top_banner' ) || empty( dina_to_https( dina_opt( 'post_top_banner', 'url' ) ) ) )
        return;
    ?>
    <div class="post-top-banner-row<?php if ( ! dina_opt( 'show_post_top_mobile' ) ) { echo ' mobile-hidden'; } ?>">
        <div class="col-12 bnr-image shadow-box">
            <?php
            $link_target = dina_opt( 'post_top_banner_newtab' ) ? ' target="_blank"' : '';
            $link_rel = dina_opt( 'post_top_banner_nofollow' ) ? ' rel="nofollow"' : '';
            ?>
            <a href="<?php echo dina_opt( 'post_top_banner_link' ); ?>" title="<?php echo dina_opt( 'post_top_banner_title' ); ?>" aria-label="<?php echo dina_opt( 'post_top_banner_title' ); ?>"<?php echo $link_target . $link_rel; ?>>
                <?php
                    $headb_width = ( ! empty( dina_opt( 'post_top_banner', 'width' ) ) ) ? dina_opt( 'post_top_banner', 'width' ) : '1260';
                    $headb_height = ( ! empty( dina_opt( 'post_top_banner', 'height' ) ) ) ? dina_opt( 'post_top_banner', 'height' ) : '142'; 
                ?>
                <img src="<?php echo dina_to_https( dina_opt( 'post_top_banner', 'url' ) ); ?>" alt="<?php echo dina_opt( 'post_top_banner_title' ); ?>" class="head-banner shadow-box" width="<?php echo $headb_width; ?>" height="<?php echo $headb_height; ?>" />
            </a>
        </div>
    </div>
<?php
}

//Dina post bottom banner
function dina_post_bottom_banner() {
    if ( ! dina_opt( 'show_post_bottom_banner' ) || empty( dina_to_https( dina_opt( 'post_bottom_banner', 'url' ) ) ) )
        return;
    ?>
    <div class="post-bottom-banner-row<?php if ( !dina_opt( 'show_post_bottom_mobile' ) ) { echo ' mobile-hidden'; }?>">
        <div class="col-12 bnr-image shadow-box">
            <?php
            $link_target = dina_opt( 'post_bottom_banner_newtab' ) ? ' target="_blank"' : '';
            $link_rel = dina_opt( 'post_bottom_banner_nofollow' ) ? ' rel="nofollow"' : '';
            ?>
            <a href="<?php echo dina_opt( 'post_bottom_banner_link' ); ?>" title="<?php echo dina_opt( 'post_bottom_banner_title' ); ?>" aria-label="<?php echo dina_opt( 'post_bottom_banner_title' ); ?>"<?php echo $link_target . $link_rel; ?>>
                <?php
                    $headb_width = ( ! empty( dina_opt( 'post_bottom_banner', 'width' ) ) ) ? dina_opt( 'post_bottom_banner', 'width' ) : '1260';
                    $headb_height = ( ! empty( dina_opt( 'post_bottom_banner', 'height' ) ) ) ? dina_opt( 'post_bottom_banner', 'height' ) : '142'; 
                ?>
                <img src="<?php echo dina_to_https( dina_opt( 'post_bottom_banner', 'url' ) ); ?>" alt="<?php echo dina_opt( 'post_bottom_banner_title' ); ?>" class="head-banner shadow-box" width="<?php echo $headb_width; ?>" height="<?php echo $headb_height; ?>" />
            </a>
        </div>
    </div>
<?php
}

//Dina Post Author Block
function dina_post_author() {
    if ( ! dina_opt( 'show_author_block' ) )
        return;

    $author = get_post_field( 'post_author', get_the_ID() );
    ?>
    <div class="shadow-box author-con">
        <div class="row">
            <div class="col-md-2 col-12 uavatar">
                <a class="author-link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
                    <?php echo get_avatar( $author , 128, '', get_the_author_meta( 'display_name', $author ) ); ?>
                </a>
            </div>
            <div class="col-md-10 col-12">
                <div class="author-name">
                    <a class="author-link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
                        <?php echo get_the_author_meta( 'display_name', $author ); ?>
                    </a>
                </div>
                <div class="author-bio">
                    <?php echo get_the_author_meta( 'description', $author ); ?>
                </div>
            </div>
        </div>
    </div>
<?php
}

//Dina related posts
function dina_related_posts() {
    if ( ! dina_opt( 'show_related_post' ) )
        return;

        $related_taxterms = wp_get_object_terms( get_the_ID(), dina_opt( 'related_post_by' ), array( 'fields' => 'ids' ) );

        $args = array(
            'post_type'              => 'post',
            'post_status'            => 'publish',
            'posts_per_page'         => dina_opt( 'related_post_count' ),
            'orderby'                => 'rand',
            //'fields'               => 'ids',
            'no_found_rows'          => true,
            'update_post_term_cache' => false,
            'tax_query'              => array(
                array(
                    'taxonomy' => dina_opt( 'related_post_by' ),
                    'field'    => 'id',
                    'terms'    => $related_taxterms
                )
            ),
            'post__not_in' => array ( get_the_ID() ),
        );

        $related_items = new WP_Query( $args ); 
        
        if ( $related_items->have_posts() ) {  ?>

            <div class="post-block<?php if ( dina_opt( 'prod_navs' ) == 'sttwo' ) { ?> nav-type-two<?php } ?> related block related-con">
                <div class="block-title">
                    <span class="block-title-con">
                        <i class="fal fa-file-invoice" aria-hidden="true"></i>
                        <?php echo dina_opt( 'related_post_title' ); ?>
                    </span>
                </div>

                <?php
                    $carousel_options = '';
                    $carousel_options .= dina_opt( 'mobile_single_col' ) ? ' data-mcol="1"' : ' data-mcol="2"'; 
                    $carousel_options .= dina_opt( 'show_post_arrows' ) ? ' data-itemnavs="true"' : ' data-itemnavs="false"'; 
                    $carousel_options .= dina_opt( 'post_loop' ) ? ' data-itemloop="true"' : ' data-itemloop="false"'; 
                    $carousel_options .= dina_opt( 'auto_post_play' ) ? ' data-itemplay="true"' : ' data-itemplay="false"'; 
                    $carousel_options .= ! empty ( dina_opt( 'postcount' ) ) ? ' data-itemscount="'. dina_opt( 'postcount' ) .'"' : ' data-itemscount="5"';
                    $carousel_options .= ' data-dir="'. dina_rtl() .'"';
                ?>

                <div class="owl-carousel" <?php echo $carousel_options; ?>>
                    <?php while ( $related_items->have_posts() ) : $related_items->the_post(); ?>
                        <div class="item">
                            <?php get_template_part( 'includes/content-post' ); ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
    <?php
        }
    wp_reset_postdata();
}

//Dina related post products
function dina_related_post_products() {

    if ( ! class_exists( 'WooCommerce' ) || ! dina_opt( 'show_related_post_products' ) )
        return;

    global $post;

    $related_taxterms = wp_get_object_terms( get_the_ID(), 'post_tag', array( 'fields' => 'names' ) );

    $args = array(
        'post_type'              => 'product',
        'post_status'            => 'publish',
        'posts_per_page'         => dina_opt( 'related_post_products_count' ),
        'orderby'                => 'rand',
        'update_post_term_cache' => false,
        'tax_query'              => array(
            array(
                'taxonomy' => 'product_tag',
                'field'    => 'name',
                'terms'    => $related_taxterms
            )
        ),
        'post__not_in' => array ( get_the_ID() ),
    );

    $related_items = new WP_Query( $args ); ?>

    <?php if ( $related_items->have_posts() ) { ?>
        <div class="product-block<?php if ( dina_opt( 'prod_navs' ) == 'sttwo' ) { ?> nav-type-two<?php } ?> related block dina-related-post-products">
            <div class="block-title">
                <span class="block-title-con">
                    <i class="fal fa-shopping-bag" aria-hidden="true"></i>
                    <?php echo dina_opt( 'related_p_title' ); ?>
                </span>
            </div>

            <?php
                $carousel_options = '';
                $carousel_options .= dina_opt( 'mobile_single_col' ) ? ' data-mcol="1"' : ' data-mcol="2"'; 
                $carousel_options .= dina_opt( 'show_arrows' ) ? ' data-itemnavs="true"' : ' data-itemnavs="false"'; 
                $carousel_options .= dina_opt( 'prod_loop' ) ? ' data-itemloop="true"' : ' data-itemloop="false"'; 
                $carousel_options .= dina_opt( 'auto_play' ) ? ' data-itemplay="true"' : ' data-itemplay="false"'; 
                //$carousel_options .= 'yes' === $settings['pause_over'] ? ' data-itemover="true"' : ' data-itemover="false"'; 
                $carousel_options .= ! empty ( dina_opt( 'pcount' ) ) ? ' data-itemscount="'. dina_opt( 'pcount' ) .'"' : ' data-itemscount="5"';
                //$carousel_options .= ! empty ( $settings['slide_by'] ) ? ' data-item-slideby="'. $settings['slide_by'] .'"' : ' data-item-slideby="1"';
                $carousel_options .= ' data-dir="'. dina_rtl() .'"';
            ?>

            <div class="owl-carousel" <?php echo $carousel_options; ?>>
            <?php
                while ( $related_items->have_posts() ) : $related_items->the_post(); ?>
                <div class="item">
                    <?php get_template_part( 'includes/content-product' ); ?>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    <?php }
    wp_reset_postdata();
}
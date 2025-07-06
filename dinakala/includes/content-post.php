<?php
/*
Theme Designed By: Meysam Hosseinkhani
Email: Meysam98@Gmail.com
Author Website: i-design.ir
*/
// Exit if accessed directly

if ( ! defined( 'ABSPATH' ) )
    exit;
?>

<div class="shadow-box <?php echo dina_opt( 'prod_hover' ) ?> mini-post">

    <?php po_img( get_the_ID() ) ?>

    <?php if ( is_archive() ) { ?>
        <<?php echo dina_opt( 'product_title_tag_archive' ); ?> class="post-title">
    <?php } else { ?>
        <<?php echo dina_opt( 'product_title_tag_home' ); ?> class="post-title">
    <?php } ?>

        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="post-link" target="<?php echo dina_link_target(); ?>">
            <?php the_title(); ?>
        </a>

    <?php if ( is_archive() ) { ?>
        </<?php echo dina_opt( 'product_title_tag_archive' ); ?>>
    <?php } else { ?>
        </<?php echo dina_opt( 'product_title_tag_home' ); ?>>
    <?php } ?>

    <?php if ( dina_opt( 'show_post_author' ) ) { ?>
        <span class="dina-post-author">

            <?php if ( dina_opt( 'link_post_author' ) ) { ?>
            <a class="author-link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" rel="author">
            <?php } ?>

            <?php 
                $author = get_post_field( 'post_author', get_the_ID() );
                echo get_avatar( $author , 20, '' , get_the_author_meta( 'display_name', $author ) ); 
                echo '<span class="dina-author-name">'. get_the_author_meta( 'display_name', $author ) .'</span>';
            ?>

            <?php if ( dina_opt( 'link_post_author' ) ) { ?>
            </a>
            <?php } ?>
        </span>
    <?php } ?>

    <?php if ( dina_opt( 'show_post_excerpt' ) ) { ?>
        <span class="post-exc">
            <?php echo strip_tags( get_the_excerpt() ); ?>
        </span>
    <?php } ?>

    <?php if ( dina_opt( 'show_hover_btns' ) && ! dina_opt( 'hide_read_more' ) ) { ?>
    <a href="<?php the_permalink(); ?>" class="btn btn-success btn-read-more btn-buy<?php if ( dina_opt( 'show_hover_btns_fixed' ) ) { echo ' btn-buy-fixed'; } if ( dina_opt( 'hover_btns_fixed_mobile' ) ) { echo ' btn-buy-fixed-mobile'; } ?>">
        <?php _e( 'Read More...', 'dina-kala' ); ?>
    </a>
    <?php } ?>
    
</div>
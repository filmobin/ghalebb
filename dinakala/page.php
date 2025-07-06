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

$pside = get_post_meta( get_the_ID(), 'dina_pageside', true );
$lock_page_content = get_post_meta( get_the_ID(), 'dina_lock_page_content', true );
$content_sticky = ( dina_opt( 'side_sticky' ) ? ' content-sticky' : '' );

if ( class_exists( 'WooCommerce' ) && ( is_cart() || is_checkout() ) ) {

    $row = '';
    $article = 'col-12';

} elseif ( $pside == '' ) {

    if ( dina_opt( 'page_side' ) == 0 ) {
        $row = '';
        $article = 'col-12';
    } elseif ( dina_opt( 'page_side' ) == 1 ) {
        $row = '';
        $article = 'col-lg-9 col-12 dina-full-tablet' . $content_sticky;
    } elseif ( dina_opt( 'page_side' ) == 2 ) {
        $row = ' right-side';
        $article = 'col-lg-9 col-12 dina-full-tablet' . $content_sticky;
    }

} elseif ( $pside == 'lside' ) {

    $row = '';
    $article = 'col-lg-9 col-12 dina-full-tablet' . $content_sticky;

} elseif ( $pside == 'rside' ) {

    $row = ' right-side';
    $article = 'col-lg-9 col-12 dina-full-tablet' . $content_sticky;

} elseif ( $pside == 'wside' ) {

    $row = '';
    $article = 'col-12';

}
?>

<div class="container main-con">

    <?php if ( dina_opt( 'show_bread' ) ) { dina_breadcrumb(); } ?>

    <div class="row page-row<?php echo $row; ?>">

        <?php if ( have_posts() ) : ?>

        <article role="main"  class="<?php echo $article; ?>">

            <?php while ( have_posts() ) : the_post(); ?>

            <?php do_action( 'dina_before_page' ); ?>

                <div class="shadow-box page-con" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <?php if ( ! dina_opt( 'hide_page_title' ) ) { ?>
                    <h1 class="ptitle">
                        <?php the_title(); ?>
                    </h1>
                    <?php } ?>

                    <div class="entry-content">

                        <?php
                        
                        if ( ! is_user_logged_in() && $lock_page_content ) {
                            dina_locked_content();
                        } else { 
                            
                            if ( has_post_thumbnail() && dina_opt( 'show_page_thumb' ) ) { ?>
                            <div class="post-img">
                                <?php the_post_thumbnail( 'larg' ); ?>
                            </div>
                        <?php
                            } 
                        
                        the_content(); ?>
                        
                        <?php
                        }
                        ?>

                    </div>

                    <?php
                    $defaults = array(
                        'before'           => '<div class="text-center apage-break">',
                        'after'            => '</div>',
                        'link_before'      => '',
                        'link_after'       => '',
                        'next_or_number'   => 'text',
                        'separator'        => ' ',
                        'nextpagelink'     => '<span class="btn btn-outline-info">'.__( 'Next Page ', 'dina-kala' ).'<i aria-hidden="true" class="fal fa-angle-left"></i></span>',
                        'previouspagelink' => '<span class="btn btn-outline-info"><i aria-hidden="true" class="fal fa-angle-right"></i>'.__( ' Prev Page', 'dina-kala' ).'</span>',
                        'pagelink'         => '%',
                        'echo'             => 1
                    );
                    wp_link_pages( $defaults); ?>
                </div>

            <?php do_action( 'dina_after_page' ); ?>

            <?php endwhile; ?>

            <?php
            if ( ! is_user_logged_in() && $lock_page_content ) {
                //do nothing
            } else {
            //Start Comments
            if ( comments_open() ) : ?>
                <div class="shadow-box comments-list">
                    <?php comments_template(); ?> 
                </div>
            <?php endif;
            //End Comments
            }
            ?>

        </article>

        <?php endif; 

        if ( class_exists( 'WooCommerce' ) && ( is_cart() || is_checkout() ) ) {
            //Do Nothing!
        } elseif ( $pside == '' && dina_opt( 'page_side' ) > 0 ) {
            get_sidebar();
        } elseif ( $pside != 'wside' && $pside != '' ) {
            get_sidebar();
        } ?>
        
    </div>

</div>

<?php get_footer();
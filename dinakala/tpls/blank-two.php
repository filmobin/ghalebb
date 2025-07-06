<?php
/*
Theme Designed By: Meysam Hosseinkhani
Email: Meysam98@Gmail.com
Author Website: i-design.ir
*/
/*
 * Template Name: Blank Page 2 (DinaKala)
 */
// Exit if accessed directly
__( 'Blank Page 2 (DinaKala)', 'dina-kala' );

if ( ! defined( 'ABSPATH' ) )
    exit;

get_header(); 
$pside = get_post_meta( get_the_ID(), 'dina_pageside', true );
$content_sticky = ( dina_opt( 'side_sticky' ) ? ' content-sticky' : '' );

if ( is_cart() || is_checkout() ) {
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

    <?php the_content(); ?>
    
<?php endwhile; ?>

</article>
<?php endif; 

if (is_cart() || is_checkout() ) {
    //Do Nothing!
} elseif ( $pside == '' && dina_opt( 'page_side' ) > 0 ) {
    get_sidebar();
} elseif ( $pside != 'wside' && $pside != '' ) {
    get_sidebar();
} ?>

</div>
</div>
<?php get_footer();
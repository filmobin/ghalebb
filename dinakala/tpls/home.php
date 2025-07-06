<?php
/*
Theme Designed By: Meysam Hosseinkhani
Email: Meysam98@Gmail.com
Author Website: i-design.ir
*/
/*
 * Template Name: Home Page (DinaKala)
 */
// Exit if accessed directly

__( 'Home Page (DinaKala)', 'dina-kala' );
__( 'DinaKala', 'dina-kala' );
__( 'Sell online in the simplest way possible!', 'dina-kala' );
__( 'Meysam Hosseinkhani', 'dina-kala' );
__( 'DinaKala', 'dina-kala' );

if ( ! defined( 'ABSPATH' ) )
    exit;

get_header();
?>

<?php if ( have_posts() ) :
    while ( have_posts() ) : the_post(); ?>

<main class="container-fluid blank-page main-con">
    <?php the_content(); ?>
</main>

<?php endwhile;
endif; ?>
             
       
<?php 
get_footer();
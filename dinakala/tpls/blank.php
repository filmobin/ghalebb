<?php
/*
Theme Designed By: Meysam Hosseinkhani
Email: Meysam98@Gmail.com
Author Website: i-design.ir
*/
/*
 * Template Name: Blank Page (DinaKala)
 */
// Exit if accessed directly
__( 'Blank Page (DinaKala)', 'dina-kala' );

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
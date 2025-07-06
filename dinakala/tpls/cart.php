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

<div class="container main-con">

    <?php do_action( 'dina_before_cart_check' ); ?>

    <div class="row page-row">
        <?php if ( have_posts() ) : ?>
            <article role="main"  class="col-12">
                <div class="shadow-box page-con" id="post-<?php the_ID(); ?>">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; ?>
                </div>
            </article>
        <?php 
        endif; 
        ?>
    </div>
</div>

<?php get_footer();
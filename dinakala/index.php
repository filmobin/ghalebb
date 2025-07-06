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

$sidebar = ( dina_opt( 'post_archive_side' ) == '2' ? ' right-side' : '' );

$classes = 'dina-post-archive-con';
$classes .= ( dina_opt( 'post_archive_side' ) != '0' ? ' col-12 col-lg-9 dina-full-tablet ' : ' col-12' );
$classes .= ( dina_opt( 'side_sticky' ) ? ' content-sticky' : '' );
$classes .= ( dina_opt( 'ajax_post' ) ? ' ajax-post' : '' );
$classes .= ( dina_opt( 'ajax_post' ) && dina_opt( 'ajax_post_auto' )  ? ' ajax-post-auto' : '' );
$ajax_post_auto = ( dina_opt( 'ajax_post' ) && dina_opt( 'ajax_post_auto' )  ? ' data-auto-ajax-load="100"' : ' data-auto-ajax-load="false"' );
$ajax_post_history = ( dina_opt( 'ajax_post' ) && dina_opt( 'ajax_post_history' )  ? ' data-ajax-post-history="push"' : ' data-ajax-post-history="false"' );

?>

<div id="primary" class="container content-area main-con">

    <main id="main" class="site-main">

        <?php if ( dina_opt( 'show_bread' ) ) { dina_breadcrumb(); } ?>

        <?php if ( dina_opt( 'show_head_banner' ) ) { dina_header_banner(); }  ?>

        <?php dina_archive_header_banner(); ?>

        <div class="row post-row<?php echo $sidebar; ?>">

            <div class="<?php echo $classes; ?>"<?php echo $ajax_post_auto . $ajax_post_history; ?>>

                <?php
                if ( dina_opt( 'show_parchive_title' ) ) {
                    if ( is_archive() || ( ! is_front_page() && is_home() ) ) {
                    ?>

                        <div class="row archive-title-con">
                            <div class="col-12 shadow-box">
                                <h1> 
                                    <?php echo is_archive() ? single_cat_title() : single_post_title(); ?> 
                                </h1>
                            </div>
                        </div>

                    <?php }
                }
                ?>

                <?php if ( have_posts() ) :
                
                    if ( dina_opt( 'show_on_top_cat' ) ) {
                        dina_archive_description();
                    }

                    if ( dina_opt( 'post_col' ) == 2) {
                        $pclasses = 'col-6';
                    } elseif ( dina_opt( 'post_col' ) == 3) {
                        $pclasses = 'col-md-4 col-6';
                    } elseif ( dina_opt( 'post_col' ) == 4) {
                        $pclasses = 'col-md-3 col-6';
                    } elseif ( dina_opt( 'post_col' ) == 5) {
                        $pclasses = 'col-p-5 col-md-3 col-6';
                    }
                    
                    if ( dina_opt( 'mobile_single_col' ) ) {
                        $pclasses .= ' mobile-single-col';
                    }
                ?>

                    <ul class="posts">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <li class="mini-post-con <?php echo $pclasses; ?>"> 
                                <?php get_template_part( 'includes/content-post' ); ?>
                            </li>
                        <?php endwhile; ?>
                    </ul>

                    <?php
                    if ( ! dina_opt( 'show_on_top_cat' ) ) {
                        dina_archive_description(); 
                    } ?>

                    <?php dina_pagination(); ?>

                    <?php if ( dina_opt( 'ajax_post' ) ) { ?>
                    <div class="col-12 load-more">
                        <div class="page-load-status">
                            <p class="infinite-scroll-request"><i class="fal fa-spinner-third fa-spin" aria-hidden="true"></i></p>		
                        </div>
                        <span id="load-more-button" class="load-more-button btn btn-outline-dina"><?php _e( 'Load More Posts', 'dina-kala' ) ?></span>
                    </div>
                    <?php } ?>

                <?php else : ?>
                    <div class="alert alert-warning" role="alert">
                        <strong><span class="fal fa-bell fa-lg" aria-hidden="true">
                        </span> <?php _e( 'No posts found!', 'dina-kala' ) ?></strong>
                    </div>
                <?php endif; ?>

            </div>

            <?php if ( dina_opt( 'post_archive_side' ) != '0' ) {
                get_sidebar();
            } ?>

        </div>

    </main>

</div>
<?php 
get_footer();
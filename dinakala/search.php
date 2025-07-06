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

$classes  = 'dina-post-archive-con col-lg-9 col-12 dina-full-tablet';
$classes .= ( dina_opt( 'side_sticky' ) ? ' content-sticky' : '' );
$classes .= ( dina_opt( 'ajax_post' ) ? ' ajax-post' : '' );
$classes .= ( dina_opt( 'ajax_post' ) && dina_opt( 'ajax_post_auto' )  ? ' ajax-post-auto' : '' );

$ajax_post_auto     = ( dina_opt( 'ajax_post' ) && dina_opt( 'ajax_post_auto' )  ? ' data-auto-ajax-load="100"' : ' data-auto-ajax-load="false"' );
$ajax_post_history  = ( dina_opt( 'ajax_post' ) && dina_opt( 'ajax_post_history' )  ? ' data-ajax-post-history="push"' : ' data-ajax-post-history="false"' );
?>

<div id="primary" class="container content-area main-con">
<main id="main" class="site-main">
<?php if ( dina_opt( 'show_bread' ) ) { dina_breadcrumb(); }
if ( dina_opt( 'show_head_banner' ) ) { dina_header_banner(); }  ?>
    <div class="row prod-row<?php echo $sidebar; ?>">
        <div class="<?php echo $classes; ?>"<?php echo $ajax_post_auto . $ajax_post_history; ?>>
       <?php 
	if ( dina_opt( 'post_col' ) == 2) {
		$pclasses = 'col-6';
	}
	elseif ( dina_opt( 'post_col' ) == 3) {
		$pclasses = 'col-md-4 col-6';
	}
	elseif ( dina_opt( 'post_col' ) == 4) {
		$pclasses = 'col-md-3 col-6';
    }
    elseif ( dina_opt( 'post_col' ) == 5) {
		$pclasses = 'col-p-5 col-md-3 col-6';
	}
    if ( dina_opt( 'mobile_single_col' ) ) {
        $pclasses .= ' mobile-single-col';
    }
?>

<?php if ( have_posts() ) : ?>

<ul class="posts">
<?php while ( have_posts() ) : the_post(); ?>

    <?php if (get_post_type() == 'product' ) { ?>
        <li class="<?php echo $pclasses; ?> mini-product-con type-product">

        <?php get_template_part( 'includes/content-product' ); ?>

        </li>
    <?php } elseif ( get_post_type() == 'post' ) { ?>

        <li class="mini-post-con <?php echo $pclasses; ?>"> 
            <?php get_template_part( 'includes/content-post' ); ?>
        </li>

    <?php } else { ?>

        <li class="mini-post-con <?php echo $pclasses; ?>"> 
            <div class="shadow-box <?php echo dina_opt( 'prod_hover' ); ?> mini-post">

                <?php po_img() ?>

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

                <?php if ( dina_opt( 'show_post_excerpt' ) ) { ?>
                    <span class="post-exc">
                        <?php echo strip_tags( get_the_excerpt() ); ?>
                    </span>
                <?php } ?>

                <?php if ( dina_opt( 'show_hover_btns' ) ) { ?>
                <a href="<?php the_permalink(); ?>" class="btn btn-success btn-read-more btn-buy<?php if ( dina_opt( 'show_hover_btns_fixed' ) ) { echo ' btn-buy-fixed'; } if ( dina_opt( 'hover_btns_fixed_mobile' ) ) { echo ' btn-buy-fixed-mobile'; } ?>">
                    <?php _e( 'Read More...', 'dina-kala' ); ?>
                </a>
                <?php } ?>

            </div>
        </li>

    <?php } ?>

<?php endwhile; ?>
</ul>

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
        <?php get_sidebar(); ?>
    </div>
</main>

</div>
<?php 
get_footer();
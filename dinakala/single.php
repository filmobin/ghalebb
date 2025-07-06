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

if ( dina_opt( 'show_next_prev_post' ) ) {
    require_once DI_DIR . '/includes/next-prev.php';
}

$pside = get_post_meta( get_the_ID(), 'dina_postside', true );
$lock_post_content = get_post_meta( get_the_ID(), 'dina_lock_post_content', true );
$hide_related_posts = get_post_meta( get_the_ID(), 'dina_hide_related_posts', true );
$content_sticky = ( dina_opt( 'side_sticky' ) ? ' content-sticky' : '' );

if ( $pside == '' ) {

    if ( dina_opt( 'post_side' ) == 0 ) {
        $row = '';
        $article = 'col-12';
    } elseif ( dina_opt( 'post_side' ) == 1 ) {
        $row = '';
        $article = 'col-lg-9 col-12 dina-full-tablet' . $content_sticky;
    } elseif ( dina_opt( 'post_side' ) == 2 ) {
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

<?php if ( dina_opt( 'show_bread' ) ) { dina_breadcrumb(); }

if ( dina_opt( 'show_head_banner' ) ) { dina_header_banner(); } ?>

<div class="row post-row<?php echo $row; ?>">
<?php if ( have_posts() ) : ?>
<article role="main" class="<?php echo $article; ?>" <?php if ( dina_opt( 'site_schema' ) ) {?>itemscope itemtype="https://schema.org/BlogPosting" <?php } ?>>

<?php

if ( ! $hide_related_posts  ) {
    //Dina related posts
    if ( dina_opt( 'show_related_post_top' ) )
        dina_related_posts();

    //Dina related post products
    if ( dina_opt( 'show_related_post_products_top' ) )
        dina_related_post_products();
}

while ( have_posts() ) : the_post(); ?>

    <?php if ( dina_opt( 'site_schema' ) ) { ?>
        <link itemprop="mainEntityOfPage" href="<?php the_permalink(); ?>" />
        <meta itemprop="image" content="<?php the_post_thumbnail_url(); ?>">
        <span itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
            <span itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
                <meta itemprop="url" content="<?php echo dina_to_https( dina_opt( 'site_logo', 'url' ) ); ?>">
                <meta itemprop="width" content="140">
                <meta itemprop="height" content="60">
            </span>
            <meta itemprop="name" content="<?php bloginfo( 'name' ); ?>">
        </span>
    <?php } ?>

    <?php 
    //Dina post top banner
    dina_post_top_banner();

    do_action( 'dina_before_post' );

    ?>

    <div <?php post_class( 'shadow-box post-con' ); ?> id="post-<?php the_ID(); ?>">
    
        <?php if ( ! dina_opt( 'hide_post_title' ) ) { ?>
            <h1 class="ptitle" <?php if ( dina_opt( 'site_schema' ) ) { ?>itemprop="headline"<?php } ?>>
                <?php the_title(); ?>
            </h1>
        <?php } ?>

        <?php
                        
            if ( ! is_user_logged_in() && $lock_post_content ) {
                dina_locked_content();
            } else {

        ?>

        <div class="row post-det">

            <?php if ( dina_opt( 'show_post_aut' ) ) { ?>
            <div class="dina-post-details post-aut">
                <a class="author-link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" rel="author">
                    <?php 
                        $author = get_post_field( 'post_author', get_the_ID() );
                        echo get_avatar( $author , 32, '' , get_the_author_meta( 'display_name', $author ) ); 
                        _e( 'Author: ', 'dina-kala' );
                        echo get_the_author_meta( 'display_name', $author );
                    ?>
                </a>
                <?php
                if ( dina_opt( 'site_schema' ) ) {
                    echo '<meta itemprop="editor" content="'. get_the_author_meta( 'display_name', $author ) .'">'; 
                }
                ?>
            </div>
            <?php } ?>

            <?php if ( dina_opt( 'show_post_pubdate' ) ) { ?>
                <div class="dina-post-details post-date">
                    <i class="fal fa-calendar-alt" aria-hidden="true"></i>
                    <?php _e( 'Publication date: ', 'dina-kala' ); ?>
                    <?php if ( dina_opt( 'site_schema' ) ) { ?>
                        <time datetime="<?php echo get_the_date( 'Y-m-d' );?>" itemprop="datePublished">
                    <?php } ?>
                    <?php echo get_jdate_publish_time(); ?>
                    <?php
                        if ( dina_opt( 'show_post_up' ) ) {
                            $modi_date = dina_get_modified_date();
                            printf( esc_html__( '(Update on: %s)', 'dina-kala' ), $modi_date );
                        }
                    ?>
                    <?php if ( dina_opt( 'site_schema' ) ) { ?>
                        </time>
                    <?php } ?>
                    <?php if ( dina_opt( 'site_schema' ) ) { ?>
                        <meta content="<?php echo get_the_date( 'Y-m-d' );?>" itemprop="dateModified">
                    <?php } ?>
                </div>
            <?php } ?>

            <?php setPostViews( get_the_ID() );
            if ( dina_opt( 'show_post_view' ) ) {
                $dina_post_view = getPostViews( get_the_ID() ); ?>
                <div class="dina-post-details post-views">
                    <i class="fal fa-eye" aria-hidden="true"></i>
                    <?php _e( 'Views: ', 'dina-kala' ); ?>
                    <span>
                        <?php echo $dina_post_view; ?> <?php _e( 'View', 'dina-kala' ) ?>
                    </span>
                </div>
            <?php } ?>

            <?php $di_reading_time = get_post_meta( get_the_ID(), 'dina_reading_time', true );
            if ( ! empty ( $di_reading_time ) ) { ?>
                <div class="dina-post-details dina-reading-time">
                    <i class="fal fa-clock" aria-hidden="true"></i>
                    <?php _e( 'Reading time: ', 'dina-kala' ); ?>
                    <span>
                        <?php echo $di_reading_time; ?>
                    </span>
                </div>
            <?php } ?>
            
        </div>

        <?php do_action( 'dina_before_post_content' ); ?>

        <div class="post-content entry-content<?php echo ! dina_opt( 'show_more_s_desktop' ) ? ' post-content-short-mobile' : ''; ?>" <?php if ( dina_opt( 'site_schema' ) ) { ?>itemprop="articleBody" <?php } ?>>

            <?php if ( dina_opt( 'site_schema' ) ) { echo '<meta itemprop="author" content="'.get_the_author_meta( 'display_name',$author ).'">'; } ?>
            
            <?php
            $dina_post_video_thumb = get_post_meta( get_the_ID(), 'dina_post_video_thumb', true );
            $dina_post_aparat_thumb = get_post_meta( get_the_ID(), 'dina_post_aparat_thumb', true );
            if ( ! empty ( $dina_post_video_thumb ) || ! empty ( $dina_post_aparat_thumb ) ) {
                echo '<div class="post-img dina-post-video-thumb">';
                    if ( ! empty ( $dina_post_aparat_thumb ) ) {
                        echo '<style>.h_iframe-aparat_embed_frame{position:relative;}.h_iframe-aparat_embed_frame .ratio{display:block;width:100%;height:auto;}.h_iframe-aparat_embed_frame iframe{position:absolute;top:0;left:0;width:100%;height:100%;}</style><div class="h_iframe-aparat_embed_frame"><span style="display: block;padding-top: 57%"></span><iframe src="https://www.aparat.com/video/video/embed/videohash/'.$dina_post_aparat_thumb.'/vt/frame" title="'.get_the_title( $id ).'" allowFullScreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe></div>';
                    } elseif ( ! empty ( $dina_post_video_thumb ) ) {
                        echo do_shortcode( '[video src="'. $dina_post_video_thumb .'" preload="none"]' );
                    }
                echo '</div>';
            } elseif ( has_post_thumbnail() && dina_opt( 'show_post_thumb' ) ) { ?>
                <div class="post-img">
                    <?php the_post_thumbnail( 'larg' ); ?>
                </div>
            <?php } ?>

            <?php
            if ( dina_opt( 'show_more_s' ) ) { ?>
                <div class="post-sh dina-more-less" data-more="<?php _e( 'Show More', 'dina-kala' ); ?>" data-less="<?php _e( 'Show Less', 'dina-kala' ); ?>">
                <div class="dina-more-less-content">
            <?php } ?>
            <?php the_content(); ?>

            <?php
            //Post Download Box
            $show_dlbox = get_post_meta( get_the_ID(), 'dina_show_dlbox', true );

            if ( $show_dlbox ) {
               echo dina_dl_box( get_the_ID() );
            }
            ?>

            <?php 
            if ( dina_opt( 'show_more_s' ) ) {
                echo '</div></div>';
            } ?>
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
        wp_link_pages( $defaults ); ?>

        <?php do_action( 'dina_after_post_content' ); ?>


        <div class="row post-det">

            <?php if ( dina_opt( 'show_post_tags' ) ) { ?>
                <div class="col-12 post-tags">
                    <?php the_tags( '<span class="fal fa-tags" aria-hidden="true"></span>'.__( ' Tags ', 'dina-kala' ), '&nbsp;', '' ); ?>
                </div>
            <?php } ?>

            <?php if ( dina_opt( 'show_post_cats' ) ) { ?>
                <div class="col-md-6 col-12 post-cats">
                    <i class="fal fa-folder-open" aria-hidden="true"></i>
                    <?php _e( 'Category', 'dina-kala' ) ?>
                    <?php the_category( '&nbsp;' ); ?>
                </div>
            <?php } ?>

            <?php if ( dina_opt( 'share_post' ) ) { ?>
            <div class="col-md-6 col-12 post-share">
                <span data-toggle="modal" data-target="#shareModal" class="pshare"">
                    <i aria-hidden="true" class="fal fa-share-alt"></i>
                    <?php _e( 'Share', 'dina-kala' ) ?>
                </span>
            </div>
            <?php } ?>

        </div>
        <?php } ?>
    </div>

    <?php 
    //Dina post bottom banner
    dina_post_bottom_banner();

    do_action( 'dina_after_post' );
    ?>

    <?php
    //Post Author Block
    if ( ! is_user_logged_in() && $lock_post_content ) {
        //do nothing
    } else {
        //Dina Post Author Block
        dina_post_author();
    }

    endwhile; 

if ( ! $hide_related_posts  ) {
    //Dina related posts
    if ( ! dina_opt( 'show_related_post_top' ) )
        dina_related_posts();

    //Dina related post products
    if ( ! dina_opt( 'show_related_post_products_top' ) )
        dina_related_post_products();
}

if ( ! is_user_logged_in() && $lock_post_content ) {
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
//Post Sidebar
if ( $pside == '' && dina_opt( 'post_side' ) > 0 ) {
    get_sidebar();
} elseif ( $pside != 'wside' && $pside != '' ) {
    get_sidebar();
} ?>

</div>
</div>
<?php get_footer();
<?php
/*
Theme Designed By: Meysam Hosseinkhani
Email: Meysam98@Gmail.com
Demo Website: Dinakala.I-design.ir
Author Website: i-design.ir
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
    exit;

Redux::setSection( $opt_name, array(
    'title'      => __( 'Post Settings', 'dina-kala' ),
    'id'         => 'post_setting',
    'icon'       => 'fal fa-file-alt',
    'fields'     => array(
        array( 
            'id'       => 'post_setting_docs',
            'type'     => 'raw',
            'content'  => dina_admin_info( '', 'https://i-design.ir/docs/dinakala/?p=2213', 'info' )
        ),
        array(
            'id'       => 'post_side',
            'type'     => 'image_select',
            'title'    => __( 'Posts Sidebar', 'dina-kala' ),
            'subtitle' => __( 'Specify the location of the posts sidebar, this feature is also customizable for each post.', 'dina-kala' ),
            'options'  => array(
                '0' => array(
                    'alt' => __( 'No sidebar', 'dina-kala' ),
                    'img' => RE_URI . 'assets/img/1c.png'
                ),
                '1' => array(
                    'alt' => __( 'Left alignment', 'dina-kala' ),
                    'img' => RE_URI . 'assets/img/2cl.png'
                ),
                '2' => array(
                    'alt' => __( 'Right alignment', 'dina-kala' ),
                    'img' => RE_URI . 'assets/img/2cr.png'
                )
            ),
            'default'  => '1'
        ),
        array(
            'id'       => 'post_archive_side',
            'type'     => 'image_select',
            'title'    => __( 'Posts Archive Sidebar', 'dina-kala' ),
            'subtitle' => __( 'Specify the location of the posts sidebar in archive pages (Category page, Tag page, ...)', 'dina-kala' ),
            'options'  => array(
                '0' => array(
                    'alt' => __( 'No sidebar', 'dina-kala' ),
                    'img' => RE_URI . 'assets/img/1c.png'
                ),
                '1' => array(
                    'alt' => __( 'Left alignment', 'dina-kala' ),
                    'img' => RE_URI . 'assets/img/2cl.png'
                ),
                '2' => array(
                    'alt' => __( 'Right alignment', 'dina-kala' ),
                    'img' => RE_URI . 'assets/img/2cr.png'
                )
            ),
            'default'  => '1'
        ),
        array(
            'id'       => 'post_col',
            'type'     => 'select',
            'title'    => __( 'Number of posts columns', 'dina-kala' ),
            'subtitle' => __( 'Number of posts columns in archive pages', 'dina-kala' ),
            'options'  => array(
                2 =>  2,
                3 =>  3,
                4 =>  4,
                5 =>  5,
            ),
            'default'  => 4,
        ),
        array(
            'id'       => 'show_parchive_title',
            'type'     => 'switch',
            'title'    => __( 'Show post archive title', 'dina-kala' ),
            'subtitle' => __( 'Add archive title to post archive pages', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'custom_post_thumb',
            'type'     => 'switch',
            'title'    => __( 'Custom size for thumbnails of posts', 'dina-kala' ),
            'subtitle' => __( 'Need to regenerate thumbnails by the plugin (regenerate thumbnails)', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'post_thumb_width',
            'type'     => 'text',
            'title'    => __( 'Width', 'dina-kala' ),
            'default'  => '300',                
            'required' => array( 'custom_post_thumb', '=', true ),
        ),
        array(
            'id'       => 'post_thumb_height',
            'type'     => 'text',
            'title'    => __( 'Height', 'dina-kala' ),
            'default'  => '300',                
            'required' => array( 'custom_post_thumb', '=', true ),
        ),            
        array(
            'id'      => 'show_author_block',
            'type'    => 'switch',
            'title'   => __( 'Show author info block in post page', 'dina-kala' ),
            'default' => false,
        ),
        array(
            'id'      => 'show_more_s',
            'type'    => 'switch',
            'title'   => __( 'Show the post description in a summary form on mobile', 'dina-kala' ),
            'default' => false,
        ),
        array(
            'id'       => 'show_more_s_desktop',
            'type'     => 'switch',
            'title'    => __( 'Show the post description in a summary form on desktop', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_more_s', '=', true ),
        ),
        array(
            'id'       => 'ajax_post',
            'type'     => 'switch',
            'title'    => __( 'Ajax Posts loading', 'dina-kala' ),
            'subtitle' => __( 'Loading posts ajax and remove pagination', 'dina-kala' ),
            'default'  => true,
        ),
        array(
            'id'       => 'ajax_post_auto',
            'type'     => 'switch',
            'title'    => __( 'Automatic loading of more posts', 'dina-kala' ),
            'subtitle' => __( 'Automatic loading of more posts when reaching the end of posts', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'ajax_post', '=', true ),
        ),
        array(
            'id'       => 'ajax_post_history',
            'type'     => 'switch',
            'title'    => __( 'Show page number', 'dina-kala' ),
            'subtitle' => __( 'Display page number in Ajax loading mode', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'ajax_post', '=', true ),
        ),
        array(
            'id'       => 'hide_post_title',
            'type'     => 'switch',
            'title'    => __( 'Hide Post title', 'dina-kala' ),
            'subtitle' => __( 'Hide Post title in top of post content', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'      => 'show_post_thumb',
            'type'    => 'switch',
            'title'   => __( 'Show Post thumbnail in top of post content', 'dina-kala' ),
            'default' => true,
        ),
        array(
            'id'      => 'show_post_tags',
            'type'    => 'switch',
            'title'   => __( 'View Post tags section', 'dina-kala' ),
            'default' => true
        ),
        array(
            'id'      => 'show_post_cats',
            'type'    => 'switch',
            'title'   => __( 'View Post category section', 'dina-kala' ),
            'default' => true
        ),
        array(
            'id'      => 'show_post_view',
            'type'    => 'switch',
            'title'   => __( 'View Post view section', 'dina-kala' ),
            'default' => true
        ),
        array(
            'id'      => 'show_post_aut',
            'type'    => 'switch',
            'title'   => __( 'Show author name in post page', 'dina-kala' ),
            'default' => true
        ),
        array(
            'id'      => 'show_post_pubdate',
            'type'    => 'switch',
            'title'   => __( 'Show publish date in post page', 'dina-kala' ),
            'default' => true
        ),
        array(
            'id'       => 'show_post_up',
            'type'     => 'switch',
            'title'    => __( 'Show update date in post page', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_post_pubdate', '=', true ),
        ),
        array(
            'id'       => 'share_post',
            'type'     => 'switch',
            'title'    => __( 'Share Post Button', 'dina-kala' ),
            'subtitle' => __( 'Show Share Post Button in post page', 'dina-kala' ),
            'default'  => true,
        ),
        array(
            'id'       => 'show_next_prev_post',
            'type'     => 'switch',
            'title'    => __( 'Display link to previous and next post on post page', 'dina-kala' ),
            'default'  => true,
        ),

        // post-settings-archive-start
        array(
            'id'     => 'post-settings-archive-section-start',
            'type'   => 'section',
            'title'  => __( 'Post settings on archive pages', 'dina-kala' ),
            'indent' => true,
        ),
        array(
            'id'       => 'show_post_cat',
            'type'     => 'switch',
            'title'    => __( 'Show post category on the thumbnail image', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'post_cat_style',
            'type'     => 'select',
            'title'    => __( 'Post category style', 'dina-kala' ),
            'options'  => array(
                'first'  => __( 'First style', 'dina-kala' ),
                'second' =>  __( 'Second style', 'dina-kala' ),
            ),
            'default'  => 'first',
            'required' => array( 'show_post_cat', '=', true ),
        ),
        array(
            'id'       => 'show_post_pub',
            'type'     => 'switch',
            'title'    => __( 'Show post publish date on the thumbnail image', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'post_pub_style',
            'type'     => 'select',
            'title'    => __( 'Post publish date style', 'dina-kala' ),
            'options'  => array(
                'first'  => __( 'First style', 'dina-kala' ),
                'second' =>  __( 'Second style', 'dina-kala' ),
            ),
            'default'  => 'first',
            'required' => array( 'show_post_pub', '=', true ),
        ),
        array(
            'id'      => 'show_post_author',
            'type'    => 'switch',
            'title'   => __( 'Show the name of the author', 'dina-kala' ),
            'default' => false,
        ),
        array(
            'id'       => 'link_post_author',
            'type'     => 'switch',
            'title'    => __( 'Link author name to author page', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_post_author', '=', true ),
        ),
        array(
            'id'      => 'show_post_excerpt',
            'type'    => 'switch',
            'title'   => __( 'Show post excerpt in post archive pages', 'dina-kala' ),
            'default' => false,
        ),
        array(
            'id'     => 'post-settings-archive-section-end',
            'type'   => 'section',
            'indent' => false,
        ),
        
        //relatedp-section-start
        array(
            'id'     => 'relatedp-section-start',
            'type'   => 'section',
            'title'  => __( 'Related Posts settings', 'dina-kala' ),
            'indent' => true,
        ),
        array(
            'id'       => 'show_related_post',
            'type'     => 'switch',
            'title'    => __( 'Related Post', 'dina-kala' ),
            'subtitle' => __( 'Show related post section in post page', 'dina-kala' ),
            'default'  => true,
        ),
        array(
            'id'       => 'show_related_post_top',
            'type'     => 'switch',
            'title'    => __( 'Show at the top of the post', 'dina-kala' ),
            'subtitle' => __( 'Show related posts on top of the post', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_related_post', '=', true ),
        ),
        array(
            'id'       => 'related_post_title',
            'type'     => 'text',
            'title'    => __( 'Block title', 'dina-kala' ),
            'default'  => __( 'Related Posts', 'dina-kala' ),   
            'required' => array( 'show_related_post', '=', true ),
        ),
        array(
            'id'       => 'related_post_count',
            'type'     => 'text',
            'title'    => __( 'Post total count', 'dina-kala' ),
            'default'  => 8,
            'required' => array( 'show_related_post', '=', true ),
        ),
        array(
            'id'      => 'related_post_by',
            'type'    => 'select',
            'title'   => __( 'Show related post by', 'dina-kala' ),
            'options' => array(
                'category' =>  __( 'Post category', 'dina-kala' ),
                'post_tag'  =>  __( 'Post tag', 'dina-kala' ),
            ),
            'default'  => 'category',
            'required' => array( 'show_related_post', '=', true ),
        ),
        array(
            'id'       => 'show_post_arrows',
            'type'     => 'switch',
            'title'    => __( 'Show arrows', 'dina-kala' ),
            'default'  => true,
            'required' => array( 'show_related_post', '=', true ),
        ),
        array(
            'id'       => 'post_loop',
            'type'     => 'switch',
            'title'    => __( 'Post loop', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_related_post', '=', true ),
        ),
        array(
            'id'       => 'auto_post_play',
            'type'     => 'switch',
            'title'    => __( 'Auto play', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_related_post', '=', true ),
        ),
        array(
            'id'       => 'postcount',
            'type'     => 'text',
            'title'    => __( 'Slider columns count', 'dina-kala' ),
            'default'  => 5,                
            'required' => array( 'show_related_post', '=', true ),
        ),
        array(
            'id'     => 'relatedp-section-end',
            'type'   => 'section',
            'indent' => false,
        ),
        //relatedp-section-end

        //related-post-products-section-start
        array(
            'id'     => 'related-post-products-section-start',
            'type'   => 'section',
            'title'  => __( 'Post related products settings', 'dina-kala' ),
            'indent' => true,
        ),
        array(
            'id'       => 'show_related_post_products',
            'type'     => 'switch',
            'title'    => __( 'Show related products in post page', 'dina-kala' ),
            'subtitle' => __( 'By activating this option, products related to the post will be displayed on the post page. These entries are selected by the same tag as the post.', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'show_related_post_products_top',
            'type'     => 'switch',
            'title'    => __( 'Show at the top of the post', 'dina-kala' ),
            'subtitle' => __( 'Show related products on top of the post', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_related_post_products', '=', true ),
        ),
        array(
            'id'       => 'related_post_products_title',
            'type'     => 'text',
            'title'    => __( 'Block title', 'dina-kala' ),
            'default'  => __( 'Related Products', 'dina-kala' ),
            'required' => array( 'show_related_post_products', '=', true ),
        ),
        array(
            'id'       => 'related_post_products_count',
            'type'     => 'text',
            'title'    => __( 'Product total count', 'dina-kala' ),
            'default'  => 8,
            'required' => array( 'show_related_post_products', '=', true ),
        ),
        array(
            'id'       => 'show_post_products_arrows',
            'type'     => 'switch',
            'title'    => __( 'Show arrows', 'dina-kala' ),
            'default'  => true,
            'required' => array( 'show_related_post_products', '=', true ),
        ),
        array(
            'id'       => 'post_products_loop',
            'type'     => 'switch',
            'title'    => __( 'Product loop', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_related_post_products', '=', true ),
        ),
        array(
            'id'       => 'auto_post_products_play',
            'type'     => 'switch',
            'title'    => __( 'Auto play', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_related_post_products', '=', true ),
        ),
        array(
            'id'       => 'post_products_count',
            'type'     => 'text',
            'title'    => __( 'Slider columns count', 'dina-kala' ),
            'default'  => 5,                
            'required' => array( 'show_related_post_products', '=', true ),
        ),
        array(
            'id'     => 'related-post-products-section',
            'type'   => 'section',
            'indent' => false,
        ),
        //related-post-products-section

        array(
            'id'     => 'section-dl-box-start',
            'type'   => 'section',
            'title'  => __( 'Download Box Settings', 'dina-kala' ),
            'indent' => true,
        ),
        array(
            'id'      => 'dl_box_product',
            'type'    => 'switch',
            'title'   => __( 'Activate the download box in the products', 'dina-kala' ),
            'default' => false,
        ),
        array(
            'id'      => 'dl_box_login',
            'type'    => 'switch',
            'title'   => __( 'Show download links to logged in users', 'dina-kala' ),
            'default' => false,
        ),
        array(
            'id'      => 'dl_guide_title',
            'type'    => 'text',
            'title'   => __( 'Download guide title', 'dina-kala' ),
            'default' => __( 'Download guide', 'dina-kala' ),
        ), 
        array(
            'id'      => 'dl_guide_text',
            'type'    => 'editor',
            'title'   => __( 'Download guide text', 'dina-kala' ),
            'default' => __( 'Download guide', 'dina-kala' ),
            'args'    => array(
                'wpautop'       => true,
                'media_buttons' => true,
                'textarea_rows' => 5,
                'teeny'         => false,
                'quicktags'     => true,
            ),
        ),
        array(
            'id'       => 'dl_box_pass',
            'type'     => 'text',
            'title'    => __( 'Default Password', 'dina-kala' ),
            'subtitle' => __( 'This item can be set for each post individually on the post page', 'dina-kala' ),
            'default'  => 'www.example.com',
        ),
        array(
            'id'     => 'section-dl-box-end',
            'type'   => 'section',
            'indent' => false,
        ),

        array(
            'id'     => 'post-top-banner-section-start',
            'type'   => 'section',
            'title'  => __( 'Ad banner settings above posts', 'dina-kala' ),
            'indent' => true,
        ),
        array(
            'id'       => 'show_post_top_banner',
            'type'     => 'switch',
            'title'    => __( 'Show banner ad above posts', 'dina-kala' ),
            'default'  => false
        ),
        array(
            'id'       => 'show_post_top_mobile',
            'type'     => 'switch',
            'title'    => __( 'Show banner in mobile mode', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_post_top_banner', '=', true ),
        ),
        array(
            'id'       => 'post_top_banner',
            'type'     => 'media',
            'url'      => true,
            'readonly' => false,
            'title'    => __( 'Banner image', 'dina-kala' ),
            'compiler' => 'true',
            'subtitle' =>  __( 'Appropriate size: 940 pixel(w) in 150 pixel(h)', 'dina-kala' ),
            'required' => array( 'show_post_top_banner', '=', true ),
        ),
        array(
            'id'       => 'post_top_banner_link',
            'type'     => 'text',
            'title'    => __( 'Banner link', 'dina-kala' ),
            'default'  => '#',
            'required' => array( 'show_post_top_banner', '=', true ),
        ),
        array(
            'id'       => 'post_top_banner_title',
            'type'     => 'text',
            'title'    => __( 'Banner title', 'dina-kala' ),
            'default'  => '#',
            'required' => array( 'show_post_top_banner', '=', true ),
        ),
        array(
            'id'       => 'post_top_banner_newtab',
            'type'     => 'switch',
            'title'    => __( 'Open the link in a new tab', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_post_top_banner', '=', true ),
        ),
        array(
            'id'       => 'post_top_banner_nofollow',
            'type'     => 'switch',
            'title'    => __( 'Add nofollow property to link', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_post_top_banner', '=', true ),
        ),
        array(
            'id'     => 'post-top-banner-section-end',
            'type'   => 'section',
            'indent' => false,
        ),

        array(
            'id'     => 'post-bottom-banner-section-start',
            'type'   => 'section',
            'title'  => __( 'Ad banner settings below posts', 'dina-kala' ),
            'indent' => true,
        ),
        array(
            'id'      => 'show_post_bottom_banner',
            'type'    => 'switch',
            'title'   => __( 'Show banner ad below posts', 'dina-kala' ),
            'default' => false
        ),
        array(
            'id'       => 'show_post_bottom_mobile',
            'type'     => 'switch',
            'title'    => __( 'Show banner in mobile mode', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_post_bottom_banner', '=', true ),
        ),
        array(
            'id'       => 'post_bottom_banner',
            'type'     => 'media',
            'url'      => true,
            'readonly' => false,
            'title'    => __( 'Banner image', 'dina-kala' ),
            'compiler' => 'true',
            'subtitle' =>  __( 'Appropriate size: 940 pixel(w) in 150 pixel(h)', 'dina-kala' ),
            'required' => array( 'show_post_bottom_banner', '=', true ),
        ),
        array(
            'id'       => 'post_bottom_banner_link',
            'type'     => 'text',
            'title'    => __( 'Banner link', 'dina-kala' ),
            'default'  => '#',
            'required' => array( 'show_post_bottom_banner', '=', true ),
        ),
        array(
            'id'       => 'post_bottom_banner_title',
            'type'     => 'text',
            'title'    => __( 'Banner title', 'dina-kala' ),
            'default'  => '#',
            'required' => array( 'show_post_bottom_banner', '=', true ),
        ),
        array(
            'id'       => 'post_bottom_banner_newtab',
            'type'     => 'switch',
            'title'    => __( 'Open the link in a new tab', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_post_bottom_banner', '=', true ),
        ),
        array(
            'id'       => 'post_bottom_banner_nofollow',
            'type'     => 'switch',
            'title'    => __( 'Add nofollow property to link', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_post_bottom_banner', '=', true ),
        ),
        array(
            'id'     => 'post-bottom-banner-section-end',
            'type'   => 'section',
            'indent' => false,
        ),

    ),
) );
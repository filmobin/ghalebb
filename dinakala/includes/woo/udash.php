<?php

if ( class_exists( 'WeDevs_Dokan' ) ) { 
    remove_action( 'woocommerce_account_dashboard', 'dokan_set_go_to_vendor_dashboard_btn' );
}

add_action( 'woocommerce_account_dashboard', 'dina_dashboard_content' );
if ( ! function_exists( 'dina_dashboard_content' ) ) {
    function dina_dashboard_content() {
        $stat_class = 'col-lg-3 col-md-6 col-12';
    ?>

        <ul class="dina-dashboard-stats row">
            <li class="<?= $stat_class ?>">
                <div class="dina-dashboard-stat-con dina-dashboard-green shadow-box">
                    <i class="fal fa-shopping-cart"></i>
                    <span class="col-12 dina-stats-con d-flex">
                        <span class="dina-dashboard-stats-count">
                            <?= dina_get_customer_total_orders( get_current_user_id() ) ?>
                        </span>
                        <span class="dina-dashboard-stats-title">
                            <?= __( 'Total Orders', 'dina-kala' ) ?>
                        </span>
                    </span>
                </div>
            </li>

            <li class="<?= $stat_class ?>">
                <div class="dina-dashboard-stat-con dina-dashboard-yellow shadow-box">
                    <i class="<?= dina_opt( 'completed_orders_icon' ) ?>"></i>
                    <span class="col-12 dina-stats-con d-flex">
                        <span class="dina-dashboard-stats-count">
                            <?= dina_get_customer_orders( get_current_user_id(), dina_opt( 'completed_orders_status' ) ) ?>
                        </span>
                        <span class="dina-dashboard-stats-title">
                            <?= dina_opt( 'completed_orders_title' ) ?>
                        </span>
                    </span>
                </div>
            </li>
            
            <li class="<?= $stat_class ?>">
                <div class="dina-dashboard-stat-con dina-dashboard-blue shadow-box">
                    <i class="<?= dina_opt( 'pending_orders_icon' ) ?>"></i>
                    <span class="col-12 dina-stats-con d-flex">
                        <span class="dina-dashboard-stats-count">
                            <?= dina_get_customer_orders( get_current_user_id(), dina_opt( 'pending_orders_status' ) ) ?>
                        </span>
                        <span class="dina-dashboard-stats-title">
                            <?= dina_opt( 'pending_orders_title' ) ?>
                        </span>
                    </span>
                </div>
            </li>

            <li class="<?= $stat_class ?>">
                <div class="dina-dashboard-stat-con dina-dashboard-red shadow-box">
                    <i class="<?= dina_opt( 'processing_orders_icon' ) ?>"></i>
                    <span class="col-12 dina-stats-con d-flex">
                        <span class="dina-dashboard-stats-count">
                            <?= dina_get_customer_orders( get_current_user_id(), dina_opt( 'processing_orders_status' ) ) ?>
                        </span>
                        <span class="dina-dashboard-stats-title">
                            <?= dina_opt( 'processing_orders_title' ) ?>
                        </span>
                    </span>
                </div>
            </li>

        </ul>

        <?php
        if ( dina_opt( 'show_dashboard_slider' ) ) {
            dina_dashboard_slider();
        }
        ?>

        <?php
        if ( dina_opt( 'show_dashboard_banner' ) ) {
            dina_dashboard_banner();
        }
        ?>
        
        <?php dina_dashboard_message() ?>

        <ul class="dina-dashboard-items row">
            <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) :
                if ( $endpoint != 'dashboard' && $endpoint != 'customer-logout' ) { ?>
                <li class="col-md-3 col-sm-4 col-6 <?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
                    <a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>" class="shadow-box">
                        <?php echo esc_html( $label ); ?>
                    </a>
                </li>
            <?php } 
            endforeach; ?>
        
        </ul>
<?php }
}

// Dina Get Customer's Orders Value
function dina_get_customer_total_orders( $customer_id ) {

    $customer_orders = wc_get_orders( array(
        'customer' => $customer_id,
        'status'   => 'completed',
        'return'   => 'ids',
    ) );

    $total = 0;
    foreach ( $customer_orders as $customer_order ) {
        $order = wc_get_order( $customer_order );
        $total += $order->get_total();
    }

    $total = wc_price( $total );

    return $total;
}

// Dina Get Customer's Orders
function dina_get_customer_orders( $customer_id, $order_status ) {

    $order_status = str_replace( 'wc-', '', $order_status, );

    $customer_orders = wc_get_orders( array(
        'customer' => $customer_id,
        'status'   => $order_status,
        'return'   => 'ids',
    ) );

    $total        = count( $customer_orders );
    $total_orders = sprintf( _n( '%s Order', '%s Orders', $total, 'dina-kala' ), $total );

    return $total_orders;
}

// Dina Registration Date 
function dina_register_date( $author ) {

    $user_reg = strtotime( get_the_author_meta( 'user_registered', $author ) );
    $lang = get_bloginfo("language"); 
    
    if ( $lang != 'fa-IR' ) {
        echo date( 'j F Y' );
    } elseif ( function_exists( 'wp_date' ) ) {
		echo wp_date( 'j F Y', $user_reg,null);
    } elseif ( function_exists( 'parsidate' ) ) {
		echo parsidate( 'j F Y', get_the_author_meta( 'user_registered', $author ), $lang='per' );
	} else {
		echo date( 'j F Y' );
	}
}

//Add Affiliate link to my account page
if ( class_exists( 'Affiliate_WP' ) ) {
    add_filter ( 'woocommerce_account_menu_items', 'affiliate_one_more_link' );
    function affiliate_one_more_link( $menu_links ) {
        $new = array( 'affiliate-wp' => __( 'Affiliates' , 'dina-kala' ) ); 
        $menu_links = array_slice( $menu_links, 0, 6, true ) 
        + $new 
        + array_slice( $menu_links, 1, NULL, true );
        return $menu_links;
    }
    add_filter( 'woocommerce_get_endpoint_url', 'affiliate_hook_endpoint', 5, 4 );
    function affiliate_hook_endpoint( $url, $endpoint, $value, $permalink ) {
        if ( $endpoint === 'affiliate-wp' ) {
            $url = esc_url( affwp_get_affiliate_area_page_url() );
        }
        return $url;
    }
}

//Add YITH Affiliate link to my account page
if ( class_exists( 'YITH_WCAF' ) ) {
    add_filter ( 'woocommerce_account_menu_items', 'yith_affiliate_one_more_link' );
    function yith_affiliate_one_more_link( $menu_links ) {
        // we will hook "affiliate-wp" later
        $new = array( 'yith-affiliate' => __( 'Affiliates' , 'dina-kala' ) ); 
        // or in case you need 2 links
        // $new = array( 'link1' => 'Link 1', 'link2' => 'Link 2' );
    
        // array_slice() is good when you want to add an element between the other ones
        $menu_links = array_slice( $menu_links, 0, 6, true ) 
        + $new 
        + array_slice( $menu_links, 1, NULL, true );
        return $menu_links;
    }
    add_filter( 'woocommerce_get_endpoint_url', 'yith_affiliate_hook_endpoint', 5, 4 );
    function yith_affiliate_hook_endpoint( $url, $endpoint, $value, $permalink ) {
        if ( $endpoint === 'yith-affiliate' ) {
            // ok, here is the place for your custom URL, it could be external
            $page_id = (int)get_option( 'yith_wcaf_dashboard_page_id' );
            $url = esc_url( get_the_permalink( $page_id ) );
        }
        return $url;
    }
}

//Add Wishlist link to my account page
if ( class_exists( 'YITH_WCWL' ) ) {
    add_filter( 'woocommerce_account_menu_items', 'dina_wishlist_link' );
    add_filter( 'woocommerce_get_endpoint_url', 'dina_wishlist_link_endpoint', 4, 4 );
}

function dina_wishlist_link( $menu_links ) {
    $new = array( 'dina-wishlist-link' => __( 'Wishlist' , 'dina-kala' ) );
    $menu_links = array_slice( $menu_links, 0, 4, true ) 
    + $new 
    + array_slice( $menu_links, 1, NULL, true );
    return $menu_links;
}

function dina_wishlist_link_endpoint( $url, $endpoint, $value, $permalink ) {
    if ( $endpoint === 'dina-wishlist-link' ) {
        if ( class_exists( 'YITH_WCWL' ) ) {
            $url = esc_url( YITH_WCWL()->get_wishlist_url() );
        }
    }
    return $url;
}

//Add custom links to my account page
add_filter ( 'woocommerce_account_menu_items', 'dina_dashboard_links' );
function dina_dashboard_links( $menu_links ) {
    for( $num = 1; $num <= 10 ; $num++ ) {
        if ( dina_opt( 'dashboard_link_'. di_dig2word( $num ) ) ) {
            $new = array( 'dina-dashboard-link-'. di_dig2word( $num ) => dina_opt( 'dashboard_link_'. di_dig2word( $num ) .'_title' ) ); 
            $menu_links = array_slice( $menu_links, 0, 1, true ) + $new + array_slice( $menu_links, 1, NULL, true );
        }
    }
    return $menu_links;
}

//Custom links endpoint
add_filter( 'woocommerce_get_endpoint_url', 'dina_dashboard_links_endpoint', 10, 4 );
function dina_dashboard_links_endpoint( $url, $endpoint, $value, $permalink ) {
    for( $num = 1; $num <= 10 ; $num++ ) {
        if ( dina_opt( 'dashboard_link_'. di_dig2word( $num ) ) ) {
            if ( $endpoint === 'dina-dashboard-link-'. di_dig2word( $num ) ) {
                $url = esc_url( dina_opt( 'dashboard_link_'. di_dig2word( $num ) .'_url' ) );
            }
        }
    }
    return $url;
}

//Dina Dashboard Banner
function dina_dashboard_banner() {
    
    if ( ! empty( dina_to_https ( dina_opt( 'dashboard_banner', 'url' ) ) ) ) { ?>

    <div class="row dashboard-banner-row<?php if ( !dina_opt( 'show_dashboard_mobile' ) ) { echo ' mobile-hidden'; }?>">
        <div class="col-12 bnr-image">
            <?php
            $link_target = dina_opt( 'dashboard_banner_newtab' ) ? ' target="_blank"' : '';
            $link_rel = dina_opt( 'dashboard_banner_nofollow' ) ? ' rel="nofollow"' : '';
            ?>
            <a class="shadow-box" href="<?php echo dina_opt( 'dashboard_banner_link' ); ?>" title="<?php echo dina_opt( 'dashboard_banner_title' ); ?>" aria-label="<?php echo dina_opt( 'dashboard_banner_title' ); ?>"<?php echo $link_target . $link_rel; ?>>
                <?php
                    $headb_width = ( ! empty( dina_opt( 'dashboard_banner', 'width' ) ) ) ? dina_opt( 'dashboard_banner', 'width' ) : '1260';
                    $headb_height = ( ! empty( dina_opt( 'dashboard_banner', 'height' ) ) ) ? dina_opt( 'dashboard_banner', 'height' ) : '142'; 
                ?>
                <img src="<?php echo dina_to_https( dina_opt( 'dashboard_banner', 'url' ) ); ?>" alt="<?php echo dina_opt( 'dashboard_banner_title' ); ?>" class="dashboard-banner shadow-box" width="<?php echo $headb_width; ?>" height="<?php echo $headb_height; ?>" />
            </a>
        </div>
    </div>

<?php 
    }
}

//Dina Dashboard Slider
function dina_dashboard_slider() {
    
    $sliders = dina_opt( 'dashboard_slider' );
    if ( ! dina_opt( 'show_dashboard_slider' ) || empty( $sliders[0]['image'] ) )
        return;
    ?>

    <!-- start slider -->
        <?php
        $slider_classes  = '';
        $slider_classes .= ! dina_opt( 'dashboard_slider_mobile' ) ? ' mobile-hidden' : '';
        $slider_classes .= dina_opt( 'dashboard_slider_mobile_title' ) ? ' slider-title-mobile' : '';
        ?>
        <div class="row dina-account-slider<?php echo $slider_classes; ?>">
            <div class="col-12">
                <div class="dina-slider shadow-box">

                    <?php
                        $slider_options = '';
                        $slider_options .= dina_opt( 'dashboard_slider_arrows' ) ? ' data-itemnavs="true"' : ' data-itemnavs="false"'; 
                        $slider_options .= dina_opt( 'dashboard_slider_dots' ) ? ' data-itemdots="true"' : ' data-itemdots="false"';
                        $slider_options .= dina_opt( 'dashboard_slider_auto_play' ) ? ' data-itemplay="true" data-itemtime="'. dina_opt( 'dashboard_slider_time' ) .'"' : ' data-itemplay="false"'; 
                        $slider_options .= dina_opt( 'dashboard_slider_pause_over' ) ? ' data-itemover="true"' : ' data-itemover="false"'; 
                        $slider_options .= ' data-dir="'. dina_rtl() .'"';
                    ?>
                        <div class="slider-con owl-carousel" <?php echo $slider_options; ?>>
                            <?php foreach ( $sliders as $slide ) {
                                if ( ! empty( $slide['image'] ) ) {

                                $target = dina_opt( 'dashboard_slider_newtab' ) ? ' target="_blank"' : '';
                                $nofollow = dina_opt( 'dashboard_slider_nofollow' ) ? ' rel="nofollow"' : ''; ?>

                                <div class="item">
                                    
                                    <?php if  ( ! empty( dina_to_https( $slide['url'] ) ) ) { ?>
                                        <a href="<?php echo dina_to_https( $slide['url'] ); ?>" title="<?php echo $slide['title']; ?>"<?php echo $target . $nofollow; ?>>
                                    <?php }
                                            $slider_width  = $slide['width'];
                                            $slider_height = $slide['height'];
                                    ?>
                                            <img loading="eager" src="<?php echo $slide['image']; ?>" alt="<?php echo $slide['title']; ?>" width="<?php echo $slider_width; ?>" height="<?php echo $slider_height; ?>" class="slider-img skip-lazy no-lazyload">
                                    <?php if ( ! empty( dina_to_https( $slide['url'] ) ) ) { ?>
                                        </a>
                                    <?php } ?>
                                </div>
                            <?php }
                            } ?>
                        </div>

                        <?php if ( dina_opt( 'dashboard_slider_title' ) ) { ?>
                            <ul class="slider-title">
                                <?php foreach ( $sliders as $slide ) { ?>
                                <li class="col">
                                    <span class="slide-title"><?php echo $slide['title']; ?></span>
                                </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                </div>
            </div>
        </div>
    <!-- end slider -->

<?php 
}

//Set template of Woocomemrce MyAccount
add_filter( 'page_template', 'dina_my_account_page_template' );
function dina_my_account_page_template( $page_template ) {
    if ( is_account_page() )
        $page_template = DI_DIR . '/tpls/my-account.php';

    if ( is_account_page() && dina_opt( 'user_panel_style' ) == 'upanel-one' )
        add_filter( 'show_admin_bar', '__return_false' );

    return $page_template;
}

//dina_whishlist_page_template
add_filter( 'page_template', 'dina_whishlist_page_template' );
function dina_whishlist_page_template( $page_template ) {

    if ( ! is_user_logged_in() )
        return $page_template;
    
    $shortcode = 'yith_wcwl_wishlist';

    if ( class_exists( 'YITH_WCWL' ) ) {
        $shortcode = 'yith_wcwl_wishlist';
    }

    if ( wc_post_content_has_shortcode( $shortcode ) )
        $page_template = DI_DIR . '/tpls/user-panel.php';

    if ( wc_post_content_has_shortcode( $shortcode ) && dina_opt( 'user_panel_style' ) == 'upanel-one' )
        add_filter( 'show_admin_bar', '__return_false' );

    return $page_template;
}

//dina_ticket_page_template
if ( class_exists( 'Awesome_Support' ) ) { 
    add_filter( 'page_template', 'dina_ticket_page_template' );
    function dina_ticket_page_template( $page_template ) {
        if ( wc_post_content_has_shortcode( 'tickets' ) || wc_post_content_has_shortcode( 'ticket-submit' ) )
            $page_template = DI_DIR . '/tpls/user-panel.php';

        if ( ( wc_post_content_has_shortcode( 'tickets' ) || wc_post_content_has_shortcode( 'ticket-submit' ) ) && dina_opt( 'user_panel_style' ) == 'upanel-one' )
            add_filter( 'show_admin_bar', '__return_false' );

        return $page_template;
    }
}

//dina_affiliate_page_template
if ( class_exists( 'Affiliate_WP' ) ) {
    add_filter( 'page_template', 'dina_affiliate_page_template' );
    function dina_affiliate_page_template( $page_template ) {

        $affiliates_page              = affiliate_wp()->settings->get( 'affiliates_page' );
        $affiliates_registration_page = affiliate_wp()->settings->get( 'affiliates_registration_page' );

        if ( get_the_ID() == (int)$affiliates_page ) {
            $page_template = DI_DIR . '/affiliate-area.php';
        } elseif ( get_the_ID() == (int)$affiliates_registration_page ) {
            $page_template = DI_DIR . '/tpls/user-panel.php';
        }

        if ( get_the_ID() == (int)$affiliates_page || get_the_ID() == (int)$affiliates_registration_page )
            add_filter( 'show_admin_bar', '__return_false' );

        return $page_template;
    }
}

//dina_yith_affiliate_page_template
if ( class_exists( 'YITH_WCAF' ) ) {
    add_filter( 'page_template', 'dina_yith_affiliate_page_template' );
    function dina_yith_affiliate_page_template( $page_template ) {
        if ( wc_post_content_has_shortcode( 'yith_wcaf_affiliate_dashboard' ) )
            $page_template = DI_DIR . '/yith-affiliate.php';

        if ( wc_post_content_has_shortcode( 'yith_wcaf_affiliate_dashboard' ) && dina_opt( 'user_panel_style' ) == 'upanel-one' )
            add_filter( 'show_admin_bar', '__return_false' );
        return $page_template;
    }
}

//dina_user_avatar_form
add_action( 'woocommerce_before_edit_account_form', 'dina_user_avatar_form' );
function dina_user_avatar_form() {
    if ( ! dina_opt( 'change_user_avatar' ) )
        return;
    echo '<h2>'. __( 'Change profile picture', 'dina-kala' ) .'</h2>';
    echo do_shortcode( '[dina-user-avatars]' );
}

add_action( 'woocommerce_edit_account_form_start', 'dina_edit_account_form_start' );
function dina_edit_account_form_start() {
    echo '<h2>'. __( 'Account details', 'dina-kala' ) .'</h2>';
}

//Add my comment to my account page
if ( dina_opt( 'comments_user_panel' ) ) {
	//Add rewrite endpoint comments
	add_action( 'init', function() {
		add_rewrite_endpoint( 'my-comments', EP_ROOT | EP_PAGES );
	});
	add_filter ( 'woocommerce_account_menu_items', 'dina_account_comments_link' );
	//Add comments endpoint content
	add_action( 'woocommerce_account_comments_endpoint', 'dina_my_comments' );
	add_filter( 'woocommerce_endpoint_comments_title', 'dina_comments_endpoint_title', 10, 2 );
	add_filter( 'woocommerce_get_query_vars', 'dina_comments_query_vars', 0);
}

//Add comments link to my-account page
function dina_account_comments_link( $menu_links ) {
    $menu_position = count( $menu_links ) - 1;
    $new = array( 'comments' => __( 'My comments', 'dina-kala' ) ); 
    $menu_links = array_slice( $menu_links, 0, $menu_position, true ) 
    + $new 
    + array_slice( $menu_links, 1, NULL, true );
    return $menu_links;
}

//dina_comments_endpoint_title
function dina_comments_endpoint_title( $title, $endpoint ) {
    $title = __( 'My comments', 'dina-kala' );
    return $title;
}

//dina_comments_query_vars
function dina_comments_query_vars( $endpoints ) {
    $endpoints['comments'] = 'comments';
    return $endpoints;
}

//dina_my_comments
function dina_my_comments() {

    $user_id = get_current_user_id();

    $args = array(
        'user_id' => $user_id,
    );

    $comments = get_comments( $args );

    if ( ! empty ( $comments ) ) {

        echo '
        <table class="woocommerce-comments-table woocommerce-MyAccount-comments shop_table shop_table_responsive my_account_comments account-comments-table">

            <thead>
                <tr>
                    <th class="woocommerce-comments-table__header woocommerce-comments-table__header-comment-content"><span class="nobr">'. __( 'Comment', 'dina-kala' ) .'</span></th>
                    <th class="woocommerce-comments-table__header woocommerce-comments-table__header-comment-date"><span class="nobr">'. __( 'Date', 'dina-kala' ) .'</span></th>
                    <th class="woocommerce-comments-table__header woocommerce-comments-table__header-comment-status"><span class="nobr">'. __( 'Status', 'dina-kala' ) .'</span></th>
                    <th class="woocommerce-comments-table__header woocommerce-comments-table__header-comment-actions"><span class="nobr">'. __( 'Actions', 'dina-kala' ) .'</span></th>
                </tr>
            </thead>

            <tbody>';

        foreach( $comments as $comment ) :
            $comment_id      = $comment->comment_ID;
            $comment_after   = strlen( $comment->comment_content ) > 50 ? ' ...' : '';
            $comment_content = mb_substr( $comment->comment_content, 0, 50,'utf-8' ) . $comment_after;
            $comment_link    = esc_url( get_comment_link( $comment_id ) );
            $comment_date    = get_comment_date( "l, j F Y", $comment_id );
            $comment_status  = wp_get_comment_status( $comment_id ) == 'approved' ? __( 'Approved', 'dina-kala' ) : __( 'Waiting for approval', 'dina-kala' );
            echo '
                <tr class="woocommerce-comments-table__row comment-'. wp_get_comment_status( $comment_id ) .'">
                    <td class="woocommerce-comments-table__cell woocommerce-comments-table__cell-comment-content" data-title="'. __( 'Comment', 'dina-kala' ) .'">
                    '. $comment_content .'
                    </td>
                    <td class="woocommerce-comments-table__cell woocommerce-comments-table__cell-comment-date" data-title="'. __( 'Date', 'dina-kala' ) .'">
                    '. $comment_date .'
                    </td>
                    <td class="woocommerce-comments-table__cell woocommerce-comments-table__cell-comment-status" data-title="'. __( 'Status', 'dina-kala' ) .'">
                    '. $comment_status .'
                    </td>
                    <td class="woocommerce-comments-table__cell woocommerce-comments-table__cell-comment-actions" data-title="'. __( 'Actions', 'dina-kala' ) .'">
                        <a href="'. $comment_link .'" class="woocommerce-button button view" target="_blank">'. __( 'View comment', 'dina-kala' ) .'</a>
                    </td>
                </tr>';
        endforeach;

			echo '				
            </tbody>
	    </table>';

    } else {
        echo '<div class="woocommerce-info">'. __( 'You have not posted a comment yet', 'dina-kala' ) .'</div>';
    }
}

//dina_order_item_quantity_html
add_filter( 'woocommerce_order_item_quantity_html', 'dina_order_item_quantity_html', 10, 2 );
function dina_order_item_quantity_html( $quantity_html,$item ) {
    $quantity_html = '<div class="dina-product-quantity"><strong>'. __( 'Quantity: ', 'dina-kala' ) .'</strong>' . $item->get_quantity() . '</div>';
    return $quantity_html;
}

//add order class to my orders page
add_filter( 'body_class', 'order_class' );
function order_class( $orderclasses ) {

    global $wp;

    if (is_wc_endpoint_url( 'view-order' )) {
        $order = wc_get_order( $wp->query_vars['view-order'] );
        $order_status  = 'dina-status-' . $order->get_status();
        $orderclasses[] = $order_status;
    }

    return $orderclasses;
}

//dina_dashboard_message
function dina_dashboard_message() {
    if ( ! dina_opt( 'show_dashboard_message') )
    return;
    ?>
    <div class="row dina-dashboard-message">
        <div class="col-12">
            
            <?php if ( dina_opt( 'show_dashboard_message_one' ) && ! empty( dina_opt( 'dashboard_message_one' ) ) ) { ?>
                <div class="woocommerce-message" role="alert">
                    <?php echo do_shortcode( dina_opt( 'dashboard_message_one' ) ); ?>
                </div>
            <?php } ?>

            <?php if ( dina_opt( 'show_dashboard_message_two' ) && ! empty( dina_opt( 'dashboard_message_two' ) ) ) { ?>
                <div class="woocommerce-info" role="alert">
                    <?php echo do_shortcode( dina_opt( 'dashboard_message_two' ) ); ?>
                </div>
            <?php } ?>

            <?php if ( dina_opt( 'show_dashboard_message_three' ) && ! empty( dina_opt( 'dashboard_message_three' ) ) ) { ?>
                <div class="woocommerce-error" role="alert">
                    <?php echo do_shortcode( dina_opt( 'dashboard_message_three' ) ); ?>
                </div>
            <?php } ?>

            <?php if ( dina_opt( 'show_dashboard_message_four' ) && ! empty( dina_opt( 'dashboard_message_four' ) ) ) { ?>
                <div class="woocommerce-info" role="alert">
                    <?php echo do_shortcode( dina_opt( 'dashboard_message_four' ) ); ?>
                </div>
            <?php } ?>

            <?php if ( dina_opt( 'show_dashboard_message_five' ) && ! empty( dina_opt( 'dashboard_message_five' ) ) ) { ?>
                <div class="woocommerce-message" role="alert">
                    <?php echo do_shortcode( dina_opt( 'dashboard_message_five' ) ); ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php
}

// dina_get_user_panel_header
function dina_get_user_panel_header()
{
    if ( dina_opt( 'user_panel_style' ) == 'upanel-one' ) {
    ?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
        <head>
            <link rel="shortcut icon" href="<?php echo dina_to_https( dina_opt( 'site_favicon', 'url' ) ); ?>" type="image/x-icon" />
            <link rel="apple-touch-icon" href="<?php echo dina_to_https( dina_opt( 'site_favicon', 'url' ) ); ?>">
            <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <?php if ( ! dina_opt( 'dis_mobile_color' ) ) { ?>
            <meta name="theme-color" content="<?php echo ( dina_opt( 'ch_mobile_color' ) ? dina_opt( 'mobile_bar_color' ) : dina_opt( 'custom_color' ) ); ?>" />
            <?php } ?>
            <meta name="fontiran.com:license" content="B3L8B">
            <?php if (is_singular() ) wp_enqueue_script( 'comment-reply' ) ?>
            <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
            <?php wp_head(); ?>
        </head>
        <body <?php body_class(); ?> <?php if ( dina_opt( 'site_schema' ) ) {?>itemscope itemtype="https://schema.org/WebPage"<?php } ?>>
            <header class="container-fluid dina-header dina-my-account-header">
                <div class="row logo-box">

                    <div class="col-6 logo dina-logo dina-myaccount-logo">
                        <?php dina_site_logo( true, ' header-logo', true ); ?>
                    </div>

                    <div class="col-6 dina-myaccount-mobile-btns">
                        <?php $position = is_rtl() ? 'right' : 'left' ?>
                        <span class="btn btn-light mmenu<?php if ( dina_opt( 'mobile_menu_text_style' ) ) { echo ' menu-btn-text-style'; } ?>" onclick="openAccountNav('<?= $position ?>')">
                            <i aria-hidden="true" data-title="<?php _e( 'Menu', 'dina-kala' ); ?>" class="fal fa-bars"></i>
                        </span>
                    </div>

                    <div class="col-md-6 hidden-tablet dina-myaccount-header-buttons">
                        <?php do_action( 'dina_before_header_btns' ); ?>

                        <?php if ( dina_opt( 'dina_dark_mode' ) && dina_opt( 'dina_dark_mode_switch' ) ) { ?>
                            <div class="btn-di-toggle">
                                <i aria-hidden="true" class="di-toggle-icon fal fa-moon" data-toggle="tooltip" data-placement="top" title="<?php _e( 'Dark mode', 'dina-kala' ); ?>"></i>
                                <i aria-hidden="true" class="di-toggle-icon fal fa-sun" data-toggle="tooltip" data-placement="top" title="<?php _e( 'Light mode', 'dina-kala' ); ?>"></i>
                            </div>
                        <?php } ?>

                        <?php if ( class_exists( 'WooCommerce' ) && ! dina_opt( 'product_catalog_mode' ) && dina_opt( 'show_cart_btn' ) ) { ?>
                        <div class="btn-cart">
                            <?php if ( ! dina_opt( 'direct_cart_link' ) ) { ?>
                                <span class="shop-icon" data-toggle="tooltip" data-placement="top" title="<?php _e( 'Shopping cart', 'dina-kala' ); ?>" onclick="dinaOpenCart()">
                                    <i aria-hidden="true" class="fal fa-shopping-bag"></i>
                                    <i class="dina-cart-amount">
                                        <?php echo dina_cart_amount() ?>
                                    </i>
                                </span>
                            <?php } else { ?>
                                <a class="shop-icon" data-toggle="tooltip" data-placement="top" title="<?php _e( 'Shopping cart', 'dina-kala' ); ?>" href="<?php echo wc_get_cart_url() ?>">
                                    <i aria-hidden="true" class="fal fa-shopping-bag"></i>
                                    <i class="dina-cart-amount">
                                        <?php echo dina_cart_amount() ?>
                                    </i>
                                </a>
                            <?php } ?>
                        </div>
                        <?php } ?>

                        <?php do_action( 'dina_after_header_btns' ); ?>
                        <?php if ( dina_opt( 'show_user_btn' ) ) {
                            $user = wp_get_current_user(); ?>
                            <div class="drop-con">
                            <div class="dropdown user-drop">
                                <button class="dropdown-toggle user-menu" type="button">
                                    <?php echo get_avatar( get_current_user_id() , 32, '', $user->display_name ); ?>
                                    <span class="user-name">
                                        <?php echo $user->display_name; ?>
                                    </span>
                                    <span class="fal fa-chevron-down user-chevron-down" aria-hidden="true"></span>
                                </button>

                                <?php if ( dina_opt( 'replace_user_menu' ) && has_nav_menu( 'user_menu' ) ) { ?>
                                    <?php
                                        wp_nav_menu( array(
                                            'menu'              => 'user_menu',
                                            'theme_location'    => 'user_menu',
                                            'menu_class'        => 'dropdown-menu user-menu mu-menu col-12',
                                            'depth'             => 1,
                                            'container'         => ''
                                            )
                                        );
                                    ?>
                                <?php } elseif ( class_exists( 'WooCommerce' ) ) { ?>
                                    <ul class="dropdown-menu user-menu mu-menu col-12">
                                        <?php get_template_part( 'includes/umenu' ); ?>
                                    </ul>
                                <?php } ?>
                            </div>
                            </div>
                        <?php } ?>
                    </div>

                </div>
            </header>
    <?php
    } else {
        get_header();
    }
}

// dina_get_user_panel_footer
function dina_get_user_panel_footer()
{
    if ( dina_opt( 'user_panel_style' ) == 'upanel-one' ) {
        ?>
        <footer class="container-fluid dina-my-account-footer copyright<?php if ( dina_opt( 'hide_copy' ) ) { echo ' hide-copy-m'; } ?>">
            <div class="row">
                <div class="col-md-6 col-12 copy-text">
                    <?php echo dina_opt( 'copy_text' ); ?>
                </div>
                <?php if ( dina_opt( 'show_footer_social' ) ) { ?>
                <?php $social_nofollow = ( dina_opt( 'nofollow_social_link' ) ? ' rel="nofollow"' : '' ); ?>
                <div class="col-md-6 col-12 social-footer">
                    <?php
                    $classes = dina_opt( 'footer_social_circle' ) ? 'footer-social-circle' : 'footer-social-square';
                    dina_social_links( $classes, false ) ?>
                </div>
                <?php } ?>
            </div>
        </footer>
        <!-- Copyright area -->
        <?php
        if ( function_exists( 'dina_footer' ) ) {
            dina_footer();
        } else {
            do_action( 'dina_footer' );
        }

        wp_footer();
        ?>
        </body>
        </html>
    <?php
    } else {
        get_footer();
    }
}

//dina_before_account_navigation
add_action( 'woocommerce_before_account_navigation', 'dina_before_account_navigation' );
function dina_before_account_navigation() {
    $menu_position = is_rtl() ? "'right'" : "'left'";
    $user          = wp_get_current_user();
    $edit_profile  = get_option( 'woocommerce_myaccount_edit_account_endpoint', 'edit-account' );
    $before        = '<div id="dinaAccountNav" class="woocommerce-MyAccount-navigation-con">';
    $before       .= dina_opt( 'user_panel_style' ) == 'upanel-one' ? '<a href="javascript:void(0)" class="mclosebtn" aria-label="'. __( 'Close', 'dina-kala' ) .'" data-title="'. __( 'Close', 'dina-kala' ) .'" rel="nofollow" onclick="closeAccountNav('. $menu_position .')"><i class="fal fa-times" aria-hidden="true"></i></a>' : '';
    $before       .= dina_opt( 'user_panel_style' ) == 'upanel-one' && dina_opt( 'dina_dark_mode' ) && dina_opt( 'dina_dark_mode_switch' ) ? '<div class="btn-di-toggle di-toggle-mobile"><i aria-hidden="true" class="di-toggle-icon fal fa-moon" title="'. __( 'Dark mode', 'dina-kala' ) .'"></i><i aria-hidden="true" class="di-toggle-icon fal fa-sun" title="'. __( 'Light mode', 'dina-kala' ) .'"></i></div>' : '';
    $before       .= '<div class="dina-user-avatar-container">';
    $before       .= '<a href="' . esc_url( dina_myaccount_link() . $edit_profile ) .'" class="dina-edit-profile" title="'. __( 'Edit Profile', 'dina-kala' ) .'">';
    $before       .= get_avatar( get_current_user_id() , 120,'' ,$user->display_name );
    $before       .= '<i class="dina-edit-profile-icon fal fa-user-edit" aria-hidden="true"></i>';
    $before       .= '</a>';
    $before       .= '</div>';
    $before       .= '<span class="side-uname">'. $user->display_name .'</span>';

	if ( ! empty ( dina_get_wallet() ) ) {
        $before .= '<span class="m-wallet">'. __( 'Wallet Inventory: ', 'dina-kala' ) . dina_get_wallet() .'</span>';
    }

    echo $before;

    do_action ( 'dina_after_account_wallet_balance' );
}

//dina_after_account_navigation
add_action( 'woocommerce_after_account_navigation', 'dina_after_account_navigation' );
function dina_after_account_navigation() {
    $menu_position = is_rtl() ? "'right'" : "'left'";
    echo '</div>';
    echo '<div id="dinaAccountCanvas" class="overlay3" onclick="closeAccountNav('. $menu_position .')"></div>';
}

//Dina site logo
function dina_login_logo( $schema, $class, $strong ) {
    ?>
    <a href="<?php echo dina_logo_link(); ?>" title="<?php bloginfo( 'name' ); ?> | <?php bloginfo( 'description' ); ?>" class="dina-logo-link" rel="home">

        <?php
            if ( dina_opt( 'change_login_page_logo' ) && ! empty( dina_opt( 'login_page_logo', 'url' ) ) ) {
                $logo_retina_src = dina_to_https( dina_opt( 'login_page_logo', 'url' ) );
                $logo_width      = ( ! empty( dina_opt( 'login_page_logo', 'width' ) ) ) ? dina_opt( 'login_page_logo', 'width' ) : '320';
                $logo_height     = ( ! empty( dina_opt( 'login_page_logo', 'height' ) ) ) ? dina_opt( 'login_page_logo', 'height' ) : '114';
            } else {
                $logo_src        = dina_to_https( dina_opt( 'site_logo', 'url' ) );
                $logo_retina_src = ( ! empty( dina_opt( 'site_logo_retina', 'url' ) ) ) ? dina_to_https( dina_opt( 'site_logo_retina', 'url' ) ) : $logo_src;
                $logo_width      = ( ! empty( dina_opt( 'site_logo_retina', 'width' ) ) ) ? dina_opt( 'site_logo_retina', 'width' ) : '320';
                $logo_height     = ( ! empty( dina_opt( 'site_logo_retina', 'height' ) ) ) ? dina_opt( 'site_logo_retina', 'height' ) : '114';
            }
            $alt_text        = get_post_meta( dina_opt( 'login_page_logo', 'id' ), '_wp_attachment_image_alt', true);
            $alt             = ! empty( $alt_text  ) ? $alt_text  : get_bloginfo( 'name' ) . ' | ' . get_bloginfo( 'description' );
            $light_style     = ( dina_opt( 'dina_dark_mode' ) && dina_opt( 'ch_dark_site_logo' ) ) ? ' dina-light-logo' : '';
            $logo_schema     = $schema && dina_opt( 'site_schema' ) ? 'itemprop="logo"' : '';
        ?>

        <img <?php echo $logo_schema; ?>
        src="<?php echo $logo_retina_src; ?>"
        width="<?php echo $logo_width; ?>"
        height="<?php echo $logo_height; ?>"
        alt="<?php echo $alt; ?>"
        title="<?php echo $alt; ?>"
        class="img-logo<?php echo $light_style . $class; ?>"/>

        <?php
        if ( dina_opt( 'dina_dark_mode' ) && dina_opt( 'ch_dark_site_logo' ) ) {
            if ( dina_opt( 'change_login_page_logo' ) && ! empty( dina_opt( 'login_page_dark_logo', 'url' ) ) ) {
                $logo_retina_src = dina_to_https( dina_opt( 'login_page_dark_logo', 'url' ) );
                $logo_width      = ( ! empty( dina_opt( 'login_page_dark_logo', 'width' ) ) ) ? dina_opt( 'login_page_dark_logo', 'width' ) : '320';
                $logo_height     = ( ! empty( dina_opt( 'login_page_dark_logo', 'height' ) ) ) ? dina_opt( 'login_page_dark_logo', 'height' ) : '114';
            } else {
                $logo_src        = dina_to_https( dina_opt( 'dark_site_logo', 'url' ) );
                $logo_retina_src = ( ! empty( dina_opt( 'dark_site_logo_retina', 'url' ) ) ) ? dina_to_https( dina_opt( 'dark_site_logo_retina', 'url' ) ) : $logo_src;
                $logo_width      = ( ! empty( dina_opt( 'dark_site_logo_retina', 'width' ) ) ) ? dina_opt( 'dark_site_logo_retina', 'width' ) : '320';
                $logo_height     = ( ! empty( dina_opt( 'dark_site_logo_retina', 'height' ) ) ) ? dina_opt( 'dark_site_logo_retina', 'height' ) : '114';
            }
            $logo_schema     = dina_opt( 'site_schema' ) ? 'itemprop="logo"' : '';
        ?>

            <img <?php echo $logo_schema; ?>
            src="<?php echo $logo_retina_src; ?>"
            width="<?php echo $logo_width; ?>"
            height="<?php echo $logo_height; ?>"
            alt="<?php echo $alt; ?>"
            title="<?php echo $alt; ?>"
            class="img-logo dina-dark-logo<?php echo $class; ?>"/>

        <?php } ?>
    </a>
<?php
}

// dina_before_myaccount in userpanel style one
add_action( 'dina_before_myaccount_content', 'dina_before_myaccount' );
function dina_before_myaccount(){
    if ( dina_opt( 'user_panel_style' ) != 'upanel-one' )
        return;
    ?>
    <div class="woocommerce-MyAccount-content-con">
    <?php
}

// dina_after_myaccount in userpanel style one
add_action( 'dina_after_myaccount_content', 'dina_after_myaccount' );
function dina_after_myaccount(){
    if ( dina_opt( 'user_panel_style' ) != 'upanel-one' )
        return;
    ?>
    </div>
    <?php
}

// dina_myaccount_body_class
function dina_myaccount_body_class( $classes ) {
    $classes[] = ' woocommerce-account';
    if ( is_user_logged_in() ) {
        $classes[] = ( dina_opt( 'user_panel_style' ) == 'upanel-one' ? ' dina-account-one' : ' dina-account-two' );
    } elseif ( dina_opt( 'woo_login_template' ) ) {
        $classes[] = ' dina-login-page';
    } else {
        $classes[] = ' dina-woo-login-page';
    }

    return $classes;
}

// dina_edit_account_phone_number_field
add_action( 'woocommerce_edit_account_form_fields', 'dina_edit_account_form_fields' );
function dina_edit_account_form_fields() {

    $user_id = get_current_user_id();
    
    if ( ! dina_opt( 'remove_phone_field' ) ) {
        $user_phone = get_user_meta( $user_id, 'billing_phone', true );
        $req_phone  = ! dina_opt( 'optional_phone_field' ) ? '&nbsp;<span class="required">*</span>' : '';
    ?>
    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="account_billing_phone"><?php esc_html_e( 'Phone number', 'dina-kala' ); echo $req_phone; ?> </label>
        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="billing_phone" id="account_billing_phone" value="<?php echo esc_attr( $user_phone ); ?>" />
    </p>
    <?php }
    
    if ( dina_opt( 'national_code_field' ) ) {
        $user_national_code = get_user_meta( $user_id, 'billing_national_code', true );
        $req_national_code  = ! dina_opt( 'optional_national_code_field' ) ? '&nbsp;<span class="required">*</span>' : ''; ?>
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <label for="account_national_code"><?php esc_html_e( 'National code', 'dina-kala' ); echo $req_national_code; ?> </label>
            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="billing_national_code" id="account_national_code" value="<?php echo esc_attr( $user_national_code ); ?>" />
        </p>
    <?php } 
    
}

// dina_edit_account_save_phone_number_field
add_action( 'woocommerce_save_account_details', 'dina_edit_account_save_phone_number_field' );
function dina_edit_account_save_phone_number_field( $user_id ) {
    if ( ! dina_opt( 'remove_phone_field' ) && isset( $_POST['billing_phone'] ) ) {
        update_user_meta( $user_id, 'billing_phone', sanitize_text_field( $_POST['billing_phone'] ) );
    }
    if ( dina_opt( 'national_code_field' ) && isset( $_POST['billing_national_code'] ) ) {
        update_user_meta( $user_id, 'billing_national_code', sanitize_text_field( $_POST['billing_national_code'] ) );
    }
}

add_action( 'woocommerce_save_account_details_errors', 'dina_edit_account_validate_fields', 10, 1 );
function dina_edit_account_validate_fields( $args ) {

    if ( ! dina_opt( 'remove_phone_field' ) ) {
        if ( isset( $_POST['billing_phone'] ) && empty( $_POST['billing_phone'] ) && ! dina_opt( 'optional_phone_field' ) ) {
            $args->add( 'billing_phone_error', __( 'Phone Number is a required field.', 'dina-kala' ) );
        }
    }

    if ( dina_opt( 'national_code_field' ) ) {
        if ( isset( $_POST['billing_national_code'] ) && empty( $_POST['billing_national_code'] ) && ! dina_opt( 'optional_national_code_field' ) ) {
            $args->add( 'billing_national_code_error', __( 'National code is a required field.', 'dina-kala' ) );
        }
    }
}

// dina_before_lost_password_confirmation_message
add_action( 'woocommerce_before_lost_password_confirmation_message', 'dina_before_lost_password_confirmation_message' );
function dina_before_lost_password_confirmation_message() {
    echo '<div class="dina-lost-password-confirmation-message">';
}

// dina_after_lost_password_confirmation_message
add_action( 'woocommerce_after_lost_password_confirmation_message', 'dina_after_lost_password_confirmation_message' );
function dina_after_lost_password_confirmation_message() {
    echo '</div>';
}
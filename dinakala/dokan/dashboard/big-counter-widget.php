<?php
/**
 *  Dashboard Widget Template
 *
 *  Dashboard Big Counter widget template
 *
 *  @since 2.4
 *
 *  @author weDevs <info@wedevs.com>
 *
 *  @package dokan
 */
?>
<div class="dashboard-widget big-counter">
    <ul class="dina-dashboard-stats row">
         <li class="col-lg-3 col-md-6 col-12">
            <div class="dina-dashboard-stat-con dina-dashboard-green shadow-box">
                <i class="fal fa-dollar-sign" aria-hidden="true"></i>    
                <span class="col-12 dina-stats-con d-flex">
                    <span class="dina-dashboard-stats-count"><?php echo wc_price( $earning ); ?></span>
                    <span class="dina-dashboard-stats-title"><?php esc_html_e( 'Sales', 'dokan-lite' ); ?></span>
                </span>
            </div>
        </li>
        <li class="col-lg-3 col-md-6 col-12">
            <div class="dina-dashboard-stat-con dina-dashboard-yellow shadow-box">
                <i class="fal fa-sack-dollar" aria-hidden="true"></i>
                <span class="col-12 dina-stats-con d-flex">
                    <span class="dina-dashboard-stats-count"><?php echo dokan_get_seller_earnings( dokan_get_current_user_id() ); ?></span>
                    <span class="dina-dashboard-stats-title"><?php esc_html_e( 'Earning', 'dokan-lite' ); ?></span>
                </span>
            </div>
        </li>
        <li class="col-lg-3 col-md-6 col-12">
            <div class="dina-dashboard-stat-con dina-dashboard-blue shadow-box">
                <i class="fal fa-file-invoice" aria-hidden="true"></i>
                <span class="col-12 dina-stats-con d-flex">
                    <span class="dina-dashboard-stats-count"><?php echo dokan_number_format( esc_attr( $pageviews ) ) . ' '; esc_html_e( 'Pageview', 'dokan-lite' ); ?></span>
                    <span class="dina-dashboard-stats-title"><?php esc_html_e( 'Pageview', 'dokan-lite' ); ?></span>
                </span>
            </div>
        </li>
        <li class="col-lg-3 col-md-6 col-12">
            <div class="dina-dashboard-stat-con dina-dashboard-red shadow-box">
                <i class="fal fa-bags-shopping" aria-hidden="true"></i>
                <span class="col-12 dina-stats-con d-flex">
                    <span class="dina-dashboard-stats-count">
                        <?php
                        $status = dokan_withdraw_get_active_order_status();
                        $total = 0;
                        foreach ( $status as $order_status ) {
                            $total += $orders_count->$order_status;
                        }
                        echo esc_html( number_format_i18n( $total, 0 ) ) . ' ';
                        esc_html_e( 'Order', 'dokan-lite' );
                        ?>
                    </span>
                    <span class="dina-dashboard-stats-title"><?php esc_html_e( 'Order', 'dokan-lite' ); ?></span>
                </span>
            </div>
        </li>

        <?php do_action( 'dokan_seller_dashboard_widget_counter' ); ?>
    </ul>
</div> <!-- .big-counter -->

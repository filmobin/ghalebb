<?php
/*
Theme Designed By: Meysam Hosseinkhani
Email: Meysam98@Gmail.com
Author Website: i-design.ir
*/ 

if ( ! defined( 'ABSPATH' ) )
    exit;

foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
    <li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
        <a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>">
            <?php 
                echo ( $endpoint == 'customer-logout' ? __( 'Logout', 'dina-kala' ) : esc_html( $label ) );
            ?>
        </a>
    </li>
<?php endforeach; ?>
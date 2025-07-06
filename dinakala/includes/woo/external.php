<?php

// Remove the default WooCommerce external product Buy Product button on the individual Product page.
remove_action( 'woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30 );

// Add the open in a new browser tab WooCommerce external product Buy Product button.
add_action( 'woocommerce_external_add_to_cart', 'dina_external_add_to_cart', 30 );
function dina_external_add_to_cart() {
    global $product;

    if ( ! $product->add_to_cart_url() ) {
        return;
    }

    $product_url = $product->add_to_cart_url();
    $button_text = $product->single_add_to_cart_text();

    /**
    * The code below outputs the edited button with target="_blank" added to the html markup.
    */
    do_action( 'woocommerce_before_add_to_cart_button' ); ?>

    <p class="cart dina-external-link-con">
        <a href="<?php echo esc_url( $product_url ); ?>" rel="nofollow" class="dina-external-link single_add_to_cart_button button alt" target="_blank">
            <?php echo esc_html( $button_text ); ?>
        </a>
    </p>

<?php
    do_action( 'woocommerce_after_add_to_cart_button' );
}
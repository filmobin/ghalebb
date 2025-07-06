<?php

// admin_otp_test_script
add_action( 'admin_enqueue_scripts', 'dina_admin_otp_test_script' );
function dina_admin_otp_test_script( $page )
{
    if ( ! is_admin() )
        return;

    wp_enqueue_script( 'dina-admin-otp-test-script', DI_URI . '/includes/admin-panel/assets/ajax-test-sms.js', array( 'jquery' ), DI_VER, true );
    wp_localize_script( 'dina-admin-otp-test-script', 'admin_ajax_test_sms_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}

// otp_test_form
function dina_otp_test_form()
{
    ob_start();
    ?>
    <div class="dina-test-sms-sending">
        <input type="text" class="dina-test-sms-number" id="dina-test-sms-number" placeholder="<?php _e( 'Phone number', 'dina-kala' ) ?>">
        <?php $user = wp_get_current_user() ?>
        <span class="button button-primary dina-test-sms-submit" id="dina-test-sms-submit" data-user-id="<?php echo $user->ID ?>">
            <i class="fal fa-envelope"></i>
            <?php _e( 'Send', 'dina-kala' ) ?>
        </span>
        <?php wp_nonce_field( "dina_otp_test_action", "dina_otp_test_nonce" ); ?>
        <div class="dina-test-sms-sending-result"></div>
    </div>
    <?php
    $sms_test_form = ob_get_clean();
    return $sms_test_form;
}

add_action( 'wp_ajax_dina_otp_test_action', 'dina_otp_test_callback' );
function dina_otp_test_callback()
{
    check_ajax_referer( 'dina_otp_test_action', 'security' );
    $userid      = sanitize_text_field( $_POST['userid'] );
    $phonenumber = $_POST['phonenumber'];
    // Verify phone number
    if ( strlen( $phonenumber ) != 11 || ! ( preg_replace('/[^0-9]/', '', wp_unslash( $phonenumber ) ) ) ) {
        echo json_encode([
            'success'      => false,
            'class'        => 'alert alert-danger',
            'message'      => __( 'Phone number is wrong!', 'dina-kala' )
        ]);
        die();
    }

    $log = (new DinakalaLogin)->generateOtpCode( $userid, $phonenumber );
    
    if ( $log ) {
        echo json_encode([
            'success'      => true,
            'message'      => __( 'SMS sent successfully!', 'dina-kala' ),
        ]);
        die();
    } else {
        echo json_encode([
            'success'      => false,
            'message'      => __( 'SMS not sent!', 'dina-kala' ),
        ]);
        die();
    }
}
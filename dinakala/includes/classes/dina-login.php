<?php
// DinakalaLogin
class DinakalaLogin
{
	public static $instance = null;

    // getInstance
	public static function getInstance()
	{
		null === self::$instance AND self::$instance = new self;
		return self::$instance;
	}

	public function __construct()
	{
        // Register Scripts
		add_action( 'wp_loaded', [$this, 'scriptsRegister'] );
		
        // Enqueue Scripts
        add_action( 'wp_enqueue_scripts', array( $this, 'scriptsEnqueue' ) );
        add_action( 'wp_enqueue_scripts', [$this, 'scriptsLocalize'] );
        
        // Ajax Callbacks
		add_action( 'wp_ajax_nopriv_ajax_login_action', [$this, 'login_ajaxCb'] );
		add_action( 'wp_ajax_nopriv_sms_ajax_login_action', [$this, 'sms_ajaxCb'] );
		add_action( 'wp_ajax_nopriv_sms_ajax_token_action', [$this, 'token_ajaxCb'] );
		add_action( 'wp_ajax_nopriv_ajax_register_action', [$this, 'register_ajaxCb'] );
		add_action( 'wp_ajax_nopriv_resend_ajax_token_action', [$this, 'resendToken_ajaxCb'] );
        add_action( 'wp_ajax_force_number_popup_action', [$this, 'numberPopup_ajaxCb'] );
        add_action( 'wp_ajax_force_number_token_action', [$this, 'numberToken_ajaxCb'] );
        add_action( 'wp_ajax_force_resend_token_action', [$this, 'forceResendToken_ajaxCb'] );

        // Add Force Number Popup To Footer
        \fe7f0b55ea269f297164af3d1fb::c5387e5164eaf413af5dce4bd4eebcf($this);

        // Add Phone Number To Users Table
        add_filter( 'manage_users_columns', [$this, 'dina_modify_user_table'] );
        add_filter( 'manage_users_custom_column', [$this, 'dina_modify_user_table_row'] , 10, 3);
        add_action( 'pre_user_query', [$this, 'dina_pre_user_query_for_phone_number'] );

        // Define Shortcode
        add_shortcode( 'dina_login_form', [$this, 'dina_login_form_shortcode'] );       
	}

    // Check if the phone number is valid
    private function isValidPhoneNumber( $phone_number ) {
        $phone_number = trim( $phone_number );
        $phone_number = wp_unslash( $phone_number );
        return preg_match( '/^09\d{9}$/', $phone_number );
    }

    // Helper function to localize script
    private function localize_script( $handle, $object_name, $extra_args = array() ) {
        $default_args = array(
            'ajaxurl'        => admin_url( 'admin-ajax.php' ),
            'loadingmessage' => __( 'Please wait...', 'dina-kala' )
        );
        wp_localize_script( $handle, $object_name, array_merge( $default_args, $extra_args ) );
    }

    // scriptsRegister
	public function scriptsRegister( $page )
	{
        $deps = array( 'jquery' );
		if ( dina_opt( 'recapcha_login' ) && ! empty( dina_opt( 'site_key' ) ) && ! empty( dina_opt( 'site_secret' ) ) ) {
            $recapcha_lang = ( is_rtl() ? 'fa' : 'en' );
            wp_register_script( 'dina-ajax-login-recapcha', 'https://www.google.com/recaptcha/api.js?hl='. $recapcha_lang .'&onload=onloadCallback&render=explicit', array( 'jquery' ), '' , true );
            $deps[] = 'dina-ajax-login-recapcha';
        }
        wp_register_script( 'dina-ajax-login', DI_URI . '/includes/classes/assets/ajax-login-script.js', $deps, DI_VER, true );
        wp_register_script( 'dina-ajax-force-number', DI_URI . '/includes/classes/assets/ajax-force-number.js', array( 'jquery' ), DI_VER, true );
	}

    // scriptsEnqueue
	public function scriptsEnqueue( $page )
	{
		wp_enqueue_script( 'dina-ajax-login' );
        wp_enqueue_script( 'dina-ajax-login-recapcha' );
	}

    // scriptsLocalize
	public function scriptsLocalize( $page )
	{
        $current = get_permalink( get_the_ID() );

        $this->localize_script( 'dina-ajax-login', 'ajax_login_object', array() );
        $this->localize_script( 'dina-ajax-login', 'ajax_register_object', array() );

        if ( dina_opt( 'sms_login_register' ) ) {
            $this->localize_script( 'dina-ajax-login', 'ajax_sms_login_object', array() );
            $this->localize_script( 'dina-ajax-login', 'ajax_sms_token_object', array() );
            $this->localize_script( 'dina-ajax-login', 'ajax_resend_token_object', array() );
            $this->localize_script( 'dina-ajax-force-number', 'ajax_force_number_object', array() );
            $this->localize_script( 'dina-ajax-force-number', 'ajax_force_number_token_object', array(
                'current' => $current,
            ));
            $this->localize_script( 'dina-ajax-force-number', 'ajax_force_resend_token_object', array() );
        }
	}

    // renderForm
	public function renderForm()
	{
        $redirect_to = '';

        if ( ! empty( $_POST['redirect-to'] ) ) {
            $redirect_to = sanitize_text_field( $_POST['redirect-to'] );
        } elseif ( ! empty( $_GET['redirect-to'] ) ) {
            $redirect_to = sanitize_text_field( $_GET['redirect-to'] );
        } elseif ( ! empty( $_GET['redirect_to'] ) ) {
            $redirect_to = sanitize_text_field( $_GET['redirect_to'] );
        }

        if ( ! empty( $redirect_to ) ) {
            $redirect_to = urldecode( $redirect_to );
            $redirect_to = sanitize_url( $redirect_to );
        } elseif ( dina_opt( 'dina_login_redirect' ) ) {
            $redirect_url = dina_opt( 'dina_login_redirect_url' );
            if ( ! empty( $redirect_url ) ) {
                $redirect_to = $redirect_url;
            }
        } else {
            $redirect_to = dina_get_current_page_url();
        }
		?>

        <div class="dina-login-wrapper dina-ajax-form-wrapper d-block">

            <?php
            if ( ! ( dina_opt( 'hide_user_pass_login' ) && dina_opt( 'sms_login_register') ) && ! dina_opt( 'one_click_login_register' ) ) {
                $digits_class = function_exists( 'digits_version' ) && dina_opt( 'digits_mode' ) ? ' digits-login' : '';
                $form_class   = dina_opt( 'sms_login_main' ) ? 'd-none dina_login_form' . $digits_class : 'd-block dina_login_form' . $digits_class;
                ?>
                <form name="login_form" class="<?= $form_class ?>" id="dina_login_form" action="#" method="post">
                    <div class="row">
                        <div class="col-12">
                            <div class="status"></div>
                            <div class="form-group">
                                <i class="fal fa-user" aria-hidden="true"></i>
                                <input name="username" type="text" class="form-control" id="username" autocomplete="email" placeholder="<?php _e( 'Username or email address', 'dina-kala' ); ?>" required="required" />
                            </div>
                            <div class="form-group">
                                <i class="fal fa-key" aria-hidden="true"></i>
                                <input name="password" type="password" class="form-control" id="password" placeholder="<?php _e( 'Password', 'dina-kala' ); ?>" required="required" />
                            </div>
                            <div class="dina-login-links">
                                <a href="<?= dina_reset_pw_url(); ?>" title="<?php _e( 'Reset password', 'dina-kala' ); ?>" class="lost-password"><?php _e( 'Reset password', 'dina-kala' ); ?></a>
                                <?php if ( ! dina_opt( 'remove_registration_link' ) ) { ?>
                                    <?php if ( dina_opt( 'ch_registration_link' ) ) { ?>
                                        <a href="<?php echo dina_opt( 'registration_link' ); ?>" title="<?php _e( 'Create an account', 'dina-kala' ); ?>" class="dina-register-link"><?php _e( 'Create an account', 'dina-kala' ); ?></a>
                                    <?php } else { ?>
                                        <span class="dina-show-register-form"><?php _e( 'Create an account', 'dina-kala' ); ?></span>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                            <?php if ( dina_opt( 'recapcha_login' ) && ! empty( dina_opt( 'site_key' ) ) && ! empty( dina_opt( 'site_secret' ) ) ) { ?>
                                <div id="recaptchaEmailLogin" class="g-recaptcha" data-sitekey="<?php echo dina_opt( 'site_key' ); ?>"></div>
                            <?php } ?>
                            <input type="hidden" name="redirect-to" value="<?= esc_url( $redirect_to ) ?>">
                            <?php wp_nonce_field( "ajax_login_action", "ajax_login_elogin" ); ?>
                            <button class="btn btn-success plogin-btn" id="loginSubmit">
                                <i class="fal fa-user btn-icon" aria-hidden="true"></i><?php _e( 'Login to the site', 'dina-kala' ); ?>
                            </button>
                            <?php if ( dina_opt( 'sms_login_register' ) ) { ?>
                                <span class="btn btn-outline-dina dina-login-phone-btn">
                                    <i class="fal fa-mobile btn-icon" aria-hidden="true"></i><?php _e( 'Login with mobile number', 'dina-kala' ); ?>
                                </span>
                            <?php } ?>
                        </div>
                    </div>
                </form>
            <?php } ?>

            <?php if ( dina_opt( 'sms_login_register') ) {
                $form_class = dina_opt( 'hide_user_pass_login' ) || dina_opt( 'one_click_login_register' ) || dina_opt( 'sms_login_main' ) ? 'd-block dina_login_form' : 'd-none dina_login_form'; ?>
                <form name="sms_login_form" class="<?= $form_class ?>" id="dina_sms_login_form" action="#" method="post">
                    <div class="row">
                        <div class="col-12">
                            <div class="status"></div>
                            <div class="form-group">
                                <i class="fal fa-mobile" aria-hidden="true"></i>
                                <input name="mobile_number" type="tel" autocomplete="tel" class="form-control dina-mobile-number" id="mobile_number" placeholder="<?php _e( 'Mobile number', 'dina-kala' ); ?>" required="required" />
                            </div>

                            <?php if ( ! dina_opt( 'one_click_login_register' ) ) { ?>
                            <div class="dina-login-links">
                                <a href="<?= dina_reset_pw_url(); ?>" title="<?php _e( 'Reset password', 'dina-kala' ); ?>" class="lost-password"><?php _e( 'Reset password', 'dina-kala' ); ?></a>
                                <?php if ( ! dina_opt( 'remove_registration_link' ) ) { ?>
                                    <?php if ( dina_opt( 'ch_registration_link' ) ) { ?>
                                        <a href="<?php echo dina_opt( 'registration_link' ); ?>" title="<?php _e( 'Create an account', 'dina-kala' ); ?>" class="dina-register-link"><?php _e( 'Create an account', 'dina-kala' ); ?></a>
                                    <?php } else { ?>
                                        <span class="dina-show-register-form"><?php _e( 'Create an account', 'dina-kala' ); ?></span>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                            <?php } ?>

                            <?php if ( dina_opt( 'recapcha_login' ) && ! empty( dina_opt( 'site_key' ) ) && ! empty( dina_opt( 'site_secret' ) ) ) { ?>
                                <div id="recaptchaSMSLogin" class="g-recaptcha" data-sitekey="<?php echo dina_opt( 'site_key' ); ?>"></div>
                            <?php } ?>
                            <input type="hidden" name="redirect-to" value="<?= esc_url( $redirect_to ) ?>">
                            <?php wp_nonce_field( "ajax_login_action", "ajax_login_mlogin" ); ?>
                            <button class="btn btn-success mobile-login-btn plogin-btn" id="loginSubmitMobile">
                                <i class="fal fa-user btn-icon" aria-hidden="true"></i><?php echo dina_opt( 'one_click_login_register' ) ? __( 'Login | Register', 'dina-kala' ) : __( 'Login to the site', 'dina-kala' ); ?>
                            </button>
                            <?php if ( ! dina_opt( 'hide_user_pass_login' ) && ! dina_opt( 'one_click_login_register' ) ) { ?>
                                <span class="btn btn-outline-dina dina-login-email-btn">
                                    <i class="fal fa-envelope btn-icon" aria-hidden="true"></i><?php _e( 'Login with username', 'dina-kala' ); ?>
                                </span>
                            <?php } ?>
                        </div>
                    </div>
                </form>
            <?php } ?>

        </div>

        <?php if ( ! dina_opt( 'one_click_login_register' ) ) { ?>
            <div class="dina-register-wrapper dina-ajax-form-wrapper d-none">
                <form name="register_form" class="d-block dina_login_form" id="dina_register_form" action="#" method="post">
                    <div class="row">
                        <div class="col-12">
                            <div class="status"></div>

                            <?php
                            // Name filed
                            if ( dina_opt( 'reg_field_fname' ) != 'hide' ) {
                                $req = dina_opt( 'reg_field_fname' ) == 'required' ? 'required="required" ' : '';
                            ?>
                            <div class="form-group">
                                <i class="fal fa-id-card" aria-hidden="true"></i>
                                <input name="fname" type="text" class="form-control" id="reg_fname" autocomplete="name" placeholder="<?php _e( 'Name', 'dina-kala' ); ?>" <?php echo $req ?>/>
                            </div>
                            <?php } ?>

                            <?php
                            // Last name filed
                            if ( dina_opt( 'reg_field_lname' ) != 'hide' ) {
                                $req = dina_opt( 'reg_field_lname' ) == 'required' ? 'required="required" ' : '';
                            ?>
                            <div class="form-group">
                                <i class="fal fa-id-card" aria-hidden="true"></i>
                                <input name="lname" type="text" class="form-control" id="reg_lname" autocomplete="family-name" placeholder="<?php _e( 'Last name', 'dina-kala' ); ?>" <?php echo $req ?>/>
                            </div>
                            <?php } ?>

                            <?php
                            // Username filed
                            if ( dina_opt( 'reg_field_uname' ) != 'hide' ) {
                                $req = dina_opt( 'reg_field_uname' ) == 'required' ? 'required="required" ' : '';
                            ?>
                            <div class="form-group">
                                <i class="fal fa-user" aria-hidden="true"></i>
                                <input name="username" type="text" class="form-control" id="reg_username" placeholder="<?php _e( 'Username', 'dina-kala' ); ?>" <?php echo $req ?>/>
                            </div>
                            <?php } ?>

                            <?php
                            // Password filed
                            if ( dina_opt( 'reg_field_pass' ) != 'hide' ) {
                                $req = dina_opt( 'reg_field_pass' ) == 'required' ? 'required="required" ' : '';
                            ?>
                            <div class="form-group">
                                <i class="fal fa-key" aria-hidden="true"></i>
                                <input name="password" type="password" class="form-control" id="reg_password" placeholder="<?php _e( 'Password', 'dina-kala' ); ?>" <?php echo $req ?>/>
                            </div>
                            <?php } ?>

                            <?php
                            // Mobile number filed
                            if ( dina_opt( 'reg_field_mobile' ) != 'hide' ) {
                                $req = dina_opt( 'reg_field_mobile' ) == 'required' ? 'required="required" ' : '';
                            ?>
                            <div class="form-group">
                                <i class="fal fa-mobile" aria-hidden="true"></i>
                                <input name="mobile_number" type="tel" autocomplete="tel" class="form-control dina-mobile-number" id="reg_mobile_number" placeholder="<?php _e( 'Mobile number', 'dina-kala' ); ?>" pattern="[0-9]{11}" <?php echo $req ?>/>
                            </div>
                            <?php } ?>

                            <?php
                            // Email filed
                            if ( dina_opt( 'reg_field_email' ) != 'hide' ) {
                                $req = dina_opt( 'reg_field_email' ) == 'required' ? 'required="required" ' : '';
                            ?>
                            <div class="form-group">
                                <i class="fal fa-at" aria-hidden="true"></i>
                                <input name="email" type="email" class="form-control" id="reg_email" autocomplete="email" placeholder="<?php _e( 'Email', 'dina-kala' ); ?>" <?php echo $req ?>/>
                            </div>
                            <?php } ?>
                            
                            <div class="dina-login-links">
                                <a href="<?= dina_reset_pw_url(); ?>" title="<?php _e( 'Reset password', 'dina-kala' ); ?>" class="lost-password"><?php _e( 'Reset password', 'dina-kala' ); ?></a>
                                <span class="dina-show-login-form"><?php _e( 'Login to the site', 'dina-kala' ); ?></span>
                            </div>

                            <?php if ( dina_opt( 'recapcha_login' ) && ! empty( dina_opt( 'site_key' ) ) && ! empty( dina_opt( 'site_secret' ) ) ) { ?>
                                <div id="recaptchaRegsiter" class="g-recaptcha" data-sitekey="<?php echo dina_opt( 'site_key' ); ?>"></div>
                            <?php } ?>
                            <input type="hidden" name="redirect-to" value="<?= esc_url( $redirect_to ) ?>">
                            <?php wp_nonce_field( "ajax_login_action", "ajax_register" ); ?>
                            <button class="btn btn-success plogin-btn" id="registerSubmit">
                                <i class="fal fa-user-plus btn-icon" aria-hidden="true"></i><?php _e( 'Create an account', 'dina-kala' ); ?>
                            </button>

                        </div>
                    </div>
                </form>
            </div>
        <?php
        }
	}

    // renderTokenForm
    public function renderTokenForm( $user_id, $phone )
    {
        ob_start();
        $time        = ( (int)dina_opt( 'resend_code_time' ) ) * 60000 + 1000;
        $redirect_to = isset( $_POST['redirecturl'] ) && ! empty( $_POST['redirecturl'] ) ? sanitize_url( $_POST['redirecturl'] ) : dina_get_current_page_url();
        ?>
        <form name="sms_token_form" class="dina_login_form" id="dina_sms_token_form" action="#" method="post">
            <div class="row">
                <div class="col-12">
                    <div class="status"></div>
                    <div class="dina-otp-container">
                        <?php
                        $otp_digits = (int)dina_opt( 'otp_digits' );
                        for ( $i = 1; $i < $otp_digits; $i++ ) {
                        ?>
                        <input type="tel" name="otp-code[]" class="form-control dina-otp-input" maxlength="1" onfocus="this.select()" oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.nextElementSibling.focus()">
                        <?php } ?>
                        <input type="tel" name="otp-code[]" class="form-control dina-otp-input" maxlength="1" onfocus="this.select()" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                    </div>
                    <?php wp_nonce_field( "ajax_login_action", "ajax_login_token" ); ?>
                    <button class="btn btn-success mobile-login-btn" id="loginSendToken">
                        <i class="fal fa-user btn-icon" aria-hidden="true"></i><?php _e( 'Login to the site', 'dina-kala' ); ?>
                    </button>
                    <span class="btn btn-outline-dina disabled" id="dina-resend-code-btn" data-time="<?php echo $time ?>" aria-disabled="true">
                        <span id="dina-code-timer"></span>
                        <?php _e( 'Resend the code', 'dina-kala' ); ?>
                    </span>
                </div>
            </div>
            <input type="hidden" name="redirect-to" value="<?= esc_url( $redirect_to ) ?>">
            <input type="hidden" name="user_id" value="<?php echo $user_id ?>" />
            <input type="hidden" name="phone_number" value="<?php echo $phone ?>" />
        </form>
        <?php
        return ob_get_clean();
    }

    // renderForceForm
	public function renderForceForm()
	{   
        $user = wp_get_current_user();
        $user_id = $user->ID;
		?>
        <form name="force_number_form" class="dina_login_form" id="dina_force_number_form" action="#" method="post">
            <div class="row">
                <div class="col-12">
                    <div class="status"></div>
                    <div class="form-group">
                        <i class="fal fa-mobile" aria-hidden="true"></i>
                        <input name="mobile_number" type="tel" autocomplete="tel" class="form-control dina-mobile-number" id="mobile_number" placeholder="<?php _e( 'Mobile number', 'dina-kala' ); ?>" required="required" />
                    </div>
                    <?php wp_nonce_field( "ajax_login_action", "force_mobile_number" ); ?>
                    <button class="btn btn-success register-mobile-number-btn" id="registerNumberMobile">
                        <i class="fal fa-mobile btn-icon" aria-hidden="true"></i><?php _e( 'Register number', 'dina-kala' ); ?>
                    </button>
                </div>
            </div>
            <input type="hidden" name="user_id" value="<?php echo $user_id ?>" />
        </form>
        <?php
	}

    // renderForceTokenForm
    public function renderForceTokenForm( $user_id, $phone )
    {
        ob_start();
        $time   = ( (int)dina_opt( 'resend_code_time' ) ) * 60000 + 1000;
        ?>
        <form name="force_token_form" class="dina_login_form" id="dina_force_token_form" action="#" method="post">
            <div class="row">
                <div class="col-12">
                    <div class="status"></div>
                    <div class="dina-otp-container">
                        <?php
                        $otp_digits = (int)dina_opt( 'otp_digits' );
                        for ( $i = 1; $i < $otp_digits; $i++ ) {
                        ?>
                        <input type="tel" name="otp-code[]" class="form-control dina-otp-input" maxlength="1" onfocus="this.select()" oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.nextElementSibling.focus()">
                        <?php } ?>
                        <input type="tel" name="otp-code[]" class="form-control dina-otp-input" maxlength="1" onfocus="this.select()" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                    </div>
                    <?php 
                    wp_nonce_field( "ajax_login_action", "force_mobile_number_token" );
                    wp_nonce_field( "resend_otp_action", "force_resend_token" ); 
                    ?>
                    <button class="btn btn-success mobile-login-btn" id="registerNumberToken">
                        <i class="fal fa-mobile btn-icon" aria-hidden="true"></i><?php _e( 'Register number', 'dina-kala' ); ?>
                    </button>
                    <span class="btn btn-outline-dina disabled" id="dina-resend-code-btn" data-time="<?php echo $time ?>" aria-disabled="true">
                        <span id="dina-code-timer"></span>
                        <?php _e( 'Resend the code', 'dina-kala' ); ?>
                    </span>
                </div>
            </div>
            <input type="hidden" name="user_id" value="<?php echo $user_id ?>" />
            <input type="hidden" name="phone_number" value="<?php echo $phone ?>" />
        </form>
        <?php
        return ob_get_clean();
    }

    // login_form callback
    public function login_ajaxCb( $data )
    {
        // First check the nonce, if it fails the function will break
        check_ajax_referer( "ajax_login_action", 'security' );

        // Check recaptcha response
        if ( isset( $_POST["g-recaptcha-response"] ) && $this->verifyReCaptcha( $_POST["g-recaptcha-response"] ) == false ) {
            echo json_encode( array(
                    'success' => false,
                    'class'    => 'woocommerce-error',
                    'message'  => __( 'Enter Captcha Code!', 'dina-kala' )
                )
            );
            die();
        }

        // Get username or email from input
        $input = sanitize_text_field( $_POST['username'] );
        $password = sanitize_text_field( $_POST['password'] );

        // Check if input is an email
        if ( is_email( $input ) ) {
            // Get user by email
            $user = get_user_by( 'email', $input );
            if ( $user ) {
                $username = $user->user_login;
            } else {
                echo json_encode( array(
                        'success' => false,
                        'class'    => 'woocommerce-error',
                        'message'  => __( 'No account found with this email address!', 'dina-kala' )
                    )
                );
                die();
            }
        } else {
            $username = $input;
        }

        $info                  = array();
        $info['user_login']    = $username;
        $info['user_password'] = $password;
        $info['remember']      = true;
        $user_signon           = wp_signon( $info, is_ssl() );

        if ( is_wp_error( $user_signon ) ) {
            echo json_encode( array(
                    'success' => false,
                    'class'    => 'woocommerce-error',
                    'message'  => __( 'The login details are incorrect!', 'dina-kala' )
                )
            );
        } else {
            wp_set_current_user( $user_signon->ID );
            wp_set_auth_cookie( $user_signon->ID, true, is_ssl() );
            echo json_encode( array(
                    'success' => true,
                    'class'    => 'woocommerce-message',
                    'message'  => __( 'Login was successful...', 'dina-kala' )
                )
            );
        }

        die();
    }


    // Register form callback
	public function register_ajaxCb( $data )
	{
        // First check the nonce, if it fails the function will break
        check_ajax_referer( "ajax_login_action", 'security' );

        // init info
        $username = $password = $email = $name = $phone_number = '';

        // Check recaptcha response
        if ( isset( $_POST["g-recaptcha-response"] ) && $this->verifyReCaptcha( $_POST["g-recaptcha-response"] ) == false ) {
            echo json_encode([
                'success' => false,
                'class'   => 'woocommerce-error',
                'message' => __( 'Enter Captcha Code!', 'dina-kala' )
            ]);
            die();
        }

        // Verify username
        if ( isset( $_POST['username'] ) ) {
            $username = sanitize_user( $_POST['username'] );
            if ( username_exists( $username ) ) {
                echo json_encode([
                    'success'      => false,
                    'class'        => 'woocommerce-error',
                    'message'      => __( 'Username is in use!', 'dina-kala' )
                ]);
                die();
            }
        }

        // Verify phone number
        if ( isset( $_POST['phonenumber'] ) ) {
            $phone_number = dinafa_digits( $_POST['phonenumber'] );
            if ( ! $this->isValidPhoneNumber( $phone_number ) ) {
                echo json_encode([
                    'success'      => false,
                    'class'        => 'woocommerce-error',
                    'message'      => __( 'Phone number is wrong!', 'dina-kala' )
                ]);
                die();
            }
            $username_exists = $this->phoneNumberExist( $phone_number );
            if ( $username_exists ) {
                echo json_encode([
                    'success'      => false,
                    'class'        => 'woocommerce-error',
                    'message'      => __( 'Phone number is in use!', 'dina-kala' )
                ]);
                die();
            }
        }

        // Verify email
        if ( isset( $_POST['email'] ) ) {
            $email = sanitize_email( $_POST['email'] );
            if ( email_exists( $email ) ) {
                echo json_encode([
                    'success'      => false,
                    'class'        => 'woocommerce-error',
                    'message'      => __( 'Email is in use!', 'dina-kala' )
                ]);
                die();
            }
        }

        // Verify name
        if ( isset( $_POST['fname'] ) )
            $fname = sanitize_text_field ( $_POST['fname'] );

        // Verify name
        if ( isset( $_POST['lname'] ) )
            $lname = sanitize_text_field ( $_POST['lname'] );

        // Verify password
        if ( isset( $_POST['password'] ) ) {
            $password        = sanitize_text_field( $_POST['password'] );
            $hashed_password = wp_hash_password( $password );
        }

        if ( ! empty ( $phone_number ) && dina_opt( 'sms_login_register' ) && dina_opt( 'verify_reg_field_mobile' ) ) {
            $user_register = $this->registerUser( $username, $email, $phone_number, $password, $fname, $lname );
            if ( is_wp_error( $user_register ) ) {
                echo json_encode([
                    'success'      => false,
                    'phone_number' => $phone_number,
                    'class'        => 'woocommerce-error',
                    'message'      => __( 'Account creation failed!', 'dina-kala' )
                ]);
                die();
            } else {
                $log = $this->generateOtpCode( $user_register, $phone_number );  // Generate OTP and send SMS
                if ( $log ) {
                    $token_form = $this->renderTokenForm( $user_register, $phone_number );
                    wp_clear_auth_cookie();
                    echo json_encode([
                        'success'      => true,
                        'ID'           => $user_register,
                        'phone_number' => $phone_number,
                        'message'      => __( 'SMS sent successfully!', 'dina-kala' ),
                        'class'        => 'woocommerce-message',
                        'token_form'   => $token_form,
                    ]);
                    die();
                } else {
                    echo json_encode([
                        'success'      => false,
                        'phone_number' => $phone_number,
                        'class'        => 'woocommerce-error',
                        'message'      => __( 'SMS not sent!', 'dina-kala' )
                    ]);
                    die();
                }
            }
        } else {
            $user_register = $this->registerUser( $username, $email, $phone_number, $password, $fname, $lname );
            if ( is_wp_error( $user_register ) ) {
                echo json_encode([
                    'success'      => false,
                    'phone_number' => $phone_number,
                    'class'        => 'woocommerce-error',
                    'message'      => __( 'Account creation failed!', 'dina-kala' )
                ]);
                die();
            } else {
                $user = get_user_by( 'ID', $user_register );

                if ( ! is_wp_error( $user ) ) {
                    wp_set_current_user( $user->ID );
                    wp_set_auth_cookie( $user->ID, true, is_ssl() );

                    echo json_encode([
                        'success'    => true,
                        'class'      => 'woocommerce-message',
                        'inputclass' => 'is-valid',
                        'token_form' => '',
                        'message'    => __( 'Registration was successful...', 'dina-kala' )
                    ]);
                    die();
                } else {
                    echo json_encode([
                        'success'    => false,
                        'class'      => 'woocommerce-error',
                        'inputclass' => 'is-invalid',
                        'message'    => __( 'Registration failed!', 'dina-kala' )
                    ]);
                    die();
                }
            }
        }

	}

    // SMS Ajax Callback
    public function sms_ajaxCb( $data )
	{
        // First check the nonce, if it fails the function will break
        check_ajax_referer( "ajax_login_action", 'security' );

        // Check recaptcha response
        if ( isset( $_POST["g-recaptcha-response"] ) && $this->verifyReCaptcha( $_POST["g-recaptcha-response"] ) == false ) {
            echo json_encode([
                'success' => false,
                'class'   => 'woocommerce-error',
                'message' => __( 'Enter Captcha Code!', 'dina-kala' )
            ]);
            die();
        }

        $phone_number = dinafa_digits( $_POST['phonenumber'] );

        // Verify phone number
        if ( ! $this->isValidPhoneNumber( $phone_number ) ) {
            echo json_encode([
                'success'      => false,
                'phone_number' => $phone_number,
                'class'        => 'woocommerce-error',
                'message'      => __( 'Phone number is wrong!', 'dina-kala' )
            ]);
            die();
        }

        // Check user exists
        $username_exists = $this->phoneNumberExist( $phone_number );
        if ( ! $username_exists && dina_opt( 'one_click_login_register' ) ) {
            $username      = dina_opt( 'default_username_phone' ) ? $phone_number : '';
            $nicename      = dina_opt( 'default_nickname_phone' ) ? $phone_number : '';
            $user_register = $this->registerUser( $username, '', $phone_number, '', $nicename, '' );
            if ( is_wp_error( $user_register ) ) {
                echo json_encode([
                    'success'      => false,
                    'phone_number' => $phone_number,
                    'class'        => 'woocommerce-error',
                    'message'      => __( 'Account creation failed!', 'dina-kala' )
                ]);
                die();
            } else {
                $log = $this->generateOtpCode( $user_register, $phone_number );  // Generate OTP and send SMS
                if ( $log ) {
                    $token_form = $this->renderTokenForm( $user_register, $phone_number );
                    wp_clear_auth_cookie();
                    echo json_encode([
                        'success'      => true,
                        'ID'           => $user_register,
                        'phone_number' => $phone_number,
                        'message'      => __( 'SMS sent successfully!', 'dina-kala' ),
                        'class'        => 'woocommerce-message',
                        'token_form'   => $token_form,
                    ]);
                    die();
                } else {
                    echo json_encode([
                        'success'      => false,
                        'phone_number' => $phone_number,
                        'class'        => 'woocommerce-error',
                        'message'      => __( 'SMS not sent!', 'dina-kala' )
                    ]);
                    die();
                }
            }
        } elseif ( ! $username_exists ) {
            echo json_encode([
                'success'      => false,
                'phone_number' => $phone_number,
                'class'        => 'woocommerce-error',
                'message'      => __( 'There is no user with this phone number', 'dina-kala' )
            ]);
            die();
        } else {
            $log = $this->generateOtpCode( $username_exists, $phone_number );  // Generate OTP and send SMS
            if ( $log ) {
                $token_form = $this->renderTokenForm( $username_exists, $phone_number );
                wp_clear_auth_cookie();
                echo json_encode([
                    'success'      => true,
                    'ID'           => $username_exists,
                    'phone_number' => $phone_number,
                    'message'      => __( 'SMS sent successfully!', 'dina-kala' ),
                    'class'        => 'woocommerce-message',
                    'token_form'   => $token_form,
                ]);
                die();
            } else {
                echo json_encode([
                    'success'      => false,
                    'phone_number' => $phone_number,
                    'class'        => 'woocommerce-error',
                    'message'      => __( 'SMS not sent!', 'dina-kala' )
                ]);
                die();
            }
        }        
	}

    // Verify token Callback
    public function token_ajaxCb( $data )
	{
        // First check the nonce, if it fails the function will break
        check_ajax_referer( "ajax_login_action", 'security' );

        $token        = $_POST['token'];
        $token        = implode( "", array_map( "strval", $token ) );
        $token        = dinafa_digits( $token );
        $user_id      = $_POST['userid'];
        $phone_number = dinafa_digits( $_POST['phonenumber'] );

        if ( isset( $token ) && ! empty( $token ) && ! empty( $user_id ) ) {
            $verifytoken = $this->verifyToken( $token, $user_id );
            if ( $verifytoken === 'expired' ) {
                echo json_encode([
                    'success'      => false,
                    'phone_number' => $phone_number,
                    'class'        => 'woocommerce-error',
                    'inputclass'   => 'is-invalid',
                    'message'      => __( 'The OTP code has expired!', 'dina-kala' )
                ]);
                die();
            } elseif ( $verifytoken === 'wrong' ) {
                echo json_encode([
                    'success'      => false,
                    'phone_number' => $phone_number,
                    'class'        => 'woocommerce-error',
                    'inputclass'   => 'is-invalid',
                    'message'      => __( 'The OTP code is wrong!', 'dina-kala' )
                ]);
                die();
            }
        } else {
            echo json_encode([
                'success'      => false,
                'phone_number' => $phone_number,
                'class'        => 'woocommerce-error',
                'inputclass'   => 'is-invalid',
                'message'      => __( 'The OTP code cannot be empty!', 'dina-kala' )
            ]);
            die();
        }

        $user = get_user_by( 'ID', $user_id );

        if ( ! is_wp_error( $user ) ) {
            wp_set_current_user( $user->ID );
            wp_set_auth_cookie( $user->ID, true, is_ssl() );
            delete_user_meta( $user->ID, 'otp_code' );
            delete_user_meta( $user->ID, 'otp_code_timestamp' );

            echo json_encode([
                'success'    => true,
                'class'      => 'woocommerce-message',
                'inputclass' => 'is-valid',
                'message'    => __( 'Login was successful...', 'dina-kala' )
            ]);
            die();
        } else {
            echo json_encode([
                'success'    => false,
                'class'      => 'woocommerce-error',
                'inputclass' => 'is-invalid',
                'message'    => __( 'Login failed!', 'dina-kala' )
            ]);
            die();
        }
	}

    // Resend Token Ajax Callback
    public function resendToken_ajaxCb( $data )
	{
        // First check the nonce, if it fails the function will break
        check_ajax_referer( "ajax_login_action", 'security' );
        $userid       = $_POST['userid'];
        $phone_number = get_user_meta( $userid, 'billing_phone', true);

        // Check user exists
        $username_exists = $this->phoneNumberExist( $phone_number );
        if ( ! $username_exists ) {
            echo json_encode([
                'success' => false,
                'class'   => 'woocommerce-error',
                'message' => __( 'There is no user with this phone number', 'dina-kala' )
            ]);
            die();
        } else {
            $log = $this->generateOtpCode( $userid, $phone_number );// Generate OTP and send SMS
            if ( $log ) {
                echo json_encode([
                    'success' => true,
                    'message' => __( 'SMS sent successfully!', 'dina-kala' ),
                    'class'   => 'woocommerce-message'
                ]);
                die();
            } else {
                echo json_encode([
                    'success' => false,
                    'class'   => 'woocommerce-error',
                    'message' => __( 'SMS not sent!', 'dina-kala' )
                ]);
                die();
            }
            
        }        
	}

    // Number Popup Callback
    public function numberPopup_ajaxCb( $data )
	{
        // First check the nonce, if it fails the function will break
        check_ajax_referer( "ajax_login_action", 'security' );

        $phone_number = dinafa_digits( $_POST['phonenumber'] );

        // Verify phone number
        if ( ! $this->isValidPhoneNumber( $phone_number ) ) {
            echo json_encode([
                'success'      => false,
                'phone_number' => $phone_number,
                'class'        => 'woocommerce-error',
                'message'      => __( 'Phone number is wrong!', 'dina-kala' )
            ]);
            die();
        }

        // Check user exists
        $username_exists = $this->phoneNumberExist( $phone_number );
        if ( $username_exists ) {
            echo json_encode([
                'success'      => false,
                'phone_number' => $phone_number,
                'class'        => 'woocommerce-error',
                'message'      => __( 'This number belongs to another account!', 'dina-kala' )
            ]);
            die();
        } else {
            $user_id    = $_POST['userid'];
            $log        = $this->generateOtpCode( $user_id, $phone_number ); // Generate OTP and send SMS
            if ( $log ) {
                $token_form = $this->renderForceTokenForm( $user_id, $phone_number );
                echo json_encode([
                    'success'      => true,
                    'ID'           => $user_id,
                    'phone_number' => $phone_number,
                    'message'      => __( 'SMS sent successfully!', 'dina-kala' ),
                    'class'        => 'woocommerce-message',
                    'token_form'   => $token_form,
                ]);
                die();
            } else {
                echo json_encode([
                    'success'      => false,
                    'phone_number' => $phone_number,
                    'class'        => 'woocommerce-error',
                    'message'      => __( 'SMS not sent!', 'dina-kala' )
                ]);
                die();
            }
        }        
	}

    // Number Popup Token Callback
    public function numberToken_ajaxCb( $data )
	{
        // First check the nonce, if it fails the function will break
        check_ajax_referer( "ajax_login_action", 'security' );

        $token        = $_POST['token'];
        $token        = implode( "", array_map( "strval", $token ) );
        $token        = dinafa_digits( $token );
        $user_id      = $_POST['userid'];
        $phone_number = dinafa_digits( $_POST['phonenumber'] );

        if ( isset( $token ) && ! empty( $token ) && ! empty( $user_id ) ) {
            $verifytoken = $this->verifyToken( $token, $user_id);
            if ( $verifytoken === 'expired' ) {
                echo json_encode([
                    'success'      => false,
                    'phone_number' => $phone_number,
                    'class'        => 'woocommerce-error',
                    'inputclass'   => 'is-invalid',
                    'message'      => __( 'The OTP code has expired!', 'dina-kala' )
                ]);
                die();
            } elseif ( $verifytoken === 'wrong' ) {
                echo json_encode([
                    'success'      => false,
                    'phone_number' => $phone_number,
                    'class'        => 'woocommerce-error',
                    'inputclass'   => 'is-invalid',
                    'message'      => __( 'The OTP code is wrong!', 'dina-kala' )
                ]);
                die();
            }
        } else {
            echo json_encode([
                'success'     => false,
                'phone_number' => $phone_number,
                'class'        => 'woocommerce-error',
                'inputclass'   => 'is-invalid',
                'message'      => __( 'The OTP code cannot be empty!', 'dina-kala' )
            ]);
            die();
        }

        $user = get_user_by( 'ID', $user_id );

        if ( ! is_wp_error( $user ) ) {
            update_user_meta( $user->ID, 'billing_phone', $phone_number );
            delete_user_meta( $user->ID, 'otp_code' );
            delete_user_meta( $user->ID, 'otp_code_timestamp' );

            echo json_encode([
                'success'    => true,
                'class'      => 'woocommerce-message',
                'inputclass' => 'is-valid',
                'message'    => __( 'Mobile number added successfully...', 'dina-kala' )
            ]);
            die();
        } else {
            echo json_encode([
                'success'    => false,
                'class'      => 'woocommerce-error',
                'inputclass' => 'is-invalid',
                'message'    => __( 'There was a problem adding the mobile number!', 'dina-kala' )
            ]);
            die();
        }
	}

    // Form Force Number Resend Token Ajax Callback
    public function forceResendToken_ajaxCb( $data )
	{
        // First check the nonce, if it fails the function will break
        check_ajax_referer( "resend_otp_action", 'security' );

        $userid       = $_POST['userid'];
        $phone_number = dinafa_digits( $_POST['phonenumber'] );

        // Check user exists
        $username_exists = $this->phoneNumberExist( $phone_number );
        if ( $username_exists ) {
            echo json_encode([
                'success'      => false,
                'phone_number' => $phone_number,
                'class'        => 'woocommerce-error',
                'message'      => __( 'This number belongs to another account!', 'dina-kala' )
            ]);
            die();
        } else {
            $log = $this->generateOtpCode( $userid, $phone_number ); // Generate OTP and send SMS
            if ( $log ) {
                echo json_encode([
                    'success' => true,
                    'message' => __( 'SMS sent successfully!', 'dina-kala' ),
                    'class'   => 'woocommerce-message'
                ]);
                die();
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => __( 'SMS not sent!', 'dina-kala' ),
                    'class'   => 'woocommerce-error',
                ]);
                die();
            }
        }        
	}

    // verifyReCaptcha
    public function verifyReCaptcha( $recaptcha_response )
    {
        if ( ! dina_opt( 'recapcha_login' ) )
            $recaptcha_code = true;

            $secret    = dina_opt( 'site_secret' );
            $response  = null;
            $reCaptcha = new ReCaptcha( $secret );

            $response = $reCaptcha->verifyResponse(
                $_SERVER["REMOTE_ADDR"],
                $recaptcha_response
            );

            if ( $response != null && ( $response->success) ) {
                $recaptcha_code = true;
            } else {
                $recaptcha_code = false;
            }
        return $recaptcha_code;
    }

    // generateOtpCode
    public function generateOtpCode( $user_id, $phone_number )
    {
        $digits   = (int)dina_opt( 'otp_digits' );
        $otp_code = rand( pow( 10, $digits-1 ), pow( 10, $digits )-1 );
        update_user_meta( $user_id, 'otp_code', $otp_code );
        update_user_meta( $user_id, 'otp_code_timestamp', time() );
        return $this->sendSMS( $phone_number, $otp_code );
    }

    // verifyToken
    public function verifyToken( $token, $user_id )
    {
        $otp_code           = get_user_meta( $user_id, 'otp_code', true);
        $otp_code_timestamp = get_user_meta( $user_id, 'otp_code_timestamp', true);
        $now                = time();
        $passed             = abs( $now - $otp_code_timestamp );
        $timer              = (int)dina_opt( 'resend_code_time' ) * 60;

        if ( $passed > $timer ) {
            return 'expired';
        } elseif ( $otp_code != $token ) {
            return 'wrong';
        }

        return true;
    }

    // phoneNumberExist
    public function phoneNumberExist( $phone_number )
    {        
        $args = array(
            'meta_query' => array(
                array(
                    'key'     => 'billing_phone',
                    'value'   => $phone_number,
                    'compare' => '='
                )
            )
        );

        $users = get_users( $args );

        if ( $users && $users[0] ) {
            return $users[0]->ID;
        }
        
        if ( dina_opt( 'search_digits_users' ) ) {
            $digits_number = ltrim( $phone_number, '0' );
            $args = array(
                'meta_query' => array(
                    array(
                        'key'     => 'digits_phone_no',
                        'value'   => $digits_number,
                        'compare' => '='
                    )
                )
            );

            $users = get_users( $args );
            if ( $users && $users[0] ) {
                update_user_meta( $users[0]->ID, 'billing_phone', $phone_number );
                return $users[0]->ID;
            }
        }

        if ( dina_opt( 'other_otp_plugin' ) && ! empty ( dina_opt( 'other_otp_plugin_key' ) ) ) {
            $digits_number = ltrim( $phone_number, '0' );
            $country_code  = '98' . ltrim( $phone_number, '0' );

            $args = array(
                'meta_query' => array(
                    'relation' => 'OR',
                    array(
                        'key'     => dina_opt( 'other_otp_plugin_key' ),
                        'value'   => $phone_number,
                        'compare' => '='
                    ),
                    array(
                        'key'     => dina_opt( 'other_otp_plugin_key' ),
                        'value'   => $digits_number,
                        'compare' => '='
                    ),
                    array(
                        'key'     => dina_opt( 'other_otp_plugin_key' ),
                        'value'   => $country_code,
                        'compare' => '='
                    )
                )
            );

            $users = get_users( $args );
            if ( $users && $users[0] ) {
                update_user_meta( $users[0]->ID, 'billing_phone', $phone_number );
                return $users[0]->ID;
            }
        }

        return false;
    }

    // registerUser
    public function registerUser( $username = null, $email = null, $phone_number = null, $password = null, $fname = null, $lname = null )
    {
        $name                  = $fname . ' ' . $lname;
        $info                  = array();
        $info['first_name']    = ! empty( $fname ) ? $fname : '';
        $info['last_name']     = ! empty( $lname ) ? $lname : '';
        $info['user_login']    = ! empty( $username ) ? $username : $this->generateUsername();
        $info['user_email']    = ! empty( $email ) ? $email : '';
        $info['user_pass']     = ! empty( $password ) ? $password : '';
        $info['user_nicename'] = ! empty( trim ($name ) ) ? $name : ( $info['nickname'] = $info['display_name'] = $this->generateNickname() );
        $info['role']          = get_option( 'default_role' );
        $user_register         = wp_insert_user( $info );

        if ( is_wp_error( $user_register ) ) {
            return $user_register;
        } else {
            wp_update_user( array( 'ID' => $user_register, 'display_name' => $info['user_nicename'] , 'nickname' => $info['user_nicename']  ) );
            if ( ! empty( $phone_number ) ) {
                update_user_meta( $user_register, 'phone_number', $phone_number );
                update_user_meta( $user_register, '_billing_phone', $phone_number);
                update_user_meta( $user_register, 'billing_phone', $phone_number );
            }
            return $user_register;
        }
    }

    // generateUsername
    public function generateUsername()
    {
        $username = ! empty( dina_opt( 'default_username' ) ) ? dina_opt( 'default_username' ) : 'user';
        
        $check = username_exists( $username );
        if ( ! empty( $check ) ) {
            $suffix = 2;
            while ( ! empty( $check ) ) {
                $alt_username = $username . '-' . $suffix;
                $check        = username_exists( $alt_username );
                $suffix++;
            }
            $username = $alt_username;
        }

        return $username;
    }

    // generateNickname
    public function generateNickname()
    {    
        $nickname = ! empty( dina_opt( 'default_nickname' ) ) ? dina_opt( 'default_nickname' ) : __( 'Site user', 'dina-kala' );
        return $nickname;
    }
	
    // sendSMS
	public function sendSMS( $receptor, $otp_code )
    {
        $username = dina_opt( 'sms_uname' );
        $password = dina_opt( 'sms_password' );
        $apikey   = dina_opt( 'sms_api' );
        $sender   = dina_opt( 'sms_sender_number' );
        $pattern  = dina_opt( 'sms_pattern' );
        $message  = $otp_code; 

        switch ( dina_opt( 'sms_panel' ) ) {
            case 'meli-payamak':
                return $this->sendSMS_MeliPayamak( $username, $password, $receptor, $message, $pattern );
                break;
            case 'faraz-sms':
                return $this->sendSMS_FarazSMS( $username, $password, $sender, $receptor, $message, $pattern );
                break;
            case 'kave-negar-lookup':
                return $this->sendSMS_KavehNegarLookUp( $apikey, $receptor, $pattern, $message );
                break;
            case 'sms-ir':
                return $this->sendSMS_SMSir( $apikey, $receptor, $pattern, $message );
                break;
            case 'rastak-sms':
                return $this->sendSMS_RastakSMS( $apikey, $sender, $receptor, $message, $pattern );
                break;
            case 'raygan-sms':
                return $this->sendSMS_RayganSMS( $apikey, $sender, $receptor, $message, $pattern );
                break;
        }
        return false;
    }

    // sendSMS_FarazSMS
    private function sendSMS_FarazSMS( $username, $password, $sender, $phone_number, $message, $pattern )
    {
        if ( empty( $username ) || empty( $password ) )
            return false;
		
        $phone_number = ltrim( $phone_number, '0' );
        $to           = (array)$phone_number;
        $variable     = dina_opt( 'sms_var' );
        $input_data   = array( $variable => (int)$message );

		$url = "https://ippanel.com/patterns/pattern?username=" . $username . "&password=" . urlencode($password) . "&from=$sender&to=" . json_encode($to) . "&input_data=" . urlencode(json_encode($input_data)) . "&pattern_code=$pattern";

        $handler = curl_init($url);
        curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($handler, CURLOPT_POSTFIELDS, $input_data);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($handler);

        if ( $response > 10000 || $response == 0 )
            return true;
        else
            return false;
    }

    // sendSMS_MeliPayamak
    public function sendSMS_MeliPayamak( $username, $password, $receptor, $message, $pattern )
    {
        if ( empty( $username ) || empty( $password ) )
            return false;

        $data = array(
            'username' => $username,
            'password' => $password,
            'to'       => $receptor,
            "text"     => $message,
            "bodyId"   => $pattern
        );

        $post_data = http_build_query( $data );

        $handle    = curl_init('https://rest.payamak-panel.com/api/SendSMS/BaseServiceNumber');

        curl_setopt($handle, CURLOPT_HTTPHEADER, array(
            'content-type' => 'application/x-www-form-urlencoded'
        ));

        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);

        $response = curl_exec($handle);
        $result   = json_decode( $response );

        return ( $result->RetStatus == 1 ? true : false );
	}

    // sendSMS_KavehNegar
    public function sendSMS_KavehNegarLookUp( $apikey, $receptor, $template, $message ) {

		$response = false;

		if ( empty( $apikey ) )
			return $response;

		$url          = "http://api.kavenegar.com/v1/$apikey/verify/lookup.json?receptor=$receptor&template=$template&token=" . $message;
		$remote       = wp_remote_get( $url );
		$sms_response = wp_remote_retrieve_body( $remote );

		if ( false !== $sms_response ) {
			$json_response = json_decode( $sms_response );
			if ( ! empty( $json_response->return->status ) && $json_response->return->status == 200 ) {
				return true;
			}
		}

		if ( $response !== true ) {
			$response = $sms_response;
		}

		return $response;
	}

    // sendSMS_SMSir
    private function sendSMS_SMSir( $apikey, $receptor, $pattern, $message )
    {
        if ( empty( $apikey ) )
            return false;

        $variable = dina_opt( 'sms_var' );

        $curl = curl_init();

        curl_setopt_array( $curl, array(
            CURLOPT_URL            => 'https://api.sms.ir/v1/send/verify',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_POSTFIELDS     => '{
            "mobile": "'. $receptor .'",
            "templateId": '. $pattern .',
            "parameters": [
            {
                "name": "'. $variable .'",
                "value": "'. $message .'"
            }
            ]
        }',
            CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Accept: text/plain',
            'x-api-key: '. $apikey
            ),
        ));

        $response = curl_exec( $curl );

        curl_close( $curl );

        $result = json_decode( $response );

        return ( $result->status == 1 ? true : false );

    }   

    // sendSMS_sendSMS_RastakSMS
    private function sendSMS_RastakSMS( $apikey, $sender, $phone_number, $message, $pattern )
    {
        if ( empty( $apikey ) )
            return false;
		
        $phone_number = '+98' . ltrim( $phone_number, '0' );
        $to           = (array)$phone_number;
        $variable     = dina_opt( 'sms_var' );
        $input_data   = array( $variable => (int)$message );

        ini_set("soap.wsdl_cache_enabled", "0");
        $soap            = new SoapClient("http://panel.rastaksms.ir/wbs/send.php?wsdl");
        $soap->token     = $apikey;
        $soap->fromNum   = $sender;
        $soap->toNum     = $to;
        $soap->patternID = $pattern;
        $soap->Content   = json_encode( $input_data, JSON_UNESCAPED_UNICODE );
        $soap->Type      = 0;
        $response        = $soap->SendSMSByPattern( $soap->fromNum, $soap->toNum, $soap->Content, $soap->patternID, $soap->Type, $soap->token );
        
        if ( ! empty( $response[0] ) && $response[0] > 100 )
            return true;
        else
            return false;
    }

    // sendSMS_RayganSMS
    public function sendSMS_RayganSMS( $apikey, $sender, $receptor, $message, $pattern ) {

        if ( empty( $apikey ) )
            return false;
    
        $phone_number = '+98' . ltrim( $receptor, '0' );
        $url          = "https://smspanel.trez.ir/SendPatternWithUrl.ashx?AccessHash=$apikey&PhoneNumber=$sender&PatternId=$pattern&RecNumber=$phone_number&Smsclass=1&token1=" . $message;
        $remote       = wp_remote_get( $url );
        $sms_response = wp_remote_retrieve_body( $remote );
    
        if ( $sms_response > 2000 ) {
            return true;
        } else {
            return false;
        }
    
    }

    // dina_login_form_shortcode
    public function dina_login_form_shortcode() {
        if ( is_user_logged_in() )
            return __( 'You are already logged in', 'dina-kala' );

        $this->renderForm();
    }

    // dina_force_number_popup
    public function dina_force_number_popup()
    {
        if ( ! is_user_logged_in() || ! dina_opt( 'sms_login_register' ) || ! dina_opt( 'force_number_popup' ) )
            return;

        $user             = wp_get_current_user();
        $phone_number     = get_user_meta( $user->ID, 'billing_phone', true );
        $digits_phone     = get_user_meta( $user->ID, 'digits_phone_no', true );
        $custom_phone_key = ! empty( dina_opt( 'custom_phone_key' ) ) ? get_user_meta( $user->ID, dina_opt( 'custom_phone_key' ), true ) : '';

        if ( ! empty( $phone_number ) ) {
            return;
        } elseif ( ! empty ( $digits_phone ) ) {
            return;
        } elseif ( ! empty ( $custom_phone_key ) ) {
            return;
        }

        wp_enqueue_script( 'dina-ajax-force-number' );

        ?>
        <div class="modal fade dina-force-number-modal" data-backdrop="static" data-keyboard="false" id="forceNumberModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                <!-- Add Btn Modal Header -->
                <div class="modal-header">
                    <div class="modal-title">
                        <i aria-hidden="true" class="fal fa-mobile"></i>
                        <?php echo dina_opt( 'force_number_popup_title' ) ?>
                    </div>
                </div>

                <!-- Add Btn Modal body -->
                <div class="modal-body dina-force-number-modal-body">
                    <div class="dina-force-number-modal-desc">
                        <?php echo dina_opt( 'force_number_popup_desc') ?>
                    </div>
                    <div class="dina-ajax-form-wrapper">
                        <?php $this->renderForceForm() ?>
                    </div>
                </div>

                </div>
            </div>
        </div>
        <?php
    }

    // dina_modify_user_table
    public function dina_modify_user_table( $column )
    {
        if ( ! dina_opt( 'sms_login_register' ) )
            return $column;
        $column['phone_number'] = __( 'Phone number', 'dina-kala' );
        return $column;
    }

    // Display phone number in user table
    public function dina_modify_user_table_row( $val, $column_name, $user_id ) {
        if ( ! dina_opt( 'sms_login_register' ) )
            return $val;
        switch ( $column_name ) {
            case 'phone_number':
                return get_the_author_meta( 'billing_phone', $user_id );
            default:
                return $val;
        }
    }

    // Pre-user query for phone number
    public function dina_pre_user_query_for_phone_number( $uqi ) {
        global $wpdb;
        $search = isset( $uqi->query_vars['search'] ) ? trim ($uqi->query_vars['search'] ) : '';
        if ( $search ) {
            $search = trim( $search, '*' );
            $the_search = '%' . $search . '%';
            $search_meta = $wpdb->prepare(
                "ID IN (SELECT user_id FROM {$wpdb->usermeta}
                        WHERE (meta_key='billing_phone' AND meta_value LIKE %s))",
                $the_search
            );
            $uqi->query_where = str_replace( 'WHERE 1=1 AND (', "WHERE 1=1 AND ({$search_meta} OR ", $uqi->query_where );
        }
    }
}

new DinakalaLogin;
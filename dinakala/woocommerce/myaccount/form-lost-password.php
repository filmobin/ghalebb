<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.2.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_lost_password_form' );
?>

<form method="post" class="woocommerce-ResetPassword lost_reset_password dina_login_form ">

	<div class="row">
		<div class="col-12">
		<p><?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'dina-kala' ) ); ?></p><?php // @codingStandardsIgnoreLine ?>

			<div class="form-group">
				<i class="fal fa-user" aria-hidden="true"></i>
				<input class="form-control woocommerce-Input woocommerce-Input--text input-text" type="text" name="user_login" id="user_login" placeholder="<?php _e( 'Username or email', 'dina-kala' ); ?>" autocomplete="username" aria-required="true" required="required" />
			</div>

			<?php do_action( 'woocommerce_lostpassword_form' ); ?>

			<input type="hidden" name="wc_reset_password" value="true" />

			<button type="submit" class="btn btn-success plogin-btn" value="<?php esc_attr_e( 'Reset password', 'dina-kala' ); ?>">
				<i class="fal fa-redo btn-icon" aria-hidden="true"></i>
				<?php esc_html_e( 'Reset password', 'dina-kala' ); ?>
			</button>
			
		</div>
	</div>

	<?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>

</form>
<?php
do_action( 'woocommerce_after_lost_password_form' );
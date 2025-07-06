<?php
/**
 * Lost password reset form.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-reset-password.php.
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

do_action( 'woocommerce_before_reset_password_form' );
?>

<form method="post" class="woocommerce-ResetPassword lost_reset_password dina_login_form ">

	<div class="row">
		<div class="col-12">
		<p><?php echo apply_filters( 'woocommerce_reset_password_message', esc_html__( 'Enter a new password below.', 'dina-kala' ) ); ?></p><?php // @codingStandardsIgnoreLine ?>

			<div class="form-group">
				<i class="fal fa-key" aria-hidden="true"></i>
				<input type="password" class="form-control woocommerce-Input woocommerce-Input--text input-text" name="password_1" id="password_1" autocomplete="new-password" placeholder="<?php _e( 'New password', 'dina-kala' ); ?>" aria-required="true" required="required" />
			</div>

			<div class="form-group">
				<i class="fal fa-key" aria-hidden="true"></i>
				<input type="password" class="form-control woocommerce-Input woocommerce-Input--text input-text" name="password_2" id="password_2" autocomplete="new-password" placeholder="<?php _e( 'Re-enter new password', 'dina-kala' ); ?>" aria-required="true" required="required" />
			</div>


			<input type="hidden" name="reset_key" value="<?php echo esc_attr( $args['key'] ); ?>" />
			<input type="hidden" name="reset_login" value="<?php echo esc_attr( $args['login'] ); ?>" />

			<?php do_action( 'woocommerce_resetpassword_form' ); ?>

			<input type="hidden" name="wc_reset_password" value="true" />

			<button type="submit" class="btn btn-success plogin-btn" value="<?php esc_attr_e( 'Save password', 'dina-kala' ); ?>">
				<i class="fal fa-user-unlock btn-icon" aria-hidden="true"></i>
				<?php esc_html_e( 'Save password', 'dina-kala' ); ?>
			</button>
			
		</div>
	</div>

	<?php wp_nonce_field( 'reset_password', 'woocommerce-reset-password-nonce' ); ?>

</form>

<?php
do_action( 'woocommerce_after_reset_password_form' );
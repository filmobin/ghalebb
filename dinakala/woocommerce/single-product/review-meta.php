<?php
/**
 * The template to display the reviewers meta data (name, verified owner, review date)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/review-meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;
global $post;
global $comment;

$verified = wc_review_is_from_verified_owner( $comment->comment_ID );

if ( '0' === $comment->comment_approved ) { ?>

	<p class="meta">
		<em class="woocommerce-review__awaiting-approval">
			<?php esc_html_e( 'Your review is awaiting approval', 'dina-kala' ); ?>
		</em>
	</p>
<?php } else { ?>
	<p class="meta">
		<?php
		$user_id = $comment->user_id;
		?>
		<strong class="woocommerce-review__author"><?php comment_author(); ?></strong>
		<?php
		if ( user_can( $user_id, 'manage_options' ) && ! is_admin() ) {
			echo '<em class="woocommerce-review__verified verified">(' . esc_attr__( 'Admin', 'dina-kala' ) . ')</em> ';
		} elseif ( $post->post_author == $comment->user_id ) {
			echo '<em class="woocommerce-review__verified verified">(' . esc_attr__( 'Seller', 'dina-kala' ) . ')</em> ';
		} elseif ( 'yes' === get_option( 'woocommerce_review_rating_verification_label' ) && $verified ) {
			echo '<em class="woocommerce-review__verified verified">(' . esc_attr__( 'verified owner', 'dina-kala' ) . ')</em> ';
		}
		?>
		<time class="woocommerce-review__published-date" datetime="<?php echo esc_attr( get_comment_date( 'c' ) ); ?>"><?php echo esc_html( get_comment_date( wc_date_format() ) ); ?></time>
	</p>

<?php
}

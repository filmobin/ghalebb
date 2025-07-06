<?php
/*
Theme Designed By: Meysam Hosseinkhani
Email: Meysam98@Gmail.com
Author Website: i-design.ir
*/
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
    exit;

//Dina filter comment fields
add_filter( 'comment_form_default_fields', 'dina_comments_fields' );
function dina_comments_fields( $fields ) {
    if ( isset( $fields['url'] ) && dina_opt( 'comment_remove_url' ) )
        unset( $fields['url'] );
    if ( isset( $fields['email'] ) && dina_opt( 'comment_remove_email' ) )
        unset( $fields['email'] );
    return $fields;
}

function dina_remove_woocommerce_review_fields($comment_fields) {
    if (is_product()) {
        unset($comment_fields['email']);
    }
    return $comment_fields;
}
if ( dina_opt( 'comment_remove_email' ) ) {
    add_filter('woocommerce_product_review_comment_form_args', function( $comment_form ) {
        $comment_form['fields'] = dina_remove_woocommerce_review_fields( $comment_form['fields'] );
        return $comment_form;
    });
}

//Remove Cookie filed from comment form
if ( dina_opt( 'comment_remove_cookie' ) ) {
    remove_action( 'set_comment_cookies', 'wp_set_comment_cookies' );
}

// Add fields after default fields above the comment box, always visible
add_action( 'comment_form_logged_in_after', 'dina_additional_fields' );
add_action( 'comment_form_after_fields', 'dina_additional_fields' );
function dina_additional_fields() {

	dina_comment_phone_field();

	if ( is_single() && 'product' == get_post_type() )
		dina_comment_cons_pros();
}

//Save the comment meta data along with comment
add_action( 'comment_post', 'dina_save_comment_meta_data' );
function dina_save_comment_meta_data( $comment_id ) {
	if ( ( isset( $_POST['comment_phone'] ) ) && ( $_POST['comment_phone'] != '' ) ) {
		$phone = dinafa_digits( $_POST['comment_phone'] );
        $phone = wp_filter_nohtml_kses( $phone );
        $phone = wp_unslash( $phone );
        add_comment_meta( $comment_id, 'comment_phone', $phone );
    }

	if( ( isset ( $_POST['dina-repeater-item-pros'] ) ) && ! empty( $_POST['dina-repeater-item-pros'] ) ) {
		$dina_repeater_item_pros = array_map( 'sanitize_text_field', $_POST['dina-repeater-item-pros'] );
		add_comment_meta( $comment_id, 'dina-repeater-item-pros', $dina_repeater_item_pros );
	}

	if( ( isset ( $_POST['dina-repeater-item-cons'] ) ) && ! empty( $_POST['dina-repeater-item-cons'] ) ) {
		$dina_repeater_item_cons = array_map( 'sanitize_text_field', $_POST['dina-repeater-item-cons'] );
		add_comment_meta( $comment_id, 'dina-repeater-item-cons', $dina_repeater_item_cons );
	}
}

//Add the filter to check comment meta data
add_action( 'pre_comment_on_post', 'dina_verify_comment_meta_data' );
function dina_verify_comment_meta_data() {
	if ( ! dina_opt( 'comment_add_phone' ) )
		return;
	if( is_user_logged_in() && ! dina_opt( 'comment_phone_logged' ) )
		return;
	$phone = isset( $_POST[ 'comment_phone' ] ) ? dinafa_digits( $_POST[ 'comment_phone' ] ) : '';
    if( dina_opt( 'comment_phone_req' ) && ( empty( $phone ) || ! ( preg_replace('/[^0-9]/', '', wp_unslash( $phone ) ) ) ) )
        wp_die( __( 'Please enter a valid phone number.', 'dina-kala' ), '', array( 'back_link' => true ) );
}

//Add an edit option in comment edit screen  
add_action( 'add_meta_boxes_comment', 'dina_comment_add_meta_box' );
function dina_comment_add_meta_box() {
    add_meta_box( 'title', __( 'Comment Metadata', 'dina-kala' ), 'dina_comment_meta_box', 'comment', 'normal', 'high' );
}
 
function dina_comment_meta_box ( $comment ) {

    $phone                   = get_comment_meta( $comment->comment_ID, 'comment_phone', true );
    $dina_repeater_item_pros = get_comment_meta( $comment->comment_ID, 'dina-repeater-item-pros', true );
	$dina_repeater_item_cons = get_comment_meta( $comment->comment_ID, 'dina-repeater-item-cons', true );

    wp_nonce_field( 'dina_comment_update', 'dina_comment_update', false );

	if ( ! empty( $phone ) ) {
    ?>
    <p>
        <label for="comment_phone"><?php _e( 'Phone', 'dina-kala' ); ?></label>
        <input type="text" name="comment_phone" value="<?php echo esc_attr( $phone ); ?>" class="widefat" />
    </p>
	<?php
	}

	if ( ! empty( $dina_repeater_item_pros ) ) {
		echo '<span class="dina-meta-title">'. __( 'Product pros', 'dina-kala' ) .'</span>';
		$i = 0;
		foreach ( $dina_repeater_item_pros as $pros ) {
			if ( isset( $pros ) ) {
			?>
				<p>
					<input type="text" name="dina-repeater-item-pros[<?php echo $i ?>]" value="<?php echo esc_attr( $pros ); ?>" class="widefat" />
				</p>
			<?php
				$i++;
			}
		}
	}

	if ( ! empty( $dina_repeater_item_cons ) ) {
		echo '<span class="dina-meta-title">'. __( 'Product cons', 'dina-kala' ) .'</span>';
		$i = 0;
		foreach ( $dina_repeater_item_cons as $cons ) {
			if ( isset( $cons ) ) {
			?>
				<p>
					<input type="text" name="dina-repeater-item-cons[<?php echo $i ?>]" value="<?php echo esc_attr( $cons ); ?>" class="widefat" />
				</p>
			<?php
				$i++;
			}
		}
	}
}

// Update comment meta data from comment edit screen 
add_action( 'edit_comment', 'dina_comment_edit_metafields' );
function dina_comment_edit_metafields( $comment_id ) {

    if( ! isset( $_POST['dina_comment_update'] ) || ! wp_verify_nonce( $_POST['dina_comment_update'], 'dina_comment_update' ) )
        return;

	if ( ( isset( $_POST['comment_phone'] ) ) && ( $_POST['comment_phone'] != '') ) : 
        $phone = sanitize_text_field( $_POST['comment_phone'] );
        update_comment_meta( $comment_id, 'comment_phone', $phone );
	else :
	    delete_comment_meta( $comment_id, 'comment_phone');
	endif;

	if ( ( isset( $_POST['dina-repeater-item-pros'] ) ) && ( ! empty( $_POST['dina-repeater-item-pros'] ) ) ) : 
        $dina_repeater_item_pros = array_map( 'sanitize_text_field', $_POST['dina-repeater-item-pros'] );
        update_comment_meta( $comment_id, 'dina-repeater-item-pros', $dina_repeater_item_pros );
	else :
	    delete_comment_meta( $comment_id, 'dina-repeater-item-pros' );
	endif;

	if ( ( isset( $_POST['dina-repeater-item-cons'] ) ) && ( ! empty( $_POST['dina-repeater-item-cons'] ) ) ) : 
        $dina_repeater_item_cons = array_map( 'sanitize_text_field', $_POST['dina-repeater-item-cons'] );
        update_comment_meta( $comment_id, 'dina-repeater-item-cons',  $dina_repeater_item_cons );
	else :
	    delete_comment_meta( $comment_id, 'dina-repeater-item-cons' );
	endif;
}

function dina_comment_phone_field() {

	if ( ! dina_opt( 'comment_add_phone' ) )
		return;

	if ( ! dina_opt( 'comment_phone_logged' ) && is_user_logged_in() )
		return;

	$req = dina_opt( 'comment_phone_req' ) ? '<span class="required"> *</span>' : '';
		echo '<p class="comment-form-phone">'.
			'<label for="comment_phone">' . __( 'Phone', 'dina-kala' ) . $req . '</label>
			<input id="comment_phone" name="comment_phone" type="text" size="30"/></p>';
}

function dina_comment_cons_pros() {

	global $product;

	if ( ! dina_opt('comment_pros_cons') )
		return;

	if ( dina_opt('comment_pros_cons_logged' ) && ! is_user_logged_in() )
		return;

	if ( dina_opt('comment_pros_cons_buyers' ) && ! ( wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) )
		return;

	wp_enqueue_script( 'dina-comment-repeater' );
	?>
	<div class="dina-comment-cons-pros">
		
		<div class="dina-repeater-title">
			<?php _e( 'Positive points', 'dina-kala' ) ?>
		</div>

		<div class="dina-repeater-items dina-repeater-items-pros">
			<div class="dina-repeater-item" data-group="dina-repeater-item">
				<input id="pros" name="pros" data-name="pros" type="text" size="26"/>
				<span class="fal fa-trash-alt dina-repeater-remove"></span>
			</div>
			<span class="btn btn-outline-success dina-repeater-add">
				<span class="fal fa-plus"></span>
				<?php _ex( 'Add', 'comment', 'dina-kala' ) ?>
			</span>
		</div>

		<div class="dina-repeater-title">
			<?php _e( 'Negative points', 'dina-kala' ) ?>
		</div>

		<div class="dina-repeater-items dina-repeater-items-cons">
			<div class="dina-repeater-item" data-group="dina-repeater-item">
				<input id="cons" name="cons" data-name="cons" type="text" size="26"/>
				<span class="fal fa-trash-alt dina-repeater-remove"></span>
			</div>
			<span class="btn btn-outline-danger dina-repeater-add">
				<span class="fal fa-plus"></span>
				<?php _ex( 'Add', 'comment', 'dina-kala' ) ?>
			</span>
		</div>

	</div>
	<?php
}

// Add the comment meta to the comment text
add_filter( 'comment_text', 'dina_modify_comment');
function dina_modify_comment( $text ){

	if ( ! dina_opt('comment_pros_cons') )
		return $text;

	$dina_repeater_item_pros = get_comment_meta( get_comment_ID(), 'dina-repeater-item-pros', true );
	$dina_repeater_item_cons = get_comment_meta( get_comment_ID(), 'dina-repeater-item-cons', true );

	ob_start();

	if ( ! empty( $dina_repeater_item_pros ) ) {
		echo '<div class="dina-comment-pros">';
		$i = 0;
		foreach ( $dina_repeater_item_pros as $pros ) {
			if ( isset( $pros ) ) {
			?>
				<div class="dina-comment-pros-item">
					<?php echo $pros ?>
				</div>
			<?php
				$i++;
			}
		}
		echo '</div>';
	}

	if ( ! empty( $dina_repeater_item_cons ) ) {
		echo '<div class="dina-comment-cons">';
		$i = 0;
		foreach ( $dina_repeater_item_cons as $cons ) {
			if ( isset( $cons ) ) {
			?>
				<div class="dina-comment-cons-item">
					<?php echo $cons ?>
				</div>
			<?php
				$i++;
			}
		}
		echo '</div>';
	}

	$content = ob_get_clean();

	if( ! empty( $content ) ) {
		$text = $text . $content;
		return $text;
	} else {
		return $text;		
	}	 
}
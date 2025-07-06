<?php
/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.5.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_account_orders', $has_orders ); ?>

<?php if ( $has_orders ) :

if ( ! dina_opt( 'woo_ac_orders' ) || dina_opt( 'remove_myacc_hooks' ) ) {
?>

	<table class="woocommerce-orders-table woocommerce-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table">
		<thead>
			<tr>
				<?php foreach ( wc_get_account_orders_columns() as $column_id => $column_name ) : ?>
					<th scope="col" class="woocommerce-orders-table__header woocommerce-orders-table__header-<?php echo esc_attr( $column_id ); ?>"><span class="nobr"><?php echo esc_html( $column_name ); ?></span></th>
				<?php endforeach; ?>
			</tr>
		</thead>

		<tbody>
			<?php
			foreach ( $customer_orders->orders as $customer_order ) {
				$order      = wc_get_order( $customer_order ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
				$item_count = $order->get_item_count() - $order->get_item_count_refunded();
				?>
				<tr class="woocommerce-orders-table__row woocommerce-orders-table__row--status-<?php echo esc_attr( $order->get_status() ); ?> order">
					<?php foreach ( wc_get_account_orders_columns() as $column_id => $column_name ) :
						$is_order_number = 'order-number' === $column_id;
					?>
						<?php if ( $is_order_number ) : ?>
							<th class="woocommerce-orders-table__cell woocommerce-orders-table__cell-<?php echo esc_attr( $column_id ); ?>" data-title="<?php echo esc_attr( $column_name ); ?>" scope="row">
						<?php else : ?>
							<td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-<?php echo esc_attr( $column_id ); ?>" data-title="<?php echo esc_attr( $column_name ); ?>">
						<?php endif; ?>

							<?php if ( has_action( 'woocommerce_my_account_my_orders_column_' . $column_id ) ) : ?>
								<?php do_action( 'woocommerce_my_account_my_orders_column_' . $column_id, $order ); ?>

							<?php elseif ( $is_order_number ) : ?>
								<?php /* translators: %s: the order number, usually accompanied by a leading # */ ?>
								<a href="<?php echo esc_url( $order->get_view_order_url() ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'View order number %s', 'dina-kala' ), $order->get_order_number() ) ); ?>">
									<?php echo esc_html( _x( '#', 'hash before order number', 'dina-kala' ) . $order->get_order_number() ); ?>
								</a>

							<?php elseif ( 'order-date' === $column_id ) : ?>
								<time datetime="<?php echo esc_attr( $order->get_date_created()->date( 'c' ) ); ?>"><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></time>

							<?php elseif ( 'order-status' === $column_id ) : ?>
								<?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?>

							<?php elseif ( 'order-total' === $column_id ) : ?>
								<?php
								/* translators: 1: formatted order total 2: total order items */
								echo wp_kses_post( sprintf( _n( '%1$s for %2$s item', '%1$s for %2$s items', $item_count, 'dina-kala' ), $order->get_formatted_order_total(), $item_count ) );
								?>

							<?php elseif ( 'order-actions' === $column_id ) : ?>
								<?php
								$actions = wc_get_account_orders_actions( $order );

								if ( ! empty( $actions ) ) {
									foreach ( $actions as $key => $action ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
										if ( empty( $action['aria-label'] ) ) {
											// Generate the aria-label based on the action name.
											/* translators: %1$s Action name, %2$s Order number. */
											$action_aria_label = sprintf( __( '%1$s order number %2$s', 'dina-kala' ), $action['name'], $order->get_order_number() );
										} else {
											$action_aria_label = $action['aria-label'];
										}
										echo '<a href="' . esc_url( $action['url'] ) . '" class="woocommerce-button' . esc_attr( $wp_button_class ) . ' button ' . sanitize_html_class( $key ) . '" aria-label="' . esc_attr( $action_aria_label ) . '">' . esc_html( $action['name'] ) . '</a>';
										unset( $action_aria_label );
									}
								}
								?>
							<?php endif; ?>

						<?php if ( $is_order_number ) : ?>
							</th>
						<?php else : ?>
							</td>
						<?php endif; ?>
					<?php endforeach; ?>
				</tr>
				<?php
			}
			?>
		</tbody>
	</table>

<?php 
} else {
?>
<section class="woocommerce-my-orders">

	<div id="accordion" class="dina-my-orders-accordion">
		<?php $orderNumber = 1; ?>

		<?php
			foreach ( $customer_orders->orders as $customer_order ) {
				$order      = wc_get_order( $customer_order ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
				$item_count = $order->get_item_count() - $order->get_item_count_refunded();
		?>
			<div class="card woocommerce-orders-table__row--status-<?php echo esc_attr( $order->get_status() ); ?> dina-status-<?php echo esc_attr( $order->get_status() ); ?> order">

				<div class="card-header" id="heading<?php echo $orderNumber; ?>">
				<h5 class="mb-0<?php if ( $orderNumber == 1 ) echo ' dina-ac-open' ?>">
					<button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo $orderNumber; ?>" aria-expanded="true" aria-controls="collapse<?php echo $orderNumber; ?>">
						<?php echo esc_html__( 'Order: ', 'dina-kala' ) . esc_html( _x( '#', 'hash before order number', 'dina-kala' ) . $order->get_order_number() ); ?>
						<span class="dina-accordion-sep">-</span>
						<time datetime="<?php echo esc_attr( $order->get_date_created()->date( 'c' ) ); ?>"><?php echo esc_html( esc_html__( 'Date: ', 'dina-kala' ) . wc_format_datetime( $order->get_date_created() ) ); ?></time>
					</button>
				</h5>
				</div>

				<div id="collapse<?php echo $orderNumber; ?>" class="collapse<?php if ( $orderNumber == 1 ) echo ' show' ?>" aria-labelledby="heading<?php echo $orderNumber; ?>" data-parent="#accordion">
					<div class="card-body dina-accordion-body">

						<div class="col-sm-6 col-12 dina-accordion-extra dina-order-status">
							<div class="dina-accordion-extra-title">
								<i class="fal fa-box" aria-hidden="true"></i>
								<?php _e( 'Status:', 'dina-kala' ) ?>
							</div>
							<div class="dina-accordion-extra-value">
								<?php echo wp_kses_post( wc_get_order_status_name( $order->get_status() ) ); ?>
							</div>
						</div>

						<div class="col-sm-6 col-12 dina-accordion-extra dina-total-value">
							<div class="dina-accordion-extra-title">
								<i class="fal fa-file-invoice-dollar" aria-hidden="true"></i>
								<?php _e( 'Total:', 'dina-kala' ) ?>
							</div>
							<div class="dina-accordion-extra-value">
								<?php echo wp_kses_post( sprintf( _n( '%1$s for %2$s item', '%1$s for %2$s items', $item_count, 'dina-kala' ), $order->get_formatted_order_total(), $item_count ) ); ?>
							</div>
						</div>

						<?php
						$order_items = $order->get_items();
						echo '<ul class="dina-order-details-products">';
						foreach ( $order_items as $order_item ) {
							$product_id = $order_item['product_id'];
							$product = wc_get_product( $product_id );
							if ( $product ) {
								echo '<li><a href="'. get_permalink( $product->get_id() ) .'" title="'. $product->get_name() .'" target="_blank">'. $product->get_image( 'thumbnail' ) .'</a></li>';
							} else {
								echo '';
							}
						}
						echo '</ul>';
						?>

							<?php
							$tracking_code = $order->get_meta( 'tracking_column' );
							$col_class = ! empty ( $tracking_code ) ? 'col-md-6 col-12' : 'col-12';
							if ( ! empty ( $tracking_code ) ) { ?>

							<div class="dina-accordion-extra dina-tracking-extra <?php echo $col_class ?>">
								<div class="dina-accordion-extra-title">
									<i class="<?php echo dina_opt( 'order_tracking_code_icon' ) ?>" aria-hidden="true"></i>
									<?php echo dina_opt( 'order_tracking_code_title' ) . ': ' ?>
								</div>
								<div class="dina-accordion-extra-value">
									<span class="dina-order-tracking-code">
										<span class="dina-order-tracking-text" data-toggle="tooltip" data-placement="top" title="<?php _e( 'Click to copy the code', 'dina-kala' ); ?>">
											<?php echo esc_html( $tracking_code ) ?>
										</span>
										<span class="link-copy"><?php _e( 'Code copied!', 'dina-kala' ) ?></span>
									</span>
								</div>
							</div>

							<?php } ?>
										
							<div class="d-flex <?php echo $col_class ?> dina-order-actions justify-content-end">
								<?php
								$actions = wc_get_account_orders_actions( $order );
								if ( ! empty( $actions ) ) {
									foreach ( $actions as $key => $action ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
										echo '<a href="' . esc_url( $action['url'] ) . '" class="woocommerce-button button view'. esc_attr( $wp_button_class ) .' button dina-order-'. sanitize_html_class( $key ) . '-btn">' . esc_html( $action['name'] ) . '</a>';
									}
								}
								?>
							</div>
					</div>
				</div>

			</div>
			<?php $orderNumber++; ?>
		<?php } ?>
	</div>
</section>
<?php
}

do_action( 'woocommerce_before_account_orders_pagination' ); ?>

	<?php if ( 1 < $customer_orders->max_num_pages ) : ?>
		<div class="woocommerce-pagination woocommerce-pagination--without-numbers woocommerce-Pagination">
			<?php if ( 1 !== $current_page ) : ?>
				<a class="woocommerce-button woocommerce-button--previous woocommerce-Button woocommerce-Button--previous button<?php echo esc_attr( $wp_button_class ); ?>" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page - 1 ) ); ?>"><?php esc_html_e( 'Previous', 'dina-kala' ); ?></a>
			<?php endif; ?>

			<?php if ( intval( $customer_orders->max_num_pages ) !== $current_page ) : ?>
				<a class="woocommerce-button woocommerce-button--next woocommerce-Button woocommerce-Button--next button<?php echo esc_attr( $wp_button_class ); ?>" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page + 1 ) ); ?>"><?php esc_html_e( 'Next', 'dina-kala' ); ?></a>
			<?php endif; ?>
		</div>
	<?php endif; ?>

<?php else : ?>

	<?php wc_print_notice( esc_html__( 'No order has been made yet.', 'dina-kala' ) . ' <a class="woocommerce-Button wc-forward button' . esc_attr( $wp_button_class ) . '" href="' . esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ) . '">' . esc_html__( 'Browse products', 'dina-kala' ) . '</a>', 'notice' ); // phpcs:ignore WooCommerce.Commenting.CommentHooks.MissingHookComment ?>

<?php endif; ?>

<?php do_action( 'woocommerce_after_account_orders', $has_orders ); ?>
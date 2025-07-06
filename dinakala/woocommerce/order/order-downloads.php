<?php
/**
 * Order Downloads.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-downloads.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<?php if ( ! dina_opt( 'woo_ac_downloads' ) || isset( $show_title ) ) { ?>
	<section class="woocommerce-order-downloads">
		<?php if ( isset( $show_title ) ) : ?>
			<h2 class="woocommerce-order-downloads__title"><?php esc_html_e( 'Downloads', 'dina-kala' ); ?></h2>
		<?php endif; ?>
		<table class="woocommerce-table woocommerce-table--order-downloads shop_table shop_table_responsive order_details">
			<thead>
				<tr>
					<?php foreach ( wc_get_account_downloads_columns() as $column_id => $column_name ) : ?>
					<th class="<?php echo esc_attr( $column_id ); ?>"><span class="nobr"><?php echo esc_html( $column_name ); ?></span></th>
					<?php endforeach; ?>
				</tr>
			</thead>

			<?php foreach ( $downloads as $download ) : ?>
				<tr>
					<?php foreach ( wc_get_account_downloads_columns() as $column_id => $column_name ) : ?>
						<td class="<?php echo esc_attr( $column_id ); ?>" data-title="<?php echo esc_attr( $column_name ); ?>">
							<?php
							if ( has_action( 'woocommerce_account_downloads_column_' . $column_id ) ) {
								do_action( 'woocommerce_account_downloads_column_' . $column_id, $download );
							} else {
								switch ( $column_id ) {
									case 'download-product':
										if ( $download['product_url'] ) {
											echo '<a href="' . esc_url( $download['product_url'] ) . '">' . esc_html( $download['product_name'] ) . '</a>';
										} else {
											echo esc_html( $download['product_name'] );
										}
										break;
									case 'download-file':
										echo '<a href="' . esc_url( $download['download_url'] ) . '" class="woocommerce-MyAccount-downloads-file button alt">' . esc_html( $download['download_name'] ) . '</a>';
										break;
									case 'download-remaining':
										echo is_numeric( $download['downloads_remaining'] ) ? esc_html( $download['downloads_remaining'] ) : esc_html__( '&infin;', 'dina-kala' );
										break;
									case 'download-expires':
										if ( ! empty( $download['access_expires'] ) ) {
											echo '<time datetime="' . esc_attr( date( 'Y-m-d', strtotime( $download['access_expires'] ) ) ) . '" title="' . esc_attr( strtotime( $download['access_expires'] ) ) . '">' . esc_html( date_i18n( get_option( 'date_format' ), strtotime( $download['access_expires'] ) ) ) . '</time>';
										} else {
											esc_html_e( 'Never', 'dina-kala' );
										}
										break;
								}
							}
							?>
						</td>
					<?php endforeach; ?>
				</tr>
			<?php endforeach; ?>
		</table>
	</section>
<?php } else { ?>
	<section class="woocommerce-order-downloads">
		<?php if ( isset( $show_title ) ) : ?>
			<h2 class="woocommerce-order-downloads__title"><?php esc_html_e( 'Downloads', 'dina-kala' ); ?></h2>
		<?php endif; ?>

		<div id="accordion" class="dina-download-accordion">
			<?php $downloadNumber = 1; ?>
			<?php foreach ( $downloads as $download ) : ?>
				<div class="card">

					<div class="card-header" id="heading<?php echo $downloadNumber; ?>">
					<h5 class="mb-0">
						<button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo $downloadNumber; ?>" aria-expanded="true" aria-controls="collapse<?php echo $downloadNumber; ?>">
						<?php
						echo get_the_post_thumbnail( $download['product_id'], 'thumbnail' );

							//if ( $download['product_url'] ) {
								//echo '<a href="' . esc_url( $download['product_url'] ) . '">' . esc_html( $download['product_name'] ) . '</a>';
							//} else {
								echo esc_html( $download['product_name'] );
							//}
						?>
						</button>
					</h5>
					</div>

					<div id="collapse<?php echo $downloadNumber; ?>" class="collapse" aria-labelledby="heading<?php echo $downloadNumber; ?>" data-parent="#accordion">
					<div class="card-body dina-accordion-body">

						<div class="col-sm-6 col-12 dina-accordion-extra dina-remaining-downloads">
							<i class="fa fa-tasks" aria-hidden="true"></i>
							<?php
								_e( 'Remaining downloads: ', 'dina-kala' );
								echo is_numeric( $download['downloads_remaining'] ) ? esc_html( $download['downloads_remaining'] ) : esc_html__( '&infin;', 'dina-kala' );
							?>
						</div>

						<div class="col-sm-6 col-12 dina-accordion-extra dina-access-expiration">
							<i class="fa fa-alarm-exclamation" aria-hidden="true"></i>
							<?php
								_e( 'Access Expiration: ', 'dina-kala' );
								if ( ! empty( $download['access_expires'] ) ) {
									echo '<time datetime="' . esc_attr( date( 'Y-m-d', strtotime( $download['access_expires'] ) ) ) . '" title="' . esc_attr( strtotime( $download['access_expires'] ) ) . '">' . esc_html( date_i18n( get_option( 'date_format' ), strtotime( $download['access_expires'] ) ) ) . '</time>';
								} else {
									esc_html_e( 'Never', 'dina-kala' );
								}
							?>
						</div>

						<?php
						$lists = $download['list'];

						if ( empty( $lists ) ) {
							_e( 'No Download Files', 'dina-kala' );
							return;
						}
					
						echo '<ul class="dina-download-list col-12">';
					
						foreach ( $lists as $list ) {
							echo '<li>';
							echo '<a href="' . esc_url( $list['download_url'] ) . '" class="woocommerce-MyAccount-downloads-file">';
							echo esc_html( $list['file_name'] );
							echo '</a></li>';
						}
					
						echo '</ul>';

						 ?>


					</div>
					</div>

				</div>
				<?php $downloadNumber++; ?>
			<?php endforeach; ?>
		</div>
	</section>
<?php } ?>


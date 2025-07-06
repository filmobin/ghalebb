<?php $active_tab = affwp_get_active_affiliate_area_tab(); ?>

<div id="affwp-affiliate-dashboard">

	<?php if ( 'pending' == affwp_get_affiliate_status( affwp_get_affiliate_id() ) ) : ?>

		<p class="affwp-notice"><?php _e( 'Your affiliate account is pending approval', 'affiliate-wp' ); ?></p>

	<?php elseif ( 'inactive' == affwp_get_affiliate_status( affwp_get_affiliate_id() ) ) : ?>

		<p class="affwp-notice"><?php _e( 'Your affiliate account is not active', 'affiliate-wp' ); ?></p>

	<?php elseif ( 'rejected' == affwp_get_affiliate_status( affwp_get_affiliate_id() ) ) : ?>

		<p class="affwp-notice"><?php _e( 'Your affiliate account request has been rejected', 'affiliate-wp' ); ?></p>

	<?php endif; ?>

	<?php if ( 'active' == affwp_get_affiliate_status( affwp_get_affiliate_id() ) ) : ?>

		<?php
		/**
		 * Fires at the top of the affiliate dashboard.
		 *
		 * @since 0.2
		 * @since 1.8.2 Added the `$active_tab` parameter.
		 *
		 * @param int|false $affiliate_id ID for the current affiliate.
		 * @param string    $active_tab   Slug for the currently-active tab.
		 */
		do_action( 'affwp_affiliate_dashboard_top', affwp_get_affiliate_id(), $active_tab );
		?>

		<?php if ( ! empty( $_GET['affwp_notice'] ) && 'profile-updated' == $_GET['affwp_notice'] ) : ?>

			<p class="affwp-notice"><?php _e( 'Your affiliate profile has been updated', 'affiliate-wp' ); ?></p>

		<?php endif; ?>

		<?php
		/**
		 * Fires inside the affiliate dashboard above the tabbed interface.
		 *
		 * @since 0.2
		 * @since 1.8.2 Added the `$active_tab` parameter.
		 *
		 * @param int|false $affiliate_id ID for the current affiliate.
		 * @param string    $active_tab   Slug for the currently-active tab.
		 */
		do_action( 'affwp_affiliate_dashboard_notices', affwp_get_affiliate_id(), $active_tab );
		?>

		<div id="dinaAccountNav" class="woocommerce-MyAccount-navigation-con">
			<?php 
			$menu_position = is_rtl() ? "'right'" : "'left'";
			$user          = wp_get_current_user();
			$edit_profile  = get_option( 'woocommerce_myaccount_edit_account_endpoint', 'edit-account' );
			$before        = dina_opt( 'user_panel_style' ) == 'upanel-one' ? '<a href="javascript:void(0)" class="mclosebtn" aria-label="'. __( 'Close', 'dina-kala' ) .'" data-title="'. __( 'Close', 'dina-kala' ) .'" rel="nofollow" onclick="closeAccountNav('. $menu_position .')"><i class="fal fa-times" aria-hidden="true"></i></a>' : '';
			$before       .= dina_opt( 'user_panel_style' ) == 'upanel-one' && dina_opt( 'dina_dark_mode' ) && dina_opt( 'dina_dark_mode_switch' ) ? '<div class="btn-di-toggle di-toggle-mobile"><i aria-hidden="true" class="di-toggle-icon fal fa-moon" title="'. __( 'Dark mode', 'dina-kala' ) .'"></i><i aria-hidden="true" class="di-toggle-icon fal fa-sun" title="'. __( 'Light mode', 'dina-kala' ) .'"></i></div>' : '';
			$before       .= '<div class="dina-user-avatar-container">';
			$before       .= '<a href="' . esc_url( dina_myaccount_link() . $edit_profile ) .'" class="dina-edit-profile" title="'. __( 'Edit Profile', 'dina-kala' ) .'">';
			$before       .= get_avatar( get_current_user_id() , 120,'' ,$user->display_name );
			$before       .= '<i class="dina-edit-profile-icon fal fa-user-edit" aria-hidden="true"></i>';
			$before       .= '</a>';
			$before       .= '</div>';
			$before       .= '<span class="side-uname">'. $user->display_name .'</span>';

			if ( ! empty ( dina_get_wallet() ) ) {
				$before .= '<span class="m-wallet">'. __( 'Wallet Inventory: ', 'dina-kala' ) . dina_get_wallet() .'</span>';
			}
		
			echo $before;
		
			do_action ( 'dina_after_account_wallet_balance' );
			?>
			<nav class="woocommerce-MyAccount-navigation">
				<ul id="affwp-affiliate-dashboard-tabs">
					<?php

					$tabs = affwp_get_affiliate_area_tabs();

					if ( $tabs ) {
						foreach ( $tabs as $tab_slug => $tab_title ) : ?>
							<?php if ( affwp_affiliate_area_show_tab( $tab_slug ) ) : ?>
							<li class="affwp-affiliate-dashboard-tab<?php echo $active_tab == $tab_slug ? ' active' : ''; ?>">
								<a href="<?php echo esc_url( affwp_get_affiliate_area_page_url( $tab_slug ) ); ?>"><?php echo $tab_title; ?></a>
							</li>
							<?php endif; ?>
						<?php endforeach;
					}

					/**
					 * Fires immediately after core Affiliate Area tabs are output,
					 * but before the 'Log Out' tab is output (if enabled).
					 *
					 * @since 1.0
					 *
					 * @param int    $affiliate_id ID of the current affiliate.
					 * @param string $active_tab   Slug of the active tab.
					 */
					do_action( 'affwp_affiliate_dashboard_tabs', affwp_get_affiliate_id(), $active_tab );
					?>

					<?php if ( affiliate_wp()->settings->get( 'logout_link' ) ) : ?>
					<li class="affwp-affiliate-dashboard-tab">
						<a href="<?php echo esc_url( affwp_get_logout_url() ); ?>"><?php _e( 'Log out', 'affiliate-wp' ); ?></a>
					</li>
					<?php endif; ?>

				</ul>
			</nav>
		</div>
		<?php $menu_position = is_rtl() ? "right" : "left" ?>
		<div id="dinaAccountCanvas" class="overlay3" onclick="closeAccountNav('<?= $menu_position ?>')"></div>
		
		<?php do_action( 'dina_before_myaccount_content' ); ?>
		<div class="woocommerce-MyAccount-content">
			<?php
			if ( ! empty( $active_tab ) && affwp_affiliate_area_show_tab( $active_tab ) ) :
				echo affwp_render_affiliate_dashboard_tab( $active_tab );
			endif;
			?>
		</div>
		<?php do_action( 'dina_after_myaccount_content' ); ?>
		<?php
		/**
		 * Fires at the bottom of the affiliate dashboard.
		 *
		 * @since 0.2
		 * @since 1.8.2 Added the `$active_tab` parameter.
		 *
		 * @param int|false $affiliate_id ID for the current affiliate.
		 * @param string    $active_tab   Slug for the currently-active tab.
		 */
		do_action( 'affwp_affiliate_dashboard_bottom', affwp_get_affiliate_id(), $active_tab );
		?>

	<?php endif; ?>

</div>

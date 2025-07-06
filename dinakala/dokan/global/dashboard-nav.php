<?php
$home_url = home_url();
$active_class = ' class="active"'
?>

<div id="dinaAccountNav" class="col-lg-3 col-12 dashboard-con">
	<?php
	$menu_position = is_rtl() ? "'right'" : "'left'";
	echo dina_opt( 'user_panel_style' ) == 'upanel-one' ? '<a href="javascript:void(0)" class="mclosebtn" aria-label="'. __( 'Close', 'dina-kala' ) .'" data-title="'. __( 'Close', 'dina-kala' ) .'" rel="nofollow" onclick="closeAccountNav('. $menu_position .')"><i class="fal fa-times" aria-hidden="true"></i></a>' : '';
    echo dina_opt( 'user_panel_style' ) == 'upanel-one' && dina_opt( 'dina_dark_mode' ) && dina_opt( 'dina_dark_mode_switch' ) ? '<div class="btn-di-toggle di-toggle-mobile"><i aria-hidden="true" class="di-toggle-icon fal fa-moon" title="'. __( 'Dark mode', 'dina-kala' ) .'"></i><i aria-hidden="true" class="di-toggle-icon fal fa-sun" title="'. __( 'Light mode', 'dina-kala' ) .'"></i></div>' : '';
	?>
	<div class="dashboard-menu-con">
	<?php
		
			$user = wp_get_current_user(); 
			echo get_avatar(get_current_user_id() , 120,'' ,$user->display_name );
		?>
		<span class="side-uname">
			<?php echo $user->display_name; ?>
		</span>

		<?php
		if ( ! empty ( dina_get_wallet() ) ) { 
			echo '<span class="m-wallet">'.__( 'Wallet Inventory: ', 'dina-kala' ). dina_get_wallet() .'</span>';
		} 
		do_action ( 'dina_after_account_wallet_balance' ); 
		?>

		<nav class="customer-dashboard-menu">
			
				<?php
					global $allowedposttags;

					// These are required for the hamburger menu.
					if ( is_array( $allowedposttags ) ) {
						$allowedposttags['input'] = [
							'id'      => [],
							'type'    => [],
							'checked' => []
						];
					}

					echo wp_kses( dokan_dashboard_nav( $active_menu ), $allowedposttags );
				?>
			
		</nav>
	</div>
</div>
<?php $menu_position = is_rtl() ? "right" : "left" ?>
<div id="dinaAccountCanvas" class="overlay3" onclick="closeAccountNav('<?= $menu_position ?>')"></div>
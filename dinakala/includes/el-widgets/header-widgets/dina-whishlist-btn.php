<?php
namespace Elementor;

class Dina_Wishlist_Btn extends Widget_Base {

	public function get_name() {
		return 'dina-wishlist-btn';
	}
	
	public function get_title() {
		return __( 'Wishlist button (Dinakala)', 'dina-kala' );
	}
	
	public function get_icon() {
		return 'fal fa-heart';
	}

	public function get_help_url() {
		return 'https://i-design.ir/docs/dinakala/?p=1062';
	}
	
	public function get_categories() {
		return [ 'dina-kala-header' ];
	}
	
	protected function register_controls() {

		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Wishlist button (Dinakala)', 'dina-kala' ),
			]
		);
		
		$this->add_control(
			'show_items',
			[
				'label' => __( 'Show number of products', 'dina-kala' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'dina-kala' ),
				'label_off' => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_hover_title',
			[
				'label' => __( 'Show title when hovering mouse', 'dina-kala' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'dina-kala' ),
				'label_off' => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        
		$this->end_controls_section();
	}
	
	protected function render() {

        $settings = $this->get_settings_for_display();

        $show_hover_title = $settings['show_hover_title'] === 'yes' ? true : false;
        $show_items       = $settings['show_items'];

		if ( class_exists( 'YITH_WCWL' ) ) {
			$wcwl_url = esc_url( YITH_WCWL()->get_wishlist_url() ); ?>
			<div class="btn-wish di-el-btn-wish dina-yith-wcwl-btn">
				<a href="<?php echo $wcwl_url; ?>" aria-label="<?php _e( 'Wishlist', 'dina-kala' ); ?>" rel="nofollow" class="wish-icon" <?php if ( $show_hover_title ) { ?>data-toggle="tooltip" data-placement="top" title="<?php _e( 'Wishlist', 'dina-kala' ); ?>"<?php } ?>>
					<i aria-hidden="true" class="fal fa-heart"></i>
					<?php if ( $show_items === 'yes' ) { ?>
					<i class="wish-amount"><?php echo do_shortcode( '[yith_wcwl_items_count]' ); ?></i>
					<?php } ?>
				</a>
			</div>
		<?php 
		}
	}
}
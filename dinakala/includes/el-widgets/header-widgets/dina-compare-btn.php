<?php
namespace Elementor;

class Dina_Compare_Btn extends Widget_Base {

    
	public function get_name() {
		return 'dina-compare-btn';
	}
	
	public function get_title() {
		return __( 'Compare button (Dinakala)', 'dina-kala' );
	}
	
	public function get_icon() {
		return 'fal fa-random';
	}

	public function get_help_url() {
		return 'https://i-design.ir/docs/dinakala/?p=1063';
	}
	
	public function get_categories() {
		return [ 'dina-kala-header' ];
	}
	
	protected function register_controls() {

		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Compare button (Dinakala)', 'dina-kala' ),
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

		if ( class_exists( 'YITH_Woocompare' ) ) {
			global $yith_woocompare; ?>
			<div class="btn-compare di-el-btn-compare dina-yith-compare">
				<a href="<?php echo $yith_woocompare->obj->view_table_url() ?>" aria-label="<?php _e( 'Compare Products', 'dina-kala' ); ?>" rel="nofollow" class="compare-icon compare-link" <?php if ( $show_hover_title ) { ?>data-toggle="tooltip" data-placement="top" title="<?php _e( 'Compare Products', 'dina-kala' ); ?>"<?php } ?>>
					<i aria-hidden="true" class="fal fa-random"></i>
				</a>
			</div>
		<?php } elseif ( defined( 'WCCM_VERISON' ) ) {
			$compare_url = wccm_get_compare_page_link( wccm_get_compare_list() );
			$compare_count = count(wccm_get_compare_list() ); ?>
			<div class="btn-compare di-el-btn-compare">
				<a href="<?php echo $compare_url; ?>" aria-label="<?php _e( 'Compare Products', 'dina-kala' ); ?>" rel="nofollow" class="compare-icon compare-link" <?php if ( $show_hover_title ) { ?>data-toggle="tooltip" data-placement="top" title="<?php _e( 'Compare Products', 'dina-kala' ); ?>"<?php } ?>>
					<i aria-hidden="true" class="fal fa-random"></i>
					<?php if ( $show_items === 'yes' ) { ?>
					<i class="compare-amount"><?php echo $compare_count; ?></i>
					<?php } ?>
				</a>
			</div>
		<?php
		}
	}
}
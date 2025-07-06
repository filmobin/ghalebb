<?php
namespace Elementor;

class Dina_Shopping_Cart extends Widget_Base {

    
	public function get_name() {
		return 'dina-shopping-cart';
	}
	
	public function get_title() {
		return __( 'Shopping cart (Dinakala)', 'dina-kala' );
	}
	
	public function get_icon() {
		return 'fal fa-shopping-bag';
	}

	public function get_help_url() {
		return 'https://i-design.ir/docs/dinakala/?p=1061';
	}
	
	public function get_categories() {
		return [ 'dina-kala-header' ];
	}
	
	protected function register_controls() {

		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Shopping cart (Dinakala)', 'dina-kala' ),
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

        $this->add_control(
			'direct_cart_link',
			[
				'label' => __( 'Direct link to shopping cart', 'dina-kala' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'dina-kala' ),
				'label_off' => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);
        
		$this->end_controls_section();
	}
	
	protected function render() {

        $settings = $this->get_settings_for_display();

        $direct_cart_link = $settings['direct_cart_link'];
        $show_hover_title = $settings['show_hover_title'] === 'yes' ? true : false;
        $show_items       = $settings['show_items'];

		?>
        <div class="btn-cart di-el-btn-cart">
            <?php if ( $direct_cart_link != 'yes' ) { ?>
				<span class="shop-icon" <?php if ( $show_hover_title ) { ?>data-toggle="tooltip" data-placement="top" title="<?php _e( 'Shopping cart', 'dina-kala' ); ?>"<?php } ?> onclick="dinaOpenCart()">
					<i aria-hidden="true" class="fal fa-shopping-bag"></i>
					<?php if ( $show_items === 'yes' ) { ?>
						<i class="dina-cart-amount">
							<?php echo dina_cart_amount() ?>
						</i>
					<?php } ?>
				</span>
            <?php } else { ?>
                <a class="shop-icon" <?php if ( $show_hover_title ) { ?>data-toggle="tooltip" data-placement="top"<?php } ?> title="<?php _e( 'Shopping cart', 'dina-kala' ); ?>" href="<?php echo wc_get_cart_url() ?>">
                    <i aria-hidden="true" class="fal fa-shopping-bag"></i>
                    <?php if ( $show_items === 'yes' ) { ?>
                        <i class="dina-cart-amount">
							<?php echo dina_cart_amount() ?>
						</i>
                    <?php } ?>
                </a>
            <?php } ?>
        </div>
        <?php
	}
}
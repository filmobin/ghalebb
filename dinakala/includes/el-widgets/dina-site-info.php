<?php
namespace Elementor;

class Dina_Site_Info extends Widget_Base {
	
	public function get_name() {
		return 'dina-site-info';
	}
	
	public function get_title() {
		return __( 'Site information icon (Dinakala)', 'dina-kala' );
	}
	
	public function get_icon() {
		return 'fal fa-info-circle';
	}

	public function get_help_url() {
		return 'https://i-design.ir/docs/dinakala/?p=1046';
	}
	
	public function get_categories() {
		return [ 'dina-kala' ];
	}
	
	protected function register_controls() {

		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Site information icon (Dinakala)', 'dina-kala' ),
			]
		);
		
		$this->add_control(
			'info_title',
			[
				'label'       => __( 'Title', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter icon title', 'dina-kala' ),
				'default'     => __( 'Title', 'dina-kala' ),
			]
        );

		$this->add_control(
			'info_icon',
			[
				'label'   => __( 'Icon', 'dina-kala' ),
				'type'    => Controls_Manager::SELECT2,
				'options' => dina_elfa_icons(),
				'default' => 'info'
			]
		);

		$this->add_control(
			'inherit_color',
			[
				'label'        => __( 'Inherit the color from the template color', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'color',
			[
				'label'     => __( 'Color', 'dina-kala' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
					'{{WRAPPER}} .dina-info-icon i' => 'color: {{VALUE}}',
				],
				'condition' => [
					'inherit_color' => '',
				],
			]
		);

		$this->add_control(
			'info_image',
			[
				'label' => __( 'Or custom icon (Suitable size: 64px by 64px)', 'dina-kala' ),
				'type'  => Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'info_data_source',
			[
				'label'   => __( 'Data source', 'dina-kala' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'none'           => __( 'None', 'dina-kala' ),
					'products-count' => __( 'Products', 'dina-kala' ),
					'users-count'    => __( 'Members', 'dina-kala' ),
					'sellers-count'  => __( 'Sellers', 'dina-kala' ),
					'sales-count'    => __( 'Order completed', 'dina-kala' ),
					'posts-count'    => __( 'Blog content', 'dina-kala' ),
					'custom-data'    => __( 'Custom data', 'dina-kala' ),
				],
			]
		);

		$this->add_control(
			'custom_data_value',
			[
				'label'       => __( 'Custom data value', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'description' => __( 'You can also use the shortcode', 'dina-kala' ),
				'placeholder' => __( 'Enter custom data value', 'dina-kala' ),
				'default'     => __( 'Value', 'dina-kala' ),
				'condition'   => [
					'info_data_source' => 'custom-data',
				],
			]
        );

		$this->add_control(
			'display_border',
			[
				'label'        => __( 'Display border', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
        
		$this->end_controls_section();
	}
	
	protected function render() {

		//Init
		$settings         = $this->get_settings_for_display();
		$info_title       = $settings['info_title'];
		$info_icon        = $settings['info_icon'];
		$info_image       = $settings['info_image']['url'];
		$info_data_source = $settings['info_data_source'];
		$display_border   = $settings['display_border'] != 'yes' ? ' dina-noborder' : '';

		switch ( $info_data_source ) {

			case 'products-count':
				$count      = wp_count_posts( 'product' );
				$info_value = $count->publish . '+';
				break;

			case 'users-count':
				$count      = count_users();
				$info_value = $count['total_users'] . '+';
				break;

			case 'sellers-count':
				$info_value	= dina_count_sellers() . '+';
				break;

			case 'sales-count':
				$info_value = di_woo_get_total_sales() . '+';
				break;

			case 'posts-count':
				$count      = wp_count_posts( 'post' );
				$info_value = $count->publish . '+';
				break;

			case 'custom-data':
				$info_value = do_shortcode( $settings['custom_data_value'] );
				break;

			default:
				$info_value = '';
		}

		?>

		<div class="dina-info-icon">
			<?php if ( ! empty( $info_image ) ) { ?>
				<img src="<?php echo $info_image; ?>" width="64" height="64" alt="<?php echo $info_title; ?>" class="info-custum-icon<?php echo $display_border; ?>">
			<?php } else { ?>
				<i class="fal fa-<?php echo $info_icon . $display_border; ?>" aria-hidden="true"></i>
			<?php } ?>
			<span class="count-num"><?php echo $info_value; ?></span>
			<span class="count-text"><?php echo $info_title; ?></span>
		</div>

        <?php
	}
}
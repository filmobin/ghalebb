<?php
namespace Elementor;

class Dina_Search_Bar extends Widget_Base {

    
	public function get_name() {
		return 'dina-search-bar';
	}
	
	public function get_title() {
		return __( 'Search bar (Dinakala)', 'dina-kala' );
	}
	
	public function get_icon() {
		return 'fal fa-search';
	}

	public function get_help_url() {
		return 'https://i-design.ir/docs/dinakala/?p=1050';
	}
	
	public function get_categories() {
		return [ 'dina-kala-header' ];
	}
	
	protected function register_controls() {

		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Search bar (Dinakala)', 'dina-kala' ),
			]
		);
		
		$this->add_control(
			'ajax_search',
			[
				'label'        => __( 'Ajax live search', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'search_cat',
			[
				'label'        => __( 'Show Search Category', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'search_cat_sort',
			[
				'label'        => __( 'Sort categories alphabetically', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
				'condition'    => [
                    'search_cat' => 'yes',
                ],
			]
		);

		$this->add_control(
			'search_cat_hierarchical',
			[
				'label'        => __( 'Display hierarchy', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
                    'search_cat' => 'yes',
                ],
			]
		);

		$this->add_control(
			'search_cat_parent',
			[
				'label'        => __( 'Parent categories only', 'dina-kala' ),
				'description'  => __( 'By activating this option, only the first level categories are displayed', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
				'condition'    => [
                    'search_cat' => 'yes',
                ],
			]
		);

		$this->add_control(
			'search_cat_cats',
			[
				'label'       => __( 'Hide categories', 'dina-kala' ),
				'description' => __( 'Selected categories are not displayed in the search box', 'dina-kala' ),
				'type'        => 'dina_autocomplete',
				'search'      => 'dina_get_taxonomies_by_query',
				'render'      => 'dina_get_taxonomies_title_by_id',
				'taxonomy'    => 'product_cat',
				'multiple'    => true,
				'label_block' => true,
				'condition'   => [
					'search_cat' => 'yes',
				],
			]
		);

		$this->add_control(
			'search_others',
			[
				'label'        => __( 'Search pages and posts', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);
        
		$this->end_controls_section();
	}
	
	protected function render() {

        $settings = $this->get_settings_for_display();

		$ajax_search              = $settings['ajax_search'] === 'yes' ? true : false;
		$search_cat               = $settings['search_cat'] === 'yes' ? true : false;
		$search_cat_sort          = $settings['search_cat_sort'] === 'yes' ? true : false;
		$search_cat_hierarchical  = $settings['search_cat_hierarchical'] === 'yes' ? true : false;
		$search_cat_parent        = $settings['search_cat_parent'] === 'yes' ? true : false;
		$search_cat_cats          = $settings['search_cat_cats'] === 'yes' ? true : false;
		$search_others            = $settings['search_others'] === 'yes' ? true : false;

		?>

		<form class="dina-search-bar di-el-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php if ( ! $search_others ) { ?>
				<input type="hidden" name="post_type" value="product" />
			<?php } ?>
			<div class="input-group search-form dina-ajax-search-wrapper">
				<?php 

				if ( class_exists( 'WooCommerce' ) && $search_cat ) {

					$args = array (
						'taxonomy'        => 'product_cat',
						'hide_empty'      => true,
						'show_count'      => 0,
						'hierarchical'    => 1,
						'show_option_all' => __( 'Category', 'dina-kala' ),
						'value_field'     => 'slug',
						'name'            => 'product_cat',
						'class'           => 'product_cat',
						'id'              => 'di-el-search',
						'echo'            => 0
					);

					if ( $search_cat_sort ) {
						$args['orderby'] = 'name';
						$args['order']   = 'ASC';
					}

					if ( $search_cat_parent ) {
						$args['parent'] = 0;
					}

					if ( ! empty ( $search_cat_cats ) ) {
						$args['exclude'] = $search_cat_cats;
					}

					if ( $search_cat_hierarchical ) {
						$args['hierarchical'] = 1;
					}

					$categories = wp_dropdown_categories( $args );

				if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
					?>
					<div class="input-group-before prod-cat">
						<?php echo $categories; ?>
					</div>
				<?php }
				} ?>
				<?php $placeholder = $search_others ? __( 'Search...', 'dina-kala' ) : __( 'Search Products...', 'dina-kala' ) ?>
				<input autocomplete="off"<?php if ( $ajax_search ) { echo ' data-swplive="true"'; } ?> name="s" type="text" class="form-control search-input" placeholder="<?= $placeholder ?>" aria-label="<?php _e("Search", 'dina-kala' ); ?>" required>
				<div class="input-group-append">
					<button class="btn btn-search" type="submit" aria-label="<?php _e("Search", 'dina-kala' ); ?>">
						<i class="fal fa-search" aria-hidden="true"></i>
					</button>
				</div>
			</div>
		</form>

        <?php
	}
}
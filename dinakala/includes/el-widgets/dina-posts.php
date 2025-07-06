<?php
namespace Elementor;

class Dina_Blog_Posts extends Widget_Base {
	
	public function get_name() {
		return 'dina-blog-posts';
	}
	
	public function get_title() {
		return __( 'Blog posts (Dinakala)', 'dina-kala' );
	}
	
	public function get_icon() {
		return 'fal fa-file-alt';
	}

	public function get_help_url() {
		return 'https://i-design.ir/docs/dinakala/?p=1023';
	}
	
	public function get_categories() {
		return [ 'dina-kala' ];
	}
	
	protected function register_controls() {

		//Start Title Section 
		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Title settings', 'dina-kala' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => __( 'Title', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your title', 'dina-kala' ),
			]
		);

		$this->add_control(
			'post_icon',
			[
				'label'   => __( 'Icon', 'dina-kala' ),
				'type'    => Controls_Manager::SELECT2,
				'options' => dina_elfa_icons(),
			]
		);

		$this->add_control(
			'custom_icon',
			[
				'label' => __( 'Or custom icon (Suitable size: 32px by 32px)', 'dina-kala' ),
				'type'  => Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'   => __( 'Block title tag', 'dina-kala' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => [
					'div' => __( 'div', 'dina-kala' ),
					'h1'  => __( 'h1', 'dina-kala' ),
					'h2'  => __( 'h2', 'dina-kala' ),
					'h3'  => __( 'h3', 'dina-kala' ),
					'h4'  => __( 'h4', 'dina-kala' ),
				],
			]
		);

		$this->add_control(
			'hide_desk_title',
			[
				'label'        => __( 'Hide title in desktop mode', 'dina-kala' ),
				'description'  => __( 'Suitable for the case where you consider an image containing a title for the block', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'white_title',
			[
				'label'        => __( 'White title (Suitable for background mode)', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		if ( dina_opt( 'dina_dark_mode' ) ) {
			$this->add_control(
				'dark_title',
				[
					'label'        => __( 'Dark title (Suitable for dark mode and white background)', 'dina-kala' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => __( 'On', 'dina-kala' ),
					'label_off'    => __( 'Off', 'dina-kala' ),
					'return_value' => 'yes',
					'default'      => '',
				]
			);
		}

		$this->add_control(
			'remove_underline',
			[
				'label'        => __( 'Remove the title underline', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'inherit_color',
			[
				'label'        => __( 'Inheriting title border color from template color', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition' => [
					'remove_underline' => '',
				],
			]
		);

		$this->add_control(
			'title_border_color',
			[
				'label'     => __( 'Title border color', 'dina-kala' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#17A2B8',
				'selectors' => [
					'{{WRAPPER}} .block-title' => 'border-bottom-color: {{VALUE}}',
				],
				'condition' => [
					'inherit_color' => '',
				],
			]
		);

		$this->end_controls_section();
		//End Title Section

		//Start Posts Section
		$this->start_controls_section(
			'section_posts',
			[
				'label' => __( 'Posts settings', 'dina-kala' ),
			]
		);

		$this->add_control(
			'post_sort',
			[
				'label'   => __( 'Posts sorting', 'dina-kala' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'latest',
				'options' => [
					'latest'         => __( 'Latest posts', 'dina-kala' ),
					'latest-updated' => __( 'Latest updated posts', 'dina-kala' ),
					'random'         => __( 'Random posts', 'dina-kala' ),
					'viewed'         => __( 'Most viewed posts', 'dina-kala' ),
				],
			]
		);

		$this->add_control(
			'post_filter',
			[
				'label'   => __( 'Post filtering', 'dina-kala' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'category',
				'options' => [
					'category' => __( 'Post category', 'dina-kala' ),
					'tag'      => __( 'Post tag', 'dina-kala' ),
					'post-ids' => __( 'Post ID', 'dina-kala' ),
				],
			]
		);

		$this->add_control(
			'post_cat',
			[
				'label'       => __( 'Posts category', 'dina-kala' ),
				'type'        => 'dina_autocomplete',
				'search'      => 'dina_get_taxonomies_by_query',
				'render'      => 'dina_get_taxonomies_title_by_id',
				'taxonomy'    => 'category',
				'multiple'    => true,
				'label_block' => true,
				'condition'   => [
					'post_filter'   => 'category',
				],
			]
		);

		$this->add_control(
			'post_tag',
			[
				'label'       => __( 'Post tag', 'dina-kala' ),
				'type'        => 'dina_autocomplete',
				'search'      => 'dina_get_taxonomies_by_query',
				'render'      => 'dina_get_taxonomies_title_by_id',
				'taxonomy'    => 'post_tag',
				'multiple'    => true,
				'label_block' => true,
				'condition'   => [
					'post_filter'   => 'tag',
				],
			]
		);

		$this->add_control(
			'post_ids',
			[
				'label'       => __( 'Post ID', 'dina-kala' ),
				'description' => __( 'If you have defined the post filter on the post ID, enter the desired ID(s) in this box (separate the IDs with a "," sign, for example 145,12,6)', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Post(s) ID', 'dina-kala' ),
				'condition'   => [
					'post_filter' => 'post-ids',
				],
			]
		);

		$this->add_control(
			'hide_no_post',
			[
				'label'        => __( 'Hide the block if there is no post', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'ptotalcount',
			[
				'label'   => __( 'Posts total count', 'dina-kala' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 1,
				'max'     => 200,
				'step'    => 1,
				'default' => 8,
			]
		);

		$this->add_control(
			'pcount',
			[
				'label'   => __( 'Slider columns count', 'dina-kala' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 1,
				'max'     => 6,
				'step'    => 1,
				'default' => 5,
			]
		);

		$this->add_control(
			'pcount_mobile',
			[
				'label'   => __( 'Number of mobile columns', 'dina-kala' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __( 'Default', 'dina-kala' ),
					'1'       => __( 'One column', 'dina-kala' ),
					'2'       => __( 'Two columns', 'dina-kala' ),
				],
			]
		);

		$this->add_control(
			'view_all',
			[
				'label'        => __( 'Display view all button (If category or tag selected)', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'view_all_link',
			[
				'label'         => __( 'View all button custom link', 'dina-kala' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'dina-kala' ),
				'show_external' => true,
				'default'       => [
					'url'         => '',
					'is_external' => true,
					'nofollow'    => false,
				],
				'condition'     => [
					'view_all' => 'yes',
				],
			]
        );

		$this->end_controls_section();
		//End Posts Section

		//Start Animation Section
		$this->start_controls_section(
			'animation_section',
			[
				'label' => __( 'Animation settings', 'dina-kala' ),
			]
		);

		$this->add_control(
			'show_arrows',
			[
				'label'        => __( 'Show Arrows', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'arrows_style',
			[
				'label'   => __( 'Arrows display style', 'dina-kala' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __( 'Default', 'dina-kala' ),
					'stone'   => __( 'Style one', 'dina-kala' ),
					'sttwo'   => __( 'Style two', 'dina-kala' ),
				],
			]
		);

		$this->add_control(
			'auto_play',
			[
				'label'        => __( 'Auto play', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'time',
			[
				'label'     => __( 'Auto play speed(ms)', 'dina-kala' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1000,
				'max'       => 20000,
				'step'      => 1000,
				'default'   => 8000,
				'condition' => [
					'auto_play' => 'yes',
				],
			]
		);

		$this->add_control(
			'pause_over',
			[
				'label'        => __( 'Pause slider on mouse over', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'slide_by',
			[
				'label'   => __( 'Items displayed when scrolling', 'dina-kala' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 1,
				'max'     => 40,
				'step'    => 1,
				'default' => 1,
			]
		);

		$this->add_control(
			'post_loop',
			[
				'label'        => __( 'Posts loop', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->end_controls_section();
		//End Animation Section

        //Start Style Section
		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Style settings', 'dina-kala' ),
			]
		);

		$this->add_control(
			'white_box',
			[
				'label'        => __( 'White box style', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->end_controls_section();
		//End Style Section

	}
	
	protected function render() {
		$settings = $this->get_settings_for_display();
		$navtype  = 'default' === $settings['arrows_style'] ? dina_opt( 'prod_navs' ) : $settings['arrows_style'];
		
		$block_classes  = '';
		$block_classes .= ( empty( $settings['title'] ) && $navtype == 'stone' ? ' nav-type-one' : '' ); 
		$block_classes .= ( $navtype == 'sttwo' ? ' nav-type-two' : '' );
		$block_classes .= ( 'yes' === $settings['white_title'] ? ' white-title' : '' );
		$block_classes .= ( isset( $settings['dark_title'] ) && 'yes' === $settings['dark_title'] ? ' dark-title' : '' );
		$block_classes .= ( 'yes' === $settings['white_box'] ? ' white-box' : '' );
		$block_classes .= ( 'yes' === $settings['hide_desk_title'] ? ' hide-desk-title' : '' );
		$block_classes .= ( 'yes' === $settings['hide_desk_title'] && $navtype == 'stone' ? ' hide-desk-title-one' : '' ); ?>
		
		<div class="post-block<?php echo $block_classes; ?>">
		<?php
		$post_sort     = $settings['post_sort'];
		$post_filter   = $settings['post_filter'];
		$post_cat      = $settings['post_cat'];
		$post_tag      = $settings['post_tag'];
		$view_all_link = '';

			switch ( $post_sort ) {
				case 'latest':
					$args = array(
						'posts_per_page' => $settings['ptotalcount'],
						'post_type'      => 'post',
						'post_status'    => 'publish',
						'order'          => 'DESC'  );
					break;
				case 'latest-updated':
					$args = array(
						'posts_per_page'      => $settings['ptotalcount'],
						'post_type'           => 'post',
						'post_status'         => 'publish',
						'orderby'             => 'modified',
						'ignore_sticky_posts' => '1',
						'order'               => 'DESC'  );
					break;
				case 'viewed':
					$args = array(
						'posts_per_page' => $settings['ptotalcount'],
						'post_type'      => 'post',
						'post_status'    => 'publish',
						'meta_key'       => dina_opt( 'views_meta_key' ),
						'orderby'        => 'meta_value_num',
						'order'          => 'DESC'  );
					break;
				case 'random':
					$args = array(
						'posts_per_page' => $settings['ptotalcount'],
						'post_type'      => 'post',
						'post_status'    => 'publish',
						'orderby'        => 'rand'  );
					break;
				default:
				$args = array(
						'posts_per_page' => $settings['ptotalcount'],
						'post_type'      => 'post',
						'post_status'    => 'publish',
						'order'          => 'DESC'  );
				}
				if ( $post_filter ) {
					if ( $post_filter == 'category' && ! empty( $post_cat) ) {
						$args['tax_query'] = array(
							array(
							'taxonomy' => 'category',
							'field'    => 'term_id',
							'terms'    => $post_cat
							)
						);
						$view_all_link = dina_get_term_links( 'category', $post_cat );
					} elseif ( $post_filter == 'tag' && ! empty( $post_tag) ) {
						$args['tax_query'] = array(
							array(
							'taxonomy' => 'post_tag',
							'field'    => 'term_id',
							'terms'    => $post_tag
							)
						);
						$view_all_link = dina_get_term_links( 'post_tag',$post_tag);
					}
				}

				$args[] = array(
					'no_found_rows'          => true,
					'update_post_term_cache' => false
				);

				if ( $settings['post_filter'] == 'post-ids' && ! empty( $settings['post_ids'] ) ) {
					$args['post__in'] = explode( ',', $settings['post_ids'] );
				}
			
			$postsquery = new \WP_Query( $args );
		?>
		
		<?php if ( $postsquery->have_posts() ) { ?>
		<?php if ( ! empty( $settings['title'] ) ) { ?>
			<div class="block-title<?php if ( $settings['remove_underline'] ) echo ' block-title-not-line' ?>">
				<?php echo ! isset ( $settings['title_tag'] ) ? '<h2 class="block-title-con">' : '<' . $settings['title_tag'] . ' class="block-title-con">'; ?>
					<?php if ( ! empty( $settings['custom_icon']['url'] ) ) { ?>
						<img src="<?php echo $settings['custom_icon']['url']; ?>" width="32" height="32" alt="<?php echo $settings['title']; ?>" class="cust-icon">
					<?php } else { ?>
						<i class="fal fa-<?php echo $settings['post_icon']; ?>" aria-hidden="true"></i>
					<?php } ?>
					<?php echo $settings['title']; ?>
				<?php echo ! isset ( $settings['title_tag'] ) ? '</h2>' : '</' . $settings['title_tag'] . '>'; ?>

				<?php
				if ( ! empty ( $settings['view_all_link']['url'] ) ) {
					$target        = ! empty ( $settings['view_all_link']['is_external'] ) ? ' target="_blank"' : '';
					$nofollow      = ! empty ( $settings['view_all_link']['nofollow'] ) ? ' rel="nofollow"' : '';
					$view_all_link = $settings['view_all_link']['url'];
				?>
					<a href="<?php echo $view_all_link; ?>" class="pview-all"<?php echo $target . $nofollow; ?>>
						<?php _e( 'View All' , 'dina-kala' ); ?>
						<i class="fal fa-chevron-left" aria-hidden="true"></i>
					</a>
				<?php } elseif ( 'yes' === $settings['view_all'] && $view_all_link != '' ) { ?>
					<a href="<?php echo $view_all_link; ?>" class="pview-all">
						<?php _e( 'View All' , 'dina-kala' ); ?>
						<i class="fal fa-chevron-left" aria-hidden="true"></i>
					</a>
				<?php } ?>
			</div>
		<?php } ?>
		
		<?php
			if ( $settings['pcount_mobile'] == 'default' ) {
				$mobile_col = dina_opt( 'mobile_single_col' ) ? ' data-mcol="1"' : ' data-mcol="2"';
			} else {
				$mobile_col = ' data-mcol="'. $settings['pcount_mobile'] .'"';
			}
			$carousel_options  = '';
			$carousel_options .= $mobile_col;
			$carousel_options .= 'yes' === $settings['show_arrows'] ? ' data-itemnavs="true"' : ' data-itemnavs="false"'; 
			$carousel_options .= 'yes' === $settings['post_loop'] ? ' data-itemloop="true"' : ' data-itemloop="false"'; 
			$carousel_options .= 'yes' === $settings['auto_play'] ? ' data-itemplay="true" data-itemtime="'. $settings['time'] .'"' : ' data-itemplay="false"'; 
			$carousel_options .= 'yes' === $settings['pause_over'] ? ' data-itemover="true"' : ' data-itemover="false"'; 
			$carousel_options .= ! empty ( $settings['pcount'] ) ? ' data-itemscount="'. $settings['pcount'] .'"' : ' data-itemscount="5"';
			$carousel_options .= ! empty ( $settings['slide_by'] ) ? ' data-item-slideby="'. $settings['slide_by'] .'"' : ' data-item-slideby="1"';
			$carousel_options .= ' data-dir="'. dina_rtl() .'"';
		?>
		
		<div class="owl-carousel" <?php echo $carousel_options; ?>>
		
		<?php while ( $postsquery->have_posts() ) : $postsquery->the_post(); ?>
			<div class="item">
				<?php get_template_part( 'includes/content-post' ); ?>
			</div>
        <?php endwhile; ?>
        </div>

		<?php 
		} else {
			$no_post_class = ( 'yes' === $settings['hide_no_post'] ? ' not-dina-hide-section' : '' );
			echo '<div class="col-12 not-msg'. $no_post_class .'">'.__( 'No post with the desired conditions was found.', 'dina-kala' ).'</div>';
		}
		
		wp_reset_postdata();
		?>
        </div>
        <?php

	}

}
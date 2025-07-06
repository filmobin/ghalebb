<?php
namespace Elementor;

class Dina_Blog_Posts_Grid extends Widget_Base {
	
	public function get_name() {
		return 'dina-blog-posts-grid';
	}
	
	public function get_title() {
		return __( 'Blog posts grid (Dinakala)', 'dina-kala' );
	}
	
	public function get_icon() {
		return 'fal fa-th';
	}

	public function get_help_url() {
		return 'https://i-design.ir/docs/dinakala/?p=1024';
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
			'middle_title',
			[
				'label'        => __( 'Show title in the middle', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
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
					'{{WRAPPER}} .block-title-con' => 'border-bottom-color: {{VALUE}}',
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
				'default' => 10,
			]
		);

		$this->add_control(
			'pcount',
			[
				'label'   => __( 'Posts columns count', 'dina-kala' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 2,
				'max'     => 5,
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

		$block_classes  = '';
		$block_classes .= ( 'yes' === $settings['white_title'] ? ' white-title' : '' );
		$block_classes .= ( isset( $settings['dark_title'] ) && 'yes' === $settings['dark_title'] ? ' dark-title' : '' );
		$block_classes .= ( 'yes' === $settings['white_box'] ? ' white-box' : '' );
		$block_classes .= ( 'yes' === $settings['middle_title'] ? ' dina-middle-title' : '' );
		?>
        <div class="post-block-grid<?php echo $block_classes; ?>">
		<?php
		$post_sort   = $settings['post_sort'];
		$post_filter = $settings['post_filter'];
		$post_cat    = $settings['post_cat'];
		$post_tag    = $settings['post_tag'];
			switch ( $post_sort) {
				case 'latest':
					$args = array(
						'posts_per_page' => $settings['ptotalcount'],
						'post_type'      => 'post',
						'post_status'    => 'publish',
						'order'          => 'DESC' 
					);
					break;
				case 'viewed':
					$args = array(
						'posts_per_page' => $settings['ptotalcount'],
						'post_type'      => 'post',
						'post_status'    => 'publish',
						'meta_key'       => dina_opt( 'views_meta_key' ),
						'orderby'        => 'meta_value_num',
						'order'          => 'DESC'
					);
					break;
				case 'random':
					$args = array(
						'posts_per_page' => $settings['ptotalcount'],
						'post_type'      => 'post',
						'post_status'    => 'publish',
						'orderby'        => 'rand'
					);
					break;
				default:
				$args = array(
					'posts_per_page' => $settings['ptotalcount'],
					'post_type'      => 'post',
					'post_status'    => 'publish',
					'order'          => 'DESC'
				);

			}

				if ( $post_filter ) {
					if ( $post_filter == 'category' && ! empty( $post_cat ) ) {
						$args['tax_query'] = array(
							array(
							'taxonomy' => 'category',
							'field'    => 'term_id',
							'terms'    => $post_cat
							)
						);
						$view_all_link = dina_get_term_links( 'category', $post_cat );
					} elseif ( $post_filter == 'tag' && ! empty( $post_tag ) ) {
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
				
			$postsquery  = new \WP_Query( $args );
			$title_class = 'yes' === $settings['remove_underline'] ? 'block-title-con block-title-not-line' : 'block-title-con';
		?>
		
		<?php if ( $postsquery->have_posts() ) { ?>
		<?php if ( ! empty( $settings['title'] ) ) { ?>
			<?php echo ! isset ( $settings['title_tag'] ) ? '<h2 class="'. $title_class .'">' : '<' . $settings['title_tag'] . ' class="'. $title_class .'">'; ?>
				<?php if ( ! empty( $settings['custom_icon']['url'] ) ) { ?>
					<img src="<?php echo $settings['custom_icon']['url']; ?>" width="32" height="32" alt="<?php echo $settings['title']; ?>" class="cust-icon">
				<?php } else { ?>
					<i class="fal fa-<?php echo $settings['post_icon']; ?>" aria-hidden="true"></i>
				<?php } ?>
				<?php echo $settings['title']; ?>
			<?php echo ! isset ( $settings['title_tag'] ) ? '</h2>' : '</' . $settings['title_tag'] . '>'; ?>
		<?php } ?>
		<div class="row">
			<?php while ( $postsquery->have_posts() ) : $postsquery->the_post(); ?>

				<?php 
					if ( $settings['pcount'] == 2 ) {
						$pclasses = 'col-6';
					} elseif ( $settings['pcount'] == 3 ) {
						$pclasses = 'col-md-4 col-6';
					} elseif ( $settings['pcount'] == 4 ) {
						$pclasses = 'col-md-3 col-6';
					} elseif ( $settings['pcount'] == 5 ) {
						$pclasses = 'col-p-5 col-md-3 col-6';
					}
					
					if ( ( dina_opt( 'mobile_single_col' ) && $settings['pcount_mobile'] == 'default' ) || ( $settings['pcount_mobile'] == '1' ) ) {
						$pclasses .= ' mobile-single-col';
					}
				?>
			
				<div class="<?php echo $pclasses; ?> mini-post-con">
					<?php get_template_part( 'includes/content-post' ); ?>
				</div>

			<?php endwhile; ?>
        </div>
		<?php if ( ! empty ( $settings['view_all_link']['url'] ) ) {
			$target = ! empty ( $settings['view_all_link']['is_external'] ) ? ' target="_blank"' : '';
			$nofollow = ! empty ( $settings['view_all_link']['nofollow'] ) ? ' rel="nofollow"' : '';
			$view_all_link = $settings['view_all_link']['url'];
		?>
			<a href="<?php echo $view_all_link; ?>" class="btn btn-outline-dina pgview-all"<?php echo $target . $nofollow; ?>>
				<?php _e( 'View All Posts' , 'dina-kala' ); ?>
				<i class="fal fa-chevron-left" aria-hidden="true"></i>
			</a>
		<?php } elseif ( 'yes' === $settings['view_all'] && $view_all_link != '' ) { ?>
			<a href="<?php echo $view_all_link; ?>" class="btn btn-outline-dina pgview-all">
				<?php _e( 'View All Posts' , 'dina-kala' ); ?>
				<i class="fal fa-chevron-left" aria-hidden="true"></i>
			</a>
		<?php } ?>
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
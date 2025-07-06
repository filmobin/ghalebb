<?php
namespace Elementor;

class Dina_Text_Ticker extends Widget_Base {
	
	public function get_name() {
		return 'dina-text-ticker';
	}
	
	public function get_title() {
		return __( 'Text Ticker (Dinakala)', 'dina-kala' );
	}
	
	public function get_icon() {
		return 'fal fa-text-height';
	}

	public function get_help_url() {
		return 'https://i-design.ir/docs/dinakala/?p=1047';
	}
	
	public function get_categories() {
		return [ 'dina-kala' ];
	}

	public function get_script_depends() {
		return [ 'dina-easy-ticker' ];
	}
	
	protected function register_controls() {

		//Start Title Section
		$this->start_controls_section(
			'title_section',
			[
				'label' => __( 'Title settings', 'dina-kala' ),
			]
		);

		$this->add_control(
			'show_title',
			[
				'label'        => __( 'Show title', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'tickers_title',
			[
				'label'       => __( 'Title', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'title', 'dina-kala' ),
				'condition'   => [
					'show_title' => 'yes'
				],
			]
		);

		$this->add_control(
			'tickers_icon',
			[
				'label'   => __( 'Title icon', 'dina-kala' ),
				'type'    => Controls_Manager::SELECT2,
				'options' => dina_elfa_icons(),
			]
		);

		$this->end_controls_section();
		//End Title Section

		//Start Tickers Section
		$this->start_controls_section(
			'tickers_section',
			[
				'label' => __( 'Tickers settings', 'dina-kala' ),
			]
		);

		$this->add_control(
			'titles_source',
			[
				'label'   => __( 'Source of titles', 'dina-kala' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'manual',
				'options' => [
					'manual' => __( 'Manual', 'dina-kala' ),
					'posts'  => __( 'Posts', 'dina-kala' )
				],
			]
		);

		$this->add_control(
			'titles_rows',
			[
				'label'   => __( 'Number of rows', 'dina-kala' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 1,
				'max'     => 200,
				'step'    => 1,
				'default' => 1,
			]
		);

		//Posts Ticker
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
				'condition' => [
					'titles_source' => 'posts',
				]
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
				'condition' => [
					'titles_source' => 'posts',
				]
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
					'titles_source' => 'posts',
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
					'titles_source' => 'posts',
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
					'post_filter'   => 'post-ids',
					'titles_source' => 'posts',
				],
			]
		);

		$this->add_control(
			'ptotalcount',
			[
				'label'     => __( 'Posts total count', 'dina-kala' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 200,
				'step'      => 1,
				'default'   => 8,
				'condition' => [
					'titles_source' => 'posts',
				],
			]
		);

		$this->add_control(
			'publication_date',
			[
				'label'        => __( 'Display the publication date', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
				'condition'    => [
					'titles_source' => 'posts',
				],
			]
		);

		//Manual Tickers
		$ticker = new Repeater();

		$ticker->add_control(
			'ticker_title',
			[
				'label'       => __( 'Ticker title', 'dina-kala' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$ticker->add_control(
			'ticker_link',
			[
				'label'         => __( 'Ticker link', 'dina-kala' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'dina-kala' ),
				'show_external' => true,
				'default'       => [
					'url'         => '',
					'is_external' => false,
					'nofollow'    => false,
				],
			]
        );

		$ticker->add_control(
			'ticker_date',
			[
				'label'        => __( 'Scheduling the ticker show', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$ticker->add_control(
			'ticker_date_start',
			[
				'label'          => __( 'Start time', 'dina-kala' ),
				'type'           => Controls_Manager::DATE_TIME,
				'picker_options' => [
					'enableTime' => false,
				],
				'condition'      => [
					'ticker_date' => 'yes',
				],
			]
		);

		$ticker->add_control(
			'ticker_date_end',
			[
				'label'          => __( 'End time', 'dina-kala' ),
				'type'           => Controls_Manager::DATE_TIME,
				'picker_options' => [
					'enableTime' => false,
				],
				'condition'      => [
					'ticker_date' => 'yes',
				],
			]
		);
		//Manual Tickers

		$this->add_control(
			'tickers',
			[
				'label'   => __( 'Tickers', 'dina-kala' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $ticker->get_controls(),
				'default' => [
					[
						'ticker_title' => __( 'Ticker title', 'dina-kala' ),
						'ticker_link'  => __( 'https://your-link.com', 'dina-kala' ),
					],
				],
				'title_field' => '{{{ ticker_title }}}',
				'condition'   => [
					'titles_source' => 'manual',
				]
			]
		);

		$this->end_controls_section();
		//End Tickers Section



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



		//Start Animation Section
		$this->start_controls_section(
			'animation_section',
			[
				'label' => __( 'Animation settings', 'dina-kala' ),
			]
		);

		$this->add_control(
			'direction',
			[
				'label'   => __( 'Direction of movement', 'dina-kala' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'up',
				'options' => [
					'up'   => __( 'Up', 'dina-kala' ),
					'down' => __( 'Down', 'dina-kala' )
				],
			]
		);

		$this->add_control(
			'animation_speed',
			[
				'label'   => __( 'Animation speed', 'dina-kala' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'medium',
				'options' => [
					'slow'   => __( 'Slow', 'dina-kala' ),
					'medium' => __( 'Medium', 'dina-kala' ),
					'fast'   => __( 'Fast', 'dina-kala' )
				],
			]
		);

		$this->add_control(
			'animation_interval',
			[
				'label'   => __( 'Interval', 'dina-kala' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 0,
				'max'     => 50000,
				'step'    => 1000,
				'default' => 5000,
			]
		);

		$this->add_control(
			'pause_over',
			[
				'label'        => __( 'Pause ticker on mouse over', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);
        
		$this->end_controls_section();
		//End Animation Section
	}
	
	protected function render() {

		$settings         = $this->get_settings_for_display();

		$block_classes   = array();
		$block_classes[] = 'dina-ticker-wrapper';
		$block_classes[] = ( 'yes' === $settings['white_box'] ? 'shadow-box white-box' : '' );
		

		$ticker_options   = array();
		$ticker_options[] = 'data-direction="'. $settings['direction'] .'"';
		$ticker_options[] = 'data-speed="'. $settings['animation_speed'] .'"';
		$ticker_options[] = 'data-interval="'. $settings['animation_interval'] .'"';
		$ticker_options[] = 'data-rows="'. $settings['titles_rows'] .'"';
		$ticker_options[] = $settings['pause_over'] === 'yes' ? 'data-pause-over="true"' : 'data-pause-over="false"';

		if ( $settings['titles_source'] === 'manual' && ! empty ( $settings['tickers'] ) ) {

			$tickers = array();

			foreach ( $settings['tickers'] as $ticker ) {

				if ( $ticker['ticker_date'] === 'yes' ) {

					$timezone = get_option( 'timezone_string' );
					date_default_timezone_set( $timezone );

					$currentDate = date( 'Y-m-d' );
					$currentDate = date( 'Y-m-d', strtotime( $currentDate ) );

					$dateBegin = date( 'Y-m-d', strtotime( $ticker['ticker_date_start'] ) );
					$dateEnd   = date( 'Y-m-d', strtotime( $ticker['ticker_date_end'] ) );
						
					if ( ( $currentDate >= $dateBegin ) && ( $currentDate <= $dateEnd ) ) {
						$tickers[] = $ticker;
					}

				} else {
					$tickers[] = $ticker;
				}

			}
		} elseif ( $settings['titles_source'] === 'posts' ) {

			$post_sort   = $settings['post_sort'];
			$post_filter = $settings['post_filter'];
			$post_cat    = $settings['post_cat'];
			$post_tag    = $settings['post_tag'];

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
						$view_all_link = dina_get_term_links( 'post_tag',$post_tag );
					}
				}

				$args[] = array(
					//'fields'                    => 'ids',
					'no_found_rows'          => true,
					'update_post_term_cache' => false
				);

				if ( $settings['post_filter'] == 'post-ids' && ! empty( $settings['post_ids'] ) ) {
					$args['post__in'] = explode( ',', $settings['post_ids'] );
				}
			
			$postsquery = new \WP_Query( $args );
		}
		?>
		<div class="<?php echo implode( ' ', $block_classes ); ?>">
			<?php if ( $settings['show_title'] === 'yes' ) { ?>
			<div class="dina-ticker-title">
				<i class="fal fa-<?php echo $settings['tickers_icon']; ?> dina-ticker-icon"></i>
				<?php echo $settings['tickers_title']; ?>
			</div>
			<?php } ?>
			<div class="dina-text-ticker" <?php echo implode( ' ', $ticker_options ); ?>>
				<ul>
		<?php
		if ( $settings['titles_source'] === 'manual' && ! empty( $tickers ) ) {
			foreach ( $tickers as $ticker ) {
			?>
				<li class="dina-ticker-item">
					<?php if ( ! empty( $ticker['ticker_link']['url'] ) ) {
						$target   = ! empty ( $item['ticker_link']['is_external'] ) ? ' target="_blank"' : '';
						$nofollow = ! empty ( $item['ticker_link']['nofollow'] ) ? ' rel="nofollow"' : '';
						?>
						<a href="<?php echo $ticker['ticker_link']['url']; ?>" title="<?php echo $ticker['ticker_title']; ?>"<?php echo $target . $nofollow; ?>>
					<?php }

					echo $ticker['ticker_title'];

					if ( ! empty( $ticker['ticker_link']['url'] ) ) { ?>
					</a>
					<?php } ?>						
				</li>
			<?php }
		} elseif ( $settings['titles_source'] === 'posts' && $postsquery->have_posts() ) {
			while ( $postsquery->have_posts() ) : $postsquery->the_post();
			?>
				<li class="dina-ticker-item">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" target="<?php echo dina_link_target(); ?>">
						<?php the_title(); ?>
					</a>	
					<?php if ( $settings['publication_date'] === 'yes' ) {
						echo '<span class="dina-ticker-date">( '. get_jdate_publish_time_two( 'j F Y' ) .' )</span>'; 
					} ?>
				</li>
			<?php endwhile;
		}
		?>
				</ul>
			</div>
		</div>
		<?php
		wp_reset_postdata();
	}
}
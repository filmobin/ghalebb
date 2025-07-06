<?php
namespace Elementor;

class Dina_Header_Logo extends Widget_Base {

    
	public function get_name() {
		return 'dina-header-logo';
	}
	
	public function get_title() {
		return __( 'Header logo (Dinakala)', 'dina-kala' );
	}
	
	public function get_icon() {
		return 'fal fa-image-polaroid';
	}

	public function get_help_url() {
		return 'https://i-design.ir/docs/dinakala/?p=1049';
	}
	
	public function get_categories() {
		return [ 'dina-kala-header' ];
	}
	
	protected function register_controls() {

		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Header logo (Dinakala)', 'dina-kala' ),
			]
		);

		$this->add_control(
			'site_logo',
			[
				'label'        => __( 'Your logo', 'dina-kala' ),
				'type'         => Controls_Manager::MEDIA,
				'description'  => __( 'Upload your site logo from this section. Appropriate size: 160 pixel(w) in 57 pixel(h)', 'dina-kala' ),
				'default'      => [
					'url' => get_template_directory_uri()."/images/logo.png",
				],
			]
		);

		$this->add_control(
			'site_logo_retina',
			[
				'label'        => __( 'Retina logo', 'dina-kala' ),
				'type'         => Controls_Manager::MEDIA,
				'description'  => __( 'Upload a site logo in a two-dimensional size to the current logo. Appropriate size: 320 pixel(w) in 114 pixel(h)', 'dina-kala' ),
				'default'      => [
					'url' => get_template_directory_uri()."/images/logo2x.png",
				],
			]
		); 
		
		if ( dina_opt( 'dina_dark_mode' ) ) {
			$this->add_control(
				'ch_dark_site_logo',
				[
					'label'        => __( 'Change logo in dark mode', 'dina-kala' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => __( 'On', 'dina-kala' ),
					'label_off'    => __( 'Off', 'dina-kala' ),
					'return_value' => 'yes',
					'default'      => '',
				]
			);

			$this->add_control(
				'dark_site_logo',
				[
					'label'        => __( 'Dark mode logo', 'dina-kala' ),
					'type'         => Controls_Manager::MEDIA,
					'description'  => __( 'Upload your dark mode site logo from this section. Appropriate size: 160 pixel(w) in 57 pixel(h)', 'dina-kala' ),
					'default'      => [
						'url' => get_template_directory_uri()."/images/logo.png",
					],
					'condition'   => [
						'ch_dark_site_logo' => 'yes',
					],
				]
			);

			$this->add_control(
				'dark_site_logo_retina',
				[
					'label'        => __( 'Dark mode retina logo', 'dina-kala' ),
					'type'         => Controls_Manager::MEDIA,
					'description'  => __( 'Upload your dark mode site logo in a two-dimensional size to the current logo. Appropriate size: 320 pixel(w) in 114 pixel(h)', 'dina-kala' ),
					'default'      => [
						'url' => get_template_directory_uri()."/images/logo2x.png",
					],
					'condition'    => [
						'ch_dark_site_logo' => 'yes',
					],
				]
			);
		}

		$this->add_control(
			'add_home_heading',
			[
				'label'        => __( 'Add an H1 tag to the logo', 'dina-kala' ),
				'description'  => __( 'Add an H1 tag to the logo on the home page', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'change_logo_link',
			[
				'label'        => __( 'Change logo link', 'dina-kala' ),
				'description'  => __( 'With this option, you can change the default link of the logo that is connected to the main page of your site', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'logo_link',
			[
				'label'         => __( 'Logo link', 'dina-kala' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'dina-kala' ),
				'show_external' => true,
				'default' => [
					'url' => '#',
					'is_external' => false,
					'nofollow' => false,
				],
				'condition' => [
                    'change_logo_link' => 'yes',
                ],
			]
        );
        
		$this->end_controls_section();
	}
	
	protected function render() {

        $settings = $this->get_settings_for_display();

		$site_logo        = $settings['site_logo']['url'];
		$site_logo_retina = $settings['site_logo_retina']['url'];
		$add_home_heading = $settings['add_home_heading'] === 'yes' ? true : false;

		$image_attributes = wp_get_attachment_metadata( $settings['site_logo']['id'] );
		$width            = ( isset( $image_attributes['width'] ) ? $image_attributes['width'] : '' );
		$height           = ( isset( $image_attributes['height'] ) ? $image_attributes['height'] : '' );

		$ch_dark_site_logo = $settings['ch_dark_site_logo'] === 'yes' ? true : false;

		if ( dina_opt( 'dina_dark_mode' ) && $ch_dark_site_logo ) {
			$dark_site_logo        = $settings['dark_site_logo']['url'];
			$dark_site_logo_retina = $settings['dark_site_logo_retina']['url'];
			$image_attributes      = wp_get_attachment_metadata( $settings['dark_site_logo']['id'] );
			$dark_width            = ( isset( $image_attributes['width'] ) ? $image_attributes['width'] : '' );
			$dark_height           = ( isset( $image_attributes['height'] ) ? $image_attributes['height'] : '' );
		}

		$change_logo_link = $settings['change_logo_link'] === 'yes' ? true : false;
		$logo_link        = ( $change_logo_link ? $settings['logo_link']['url'] : esc_url( home_url() ) );
		$logo_target      = isset ( $settings['logo_link']['is_external'] ) ? ' target="_blank"' : '';
		$logo_nofollow    = isset ( $settings['logo_link']['nofollow'] ) ? ' rel="nofollow"' : 'rel="home"';

		if ( is_front_page() && $add_home_heading ) { echo '<h1>'; } ?>

		<a href="<?php echo $logo_link; ?>" title="<?php bloginfo( 'name' ); ?> | <?php bloginfo( 'description' ); ?>" class="dina-logo-link di-el-site-logo" <?php echo $logo_target . $logo_nofollow; ?>>

		<?php
			$logo_src        = dina_to_https( $site_logo );
			$logo_retina_src = ( ! empty( $site_logo_retina ) ) ? dina_to_https( $site_logo_retina ) : $logo_src;
			$logo_width      = ( ! empty( $width ) ) ? $width : '160';
			$logo_height     = ( ! empty( $height ) ) ? $height : '57';
			$alt_text        = get_post_meta( $settings['site_logo']['id'], '_wp_attachment_image_alt', true);
            $alt             = ! empty( $alt_text  ) ? $alt_text  : get_bloginfo( 'name' ) . ' | ' . get_bloginfo( 'description' );
			$light_style     = ( dina_opt( 'dina_dark_mode' ) && $ch_dark_site_logo ) ? ' dina-light-logo' : '';
			$logo_schema     = dina_opt( 'site_schema' ) ? 'itemprop="logo"' : '';
		?>

			<img <?php echo $logo_schema; ?>
			src="<?php echo $logo_src; ?>"
			srcset="<?php echo $logo_retina_src; ?> 2x"
			width="<?php echo $logo_width; ?>"
			height="<?php echo $logo_height; ?>"
			alt="<?php echo $alt; ?>"
			title="<?php echo $alt; ?>"
			class="img-logo<?php echo $light_style ?>"/>

			<?php
			if ( dina_opt( 'dina_dark_mode' ) && $ch_dark_site_logo ) {
				$logo_src        = dina_to_https( $dark_site_logo );
				$logo_retina_src = ( ! empty( $dark_site_logo_retina ) ) ? dina_to_https( $dark_site_logo_retina ) : $logo_src;
				$logo_width      = ( ! empty( $dark_width ) ) ? $dark_width : '160';
				$logo_height     = ( ! empty( $dark_height ) ) ? $dark_height : '57';
				$logo_schema     = dina_opt( 'site_schema' ) ? 'itemprop="logo"' : '';
			?>

				<img <?php echo $logo_schema; ?>
				src="<?php echo $logo_src; ?>"
				srcset="<?php echo $logo_retina_src; ?> 2x"
				width="<?php echo $logo_width; ?>"
				height="<?php echo $logo_height; ?>"
				alt="<?php echo $alt; ?>"
				title="<?php echo $alt; ?>"
				class="img-logo dina-dark-logo"/>

			<?php } ?>

			<strong><?php bloginfo( 'name' ); ?> | <?php bloginfo( 'description' ); ?> </strong>
		</a>
			
	<?php	if ( is_front_page() && $add_home_heading ) { echo '</h1>'; }
	}
}
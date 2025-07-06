<?php
namespace Elementor;

class Dina_Social_Links extends Widget_Base {
	
	public function get_name() {
		return 'dina-social-links';
	}
	
	public function get_title() {
		return __( 'Social links (Dinakala)', 'dina-kala' );
	}
	
	public function get_icon() {
		return 'fal fa-share-alt';
	}

	public function get_help_url() {
		return 'https://i-design.ir/docs/dinakala/?p=1048';
	}
	
	public function get_categories() {
		return [ 'dina-kala' ];
	}
	
	protected function register_controls() {
		
		//General settings Section
		$this->start_controls_section(
			'general_settings',
			[
				'label' => __( 'General settings of links', 'dina-kala' ),
			]
		);

		$this->add_control(
			'circle_style',
			[
				'label'        => __( 'Circle style', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'nofollow_social_link',
			[
				'label'        => __( 'Add nofollow property to social network links', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->end_controls_section();
		//End General settings Section
		
		//Social network links Section
		$this->start_controls_section(
			'social_network_links',
			[
				'label' => __( 'Social network links', 'dina-kala' ),
			]
		);

		//Facebook
		$this->add_control(
			'so_facebook',
			[
				'label'        => __( 'Facebook', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'so_facebook_link',
			[
				'label'       => __( 'Link', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'https://', 'dina-kala' ),
				'default'     => __( '#', 'dina-kala' ),
				'condition'   => [
					'so_facebook' => 'yes',
				]
			]
		);

		//Google+
		$this->add_control(
			'so_google',
			[
				'label'        => __( 'Google+', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'so_google_link',
			[
				'label'       => __( 'Link', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'https://', 'dina-kala' ),
				'default'     => __( '#', 'dina-kala' ),
				'condition'   => [
					'so_google' => 'yes',
				]
			]
		);

		//Twitter
		$this->add_control(
			'so_twitter',
			[
				'label'        => __( 'Twitter', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'so_twitter_link',
			[
				'label'       => __( 'Link', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'https://', 'dina-kala' ),
				'default'     => __( '#', 'dina-kala' ),
				'condition'   => [
					'so_twitter' => 'yes',
				]
			]
		);

		//Youtube
		$this->add_control(
			'so_youtube',
			[
				'label'        => __( 'Youtube', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'so_youtube_link',
			[
				'label'       => __( 'Link', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'https://', 'dina-kala' ),
				'default'     => __( '#', 'dina-kala' ),
				'condition'   => [
					'so_youtube' => 'yes',
				]
			]
		);

		//Dribble
		$this->add_control(
			'so_dribble',
			[
				'label'        => __( 'Dribble', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'so_dribble_link',
			[
				'label'       => __( 'Link', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'https://', 'dina-kala' ),
				'default'     => __( '#', 'dina-kala' ),
				'condition'   => [
					'so_dribble' => 'yes',
				]
			]
		);

		//Behance
		$this->add_control(
			'so_behance',
			[
				'label'        => __( 'Behance', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'so_behance_link',
			[
				'label'       => __( 'Link', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'https://', 'dina-kala' ),
				'default'     => __( '#', 'dina-kala' ),
				'condition'   => [
					'so_behance' => 'yes',
				]
			]
		);

		//Linkedin
		$this->add_control(
			'so_linkedin',
			[
				'label'        => __( 'Linkedin', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'so_linkedin_link',
			[
				'label'       => __( 'Link', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'https://', 'dina-kala' ),
				'default'     => __( '#', 'dina-kala' ),
				'condition'   => [
					'so_linkedin' => 'yes',
				]
			]
		);

		//Instagram
		$this->add_control(
			'so_instagram',
			[
				'label'        => __( 'Instagram', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'so_instagram_link',
			[
				'label'       => __( 'Link', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'https://', 'dina-kala' ),
				'default'     => __( '#', 'dina-kala' ),
				'condition'   => [
					'so_instagram' => 'yes',
				]
			]
		);

		//Telegram
		$this->add_control(
			'so_telegram',
			[
				'label'        => __( 'Telegram', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'so_telegram_link',
			[
				'label'       => __( 'Link', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'https://', 'dina-kala' ),
				'default'     => __( '#', 'dina-kala' ),
				'condition'   => [
					'so_telegram' => 'yes',
				]
			]
		);

		//Pinterest
		$this->add_control(
			'so_pinterest',
			[
				'label'        => __( 'Pinterest', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'so_pinterest_link',
			[
				'label'       => __( 'Link', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'https://', 'dina-kala' ),
				'default'     => __( '#', 'dina-kala' ),
				'condition'   => [
					'so_pinterest' => 'yes',
				]
			]
		);

		//Whatsapp
		$this->add_control(
			'so_whatsapp',
			[
				'label'        => __( 'Whatsapp', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'so_whatsapp_link',
			[
				'label'       => __( 'Link', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'https://', 'dina-kala' ),
				'default'     => __( '#', 'dina-kala' ),
				'condition'   => [
					'so_whatsapp' => 'yes',
				]
			]
		);

		//Threads
		$this->add_control(
			'so_threads',
			[
				'label'        => __( 'Threads', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'so_threads_link',
			[
				'label'       => __( 'Link', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'https://', 'dina-kala' ),
				'default'     => __( '#', 'dina-kala' ),
				'condition'   => [
					'so_threads' => 'yes',
				]
			]
		);

		//Tiktok
		$this->add_control(
			'so_tiktok',
			[
				'label'        => __( 'Tiktok', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'so_tiktok_link',
			[
				'label'       => __( 'Link', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'https://', 'dina-kala' ),
				'default'     => __( '#', 'dina-kala' ),
				'condition'   => [
					'so_tiktok' => 'yes',
				]
			]
		);

		//Aparat
		$this->add_control(
			'so_aparat',
			[
				'label'        => __( 'Aparat', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'so_aparat_link',
			[
				'label'       => __( 'Link', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'https://', 'dina-kala' ),
				'default'     => __( '#', 'dina-kala' ),
				'condition'   => [
					'so_aparat' => 'yes',
				]
			]
		);

		  //Soroush
		$this->add_control(
			'so_soroush',
			[
				'label'        => __( 'Soroush', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'so_soroush_link',
			[
				'label'       => __( 'Link', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'https://', 'dina-kala' ),
				'default'     => __( '#', 'dina-kala' ),
				'condition'   => [
					'so_soroush' => 'yes',
				]
			]
		);

		  //Gap
		$this->add_control(
			'so_gap',
			[
				'label'        => __( 'Gap', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'so_gap_link',
			[
				'label'       => __( 'Link', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'https://', 'dina-kala' ),
				'default'     => __( '#', 'dina-kala' ),
				'condition'   => [
					'so_gap' => 'yes',
				]
			]
		);

		  //Eitaa
		$this->add_control(
			'so_eitaa',
			[
				'label'        => __( 'Eitaa', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'so_eitaa_link',
			[
				'label'       => __( 'Link', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'https://', 'dina-kala' ),
				'default'     => __( '#', 'dina-kala' ),
				'condition'   => [
					'so_eitaa' => 'yes',
				]
			]
		);

		  //Bisphone
		$this->add_control(
			'so_bisphone',
			[
				'label'        => __( 'Bisphone', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'so_bisphone_link',
			[
				'label'       => __( 'Link', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'https://', 'dina-kala' ),
				'default'     => __( '#', 'dina-kala' ),
				'condition'   => [
					'so_bisphone' => 'yes',
				]
			]
		);

		  //Bale
		$this->add_control(
			'so_bale',
			[
				'label'        => __( 'Bale', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'so_bale_link',
			[
				'label'       => __( 'Link', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'https://', 'dina-kala' ),
				'default'     => __( '#', 'dina-kala' ),
				'condition'   => [
					'so_bale' => 'yes',
				]
			]
		);

		  //iGap
		$this->add_control(
			'so_igap',
			[
				'label'        => __( 'iGap', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'so_igap_link',
			[
				'label'       => __( 'Link', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'https://', 'dina-kala' ),
				'default'     => __( '#', 'dina-kala' ),
				'condition'   => [
					'so_igap' => 'yes',
				]
			]
		);

		  //Rubika
		$this->add_control(
			'so_rubika',
			[
				'label'        => __( 'Rubika', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'so_rubika_link',
			[
				'label'       => __( 'Link', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'https://', 'dina-kala' ),
				'default'     => __( '#', 'dina-kala' ),
				'condition'   => [
					'so_rubika' => 'yes',
				]
			]
		);

		  //Hoorsa
		$this->add_control(
			'so_hoorsa',
			[
				'label'        => __( 'Hoorsa', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'so_hoorsa_link',
			[
				'label'       => __( 'Link', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'https://', 'dina-kala' ),
				'default'     => __( '#', 'dina-kala' ),
				'condition'   => [
					'so_hoorsa' => 'yes',
				]
			]
		);

		  //Soundcloud
		$this->add_control(
			'so_soundcloud',
			[
				'label'        => __( 'Soundcloud', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'so_soundcloud_link',
			[
				'label'       => __( 'Link', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'https://', 'dina-kala' ),
				'default'     => __( '#', 'dina-kala' ),
				'condition'   => [
					'so_soundcloud' => 'yes',
				]
			]
		);

		  //Spotify
		$this->add_control(
			'so_spotify',
			[
				'label'        => __( 'Spotify', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'so_spotify_link',
			[
				'label'       => __( 'Link', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'https://', 'dina-kala' ),
				'default'     => __( '#', 'dina-kala' ),
				'condition'   => [
					'so_spotify' => 'yes',
				]
			]
		);

		  //Google podcasts
		$this->add_control(
			'so_google_podcasts',
			[
				'label'        => __( 'Google podcasts', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'so_google_podcasts_link',
			[
				'label'       => __( 'Link', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'https://', 'dina-kala' ),
				'default'     => __( '#', 'dina-kala' ),
				'condition'   => [
					'so_google_podcasts' => 'yes',
				]
			]
		);

		  //Castbox
		$this->add_control(
			'so_castbox',
			[
				'label'        => __( 'Castbox', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'so_castbox_link',
			[
				'label'       => __( 'Link', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'https://', 'dina-kala' ),
				'default'     => __( '#', 'dina-kala' ),
				'condition'   => [
					'so_castbox' => 'yes',
				]
			]
		);

		  //Linktree
		$this->add_control(
			'so_linktree',
			[
				'label'        => __( 'Linktree', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'so_linktree_link',
			[
				'label'       => __( 'Link', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'https://', 'dina-kala' ),
				'default'     => __( '#', 'dina-kala' ),
				'condition'   => [
					'so_linktree' => 'yes',
				]
			]
		);

		  //Phone
		$this->add_control(
			'so_phone',
			[
				'label'        => __( 'Phone', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'so_phone_remove_tel',
			[
				'label'        => __( 'Remove "tel:" from link output', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
				'condition'    => [
					'so_phone' => 'yes',
				]
			]
		);

		$this->add_control(
			'so_phone_link',
			[
				'label'       => __( 'Link', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'https://', 'dina-kala' ),
				'default'     => __( '#', 'dina-kala' ),
				'condition'   => [
					'so_phone' => 'yes',
				]
			]
		);

		  //Mobile
		$this->add_control(
			'so_mobile',
			[
				'label'        => __( 'Mobile', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'so_mobile_remove_tel',
			[
				'label'        => __( 'Remove "tel:" from link output', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
				'condition'    => [
					'so_mobile' => 'yes',
				]
			]
		);

		$this->add_control(
			'so_mobile_link',
			[
				'label'       => __( 'Link', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'https://', 'dina-kala' ),
				'default'     => __( '#', 'dina-kala' ),
				'condition'   => [
					'so_mobile' => 'yes',
				]
			]
		);

		  //Email
		$this->add_control(
			'so_email',
			[
				'label'        => __( 'Email', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'so_email_link',
			[
				'label'       => __( 'Link', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'https://', 'dina-kala' ),
				'default'     => __( '#', 'dina-kala' ),
				'condition'   => [
					'so_email' => 'yes',
				]
			]
		);

		$this->end_controls_section();
		//End Social network links Section
	}
	
	protected function render() {

        $settings        = $this->get_settings_for_display();
		$social_nofollow = 'yes' === $settings['nofollow_social_link'] ? ' rel="nofollow"' : '';
		$link_schema     = dina_opt( 'site_schema' ) ? 'itemprop="sameAs" ' : '';
		$classes         = 'yes' === $settings['circle_style'] ? 'footer-social-circle' : 'footer-social-square';
		?>
		<!-- Social links -->
		<div class="di-el-social-link">
			<ul class="<?php echo $classes; ?>">

				<?php if ( 'yes' === $settings['so_twitter'] ) { ?>
				<li>
					<a <?php echo $link_schema; ?>href="<?php echo $settings['so_twitter_link']; ?>" title="<?php _e( 'Twitter', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
						<i class="dico ico-twitter-x"></i>
					</a>
				</li>
				<?php } ?>

				<?php if ( 'yes' === $settings['so_facebook'] ) { ?>
				<li>
					<a <?php echo $link_schema; ?>href="<?php echo $settings['so_facebook_link']; ?>" title="<?php _e( 'Facebook', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
						<i class="fab fa-facebook-f"></i>
					</a>
				</li>
				<?php } ?>

				<?php if ( 'yes' === $settings['so_google'] ) { ?>
				<li>
					<a <?php echo $link_schema; ?>href="<?php echo $settings['so_google_link']; ?>" title="<?php _e( 'Google+', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
						<i class="fab fa-google-plus-g"></i>
					</a>
				</li>
				<?php } ?>

				<?php if ( 'yes' === $settings['so_whatsapp'] ) { ?>
				<li>
					<a <?php echo $link_schema; ?>href="<?php echo $settings['so_whatsapp_link']; ?>" title="<?php _e( 'Whatsapp', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
						<i class="fab fa-whatsapp"></i>
					</a>
				</li>
				<?php } ?>

				<?php if ( 'yes' === $settings['so_threads'] ) { ?>
				<li>
					<a <?php echo $link_schema; ?>href="<?php echo $settings['so_threads_link']; ?>" title="<?php _e( 'Threads', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
						<i class="dico ico-threads"></i>
					</a>
				</li>
				<?php } ?>

				<?php if ( 'yes' === $settings['so_tiktok'] ) { ?>
				<li>
					<a <?php echo $link_schema; ?>href="<?php echo $settings['so_tiktok_link']; ?>" title="<?php _e( 'Tiktok', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
						<i class="fab fa-tiktok"></i>
					</a>
				</li>
				<?php } ?>

				<?php if ( 'yes' === $settings['so_telegram'] ) { ?>
				<li>
					<a <?php echo $link_schema; ?>href="<?php echo $settings['so_telegram_link']; ?>" title="<?php _e( 'Telegram', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
						<i class="fab fa-telegram-plane"></i>
					</a>
				</li>
				<?php } ?>

				<?php if ( 'yes' === $settings['so_instagram'] ) { ?>
				<li>
					<a <?php echo $link_schema; ?>href="<?php echo $settings['so_instagram_link']; ?>" title="<?php _e( 'Instagram', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
						<i class="fab fa-instagram"></i>
					</a>
				</li>
				<?php } ?>

				<?php if ( 'yes' === $settings['so_soundcloud'] ) { ?>
				<li>
					<a <?php echo $link_schema; ?>href="<?php echo $settings['so_soundcloud_link']; ?>" title="<?php _e( 'Soundcloud', 'dina-kala' ) ?>" target="_blank"<?php echo $social_nofollow; ?>>
						<i class="fab fa-soundcloud"></i>
					</a>
				</li>
				<?php } ?>

				<?php if ( 'yes' === $settings['so_spotify'] ) { ?>
				<li>
					<a <?php echo $link_schema; ?>href="<?php echo $settings['so_spotify_link']; ?>" title="<?php _e( 'Spotify', 'dina-kala' ) ?>" target="_blank"<?php echo $social_nofollow; ?>>
						<i class="fab fa-spotify"></i>
					</a>
				</li>
				<?php } ?>

				<?php if ( 'yes' === $settings['so_google_podcasts'] ) { ?>
				<li>
					<a <?php echo $link_schema; ?>href="<?php echo $settings['so_google_podcasts_link']; ?>" title="<?php _e( 'Google podcasts', 'dina-kala' ) ?>" target="_blank"<?php echo $social_nofollow; ?>>
						<i class="dico ico-google-podcasts"></i>
					</a>
				</li>
				<?php } ?>

				<?php if ( 'yes' === $settings['so_castbox'] ) { ?>
				<li>
					<a <?php echo $link_schema; ?>href="<?php echo $settings['so_castbox_link']; ?>" title="<?php _e( 'Castbox', 'dina-kala' ) ?>" target="_blank"<?php echo $social_nofollow; ?>>
						<i class="dico ico-castbox"></i>
					</a>
				</li>
				<?php } ?>

				<?php if ( 'yes' === $settings['so_linktree'] ) { ?>
				<li>
					<a <?php echo $link_schema; ?>href="<?php echo $settings['so_linktree_link']; ?>" title="<?php _e( 'Linktree', 'dina-kala' ) ?>" target="_blank"<?php echo $social_nofollow; ?>>
						<i class="dico ico-linktr"></i>
					</a>
				</li>
				<?php } ?>

				<?php if ( 'yes' === $settings['so_youtube'] ) { ?>
				<li>
					<a <?php echo $link_schema; ?>href="<?php echo $settings['so_youtube_link']; ?>" title="<?php _e( 'Youtube', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
						<i class="fab fa-youtube"></i>
					</a>
				</li>
				<?php } ?>

				<?php if ( 'yes' === $settings['so_linkedin'] ) { ?>
				<li>
					<a <?php echo $link_schema; ?>href="<?php echo $settings['so_linkedin_link']; ?>" title="<?php _e( 'Linkedin', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
						<i class="fab fa-linkedin-in"></i>
					</a>
				</li>
				<?php } ?>

				<?php if ( 'yes' === $settings['so_dribble'] ) { ?>
				<li>
					<a <?php echo $link_schema; ?>href="<?php echo $settings['so_dribble_link']; ?>" title="<?php _e( 'Dribble', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
						<i class="fab fa-dribbble"></i>
					</a>
				</li>
				<?php } ?>

				<?php if ( 'yes' === $settings['so_behance'] ) { ?>
				<li>
					<a <?php echo $link_schema; ?>href="<?php echo $settings['so_behance_link']; ?>" title="<?php _e( 'Behance', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
						<i class="fab fa-behance"></i>
					</a>
				</li>
				<?php } ?>

				<?php if ( 'yes' === $settings['so_pinterest'] ) { ?>
				<li>
					<a <?php echo $link_schema; ?>href="<?php echo $settings['so_pinterest_link']; ?>" title="<?php _e( 'Pinterest', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
						<i class="fab fa-pinterest-p"></i>
					</a>
				</li>
				<?php } ?>

				<?php if ( 'yes' === $settings['so_aparat'] ) { ?>
				<li>
					<a <?php echo $link_schema; ?>href="<?php echo $settings['so_aparat_link']; ?>" title="<?php _e( 'Aparat', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
						<i class="dico ico-aparat"></i>
					</a>
				</li>
				<?php } ?>

				<?php if ( 'yes' === $settings['so_soroush'] ) { ?>
				<li>
					<a <?php echo $link_schema; ?>href="<?php echo $settings['so_soroush_link']; ?>" title="<?php _e( 'Soroush', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
						<i class="dico ico-Soroush"></i>
					</a>
				</li>
				<?php } ?>

				<?php if ( 'yes' === $settings['so_gap'] ) { ?>
				<li>
					<a <?php echo $link_schema; ?>href="<?php echo $settings['so_gap_link']; ?>" title="<?php _e( 'Gap', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
						<i class="dico ico-Gap"></i>
					</a>
				</li>
				<?php } ?>

				<?php if ( 'yes' === $settings['so_eitaa'] ) { ?>
				<li>
					<a <?php echo $link_schema; ?>href="<?php echo $settings['so_eitaa_link']; ?>" title="<?php _e( 'Eitaa', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
						<i class="dico ico-Eitaa"></i>
					</a>
				</li>
				<?php } ?>

				<?php if ( 'yes' === $settings['so_bisphone'] ) { ?>
				<li>
					<a <?php echo $link_schema; ?>href="<?php echo $settings['so_bisphone_link']; ?>" title="<?php _e( 'Bisphone', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
						<i class="dico ico-Bisphone"></i>
					</a>
				</li>
				<?php } ?>

				<?php if ( 'yes' === $settings['so_bale'] ) { ?>
				<li>
					<a <?php echo $link_schema; ?>href="<?php echo $settings['so_bale_link']; ?>" title="<?php _e( 'Bale', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
						<i class="dico ico-Bale"></i>
					</a>
				</li>
				<?php } ?>

				<?php if ( 'yes' === $settings['so_igap'] ) { ?>
				<li>
					<a <?php echo $link_schema; ?>href="<?php echo $settings['so_igap_link']; ?>" title="<?php _e( 'iGap', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
						<i class="dico ico-iGap"></i>
					</a>
				</li>
				<?php } ?>

				<?php if ( 'yes' === $settings['so_rubika'] ) { ?>
				<li>
					<a <?php echo $link_schema; ?>href="<?php echo $settings['so_rubika_link']; ?>" title="<?php _e( 'Rubika', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
						<i class="dico ico-rubika"></i>
					</a>
				</li>
				<?php } ?>

				<?php if ( 'yes' === $settings['so_hoorsa'] ) { ?>
				<li>
					<a <?php echo $link_schema; ?>href="<?php echo $settings['so_hoorsa_link']; ?>" title="<?php _e( 'Hoorsa', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
						<i class="dico ico-hoorsa"></i>
					</a>
				</li>
				<?php } ?>

				<?php if ( 'yes' === $settings['so_phone'] ) { ?>
				<li>
					<a <?php echo $link_schema; ?>href="<?php echo $settings['so_phone_remove_tel'] ? $settings['so_phone_link'] : 'tel:'. dina_remove_dash( $settings['so_phone_link'] ); ?>" title="<?php _e( 'Phone', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
						<i class="fal fa-phone" aria-hidden="true"></i>
					</a>
				</li>
				<?php } ?>

				<?php if ( 'yes' === $settings['so_mobile'] ) { ?>
				<li>
					<a <?php echo $link_schema; ?>href="<?php echo $settings['so_mobile_remove_tel'] ? $settings['so_mobile_link'] : 'tel:'. dina_remove_dash( $settings['so_mobile_link'] ); ?>" title="<?php _e( 'Mobile', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
						<i class="fal fa-mobile-alt" aria-hidden="true"></i>
					</a>
				</li>
				<?php } ?>

				<?php if ( 'yes' === $settings['so_email'] ) { ?>
				<li>
					<a <?php echo $link_schema; ?>href="mailto:<?php echo $settings['so_email_link']; ?>" title="<?php _e( 'Email', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
						<i class="fal fa-at" aria-hidden="true"></i>
					</a>
				</li>
				<?php } ?>

			</ul>
		</div>
        <!-- Social links --> <?php

	}

}
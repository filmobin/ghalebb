<?php
/**
 * Redux Custom Font Extension Class
 *
 * @package Redux
 * @author  Kevin Provance <kevin.provance@gmail.com> & Dovy Paukstys <dovy@reduxframework.com>
 * @class   Redux_Extension_Custom_Fonts
 * @version 4.4.2
 *
 * @noinspection PhpHierarchyChecksInspection
 * @noinspection PhpDocFinalChecksInspection
 * @noinspection PhpIgnoredClassAliasDeclaration
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Redux_Extension_Custom_Fonts' ) ) {

	/**
	 * Class Redux_Extension_Custom_Fonts
	 */
	class Redux_Extension_Custom_Fonts extends Redux_Extension_Abstract {

		/**
		 * Extension version.
		 *
		 * @var string
		 */
		public static string $version = '4.4.2';

		/**
		 * Extension friendly name.
		 *
		 * @var string
		 */
		public string $extension_name = 'Custom Fonts';
		/**
		 * Class instance.
		 *
		 * @var object|null
		 */
		public static ?object $instance;

		/**
		 * Custom fonts array.
		 *
		 * @var array|null
		 */
		public ?array $custom_fonts = array();

		/**
		 * WordPress upload directory.
		 *
		 * @var string|null
		 */
		public ?string $upload_dir = '';

		/**
		 * WordPress upload URI.
		 *
		 * @var string|null
		 */
		public ?string $upload_url = '';

		/**
		 * Subfolder name.
		 *
		 * @var string
		 */
		public string $subfolder = 'custom/';

		/**
		 * Font folder.
		 *
		 * @var string|null
		 */
		public ?string $font_folder = '';

		/**
		 * Font Filename.
		 *
		 * @var string|null
		 */
		public ?string $font_filename = '';

		/**
		 * File selected in media upload.
		 *
		 * @var string|null
		 */
		public ?string $selected_file = '';

		/**
		 * Is font conversation service available?
		 *
		 * @var bool
		 */
		private bool $can_convert;

		/**
		 * Class Constructor. Defines the args for the extensions class
		 *
		 * @param ReduxFramework $redux ReduxFramework pointer.
		 *
		 * @return      void
		 * @since       1.0.0
		 * @access      public
		 */
		public function __construct( $redux ) {
			parent::__construct( $redux, __FILE__ );

			self::$instance = parent::get_instance();

			$this->add_field( 'custom_fonts' );

			$this->upload_dir = Redux_Core::$upload_dir . 'custom-fonts/';
			$this->upload_url = Redux_Core::$upload_url . 'custom-fonts/';

			if ( ! is_dir( $this->upload_dir ) ) {
				Redux_Core::$filesystem->execute( 'mkdir', $this->upload_dir );
			}

			if ( ! is_dir( $this->upload_dir . '/custom' ) ) {
				Redux_Core::$filesystem->execute( 'mkdir', $this->upload_dir . '/custom' );
			}

			$this->get_fonts();

			if ( file_exists( $this->upload_dir . 'fonts.css' ) ) {
				if ( filemtime( $this->upload_dir . 'custom' ) > ( filemtime( $this->upload_dir . 'fonts.css' ) + 10 ) ) {
					$this->generate_css();
				}
			} else {
				$this->generate_css();
			}

			add_action( 'wp_ajax_redux_custom_fonts', array( $this, 'ajax' ) );
			add_action( 'wp_ajax_redux_custom_font_timer', array( $this, 'timer' ) );

			add_filter( "redux/{$this->parent->args['opt_name']}/field/typography/custom_fonts", array( $this, 'add_custom_fonts' ) );

			// phpcs:disable
			// $this->is_field = Redux_Helpers::is_field_in_use( $parent, 'custom_fonts' );

			// if ( ! $this->is_field ) {
			// 	$this->add_section();
			// }

			add_filter( "redux/options/{$this->parent->args['opt_name']}/section/redux_dynamic_font_control", array( $this, 'remove_dynamic_section' ) ); // phpcs:ignore WordPress.NamingConventions.ValidHookName
			add_filter( 'upload_mimes', array( $this, 'custom_upload_mimes' ) );
			add_action( 'wp_head', array( $this, 'enqueue_output' ), 150 );
			add_filter( 'tiny_mce_before_init', array( $this, 'extend_tinymce_dropdown' ) );

			$this->can_convert = true; // has_filter( 'redux/' . $this->parent->args['opt_name'] . '/extensions/custom_fonts/api_url' );
			// phpcs:enable
		}

		/**
		 * Timer.
		 */
		public function timer() {
			$name = get_option( 'redux_custom_font_current' );

			if ( ! empty( $name ) ) {
				echo esc_html( $name );
			}

			die();
		}

		/**
		 * Remove the dynamically added section if the field was used elsewhere
		 *
		 * @param array $section Section array.
		 *
		 * @return array
		 * @since  Redux_Framework 3.1.1
		 */
		public function remove_dynamic_section( array $section ): array {
			if ( isset( $this->parent->field_types['custom_fonts'] ) ) {
				$section = array();
			}

			return $section;
		}

		/**
		 * Adds FontMeister fonts to the TinyMCE drop-down.
		 * Typekit's fonts don't render properly in the drop-down and in the editor,
		 * because Typekit needs JS and TinyMCE doesn't support that.
		 *
		 * @param array $opt Option array.
		 *
		 * @return array
		 */
		public function extend_tinymce_dropdown( array $opt ): array {
			if ( ! is_admin() ) {
				return $opt;
			}

			if ( file_exists( $this->upload_dir . 'fonts.css' ) ) {
				$theme_advanced_fonts = $opt['font_formats'] ?? 'Andale Mono=andale mono,times;Arial=arial,helvetica,sans-serif;Arial Black=arial black,avant garde;Book Antiqua=book antiqua,palatino;Comic Sans MS=comic sans ms,sans-serif;Courier New=courier new,courier;Georgia=georgia,palatino;Helvetica=helvetica;Impact=impact,chicago;Symbol=symbol;Tahoma=tahoma,arial,helvetica,sans-serif;Terminal=terminal,monaco;Times New Roman=times new roman,times;Trebuchet MS=trebuchet ms,geneva;Verdana=verdana,geneva;Webdings=webdings;Wingdings=wingdings,zapf dingbats';
				$custom_fonts         = '';

				$stylesheet = $this->upload_url . 'fonts.css';

				if ( empty( $opt['content_css'] ) ) {
					$opt['content_css'] = $stylesheet;
				} else {
					$opt['content_css'] = $opt['content_css'] . ',' . $stylesheet;
				}

				foreach ( $this->custom_fonts as $arr ) {
					foreach ( $arr as $font => $pieces ) {
						$custom_fonts .= ';' . $font . '=' . $font;
					}
				}

				$opt['font_formats'] = $theme_advanced_fonts . $custom_fonts;
			}

			return $opt;
		}


		/**
		 * Function to enqueue the custom fonts css
		 */
		public function enqueue_output() {
			if ( file_exists( $this->upload_dir . 'fonts.css' ) ) {
				wp_enqueue_style(
					'redux-custom-fonts',
					$this->upload_url . 'fonts.css',
					array(),
					time()
				);
			}
		}

		/**
		 * Adds the appropriate mime types to WordPress
		 *
		 * @param array $existing_mimes Mine array.
		 *
		 * @return array
		 */
		public function custom_upload_mimes( array $existing_mimes = array() ): array {
			$existing_mimes['ttf']   = 'font/ttf';
			$existing_mimes['otf']   = 'font/otf';
			$existing_mimes['eot']   = 'application/vnd.ms-fontobject';
			$existing_mimes['woff']  = 'application/font-woff';
			$existing_mimes['woff2'] = 'application/font-woff2';
			$existing_mimes['svg']   = 'image/svg+xml';
			$existing_mimes['zip']   = 'application/zip';

			return $existing_mimes;
		}

		/**
		 * Gets all the fonts in the custom_fonts directory
		 */
		public function get_fonts() {
			if ( empty( $this->custom_fonts ) ) {
				$params = array(
					'include_hidden' => false,
					'recursive'      => true,
				);

				$fonts = Redux_Core::$filesystem->execute( 'dirlist', $this->upload_dir, $params );

				if ( ! empty( $fonts ) ) {
					foreach ( $fonts as $section ) {
						if ( 'd' === $section['type'] && ! empty( $section['name'] ) ) {
							if ( 'custom' === $section['name'] ) {
								$section['name'] = esc_html__( 'Custom Fonts', 'dina-kala' );
							}

							if ( empty( $section['files'] ) ) {
								continue;
							}

							$this->custom_fonts[ $section['name'] ] = $this->custom_fonts[ $section['name'] ] ?? array();

							foreach ( $section['files'] as $font ) {
								if ( ! empty( $font['name'] ) ) {
									if ( empty( $font['files'] ) ) {
										continue;
									}

									$kinds = array();

									foreach ( $font['files'] as $f ) {
										$valid = $this->check_font_name( $f );
										if ( $valid ) {
											$kinds[] = $valid;
										}
									}

									$this->custom_fonts[ $section['name'] ][ $font['name'] ] = $kinds;
								}
							}
						}
					}
				}
			}
		}

		/**
		 * Add custom fonts.
		 *
		 * @param mixed $custom_fonts Custom fonts.
		 *
		 * @return array
		 */
		public function add_custom_fonts( $custom_fonts ): array {
			if ( empty( $custom_fonts ) ) {
				$custom_fonts = array();
			}

			return wp_parse_args( $custom_fonts, $this->custom_fonts );
		}

		/**
		 * Ajax used within the panel to add and process the fonts
		 */
		public function ajax() {
			if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['nonce'] ) ), 'redux_custom_fonts' ) ) {
				die( 0 );
			}

			if ( isset( $_POST['type'] ) && 'delete' === $_POST['type'] ) {
				if ( isset( $_POST['section'] ) ) {
					if ( esc_html__( 'Custom Fonts', 'dina-kala' ) === $_POST['section'] ) {
						$_POST['section'] = 'custom';
					}
				}

				try {
					if ( isset( $_POST['section'] ) || isset( $_POST['name'] ) ) {
						$ret = Redux_Core::$filesystem->execute( 'rmdir', $this->upload_dir . sanitize_file_name( wp_unslash( $_POST['section'] ) ) . '/' . sanitize_file_name( wp_unslash( $_POST['name'] ) ) . '/', array( 'recursive' => true ) );

						if ( true === $ret ) {
							$result = array( 'type' => 'success' );
						} else {
							$result = array(
								'type' => 'error',
								'msg'  => esc_html__( 'File system failure. Could not delete temp dir.', 'dina-kala' ),
							);
						}

						echo wp_json_encode( $result );
					}
				} catch ( Exception $e ) {
					echo wp_json_encode(
						array(
							'type' => 'error',
							'msg'  => esc_html__( 'Unable to delete font file(s).', 'dina-kala' ),
						)
					);
				}

				die();
			}

			if ( ! isset( $_POST['title'] ) ) {
				$_POST['title'] = '';
			}

			if ( ! isset( $_POST['filename'] ) ) {
				$_POST['filename'] = '';
			}

			$this->font_folder   = sanitize_file_name( wp_unslash( $_POST['title'] ) );
			$this->font_filename = sanitize_file_name( wp_unslash( $_POST['filename'] ) );

			if ( ! empty( $_POST['attachment_id'] ) ) {
				if ( isset( $_POST['title'] ) || isset( $_POST['mime'] ) ) {
					$msg = $this->process_web_font( sanitize_key( wp_unslash( $_POST['attachment_id'] ) ), sanitize_text_field( wp_unslash( $_POST['mime'] ) ) );

					if ( empty( $msg ) ) {
						$msg = '';
					}

					$result = array(
						'type' => 'success',
						'msg'  => $msg,
					);

					echo wp_json_encode( $result );
				}
			}

			die();
		}

		/**
		 * Get only valid files. Ensure everything is proper for processing.
		 *
		 * @param string $path Path.
		 *
		 * @return array
		 */
		public function get_valid_files( string $path ): array {
			$output = array();
			$path   = trailingslashit( $path );

			$params = array(
				'include_hidden' => false,
				'recursive'      => true,
			);

			$files = Redux_Core::$filesystem->execute( 'dirlist', $path, $params );

			foreach ( $files as $file ) {
				if ( 'd' === $file['type'] ) {
					$output = array_merge( $output, $this->get_valid_files( $path . $file['name'] ) );
				} elseif ( 'f' === $file['type'] ) {
					$valid = $this->check_font_name( $file );
					if ( $valid ) {
						$output[ $valid ] = trailingslashit( $path ) . $file['name'];
					}
				}
			}

			return $output;
		}

		/**
		 * Take a valid web font and process the missing pieces.
		 *
		 * @param string $attachment_id ID.
		 * @param string $mime_type     Mine type.
		 */
		public function process_web_font( string $attachment_id, string $mime_type ) {
			// phpcs:ignore WordPress.Security.NonceVerification
			if ( ! isset( $_POST['conversion'] ) ) {
				$_POST['conversion'] = 'false';
			}

			// phpcs:ignore WordPress.Security.NonceVerification
			$conversion = sanitize_text_field( wp_unslash( $_POST['conversion'] ) );

			$missing = array();

			$complete = array(
				'ttf',
				'woff',
				'woff2',
				'eot',
				'svg',
				'otf',
			);

			$subtype = explode( '/', $mime_type );
			$subtype = trim( max( $subtype ) );

			if ( ! is_dir( $this->upload_dir ) ) {
				Redux_Core::$filesystem->execute( 'mkdir', $this->upload_dir );
			}

			if ( ! is_dir( $this->upload_dir . $this->subfolder ) ) {
				Redux_Core::$filesystem->execute( 'mkdir', $this->upload_dir . $this->subfolder );
			}

			$temp                = $this->upload_dir . 'temp';
			$this->selected_file = get_attached_file( $attachment_id );

			if ( empty( $this->selected_file ) ) {
				echo wp_json_encode(
					array(
						'type' => 'error',
						'msg'  => esc_html__( 'Attachment does not exist.', 'dina-kala' ),
					)
				);

				die();
			}

			$filename = explode( '/', $this->selected_file );

			$filename = $filename[ ( count( $filename ) - 1 ) ];

			$fontname = ucfirst(
				str_replace(
					array(
						'.zip',
						'.ttf',
						'.woff',
						'.woff2',
						'.eot',
						'.svg',
						'.otf',
					),
					'',
					strtolower( $filename )
				)
			);

			if ( empty( $this->font_folder ) ) {
				$this->font_folder = $fontname;
			}

			$ret = array();

			if ( ! is_dir( $temp ) ) {
				Redux_Core::$filesystem->execute( 'mkdir', $temp );
			}

			if ( 'zip' === $subtype ) {
				$unzipfile = unzip_file( $this->selected_file, $temp );

				if ( is_wp_error( $unzipfile ) ) {
					echo wp_json_encode(
						array(
							'type' => 'error',
							'msg'  => $unzipfile->get_error_message() . '<br><br>' . esc_html__( 'Unzipping failed.', 'dina-kala' ),
						)
					);

					die();
				}

				$output = $this->get_valid_files( $temp );

				if ( ! empty( $output ) ) {
					foreach ( $complete as $test ) {
						if ( ! isset( $output[ $test ] ) ) {
							$missing[] = $test;
						}
					}

					if ( ! is_dir( $this->upload_dir . $this->subfolder . $this->font_folder . '/' ) ) {
						Redux_Core::$filesystem->execute( 'mkdir', $this->upload_dir . $this->subfolder . $this->font_folder . '/' );
					}

					foreach ( $output as $key => $value ) {
						$param_array = array(
							'destination' => $this->upload_dir . $this->subfolder . $this->font_folder . '/' . $fontname . '.' . $key,
							'overwrite'   => true,
							'chmod'       => 755,
						);

						Redux_Core::$filesystem->execute( 'copy', $value, $param_array );
					}

					if ( true === $this->can_convert && 'true' === $conversion ) {
						$ret = $this->get_missing_files( $fontname, $missing, $output );
					}
				}

				Redux_Core::$filesystem->execute( 'rmdir', $temp, array( 'recursive' => true ) );

				$this->generate_css();

				wp_delete_attachment( $attachment_id, true );
			} elseif ( 'svg+xml' === $subtype || 'vnd.ms-fontobject' === $subtype || 'x-font-ttf' === $subtype || 'ttf' === $subtype || 'otf' === $subtype || 'font-woff' === $subtype || 'font-woff2' === $subtype || 'application-octet-stream' === $subtype || 'octet-stream' === $subtype ) {
				foreach ( $complete as $test ) {
					if ( $subtype !== $test ) {
						if ( ! isset( $output[ $test ] ) ) {
							$missing[] = $test;
						}
					}
				}

				if ( ! is_dir( $this->upload_dir . $this->subfolder . $this->font_folder . '/' ) ) {
					Redux_Core::$filesystem->execute( 'mkdir', $this->upload_dir . $this->subfolder . $this->font_folder . '/' );
				}

				$output = array( $subtype => $this->selected_file );

				if ( true === $this->can_convert && 'true' === $conversion ) {
					$ret = $this->get_missing_files( $fontname, $missing, $output );

					if ( false === $ret ) {
						if ( false === $this->convert_local_font() ) {
							echo wp_json_encode(
								array(
									'type' => 'error',
									'msg'  => esc_html__( 'File permission error. Local file could not be installed.', 'dina-kala' ) . ' ' . $subtype,
								)
							);

							die;
						}
					}
				} elseif ( false === $this->convert_local_font() ) {
						echo wp_json_encode(
							array(
								'type' => 'error',
								'msg'  => esc_html__( 'File permission error. Local file could not be installed.', 'dina-kala' ) . ' ' . $subtype,
							)
						);

						die;
				}

				Redux_Core::$filesystem->execute( 'rmdir', $temp, array( 'recursive' => true ) );

				$this->generate_css();

				wp_delete_attachment( $attachment_id, true );
			} else {
				echo wp_json_encode(
					array(
						'type' => 'error',
						'msg'  => esc_html__( 'File type not recognized.', 'dina-kala' ) . ' ' . $subtype,
					)
				);

				die();
			}

			if ( is_array( $ret ) && ! empty( $ret ) ) {
				$msg = esc_html__( 'Unidentified error.', 'dina-kala' );

				if ( isset( $ret['msg'] ) ) {
					$msg = $ret['msg'];
				}

				return $msg;
			}

			return '';
		}

		/**
		 * Install selected file into Custom Fonts.
		 *
		 * @return bool
		 */
		private function convert_local_font(): bool {
			$param_array = array(
				'destination' => $this->upload_dir . $this->subfolder . '/' . $this->font_folder . '/' . $this->font_filename,
				'overwrite'   => true,
				'chmod'       => 755,
			);

			return Redux_Core::$filesystem->execute( 'copy', $this->selected_file, $param_array );
		}

		/**
		 * Ping the WebFontOMatic API to get the missing files.
		 *
		 * @param string $fontname  Font name.
		 * @param array  $missing   Missing.
		 * @param array  $output    Output.
		 */
		private function get_missing_files( string $fontname, array $missing, array $output ) {
			if ( ! empty( $this->font_folder ) && ! empty( $missing ) ) {
				$temp = $this->upload_dir . 'temp';

				$font_ext = pathinfo( $this->font_filename, PATHINFO_EXTENSION );

				$unsupported = array( 'eot', 'woff', 'woff2' );

				// Find a file to convert from.
				foreach ( $output as $key => $value ) {
					if ( 'eot' === $key ) {
						continue;
					} else {
						$main = $key;
						break;
					}
				}

				if ( ! isset( $main ) ) {
					echo wp_json_encode(
						array(
							'type' => 'error',
							'msg'  => esc_html__( 'No valid font file was found.', 'dina-kala' ),
						)
					);

					Redux_Core::$filesystem->execute( 'rmdir', $temp, array( 'recursive' => true ) );
					Redux_Core::$filesystem->execute( 'rmdir', $this->upload_dir . $this->subfolder . $this->font_folder . '/', array( 'recursive' => true ) );

					die();
				}

				update_option( 'redux_custom_font_current', $this->font_folder . '.zip' );

				$boundary = wp_generate_password( 24 );

				$headers = array(
					'content-type' => 'multipart/form-data; boundary=' . $boundary,
					'user-agent'   => 'redux-custom-fonts-' . self::$version . ' using ' . wp_get_theme(),
				);

				$payload  = '--' . $boundary;
				$payload .= "\r\n";
				$payload .= 'Content-Disposition: form-data; name="md5"' . "\r\n\r\n";
				$payload .= md5( 'redux_custom_font' );
				$payload .= "\r\n";

				if ( $output[ $main ] ) {
					$payload .= '--' . $boundary;
					$payload .= "\r\n";
					$payload .= 'Content-Disposition: form-data; name="convert"; filename="' . basename( $output[ $main ] ) . '"' . "\r\n";
					$payload .= "\r\n";
					$payload .= Redux_Core::$filesystem->execute( 'get_contents', $output[ $main ] );
					$payload .= "\r\n";
				}

				$payload .= '--' . $boundary . '--';

				$args = array(
					'headers'    => $headers,
					'body'       => $payload,
					'user-agent' => $headers['user-agent'],
					'timeout'    => 300,
					'sslverify'  => true,
				);

				// phpcs:disable WordPress.NamingConventions.ValidHookName
				$api_url = apply_filters( 'redux/' . $this->parent->args['opt_name'] . '/extensions/custom_fonts/api_url', 'https://redux.io/fonts' );

				$response = wp_remote_post( $api_url, $args );

				if ( is_wp_error( $response ) ) {
					return array(
						'type' => 'error',
						'msg'  => $response->get_error_message() . '<br><br>' . esc_html__( 'Your font could not be converted at this time. Please try again later.', 'dina-kala' ),
					);
				} elseif ( isset( $response['body'] ) ) {
					if ( null !== json_decode( $response['body'] ) ) {
						return json_decode( $response['body'], true );
					}
				}

				$param_array = array(
					'content'   => $response['body'],
					'overwrite' => true,
					'chmod'     => FS_CHMOD_FILE,
				);

				$zip_file = $temp . DIRECTORY_SEPARATOR . $fontname . '.zip';

				Redux_Core::$filesystem->execute( 'put_contents', $zip_file, $param_array );

				if ( 0 === filesize( $zip_file ) ) {
					return false;
				}

				$zip = unzip_file( $zip_file, $temp );

				if ( ! is_wp_error( $zip ) ) {
					$params = array(
						'include_hidden' => false,
						'recursive'      => false,
					);

					$files = Redux_Core::$filesystem->execute( 'dirlist', $temp . DIRECTORY_SEPARATOR . 'fonts' . DIRECTORY_SEPARATOR, $params );

					foreach ( $files as $file ) {
						$param_array = array(
							'destination' => $this->upload_dir . $this->subfolder . $this->font_folder . DIRECTORY_SEPARATOR . sanitize_file_name( $file['name'] ),
							'overwrite'   => true,
							'chmod'       => 755,
						);

						Redux_Core::$filesystem->execute( 'move', $temp . DIRECTORY_SEPARATOR . 'fonts' . DIRECTORY_SEPARATOR . ( $file['name'] ), $param_array );
					}
				} else {
					$path_parts = pathinfo( $output[ $main ] );

					$param_array = array(
						'destination' => $this->upload_dir . $this->subfolder . $this->font_folder . DIRECTORY_SEPARATOR . sanitize_file_name( $path_parts['basename'] ),
						'overwrite'   => true,
						'chmod'       => 755,
					);

					Redux_Core::$filesystem->execute( 'move', $output[ $main ], $param_array );

					if ( in_array( $font_ext, $unsupported, true ) ) {
						return array(
							'type' => 'error',
							// translators: %s = font extension.
							'msg'  => $zip->get_error_message() . '<br><br>' . sprintf( esc_html__( 'The font converter does not support %s fonts.', 'dina-kala' ), $font_ext ),
						);
					} else {
						return array(
							'type' => 'error',
							'msg'  => $zip->get_error_message() . '<br><br>' . esc_html__( 'ZIP error. Your font could not be converted at this time. Please try again later.', 'dina-kala' ),
						);
					}
				}

				delete_option( 'redux_custom_font_current' );
			}

			return true;
		}

		/**
		 * Check if the file name is a valid font file.
		 *
		 * @param array $file File.
		 *
		 * @return bool|string
		 */
		private function check_font_name( array $file ) {
			if ( '.woff' === strtolower( substr( $file['name'], - 5 ) ) ) {
				return 'woff';
			}

			if ( '.woff2' === strtolower( substr( $file['name'], - 6 ) ) ) {
				return 'woff2';
			}

			$sub = strtolower( substr( $file['name'], - 4 ) );

			if ( '.ttf' === $sub ) {
				return 'ttf';
			}

			if ( '.eot' === $sub ) {
				return 'eot';
			}

			if ( '.svg' === $sub ) {
				return 'svg';
			}

			if ( '.otf' === $sub ) {
				return 'otf';
			}

			return false;
		}

		/**
		 * Generate a new custom CSS file for enqueuing on the frontend and backend.
		 */
		private function generate_css() {
			$params = array(
				'include_hidden' => false,
				'recursive'      => true,
			);

			$fonts = Redux_Core::$filesystem->execute( 'dirlist', $this->upload_dir . 'custom' . DIRECTORY_SEPARATOR, $params );

			if ( empty( $fonts ) || ! is_array( $fonts ) ) {
				return;
			}

			foreach ( $fonts as $font ) {
				if ( 'd' === $font['type'] ) {
					break;
				}

				if ( file_exists( $this->upload_dir . 'fonts.css' ) ) {
					Redux_Core::$filesystem->execute( 'delete', $this->upload_dir . 'fonts.css' );
				}

				return;
			}

			$css = '';

			foreach ( $fonts as $font ) {
				if ( 'd' === $font['type'] ) {
					$css .= $this->generate_font_css( $font['name'], $this->upload_dir . 'custom' . DIRECTORY_SEPARATOR );
				}
			}

			if ( '' !== $css ) {
				$param_array = array(
					'content' => $css,
					'chmod'   => FS_CHMOD_FILE,
				);

				Redux_Core::$filesystem->execute( 'put_contents', $this->upload_dir . 'fonts.css', $param_array );
			}
		}

		/**
		 * Process to actually construct the custom font css file.
		 *
		 * @param string $name Name.
		 * @param string $dir  Directory.
		 *
		 * @return string
		 */
		private function generate_font_css( string $name, string $dir ): ?string {
			$path = $dir . $name;

			$params = array(
				'include_hidden' => false,
				'recursive'      => true,
			);

			$files = Redux_Core::$filesystem->execute( 'dirlist', $path, $params );

			if ( empty( $files ) ) {
				return null;
			}

			$output = array();

			foreach ( $files as $file ) {
				$output[ $this->check_font_name( $file ) ] = $file['name'];
			}

			$css = '@font-face {';

			$css .= 'font-family:"' . $name . '";';

			$src = array();

			if ( isset( $output['eot'] ) ) {
				$src[] = "url('{$this->upload_url}custom/$name/{$output['eot']}?#iefix') format('embedded-opentype')";
			}

			if ( isset( $output['woff'] ) ) {
				$src[] = "url('{$this->upload_url}custom/$name/{$output['woff']}') format('woff')";
			}

			if ( isset( $output['woff2'] ) ) {
				$src[] = "url('{$this->upload_url}custom/$name/{$output['woff2']}') format('woff2')";
			}

			if ( isset( $output['ttf'] ) ) {
				$src[] = "url('{$this->upload_url}custom/$name/{$output['ttf']}') format('truetype')";
			}

			if ( isset( $output['svg'] ) ) {
				$src[] = "url('{$this->upload_url}custom/$name/{$output['svg']}#svg$name') format('svg')";
			}

			if ( ! empty( $src ) ) {
				$css .= 'src:' . implode( ', ', $src ) . ';';
			}

			// Replace font weight and style with sub-sets.
			$css .= 'font-weight: normal;';

			$css .= 'font-style: normal;';

			$css .= '}';

			return $css;
		}

		/**
		 * Custom function for filtering the section array.
		 * Good for child themes to override or add to the sections.
		 * Simply include this function in the child themes functions.php file.
		 * NOTE: the defined constants for URLs and directories will NOT be available at this point in a child theme,
		 * so you must use get_template_directory_uri() if you want to use any of the built-in icons
		 */
		public function add_section() {
			if ( ! isset( $this->parent->fontControl ) ) {
				$this->parent->sections[] = array(
					'title'  => esc_html__( 'Font Control', 'dina-kala' ),
					'desc'   => '<p class="description"></p>',
					'icon'   => 'el-icon-font',
					'id'     => 'redux_dynamic_font_control',
					// Leave this as a blank section, no options just some intro text set above.
					'fields' => array(),
				);

				for ( $i = count( $this->parent->sections ); $i >= 1; $i-- ) {
					if ( isset( $this->parent->sections[ $i ] ) && isset( $this->parent->sections[ $i ]['title'] ) && esc_html__( 'Font Control', 'dina-kala' ) === $this->parent->sections[ $i ]['title'] ) {
						$this->parent->fontControl                                        = $i;
						$this->parent->sections[ $this->parent->fontControl ]['fields'][] = array(
							'id'   => 'redux_font_control',
							'type' => 'custom_fonts',
						);

						break;
					}
				}
			}
		}
	}

	class_alias( Redux_Extension_Custom_Fonts::class, 'ReduxFramework_Extension_custom_fonts' );
}

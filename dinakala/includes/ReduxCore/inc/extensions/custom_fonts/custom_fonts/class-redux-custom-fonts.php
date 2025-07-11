<?php
/**
 * Redux Custom Font Field Class
 *
 * @package Redux
 * @author  Kevin Provance <kevin.provance@gmail.com> & Dovy Paukstys <dovy@reduxframework.com>
 * @class   Redux_Custom_Fonts
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Redux_Custom_Fonts' ) ) {

	/**
	 * Main ReduxFramework_custom_fonts class
	 *
	 * @since       1.0.0
	 */
	class Redux_Custom_Fonts extends Redux_Field {

		/**
		 * Set field defaults.
		 */
		public function set_defaults() {
			$defaults = array(
				'convert' => false,
				'eot'     => false,
				'svg'     => false,
				'ttf'     => false,
				'woff'    => true,
				'woff2'   => true,
			);

			$this->value = wp_parse_args( $this->value, $defaults );
		}

		/**
		 * Field Render Function.
		 * Takes the vars and outputs the HTML for the field in the settings
		 *
		 * @return      void
		 * @since       1.0.0
		 * @access      public
		 */
		public function render() {
			echo '</fieldset></td></tr>';
			echo '<tr>';
			echo '<td colspan="2">';
			echo '<fieldset
                    class="redux-field-container redux-field redux-field-init redux-container-custom_font"
                    data-type="' . esc_attr( $this->field['type'] ) . '"
                    data-id="' . esc_attr( $this->field['id'] ) . '"
                  >';

			$can_convert = true;

			$nonce = wp_create_nonce( 'redux_custom_fonts' );

			$this->field['custom_fonts'] = apply_filters( "redux/{$this->parent->args[ 'opt_name' ]}/field/typography/custom_fonts", array() ); // phpcs:ignore WordPress.NamingConventions.ValidHookName

			if ( $can_convert ) {
				echo '<div class="">';
				echo '<label for="custom-font-convert">';
				echo '<input type="hidden" class="checkbox-check" data-val="1" name="' . esc_attr( $this->field['name'] ) . '[convert]" value="' . esc_attr( $this->value['convert'] ) . '"/>';
				echo '<input type="checkbox" class="checkbox" id="custom-font-convert" value="1"' . checked( $this->value['convert'], '1', false ) . '">';
				echo 'Enable font conversion';
				echo '</label>';
				echo '</div>';
				echo '</div>';
			}

			if ( ! empty( $this->field['custom_fonts'] ) ) {
				foreach ( $this->field['custom_fonts'] as $section => $fonts ) {
					if ( empty( $fonts ) ) {
						continue;
					}

					echo '<h3>' . esc_html( $section ) . '</h3>';
					echo '<div class="font-error" style="display: none;"><p><strong>' . esc_html__( 'Error', 'dina-kala' ) . '</strong>: <span></span></p></div>';

					echo '<table class="wp-list-table widefat plugins" style="border-spacing:0;"><tbody>';

					foreach ( $fonts as $font => $pieces ) {
						echo '<tr class="active">';
						echo '<td class="plugin-title" style="min-width: 40%"><strong>' . esc_html( $font ) . '</strong></td>';
						echo '<td class="column-description desc">';
						echo '<div class="plugin-description">';

						if ( is_array( $pieces ) && ! empty( $pieces ) ) {
							foreach ( $pieces as $piece ) {
								echo '<span class="button button-primary button-small font-pieces">' . esc_html( $piece ) . '</span>';
							}
						}

						echo '</div>';
						echo '</td>';
						echo '<td style="width: 140px;"><div class="action-row visible">';
						echo '<span style="display:none;"><a href="#" class="rename">Rename</a> | </span>';
						echo '<a href="#" class="fontDelete delete" data-section="' . esc_attr( $section ) . '" data-name="' . esc_attr( $font ) . '" data-type="delete">' . esc_html__( 'Delete', 'dina-kala' ) . '</a>';
						echo '<span class="spinner" style="display:none; visibility: visible;"></span>';
						echo '</div>';
						echo '</td>';
						echo '</tr>';
					}

					echo '</tbody></table>';
				}

				echo '<div class="upload_button_div"><span class="button media_add_font" data-nonce="' . esc_attr( $nonce ) . '" id="' . esc_attr( $this->field['id'] ) . '-custom_fonts">' . esc_html__( 'Add Font', 'dina-kala' ) . '</span></div><br />';
			} else {
				echo '<h3>' . esc_html__( 'No Custom Fonts Found', 'dina-kala' ) . '</h3>';
				echo '<div class="upload_button_div"><span class="button media_add_font" data-nonce="' . esc_attr( $nonce ) . '" id="' . esc_attr( $this->field['id'] ) . '-custom_fonts">' . esc_html__( 'Add Font', 'dina-kala' ) . '</span></div>';
			}

			echo '</fieldset></td></tr>';
		}

		/**
		 * Functions to pass data from the PHP to the JS at render time.
		 *
		 * @param array  $field Field.
		 * @param string $value Value.
		 *
		 * @return array
		 */
		public function localize( $field, $value = '' ): array {
			$params = array();

			if ( ! isset( $field['mode'] ) ) {
				$field['mode'] = 'image';
			}

			$params['mode'] = $field['mode'];

			if ( empty( $value ) && isset( $this->value ) ) {
				$value = $this->value;
			}

			$params['val'] = $value;

			return $params;
		}

		/**
		 * Enqueue Function.
		 * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
		 *
		 * @return      void
		 * @since       1.0.0
		 * @access      public
		 */
		public function enqueue() {
			$min = Redux_Functions::isMin();

			wp_enqueue_script(
				'redux-field-custom-fonts',
				$this->url . '/redux-custom-fonts' . $min . '.js',
				array( 'jquery', 'redux-block-ui' ),
				Redux_Extension_Custom_Fonts::$version,
				true
			);

			wp_localize_script(
				'redux-field-custom-fonts',
				'redux_custom_fonts_l10',
				apply_filters(
					'redux_custom_fonts_localized_data',
					array(
						'delete_error' => esc_html__( 'There was an error deleting your font:', 'dina-kala' ),
						'unzip'        => esc_html__( 'Unzipping archive and generating any missing font files.', 'dina-kala' ),
						'convert'      => esc_html__( 'Converting font file(s)...', 'dina-kala' ),
						'partial'      => esc_html__( 'The only file(s) imported were those uploaded.  Please refresh the page to continue (making note of any errors before doing so, please).', 'dina-kala' ),
						'unknown'      => esc_html__( 'An unknown error occurred. Please try again.', 'dina-kala' ),
						'complete'     => esc_html__( 'Conversion complete.  Refreshing page...', 'dina-kala' ),
						'media_title'  => esc_html__( 'Choose Font file or ZIP of font files.', 'dina-kala' ),
						'media_button' => esc_html__( 'Update', 'dina-kala' ),
					)
				)
			);

			if ( $this->parent->args['dev_mode'] ) {
				wp_enqueue_style(
					'redux-field-custom-fonts',
					$this->url . 'redux-custom-fonts.css',
					array(),
					Redux_Extension_Custom_Fonts::$version
				);
			}

			$class = Redux_Extension_Custom_Fonts::$instance;

			if ( ! empty( $class->custom_fonts ) ) {
				if ( file_exists( $class->upload_dir . 'fonts.css' ) ) {
					wp_enqueue_style(
						'redux-custom_fonts',
						$class->upload_url . 'fonts.css',
						array(),
						Redux_Core::$version
					);
				}
			}
		}
	}
}

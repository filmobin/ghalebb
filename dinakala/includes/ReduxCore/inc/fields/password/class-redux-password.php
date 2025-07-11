<?php
/**
 * Password Field.
 *
 * @package     ReduxFramework/Fields
 * @author      Dovy Paukstys & Kevin Provance (kprovance)
 * @version     4.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Redux_Password', false ) ) {

	/**
	 * Class Redux_Password
	 */
	class Redux_Password extends Redux_Field {

		/**
		 * Field Render Function.
		 * Takes the vars and outputs the HTML for the field in the settings
		 *
		 * @since ReduxFramework 1.0.1
		 */
		public function render() {
			if ( ! empty( $this->field['username'] ) && true === $this->field['username'] ) {
				$this->render_combined_field();
			} else {
				$this->render_single_field();
			}
		}

		/**
		 * This will render a combined User/Password field
		 *
		 * @since ReduxFramework 3.0.9
		 * @example
		 *        <code>
		 *        array(
		 *        'id'          => 'smtp_account',
		 *        'type'        => 'password',
		 *        'username'    => true,
		 *        'title'       => 'SMTP Account',
		 *        'placeholder' => array('username' => 'Username')
		 *        )
		 *        </code>
		 */
		private function render_combined_field() {
			$defaults = array(
				'username'    => '',
				'password'    => '',
				'placeholder' => array(
					'password' => esc_html__( 'Password', 'dina-kala' ),
					'username' => esc_html__( 'Username', 'dina-kala' ),
				),
			);

			$this->value = wp_parse_args( $this->value, $defaults );

			if ( ! empty( $this->field['placeholder'] ) ) {
				if ( is_array( $this->field['placeholder'] ) ) {
					if ( ! empty( $this->field['placeholder']['password'] ) ) {
						$this->value['placeholder']['password'] = $this->field['placeholder']['password'];
					}
					if ( ! empty( $this->field['placeholder']['username'] ) ) {
						$this->value['placeholder']['username'] = $this->field['placeholder']['username'];
					}
				} else {
					$this->value['placeholder']['password'] = $this->field['placeholder'];
				}
			}

			// Username field.
			echo '<input 
					type="text" 
					autocomplete="off" 
					placeholder="' . esc_attr( $this->value['placeholder']['username'] ) . '" 
					id="' . esc_attr( $this->field['id'] ) . '[username]" 
					name="' . esc_attr( $this->field['name'] . $this->field['name_suffix'] ) . '[username]" 
					value="' . esc_attr( $this->value['username'] ) . '" 
					class="' . esc_attr( $this->field['class'] ) . '" />&nbsp;';

			// Password field.
			echo '<input 
					type="password" 
					autocomplete="off" 
					placeholder="' . esc_attr( $this->value['placeholder']['password'] ) . '" 
					id="' . esc_attr( $this->field['id'] ) . '[password]" 
					name="' . esc_attr( $this->field['name'] . $this->field['name_suffix'] ) . '[password]" 
					value="' . esc_attr( $this->value['password'] ) . '" 
					class="' . esc_attr( $this->field['class'] ) . '" />';
		}

		/**
		 * This will render a single Password field
		 *
		 * @since ReduxFramework 3.0.9
		 * @example
		 *        <code>
		 *        array(
		 *        'id'    => 'smtp_password',
		 *        'type'  => 'password',
		 *        'title' => 'SMTP Password'
		 *        )
		 *        </code>
		 */
		private function render_single_field() {
			echo '<input 
					type="password" 
					id="' . esc_attr( $this->field['id'] ) . '" 
					name="' . esc_attr( $this->field['name'] . $this->field['name_suffix'] ) . '" 
					value="' . esc_attr( $this->value ) . '" 
					class="' . esc_attr( $this->field['class'] ) . '" />';
		}
	}
}

class_alias( 'Redux_Password', 'ReduxFramework_Password' );

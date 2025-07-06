<?php
/*
Theme Designed By: Meysam Hosseinkhani
Email: Meysam98@Gmail.com
Demo Website: Dinakala.I-design.ir
Author Website: i-design.ir
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
    exit;

if ( dina_opt( 'show_swatches_archive' ) ) {
	switch ( dina_opt( 'swatches_archive_location' ) ) {
		case 'swatches-bottom-image':
			$location = 'dina_after_shop_loop_item_img';
			break;
		case 'swatches-above-title':
			$location = 'dina_before_shop_loop_item_title';
			break;
		case 'swatches-between-title':
			$location = 'dina_after_shop_loop_item_title';
			break;
		case 'swatches-right-side':
			$location = 'dina_after_shop_loop_item_img';
			break;
		case 'swatches-left-side':
			$location = 'dina_after_shop_loop_item_img';
			break;
		case 'swatches-right-corner':
			$location = 'dina_after_shop_loop_item_img';
			break;
		case 'swatches-left-corner':
			$location = 'dina_after_shop_loop_item_img';
			break;
		default:
			$location = 'dina_after_shop_loop_item_img';
	}
	add_action ( $location, 'dina_swatches_list' );
}

//Dina show attribute swatches list in arvhive pages
if ( ! function_exists( 'dina_swatches_list' ) ) {
	function dina_swatches_list( $attribute_name = false ) {
		global $product;

		$id = $product->get_id();

		if ( empty( $id ) || ! $product->is_type( 'variable' ) ) {
			return false;
		}

		if ( ! $attribute_name ) {
			$attribute_name = dina_opt( 'swatches_archive_attr' );
		}

		$attribute_name_alternative = dina_opt( 'swatches_archive_attr_alternative' );

		if ( empty( $attribute_name ) ) {
			return false;
		}

		$available_variations = array();

		if ( ! $available_variations ) {
			$available_variations = $product->get_available_variations();
		}

		if ( empty( $available_variations ) ) {
			return false;
		}

		if ( dina_opt( 'show_swatches_archive_instock' ) ) {
			$variations = array();
			foreach( $available_variations as $available_variation ) {
				if ( $available_variation['is_in_stock'] == 1 ) {
					$variations[] = $available_variation;
				}
			}
			$available_variations = $variations;
		} 

		if ( empty( $available_variations ) ) {
			return false;
		}

		$swatches_to_show = dina_get_option_variations( $attribute_name, $available_variations, false, $id );

		if ( empty( $swatches_to_show ) && ! empty( $attribute_name_alternative ) ) {
			$attribute_name   = $attribute_name_alternative;
			$swatches_to_show = dina_get_option_variations( $attribute_name, $available_variations, false, $id );
		}

		if ( empty( $swatches_to_show ) )
			return false;

		$out = '';

		$out .= '<div class="dina-archive-swatches">';
		
		$index = 0;

		foreach ( $swatches_to_show as $key => $swatch ) {
			$style = $class = '';
			
			$swatch_limit = dina_opt( 'swatches_archive_count' );
			if ( dina_opt( 'enable_swatches_archive_count' ) && count( $swatches_to_show ) > (int) $swatch_limit ) {
				if ( $index >= $swatch_limit ) {
					$class .= ' dina-hidden';
				}
				if ( $index === (int) $swatch_limit ) {
					//dina_enqueue_js_script( 'swatches-limit' );
					$out .= '<div class="dina-swatches-divider">+' . ( count( $swatches_to_show ) - (int) $swatch_limit ) . '</div>';
				}
			}
			
			$index++;
			
			if ( ! empty( $swatch['color'] ) ) {
				$style = 'style="background-color:' . $swatch['color'] . '"';
				$class .= ' dina-swatch-with-bg';
				$class .= dina_opt( 'swatches_circle_style' ) ? ' dina-swatche-circle' : '';
			} elseif ( $swatch['text'] ) {
                $style = '';
				$class .= ' dina-swatch-text';
			}

			$term = get_term_by( 'slug', $key, $attribute_name );

			switch ( dina_opt( 'swatches_archive_location' ) ) {
				case 'swatches-bottom-image':
					$placement = 'top';
					break;
				case 'swatches-above-title':
					$placement = 'top';
					break;
				case 'swatches-between-title':
					$placement = 'top';
					break;
				case 'swatches-right-side':
					$placement = 'left';
					break;
				case 'swatches-left-side':
					$placement = 'right';
					break;
				case 'swatches-right-corner':
					$placement = 'left';
					break;
				case 'swatches-left-corner':
					$placement = 'right';
					break;
				default:
					$placement = 'top';
			}

			if ( isset ( $term->name ) ) {
				$title = dina_opt( 'show_swatches_archive_title' ) ? ' data-toggle="tooltip" data-placement="'. $placement .'" title="'. $term->name .'"' : '';
				$out .= '<div class="dina-archive-swatch' . esc_attr( $class ) . '" ' . $style . $title . '>' . $term->name . '</div>';
			}
			
		}

		$out .= '</div>';

		echo $out;

	}
}

//dina_get_option_variations
if ( ! function_exists( 'dina_get_option_variations' ) ) {
	function dina_get_option_variations( $attribute_name, $available_variations, $option = false, $product_id = false ) {
		$swatches_to_show = array();

		//$product_image_id = get_post_thumbnail_id( $product_id );

		foreach ( $available_variations as $key => $variation ) {
			$option_variation = array();
			$attr_key         = 'attribute_' . $attribute_name;
			if ( ! isset( $variation['attributes'][ $attr_key ] ) ) {
				return;
			}

			$val = $variation['attributes'][ $attr_key ];

			// Get all variations with swatches to show by attribute name
            $swatch                   = dina_has_swatch( $product_id, $attribute_name, $val );
            $swatches_to_show[ $val ] = $swatch;
		}

		return $swatches_to_show;

	}
}

//dina_has_swatch
if ( ! function_exists( 'dina_has_swatch' ) ) {
	function dina_has_swatch( $id, $attr_name, $value ) {
		$swatches = array();

		$color = $image = $not_dropdown = '';

		$term = get_term_by( 'slug', $value, $attr_name );
		if ( is_object( $term ) ) {
			$color        = get_term_meta( $term->term_id, 'product_attribute_color', true );
		}

		if ( $color != '' ) {
			$swatches['color'] = $color;
		} else {
            $swatches['text'] = true;
        }

		return $swatches;
	}
}
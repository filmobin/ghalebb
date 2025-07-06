<?php
/*
Theme Designed By: Meysam Hosseinkhani
Email: Meysam98@Gmail.com
Author Website: i-design.ir
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) 
    exit;

class Yamm_Nav_Walker extends Walker_Nav_Menu
{

    // Starts the list before the elements are added.
    public function start_lvl(&$output, $depth = 0, $args = array() )
    {
        if ( $depth == 0 ) {
            $output .= "\n<ul class=\"dropdown-menu\">\n";
        } elseif ( $depth == 1 ) {
            $output .= "\n<ul class=\"elementy-ul yamm-fw\">\n";
        }
    }

    // Starts the element output.
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $item_html = '';
        parent::start_el( $item_html, $item, $depth, $args );

        if ( dina_opt( 'site_schema' ) ) { $itemprop =' itemprop="url"'; } else { $itemprop =''; }
        if ( $item->is_dropdown && ( $depth === 0 ) ) {
            $item_html = str_replace( '<a', '<a'.$itemprop.' class="dropdown-toggle menu-link"', $item_html);
            $item_html = str_replace( '</a>', ' <b class="fal fa-angle-down" aria-hidden="true"></b></a>', $item_html);
        } elseif ( ! ( $item->is_dropdown ) || ( $depth != 0 ) ) {
            $item_html = str_replace( '<a', '<a'.$itemprop.' class="menu-link"', $item_html);
        } elseif (stristr( $item_html, 'li class="divider' ) ) {
            $item_html = preg_replace( '/<a[^>]*>.*?<\/a>/iU', '', $item_html);
        } elseif (stristr( $item_html, 'li class="dropdown-header' ) ) {
            $item_html = preg_replace( '/<a[^>]*>(.*)<\/a>/iU', '$1', $item_html);
        } else {
            $item_html = str_replace( '<a', '<a'.$itemprop.'', $item_html);
        }

        $item_html = apply_filters( 'roots_wp_nav_menu_item', $item_html);
        $output .= $item_html;
    }

    public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        
        $depth = ! isset ( $depth ) ? 0 : $depth;

        $element->is_dropdown = ( ( ! empty ( $children_elements[$element->ID] ) && ( ( $depth + 1 ) < $max_depth || ( $max_depth === 0 ) ) ) );

        if ( $depth === 0 && ( $element->cmega ) === 'on' ) {
            $element->classes[] = 'no-mega';
        } elseif ( $depth === 0 && $element->is_dropdown ) {
            $element->classes[] = 'mega-menu';
        }

        if ( $element->is_dropdown ) {
            $element->classes[] = 'dropdown';
        }

        if ( $element && ( $depth === 1) && ( ! empty( $children_elements[$element->ID] ) )) {
            $element->classes[] = 'menu-col';
        }

        if ( $element && ( $depth === 2) && ( ! empty( $children_elements[$element->ID] ) ) ) {
            
            $element->classes[] = 'sub-menu-col';
        }

        if ( $element && ( $depth > 1 ) ) {
            switch ( dina_opt( 'maga_column' ) ) {
                case 'three':
                    $col_class= 'col-md-4';
                    break;
                case 'four':
                    $col_class= 'col-md-3';
                    break;
                case 'five':
                    $col_class= 'col-md-3 menu-col-5';
                    break;
                case 'six':
                    $col_class= 'col-md-2';
                    break;
                case 'seven':
                    $col_class= 'col-md-2 menu-col-7';
                    break;
                case 'eight':
                    $col_class= 'col-md-2 menu-col-8';
                    break;
                default:
                    $col_class= 'col-md-3';
            }
            $element->classes[] = $col_class;
        }

        if ( $depth === 2 && ! empty( $element->image) && ( $element->cimage) === 'on' ) {
            $output .= '<li class="menu-image"><img title="'.$element->title.'" alt="'.$element->title.'" src="'.$element->image.'" width="220" height="220"></li>';
        }

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output);
    }

    // 	Ends the list of after the elements are added.
    public function end_lvl(&$output, $depth = 0, $args = array() )
    {        
        $output .= ( $depth == 0 ) || ( $depth == 1 ) ? "\n</ul>\n" : "";
    }
}

// Fallback to simple list
function Yamm_Nav_Walker_menu_fallback()
{   

    if ( dina_opt( 'site_schema' ) ) { $itemprop = ' itemprop="url"'; }

    $fb_output = '<ul class="nav navbar-nav yamm">';

    $fb_output .= '<li><a'. $itemprop .' href="'. dina_logo_link() .'">'. __( 'Home' , 'dina-kala' ) .'</a></li>';

    if ( current_user_can( 'manage_options' ) ) {
        $fb_output .= '<li><a'. $itemprop .' href="' . admin_url( 'nav-menus.php' ) . '">'. __( 'Add Menu' , 'dina-kala' ) .'</a></li>';
    }

    $fb_output .= '</ul>';

    echo $fb_output;

}
<?php
/*
Theme Designed By: Meysam Hosseinkhani
Email: Meysam98@Gmail.com
Author Website: i-design.ir
*/
   // Exit if accessed directly
   if ( ! defined( 'ABSPATH' ) ) exit;
class CSS_Menu_Maker_Walker extends Walker_Nav_Menu {

  var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );

  function start_lvl( &$output, $depth = 0, $args = array() ) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul>\n";
  }

  function end_lvl( &$output, $depth = 0, $args = array() ) {
    $indent = str_repeat("\t", $depth);
    $output .= "$indent</ul>\n";
  }

  function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

    global $wp_query;
    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
    $class_names = $value = '';        
    $classes = empty( $item->classes ) ? array() : (array) $item->classes;

    /* Add active class */
    if (in_array( 'current-menu-item', $classes) ) {
      $classes[] = 'active';
      unset( $classes['current-menu-item'] );
    }

    /* Check for children */
    $children = get_posts(array( 'post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID) );
    if ( ! empty( $children) ) {
      $classes[] = 'has-sub';
    }

    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
    $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

    $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
    $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

    $output .= $indent . '<li' . $id . $value . $class_names .'>';

    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
    
    if ( dina_opt( 'site_schema' ) ) { $itemprop =' itemprop="url"'; } else { $itemprop =''; }

    $iicon = "";

    if ( ! empty( $item->icon_image ) ) {
        $iicon = '<img src="'.$item->icon_image.'" width="22" height="22" alt="'.$item->title.'" class="cu-menu-icon">';
    } elseif ( ! empty( $item->icon) && $item->icon != 'none' ) {
        $iicon = '<i class="'.$item->icon.'"></i>';
    }

    $ilabel = "";

    if ( ! empty( $item->dlabel ) ) {
      $ilabel = '<span class="dmenu_label">'.$item->dlabel.'</span>';
    }

    $item_output = $args->before;
    $item_output .= '<span><a'. $itemprop . $attributes .'>'. $iicon;
    $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
    $item_output .= $ilabel.'</a></span>';
    $item_output .= $args->after;

    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }

  function end_el( &$output, $item, $depth = 0, $args = array() ) {
    $output .= "</li>\n";
  }
}
/**
 * Fallback to simple list
 */
function CSS_Menu_Maker_fallback()
{
    $fb_output = '<ul class="menu">';

    if ( dina_opt( 'site_schema' ) ) {$itemprop =' itemprop="url"'; }
    $fb_output .= '<li><span><a'.$itemprop.' href="' . dina_logo_link() . '">'.__( 'Home' , 'dina-kala' ).'</a></span></li>';
    if ( current_user_can( 'manage_options' ) ) {
        $fb_output .= '<li><span><a'.$itemprop.' href="' . admin_url( 'nav-menus.php' ) . '">'.__( 'Add Menu' , 'dina-kala' ).'</a></span></li>';
    }
    $fb_output .= '</ul>';

    echo $fb_output;
}


<?php
/*
Theme Designed By: Meysam Hosseinkhani
Email: Meysam98@Gmail.com
Author Website: i-design.ir
*/
   // Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
class Dina_Product_widget extends WP_Widget {

   public function __construct() {
      $widget_ops = array(
         'classname'   => 'dina-product_widget',
         'description' => __( 'Products widget (DinaKala)', 'dina-kala' )
      );
      parent::__construct( 'dina-product', __( 'Products widget (DinaKala)', 'dina-kala' ), $widget_ops );
      $this->alt_option_name = 'dina-product_widget';
   }

   function widget( $args, $instance) {
      
      extract( $args );
      $title        = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Products widget (DinaKala)', 'dina-kala' ) : $instance['title'], $instance, $this->id_base);
      $number       = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
      $prod_sort    = isset( $instance['prod_sort'] ) ? esc_attr( $instance['prod_sort'] ) : 'latest';
      $prod_cat     = isset( $instance['prod_cat'] ) ? absint( $instance['prod_cat'] ) : '';
      $stock_status = isset( $instance['stock-status'] ) ? $instance['stock-status'] : '';

      $tax_query = array();
      array_push( $tax_query, array( 'relation' => 'AND' ) );			
      array_push( $tax_query, array(
         'taxonomy' => 'product_visibility',
         'field'    => 'name',
         'terms'    => 'exclude-from-catalog',
         'operator' => 'NOT IN',
      ) );
         
      switch ( $prod_sort) {
         case 'latest':
            $args = array(
               'posts_per_page' => $number,
               'post_type'      => 'product',
               'post_status'    => 'publish',
               'order'          => 'DESC' 
            );
            break;
         case 'latest-updated':
            $args = array(
               'posts_per_page' => $number,
               'post_type'      => 'product',
               'post_status'    => 'publish',
               'orderby'        => 'modified',
               'order'          => 'DESC'  
            );
            break;
         case 'saled':
            $args = array(
               'posts_per_page' => $number,
               'post_type'      => 'product',
               'post_status'    => 'publish',
               'meta_key'       => 'total_sales',
               'orderby'        => 'meta_value_num',
               'order'          => 'DESC' 
            );
            break;
         case 'discounted':
            $args = array(
               'posts_per_page' => $number,
               'post_type'      => 'product',
               'post_status'    => 'publish',
               'post__in'       => array_merge( array( 0 ), wc_get_product_ids_on_sale() ),
               'order'          => 'DESC'  
            );
            break;
         case 'viewed':
            $args = array(
               'posts_per_page' => $number,
               'post_type'      => 'product',
               'post_status'    => 'publish',
               'meta_key'       => dina_opt( 'views_meta_key' ),
               'orderby'        => 'meta_value_num',
               'order'          => 'DESC'  
            );
            break;
         case 'price-desc':
            $args = array(
               'posts_per_page' => $number,
               'post_type'      => 'product',
               'post_status'    => 'publish',
               'orderby'        => 'meta_value_num',
               'meta_key'       => '_price',
               'order'          => 'DESC'
            );
            break;
         case 'price-asc':
            $args = array(
               'posts_per_page' => $number,
               'post_type'      => 'product',
               'post_status'    => 'publish',
               'orderby'        => 'meta_value_num',
               'meta_key'       => '_price',
               'order'          => 'ASC' );
            break;
         case 'random':
            $args = array(
            'posts_per_page' => $number,
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'orderby'        => 'rand'  );
            break;
         case 'special':
            $args = array (
               'posts_per_page' => $number,
               'post_type'      => 'product',
               'post_status'    => 'publish',
               'order'          => 'DESC',
            );
            array_push( $tax_query, array(
               'taxonomy' => 'product_visibility',
               'field'    => 'name',
               'terms'    => 'featured',
            ) );
            break;
         default:
         $args = array(
            'posts_per_page' => $number,
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'order'          => 'DESC'
         );
      }

      if ( $prod_cat ) {
         array_push( $tax_query, array(
            'taxonomy' => 'product_cat',
            'field'    => 'term_id',
            'terms'    => $prod_cat
         ) );
      }

      if ( 'in-stock' === $stock_status ) {
         $args['meta_query'] = array(
				'relation' => 'AND',
				array(
					'key'     => '_stock_status',
					'value'   => 'outofstock',
					'compare' => 'NOT IN'
				)
			);
      }

      $args['tax_query'] = $tax_query;
            
      $products = get_posts( $args );				

      global $post;

      if ( ! is_object( $post ) ) 
         return;

      //save the current post
      $temp = $post;

      echo $before_widget;
      // Widget title
      echo $before_title;
      echo $instance["title"];
      echo $after_title; ?>

      <ul class="latest-posts">
         <?php
         if ( $products ) {
            foreach( $products as $post ) {
               setup_postdata( $post );
               global $product;
            ?>
               <li>
                  <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" target="<?php echo dina_link_target(); ?>">
                  <span class="post-image">
                     <?php
                     if ( has_post_thumbnail() ) :
                        the_post_thumbnail( 'thumbnail' );
                     else: 
                        prod_default_thumb();
                     endif; ?>
                  </span>
                  <span class="w-post-title">
                     <?php the_title();?>
                  </span>

                  <?php if ( $product->is_in_stock() ) { ?>
                     <span class="w-prod-desc">
                        <?php echo $product->get_price_html(); ?>
                     </span>
                  <?php } else { ?>
                     <span class="w-prod-desc nstock">
                        <?php echo dina_outofstock_text(); ?>
                     </span>
                  <?php } ?>
                  
                  </a>
               </li>
            <?php
            }
         } else {
            _e( 'No products found!', 'dina-kala' );
         }
         wp_reset_query();
         ?>
      </ul>

      <?php echo $after_widget;
   }

   //Update widget to DB
   public function update( $new_instance, $old_instance ) {
      $instance                 = $old_instance;
      $instance['title']        = sanitize_text_field( $new_instance['title'] );
      $instance['prod_sort']    = sanitize_text_field( $new_instance['prod_sort'] );
      $instance['number']       = (int) $new_instance['number'];
      $instance['stock-status'] = isset( $new_instance['stock-status'] ) ? sanitize_text_field( $new_instance['stock-status'] ) : '';
      $instance['prod_cat']     = (int) $new_instance['prod_cat'];
      return $instance;
   }

   //Display Widget Backend
   public function form( $instance ) {
      $title        = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
      $number       = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
      $prod_sort    = isset( $instance['prod_sort'] ) ? esc_attr( $instance['prod_sort'] ) : '';
      $stock_status = isset( $instance['stock-status'] ) ? $instance['stock-status'] : '';
      $prod_cat     = isset( $instance['prod_cat'] ) ? absint( $instance['prod_cat'] ) : 0;
   ?>
      <p>
         <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'dina-kala' ); ?></label>
         <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
      </p>

      <p>
         <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of products to show:', 'dina-kala' ); ?></label>
         <input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" />
      </p>

      <p>
         <label for="<?php echo $this->get_field_id( 'stock-status' ); ?>">
         <input type="checkbox" id="<?php echo $this->get_field_id( 'stock-status' ); ?>" value="in-stock" name="<?php echo $this->get_field_name( 'stock-status' ); ?>" <?php checked( $stock_status, 'in-stock' ); ?> />
         <?php _e( 'Show in stock products', 'dina-kala' ) ?>
         </label>
      </p>

      <label for="<?php echo $this->get_field_id( 'prod_sort' ); ?>"><?php _e( 'Products sorting', 'dina-kala' ) ?></label><br />
      <select class="widefat" name="<?php echo $this->get_field_name( 'prod_sort' ); ?>" id="<?php echo $this->get_field_id( 'prod_sort' ); ?>">
      <option value="latest" <?php selected( $prod_sort, 'latest' ); ?>><?php _e( 'Latest products', 'dina-kala' ) ?></option>
      <option value="latest-updated" <?php selected( $prod_sort, 'latest-updated' ); ?>><?php _e( 'Latest updated products', 'dina-kala' ) ?></option>
      <option value="random" <?php selected( $prod_sort, 'random' ); ?>><?php _e( 'Random products', 'dina-kala' ) ?></option>
      <option value="viewed" <?php selected( $prod_sort, 'viewed' ); ?>><?php _e( 'Most viewed products', 'dina-kala' ) ?></option>
      <option value="saled" <?php selected( $prod_sort, 'saled' ); ?>><?php _e( 'Best selling products', 'dina-kala' ) ?></option>
      <option value="saled" <?php selected( $prod_sort, 'price-desc' ); ?>><?php _e( 'Price (Descending)', 'dina-kala' ) ?></option>
      <option value="saled" <?php selected( $prod_sort, 'price-asc' ); ?>><?php _e( 'Price (Ascending)', 'dina-kala' ) ?></option>
      <option value="discounted" <?php selected( $prod_sort, 'discounted' ); ?>><?php _e( 'Discounted products', 'dina-kala' ) ?></option>
      <option value="special" <?php selected( $prod_sort, 'special' ); ?>><?php _e( 'Special products', 'dina-kala' ) ?></option>
      </select>

      <label for="<?php echo $this->get_field_id( 'prod_cat' ); ?>"><?php _e( 'Category', 'dina-kala' ) ?></label><br />

      <?php 
                  
      $args = array (
         'taxonomy'        => 'product_cat',
         'hide_empty'      => false,
         'show_count'      => 0,
         'hierarchical'    => 1,
         'id'              => $this->get_field_id( 'prod_cat' ),
         'show_option_all' => __( '--Select Category--', 'dina-kala' ),
         'value_field'     => 'term_id',
         'selected'        => $prod_cat,
         'name'            => $this->get_field_name( 'prod_cat' ),
         'class'           => 'widefat',
         'echo'            => 0
      );

      $categories = wp_dropdown_categories( $args );

      if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
            echo $categories;
      }
               
   }

}

// register Products Widget
add_action( 'widgets_init', function() { return register_widget( "Dina_Product_widget" ); } );
?>
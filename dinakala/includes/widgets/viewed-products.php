<?php
/*
Theme Designed By: Meysam Hosseinkhani
Email: Meysam98@Gmail.com
Author Website: i-design.ir
*/
   // Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
class Dina_Viewed_Product_widget extends WP_Widget {

public function __construct() {
   $widget_ops = array( 'classname' => 'dina-viewed-product_widget', 'description' => __( 'Viewed products widget (DinaKala)', 'dina-kala' ) );
   parent::__construct( 'dina-viewed-product', __( 'Viewed products widget (DinaKala)', 'dina-kala' ), $widget_ops );
   $this->alt_option_name = 'dina-viewed-product_widget';
}

//Display Widget Frontend
function widget( $args, $instance ) {
   
   extract( $args );

   $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Viewed products widget (DinaKala)', 'dina-kala' ) : $instance['title'], $instance, $this->id_base);
   $number  = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;

   $viewed_ids = ! empty( $_COOKIE['dina_recently_viewed'] ) ? (array) explode( '|', wp_unslash( $_COOKIE['dina_recently_viewed'] ) ) : array();
   $viewed_ids = array_reverse( array_filter( array_map( 'absint', $viewed_ids ) ) );

   if ( empty( $viewed_ids ) )
      return;
      
   $args = array(
      'posts_per_page' => $number,
      'no_found_rows'  => 1,
      'post_status'    => 'publish',
      'post_type'      => 'product',
      'post__in'       => $viewed_ids,
      'orderby'        => 'post__in',
   );
         
   $products = get_posts( $args );				

   global $post;

      if ( !is_object( $post) ) 
        return;
      //save the current post
      $temp = $post;

      echo $before_widget;

      // Widget title
      echo $before_title;
      echo $instance["title"];
      echo $after_title; ?>

      <ul class="latest-posts">

      <?php if ( $products ) {
         foreach( $products as $post ) {
            setup_postdata( $post );
         ?>

            <li>
               <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" target="<?php echo dina_link_target(); ?>">
               <span class="post-image">
                  <?php if ( has_post_thumbnail() ) :
                     the_post_thumbnail( 'thumbnail' );
                  else: 
                        prod_default_thumb();
                  endif; ?>
               </span>
               <span class="w-post-title">
                  <?php the_title();?>
               </span>
               <?php
               global $product;
               $in_stock = $product->is_in_stock(); ?>
               <?php if ( $in_stock) {
                  ?>
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
      }
      
      wp_reset_query();
      ?>

      </ul>

      <?php echo $after_widget;
}

//Update widget to DB
public function update( $new_instance, $old_instance ) {
   $instance           = $old_instance;
   $instance['title']  = sanitize_text_field( $new_instance['title'] );
   $instance['number'] = (int) $new_instance['number'];
   return $instance;
}

//Display Widget Backend
public function form( $instance ) {
   $title  = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
   $number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
?>
   <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'dina-kala' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
   </p>

   <p>
      <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of products to show:', 'dina-kala' ); ?></label>
      <input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" />
   </p>
   
<?php
}

}

// register Products Widget
add_action( 'widgets_init', function() { return register_widget("Dina_Viewed_Product_widget"); } );
?>
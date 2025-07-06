<?php
/*
Theme Designed By: Meysam Hosseinkhani
Email: Meysam98@Gmail.com
Author Website: i-design.ir
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) 
   exit;

class Dina_Post_widget extends WP_Widget {

   public function __construct() {
      $widget_ops = array(
         'classname'   => 'dina-post_widget',
         'description' => __( 'Posts widget (DinaKala)', 'dina-kala' )
      );
      parent::__construct( 'dina-post', __( 'Posts widget (DinaKala)', 'dina-kala' ), $widget_ops);
      $this->alt_option_name = 'dina-post_widget';
   }

function widget( $args, $instance) {
      
   extract( $args );

   $title     = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Posts widget (DinaKala)', 'dina-kala' ) : $instance['title'], $instance, $this->id_base);
   $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
   $post_sort = isset( $instance['post_sort'] ) ? esc_attr( $instance['post_sort'] ) : 'latest';
   $post_cat  = isset( $instance['post_cat'] ) ? absint( $instance['post_cat'] ) : '';
   
   switch ( $post_sort) {
      case 'latest':
         $posts = get_posts( 'orderby=date&numberposts='. $number .'&post_type=post&category='. $post_cat);
         break;
      case 'latest-updated':
         $posts = get_posts( 'orderby=modified&numberposts='. $number .'&post_type=post&category='. $post_cat);
         break;
      case 'viewed':
         $posts = get_posts( 'meta_key=post_views_count&orderby=meta_value_num&numberposts='. $number .'&post_type=post&order=DESC&category='. $post_cat);
         break;
      case 'random':
         $posts = get_posts( 'orderby=rand&numberposts='. $number .'&post_type=post&category='. $post_cat);
         break;
      default:
         $posts = get_posts( 'orderby=date&numberposts='. $number .'&post_type=post&category='. $post_cat);				
      }

   global $post;

   if ( ! is_object( $post ) ) 
     return;
      //save the current post
      $temp=$post;
      echo $before_widget;
      // Widget title
      echo $before_title;
      echo $instance["title"];
      echo $after_title; ?>

   <ul class="latest-posts">
      <?php if ( $posts ) {
         foreach( $posts as $post ) {
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
            <span class="w-post-desc">
                  <?php echo get_jdate_publish_time(); ?>
            </span>
            </a>
         </li>
   <?php
         }
      } else {
      _e( 'No posts found!', 'dina-kala' );
      }

   wp_reset_query();
   echo "</ul>\n";
   echo $after_widget;
   }

   public function update( $new_instance, $old_instance ) {
      $instance              = $old_instance;
      $instance['title']     = sanitize_text_field( $new_instance['title'] );
      $instance['post_sort'] = sanitize_text_field( $new_instance['post_sort'] );
      $instance['number']    = (int) $new_instance['number'];
      $instance['post_cat']  = (int) $new_instance['post_cat'];
      
      return $instance;
   }

   public function form( $instance ) {
      $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
      $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
      $post_sort = isset( $instance['post_sort'] ) ? esc_attr( $instance['post_sort'] ) : '';
      $post_cat  = isset( $instance['post_cat'] ) ? absint( $instance['post_cat'] ) : 0;
   ?>
      <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'dina-kala' ); ?></label>
         <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
      </p>
      <p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:', 'dina-kala' ); ?></label>
         <input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" />
      </p>
      <label for="<?php echo $this->get_field_id( 'post_sort' ); ?>"><?php _e( 'Posts sorting', 'dina-kala' ) ?></label><br />
      <select class="widefat" name="<?php echo $this->get_field_name( 'post_sort' ); ?>" id="<?php echo $this->get_field_id( 'post_sort' ); ?>">
         <option value="latest" <?php selected( $post_sort, 'latest' ); ?>><?php _e( 'Latest posts', 'dina-kala' ) ?></option>
         <option value="latest-updated" <?php selected( $post_sort, 'latest-updated' ); ?>><?php _e( 'Latest updated posts', 'dina-kala' ) ?></option>
         <option value="random" <?php selected( $post_sort, 'random' ); ?>><?php _e( 'Random posts', 'dina-kala' ) ?></option>
         <option value="viewed" <?php selected( $post_sort, 'viewed' ); ?>><?php _e( 'Most viewed posts', 'dina-kala' ) ?></option>
      </select>
   <label for="<?php echo $this->get_field_id( 'post_cat' ); ?>"><?php _e( 'Category', 'dina-kala' ) ?></label><br />
      <?php $categories = get_terms( array(
			'taxonomy'   => 'category',
			'hide_empty' => false,
		) );
      
      if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) { ?>
      <select class="widefat" name="<?php echo $this->get_field_name( 'post_cat' ); ?>" id="<?php echo $this->get_field_id( 'post_cat' ); ?>" >
      <option value=""><?php _e("--Select Category--",'dina-kala' ) ?></option>
      <?php foreach ( $categories as $category ) { ?>
      <option value="<?php echo $category->term_id ?>" <?php selected( $post_cat, $category->term_id ); ?>><?php echo $category->name ?></option>
      <?php } ?>
      </select>
      <?php } ?>
<?php
   }
   }
   // register Posts Widget
   add_action( 'widgets_init', function() {return register_widget("Dina_Post_widget");});
   ?>
<?php
/*
Plugin Name: Simple Link List Widget
Description: Enables a link list widget, in which you can display items in an ordered or unordered list.
Author: James Bowles
Author URI: http://thebowles.org
Version: 0.3.1
*/
define( 'SLLW_URI', get_template_directory_uri() . '/includes/widgets/simple-link-list-widget' );
class SimpleLinkListWidget extends WP_Widget {
	
	public function __construct() {
		$widget_ops = array( 'classname' => 'widget_link_list', 'description' => __( 'Link list (DinaKala)', 'dina-kala' ) );
		parent::__construct(
			'list', // Base ID
			__( 'Link list (DinaKala)', 'dina-kala' ), // Name
			$widget_ops
		);
		
		add_action( 'admin_enqueue_scripts', array( $this,'sllw_load_scripts' ) );
	}

	public function widget( $args, $instance ) {
		extract( $args);
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'List', 'dina-kala' ) : $instance['title'] );
		$type = empty( $instance['type'] ) ? 'unordered' : $instance['type'];
		$reverse = isset( $instance['reverse'] ) ? $instance['reverse'] : false;
		$amount = empty( $instance['amount'] ) ? 3 : $instance['amount'];
		
		for ( $i = 1; $i <= $amount; $i++) {
			$items[$i-1] = $instance['item'.$i];
			$item_links[$i-1] = $instance['item_link'.$i];
			$item_classes[$i-1] = $instance['item_class'.$i];	
			$item_targets[$i-1] = isset( $instance['item_target'.$i] ) ? $instance['item_target'.$i] : false;
		}
		
		if ( $reverse) {
			$items = array_reverse( $items);
			$item_links = array_reverse( $item_links);
			$item_classes = array_reverse( $item_classes);
			$item_targets = array_reverse( $item_targets);
		}

		echo $before_widget .  $before_title . $title . $after_title;
		if ( $type == "ordered") { echo "<ol ";} else { echo("<ul "); } ?> class="link-list">

		<?php foreach ( $items as $num => $item) : 
			if ( ! empty( $item) ) :
				if (empty( $item_links[$num] ) ) :
					echo("<li class='" . $item_classes[$num] . "'>" . $item . "</li>");
				else :
					if ( $item_targets[$num] ) :
						echo("<li class='" . $item_classes[$num] . "'><a href='" . $item_links[$num] . "' target='_blank'>" . $item . "</a></li>");
					else :
						echo("<li class='" . $item_classes[$num] . "'><a href='" . $item_links[$num] . "'>" . $item . "</a></li>");
					endif;
				endif;
			endif;
		endforeach;
		
      	if ( $type == "ordered") { echo "</ol>";} else { echo("</ul>"); }
		
		echo $after_widget;
	}

	public function update( $new_instance, $old_instance) {
		//$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$amount = $new_instance['amount'];
		$new_item = empty( $new_instance['new_item'] ) ? false : strip_tags( $new_instance['new_item'] );
		
		if ( isset( $new_instance['position1'] ) ) {
			for( $i=1; $i<= $new_instance['amount']; $i++) {
				if ( $new_instance['position'.$i] != -1) {
					$position[$i] = $new_instance['position'.$i];
				}else{
					$amount--;
				}
			}
			if ( $position) {
				asort( $position);
				$order = array_keys( $position);
				if (strip_tags( $new_instance['new_item'] ) ) {
					$amount++;
					array_push( $order, $amount);
				}
			}
			
		}else{
			$order = explode( ',',$new_instance['order'] );
			foreach( $order as $key => $order_str) {
				$num = strrpos( $order_str,'-' );
				if ( $num !== false) {
					$order[$key] = substr( $order_str,$num+1);
				}
			}
		}
		
		if ( $order) {
			foreach ( $order as $i => $item_num) {
				$instance['item'.( $i+1)] = empty( $new_instance['item'.$item_num] ) ? '' : strip_tags( $new_instance['item'.$item_num] );
				$instance['item_link'.( $i+1)] = empty( $new_instance['item_link'.$item_num] ) ? '' : strip_tags( $new_instance['item_link'.$item_num] );
				$instance['item_class'.( $i+1)] = empty( $new_instance['item_class'.$item_num] ) ? '' : strip_tags( $new_instance['item_class'.$item_num] );
				$instance['item_target'.( $i+1)] = empty( $new_instance['item_target'.$item_num] ) ? '' : strip_tags( $new_instance['item_target'.$item_num] );
			}
		}
		
		$instance['amount'] = $amount;
		$instance['type'] = strip_tags( $new_instance['type'] );
		$instance['reverse'] = empty( $new_instance['reverse'] ) ? '' : strip_tags( $new_instance['reverse'] );

		return $instance;
	}

	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '', 'title_link' => '' ) );
		$title = strip_tags( $instance['title'] );
		$amount = empty( $instance['amount'] ) ? 3 : $instance['amount'];
		
		for ( $i = 1; $i <= $amount; $i++) {
			$items[$i] = empty( $instance['item'.$i] ) ? '' : $instance['item'.$i];
			$item_links[$i] = empty( $instance['item_link'.$i] ) ? '' : $instance['item_link'.$i];
			$item_classes[$i] = empty( $instance['item_class'.$i] ) ? '' : $instance['item_class'.$i];
			$item_targets[$i] = empty( $instance['item_target'.$i] ) ? '' : $instance['item_target'.$i];
		}
		$title_link = $instance['title_link'];		
		$type = empty( $instance['type'] ) ? 'unordered' : $instance['type'];
		$reverse = empty( $instance['reverse'] ) ? '' : $instance['reverse'];
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'dina-kala' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title); ?>" /></p>
		<ul class="sllw-instructions">
			<li><?php _e("Empty items do not have output.", 'dina-kala' ); ?></li>
			<li><?php _e("Custom link and custom fields are optional.", 'dina-kala' ); ?></li>
			<li><?php _e("Links that are out of the web site must start with http://.", 'dina-kala' ); ?></li>
			<li class="hide-if-no-js"><?php _e("Click and drag the number of each item to change the display order.", 'dina-kala' ); ?></li>
			<li class="hide-if-no-js"><?php _e("To delete any item, click Delete.", 'dina-kala' ); ?></li>
			<li class="hide-if-js"><?php _e("Reorder or delete an item by using the 'Position/Action' table below.", 'dina-kala' ); ?></li>
			<li class="hide-if-js"><?php _e("To add a new item, click Add.", 'dina-kala' ); ?></li>
		</ul>
		<div class="simple-link-list">
		<?php foreach ( $items as $num => $item) :
			$item = esc_attr( $item);
			$item_link = esc_attr( $item_links[$num] );
			$item_class = esc_attr( $item_classes[$num] );
			$checked = checked( $item_targets[$num], 'on', false);
		?>
		
			<div id="<?php echo $this->get_field_id( $num); ?>" class="list-item">
				<h5 class="moving-handle"><span class="number"><?php echo $num; ?></span>. <span class="item-title"><?php echo $item; ?></span><a class="sllw-action hide-if-no-js"></a></h5>
				<div class="sllw-edit-item">
					<label for="<?php echo $this->get_field_id( 'item'.$num); ?>"><?php _e("Text:", 'dina-kala' ); ?></label>
					<input class="widefat" id="<?php echo $this->get_field_id( 'item'.$num); ?>" name="<?php echo $this->get_field_name( 'item'.$num); ?>" type="text" value="<?php echo $item; ?>" />
					<label for="<?php echo $this->get_field_id( 'item_link'.$num); ?>"><?php _e("Link:", 'dina-kala' ); ?></label>
					<input class="widefat" id="<?php echo $this->get_field_id( 'item_link'.$num); ?>" name="<?php echo $this->get_field_name( 'item_link'.$num); ?>" type="text" value="<?php echo $item_link; ?>" />
					<label for="<?php echo $this->get_field_id( 'item_class'.$num); ?>"><?php _e("Custom Style Class:", 'dina-kala' ); ?></label>
					<input class="widefat" id="<?php echo $this->get_field_id( 'item_class'.$num); ?>" name="<?php echo $this->get_field_name( 'item_class'.$num); ?>" type="text" value="<?php echo $item_class; ?>" />
					<input type="checkbox" name="<?php echo $this->get_field_name( 'item_target'.$num); ?>" id="<?php echo $this->get_field_id( 'item_target'.$num); ?>" <?php echo $checked; ?> /> <label for="<?php echo $this->get_field_id( 'item_target'.$num); ?>"><?php _e("Open in new window", 'dina-kala' ); ?></label>
					<a class="sllw-delete hide-if-no-js"><img src="<?php echo SLLW_URI.'/images/delete.png'; ?>" /> <?php _e("Delete", 'dina-kala' ); ?></a>
				</div>
			</div>
			
		<?php endforeach; 
		
		if ( isset( $_GET['editwidget'] ) && $_GET['editwidget'] ) : ?>
			<table class='widefat'>
				<thead><tr><th><?php _e("Item", 'dina-kala' ); ?></th><th><?php _e("Position / Function", 'dina-kala' ); ?></th></tr></thead>
				<tbody>
					<?php foreach ( $items as $num => $item) : ?>
					<tr>
						<td><?php echo esc_attr( $item); ?></td>
						<td>
							<select id="<?php echo $this->get_field_id( 'position'.$num); ?>" name="<?php echo $this->get_field_name( 'position'.$num); ?>">
								<option><?php _e( '&mdash; Select &mdash;', 'dina-kala' ); ?></option>
								<?php for( $i=1; $i<=count( $items); $i++) {
									if ( $i==$num) {
										echo "<option value='$i' selected>$i</option>";
									}else{
										echo "<option value='$i'>$i</option>";
									}
								} ?>
								<option value="-1"><?php _e("Delete", 'dina-kala' ); ?></option>
							</select>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			
			<div class="sllw-row">
				<input type="checkbox" name="<?php echo $this->get_field_name( 'new_item' ); ?>" id="<?php echo $this->get_field_id( 'new_item' ); ?>" /> <label for="<?php echo $this->get_field_id( 'new_item' ); ?>"><?php _e("Add Item", 'dina-kala' ); ?></label>
			</div>
		<?php endif; ?>
			
		</div>
		<div class="sllw-row hide-if-no-js">
			<a class="sllw-add button-secondary"><img src="<?php echo SLLW_URI.'/images/add.png';?>" /> <?php _e("Add Item", 'dina-kala' ); ?></a>
		</div>

		<input type="hidden" id="<?php echo $this->get_field_id( 'amount' ); ?>" class="amount" name="<?php echo $this->get_field_name( 'amount' ); ?>" value="<?php echo $amount ?>" />
		<input type="hidden" id="<?php echo $this->get_field_id( 'order' ); ?>" class="order" name="<?php echo $this->get_field_name( 'order' ); ?>" value="<?php echo implode( ',',range(1,$amount) ); ?>" />

		<div class="sllw-row">
			<label for="<?php echo $this->get_field_id( 'ordered' ); ?>"><input type="radio" name="<?php echo $this->get_field_name( 'type' ); ?>" value="ordered" id="<?php echo $this->get_field_id( 'ordered' ); ?>" <?php checked( $type, "ordered"); ?> />  <?php _e("Ordered", 'dina-kala' ); ?></label>
			<label for="<?php echo $this->get_field_id( 'unordered' ); ?>"><input type="radio" name="<?php echo $this->get_field_name( 'type' ); ?>" value="unordered" id="<?php echo $this->get_field_id( 'unordered' ); ?>" <?php checked( $type, "unordered"); ?> /> <?php _e("Unordered", 'dina-kala' ); ?></label>
		</div>

		<div class="sllw-row">
			<input type="checkbox" name="<?php echo $this->get_field_name( 'reverse' ); ?>" id="<?php echo $this->get_field_id( 'reverse' ); ?>" <?php checked( $reverse, 'on' ); ?> /> <label for="<?php echo $this->get_field_id( 'reverse' ); ?>"><?php _e("Reverse order of output", 'dina-kala' ); ?></label>
		</div>

<?php
	}
	
	public function sllw_load_scripts( $hook) {
		if ( $hook != 'widgets.php' ) 
			return;
		if ( !isset( $_GET['editwidget'] ) ) {
			wp_enqueue_script( 'sllw-sort-js', SLLW_URI .'/js/sllw-sort.js' );
		}
		wp_enqueue_style( 'sllw-css', SLLW_URI .'/css/sllw.css' );
	}
}

add_action( 'widgets_init', function() {return register_widget("SimpleLinkListWidget");});
?>
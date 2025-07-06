<?php
/*
Theme Designed By: Meysam Hosseinkhani
Email: Meysam98@Gmail.com
Author Website: i-design.ir
*/
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit; 

if ( is_active_sidebar( 'site-sidebar' ) ) : 
$side_sticky = ( dina_opt( 'side_sticky' ) ? ' sidesticky' : '' );
?>

<aside id="dinaSidebar" class="col-lg-3 sidebar<?php echo $side_sticky; ?>">
<div class="side-head">
      <a href="javascript:void(0)" class="mclosebtn" aria-label="<?php _e( 'Close', 'dina-kala' ); ?>" data-title="<?php _e( 'Close', 'dina-kala' ); ?>" rel="nofollow" onclick="closeSide()">
            <i class="fal fa-times" aria-hidden="true"></i>
      </a>
</div>
      <?php dynamic_sidebar( 'site-sidebar' );  ?>
</aside>
<div id="dinaCanvasSide" class="overlay3" onclick="closeSide()"></div>

<?php endif; ?>
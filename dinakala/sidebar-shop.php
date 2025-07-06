<?php
/*
Theme Designed By: Meysam Hosseinkhani
Email: Meysam98@Gmail.com
Author Website: i-design.ir
*/
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


if ( is_active_sidebar( 'shop-sidebar' ) ) { 

      $side_sticky = ( dina_opt( 'side_sticky' ) ? ' sidesticky' : '' );

      if (is_singular( 'product' ) ) {
            $pside = get_post_meta( get_the_ID(), 'dina_pside', true );
   
            if ( ( $pside == 'rside' || $pside == 'lside' ) && $pside != 'wside' ) {
      ?>

                  <aside id="dinaSidebar" class="col-lg-3 sidebar<?php echo $side_sticky; ?>">
                        <div class="side-head">
                              <a href="javascript:void(0)" class="mclosebtn" aria-label="<?php _e( 'Close', 'dina-kala' ); ?>" data-title="<?php _e( 'Close', 'dina-kala' ); ?>" rel="nofollow" onclick="closeSide()">
                                    <i class="fal fa-times" aria-hidden="true"></i>
                              </a>
                        </div>
                        <?php if ( dina_opt( 'product_page_side' ) ) {
                              dynamic_sidebar( 'product-sidebar' );
                        } else {
                              dynamic_sidebar( 'shop-sidebar' );
                        } ?>
                  </aside>

                  <div id="dinaCanvasSide" class="overlay3" onclick="closeSide()"></div>

      <?php 
            } elseif ( dina_opt( 'product_side' ) > 0 && $pside != 'wside' ) { ?>

                  <aside id="dinaSidebar" class="col-lg-3 sidebar<?php echo $side_sticky; ?>">
                        <div class="side-head">
                        <a href="javascript:void(0)" class="mclosebtn" aria-label="<?php _e( 'Close', 'dina-kala' ); ?>" data-title="<?php _e( 'Close', 'dina-kala' ); ?>" rel="nofollow" onclick="closeSide()">
                        <i class="fal fa-times" aria-hidden="true"></i>
                        </a>
                        </div>
                        <?php if ( dina_opt( 'product_page_side' ) ) {
                              dynamic_sidebar( 'product-sidebar' );
                        } else {
                              dynamic_sidebar( 'shop-sidebar' );
                        } ?>
                  </aside>

                  <div id="dinaCanvasSide" class="overlay3" onclick="closeSide()"></div>
      <?php 
            }
      } else {
            if ( dina_opt( 'product_archive_side' ) != 0) { ?>

                  <aside id="dinaSidebar" class="col-lg-3 sidebar<?php echo $side_sticky; ?>">
                        <div class="side-head">
                        <a href="javascript:void(0)" class="mclosebtn" aria-label="<?php _e( 'Close', 'dina-kala' ); ?>" data-title="<?php _e( 'Close', 'dina-kala' ); ?>" rel="nofollow" onclick="closeSide()">
                        <i class="fal fa-times" aria-hidden="true"></i>
                        </a>
                        </div>
                        <?php if ( dina_opt( 'shop_page_side' ) && is_shop() ) {
                              dynamic_sidebar( 'shop-page-sidebar' );
                        } else {
                              dynamic_sidebar( 'shop-sidebar' );
                        }
                        ?>
                  </aside>

                  <div id="dinaCanvasSide" class="overlay3" onclick="closeSide()"></div>
      <?php
            }
      } 
}
?>
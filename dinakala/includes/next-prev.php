<?php
//dina_show_next_prev_post
add_action ( 'dina_after_post_content', 'dina_show_next_prev_post' );
function dina_show_next_prev_post() {
    $next_post = get_next_post();
    $prev_post = get_previous_post();
      
    if ( $next_post || $prev_post ) : ?>
      
        <div class="dina-posts-nav">

            <div class="dina-posts-nav-prev">
                <?php if ( ! empty( $prev_post ) ) : ?>
                    <a href="<?php echo get_permalink( $prev_post ); ?>" title="<?php echo get_the_title( $prev_post ); ?>">
                        <div class="dina-posts-nav-thumbnail">
                            <div class="dina-posts-nav-img">
                                <?php echo get_the_post_thumbnail( $prev_post, [ 100, 100 ], array( 'title' => get_the_title( $prev_post )) ); ?>
                            </div>
                            <div class="dina-posts-nav-title">
                                <span><?php _e( 'Previous article', 'dina-kala' ) ?></span>
                                <h4><?php echo get_the_title( $prev_post ); ?></h4>
                            </div>
                        </div>
                    </a>
                <?php endif; ?>
            </div>

            <div class="dina-posts-nav-next">
                <?php if ( ! empty( $next_post ) ) : ?>
                    <a href="<?php echo get_permalink( $next_post ); ?>" title="<?php echo get_the_title( $next_post ); ?>">
                        <div class="dina-posts-nav-thumbnail">
                            <div class="dina-posts-nav-img">
                                <?php echo get_the_post_thumbnail( $next_post, [ 100, 100 ], array( 'title' => get_the_title( $prev_post )) ); ?>
                            </div>
                            <div class="dina-posts-nav-title">
                                <span><?php _e( 'Next article', 'dina-kala' ) ?></span>
                                <h4><?php echo get_the_title( $next_post ); ?></h4>
                            </div>
                        </div>
                    </a>
                <?php endif; ?>
            </div>

        </div> <!-- .dina-posts-nav -->
      
    <?php endif;
}
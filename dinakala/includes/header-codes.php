<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
    exit;

//Dina Header Codes
add_action( 'dina_header', 'dina_header_codes' );
function dina_header_codes() {
    
    //Show Page Loading
    dina_page_loading();
    
    $logged_msg = ( dina_opt( 'hide_msg_logged' ) && is_user_logged_in() ? true : false );

    if ( dina_opt( 'show_msg' ) && ! $logged_msg ) { ?>
        <!-- Header Massage Div -->
            <?php if ( dina_opt( 'show_img_msg' ) ) { ?>
                <aside class="head-img-msg-con">
                    <a href="<?= dina_opt( 'img_msg_link' ); ?>" class="head-img-msg" target="_blank" title="<?= dina_opt( 'img_msg_title' ); ?>"></a>
                </aside>
            <?php } else {
                if ( dina_opt( 'user_close' ) && dina_opt( 'msg_reshown' ) > 0 ) {
                    $msg_reshown = dina_opt( 'msg_reshown' );
                } else {
                    $msg_reshown = "null";
                }
                ?>
                <div class="container-fluid head-msg" id="dinaHeadMsg" data-reshown="<?= $msg_reshown; ?>">
                    <div class="container">
                        <div class="row">
                            <?php $text_class = dina_opt( 'msg_btn' ) ? 'col-12 col-md-10 msg-text' : 'col-12 msg-text'; ?>
                            <div class="<?= $text_class ?>">
                                <i aria-hidden="true" class="<?= dina_opt( 'msg_icon' ); ?> msg-icon"></i>
                                <span>
                                    <?= do_shortcode( dina_opt( 'site_msg' ) ); ?>
                                </span>
                            </div>
                            <?php if ( dina_opt( 'msg_btn' ) ) {
                                $msg_btn_class = ( dina_opt( 'msg_btn_icon_before' ) ? dina_opt( 'msg_btn_color' ) . ' msg-icon-before' : dina_opt( 'msg_btn_color' ) . '' ); ?>
                            <div class="col-12 col-md-2 msg-btn-con">
                                <a class="btn <?= $msg_btn_class; ?> msg-btn" href="<?= dina_opt( 'msg_btn_link' ); ?>" title="<?= dina_opt( 'msg_btn_text' ); ?>">
                                    <?= dina_opt( 'msg_btn_text' ); ?>
                                    <i class="<?= dina_opt( 'msg_btn_icon' ); ?>" aria-hidden="true"></i>
                                </a>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php if ( dina_opt( 'user_close' ) ) { ?>
                        <i class="fal fa-times msg-close" aria-hidden="true"></i>
                    <?php } ?>
                </div>
            <?php } ?>
        <!-- Header Massage Div -->
    <?php }

}

function dina_social_links( $class, $schema ) {
    $social_nofollow = dina_opt( 'nofollow_social_link' ) ? ' rel="nofollow"' : '';
    $link_schema     = $schema && dina_opt( 'site_schema' ) ? 'itemprop="sameAs" ' : '';
    $ul_class       = ! empty ( $class ) ? ' class="'. $class .'"' : '';
?>
    <ul<?php echo $ul_class; ?>>
        <?php if ( dina_opt( 'so_twitter' ) ) { ?>
        <li>
            <a <?php echo $link_schema; ?>href="<?php echo dina_opt( 'so_twitter_link' ); ?>" title="<?php _e( 'Twitter', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
                <i class="dico ico-twitter-x "></i>
            </a>
        </li>
        <?php } ?>
        <?php if ( dina_opt( 'so_facebook' ) ) { ?>
        <li>
            <a <?php echo $link_schema; ?>href="<?php echo dina_opt( 'so_facebook_link' ); ?>" title="<?php _e( 'Facebook', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
                <i class="fab fa-facebook-f"></i>
            </a>
        </li>
        <?php } ?>
        <?php if ( dina_opt( 'so_google' ) ) { ?>
        <li>
            <a <?php echo $link_schema; ?>href="<?php echo dina_opt( 'so_google_link' ); ?>" title="<?php _e( 'Google+', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
                <i class="fab fa-google-plus-g"></i>
            </a>
        </li>
        <?php } ?>
        <?php if ( dina_opt( 'so_whatsapp' ) ) { ?>
        <li>
            <a <?php echo $link_schema; ?>href="<?php echo dina_opt( 'so_whatsapp_link' ); ?>" title="<?php _e( 'Whatsapp', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
                <i class="fab fa-whatsapp"></i>
            </a>
        </li>
        <?php } ?>
        <?php if ( dina_opt( 'so_threads' ) ) { ?>
        <li>
            <a <?php echo $link_schema; ?>href="<?php echo dina_opt( 'so_threads_link' ); ?>" title="<?php _e( 'Threads', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
                <i class="dico ico-threads"></i>
            </a>
        </li>
        <?php } ?>
        <?php if ( dina_opt( 'so_tiktok' ) ) { ?>
        <li>
            <a <?php echo $link_schema; ?>href="<?php echo dina_opt( 'so_tiktok_link' ); ?>" title="<?php _e( 'Tiktok', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
                <i class="fab fa-tiktok"></i>
            </a>
        </li>
        <?php } ?>
        <?php if ( dina_opt( 'so_telegram' ) ) { ?>
        <li>
            <a <?php echo $link_schema; ?>href="<?php echo dina_opt( 'so_telegram_link' ); ?>" title="<?php _e( 'Telegram', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
                <i class="fab fa-telegram-plane"></i>
            </a>
        </li>
        <?php } ?>

        <?php if ( dina_opt( 'so_instagram' ) ) { ?>
        <li>
            <a <?php echo $link_schema; ?>href="<?php echo dina_opt( 'so_instagram_link' ); ?>" title="<?php _e( 'Instagram', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
                <i class="fab fa-instagram"></i>
            </a>
        </li>
        <?php } ?>

        <?php if ( dina_opt( 'so_soundcloud' ) ) { ?>
        <li>
            <a <?php echo $link_schema; ?>href="<?php echo dina_opt( 'so_soundcloud_link' ); ?>" title="<?php _e( 'Soundcloud', 'dina-kala' ) ?>" target="_blank"<?php echo $social_nofollow; ?>>
                <i class="fab fa-soundcloud"></i>
            </a>
        </li>
        <?php } ?>

        <?php if ( dina_opt( 'so_spotify' ) ) { ?>
        <li>
            <a <?php echo $link_schema; ?>href="<?php echo dina_opt( 'so_spotify_link' ); ?>" title="<?php _e( 'Spotify', 'dina-kala' ) ?>" target="_blank"<?php echo $social_nofollow; ?>>
                <i class="fab fa-spotify"></i>
            </a>
        </li>
        <?php } ?>

        <?php if ( dina_opt( 'so_google_podcasts' ) ) { ?>
        <li>
            <a <?php echo $link_schema; ?>href="<?php echo dina_opt( 'so_google_podcasts_link' ); ?>" title="<?php _e( 'Google podcasts', 'dina-kala' ) ?>" target="_blank"<?php echo $social_nofollow; ?>>
                <i class="dico ico-google-podcasts"></i>
            </a>
        </li>
        <?php } ?>

        <?php if ( dina_opt( 'so_castbox' ) ) { ?>
        <li>
            <a <?php echo $link_schema; ?>href="<?php echo dina_opt( 'so_castbox_link' ); ?>" title="<?php _e( 'Castbox', 'dina-kala' ) ?>" target="_blank"<?php echo $social_nofollow; ?>>
                <i class="dico ico-castbox"></i>
            </a>
        </li>
        <?php } ?>

        <?php if ( dina_opt( 'so_linktree' ) ) { ?>
        <li>
            <a <?php echo $link_schema; ?>href="<?php echo dina_opt( 'so_linktree_link' ); ?>" title="<?php _e( 'Linktree', 'dina-kala' ) ?>" target="_blank"<?php echo $social_nofollow; ?>>
                <i class="dico ico-linktr"></i>
            </a>
        </li>
        <?php } ?>

        <?php if ( dina_opt( 'so_youtube' ) ) { ?>
        <li>
            <a <?php echo $link_schema; ?>href="<?php echo dina_opt( 'so_youtube_link' ); ?>" title="<?php _e( 'Youtube', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
                <i class="fab fa-youtube"></i>
            </a>
        </li>
        <?php } ?>

        <?php if ( dina_opt( 'so_linkedin' ) ) { ?>
        <li>
            <a <?php echo $link_schema; ?>href="<?php echo dina_opt( 'so_linkedin_link' ); ?>" title="<?php _e( 'Linkedin', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
                <i class="fab fa-linkedin-in"></i>
            </a>
        </li>
        <?php } ?>

        <?php if ( dina_opt( 'so_dribble' ) ) { ?>
        <li>
            <a <?php echo $link_schema; ?>href="<?php echo dina_opt( 'so_dribble_link' ); ?>" title="<?php _e( 'Dribble', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
                <i class="fab fa-dribbble"></i>
            </a>
        </li>
        <?php } ?>

        <?php if ( dina_opt( 'so_behance' ) ) { ?>
        <li>
            <a <?php echo $link_schema; ?>href="<?php echo dina_opt( 'so_behance_link' ); ?>" title="<?php _e( 'Behance', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
                <i class="fab fa-behance"></i>
            </a>
        </li>
        <?php } ?>

        <?php if ( dina_opt( 'so_pinterest' ) ) { ?>
        <li>
            <a <?php echo $link_schema; ?>href="<?php echo dina_opt( 'so_pinterest_link' ); ?>" title="<?php _e( 'Pinterest', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
                <i class="fab fa-pinterest-p"></i>
            </a>
        </li>
        <?php } ?>

        <?php if ( dina_opt( 'so_aparat' ) ) { ?>
        <li>
            <a <?php echo $link_schema; ?>href="<?php echo dina_opt( 'so_aparat_link' ); ?>" title="<?php _e( 'Aparat', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
                <i class="dico ico-aparat"></i>
            </a>
        </li>
        <?php } ?>

        <?php if ( dina_opt( 'so_soroush' ) ) { ?>
        <li>
            <a <?php echo $link_schema; ?>href="<?php echo dina_opt( 'so_soroush_link' ); ?>" title="<?php _e( 'Soroush', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
                <i class="dico ico-Soroush"></i>
            </a>
        </li>
        <?php } ?>

        <?php if ( dina_opt( 'so_gap' ) ) { ?>
        <li>
            <a <?php echo $link_schema; ?>href="<?php echo dina_opt( 'so_gap_link' ); ?>" title="<?php _e( 'Gap', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
                <i class="dico ico-Gap"></i>
            </a>
        </li>
        <?php } ?>

        <?php if ( dina_opt( 'so_eitaa' ) ) { ?>
        <li>
            <a <?php echo $link_schema; ?>href="<?php echo dina_opt( 'so_eitaa_link' ); ?>" title="<?php _e( 'Eitaa', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
                <i class="dico ico-Eitaa"></i>
            </a>
        </li>
        <?php } ?>

        <?php if ( dina_opt( 'so_bisphone' ) ) { ?>
        <li>
            <a <?php echo $link_schema; ?>href="<?php echo dina_opt( 'so_bisphone_link' ); ?>" title="<?php _e( 'Bisphone', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
                <i class="dico ico-Bisphone"></i>
            </a>
        </li>
        <?php } ?>

        <?php if ( dina_opt( 'so_bale' ) ) { ?>
        <li>
            <a <?php echo $link_schema; ?>href="<?php echo dina_opt( 'so_bale_link' ); ?>" title="<?php _e( 'Bale', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
                <i class="dico ico-Bale"></i>
            </a>
        </li>
        <?php } ?>

        <?php if ( dina_opt( 'so_igap' ) ) { ?>
        <li>
            <a <?php echo $link_schema; ?>href="<?php echo dina_opt( 'so_igap_link' ); ?>" title="<?php _e( 'iGap', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
                <i class="dico ico-iGap"></i>
            </a>
        </li>
        <?php } ?>

        <?php if ( dina_opt( 'so_rubika' ) ) { ?>
        <li>
            <a <?php echo $link_schema; ?>href="<?php echo dina_opt( 'so_rubika_link' ); ?>" title="<?php _e( 'Rubika', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
                <i class="dico ico-rubika"></i>
            </a>
        </li>
        <?php } ?>

        <?php if ( dina_opt( 'so_hoorsa' ) ) { ?>
        <li>
            <a <?php echo $link_schema; ?>href="<?php echo dina_opt( 'so_hoorsa_link' ); ?>" title="<?php _e( 'Hoorsa', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
                <i class="dico ico-hoorsa"></i>
            </a>
        </li>
        <?php } ?>

        <?php if ( dina_opt( 'so_phone' ) ) { ?>
        <li>
            <a <?php echo $link_schema; ?>href="<?php echo dina_opt( 'so_phone_remove_tel' ) ? dina_opt( 'so_phone_link' ) : 'tel:'. dina_remove_dash( dina_opt( 'so_phone_link' ) ); ?>" title="<?php _e( 'Phone', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
                <i class="fal fa-phone" aria-hidden="true"></i>
            </a>
        </li>
        <?php } ?>

        <?php if ( dina_opt( 'so_mobile' ) ) { ?>
        <li>
            <a <?php echo $link_schema; ?>href="<?php echo dina_opt( 'so_mobile_remove_tel' ) ? dina_opt( 'so_mobile_link' ) : 'tel:'. dina_remove_dash( dina_opt( 'so_mobile_link' ) ); ?>" title="<?php _e( 'Mobile', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
                <i class="fal fa-mobile-alt" aria-hidden="true"></i>
            </a>
        </li>
        <?php } ?>

        <?php if ( dina_opt( 'so_email' ) ) { ?>
        <li>
            <a <?php echo $link_schema; ?>href="mailto:<?php echo dina_opt( 'so_email_link' ); ?>" title="<?php _e( 'Email', 'dina-kala' ); ?>" target="_blank"<?php echo $social_nofollow; ?>>
                <i class="fal fa-at" aria-hidden="true"></i>
            </a>
        </li>
        <?php } ?>

    </ul>
    <?php
}
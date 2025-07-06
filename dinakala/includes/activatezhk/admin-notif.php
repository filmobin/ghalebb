<?php
defined('ABSPATH') || exit ("no access");
if( empty($this->e56f84295a04e352c366f90b0ea4e) ): ?>
    <div class="notice notice-error">
        <?php if (version_compare(PHP_VERSION, '7.0.0') >= 0):?>
        <p>
            <?php printf(esc_html__( 'To activating %s, please insert your license key', 'guard-gn-d5afca6d89ba2775bce9973177ff' ), esc_html__($this->cdaca44e5e81115c8bfcb5384e, 'guard-gn-d5afca6d89ba2775bce9973177ff')); ?>
            <a href="<?php echo admin_url( 'admin.php?page='.$this->a2f5f16b6791d687b7ece14e ); ?>" class="button button-primary"><?php _e('Active License', 'guard-gn-d5afca6d89ba2775bce9973177ff'); ?></a>
        </p>
        <?php else:?>
            <p>
                <?php printf(esc_html__( 'The PHP version of the website is lower than 7.0. Ask your host administrator to upgrade PHP version to activate %s. ', 'guard-gn-d5afca6d89ba2775bce9973177ff' ), esc_html__($this->cdaca44e5e81115c8bfcb5384e, 'guard-gn-d5afca6d89ba2775bce9973177ff')); ?>
            </p>
    <?php endif; ?>
    </div>
<?php elseif( $this->d474648e9684e535c5ad218febc302a===true ): ?>
    <div class="notice notice-error">
        <p>
            <?php printf(esc_html__( 'Something is wrong with your %s license. Please check it.', 'guard-gn-d5afca6d89ba2775bce9973177ff' ), esc_html__($this->cdaca44e5e81115c8bfcb5384e, 'guard-gn-d5afca6d89ba2775bce9973177ff')); ?>
            <a href="<?php echo admin_url( 'admin.php?page='.$this->a2f5f16b6791d687b7ece14e ); ?>" class="button button-primary"><?php _e('Check Now', 'guard-gn-d5afca6d89ba2775bce9973177ff'); ?></a>
        </p>
    </div>
<?php endif; ?>
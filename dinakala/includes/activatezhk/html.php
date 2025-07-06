<?php defined('ABSPATH') || exit ("no access");  ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;700&display=swap" rel="stylesheet">
<style>
    <?php include __DIR__.'/assets/style.css' ?>
</style>
<script>
var zhaket_guard=<?php echo json_encode(array(
                                  'ajax_url' => admin_url('admin-ajax.php'),
                                  'confirm_msg' => esc_html__('Are you sure?', 'guard-gn-d5afca6d89ba2775bce9973177ff'),
                                  'wrong_license_message' => esc_html__('Something goes wrong, please try again.', 'guard-gn-d5afca6d89ba2775bce9973177ff'),
                                  'this_slug' => $this->a2f5f16b6791d687b7ece14e,
                                  'view_problem_console_log' => esc_html__('Something is wrong, please check the console log for details',
                                                                           'guard-gn-d5afca6d89ba2775bce9973177ff'),
                                  'please_add_valid_license' => esc_html__('License key is not valid, Please enter valid license key.',
                                                                           'guard-gn-d5afca6d89ba2775bce9973177ff'),
                                  'nonce' => wp_create_nonce('guard-gn-d5afca6d89ba2775bce9973177ff'),
                              )) ?>
</script>
<script>
    <?php include __DIR__.'/assets/script.js' ?>
</script>
<div id="main-guard-inner">
    <div class="license-input">
        <h1> <?php printf(esc_html__('%s Activation', 'guard-gn-d5afca6d89ba2775bce9973177ff'), esc_html__($this->cdaca44e5e81115c8bfcb5384e, 'guard-gn-d5afca6d89ba2775bce9973177ff')); ?></h1>
        <?php if ($this->e56f84295a04e352c366f90b0ea4e): ?>
            <h3><?php esc_html_e('Your activation key:', 'guard-gn-d5afca6d89ba2775bce9973177ff') ?></h3>
            <code id="code-style"><?php echo $this->c92d51c3d58ba6a4460179bf86b09a() ?></code>
            <div class="text-left">
                    <span id="recheck-license" onclick="recheck_licence(this)"><?php esc_html_e('Recheck license', 'guard-gn-d5afca6d89ba2775bce9973177ff') ?></span>
                    <span id="remove-license" onclick="remove_licence(this)"><?php esc_html_e('Remove / Change key', 'guard-gn-d5afca6d89ba2775bce9973177ff') ?></span>
            </div>
            <div id="license-message" style="display: flex; <?php echo ($this->d474648e9684e535c5ad218febc302a===true)? 'background:red;':''?>">
                <div class="result" style=""><?php echo $this->e6c8582b4849982fee468a92533a('last_message'); ?></div>
            </div>
            <!-- /#license-message -->
        <?php else: ?>
            <h3><?php esc_html_e('Enter your activation key:', 'guard-gn-d5afca6d89ba2775bce9973177ff') ?></h3>
            <input id="license-input" type="text" value="">
            <div class="text-left">
                    <span id="install-license" onclick="install_licence(this)"><?php esc_html_e('Activate',
                            'guard-gn-d5afca6d89ba2775bce9973177ff') ?></span>
            </div>
            <div id="license-message">
            </div>
        <?php endif; ?>

        <!-- /#license-message -->
        <div id="license-help">
            <strong><?php esc_html_e('Manual:', 'guard-gn-d5afca6d89ba2775bce9973177ff') ?></strong>
            <ul>
                <?php if ($this->e56f84295a04e352c366f90b0ea4e): ?>
                    <li>
                        <?php esc_html_e('Your key is used on this website, and it is not possible to use on another website.',
                            'guard-gn-d5afca6d89ba2775bce9973177ff') ?>
                    </li>
                    <li>
                        <?php esc_html_e('If you want to transfer a license to another domain, click on the "Remove / Change key", after that login to your account of zhaket.com and go to the download section and click on change domain button. Enter your new domain name and use the license key on your desired domain.',
                            'guard-gn-d5afca6d89ba2775bce9973177ff') ?>
                    </li>
                <?php else: ?>
                    <li>
                        <?php esc_html_e('To use the product, you should enter the license key, to find your license key, login to your account of zhaket.com and go to downloads section, after than select product and copy your license key or click on create license button and copy your license key.',
                            'guard-gn-d5afca6d89ba2775bce9973177ff') ?>
                    </li>
                    <li>
                        <?php esc_html_e('Each license can be activated only for one website', 'guard-gn-d5afca6d89ba2775bce9973177ff') ?>
                    </li>
                    <li>
                        <?php esc_html_e('If your license is activated on another domain, first click on the "Remove / Change key" on the old website, then login to your account of zhaket.com and go to the download section and click on the change domain button, enter your website domain name and use the license key to activate.',
                            'guard-gn-d5afca6d89ba2775bce9973177ff') ?>
                    </li>
                <?php endif; ?>
            </ul>
            <?php
            if ( defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON ) {
                echo '<hr>';
                echo sprintf( esc_html__( 'The %s constant is set to true. WP-Cron spawning is disabled.', 'guard-gn-d5afca6d89ba2775bce9973177ff' ), 'DISABLE_WP_CRON' );
            }
            if ( defined( 'ALTERNATE_WP_CRON' ) && ALTERNATE_WP_CRON ) {
                echo '<hr>';
                echo sprintf( esc_html__( 'The %s constant is set to true.', 'guard-gn-d5afca6d89ba2775bce9973177ff' ), 'ALTERNATE_WP_CRON'
                );
            }

            ?>
            <hr>
            <span style="display: block;direction: ltr;text-align:left;font-size: 10px">version:2.1</span>
        </div>


    </div>
    <!-- /.license-input -->
    <div class="background-status">
        <?php if ($this->e56f84295a04e352c366f90b0ea4e): ?>
            <?php include __DIR__.'/assets/unlocked.svg' ?>
        <?php else: ?>
            <?php include __DIR__.'/assets/lock.svg' ?>
        <?php endif; ?>
    </div>
    <!-- /.background-status -->
</div>
<!-- /#main-guard-inner -->
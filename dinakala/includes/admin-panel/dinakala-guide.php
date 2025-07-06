<?php
/*
Theme Designed By: Meysam Hosseinkhani
Email: Meysam98@Gmail.com
Demo Website: Dinakala.I-design.ir
Author Website: i-design.ir
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
    exit;

//Start Dinakala guide SECTION
Redux::setSection( $opt_name, array(
    'title'      => __( 'Dinakala guide', 'dina-kala' ),
    'id'         => 'dinakala_guide',
    'desc'       => __( 'See tutorials for using the Dinakala template:', 'dina-kala' ),
    'icon'       => 'fal fa-question-circle',
    'fields'     => array(
        array(
            'id'       => 'dinakala_knowledge_base',
            'type'     => 'raw',
            'title'    => __( 'Dinakala template knowledge base', 'dina-kala' ),
            'subtitle' => __( '<a href="https://i-design.ir/docs/dinakala/" target="_blank"><i class="fal fa-question-circle" aria-hidden="true"></i> Template knowledge base</a>', 'dina-kala' ),
            'desc'     => __( 'In the Dinakala template knowledge base, you can view and read installation and setup training, how to update, training related to template settings, how to work with Elementor, menu settings, posts and pages, and problems and frequently asked questions.', 'dina-kala' ),
        ),
        array(
            'id'       => 'installation_help',
            'type'     => 'raw',
            'title'    => __( 'Installation tutorial', 'dina-kala' ),
            'subtitle' => __( '<a href="https://i-design.ir/docs/dinakala/installation-and-update/" target="_blank"><i class="fal fa-question-circle" aria-hidden="true"></i> View the guide</a>', 'dina-kala' ),
            'desc'     => __( 'In this guide, the method of initial installation and setup of Dinakala template is explained step by step by manual installation method or installation by easy installation package method.', 'dina-kala' ),
        ),
        array(
            'id'       => 'import_guide',
            'type'     => 'raw',
            'title'    => __( 'Demo import guide', 'dina-kala' ),
            'subtitle' => __( '<a href="https://i-design.ir/docs/dinakala/?p=624" target="_blank"><i class="fal fa-question-circle" aria-hidden="true"></i> View the guide</a>', 'dina-kala' ),
            'desc'     => __( 'In this guide, how to import demos of Dinakala template into your site is taught.', 'dina-kala' ),
        ),
        array(
            'id'       => 'using_dark_mode',
            'type'     => 'raw',
            'title'    => __( 'Guide to using dark mode', 'dina-kala' ),
            'subtitle' => __( '<a href="https://i-design.ir/docs/dinakala/?p=2185" target="_blank"><i class="fal fa-question-circle" aria-hidden="true"></i> View the guide</a>', 'dina-kala' ),
            'desc'     => __( 'In this guide, how to use the dark mode of the Dinakala template and how to set this mode and related tips are taught.', 'dina-kala' ),
        ),
        array(
            'id'       => 'using_shortcodes',
            'type'     => 'raw',
            'title'    => __( 'Dinakala Template Shortcodes', 'dina-kala' ),
            'subtitle' => __( '<a href="https://i-design.ir/docs/dinakala/?p=3070" target="_blank"><i class="fal fa-question-circle" aria-hidden="true"></i> View the guide</a>', 'dina-kala' ),
            'desc'     => __( 'In this guide, while introducing Dinakala template shortcodes, how to use them will be explained.', 'dina-kala' ),
        )
    ),
) );
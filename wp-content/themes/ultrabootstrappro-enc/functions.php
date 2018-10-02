<?php

function ultrabootstrappro_enc_customize_register($wp_customize) {
      $wp_customize->add_setting(
        'instagram_textbox',
          array(
            'sanitize_callback' => 'esc_url_raw',
            'default' => '',
          )
      );

      $wp_customize->add_control(
        'instagram_textbox',
          array(
            'label' => __('Instagram','ultrabootstrap'),
            'section' => 'social_section',
            'settings' => 'instagram_textbox',
            'type' => 'text',
          )
      );

      $wp_customize->add_setting(
        'tumblr_textbox',
          array(
            'sanitize_callback' => 'esc_url_raw',
            'default' => '',
          )
      );

      $wp_customize->add_control(
        'tumblr_textbox',
          array(
            'label' => __('Tumblr','ultrabootstrap'),
            'section' => 'social_section',
            'settings' => 'tumblr_textbox',
            'type' => 'text',
          )
      );

      $wp_customize->add_setting(
        'flickr_textbox',
          array(
            'sanitize_callback' => 'esc_url_raw',
            'default' => '',
          )
      );

      $wp_customize->add_control(
        'flickr_textbox',
          array(
            'label' => __('Flickr','ultrabootstrap'),
            'section' => 'social_section',
            'settings' => 'flickr_textbox',
            'type' => 'text',
          )
      );

      $wp_customize->add_setting(
        'youtube_textbox',
          array(
            'sanitize_callback' => 'esc_url_raw',
            'default' => '',
          )
      );

      $wp_customize->add_control(
        'youtube_textbox',
          array(
            'label' => __('Youtube','ultrabootstrap'),
            'section' => 'social_section',
            'settings' => 'youtube_textbox',
            'type' => 'text',
          )
      );
}
add_action( 'customize_register', 'ultrabootstrappro_enc_customize_register' );

function ultrabootstrappro_enc_enqueue_styles() {
    $parent_style = 'ultrabootstrappro-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'ultrabootstrappro-enc-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );

}
add_action( 'wp_enqueue_scripts', 'ultrabootstrappro_enc_enqueue_styles' );

wp_enqueue_script( 'ultrabootstrappro-enc-script', get_template_directory_uri() . '-enc/js/enc-styles.js', array(), 1, true);

?>
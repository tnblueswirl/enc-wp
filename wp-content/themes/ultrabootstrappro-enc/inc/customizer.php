<?php
/**
 * ultrabootstrap Theme Customizer
 *
 * @package ultrabootstrap
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */


function ultrabootstrap_customize_register( $wp_customize ) {
  $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
  $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
  $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'ultrabootstrap_customize_register' );


function ultrabootstrap_customizer_register( $wp_customize ) 
    {
      // Do stuff with $wp_customize, the WP_Customize_Manager object.

      $wp_customize->add_panel( 'theme_option', array(
        'priority' => 10,
        'title' => __( 'Ultrabootstrap Theme Option', 'ultrabootstrap' ),
        'description' => __( 'ultrabootstrap Theme Options', 'ultrabootstrap' ),
      ));
      

      /**********************************************/
      /************* MAIN SLIDER SECTION *************/
      /**********************************************/     

      $wp_customize->add_section('main_slider_category',array(
        'priority' => 50,
        'title' => __('Slider Settings','ultrabootstrap'),
        'description' => __('Select Slider Settings.','ultrabootstrap'),
        'panel' => 'theme_option'
      ));

      $wp_customize->add_setting('slider_category_display',array(
        'sanitize_callback' => 'ultrabootstrap_sanitize_category',
        'default' => ''
      ));

      $wp_customize->add_control(new ultrabootstrap_Customize_Dropdown_Taxonomies_Control($wp_customize,'slider_category_display',array(
        'label' => __('Choose category','ultrabootstrap'),
        'section' => 'main_slider_category',
        'settings' => 'slider_category_display',
        'type'=> 'dropdown-taxonomies',
        )  
      ));

   

    // Post Order On Slider
    $wp_customize->add_setting( 'slider_post_order', array(
    'capability'    => 'edit_theme_options',
    'sanitize_callback' => 'esc_attr',
    'default'   =>'DESC',
    ) );

    $wp_customize->add_control( 'slider_post_order', array(
    'label'   => __( 'Slider Posts Order', 'ultrabootstrap' ),
    'section'   => 'main_slider_category',
    'settings'  => 'slider_post_order',
      
    'type'       => 'radio',
    'choices'    => array(
              'ASC'   => __('Ascending','ultrabootstrap' ),
              'DESC'  => __('Descending','ultrabootstrap' ),
              'rand'  => __('Random','ultrabootstrap' ),
                  ),
    ) );
    // no of posts to show on slider
    $wp_customize->add_setting( 'slider_no_of_posts', array(
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'esc_attr',
    'default'           => '5'
    ) );

    $wp_customize->add_control( 'slider_no_of_posts', array(
    'settings' => 'slider_no_of_posts',
    'label'                 =>  __( 'No Of Posts To Show On Slider', 'ultrabootstrap' ),
    'section'               => 'main_slider_category',
      
    'type'                  => 'select',
    'choices'               => array(
         '1' => __( '1', 'ultrabootstrap' ),
         '2' => __( '2 ', 'ultrabootstrap' ),
         '3' => __( '3', 'ultrabootstrap' ),
         '4' => __( '4', 'ultrabootstrap' ),
         '5' => __( '5', 'ultrabootstrap' ),
         '6' => __( '6', 'ultrabootstrap' ),
         '7' => __( '7', 'ultrabootstrap' ),
         '8' => __( '8', 'ultrabootstrap' ),
         '9' => __( '9', 'ultrabootstrap' ),
         '10' => __( '10', 'ultrabootstrap' ),
         '11' => __( '11', 'ultrabootstrap' ),
         '12' => __( '12', 'ultrabootstrap' ),
         '13' => __( '13', 'ultrabootstrap' ),
         '14' => __( '14', 'ultrabootstrap' )
                        ),
    'priority'              => '220'
    ) );

        // enable/disable slider
      $wp_customize->add_setting( 'slider_disable', array(
    'capability'    => 'edit_theme_options',
    'sanitize_callback' => 'esc_attr',
    'default'   =>'1',
    ) );

    $wp_customize->add_control( 'slider_disable', array(
    'label'   => __( 'Check to disable Slider', 'ultrabootstrap' ),
    'section'   => 'main_slider_category',
    'settings'  => 'slider_disable',
      
    'type'       => 'radio',
    'choices'    => array(
    '0'   => __('Disable','ultrabootstrap' ),
    '1'  => __('Enable','ultrabootstrap' ),
                  ),
    ) );



      /**********************************************/
      /*************** WELCOME SECTION ***************/
      /**********************************************/

      $wp_customize->add_section('welcome_text',array(
        'priority' => 60,
        'title' => __('Welcome Section','ultrabootstrap'),
        'description' => __('Write Some Words for Welcome Section in Homepage','ultrabootstrap'),
        'panel' => 'theme_option'
      ));

      $wp_customize->add_setting(
        'welcome_textbox1',
          array(
            'sanitize_callback' => 'ultrabootstrap_sanitize_text',
            'default' => '',
          )
      );

      $wp_customize->add_control(
        'welcome_textbox1',
          array(
          'label' => __('Welcome Heading','ultrabootstrap'),
          'section' => 'welcome_text',
          'settings' => 'welcome_textbox1',
          'type' => 'text',
         )
      );

      $wp_customize->add_setting(
        'welcome_textbox2',
          array(
            'sanitize_callback' => 'ultrabootstrap_sanitize_text',
            'default' => '',
          )
      );

      $wp_customize->add_control(
        'welcome_textbox2',
          array(
          'label' => __('Welcome Second Heading','ultrabootstrap'),
          'section' => 'welcome_text',
          'settings' => 'welcome_textbox2',
          'type' => 'text',
         )
      );


      $wp_customize->add_setting( 
        'textarea_setting' ,
          array(
            'sanitize_callback' => 'ultrabootstrap_sanitize_text',
            'default' => '', 
        )); 
   
      $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'textarea_setting', array( 
        'label' => __( 'Welcome Text Content', 'ultrabootstrap' ),
        'section' => 'welcome_text',
        'settings' => 'textarea_setting', 
        'type'     => 'textarea', 
        )));    


      $wp_customize->add_section('content' , array(
        'title' => __('Content','ultrabootstrap'),
      ));


      $wp_customize->add_setting(
        'welcome_button',
            array(
              'sanitize_callback' => 'esc_url_raw',
              'default' => '',
          )
      );

      $wp_customize->add_control(
        'welcome_button',
         array(
          'label' => __('Welcome Button Link','ultrabootstrap'),
          'section' => 'welcome_text',
          'settings' => 'welcome_button',
          'type' => 'text',
         )
      );      


      /**********************************************/
      /*************** FEATURES SECTION ****************/
      /**********************************************/

      $wp_customize->add_section('features_category',array(
        'priority' => 70,
        'title' => __('Features Categories','ultrabootstrap'),
        'description' => __('Select the Category for Features Section in Homepage','ultrabootstrap'),
        'panel' => 'theme_option'
      ));

      $wp_customize->add_setting(
        'features_title',
          array(
          'sanitize_callback' => 'ultrabootstrap_sanitize_text',
          'default' => '',
          
          )
       );
      $wp_customize->add_control(
        'features_title',
          array(
          'label' => __('Title','ultrabootstrap'),
          'section' => 'features_category',
          'settings' => 'features_title',
           'type' => 'text',
         )
      );

      $wp_customize->add_setting('features_display',array(
        'sanitize_callback' => 'ultrabootstrap_sanitize_category',
        'default' => ''
      ));

      $wp_customize->add_control(new ultrabootstrap_Customize_Dropdown_Taxonomies_Control($wp_customize,'features_display',array(
        'label' => __('Choose category','ultrabootstrap'),
        'section' => 'features_category',
        'settings' => 'features_display',
        'type'=> 'dropdown-taxonomies',
        )  
      ));

          // enable/disable features section
      $wp_customize->add_setting( 'featured_disable', array(
    'capability'    => 'edit_theme_options',
    'sanitize_callback' => 'esc_attr',
    'default'   =>'1',
    ) );

    $wp_customize->add_control( 'featured_disable', array(
    'label'   => __( 'Check to disable Featured', 'ultrabootstrap' ),
    'section'   => 'features_category',
    'settings'  => 'featured_disable',
      
    'type'       => 'radio',
    'choices'    => array(
    '0'   => __('Disable','ultrabootstrap' ),
    '1'  => __('Enable','ultrabootstrap' ),
                  ),
    ) );

    // Post Order On Slider
      $wp_customize->add_setting( 'featured_post_order', array(
    'capability'    => 'edit_theme_options',
    'sanitize_callback' => 'esc_attr',
    'default'   =>'DESC',
    ) );

    $wp_customize->add_control( 'featured_post_order', array(
    'label'   => __( 'Featured Posts Order', 'ultrabootstrap' ),
    'section'   => 'features_category',
    'settings'  => 'featured_post_order',
      
    'type'       => 'radio',
    'choices'    => array(
              'ASC'   => __('Ascending','ultrabootstrap' ),
              'DESC'  => __('Descending','ultrabootstrap' ),
              'rand'  => __('Random','ultrabootstrap' ),
                  ),
    ) );
    // no of posts to show on slider
    $wp_customize->add_setting( 'featured_no_of_posts', array(
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'esc_attr',
    'default'           => '4'
    ) );

    $wp_customize->add_control( 'featured_no_of_posts', array(
    'settings' => 'featured_no_of_posts',
    'label'                 =>  __( 'No Of Posts To Show On Feature', 'ultrabootstrap' ),
    'section'               => 'features_category',
      
    'type'                  => 'select',
    'choices'               => array(
         '4' => __( '4', 'ultrabootstrap' ),
         '8' => __( '8 ', 'ultrabootstrap' ),
         '12' => __( '12', 'ultrabootstrap' ),
         '16' => __( '16', 'ultrabootstrap' ),
         '20' => __( '20', 'ultrabootstrap' )
                        ),
    'priority'              => '220'
    ) );




    /**********************************************/
      /*************** SOCIAL SECTION ***************/
      /**********************************************/

       $wp_customize->add_section(
        'foot_section',
          array(
            'priority' => 100,
            'title' => __('Footer Section','ultrabootstrap'),
            'description' => 'Edit Copyright Info',
            'panel' => 'theme_option'
        )
      );

      /**********************************************/
      /*************** SOCIAL SECTION ***************/
      /**********************************************/

       $wp_customize->add_section(
        'social_section',
          array(
            'priority' => 80,
            'title' => __('Social Links & Copyright','ultrabootstrap'),
            'description' => 'Customize your Social Info',
            'panel' => 'theme_option'
        )
      );


      /**********************************************/
      /********** SOCIAL ICON LINKS SECTION ***********/
      /**********************************************/

      $wp_customize->add_setting(
        'facebook_textbox',
          array(
            'sanitize_callback' => 'esc_url_raw',
            'default' => '#',
          )
      );

      $wp_customize->add_control(
        'facebook_textbox',
          array(
            'label' => __('Facebook','ultrabootstrap'),
            'section' => 'social_section',
            'settings' => 'facebook_textbox',
            'type' => 'text',
          )
      );

      $wp_customize->add_setting(
        'twitter_textbox',
          array(
            'sanitize_callback' => 'esc_url_raw',
            'default' => '',
          )
      );

      $wp_customize->add_control(
        'twitter_textbox',
         array(
          'label' => __('Twitter','ultrabootstrap'),
          'section' => 'social_section',
          'settings' => 'twitter_textbox',
          'type' => 'text',
         )
      );

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
        'googleplus_textbox',
          array(
            'sanitize_callback' => 'esc_url_raw',
            'default' => '',
          )
      );

      $wp_customize->add_control(
        'googleplus_textbox',
          array(
          'label' => __('Googleplus','ultrabootstrap'),
          'section' => 'social_section',
          'settings' => 'googleplus_textbox',
          'type' => 'text',
         )
      );

      $wp_customize->add_setting(
        'linkedin_textbox',
            array(
              'sanitize_callback' => 'esc_url_raw',
              'default' => '',
          )
      );

      $wp_customize->add_control(
        'linkedin_textbox',
         array(
          'label' => __('Linkedin','ultrabootstrap'),
          'section' => 'social_section',
          'settings' => 'linkedin_textbox',
          'type' => 'text',
         )
      );

      $wp_customize->add_setting(
        'pinterest_textbox',
          array(
            'sanitize_callback' => 'esc_url_raw',
          'default' => '',
          )
      );
      
      $wp_customize->add_control(
        'pinterest_textbox',
          array(
            'label' => __('Pinterest','ultrabootstrap'),
            'section' => 'social_section',
            'settings' => 'pinterest_textbox',
            'type' => 'text',
         )
      );
      $wp_customize->add_setting(
        'copyright_textbox',
          array(
            'sanitize_callback' => 'ultrabootstrap_sanitize_text',
          'default' => 'Theme Ultrabootstrap by <a href="http://phantomthemes.com">Phantom Themes</a>',
          )
      );
      
      $wp_customize->add_control(
        'copyright_textbox',
          array(
            'label' => __('Edit Copyright Info','ultrabootstrap'),
            'section' => 'social_section',
            'settings' => 'copyright_textbox',
            'type' => 'text',
         )
      );

      /* Pro Options */
      $wp_customize->add_panel( 'theme_option_pro', array(
        'priority' => 15,
        'title' => __( 'Change Colors & Fonts', 'ultrabootstrap' ),
        'description' => __( 'Ultrabootstrap Options', 'ultrabootstrap' ),
      ));
        $wp_customize->add_section( 'ultrabootstrap_google_fontfamily', array(
          'panel'     => 'theme_option_pro',
          'priority'  => 200,
          'title'     => __( 'Theme Color & Font', 'ultrabootstrap' ),
        ) );

      $wp_customize->add_setting( 'ultrabootstrap_google_fontfamily_setting', array(
          'capability'        => 'edit_theme_options',
          'default'           => '',
          'sanitize_callback' => 'esc_attr'
          ) );

      $wp_customize->add_control( 'ultrabootstrap_fontfamily_setting', array(
          'settings'              => 'ultrabootstrap_google_fontfamily_setting',
          'label'                 =>  __( 'Choose Font Family For Your Site', 'ultrabootstrap' ),
          'section'               => 'ultrabootstrap_google_fontfamily',
          'type'                  => 'select',
          'default'               =>'robato',
          'choices'               => array(                    
                                                                
                                                                'ABeeZee' => 'ABeeZee',
                                                                'Abel' => 'Abel',
                                                                'Abril Fatface' => 'Abril Fatface',
                                                                'Aclonica' => 'Aclonica',
                                                                'Acme' => 'Acme',
                                                                'Actor' => 'Actor',
                                                                'Adamina' => 'Adamina',
                                                                'Advent Pro' => 'Advent Pro',
                                                                'Aguafina Script' => 'Aguafina Script',
                                                                'Akronim' => 'Akronim',
                                                                'Aladin' => 'Aladin',
                                                                'Aldrich' => 'Aldrich',
                                                                'Alef' => 'Alef',
                                                                'Alegreya' => 'Alegreya',
                                                                'Alegreya SC' => 'Alegreya SC',
                                                                'Alegreya Sans' => 'Alegreya Sans',
                                                                'Alegreya Sans SC' => 'Alegreya Sans SC',
                                                                'Alex Brush' => 'Alex Brush',
                                                                'Alfa Slab One' => 'Alfa Slab One',
                                                                'Alice' => 'Alice',
                                                                'Alike' => 'Alike',
                                                                'Alike Angular' => 'Alike Angular',
                                                                'Allan' => 'Allan',
                                                                'Allerta' => 'Allerta',
                                                                'Allerta Stencil' => 'Allerta Stencil',
                                                                'Allura' => 'Allura',
                                                                'Almendra' => 'Almendra',
                                                                'Almendra Display' => 'Almendra Display',
                                                                'Almendra SC' => 'Almendra SC',
                                                                'Amarante' => 'Amarante',
                                                                'Amaranth' => 'Amaranth',
                                                                'Amatic SC' => 'Amatic SC',
                                                                'Amethysta' => 'Amethysta',
                                                                'Anaheim' => 'Anaheim',
                                                                'Andada' => 'Andada',
                                                                'Andika' => 'Andika',
                                                                'Angkor' => 'Angkor',
                                                                'Annie Use Your Telescope' => 'Annie Use Your Telescope',
                                                                'Anonymous Pro' => 'Anonymous Pro',
                                                                'Antic' => 'Antic',
                                                                'Antic Didone' => 'Antic Didone',
                                                                'Antic Slab' => 'Antic Slab',
                                                                'Anton' => 'Anton',
                                                                'Arapey' => 'Arapey',
                                                                'Arbutus' => 'Arbutus',
                                                                'Arbutus Slab' => 'Arbutus Slab',
                                                                'Architects Daughter' => 'Architects Daughter',
                                                                'Archivo Black' => 'Archivo Black',
                                                                'Archivo Narrow' => 'Archivo Narrow',
                                                                'Arimo' => 'Arimo',
                                                                'Arizonia' => 'Arizonia',
                                                                'Armata' => 'Armata',
                                                                'Artifika' => 'Artifika',
                                                                'Arvo' => 'Arvo',
                                                                'Asap' => 'Asap',
                                                                'Asset' => 'Asset',
                                                                'Astloch' => 'Astloch',
                                                                'Asul' => 'Asul',
                                                                'Atomic Age' => 'Atomic Age',
                                                                'Aubrey' => 'Aubrey',
                                                                'Audiowide' => 'Audiowide',
                                                                'Autour One' => 'Autour One',
                                                                'Average' => 'Average',
                                                                'Average Sans' => 'Average Sans',
                                                                'Averia Gruesa Libre' => 'Averia Gruesa Libre',
                                                                'Averia Libre' => 'Averia Libre',
                                                                'Averia Sans Libre' => 'Averia Sans Libre',
                                                                'Averia Serif Libre' => 'Averia Serif Libre',
                                                                'Bad Script' => 'Bad Script',
                                                                'Balthazar' => 'Balthazar',
                                                                'Bangers' => 'Bangers',
                                                                'Basic' => 'Basic',
                                                                'Battambang' => 'Battambang',
                                                                'Baumans' => 'Baumans',
                                                                'Bayon' => 'Bayon',
                                                                'Belgrano' => 'Belgrano',
                                                                'Belleza' => 'Belleza',
                                                                'BenchNine' => 'BenchNine',
                                                                'Bentham' => 'Bentham',
                                                                'Berkshire Swash' => 'Berkshire Swash',
                                                                'Bevan' => 'Bevan',
                                                                'Bigelow Rules' => 'Bigelow Rules',
                                                                'Bigshot One' => 'Bigshot One',
                                                                'Bilbo' => 'Bilbo',
                                                                'Bilbo Swash Caps' => 'Bilbo Swash Caps',
                                                                'Bitter' => 'Bitter',
                                                                'Black Ops One' => 'Black Ops One',
                                                                'Bokor' => 'Bokor',
                                                                'Bonbon' => 'Bonbon',
                                                                'Boogaloo' => 'Boogaloo',
                                                                'Bowlby One' => 'Bowlby One',
                                                                'Bowlby One SC' => 'Bowlby One SC',
                                                                'Brawler' => 'Brawler',
                                                                'Bree Serif' => 'Bree Serif',
                                                                'Bubblegum Sans' => 'Bubblegum Sans',
                                                                'Bubbler One' => 'Bubbler One',
                                                                'Buda' => 'Buda',
                                                                'Buenard' => 'Buenard',
                                                                'Butcherman' => 'Butcherman',
                                                                'Butterfly Kids' => 'Butterfly Kids',
                                                                'Cabin' => 'Cabin',
                                                                'Cabin Condensed' => 'Cabin Condensed',
                                                                'Cabin Sketch' => 'Cabin Sketch',
                                                                'Caesar Dressing' => 'Caesar Dressing',
                                                                'Cagliostro' => 'Cagliostro',
                                                                'Calligraffitti' => 'Calligraffitti',
                                                                'Cambo' => 'Cambo',
                                                                'Candal' => 'Candal',
                                                                'Cantarell' => 'Cantarell',
                                                                'Cantata One' => 'Cantata One',
                                                                'Cantora One' => 'Cantora One',
                                                                'Capriola' => 'Capriola',
                                                                'Cardo' => 'Cardo',
                                                                'Carme' => 'Carme',
                                                                'Carrois Gothic' => 'Carrois Gothic',
                                                                'Carrois Gothic SC' => 'Carrois Gothic SC',
                                                                'Carter One' => 'Carter One',
                                                                'Caudex' => 'Caudex',
                                                                'Cedarville Cursive' => 'Cedarville Cursive',
                                                                'Ceviche One' => 'Ceviche One',
                                                                'Changa One' => 'Changa One',
                                                                'Chango' => 'Chango',
                                                                'Chau Philomene One' => 'Chau Philomene One',
                                                                'Chela One' => 'Chela One',
                                                                'Chelsea Market' => 'Chelsea Market',
                                                                'Chenla' => 'Chenla',
                                                                'Cherry Cream Soda' => 'Cherry Cream Soda',
                                                                'Cherry Swash' => 'Cherry Swash',
                                                                'Chewy' => 'Chewy',
                                                                'Chicle' => 'Chicle',
                                                                'Chivo' => 'Chivo',
                                                                'Cinzel' => 'Cinzel',
                                                                'Cinzel Decorative' => 'Cinzel Decorative',
                                                                'Clicker Script' => 'Clicker Script',
                                                                'Coda' => 'Coda',
                                                                'Coda Caption' => 'Coda Caption',
                                                                'Codystar' => 'Codystar',
                                                                'Combo' => 'Combo',
                                                                'Comfortaa' => 'Comfortaa',
                                                                'Coming Soon' => 'Coming Soon',
                                                                'Concert One' => 'Concert One',
                                                                'Condiment' => 'Condiment',
                                                                'Content' => 'Content',
                                                                'Contrail One' => 'Contrail One',
                                                                'Convergence' => 'Convergence',
                                                                'Cookie' => 'Cookie',
                                                                'Copse' => 'Copse',
                                                                'Corben' => 'Corben',
                                                                'Courgette' => 'Courgette',
                                                                'Cousine' => 'Cousine',
                                                                'Coustard' => 'Coustard',
                                                                'Covered By Your Grace' => 'Covered By Your Grace',
                                                                'Crafty Girls' => 'Crafty Girls',
                                                                'Creepster' => 'Creepster',
                                                                'Crete Round' => 'Crete Round',
                                                                'Crimson Text' => 'Crimson Text',
                                                                'Croissant One' => 'Croissant One',
                                                                'Crushed' => 'Crushed',
                                                                'Cuprum' => 'Cuprum',
                                                                'Cutive' => 'Cutive',
                                                                'Cutive Mono' => 'Cutive Mono',
                                                                'Damion' => 'Damion',
                                                                'Dancing Script' => 'Dancing Script',
                                                                'Dangrek' => 'Dangrek',
                                                                'Dawning of a New Day' => 'Dawning of a New Day',
                                                                'Days One' => 'Days One',
                                                                'Delius' => 'Delius',
                                                                'Delius Swash Caps' => 'Delius Swash Caps',
                                                                'Delius Unicase' => 'Delius Unicase',
                                                                'Della Respira' => 'Della Respira',
                                                                'Denk One' => 'Denk One',
                                                                'Devonshire' => 'Devonshire',
                                                                'Didact Gothic' => 'Didact Gothic',
                                                                'Diplomata' => 'Diplomata',
                                                                'Diplomata SC' => 'Diplomata SC',
                                                                'Domine' => 'Domine',
                                                                'Donegal One' => 'Donegal One',
                                                                'Doppio One' => 'Doppio One',
                                                                'Dorsa' => 'Dorsa',
                                                                'Dosis' => 'Dosis',
                                                                'Dr Sugiyama' => 'Dr Sugiyama',
                                                                'Droid Sans' => 'Droid Sans',
                                                                'Droid Sans Mono' => 'Droid Sans Mono',
                                                                'Droid Serif' => 'Droid Serif',
                                                                'Duru Sans' => 'Duru Sans',
                                                                'Dynalight' => 'Dynalight',
                                                                'EB Garamond' => 'EB Garamond',
                                                                'Eagle Lake' => 'Eagle Lake',
                                                                'Eater' => 'Eater',
                                                                'Economica' => 'Economica',
                                                                'Ek Mukta' => 'Ek Mukta',
                                                                'Electrolize' => 'Electrolize',
                                                                'Elsie' => 'Elsie',
                                                                'Elsie Swash Caps' => 'Elsie Swash Caps',
                                                                'Emblema One' => 'Emblema One',
                                                                'Emilys Candy' => 'Emilys Candy',
                                                                'Engagement' => 'Engagement',
                                                                'Englebert' => 'Englebert',
                                                                'Enriqueta' => 'Enriqueta',
                                                                'Erica One' => 'Erica One',
                                                                'Esteban' => 'Esteban',
                                                                'Euphoria Script' => 'Euphoria Script',
                                                                'Ewert' => 'Ewert',
                                                                'Exo' => 'Exo',
                                                                'Exo 2' => 'Exo 2',
                                                                'Expletus Sans' => 'Expletus Sans',
                                                                'Fanwood Text' => 'Fanwood Text',
                                                                'Fascinate' => 'Fascinate',
                                                                'Fascinate Inline' => 'Fascinate Inline',
                                                                'Faster One' => 'Faster One',
                                                                'Fasthand' => 'Fasthand',
                                                                'Fauna One' => 'Fauna One',
                                                                'Federant' => 'Federant',
                                                                'Federo' => 'Federo',
                                                                'Felipa' => 'Felipa',
                                                                'Fenix' => 'Fenix',
                                                                'Finger Paint' => 'Finger Paint',
                                                                'Fira Mono' => 'Fira Mono',
                                                                'Fira Sans' => 'Fira Sans',
                                                                'Fjalla One' => 'Fjalla One',
                                                                'Fjord One' => 'Fjord One',
                                                                'Flamenco' => 'Flamenco',
                                                                'Flavors' => 'Flavors',
                                                                'Fondamento' => 'Fondamento',
                                                                'Fontdiner Swanky' => 'Fontdiner Swanky',
                                                                'Forum' => 'Forum',
                                                                'Francois One' => 'Francois One',
                                                                'Freckle Face' => 'Freckle Face',
                                                                'Fredericka the Great' => 'Fredericka the Great',
                                                                'Fredoka One' => 'Fredoka One',
                                                                'Freehand' => 'Freehand',
                                                                'Fresca' => 'Fresca',
                                                                'Frijole' => 'Frijole',
                                                                'Fruktur' => 'Fruktur',
                                                                'Fugaz One' => 'Fugaz One',
                                                                'GFS Didot' => 'GFS Didot',
                                                                'GFS Neohellenic' => 'GFS Neohellenic',
                                                                'Gabriela' => 'Gabriela',
                                                                'Gafata' => 'Gafata',
                                                                'Galdeano' => 'Galdeano',
                                                                'Galindo' => 'Galindo',
                                                                'Gentium Basic' => 'Gentium Basic',
                                                                'Gentium Book Basic' => 'Gentium Book Basic',
                                                                'Geo' => 'Geo',
                                                                'Geostar' => 'Geostar',
                                                                'Geostar Fill' => 'Geostar Fill',
                                                                'Germania One' => 'Germania One',
                                                                'Gilda Display' => 'Gilda Display',
                                                                'Give You Glory' => 'Give You Glory',
                                                                'Glass Antiqua' => 'Glass Antiqua',
                                                                'Glegoo' => 'Glegoo',
                                                                'Gloria Hallelujah' => 'Gloria Hallelujah',
                                                                'Goblin One' => 'Goblin One',
                                                                'Gochi Hand' => 'Gochi Hand',
                                                                'Gorditas' => 'Gorditas',
                                                                'Goudy Bookletter 1911' => 'Goudy Bookletter 1911',
                                                                'Graduate' => 'Graduate',
                                                                'Grand Hotel' => 'Grand Hotel',
                                                                'Gravitas One' => 'Gravitas One',
                                                                'Great Vibes' => 'Great Vibes',
                                                                'Griffy' => 'Griffy',
                                                                'Gruppo' => 'Gruppo',
                                                                'Gudea' => 'Gudea',
                                                                'Habibi' => 'Habibi',
                                                                'Hammersmith One' => 'Hammersmith One',
                                                                'Hanalei' => 'Hanalei',
                                                                'Hanalei Fill' => 'Hanalei Fill',
                                                                'Handlee' => 'Handlee',
                                                                'Hanuman' => 'Hanuman',
                                                                'Happy Monkey' => 'Happy Monkey',
                                                                'Headland One' => 'Headland One',
                                                                'Henny Penny' => 'Henny Penny',
                                                                'Herr Von Muellerhoff' => 'Herr Von Muellerhoff',
                                                                'Holtwood One SC' => 'Holtwood One SC',
                                                                'Homemade Apple' => 'Homemade Apple',
                                                                'Homenaje' => 'Homenaje',
                                                                'IM Fell DW Pica' => 'IM Fell DW Pica',
                                                                'IM Fell DW Pica SC' => 'IM Fell DW Pica SC',
                                                                'IM Fell Double Pica' => 'IM Fell Double Pica',
                                                                'IM Fell Double Pica SC' => 'IM Fell Double Pica SC',
                                                                'IM Fell English' => 'IM Fell English',
                                                                'IM Fell English SC' => 'IM Fell English SC',
                                                                'IM Fell French Canon' => 'IM Fell French Canon',
                                                                'IM Fell French Canon SC' => 'IM Fell French Canon SC',
                                                                'IM Fell Great Primer' => 'IM Fell Great Primer',
                                                                'IM Fell Great Primer SC' => 'IM Fell Great Primer SC',
                                                                'Iceberg' => 'Iceberg',
                                                                'Iceland' => 'Iceland',
                                                                'Imprima' => 'Imprima',
                                                                'Inconsolata' => 'Inconsolata',
                                                                'Inder' => 'Inder',
                                                                'Indie Flower' => 'Indie Flower',
                                                                'Inika' => 'Inika',
                                                                'Irish Grover' => 'Irish Grover',
                                                                'Istok Web' => 'Istok Web',
                                                                'Italiana' => 'Italiana',
                                                                'Italianno' => 'Italianno',
                                                                'Jacques Francois' => 'Jacques Francois',
                                                                'Jacques Francois Shadow' => 'Jacques Francois Shadow',
                                                                'Jim Nightshade' => 'Jim Nightshade',
                                                                'Jockey One' => 'Jockey One',
                                                                'Jolly Lodger' => 'Jolly Lodger',
                                                                'Josefin Sans' => 'Josefin Sans',
                                                                'Josefin Slab' => 'Josefin Slab',
                                                                'Joti One' => 'Joti One',
                                                                'Judson' => 'Judson',
                                                                'Julee' => 'Julee',
                                                                'Julius Sans One' => 'Julius Sans One',
                                                                'Junge' => 'Junge',
                                                                'Jura' => 'Jura',
                                                                'Just Another Hand' => 'Just Another Hand',
                                                                'Just Me Again Down Here' => 'Just Me Again Down Here',
                                                                'Kameron' => 'Kameron',
                                                                'Kantumruy' => 'Kantumruy',
                                                                'Karla' => 'Karla',
                                                                'Kaushan Script' => 'Kaushan Script',
                                                                'Kavoon' => 'Kavoon',
                                                                'Kdam Thmor' => 'Kdam Thmor',
                                                                'Keania One' => 'Keania One',
                                                                'Kelly Slab' => 'Kelly Slab',
                                                                'Kenia' => 'Kenia',
                                                                'Khmer' => 'Khmer',
                                                                'Kite One' => 'Kite One',
                                                                'Knewave' => 'Knewave',
                                                                'Kotta One' => 'Kotta One',
                                                                'Koulen' => 'Koulen',
                                                                'Kranky' => 'Kranky',
                                                                'Kreon' => 'Kreon',
                                                                'Kristi' => 'Kristi',
                                                                'Krona One' => 'Krona One',
                                                                'La Belle Aurore' => 'La Belle Aurore',
                                                                'Lancelot' => 'Lancelot',
                                                                'Lato' => 'Lato',
                                                                'League Script' => 'League Script',
                                                                'Leckerli One' => 'Leckerli One',
                                                                'Ledger' => 'Ledger',
                                                                'Lekton' => 'Lekton',
                                                                'Lemon' => 'Lemon',
                                                                'Libre Baskerville' => 'Libre Baskerville',
                                                                'Life Savers' => 'Life Savers',
                                                                'Lilita One' => 'Lilita One',
                                                                'Lily Script One' => 'Lily Script One',
                                                                'Limelight' => 'Limelight',
                                                                'Linden Hill' => 'Linden Hill',
                                                                'Lobster' => 'Lobster',
                                                                'Lobster Two' => 'Lobster Two',
                                                                'Londrina Outline' => 'Londrina Outline',
                                                                'Londrina Shadow' => 'Londrina Shadow',
                                                                'Londrina Sketch' => 'Londrina Sketch',
                                                                'Londrina Solid' => 'Londrina Solid',
                                                                'Lora' => 'Lora',
                                                                'Love Ya Like A Sister' => 'Love Ya Like A Sister',
                                                                'Loved by the King' => 'Loved by the King',
                                                                'Lovers Quarrel' => 'Lovers Quarrel',
                                                                'Luckiest Guy' => 'Luckiest Guy',
                                                                'Lusitana' => 'Lusitana',
                                                                'Lustria' => 'Lustria',
                                                                'Macondo' => 'Macondo',
                                                                'Macondo Swash Caps' => 'Macondo Swash Caps',
                                                                'Magra' => 'Magra',
                                                                'Maiden Orange' => 'Maiden Orange',
                                                                'Mako' => 'Mako',
                                                                'Marcellus' => 'Marcellus',
                                                                'Marcellus SC' => 'Marcellus SC',
                                                                'Marck Script' => 'Marck Script',
                                                                'Margarine' => 'Margarine',
                                                                'Marko One' => 'Marko One',
                                                                'Marmelad' => 'Marmelad',
                                                                'Marvel' => 'Marvel',
                                                                'Mate' => 'Mate',
                                                                'Mate SC' => 'Mate SC',
                                                                'Maven Pro' => 'Maven Pro',
                                                                'McLaren' => 'McLaren',
                                                                'Meddon' => 'Meddon',
                                                                'MedievalSharp' => 'MedievalSharp',
                                                                'Medula One' => 'Medula One',
                                                                'Megrim' => 'Megrim',
                                                                'Meie Script' => 'Meie Script',
                                                                'Merienda' => 'Merienda',
                                                                'Merienda One' => 'Merienda One',
                                                                'Merriweather' => 'Merriweather',
                                                                'Merriweather Sans' => 'Merriweather Sans',
                                                                'Metal' => 'Metal',
                                                                'Metal Mania' => 'Metal Mania',
                                                                'Metamorphous' => 'Metamorphous',
                                                                'Metrophobic' => 'Metrophobic',
                                                                'Michroma' => 'Michroma',
                                                                'Milonga' => 'Milonga',
                                                                'Miltonian' => 'Miltonian',
                                                                'Miltonian Tattoo' => 'Miltonian Tattoo',
                                                                'Miniver' => 'Miniver',
                                                                'Miss Fajardose' => 'Miss Fajardose',
                                                                'Modern Antiqua' => 'Modern Antiqua',
                                                                'Molengo' => 'Molengo',
                                                                'Molle' => 'Molle',
                                                                'Monda' => 'Monda',
                                                                'Monofett' => 'Monofett',
                                                                'Monoton' => 'Monoton',
                                                                'Monsieur La Doulaise' => 'Monsieur La Doulaise',
                                                                'Montaga' => 'Montaga',
                                                                'Montez' => 'Montez',
                                                                'Montserrat' => 'Montserrat',
                                                                'Montserrat Alternates' => 'Montserrat Alternates',
                                                                'Montserrat Subrayada' => 'Montserrat Subrayada',
                                                                'Moul' => 'Moul',
                                                                'Moulpali' => 'Moulpali',
                                                                'Mountains of Christmas' => 'Mountains of Christmas',
                                                                'Mouse Memoirs' => 'Mouse Memoirs',
                                                                'Mr Bedfort' => 'Mr Bedfort',
                                                                'Mr Dafoe' => 'Mr Dafoe',
                                                                'Mr De Haviland' => 'Mr De Haviland',
                                                                'Mrs Saint Delafield' => 'Mrs Saint Delafield',
                                                                'Mrs Sheppards' => 'Mrs Sheppards',
                                                                'Muli' => 'Muli',
                                                                'Mystery Quest' => 'Mystery Quest',
                                                                'Neucha' => 'Neucha',
                                                                'Neuton' => 'Neuton',
                                                                'New Rocker' => 'New Rocker',
                                                                'News Cycle' => 'News Cycle',
                                                                'Niconne' => 'Niconne',
                                                                'Nixie One' => 'Nixie One',
                                                                'Nobile' => 'Nobile',
                                                                'Nokora' => 'Nokora',
                                                                'Norican' => 'Norican',
                                                                'Nosifer' => 'Nosifer',
                                                                'Nothing You Could Do' => 'Nothing You Could Do',
                                                                'Noticia Text' => 'Noticia Text',
                                                                'Noto Sans' => 'Noto Sans',
                                                                'Noto Serif' => 'Noto Serif',
                                                                'Nova Cut' => 'Nova Cut',
                                                                'Nova Flat' => 'Nova Flat',
                                                                'Nova Mono' => 'Nova Mono',
                                                                'Nova Oval' => 'Nova Oval',
                                                                'Nova Round' => 'Nova Round',
                                                                'Nova Script' => 'Nova Script',
                                                                'Nova Slim' => 'Nova Slim',
                                                                'Nova Square' => 'Nova Square',
                                                                'Numans' => 'Numans',
                                                                'Nunito' => 'Nunito',
                                                                'Odor Mean Chey' => 'Odor Mean Chey',
                                                                'Offside' => 'Offside',
                                                                'Old Standard TT' => 'Old Standard TT',
                                                                'Oldenburg' => 'Oldenburg',
                                                                'Oleo Script' => 'Oleo Script',
                                                                'Oleo Script Swash Caps' => 'Oleo Script Swash Caps',
                                                                'Open Sans' => 'Open Sans',
                                                                'Open Sans Condensed' => 'Open Sans Condensed',
                                                                'Oranienbaum' => 'Oranienbaum',
                                                                'Orbitron' => 'Orbitron',
                                                                'Oregano' => 'Oregano',
                                                                'Orienta' => 'Orienta',
                                                                'Original Surfer' => 'Original Surfer',
                                                                'Oswald' => 'Oswald',
                                                                'Over the Rainbow' => 'Over the Rainbow',
                                                                'Overlock' => 'Overlock',
                                                                'Overlock SC' => 'Overlock SC',
                                                                'Ovo' => 'Ovo',
                                                                'Oxygen' => 'Oxygen',
                                                                'Oxygen Mono' => 'Oxygen Mono',
                                                                'PT Mono' => 'PT Mono',
                                                                'PT Sans' => 'PT Sans',
                                                                'PT Sans Caption' => 'PT Sans Caption',
                                                                'PT Sans Narrow' => 'PT Sans Narrow',
                                                                'PT Serif' => 'PT Serif',
                                                                'PT Serif Caption' => 'PT Serif Caption',
                                                                'Pacifico' => 'Pacifico',
                                                                'Paprika' => 'Paprika',
                                                                'Parisienne' => 'Parisienne',
                                                                'Passero One' => 'Passero One',
                                                                'Passion One' => 'Passion One',
                                                                'Pathway Gothic One' => 'Pathway Gothic One',
                                                                'Patrick Hand' => 'Patrick Hand',
                                                                'Patrick Hand SC' => 'Patrick Hand SC',
                                                                'Patua One' => 'Patua One',
                                                                'Paytone One' => 'Paytone One',
                                                                'Peralta' => 'Peralta',
                                                                'Permanent Marker' => 'Permanent Marker',
                                                                'Petit Formal Script' => 'Petit Formal Script',
                                                                'Petrona' => 'Petrona',
                                                                'Philosopher' => 'Philosopher',
                                                                'Piedra' => 'Piedra',
                                                                'Pinyon Script' => 'Pinyon Script',
                                                                'Pirata One' => 'Pirata One',
                                                                'Plaster' => 'Plaster',
                                                                'Play' => 'Play',
                                                                'Playball' => 'Playball',
                                                                'Playfair Display' => 'Playfair Display',
                                                                'Playfair Display SC' => 'Playfair Display SC',
                                                                'Podkova' => 'Podkova',
                                                                'Poiret One' => 'Poiret One',
                                                                'Poller One' => 'Poller One',
                                                                'Poly' => 'Poly',
                                                                'Pompiere' => 'Pompiere',
                                                                'Pontano Sans' => 'Pontano Sans',
                                                                'Port Lligat Sans' => 'Port Lligat Sans',
                                                                'Port Lligat Slab' => 'Port Lligat Slab',
                                                                'Prata' => 'Prata',
                                                                'Preahvihear' => 'Preahvihear',
                                                                'Press Start 2P' => 'Press Start 2P',
                                                                'Princess Sofia' => 'Princess Sofia',
                                                                'Prociono' => 'Prociono',
                                                                'Prosto One' => 'Prosto One',
                                                                'Puritan' => 'Puritan',
                                                                'Purple Purse' => 'Purple Purse',
                                                                'Quando' => 'Quando',
                                                                'Quantico' => 'Quantico',
                                                                'Quattrocento' => 'Quattrocento',
                                                                'Quattrocento Sans' => 'Quattrocento Sans',
                                                                'Questrial' => 'Questrial',
                                                                'Quicksand' => 'Quicksand',
                                                                'Quintessential' => 'Quintessential',
                                                                'Qwigley' => 'Qwigley',
                                                                'Racing Sans One' => 'Racing Sans One',
                                                                'Radley' => 'Radley',
                                                                'Raleway' => 'Raleway',
                                                                'Raleway Dots' => 'Raleway Dots',
                                                                'Rambla' => 'Rambla',
                                                                'Rammetto One' => 'Rammetto One',
                                                                'Ranchers' => 'Ranchers',
                                                                'Rancho' => 'Rancho',
                                                                'Rationale' => 'Rationale',
                                                                'Redressed' => 'Redressed',
                                                                'Reenie Beanie' => 'Reenie Beanie',
                                                                'Revalia' => 'Revalia',
                                                                'Ribeye' => 'Ribeye',
                                                                'Ribeye Marrow' => 'Ribeye Marrow',
                                                                'Righteous' => 'Righteous',
                                                                'Risque' => 'Risque',
                                                                'Roboto' => 'Roboto',
                                                                'Roboto Condensed' => 'Roboto Condensed',
                                                                'Roboto Slab' => 'Roboto Slab',
                                                                'Rochester' => 'Rochester',
                                                                'Rock Salt' => 'Rock Salt',
                                                                'Rokkitt' => 'Rokkitt',
                                                                'Romanesco' => 'Romanesco',
                                                                'Ropa Sans' => 'Ropa Sans',
                                                                'Rosario' => 'Rosario',
                                                                'Rosarivo' => 'Rosarivo',
                                                                'Rouge Script' => 'Rouge Script',
                                                                'Rubik Mono One' => 'Rubik Mono One',
                                                                'Rubik One' => 'Rubik One',
                                                                'Ruda' => 'Ruda',
                                                                'Rufina' => 'Rufina',
                                                                'Ruge Boogie' => 'Ruge Boogie',
                                                                'Ruluko' => 'Ruluko',
                                                                'Rum Raisin' => 'Rum Raisin',
                                                                'Ruslan Display' => 'Ruslan Display',
                                                                'Russo One' => 'Russo One',
                                                                'Ruthie' => 'Ruthie',
                                                                'Rye' => 'Rye',
                                                                'Sacramento' => 'Sacramento',
                                                                'Sail' => 'Sail',
                                                                'Salsa' => 'Salsa',
                                                                'Sanchez' => 'Sanchez',
                                                                'Sancreek' => 'Sancreek',
                                                                'Sansita One' => 'Sansita One',
                                                                'Sarina' => 'Sarina',
                                                                'Satisfy' => 'Satisfy',
                                                                'Scada' => 'Scada',
                                                                'Schoolbell' => 'Schoolbell',
                                                                'Seaweed Script' => 'Seaweed Script',
                                                                'Sevillana' => 'Sevillana',
                                                                'Seymour One' => 'Seymour One',
                                                                'Shadows Into Light' => 'Shadows Into Light',
                                                                'Shadows Into Light Two' => 'Shadows Into Light Two',
                                                                'Shanti' => 'Shanti',
                                                                'Share' => 'Share',
                                                                'Share Tech' => 'Share Tech',
                                                                'Share Tech Mono' => 'Share Tech Mono',
                                                                'Shojumaru' => 'Shojumaru',
                                                                'Short Stack' => 'Short Stack',
                                                                'Siemreap' => 'Siemreap',
                                                                'Sigmar One' => 'Sigmar One',
                                                                'Signika' => 'Signika',
                                                                'Signika Negative' => 'Signika Negative',
                                                                'Simonetta' => 'Simonetta',
                                                                'Sintony' => 'Sintony',
                                                                'Sirin Stencil' => 'Sirin Stencil',
                                                                'Six Caps' => 'Six Caps',
                                                                'Skranji' => 'Skranji',
                                                                'Slackey' => 'Slackey',
                                                                'Smokum' => 'Smokum',
                                                                'Smythe' => 'Smythe',
                                                                'Sniglet' => 'Sniglet',
                                                                'Snippet' => 'Snippet',
                                                                'Snowburst One' => 'Snowburst One',
                                                                'Sofadi One' => 'Sofadi One',
                                                                'Sofia' => 'Sofia',
                                                                'Sonsie One' => 'Sonsie One',
                                                                'Sorts Mill Goudy' => 'Sorts Mill Goudy',
                                                                'Source Code Pro' => 'Source Code Pro',
                                                                'Source Sans Pro' => 'Source Sans Pro',
                                                                'Source Serif Pro' => 'Source Serif Pro',
                                                                'Special Elite' => 'Special Elite',
                                                                'Spicy Rice' => 'Spicy Rice',
                                                                'Spinnaker' => 'Spinnaker',
                                                                'Spirax' => 'Spirax',
                                                                'Squada One' => 'Squada One',
                                                                'Stalemate' => 'Stalemate',
                                                                'Stalinist One' => 'Stalinist One',
                                                                'Stardos Stencil' => 'Stardos Stencil',
                                                                'Stint Ultra Condensed' => 'Stint Ultra Condensed',
                                                                'Stint Ultra Expanded' => 'Stint Ultra Expanded',
                                                                'Stoke' => 'Stoke',
                                                                'Strait' => 'Strait',
                                                                'Sue Ellen Francisco' => 'Sue Ellen Francisco',
                                                                'Sunshiney' => 'Sunshiney',
                                                                'Supermercado One' => 'Supermercado One',
                                                                'Suwannaphum' => 'Suwannaphum',
                                                                'Swanky and Moo Moo' => 'Swanky and Moo Moo',
                                                                'Syncopate' => 'Syncopate',
                                                                'Tangerine' => 'Tangerine',
                                                                'Taprom' => 'Taprom',
                                                                'Tauri' => 'Tauri',
                                                                'Telex' => 'Telex',
                                                                'Tenor Sans' => 'Tenor Sans',
                                                                'Text Me One' => 'Text Me One',
                                                                'The Girl Next Door' => 'The Girl Next Door',
                                                                'Tienne' => 'Tienne',
                                                                'Tinos' => 'Tinos',
                                                                'Titan One' => 'Titan One',
                                                                'Titillium Web' => 'Titillium Web',
                                                                'Trade Winds' => 'Trade Winds',
                                                                'Trocchi' => 'Trocchi',
                                                                'Trochut' => 'Trochut',
                                                                'Trykker' => 'Trykker',
                                                                'Tulpen One' => 'Tulpen One',
                                                                'Ubuntu' => 'Ubuntu',
                                                                'Ubuntu Condensed' => 'Ubuntu Condensed',
                                                                'Ubuntu Mono' => 'Ubuntu Mono',
                                                                'Ultra' => 'Ultra',
                                                                'Uncial Antiqua' => 'Uncial Antiqua',
                                                                'Underdog' => 'Underdog',
                                                                'Unica One' => 'Unica One',
                                                                'UnifrakturCook' => 'UnifrakturCook',
                                                                'UnifrakturMaguntia' => 'UnifrakturMaguntia',
                                                                'Unkempt' => 'Unkempt',
                                                                'Unlock' => 'Unlock',
                                                                'Unna' => 'Unna',
                                                                'VT323' => 'VT323',
                                                                'Vampiro One' => 'Vampiro One',
                                                                'Varela' => 'Varela',
                                                                'Varela Round' => 'Varela Round',
                                                                'Vast Shadow' => 'Vast Shadow',
                                                                'Vibur' => 'Vibur',
                                                                'Vidaloka' => 'Vidaloka',
                                                                'Viga' => 'Viga',
                                                                'Voces' => 'Voces',
                                                                'Volkhov' => 'Volkhov',
                                                                'Vollkorn' => 'Vollkorn',
                                                                'Voltaire' => 'Voltaire',
                                                                'Waiting for the Sunrise' => 'Waiting for the Sunrise',
                                                                'Wallpoet' => 'Wallpoet',
                                                                'Walter Turncoat' => 'Walter Turncoat',
                                                                'Warnes' => 'Warnes',
                                                                'Wellfleet' => 'Wellfleet',
                                                                'Wendy One' => 'Wendy One',
                                                                'Wire One' => 'Wire One',
                                                                'Yanone Kaffeesatz' => 'Yanone Kaffeesatz',
                                                                'Yellowtail' => 'Yellowtail',
                                                                'Yeseva One' => 'Yeseva One',       
                                                                'Yesteryear' => 'Yesteryear',
                                                                'Zeyada' => 'Zeyada',
                                                        
                                                        ),
          'priority'              => 20
          ) );



          // add color picker setting
          $wp_customize->add_setting( 'theme_color_setting', array(
            'default' => '#F66264',
            'sanitize_callback' => 'esc_attr',
          ) );

          // add color picker control
          $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_color_setting', array(
            'label' => __('Theme  Color','ultrabootstrap'),
            'section' => 'ultrabootstrap_google_fontfamily',
            'settings' => 'theme_color_setting',
          ) ) );


     
    }

add_action( 'customize_register', 'ultrabootstrap_customizer_register' );



 //****************OTHER THEME OPTION******************///
     
        


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function ultrabootstrap_customize_preview_js() {
  wp_enqueue_script( 'ultrabootstrap_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'ultrabootstrap_customize_preview_js' );

function ultrabootstrap_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

function ultrabootstrap_sanitize_textarea( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

function ultrabootstrap_sanitize_category($input){
  $output=intval($input);
  return $output;

}
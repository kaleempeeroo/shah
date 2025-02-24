<?php
/*
function university_files() {
    wp_enqueue_script('main-university-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
    //wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Montserrat:400,500,700');
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('university_main_styles', get_theme_file_uri('/build/style-index.css'));
    wp_enqueue_style('university_extra_styles', get_theme_file_uri('/build/index.css'));
  }

/* Add bootstrap support to the Wordpress theme

function theme_add_bootstrap() {
    wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css' );
    wp_enqueue_style( 'style-css', get_template_directory_uri() . '/style.css' );
    wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '3.0.0', true );
    }
    
    add_action( 'wp_enqueue_scripts', 'theme_add_bootstrap' );

  */

function shah_files() {
    
    
    
    //wp_enqueue_script( 'bootstrap-js', get_theme_file_uri('/js/bootstrap.min.js'), array(), '3.0.0', true );

    //wp_enqueue_script('slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js');
    
    wp_enqueue_script('slick', get_theme_file_uri('/js/slick.min.js'), array('jquery'), '1.0', true   );
    //wp_enqueue_script('main', get_theme_file_uri('/js/main.js'), array('jquery'), '1.0', true);

    wp_enqueue_script('custom-zoom', get_theme_file_uri('/js/jquery.zoom.min.js'), 'JQuery', 1.5, TRUE);

    wp_enqueue_script('ho', get_theme_file_uri('/js/ho.js'), array('jquery'), '1.0', true);
    wp_enqueue_script( 'bootstrap-js', get_theme_file_uri('/js/bootstrap.min.js'), '1.0', true);

    //wp_enqueue_script('nouislider', get_theme_file_uri('/js/nouislider.min.js'), array('jquery'), '1.0', true);
    //wp_enqueue_script('jquery-ui', '//code.jquery.com/ui/1.12.1/jquery-ui.js');
    //wp_enqueue_script('prelude-jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js');
    //wp_enqueue_script('jquery-zoom', get_theme_file_uri('/js/jquery.zoom.min.js'), array(), '1.0', true);
 //wp_register_script('prelude_jquery', ('https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js'), false);
      //  wp_enqueue_script('prelude_jquery');
    wp_enqueue_style( 'bootstrap-css', get_theme_file_uri('/css/bootstrap.min.css'));
    
    
    //wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Montserrat:400,500,700');
    //wp_enqueue_style('bootstrap', get_theme_file_uri('/css/bootstrap.min.css'));
    
    wp_enqueue_style('font-awesome', get_theme_file_uri('/css/font-awesome.min.css'));
    wp_enqueue_style('slick-styles', get_theme_file_uri('/css/slick.css'));
    //wp_enqueue_style('slick-styles', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
    wp_enqueue_style('slick-theme', get_theme_file_uri('/css/slick-theme.css'));
    
    wp_enqueue_style('slick-theme-font', '//use.fontawesome.com/releases/v5.0.6/css/all.css');
    
    wp_enqueue_style('custom-styles', get_theme_file_uri('/css/style.css'));

  }

  add_action('wp_enqueue_scripts', 'shah_files');
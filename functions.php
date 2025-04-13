<?php

function shah_files() {
    
    wp_enqueue_script('slick', get_theme_file_uri('/js/slick.min.js'), array('jquery'), '1.0', true   );
    wp_enqueue_script('custom-zoom', get_theme_file_uri('/js/jquery.zoom.min.js'), 'JQuery', 1.5, TRUE);
    wp_enqueue_script('ho', get_theme_file_uri('/js/ho.js'), array('jquery'), '1.0', true);
    wp_enqueue_script( 'bootstrap-js', get_theme_file_uri('/js/bootstrap.min.js'), '1.0', true);
    wp_enqueue_script('main', get_theme_file_uri('/js/main.js'), array('jquery'), '1.0', true);
    //wp_enqueue_script('nouislider', get_theme_file_uri('/js/nouislider.min.js'), array('jquery'), '1.0', true);
    
    wp_enqueue_style( 'bootstrap-css', get_theme_file_uri('/css/bootstrap.min.css'));    
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Montserrat:400,500,700');
    // this needs to be added on top for fa icons to work
    wp_enqueue_style('slick-theme-font', '//use.fontawesome.com/releases/v5.0.6/css/all.css');
    wp_enqueue_style('font-awesome', get_theme_file_uri('/css/font-awesome.min.css'));
    wp_enqueue_style('slick-styles', get_theme_file_uri('/css/slick.css'));
    wp_enqueue_style('slick-theme', get_theme_file_uri('/css/slick-theme.css'));    
    wp_enqueue_style('custom-styles', get_theme_file_uri('/css/style.css'));
    wp_enqueue_style('icon-styles', get_theme_file_uri('/css/social-icons.css'));    

  }

add_action('wp_enqueue_scripts', 'shah_files');

add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
//add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 40 );
//add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );

// changing WooCommerce Single product title style here instead of using snippets in admin dashboard.
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
add_action( 'woocommerce_single_product_summary', 'sgl_template_single_title', 5 );
function sgl_template_single_title() {
   the_title( '<h1 class="product-name">', '</h1>' );
}

/* 
WordPress optimization specialist = RankYa
Automatically inserts social media share links to blog posts, below content.
Simply insert the code in wp-content > themes > yourCurrentTheme > functions.php

Download Automatic + Shortcode + css code from below:
https://www.rankya.com/wordpress/how-to-add-social-media-share-links-to-wordpress-without-a-plugin/?unapproved=68649&moderation-hash=4effde82275080481cb687925b15e143#comment-68649

*/
/*

We are not using this function that inserts social share icons
directly at the bottom of blog posts only.

function rankya_social_share_buttons($content) {
	$siteurlfromsettingsgeneral =  get_bloginfo( 'url' );
    $domainparts = parse_url($siteurlfromsettingsgeneral);
    $domain = isset($domainparts['host']) ? $domainparts['host'] : '';
    if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
       $siteurlfromsettingsgeneral = strstr( $regs['domain'], '.', true );
    }
    if(is_single()){
        // Get singular which will allow to add the shortcode on WordPress Widget OR you could just use is_single
        $rankya_url = urlencode( get_permalink() );
        // get_the_title but add space %20
        $rankya_title = str_replace( ' ', '%20', get_the_title());
        // Core Web Vitals are important for shares
        $twitterURL = 'https://twitter.com/intent/tweet?text='.$rankya_title.'&amp;url='.$rankya_url.'&amp;via='.$siteurlfromsettingsgeneral.'';
        $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$rankya_url;
        $whatsappURL = 'whatsapp://send?text='.$rankya_title . ' ' . $rankya_url;
        $linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url='.$rankya_url.'&amp;title='.$rankya_title;
		//if featured image set, use
		if ( has_post_thumbnail() && is_single() ) {
					$thumb_id = get_post_thumbnail_id();
					$thumb_url = wp_get_attachment_image_src($thumb_id,'full', true); 
					$pinterestNewURL = 'https://pinterest.com/pin/create/button/?url='.$rankya_url.'&amp;media='.$thumb_url[0].'&amp;description='.$rankya_title;
		} else{
			$pinterestNewURL = 'https://pinterest.com/pin/create/button/?url='.$rankya_url.'&amp;description='.$rankya_title;
			}
       // Add sharing button at the end of single posts add_filter( 'the_content', 'rankya_social_share_buttons'); OR you can also use it anywhere else, but pinterest image doesn't show in PAGES, so thus, comment pinterest line
        $content .= '<div class="social-share-div"><strong>Help others, share this content</strong><div class="share-buttons">';
        $content .= '<a class="buttonlink share-button-profile-twitter" href="'. $twitterURL .'" target="_blank" rel="nofollow noopener">Twitter</a>';
        $content .= '<a class="buttonlink share-button-profile-facebook" href="'.$facebookURL.'" target="_blank" rel="nofollow noopener">Facebook</a>';
        $content .= '<a class="buttonlink share-button-profile-whatsapp" href="'.$whatsappURL.'" target="_blank" rel="nofollow noopener">WhatsApp</a>';
        $content .= '<a class="buttonlink share-button-profile-pinterest" href="'.$pinterestNewURL.'" data-pin-custom="true" target="_blank" rel="nofollow noopener">Pin It</a>';
        $content .= '<a class="buttonlink share-button-profile-linkedin" href="'.$linkedInURL.'" target="_blank" rel="nofollow noopener">LinkedIn</a>';
        $content .= '</div></div>';
        return $content;
    } else {
        // if not is_singular return just the content include sharing button
        return $content;
    }
};
// filter below automatically will add buttons
add_filter( 'the_content', 'rankya_social_share_buttons');

/* 
WordPress Function to Add Social Media Share Links to WordPress Using Shortcode
WordPress optimization specialist = RankYa
Automatically inserts social media share links to blog posts, below content.
Simply insert the code in wp-content > themes > yourCurrentTheme > functions.php
Place it anywhere you want the Social Share Links to show (perhaps Sidebar Widget or Footer Widget) using below WordPress shortcode
[insertrankyasharebuttonshortcode]

We are using this function to insert shortcode directly on single product page.
Modified original version to check for page instead of post.
Can modify to check for specific Woocommerce ID as well.  Check youtube video comments.
*/

function rankyasharebuttonshortcode(){ 
	$siteurlfromsettingsgeneral =  get_bloginfo( 'url' );
    $domainparts = parse_url($siteurlfromsettingsgeneral);
    $domain = isset($domainparts['host']) ? $domainparts['host'] : '';
    if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
       $siteurlfromsettingsgeneral = strstr( $regs['domain'], '.', true );
    }
  // We changed this to check if it is a page instead of is_single() 
  // as it was displaying only on posts. Can check is_product() as well for woocommerce
  // products page only. Check rankya youtube comments.  
	if(is_product()){
        // Get singular which will allow to add the shortcode on WordPress Widget OR you could just use is_single
        $rankya_url = urlencode( get_permalink() );
        // get_the_title but add space %20
        $rankya_title = str_replace( ' ', '%20', get_the_title());
        // Core Web Vitals are important for shares
        $twitterURL = 'https://twitter.com/intent/tweet?text='.$rankya_title.'&amp;url='.$rankya_url.'&amp;via='.$siteurlfromsettingsgeneral.'';
        $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$rankya_url;
        $whatsappURL = 'whatsapp://send?text='.$rankya_title . ' ' . $rankya_url;
        $linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url='.$rankya_url.'&amp;title='.$rankya_title;
			  //if featured image set, use
			  if ( has_post_thumbnail() && is_single() ) {
						  $thumb_id = get_post_thumbnail_id();
						  $thumb_url = wp_get_attachment_image_src($thumb_id,'full', true); 
						  $pinterestNewURL = 'https://pinterest.com/pin/create/button/?url='.$rankya_url.'&amp;media='.$thumb_url[0].'&amp;description='.$rankya_title;
			  } else{
				  $pinterestNewURL = 'https://pinterest.com/pin/create/button/?url='.$rankya_url.'&amp;description='.$rankya_title;
				  }
       // Add sharing button anywhere
        $content = ''; 
        $content .= '<div class="social-share-div"><strong>Help others, share this content</strong><div class="share-buttons">';
        $content .= '<ul class="product-links">';
        $content .= '<li><a class="buttonlink share-button-profile-twitter" href="'. $twitterURL .'" target="_blank" rel="nofollow noopener">Twitter <i class="fa fa-twitter"></i></a></li>';
        $content .= '<li><a class="buttonlink share-button-profile-facebook" href="'.$facebookURL.'" target="_blank" rel="nofollow noopener">Facebook <i class="fa fa-facebook"></i></a></li>';
        $content .= '<li><a class="buttonlink share-button-profile-whatsapp" href="'.$whatsappURL.'" target="_blank" rel="nofollow noopener">WhatsApp <i class="fa fa-whatsapp"></i></a></li>';
        $content .= '<li><a class="buttonlink share-button-profile-pinterest" href="'.$pinterestNewURL.'" data-pin-custom="true" target="_blank" rel="nofollow noopener">Pin It <i class="fa fa-pinterest"></i></a></li>';
        $content .= '<li><a class="buttonlink share-button-profile-linkedin" href="'.$linkedInURL.'" target="_blank" rel="nofollow noopener">LinkedIn <i class="fa fa-linkedin"></i></a></li>';
        $content .= '</ul></div></div>';
	} //END if(is_singular()) check
        return $content;
}

add_shortcode('insertrankyasharebuttonshortcode', 'rankyasharebuttonshortcode');

/**
 * Change several of the breadcrumb defaults
 */
add_filter( 'woocommerce_breadcrumb_defaults', 'jk_woocommerce_breadcrumbs' );
function jk_woocommerce_breadcrumbs() {
    return array(
            'delimiter'   => ' ',
            'wrap_before' => '<ul class="breadcrumb-tree" itemprop="breadcrumb">',
            'wrap_after'  => '</ul>',
            'before'      => '<li>',
            'after'       => '</li>',
            'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
        );
}

/**
 * Rename "home" in breadcrumb
 */
add_filter( 'woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_home_text' );
function wcc_change_breadcrumb_home_text( $defaults ) {
    // Change the breadcrumb home text from 'Home' to 'Apartment'
	$defaults['home'] = 'Shop Home';
	return $defaults;
}

/**
 * Replace the home link URL
 */
add_filter( 'woocommerce_breadcrumb_home_url', 'woo_custom_breadrumb_home_url' );
function woo_custom_breadrumb_home_url() {
    return get_permalink(wc_get_page_id('shop'));
}
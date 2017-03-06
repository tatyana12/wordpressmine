<?php
/*
  Plugin Name: CS230W Native Ad
  Plugin URI: http://douglasputnam.com
  Description: Replace [cs230w_native_ad] with text.
  Version: 1.0
  Author: DVP
  Author URI: http://douglasputnam.com
*/

// Register a new shortcode for the Native Ad plugin
add_shortcode('cs230w_native_ad', 'cs230w_native_ad');

/**
 * This function creates a link to a random raven image by reading the 
 * file names in the images directory. It's just for fun.
 */
function cs230w_random_image_url() {
    $images_path = plugin_dir_path(__FILE__) . "images";
    $image_url = plugins_url('images', __FILE__);
    $images = scandir(plugin_dir_path(__FILE__) . "images");
    $images = scandir($images_path);
    array_shift($images);
    array_shift($images);
    $image = $images[array_rand($images, 1)];
    return "<figure class='random-raven'><img src='/wp-content/plugins/cs230w-native-ads/images/$image' "
            . "alt='Raven image: $image'>"
            . "<figcaption>Enjoy the random raven. :)</figcaption>"
            . "</figure>" ;
}


/**
 * The callback function that will replace [cs230w_native_ad]
 * @params $attr is an associative array passed into the function by the shortcode.
           $content is passed to the function by the WordPress API automatically.
 * @usage   [cs230w_sponspored_ad title="sometitle" sponsor="Regal Ale Pale" isbn="abc123"] the content [/cs230w_native_ad] will appear in $attr.
 * @return A string 
 */
function cs230w_native_ad($attr, $content) {
    
    wp_enqueue_style( 'cs230w_ads_css', plugins_url('css/ads.css', __FILE__ ) );
    include ( plugin_dir_path(__FILE__) . "includes/ads.php" );
    
    // Get title, sponsor, and content if possible; otherwise show
    // a default value;
    if ( isset( $attr['sponsor'] ) &&  !empty($attr['sponsor'])) {
        $sponsor = esc_html__($attr['sponsor']);
        
        if (isset ($attr['title'])) {
            $title = "<h3>" . esc_html__($attr['title']) . "</h3>";
        }
        else {
            $title = 'Message: ';
        }

    } else {
        $title = "<h1>Your Add Here</h1><p>This space is hire.</p>";
        $content = '<p>Imagine your special message here winning the hearts and minds of millions.  Contact me at...</p>';
    }
    
    return "
<div class='sponsored-message'>
<header>$title </header>
    $content
        <p style='color: $color_of_text'> The variable \$color_of_text is \"$color_of_text\". 
            This variable is defined in <code>cs230w-ntaive-ads/includes/ads.php</code>.</p> <p>
            The CSS for this plugin is contained in the file <code>cs230w-sponsored-ads/css/ads.css</code>. 
            We can use the color for inline CSS.</p>
        " . cs230w_random_image_url() . " <p>"
            . "<p style='font-size: 12px; text-align:center;'>This ad was sponsored by $sponsor.</p>"
            . "<p style='font-size: 12px; text-align:center;color:blue;' >The CS230W Native Ads "
            . "Plugin copyright &copy; 2017</small></p></div>" ;
}

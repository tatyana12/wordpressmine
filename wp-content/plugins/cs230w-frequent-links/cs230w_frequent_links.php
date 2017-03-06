<?php
/*
Plugin Name: CS230W Frequent Links
Plugin URI: http://yourdomain.com/plugins/cs230w_frequent_links
Description: Shortcode plugin that displays frequently used links.
Version: 1.0
Author: Your Name
Author URI: http://yourdomain.com
*/

add_shortcode('cs230w_textbook', 'cs230w_textbook');

add_shortcode('cs230w_echo_me', 'cs230w_echo_me');
/**
 * Return the link to the class textbook.
 */
function cs230w_textbook() {
    return "<a href='http://www.amazon.com/Professional-WordPress-Development-Brad-Williams/dp/1118987241/ref=sr_1_1?ie=UTF8&qid=1448074464&sr=8-1&keywords=professional+wordpress'>Professional WordPress: Design and Development</a>";
}
// Notice that there's no closing PHP tag. Why not?





/**
 * cs230w_echo me will print the attributes of the shortcode and the content contained between the shortcode's open and close tags.
 * The attributes will be returned as a table.
 */
function cs230w_echo_me($attr, $content) {
    $out = '';
    foreach( $attr as $key => $val) {
        $out .= "<tr><td>$key</td><td>$val</td></tr>";
    }
    return "<div class=\"cs230w-echo-me\"><h3>$content</h3><table>$out</table></div>";
}

<?php

/*
  Plugin Name: CounterPost
  Plugin URI: http://www.abcdefg.net
  Description: Plugin that increses the counter by one every time end user hit the counter button.
  Author: Omer Kalim
  Version: 1.0
  Author URI: http://www.omerkalim.com
 */

function counter_increment() {
    $post_id = isset($_POST['post_id']) ? $_POST['post_id'] : 0;
    $hit_count = get_post_meta($post_id, 'hit_count', TRUE);
    $new_hit_count = $hit_count + 1;
    $result = update_post_meta($post_id, 'hit_count', $new_hit_count);

    echo $new_hit_count;
    exit();
    // wp_send_json_success($return);
}

add_action('wp_ajax_counter_increment', 'counter_increment');
add_action('wp_ajax_nopriv_counter_increment', 'counter_increment');

function counterpost_admin() {
    include('counterpost_admin.php');
}

function counterpost_admin_actions() {
    add_options_page("CounterPost", "CounterPost", 1, "CounterPost", "counterpost_admin");
}

add_action('admin_menu', 'counterpost_admin_actions');

function ap_action_init(){
    // Localization
//    error_log(dirname( plugin_basename( __FILE__ ) ));
    load_plugin_textdomain('counter_post', false, dirname( plugin_basename( __FILE__ ) ));
}

// Add actions
add_action('init', 'ap_action_init');


function click_counter_display($content) {
    $id = get_the_ID();
    $counter_variable = get_post_meta($id, 'hit_count', TRUE);
    $new_content = '';
    $new_content .= '<input type="button" value="' . __('Hit to Increment', 'counter_post') . '" class="submit_button"  id="' . $id . '">';
    $new_content .= '<span id="hit_count" style="font-size: 50px; color: green;">' . $counter_variable . '</span>';
    $content = $content . $new_content;

    return $content;
}
add_filter('the_content', 'click_counter_display');


//for posts 
//add_filter( 'single_template', 'My_custom_page_template' );
//function My_custom_page_template( $single_template )
//{
////    if ( is_single( 'my-custom-page-slug' ) ) {
////        $single_template = dirname( plugin_basename( __FILE__ ) ) . '/custom-post-template.php';
//        $single_template = plugin_dir_path( __FILE__ ) . '/custom-post-template.php';
//        error_log("SINGLE: " . $single_template);
////    }
//    return $single_template;
//}

//function fwds_slider_activation() {
//}
//register_activation_hook(__FILE__, 'fwds_slider_activation');
//function fwds_slider_deactivation() {
//}
//register_deactivation_hook(__FILE__, 'fwds_slider_deactivation');
?>
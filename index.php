<?php
/*
  Plugin Name: Vatnumber
  Description:Vatnumber
  Version: 1.0
  Author: David Poghosyan
  Author URI: #
  Plugin URI: #
 */
add_action('admin_menu', 'vatnumber_options_panel');

function vatnumber_options_panel() {
    add_menu_page('Vutnumber', 'Vutnumber', 'manage_options', 'Vutnumber', 'vutnumber_func', plugins_url('images/vat.png', __FILE__));
}

function vutnumber_scripts()
{
    wp_enqueue_script('vutnumber1', plugins_url('public/js/vatnumber-jquery-3.2.1.js', __FILE__));
    wp_enqueue_script('vutnumber', plugins_url('public/js/vutnumber.js', __FILE__));
    wp_enqueue_style('vutnumber2', plugins_url('public/css/vutnumber.css', __FILE__));
    wp_localize_script('vutnumber', 'myVutnumber', array(
    'pluginsUrl' => plugins_url(),
    ));
    
}
add_action( 'wp_enqueue_scripts', 'vutnumber_scripts' );

function vutnumber_func(){
?>
<div class="wrap">
    <h1>Vatnumber</h1>
    <div id="welcome-panel" class="welcome-panel" style="padding-bottom: 40px;">   
     <h2>Usage</h2>
     <p class="about-description">Lorem Ipsum:Sample text</p>
        <table class="widefat" style="width: 100%">
            <tbody>
                <tr>
                    <td class="highlight">Shortcode</td>
                </tr>
                <tr>
                    <td>[vutnumber]</td>
                </tr>
                <tr>
                    <td class="highlight">Template Include</td>
                </tr>
                <tr>
                    <td>echo do_shortcode('[vutnumber]');</pre></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php
}

function vutnumber() {
?>
    <input type="vatnumber" class="text-input" id="vatnumber" name="vatnumber" required="">
    <div id="vatnumber-result"></div>     
<?php
 }
add_shortcode('vutnumber', 'vutnumber');


// Hooks near the bottom of profile page (if current user) 
add_action('edit_user_profile', 'custom_user_profile_fields');
add_action('show_user_profile', 'custom_user_profile_fields');

// @param WP_User $user
function custom_user_profile_fields(  ) {
  $current_user = wp_get_current_user();
  $meta_key = 'vatnumber';
  global $wpdb;
  $results = $wpdb->get_results( "SELECT * FROM wp_usermeta WHERE user_id = $current_user->ID AND meta_key='vatnumber'");

  echo ("<h2>VAT Number - ".$results[0]->meta_value."</h2>");
?>
  
<?php
}
?>

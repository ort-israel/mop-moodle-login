<?php
/*
Plugin Name: Mop Moodle Login
Description: This plugin inserts a moodle 2.9 login block into a post via shortcode
Version:     0.1
Author:      Tsofiya Izchak - ORT Israel
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: mop-moodle-login
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function mop_moodle_login_style() {
    wp_register_style( 'mop-moodle-login-css', plugins_url( 'style.css', __FILE__ ) );
    wp_enqueue_style( 'mop-moodle-login-css' );
}
add_action( 'wp_enqueue_scripts', 'mop_moodle_login_style' );

function mop_moodle_login_load_textdomain() {
    load_plugin_textdomain( 'mop-moodle-login', false, plugin_basename( dirname( __FILE__ ) ) . '/lang' );
}
add_action( 'plugins_loaded', 'mop_moodle_login_load_textdomain' );

function mop_add_moodle_login($atts){
    $a = shortcode_atts( array(
        'id' => '518',
    ), $atts );
    return '
    <div id="login_panel"  dir="rtl">
      <p tabindex="0" > תוכלו לבחון ידיעותיכם בנושאי התכנית שלמדתם. הכנסו למודל</p>
            <form id="login_form" action="http://schoolnet.moodle.ort.org.il/ort/courselogin.php?courseid='.$a['id'].'" method="post" >
                <div class="username_box row">
                    <label for="username" id="username_lbl">'.__( 'username', 'mop-moodle-login' ).'</label>
                    <input type="text" name="username" id="username" size="40">
                </div>
                <div class="pass_box row">
                    <label for="password" id="password_lbl">'.__( 'password', 'mop-moodle-login' ).'</label>
                    <input type="password" name="password" id="password" size="40">
                </div>
                <div class="submit_btn row">
                    <input id="submit_btn" type="submit" value="'.__( 'login', 'mop-moodle-login' ).'" >
                </div>
            </form>

    </div>
    ';
} add_shortcode('moodle_login','mop_add_moodle_login');
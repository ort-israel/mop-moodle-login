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
defined('ABSPATH') or die('No script kiddies please!');

class MopMoodleLogin {

    public function init() {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_style'));
        add_action('plugins_loaded', array($this, 'load_textdomain'));
        add_shortcode('moodle_login', array($this, 'moodle_login_shortcode'));
    }

    function enqueue_style() {
        wp_register_style('mop-moodle-login-css', plugins_url('style.css', __FILE__));
        wp_enqueue_style('mop-moodle-login-css');
    }

    function load_textdomain() {
        load_plugin_textdomain('mop-moodle-login', false, dirname(plugin_basename(__FILE__)) . '/lang');
    }


    function moodle_login_shortcode($atts) {
        $a = shortcode_atts(array(
            'id' => '518',
        ), $atts);
        return '
    <div id="login_panel"  dir="rtl">
      <p tabindex="0" >' . __('Test yourself on what you\'ve learned. Log into Moodle', 'mop-moodle-login') . ' </p>
            <form id="login_form" action="https://campus.ort.org.il/ort/anonymous_user_login.php?courseid=' . $a['id'] . '" method="post" >
                <div class="username_box row">
                    <label for="username" id="username_lbl">' . __('username', 'mop-moodle-login') . '</label>
                    <input type="text" name="username" id="username" size="40">
                </div>
                <div class="pass_box row">
                    <label for="password" id="password_lbl">' . __('password', 'mop-moodle-login') . '</label>
                    <input type="password" name="password" id="password" size="40">
                </div>
                <div class="submit_btn row">
                    <input id="submit_btn" type="submit" value="' . __('login', 'mop-moodle-login') . '" >
                </div>
            </form>

        </div>
        <div id="guest_panel" class="guest_panel">
            <h2 class="guest_panel_title">' . __('guest', 'mop-moodle-login') . ' </h2>
            <span id="guestNotification">' . __('The system doesn\'t save guest users\'s grades', 'mop-moodle-login') . '</span>
            <div class="submit_btn">
                <a id="guestButton" class="guest_button"
                   href="http://campus.ort.org.il/blocks/anonymous_user/generateuser.php?courseid=' . $a['id'] . '">' . __('connect as guest', 'mop-moodle-login') . '</a>
            </div>
        </div>
    ';
    }
}

$mopMoodleLogin = new MopMoodleLogin();
$mopMoodleLogin->init();

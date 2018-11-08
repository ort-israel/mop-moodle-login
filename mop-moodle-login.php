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

function mop_moodle_login_style() {
    wp_register_style('mop-moodle-login-css', plugins_url('mop-moodle-login-style.css', __FILE__), array(), 2.7);
    wp_enqueue_style('mop-moodle-login-css');
}

add_action('wp_enqueue_scripts', 'mop_moodle_login_style');

function mop_moodle_login_load_textdomain() {
    load_plugin_textdomain('mop-moodle-login', false, plugin_basename(dirname(__FILE__)) . '/lang');
}

add_action('plugins_loaded', 'mop_moodle_login_load_textdomain');

function mop_add_moodle_login($atts) {
    $a = shortcode_atts(array(
        'course_id' => '142',
        'moodle_url' => 'https://campus.ort.org.il'
    ), $atts);
    ?>
    <div class="login_widget">
        <div id="login_panel" class="login_panel">
            <form id="login_form"
                  action=" <?php echo $a['moodle_url'] ?> /course/view.php?id= <?php echo $a['course_id'] ?> "
                  method="post" id="login_form">
                <div class="username_box">
                    <label for="username" id="username_lbl"> <?php _e('username', 'mop-moodle-login') ?> </label>
                    <input type="text" name="username" id="username">
                </div>
                <div class="pass_box">
                    <label for="password" id="password_lbl"><?php _e('password', 'mop-moodle-login') ?></label>
                    <input type="password" name="password" id="password">
                </div>
                <div class="submit_btn">
                    <input id="submit_btn" type="submit" value="<?php _e('login', 'mop-moodle-login') ?>">
                </div>
            </form>

        </div>
        <div id="guest_panel" class="guest_panel">
            <h2 class="guest_panel_title"><?php _e('guest', 'mop-moodle-login') ?> </h2>
            <span id="guestNotification"><?php _e('The system doesn\'t save guest users\'s grades', 'mop-moodle-login') ?></span>
            <div class="submit_btn">
                <a id="guestButton" class="guest_button"
                   href="http://schoolnet.moodle.ort.org.il/tools/anonymous/generateuser.php?courseid=<?php echo $a['course_id'] ?>"><?php _e('connect as guest', 'mop-moodle-login') ?></a>
            </div>
        </div>
    </div>
    <?php
}

add_shortcode('moodle_login', 'mop_add_moodle_login');
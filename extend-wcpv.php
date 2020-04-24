<?php
/**
 * Plugin Name:       Extend WCPV
 * Plugin URI:        http://themes.tradesouthwest.com/wordpress/plugins/
 * Description:       Add custom fields to Woocommerce Product Vendors registration form.
 * Author:            tradesouthwestgmailcom
 * Author URI:        https://tradesouthwest.com
 * Version:           1.0.1
 * License:           GPLv2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.html
 * Requires at least: 4.5
 * Tested up to:      5.3.1
 * Requires PHP:      5.4
 * Text Domain:       extend-wcpv
 * Domain Path:       /languages
*/

// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) {	exit; }
/** 
 * Constants
 * 
 * @param EXTEND_WCPV_VER         Using bumped ver.
 * @param EXTEND_WCPV_URL         Base path
 * @since 1.0.0 
 */
if( !defined( 'EXTEND_WCPV_VER' )) { define( 'EXTEND_WCPV_VER', '1.0.0' ); }
if( !defined( 'EXTEND_WCPV_URL' )) { define( 'EXTEND_WCPV_URL', 
    plugin_dir_url(__FILE__)); }

    // Start the plugin when it is loaded.
    register_activation_hook(   __FILE__, 'extend_wcpv_plugin_activation' );
    register_deactivation_hook( __FILE__, 'extend_wcpv_plugin_deactivation' );
  
/**
 * Activate/deactivate hooks
 * 
 */
function extend_wcpv_plugin_activation() 
{

    return false;
}
function extend_wcpv_plugin_deactivation() 
{
    return false;
}
/**
 * Define the locale for this plugin for internationalization.
 * Set the domain and register the hook with WordPress.
 *
 * @uses slug `swedest`
 */
add_action( 'plugins_loaded', 'extend_wcpv_load_plugin_textdomain' );

function extend_wcpv_load_plugin_textdomain() 
{

    $plugin_dir = basename( dirname(__FILE__) ) .'/languages';
                  load_plugin_textdomain( 'extend-wcpv', false, $plugin_dir );
}

/** 
 * Admin side specific
 *
 * Enqueue admin only scripts 
 */ 
add_action( 'admin_enqueue_scripts', 'extend_wcpv_load_admin_scripts' );   
function extend_wcpv_load_admin_scripts() 
{
    /*
     * Enqueue styles */
    wp_enqueue_style( 'extend-wcpv-admin', 
                        EXTEND_WCPV_URL . 'css/extend-wcpv-admin.css', 
                        array(), EXTEND_WCPV_VER, false 
                        );
}

require_once ( plugin_dir_path(__FILE__) . 'inc/extend-wcpv-registration-fields.php' );
?>
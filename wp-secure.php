<?php
/*
Plugin Name: wp secure
Plugin URI: www.sitesecuritymonitor.com
Description: wp secure
Author: jremillard 
Version: 1.2

Author URI:
*/
$m_wpse_db = get_option("wpse_db");
if (empty($m_wpse_db) || ($m_wpse_db != '0.01'))
{
	wpse_db();
	update_option("wpse_db","0.01");
}

function wpse_db()
{
	require_once(ABSPATH . 'wp-admin/upgrade-functions.php');
	global $table_prefix, $wpdb,$wp_version,$wp_rewrite;

	$table_name = $table_prefix . "wpselog";
	if ($wpdb->get_var("SHOW TABLES LIKE '{$table_name}'") !== $table_name)
	{
		$sql = "CREATE TABLE " . $table_name . " (
			id INT(11) NOT NULL auto_increment,
			errorreason varchar(255) ,
			status varchar(255) ,
			errordate datetime NOT NULL default '0000-00-00 00:00:00',
			valid varchar(255)  NOT NULL DEFAULT 'YES' ,
	  		PRIMARY KEY  (`id`)
		) TYPE=MyISAM;";
	}
	dbDelta($sql);
}

require_once('wpSecureFunctions.php');

function wpSecureMenu()
{
	add_menu_page(__('WP Secure by SSM','WPSecure'), __('WP Secure by SSM','WPSecure'), 10, 'wpSecureFunctions.php','aboutWpSecure');
	add_submenu_page('wpSecureFunctions.php',__('Status','WPSecure'), __('Status','WPSecure'),10, 'wpSecureFunctions.php','aboutWpSecure');
	add_submenu_page('wpSecureFunctions.php',__('Process','WPSecure'), __('Process','WPSecure'),10, basename(dirname(__FILE__)).'/securetools.php');
	add_submenu_page('wpSecureFunctions.php', __('Security Log','WPSecure'), __('Security Log','WPSecure'), 10 , basename(dirname(__FILE__)).'/secureoptions.php');
}


add_action('init','wpseInitActionFrontEnd',1);
add_action('admin_init','wpseInitActionBackEnd',1);
add_action('admin_menu', 'wpSecureMenu');
add_action('admin_head','wpSecureAdminHead');
?>

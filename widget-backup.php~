<?php
/**
 * Plugin Name:	widget-backup
 * Plugin URI: 	http://URI_Of_Page_Describing_Plugin_and_Updates
 * Description: Plugin to backup widget data in Wordpress. Activating the plugin will give Widget Backup option in settings page, click on it and click on widgets restore button to restore widgets
 * Version:  	1.0.0
 * Author: 	Sukeshni Kantrod
 * Author URI: 	http://URI_Of_The_Plugin_Author
 * License: 	A short license name. Example: GPL2
 */

include_once 'set-widget-data-call.php';

//On plugin activation schedule our daily database backup 
register_activation_hook( __FILE__, 'wi_create_daily_backup_schedule' );
function wi_create_daily_backup_schedule(){
    //Schedule the event for right now, then to repeat daily using the hook 'wi_create_daily_backup'
    wp_schedule_event( time(), 'twicedaily', 'wi_create_daily_backup' );
}
//Hook our function , wi_create_backup(), into the action wi_create_daily_backup
add_action( 'wi_create_daily_backup', 'widget_backup' );

function widget_backup(){    
    global $wpdb;
    $widget_file_name = ABSPATH."/wp-content/plugins/widget-backup/widget-file.csv";
    $fp = fopen($widget_file_name, 'w+') or die("Unable to open file in write mode");
    
    //Query to select widget data from wp_options table
    $result = $wpdb->get_results('select * from wp_options WHERE option_name LIKE "%widget%"',ARRAY_A);
    if ($result > 0) {
        foreach($result as $row){
              fputcsv($fp, $row);
        }
    }
    fclose($fp);
}
?>

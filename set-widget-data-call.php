<?php

add_action('admin_menu', 'add_widget_menu');
function add_widget_menu(){
    // Add the top-level menu
    add_menu_page('Widget Backup','Widget Backup', 'manage_options', 'widget-backup', 'call_set_widget_data_for');
}

//Set func=set_widget_data_for to call function from file set-widget-data.php
function call_set_widget_data_for(){?>
	<div>
		<button id = "widget_backup1">Widget Restore</button>
		<script>
			jQuery('#widget_backup1').click(function() { 
                            jQuery.get( "../wp-content/plugins/widget-backup/set-widget-data.php?func=set_widget_data_for", function( data ) {
                                alert( "Data Loaded: " + data );
                            }); 
			});
		</script>
	</div>
<?php
}



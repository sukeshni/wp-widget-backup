<?php
include_once '../../../wp-config.php';

function set_widget_data_for(){
    $widget_file_name = ABSPATH."/wp-content/plugins/widget-backup/widget-file.csv";
    $fp = fopen('widget-file.csv', 'r') or die("Unable to open file in write mode");
    global $wpdb;
    
    //Read .csv file row-wise and check for the same in database in wp-options table
    while (($data = fgetcsv($fp, 1000, ",")) !== FALSE){
        $sql = "SELECT  
                    option_id 
                FROM
                    wp_options 
                WHERE   
                    option_id     =   '$data[0]'";
    
        $selectquery = $wpdb->query($sql);
        
        //Check whether to insert or update
        if($selectquery == 0){
            $wpdb->insert('wp_options',
                        array('option_id'    => $data[0],
                              'option_name'  => $data[1],
                              'option_value' => $data[2],
                              'autoload'     => $data[3]));
        }
        else{
            $wpdb->update('wp_options',
                        array('option_name'  => $data[1],
                              'option_value' => $data[2], 
                              'autoload'     => $data[3]),       
                        array('option_id'    => $data[0]));
        }
    }
    echo 'Backup Complete';
    fclose($fp);
}

//check if the func variable is set or not 
if(isset($_GET['func']) && !empty($_GET['func'])) {
    set_widget_data_for();
}
?>




<?php
    require '/opt/lampp/htdocs/car-rental-system/common-functions.php';

    $labels = array('a', 'b');
    $label_for_vals = array('val 1', 'val 2');
    $names_and_ids = array('c', 'd');
    $title = 'title';
    $action_page = 'test-action-page.php';
    
    getData($labels, $label_for_vals, $names_and_ids, $title, $action_page);
?>
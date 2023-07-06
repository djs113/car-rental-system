<?php
    require '/opt/lampp/htdocs/car-rental-system/common-functions.php';

    $labels = array('a', 'b');
    $label_for_vals = array('val 1', 'val 2');
    $names_and_ids = array('c', 'd');
    $title = 'Test Form';
    $action_page = 'test-action-page.php';
    $submit_val = 'submit';

    getData($labels, $label_for_vals, $names_and_ids, $title, $action_page, $submit_val);
?>
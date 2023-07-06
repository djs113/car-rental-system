<?php
    require '/opt/lampp/htdocs/car-rental-system/common-functions.php';

    $labels = array('a', 'b');
    $label_for_vals = array('val 1', 'val 2');
    $names_and_ids = array('c', 'd');
    $action_page = 'test-action-page.php';
    $submit_val = 'submit';

    echo '
        <html>
            <head>
                <title>Test Form</title>
            </head>
        
            <body>
                <h2>Test Form</h2>
                '.generateForm($labels, $label_for_vals, $names_and_ids, $action_page, $submit_val).'
            </body>
        </html>
    ';
    // generateForm($labels, $label_for_vals, $names_and_ids, $action_page, $submit_val);
?>
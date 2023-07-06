<?php
    function dbConnection() {
        $conn = mysqli_connect('localhost', 'root', '', 'car_rental_system');

        if ($conn->connect_error)
            die("Connection failed<br>Connection Error: ".$conn->connect_error);
        
        return $conn;
    }

    function getData($labels, $label_for_vals, $names_and_ids, $title, $action_page, $submit_val) {
        echo '
            <html>
                <head>
                    <title>
                        '.$title.'
                    </title>
                </head>
                <body>
                    <h2?><u>'.$title.'</u></h2>
                    <form action="'.$action_page.'" method="POST">
        ';

        $arr_length = count($labels);

        for ($i = 0; $i < $arr_length; $i++)
        {
            echo '
                        <label for="'.$label_for_vals[$i].'">'.$labels[$i].': </label><input type="text" name="'.$names_and_ids[$i].'" id="'.$names_and_ids[$i].'" />
                        <br><br>
            ';
        }

        echo '
                        <input type="submit" value="'.$submit_val.'" />
                    </form>
                </body>
            </html>
        ';
    }
?>
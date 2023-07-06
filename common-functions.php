<?php
    function dbConnection() {
        $conn = mysqli_connect('localhost', 'root', '', 'car_rental_system');

        if ($conn->connect_error)
            die("Connection failed<br>Connection Error: ".$conn->connect_error);
        
        return $conn;
    }

    function generateForm($labels, $label_for_vals, $names_and_ids, $action_page, $button_val) {
        echo '
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
                <input type="submit" value="'.$button_val.'" />
            </form>
        ';
    }
?>
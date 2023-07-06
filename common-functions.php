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

    function displayData($table, $title, $headings) {
        $conn = dbConnection();

        $qry = "SELECT * FROM $table";

        $res_array = mysqli_query($conn, $qry);

        echo '
            <html>
                <head>
                    <title>
                        '.$title.'       
                    </title>
                </head>
                <h2><u>'.$title.'</u></h2> 
                <body>
                    <table cellspacing="3" cellpadding="3" border="1">
                        <tr> 
        ';

        $heading_length = count($headings);

        for ($i = 0; $i < $heading_length; $i++)
        {
            echo '
                            <th>'.$headings[$i].'</th>
            ';
        }

        echo '
                        </tr>
        ';

        $col_length = mysqli_num_fields($res_array);
        
        while ($res = mysqli_fetch_array($res_array))
        {
            echo '
                        <tr>
            ';
        
            for ($j = 0; $j < $col_length; $j++)
            { 
                echo '
                            <td>'.$res[$j].'</td>
                ';
            }

            echo '        
                        </tr>
            ';
        }

    echo '
                    </table>
                </body>
            </html>
    ';
    }
?>
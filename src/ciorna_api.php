<?php

    $srv = "79.112.132.180";
    $username = "root";
    $pass = "root";
    $db = "plantInfo";

########################################################################################################################################################################################################################

    $conn = new mysqli($srv, $username, $pass, $db);

    if($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    }

########################################################################################################################################################################################################################
    
    $isPostPHP = True;


    $selectQuery = "SELECT * FROM plants";
    $result = $conn->query($selectQuery);
    
    global $dict;
    global $dictArray;
    $dictArray = array();

    if($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
        {
            /*$dict["minTemp"] = doubleval($row["minTemp"]);
            $dict["maxTemp"] = doubleval($row["maxTemp"]);
            $dict["minHumidity"] = doubleval($row["minHumidity"]);
            $dict["maxHumidity"] = doubleval($row["maxHumidity"]);
            $dict["optimalTemp"] = doubleval($row["optimalTemp"]);
            $dict["optimalHumidity"] = doubleval($row["optimalHumidity"]);*/

            $dictArray[$row["plantType"]]["minTemp"] = doubleval($row["minTemp"]);
            $dictArray[$row["plantType"]]["maxTemp"] = doubleval($row["maxTemp"]);
            $dictArray[$row["plantType"]]["minHumidity"] = doubleval($row["minHumidity"]);
            $dictArray[$row["plantType"]]["maxHumidity"] = doubleval($row["maxHumidity"]);
            $dictArray[$row["plantType"]]["optimalTemp"] = doubleval($row["optimalTemp"]);
            $dictArray[$row["plantType"]]["optimalHumidity"] = doubleval($row["optimalHumidity"]);

            /*$dict[0] = $row["minTemp"];
            $dict[1] = $row["maxTemp"];
            $dict[2] = $row["minHumidity"];
            $dict[3] = $row["maxHumidity"];
            $dict[4] = $row["optimalTemp"];
            $dict[5] = $row["optimalHumidity"];*/
        }
    }
        
    else
    {
        echo "FATAL ERROR: 0 results!";
    }


    $file = fopen("testfile.csv", "w");
    foreach ($dictArray as $fields) 
    {
        $string = "";
        $string .= "<b>Temperatura Minima: </b>" . strval($fields["minTemp"] . ", Temperatura Maxima: " . strval($fields["maxTemp"]));
        $data = explode(", ", $string);
        echo $data[0];
        fputcsv($file, $data);
    }

    fclose($file);
    echo "Hehe boi";

########################################################################################################################################################################################################################

?>
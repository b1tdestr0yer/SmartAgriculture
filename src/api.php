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

########################################################################################################################################################################################################################

?>

<html>
<head>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>

<body>
    <form action="api.php" method="POST">
        <input name="latitude" type="text" placeholder="Latitude" required>
        <br>
        <input name="longitude" type="text" placeholder="Longitude" required>
        <br>
        <input type="submit" value="Submit">
    </form>
    <script>
        var lat = <?php echo json_encode($_POST['latitude'] ?? 47.63333) ?>;
        var long = <?php echo json_encode($_POST['longitude'] ?? 26.25) ?>;
        var dictionary = <?php echo json_encode($dictArray); ?>;
        var isPost = <?php echo $isPostPHP; ?>;
    </script>
    <script src="/js/api.js"></script>
</body>
</html>
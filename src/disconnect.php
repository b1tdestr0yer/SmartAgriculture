<?php

    if (isset($_COOKIE['userID'])) 
    {
        // Cookie removal. Nu mancam biscuitei, suntem la regim.
        unset($_COOKIE['userID']); 
        setcookie('userID', null, -1, '/'); 
    } 
    else 
    {
        echo "<script>window.location.replace('login.php');</script>";
    }

?>

<html>

    <style>
        body 
        {
            background-image: url('images/signup2.jpg');
        }
    </style>

    <body onload="window.location.replace('login.php')">

    </body>

</html>
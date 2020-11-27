<?php

    $srv = "79.112.132.180";
    $username = "root";
    $pass = "root";
    $db = "users";

########################################################################################################################################################################################################################

    $conn = new mysqli($srv, $username, $pass, $db);

    if($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    }

########################################################################################################################################################################################################################

    global $errorMsg;

    if(isset($_POST['username']) and isset($_POST['password']))
    {
        $passwordQ = hash('sha256', $_POST['password']);
        $selectQuery = "SELECT id, username, password FROM userData WHERE (username='" . $_POST['username'] . "' AND password='" . $passwordQ . "');";

        global $globalResult;

        $result = $conn->query($selectQuery);
        $globalResult = $result;

        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $cookie_value = $row["id"];

                if(!isset($_COOKIE['userID']))
                {
                        
                    setcookie("userID", $cookie_value,  mktime(). time() + 30 * 60, '/', '79.112.132.180', false, true);
                }
            }
        }
        
        else
        {
            $errorMsg = "Nu există utilizatori cu acest nume/parolă.";
        }
    }

########################################################################################################################################################################################################################

function isErrorMessage($msg)
{
    if($msg == "")
    {
        return False;
    }
    
    else
    {
        return True;
    }
}


function printErrorMessage($msg)
{
    return $msg;
} 

########################################################################################################################################################################################################################

?>




<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/loading.css">
    <link rel="shortcut icon" href="img/logoico.png">
    <script src="js/pixi.min.js"></script>
    <script src="https://code.jquery.com/pep/0.4.3/pep.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
    <title>Log in</title>
</head>
<style>
   body{
       margin:0;
       padding: 0;
       background-image: url('img/signup2.jpg');
       background-size:cover;
   }
   #form input[type=text], #form input[type=password]{
        border:none;
        border-bottom: 1px solid white;
        margin-bottom: 2rem;
        background-color: transparent;
        outline: none;
        color: white;
        display: 16px;
    }
    .form-control:focus {
        border-color: none;
        -webkit-box-shadow: none;
        box-shadow: none;
    }
    ::placeholder{
        color:white;
    }
    @media only screen and (min-width : 721px) {
        #container{
            transform: translate(50%,45%);
        }
    }
    @media only screen and (max-width : 720px) {
        #container{
            transform: translate(50%,20%);
        }
    }
    .errorpopup{
        margin: 1rem;
        width: 90%;
        height: auto;
        background-color:rgba(0,0,0,0.5);
        z-index: -2;
    }

    .errorpopup p{
        color: red;
        font-size: 1rem;
        padding: 0.5rem;
        z-index: -2;
    } 
</style>
<body>
<!-- Loading -->

<?php
    if(!isErrorMessage($errorMsg)) 
    {
        echo'
        <div class="loading">
                <div class="bar">
                    <i class="sphere"></i>
                </div>
            </div>';
    }
    ?>

<?php
    if($globalResult->num_rows != 0 or isset($_COOKIE["userID"]))
    {
        echo "<script>window.location.replace('index.php'); </script>";
    }
?>
<!-- end loading page -->


<!-- start main -->

<section class="container-fluid" id="container">
    <form action="login.php" method="post" class="form-container text-white" style="background-color:rgba(0,0,0,0.5); padding:30px; box-shadow: 0px 0px 10px 0px;width:25rem; border-radius: 10px; transform: translate(-53%,0%);">
        <h4 class="text-center">Autentificare</h4>
        <div class="form-group" id="form">
            <label for="username">Nume de utilizator: </label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Ex.: Ion123" required>
            <label for="password">Parolă:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="a-z A-Z 0-9" required>
        <div>Nu dețineți un cont de utilizator? <a class="text-success" href="signup.php">Înregistrați-vă.</a></div>
        <?php 
    if(isErrorMessage($errorMsg))
    {
        echo '<div class="errorpopup">
    <p>' . printErrorMessage($errorMsg) . '</p>
</div>';
    }
?> 
        <button type="submit" class="btn text-white btn-block btn-success mt-4" style="border:1px solid gray;border-radius: 15px; box-shadow: 1px 1px 1px 0px rgba(0,0,0,0.75);">Autentificare</button>
    </form>
</section>
<!-- end main -->

<!-- bootstrap scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
<!-- end bootstrap script -->
</body>
</html>
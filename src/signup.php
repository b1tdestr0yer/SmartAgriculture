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

    $selectQuery = "SELECT MAX(id) AS id FROM userData LIMIT 1";

    $result = $conn->query($selectQuery);
    
    if($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
        {
            $lastID = $row["id"];
        }
    }
        
    else
    {
        echo "0 results!";
    }

########################################################################################################################################################################################################################
    
    function passValidation($str)
    {
        $len = strlen($str);

        for($i = 0; $i <= $len - 1; $i++)
        {
            if(!($str[$i] >= 'a' and $str[$i] <= 'z') and !($str[$i] >= 'A' and $str[$i] <= 'Z') and !($str[$i] >= '0' and $str[$i] <= '9'))
            {
                return False;
            }
        }

        return True;
    }

    function passLengthValidation($str)
    {
        $len = strlen($str);
        if($len < 3)
        {
            return False;
        }
        else
        {
            return True;
        }
    }

    function nameValidation($str)
    {
        $len = strlen($str);

        for($i = 0; $i <= $len - 1; $i++)
        {
            if(!($str[$i] >= 'a' and $str[$i] <= 'z') and !($str[$i] >= 'A' and $str[$i] <= 'Z') and $str[$i] != '-')
            {
                return False;
            }
        }

        return True;
    }

    function usernameValidation($str)
    {
        $len = strlen($str);

        for($i = 0; $i <= $len - 1; $i++)
        {
            if($str[$i] == ' ')
            {
                return False;
            }
        }

        return True;
    }

########################################################################################################################################################################################################################

    global $errorMsg;
    $errorMsg = "";

    if(isset($_POST['firstname']) and isset($_POST['lastname']) and isset($_POST['username']) and isset($_POST['password']))
    {
        if(!passValidation($_POST['password']))
        {
            $errorMsg = "Parola conține caractere invalide! Aceasta trebuie să conțină doar litere mari, litere mici sau cifre.";
        }

        else if(!passLengthValidation($_POST['password']))
        {
            $errorMsg = "Parola introdusă este prea scurtă Aceasta trebuie să fie formată din cel puțin 3 caractere.";
        }

        else if(!nameValidation($_POST['firstname']))
        {
            $errorMsg = "Prenumele conține caractere invalide! Acesta trebuie să conțină doar litere mari, litere mici sau cratime.";
        }

        else if(!nameValidation($_POST['lastname']))
        {
            $errorMsg = "Numele de familie conține caractere invalide! Acesta trebuie să conțină doar litere mari, litere mici sau cratime.";
        }

        else if(!usernameValidation($_POST['username']))
        {
            $errorMsg = "Numele de utilizator conține caractere invalide! Acesta nu poate conține spații!";
        }

        else
        {   
            $nextID = $lastID + 1;
            $latitude = 0;
            $longitude = 0;

            $passwordQ = hash('sha256', $_POST['password']);
            $addQuery = "INSERT INTO userData VALUES (" . $nextID . ", '" . $_POST['username'] . "', '" . $_POST['firstname'] . "', '" . $_POST['lastname'] . "', '" . $passwordQ . "', " . $latitude . ", " . $longitude . ")";
            
            global $globalResult;

            $result = $conn->query($addQuery);
            $globalResult = $result;

            if($result === TRUE)
            {
                //echo "Utilizator adaugat in baza de date!";
                $dummy = 1;
            }
            else
            {
                // Variabila globala $errorMsg.
                $errorMsg = "Un utilizator cu acest nume de utilizator exista deja."; 
            }
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
    <title>Sign up</title>
    <script>
       function onscroll(){
           window.scrollBy(0, 1000);
       }
       onscroll()
     </script>
</head>
<style>
   body{
       margin:0;
       padding: 0;
       background-image: url('img/signup2.jpg');
       background-size:cover;
   }
   #form input[type=text], #form input[type=password]{
        margin-bottom:2rem;
        border:none;
        border-bottom: 1px solid white;
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
            transform: translate(50%,10%);
        }
    }
    @media only screen and (max-width : 820px) {
        #container{
            transform: translate(50%,10%);
        }
        .navbarphone{
            z-index: 1000;
            margin-top: 5rem;
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
    <?php 
        if($globalResult === TRUE)
        {
            echo "<script>window.location.replace('index.php'); </script>";
        }
    ?>
<script>
       onscroll()
     </script>
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
<!-- end loading page -->



<!-- start main -->

<section class="container-fluid" id="container">
    <form action="signup.php" method="post" class="form-container text-white" style="background-color:rgba(0,0,0,0.5); padding:30px; box-shadow: 0px 0px 10px 0px;width:25rem; border-radius: 10px; transform: translate(-53%,0%);">
        <h4 class="text-center">Înregistrare</h4>
        <div class="form-group" id="form">
            <label for="firstname">Prenume:</label>
            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Ex.: Ion" required>
            <label for="lastname">Nume de familie:</label>
            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Ex.: Popescu" required>
            <label for="username">Nume de utilizator:</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Ex.: Ion213" required>
            <label for="password">Parolă:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="a-z A-Z 0-9" required>
            <div>Dețineți un cont de utilizator? <a class="text-success" href="login.php">Autentificați-vă.</a></div>
    
    <?php 
        if(isErrorMessage($errorMsg))
        {
            echo '<div class="errorpopup">
            <p>' . printErrorMessage($errorMsg) . '</p>
            </div>';
        }
        if(isset($_COOKIE["userID"]))
        {
            echo "<script>window.location.replace('index.php'); </script>";
        }
    ?>


        </div>
        <button type="submit" class="btn text-black btn-block btn-success" style="border:1px solid gray;border-radius: 15px; box-shadow: 1px 1px 1px 0px rgba(0,0,0,0.75); ">Creează Cont</button>
    </form>
</section>
<!-- end main -->
<!-- Error popup -->

<!-- End error -->

<!-- bootstrap scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
<!-- end bootstrap script -->
</body>
</html>
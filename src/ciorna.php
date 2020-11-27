<!DOCTYPE html>
<html>
<?php
    
    $srv = "79.112.132.180";
    $username = "root";
    $pass = "root";
    $db = "users";

    $conn = new mysqli($srv, $username, $pass, $db);
    
    if($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    }

?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Profile - Floareasoarelui</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="shortcut icon" href="img/logoico.png">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="css/navbar.css">
    <script src="js/pixi.min.js"></script>
    <script src="https://code.jquery.com/pep/0.4.3/pep.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<style>
    
.succespopup{
	width: auto;
    height: auto;
    color: white;
}
::-webkit-input-placeholder { /* Edge */
  color: red;
}

:-ms-input-placeholder { /* Internet Explorer 10-11 */
  color: red;
}

.form-group input[type=text]{
        outline: red;
        color: black;
        display: 16px;
    }

</style>
<body id="page-top">
<?php
    
    if(!isset($_COOKIE["userID"]))
    {
        echo "<script>window.location.replace('login.php'); </script>";
    }
    else
    {
        //
    }

    function returnUsernameFromID($id)
    {
        global $srv, $username, $pass, $db, $conn;

        $selectQuery = "SELECT username FROM userData WHERE id=" . $id . ";";

        $result = $conn->query($selectQuery);

        if($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            
            return $row['username'];
        }
    }

    function getColumnDataFromID($columnName, $id)
    {
        global $srv, $username, $pass, $db, $conn;

        $selectQuery = "SELECT " . $columnName . " FROM userData WHERE id=" . $id . ";";

        $result = $conn->query($selectQuery);
        if($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            
            return $row[$columnName];
        }
    }

    function updateUserData($columnName, $id)
    {
        global $srv, $username, $pass, $db, $conn;

        if(isset($_POST[$columnName]))
        {
            if($columnName == "longitude" or $columnName == "latitude")
            {
                $value = doubleval($_POST[$columnName]);
                $value = strval($value);
            }

            else
            {
                $value = $_POST[$columnName];
            }

            $updateQuery = "UPDATE userData SET ". $columnName . "='" . $value . "' WHERE id=" . $id . ";";
            if ($conn->query($updateQuery) === TRUE) 
            {
                $update1msg = "Datele personale au fost modificate cu succes!";
            }
            else
            {
                $update1msg = "Eroare fatala! S-au introdus date invalide.";
            }
        }

        return $update1msg;
    }

    function nameValidation($name)
    {
        $len = strlen($name);

        for($i = 0; $i <= $len - 1; $i++)
        {   
            if(!($name[$i] >= 'a' and $name[$i] <= 'z') and !($name[$i] >= 'A' and $name[$i] <= 'Z'))
            {
                return False;
            }
        }

        return True;
    }

    function usernameValidation($name)
    {
        $len = strlen($name);

        for($i = 0; $i <= $len - 1; $i++)
        {   
            if($name[$i] == " ")
            {
                return False;
            }
        }

        return True;
    }

    function localizationValidation($localizare)
    {
        $len = strlen($localizare);

        for($i = 0; $i <= $len - 1; $i++)
        {
            if(!($name[$i] >= "0" and $name[$i] <= '9') and $name[$i] != '.' and $name[$i] != '-')
            {
                return False;
            }
        }

        return True;
    }

    $errorString = "";
    $validString = "";
    function form1($notErrors)
    {
        global $errorString, $validString;
        $errorString = "";
        $validString = "";

        if(isset($_POST['username']))
        {
            if(usernameValidation($_POST['username']))
            {
                $validString .= "Numele de utilizator a fost actualizat!";
            }

            else
            {
                $errorString .= "Numele de utilizator este invalid!";
            }
        }

        if(isset($_POST['firstname']))
        {
            if(usernameValidation($_POST['firstname']))
            {
                $validString .= "<br>Prenumele a fost actualizat!";
            }

            else
            {
                $errorString .= "<br>Prenumele este invalid!";
            }
        }

        if(isset($_POST['lastname']))
        {
            if(usernameValidation($_POST['lastname']))
            {
                $validString .= "<br>Numele de familie a fost actualizat!";
            }

            else
            {
                $errorString .= "<br>Numele de familie este invalid!";
            }
        }

        if($notErrors)
        {
            return $validString;
        }
        
        else
        {
            return $errorString;
        }
    }

?>
    <div class="m-4 w-100">
    <a href="index.php"><img src="img/logoico.png" alt="" class="buttonnav" style="width: 3rem;height:3rem;margin-top:1.5rem;"></a>
</div>
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            
            <div id="content"  style="background: url('img/signup2.jpg');background-color:rgba(0, 0, 0, 0.5); background-opacity: 0.2;">
                
            <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top" style="position: absolute; top: 0; width: 100vw; z-index: 1;">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <div class="list-group list-group-horizontal" style="width: 25rem;height: 50px; z-index: 0;"><a class="list-group-item list-group-item-action text-nowrap text-left" style="width: 20rem;background: #ffffff;" href="/index.php"><i class="fas fa-tachometer-alt"></i><span style="margin: 3px;">Panou de Control</span><a href="/index.php"></a></a>
                            <a
                                class="list-group-item list-group-item-action active text-center bg-success" href="/profile.php"><i class="fas fa-user"></i><span>Profil</span></a></div><a href="/profile.php"></a>
                                <div class="list-group list-group-horizontal" style="width: 15rem; height: 50px; z-index: 0;">
                            <a class="list-group-item list-group-item-action text-center" href="/cautaluc.php" style="background: rgb(255,255,255);"><i class="fas fa-user"></i><span>Cauta lucratori</span></a></div><a href="/cautaluc.php"></a>
                            <ul class="nav navbar-nav flex-nowrap ml-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><i class="fas fa-search"></i></a>
                                <div class="dropdown-menu dropdown-menu-right p-3 animated--grow-in" aria-labelledby="searchDropdown">
                                    <form class="form-inline mr-auto navbar-search w-100">
                                        <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                            <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item dropdown no-arrow mx-1"></li>
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600"><?php echo returnUsernameFromID($_COOKIE["userID"]);?></span><img class="border rounded-circle img-profile" src="img/avatar.jpg"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in">
                                        <a class="dropdown-item" href="profile.php"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Profil</a>
                                            <div class="dropdown-divider"></div><a class="dropdown-item" href="#" onclick="window.location.replace('disconnect.php')"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Deconectare</a></div>
                    </div>
                    </li>
                    </ul>
            </div>
            </nav>
                
            <div class="container w-50" style="z-index: -14123;">
                <h3 class="text-dark mb-4">Profil</h3>
                <div class="row mb-3 ">
                    <div class="col">
                        <div class="card  ">
                            <div class="card-header py-3">
                                <p class=" m-0 font-weight-bold text-success">Date utilizator</p>
                            </div>
                            <div class="card-body mb-2" >
                                <form action="profile.php" method="POST">
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group"><label for="username"><strong>Username</strong></label><input class="form-control" type="text" placeholder="<?php echo getColumnDataFromID("username", $_COOKIE["userID"]);?>" name="username"></div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group"><label for="first_name"><strong>Prenume</strong></label><input class="form-control" type="text" placeholder="<?php echo getColumnDataFromID("firstname", $_COOKIE["userID"]);?>" name="firstname"></div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group"><label for="last_name"><strong>Nume</strong><br></label><input class="form-control" type="text" placeholder="<?php echo getColumnDataFromID("lastname", $_COOKIE["userID"]);?>" name="lastname"></div>
                                        </div>
                                    </div>
                                    <div class="form-group" style="display: flex;">
                                    <button class="btn btn-success btn-sm" style="height: 3rem" type="submit">Salvează</button>
                                    <div style="justify-concent:center; align-items: center; margin-left:15rem;"> 
                                                <p style="margin-top:auto;margin-left:auto;font-size: 1.3rem;" class=" text-success"><?php echo form1(0); ?></p>
                                    </div>
                                    <div style="justify-concent:center; align-items: center; margin-left:15rem;"> 
                                                <p style="margin-top:auto;margin-left:auto;font-size: 1.3rem;" class=" text-danger"><?php echo form1(1); ?></p>
                                    </div>
                                </div>
                                    
                                </form>
                            </div>
                        </div>
                        <div class="card  mt-2">
                            <div class="card-header py-3">
                                <p class="m-0 font-weight-bold text-success ">Localizare</p>
                            </div>
                            <div class="card-body">
                            <form action="profile.php" method="POST">
                                    <div class="form-group"><label for="address"><strong>Latitudine</strong></label><input class="form-control" type="text" placeholder="<?php echo getColumnDataFromID("latitude", $_COOKIE["userID"]);?>" name="latitude"></div>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group"><label for="city"><strong>Longitudine</strong></label><input class="form-control" type="text" placeholder="<?php echo getColumnDataFromID("longitude", $_COOKIE["userID"]);?>" name="longitude"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group" style="display: flex;">
                                    <button class="btn btn-success btn-sm" style="height: 3rem" type="submit">Salvează</button>
                                    <div style="justify-concent:center; align-items: center; margin-left:15rem;"> 
                                                <p style="margin-top:auto;margin-left:auto;font-size: 1.3rem;" class=" text-success"><?php global $updateMsg2; if($updateMsg2 == "Datele personale au fost modificate cu succes!") {echo printErrorMessage($updateMsg2);}; ?></p>
            
                                    </div>
                                    <div style="justify-concent:center; align-items: center; margin-left:15rem;"> 
                                                <p style="margin-top:auto;margin-left:auto;font-size: 1.3rem;" class=" text-danger"><?php global $updateMsg2; if($updateMsg2 == "Longitudinea introdusă este invalidă!" or $updateMsg2 == "Latitudinea introdusă este invalidă!") {echo printErrorMessage($updateMsg1);}; ?></p>
                                    </div>
                                    </div>
                                    <div>Pentru un scurt tutorial pentru a afla latitudinea si longitudinea click <a class="text-success" data-toggle="collapse" aria-controls="collapse-1" href="#collapse-1" role="button">aici</a>.
                                    <div class="collapse" id="collapse-1">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Pe Desktop:</h4>
                                                <div class="row">
                                                    <div class="col" style="width: 543px;margin-left: 0px;">
                                                        <h6 class="text-muted mb-2">Accesati google maps</h6>
                                                        <p style="max-width: 100%;">Dati click-dreapta pe locatia dorita&nbsp;&nbsp;</p>
                                                        <p style="width: 30rem;">In meniul care apare, click pe coordonate pentru a le copia&nbsp;</p>
                                                    </div>
                                                    <div style="display: flex;">
                                                    <div class="col"><img src="images/s1.png" style="width: 15rem; height:15rem;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Pe Mobil:</h4>
                                                <div class="row">
                                                    <div class="col" style="width: 543px;margin-left: 0px;">
                                                        <h6 class="text-muted mb-2">Accesati aplicatia google maps</h6>
                                                        <p style="max-width: 100%;">Tineti apasat pe locatia dorita&nbsp;&nbsp;</p>
                                                        <p>Click pe meniul care apare in partea de jos a ecranului&nbsp;&nbsp;</p>
                                                        <p style="width: 30rem;">In meniul care apare, click pe coordonate pentru a le copia&nbsp;</p>
                                                    </div>
                                                    <div style="display: flex;">
                                                    <div class="col"><img src="images/s2.jpg" style="width: 9rem; height:15rem;"></div>
                                                    <div class="col"><img src="images/s3.jpg" style="width: 9rem; height:15rem;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div  style="margin-left:10px;">Pentru si mai multe detalii click <a class="text-success" href="https://support.google.com/maps/answer/18539?co=GENIE.Platform%3DDesktop&hl=ro">aici</a>.
                                        </div>
                                    </div>
                                </div>
                                </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <footer class="text-light sticky-footer bg-success" style="margin-top: 2rem;color: rgb(231,166,26);">
        <div class="container my-auto">
            <div class="text-center my-auto copyright" style="font-size: 17px;">
            <span style="text-align: center;">Copyright © FloareaSoarelui 2020</span><br><br>
            <a href="contacts.php" style=" text-decoration: none; color: white;"><span style="text-align: center; color: white;">ABOUT US</span></a>
        </div>
        </div>
    </footer>
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
    
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>
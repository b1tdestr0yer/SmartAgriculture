<?php

    $srv = "79.112.132.180";
    $username = "root";
    $pass = "root";
    $db = "plantInfo";
    $db2 = "users";

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

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Panou de Control - Floarea Soarelui</title>
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="/assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="/assets/fonts/font-awesome.min.css">
    <link rel="shortcut icon" href="img/logoico.png">
    <link rel="stylesheet" href="/assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="/css/weather.css">
    <link rel="stylesheet" href="css/loading.css">
    <script src="js/pixi.min.js"></script>
    <script src="https://code.jquery.com/pep/0.4.3/pep.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.0/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.0/angular-cookies.js"></script>
</head>
<body id="page-top">
    <div style="z-index: -32180973213; width: 100vw; height: 100%;position: fixed; top:0;left:0;opacity: 0.2;">
    <img src="img/signup2.jpg" alt="" style="width:100%;height: 100%;">
</div>

<?php
    
########################################################################################################################################################################################################################

    if(!isset($_COOKIE["userID"]))
    {   
        echo "<script>window.location.replace('login.php'); </script>";
    }

    function returnUsernameFromID($id)
    {
        global $srv, $username, $pass, $db2;

        $conn = new mysqli($srv, $username, $pass, $db2);

        $selectQuery = "SELECT username FROM userData WHERE id=" . $id . ";";

        $result = $conn->query($selectQuery);

        if($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            
            return $row['username'];
        }
    }

########################################################################################################################################################################################################################

    function getDataFrom($fieldName, $id)
    {   
        global $srv, $username, $pass, $db2;

        $conn = new mysqli($srv, $username, $pass, $db2);

        $selectQuery = "SELECT " . $fieldName . " FROM userData WHERE id=" . $id . ";";

        $result = $conn->query($selectQuery);
        
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                return $row[$fieldName];
            }
        }
    }


?>
<div class="loading">
                <div class="bar">
                    <i class="sphere"></i>
                </div>
            </div>
<div class="m-4 w-100">
    <a href="index.php"><img src="img/logoico.png" alt="" class="buttonnav" style="width: 3rem;height:3rem;margin-top:1.5rem;"></a>
</div>
    <div id="wrapper" style="background: rgba(0,0,0,0);">
        <div class="d-flex flex-column" id="content-wrapper" style="background: transparent;">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top" style="position: absolute; top: 0; width: 100vw;">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <div class="list-group list-group-horizontal" style=" height: 50px; z-index: 0;"><a class="list-group-item list-group-item-action active text-nowrap text-left bg-success" style="width: 200px;" href="/index.php"><i class="fas fa-tachometer-alt"></i><span style="margin: 3px;">Panou de Control</span><a href="/index.php"></a></a>
                            <a class="list-group-item list-group-item-action text-center" href="/profile.php" style="background: rgb(255,255,255);"><i class="fas fa-user"></i><span>Profil</span></a><a href="/profile.php"></a><a class="list-group-item list-group-item-action text-center" style="width:15rem;" href="/messages.php"><i class="fa fa-commenting"></i><span>Contact</span></a></div>
                            
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
                                    <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in"><a class="dropdown-item" href="profile.php"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Profil</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#" onclick="window.location.replace('disconnect.php')"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Deconectare</a>
                                    </div>
                                </div>
                             </li>
                        </ul>
                    </div>
                </nav>
            <div class="container-fluid" style="padding-left: 20px;">
                <div class="d-sm-flex justify-content-between align-items-center mb-4">
                    <h3 class="mb-0 text-success" style="margin-top:4rem" ><b>Panou de Control<b></h3></div>
                <div class="row">
                    <div class="col"  style=" z-index: -1;">
                        <div class="card" style="background: rgb(246,194,62);color: rgb(255,255,255);">
                            <div class="card-body" style="background: linear-gradient(-13deg, rgb(231,166,26) 77%, rgb(255,240,203) 100%), #2033dd;">
                                <p class="card-text">Temperatura</p>
                                <h4 id="temperature" class="card-title">Incarcare</h4>
                                <p id="temperatureDescription" class="card-text">Incarcare</p>
                            </div>
                        </div>
                    </div>
                    <div class="col"  style=" z-index: -1;">
                        <div class="card" style="background: rgb(66,208,217);color: rgb(255,255,255);">
                            <div class="card-body" style="background: linear-gradient(-13deg, rgb(62,213,246) 77%, rgb(203,246,255) 100%), #2033dd;padding-bottom: 44px;">
                                <p class="card-text">Vant</p>
                                <h4 id="windspeed" class="card-title">Incarcare</h4>
                            </div>
                        </div>
                        <div class="card"></div>
                    </div>
                    <div class="col"  style=" z-index: -1;">
                        <div class="card">
                            <div class="card-body" style="background: linear-gradient(-13deg, rgb(62,169,246) 77%, rgb(203,239,255) 100%), #2033dd;color: rgb(255,255,255);padding-bottom: 44px;">
                                <p class="card-text">Umiditate</p>
                                <h4 id="humidity" class="card-title">Incarcare</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col"  style=" z-index: -1;">
                        <div class="card">
                            <div class="card-body" style="color: rgb(255,255,255);background: linear-gradient(-13deg, rgb(62,80,246) 83%, rgb(187,197,251) 100%), #2033dd;padding-bottom: 44px;">
                                <p class="card-text">Presiune atmosferica</p>
                                <h4 id="pressure" class="card-title">Incarcare</h4>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="row" style="max-width: 60vw;margin-left: 18vw;">
                <div class="col" style="margin-top: 2rem;">
                    <div class="card" style="opacity: 1;background: rgb(255,255,255);z-index:-1;">
                        <div class="card-header py-3" style="opacity: 1;">
                            <h6 class="font-weight-bold m-0 text-success">Prognoza de astăzi este: </h6>
                        </div>
                        <div class="card-body" style="opacity: 1;width: 100%;">
                            <ul id="tasks" class="list-group">
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                if(getDataFrom("latitude", $_COOKIE['userID']) == "0")
                {
                    echo '<div
                    style="max-width: 60vw;margin-right: 0;margin-left: 17rem; font-size: 3rem;"
                    class="row d-flex justify-content-center align-self-center text-success" >
                    <p style="text-align:center">Introduceți latitudinea și longidutinea (în secțiunea "Profil") pentru a se putea afișa fezabilitatea!</p>
                    </div>
                    '
                    ;
                }
                else
                {
                    echo '<div class="row" style="max-width: 60vw;margin-right: 0;margin-left: 18vw;">
                    <div class="col" style="margin-top: 3rem;">
                        <div class="card" style="background: rgb(255,255,255);z-index: -1;">
                            <div class="card-header py-3">
                                <h4 class="text-center font-weight-bold m-0 text-success">Culturi</h4>
                            </div>
                            <div class="card-body" style="background: transparent;">
                                <h4 class="small font-weight-bold" style="font-size: 16px;color: rgb(0,0,0);">Floarea Soarelui<span id="SunflowerText" class="float-right">Incarcare</span></h4>
                                <div class="progress mb-4" style="filter: saturate(103%) sepia(0%);">
                                    <div id="Sunflower" class="progress-bar progress-bar-animated" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"><span class="sr-only">100%</span></div>
                                </div>
                                <h4 class="small font-weight-bold" style="font-size: 16px;color: rgb(0,0,0);">Cartofi<span id="PotatoText" class="float-right">Incarcare</span></h4>
                                <div class="progress mb-4">
                                    <div id="Potato" class="progress-bar" style="width: 90%;"><span class="sr-only"></span></div>
                                </div>
                                <h4 class="small font-weight-bold" style="font-size: 16px;color: rgb(0,0,0);">Grau<span id="WheatText" class="float-right">Incarcare</span></h4>
                                <div class="progress mb-4">
                                    <div id="Wheat" class="progress-bar" style="width: 20%;"><span class="sr-only">20%</span></div>
                                </div>
                                <h4 class="small font-weight-bold" style="font-size: 16px;color: rgb(0,0,0);">Rapita<span id="RapeseedText" class="float-right">Incarcare</span></h4>
                                <div class="progress mb-4">
                                    <div id="Rapeseed" class="progress-bar" style="width: 80%;"><span class="sr-only">80%</span></div>
                                </div>
                                <h4 class="small font-weight-bold" style="font-size: 16px;color: rgb(0,0,0);">Soia<span id="SoyText" class="float-right">Incarcare</span></h4>
                                <div class="progress mb-4">
                                    <div id="Soy" class="progress-bar" style="width: 40%;"><span class="sr-only">40%</span></div>
                                </div>
                                <h4 class="small font-weight-bold" style="font-size: 16px;color: rgb(0,0,0);">Porumb<span id="MaizeText" class="float-right">Incarcare</span></h4>
                                <div class="progress mb-4">
                                    <div id="Maize" class="progress-bar" style="width: 100%;"><span class="sr-only">100%</span></div>
                                </div>
                                <h4 class="small font-weight-bold" style="font-size: 16px;color: rgb(0,0,0);">Struguri<span id="GrapesText" class="float-right">Incarcare</span></h4>
                                <div class="progress mb-4">
                                    <div id="Grapes" class="progress-bar" style="width: 0%;"><span class="sr-only">0%</span></div>
                                </div>
                                <h4 class="small font-weight-bold" style="font-size: 16px;color: rgb(0,0,0);">Rosii<span id="TomatoText" class="float-right">Incarcare</span></h4>
                                <div class="progress mb-4">
                                    <div id="Tomato" class="progress-bar" style="width: 0%;"><span class="sr-only">0%</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
                }
            ?>
        </div>
    </div>
    <footer class="text-light sticky-footer bg-success" style="margin-top: 2rem;color: rgb(231,166,26);">
        <div class="container my-auto">
            <div class="text-center my-auto copyright" style="font-size: 17px;">
            <span style="text-align: center;">Copyright © FloareaSoarelui 2020</span><br><br>
            <a href="contacts.php" style=" text-decoration: none;"><span style="text-align: center;">ABOUT US</span></a>
        </div>
        </div>
    </footer>
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="/assets/js/theme.js"></script>
    <script>
        var lat = <?php echo json_encode(getDataFrom("latitude", $_COOKIE['userID'])); ?>;
        var long = <?php echo json_encode(getDataFrom("longitude", $_COOKIE['userID'])); ?>;
        var dictionary = <?php echo json_encode($dictArray); ?>;
        var isPost = <?php echo $isPostPHP; ?>;
    </script>
    <script src="/js/api.js"></script>
    <script src="/js/weather.js"></script>
</body>

</html>
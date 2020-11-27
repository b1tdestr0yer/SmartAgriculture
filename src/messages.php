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

?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Profile - Floareasoarelui</title>
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="/assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="/assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="/assets/css/Contact-Form-Clean.css">
    <link rel="shortcut icon" href="img/logoico.png">
</head>

<body id="page-top">
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop-1" type="button"><i class="fas fa-bars"></i></button>
                        <div class="list-group list-group-horizontal" style="height: 50px;"><a class="list-group-item list-group-item-action text-nowrap text-left" style="width: 200px;background: #ffffff;" href="/index.php"><i class="fas fa-tachometer-alt"></i><span style="margin: 3px;">Panou de Control</span><a href="/index_old.html"></a></a>
                            <a
                                class="list-group-item list-group-item-action text-center" href="/profile.php" style="background: rgb(255,255,255);"><i class="fas fa-user"></i><span>Profil</span></a><a class="list-group-item list-group-item-action active text-center" href="/table.html" style="width:250px;background: rgb(28,200,138);"><i class="fa fa-commenting"></i><span>Contact</span></a></div>
                        <ul
                            class="nav navbar-nav flex-nowrap ml-auto">
                            <li class="nav-item dropdown no-arrow mx-1"></li>
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600"><?php echo returnUsernameFromID($_COOKIE["userID"]);?></span><img class="border rounded-circle img-profile" src="img/avatar.jpg"></a>
                                    <div
                                        class="dropdown-menu shadow dropdown-menu-right animated--grow-in"><a class="dropdown-item" href="profile.php"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Profile</a>
                                            <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Logout</a></div>
                    </div>
                    </li>
                    </ul><a href="/profile_old.html"></a></div>
            </nav>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="/" method="POST" style="width: auto;max-width: 30rem;margin-left: 30rem;">
                    <h2 class="text-center">Contact worker</h2>
                    <div class="form-group"><input class="form-control" type="tel" name="number" placeholder="Telephone number"><small class="form-text text-danger">Please enter a correct telephone number</small></div>
                    <div class="form-group"><textarea class="form-control" name="message" placeholder="Message" rows="14"></textarea></div>
                    <div class="form-group"><button class="btn btn-success" type="submit" onclick="window.location.replace('index.php');">send </button></div>
                </form>
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
</body>

</html>
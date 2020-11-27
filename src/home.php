


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
    <title>Home</title>
</head>
<style>
   body{
       margin:0;
       padding: 0;
       background-image: url('img/signup.jpg');
       background-size:cover;
   }
</style>
<body>
<!-- Loading -->
<div class="loading">
		<div class="bar">
			<i class="sphere"></i>
		</div>
	</div>
<!-- end loading page -->
<!--  Nav bar -->
<div class="m-4 w-100">
	<label  for="main-nav-toggle" tabindex="0" aria-label="Menu" class="buttonnav">
		<svg aria-hidden="true" width="28px" height="20px" viewBox="0 0 28 20">
			<rect x="0" y="2" width="28" height="2"></rect>
			<rect x="0" y="10" width="24" height="2"></rect>
				<rect x="0" y="18" width="28" height="2"></rect>
		</svg>
	</label>
	<input type="checkbox" id="main-nav-toggle" />
	<nav class="main-nav">
        <ul class="main-nav__fallback">
            <li><a href="home.php">Home</a></li>
            <li><a href="#events">Site1</a></li>
            <li><a href="contacts.php">Contact</a></li>
        </ul>
        <label class="main-nav__close nav-toggle" for="main-nav-toggle" tabindex="0" aria-label="Close menu">
            <svg aria-hidden="true" width="24" height="22px" viewBox="0 0 24 22">
                <path d="M11 9.586L20.192.393l1.415 1.415L12.414 11l9.193 9.192-1.415 1.415L11 12.414l-9.192 9.193-1.415-1.415L9.586 11 .393 1.808 1.808.393 11 9.586z">
            </svg>
        </label>
	</nav>
    </div>
    <script src="js/navbar.js"></script>
<!-- End nav bar -->




<!-- bootstrap scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
<!-- end bootstrap script -->
</body>
</html>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>test</title>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Slicebox - 3D Image Slider with Fallback" />
        <meta name="keywords" content="jquery, css3, 3d, webkit, fallback, slider, css3, 3d transforms, slices, rotate, box, automatic" />
		<link rel="stylesheet" type="text/css" href="css/custom.css" />
    <link rel="shortcut icon" href="img/logoico.png">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="css/navbar.css">
	<link rel="stylesheet" href="css/loading.css">
	<script type="text/javascript" src="js/modernizr.custom.46884.js"></script>
    <script src="js/pixi.min.js"></script>
    <script src="https://code.jquery.com/pep/0.4.3/pep.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
	</head>
	<body style="background: url('img/signup2.jpg')">
	<div class="loading">
                <div class="bar">
                    <i class="sphere"></i>
                </div>
            </div>
		<div class="m-4 w-100">
    <a href="index.php"><img src="img/logoico.png" alt="" class="buttonnav" style="width: 3rem;height:3rem;margin-top:3rem;"></a>
</div>
			<div class="wrapper" style="margin-top:4rem;">
				<ul id="sb-slider" class="sb-slider">
					<li>
						<div style="display: flex;">
						<img src="images/poster2.jpg" alt="image1" style="height:30rem; width: 23rem;"/>
						<p style="padding: 2rem; color: white; background: rgba(0,0,0,0.2);margin: 2rem;font-size: 1.5rem"> Responsabil cu hostarea server-ului, management-ul docker-cotainerului și al algorithmului de predicție.
						</p>
						</div>
						<div class="sb-description">
							<h3 style="z-index: -1;">Cuzenco  Andrei - Robert</h3>
						</div>
					</li>
					<li>
					<div style="display: flex;">
						<img src="images/poster3.jpg" alt="image1" style="height:30rem; width: 22.5rem"/>
						<p style="padding: 2rem; color: white; background: rgba(0,0,0,0.2);margin: 2rem;font-size: 1.5rem">Responsabil pentru management-ul bazei de date (un task pe care nu mulți și-l doresc, dar care este pe placul meu), și programarea părții ce ține de PHP a backend-ului. 
						</p>
						</div>
						<div class="sb-description">
							<h3 style="z-index: -1;">Doroftei Victor</h3>
						</div>
					</li>
					<li>
					<div style="display: flex;">
						<img src="images/poster4.jpg" alt="image1" style="height:30rem; width: 23rem;"/>
						<p style="padding: 2rem; color: white; background: rgba(0,0,0,0.2);margin: 2rem;font-size: 1.5rem">
						Am creat design-ul platformei si tot ce tine de interfata utilizator. <br><br>Bootstrap ftw.
						</p>
						</div>
						<div class="sb-description">
							<h3 style="z-index: -1;">Volostiuc Eusebiu</h3>
						</div>
					</li>
					<li>
					<div style="display: flex;">
						<img src="images/poster1.jpg" alt="image1" style="height:30rem; width: 23rem;"/>
						<p style="padding: 2rem; color: white; background: rgba(0,0,0,0.2); margin: 2rem;font-size: 1.5rem">
						Sunt un tip zambaret, ce emana o energie pozitiva si care adora sa-si exercite creativitate pe site-urile lui.
						<br>Am creat efectele nenumarate si ador sa ma scufund in alte mii de efecte
						<br>
						<sub style="position: absolute; bottom: 5rem;">P.S. sunt o oaie</sub>
						</p>
						</div>
						<div class="sb-description">
							<h3 style="z-index: -1;">Hostiuc Robert - Gabriel</h3>
						</div>
					</li>
				</ul>
				<div id="shadow" class="shadow"></div>
				<div id="nav-arrows" class="nav-arrows">
					<a href="#">Next</a>
					<a href="#">Previous</a>
				</div>
			</div>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.slicebox.js"></script>
		<script type="text/javascript">
			$(function() {

				var Page = (function() {

					var $navArrows = $( '#nav-arrows' ).hide(),
						$navDots = $( '#nav-dots' ).hide(),
						$nav = $navDots.children( 'span' ),
						$shadow = $( '#shadow' ).hide(),
						slicebox = $( '#sb-slider' ).slicebox( {
							onReady : function() {

								$navArrows.show();
								$navDots.show();
								$shadow.show();

							},
							onBeforeChange : function( pos ) {

								$nav.removeClass( 'nav-dot-current' );
								$nav.eq( pos ).addClass( 'nav-dot-current' );

							}
						} ),
						
						init = function() {

							initEvents();
							
						},
						initEvents = function() {

							// add navigation events
							$navArrows.children( ':first' ).on( 'click', function() {

								slicebox.next();
								return false;

							} );

							$navArrows.children( ':last' ).on( 'click', function() {
								
								slicebox.previous();
								return false;

							} );

							$nav.each( function( i ) {
							
								$( this ).on( 'click', function( event ) {
									
									var $dot = $( this );
									
									if( !slicebox.isActive() ) {

										$nav.removeClass( 'nav-dot-current' );
										$dot.addClass( 'nav-dot-current' );
									
									}
									
									slicebox.jump( i + 1 );
									return false;
								
								} );
								
							} );

						};

						return { init : init };

				})();

				Page.init();

			});
		</script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
	<script src="assets/js/theme.js"></script>
</body>
</html>	

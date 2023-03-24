

<html>
<head>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        function mostrar(id) {
            if (id == "in") {
                $("#in").show();
                $("#out").hide();
                $("#main").hide();
            }
            if (id == "out") {
                $("#in").hide();
                $("#out").show();
                $("#main").hide();
            }

        }
    </script>
    <meta charset="UTF-8">
    <?php include('../includes/title.inc');?>
</head>

<link rel="stylesheet" href="dist/kioskboard-1.4.0.min.css" /><script src="dist/kioskboard-1.4.0.min.js"></script>

	<Script>
KioskBoard.Init({
	keysArrayOfObjects: null,
	keysJsonUrl: null,
	specialCharactersObject: null,
	language: 'en', // Language Code (ISO 639-1) for custom keys (for language support) => e.g. "en" || "tr" || "es" || "de" || "fr" etc.
	theme: 'light', // The theme of keyboard => "light" || "dark" || "flat" || "material" || "oldschool"
	capsLockActive: true, // Uppercase or lowercase to start. Uppercase when "true"
	allowRealKeyboard: false, // Allow or prevent real/physical keyboard usage. Prevented when "false"
	cssAnimations: true, // CSS animations for opening or closing the keyboard
	cssAnimationsDuration: 360, // CSS animations duration as millisecond
	cssAnimationsStyle: 'slide', // CSS animations style for opening or closing the keyboard => "slide" || "fade"
	keysAllowSpacebar: true, // Allow or deny Spacebar on the keyboard. The keyboard is denied when "false"
	keysSpacebarText: 'Space', // Text of the space key (spacebar). Without text => " "
	keysFontFamily: 'sans-serif', // Font family of the keys
	keysFontSize: '22px', // Font size of the keys
	keysFontWeight: 'normal', // Font weight of the keys
	keysIconSize: '25px', // Size of the icon keys
	KioskBoard.Run('.js-kioskboard-input');
	</script>

<style type="text/css" media="screen">
.botonIN {
border: 1px solid #2e518b; /*anchura, estilo y color borde*/
padding: 10px; /*espacio alrededor texto*/
background-color: #2E9B2F; /*color botón*/
color: #ffffff; /*color texto*/
text-decoration: none; /*decoración texto*/
text-transform: uppercase; /*capitalización texto*/
font-family: 'Helvetica', sans-serif; /*tipografía texto*/
border-radius: 50px; /*bordes redondos*/
}
	</style>

<style>	
.botonOUT {
border: 1px solid #2e518b; /*anchura, estilo y color borde*/
padding: 10px; /*espacio alrededor texto*/
background-color: #C0080B; /*color botón*/
color: #ffffff; /*color texto*/
text-decoration: none; /*decoración texto*/
text-transform: uppercase; /*capitalización texto*/
font-family: 'Helvetica', sans-serif; /*tipografía texto*/
border-radius: 50px; /*bordes redondos*/
}
	
	</style>
<?php


 include ('../includes/registro.php');

?>

</html>

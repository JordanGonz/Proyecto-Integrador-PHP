<?php
/* Database connection settings */
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'location_db';
$mysqli = new mysqli($host, $user, $pass, $db) or die($mysqli->error);

$coordinates = array();
$latitudes = array();
$longitudes = array();

// Select all the rows in the markers table
$query = "SELECT  `locationLatitude`, `locationLongitude` FROM `location_tab` ";
$result = $mysqli->query($query) or die('data selection for google map failed: ' . $mysqli->error);

while ($row = mysqli_fetch_array($result)) {

	$latitudes[] = $row['locationLatitude'];
	$longitudes[] = $row['locationLongitude'];
	$coordinates[] = 'new google.maps.LatLng(' . $row['locationLatitude'] . ',' . $row['locationLongitude'] . '),';
}

//remove the comaa ',' from last coordinate
$lastcount = count($coordinates) - 1;
$coordinates[$lastcount] = trim($coordinates[$lastcount], ",");



?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Mapa</title>


	<link href="../css/bootstrap.min.css" rel="stylesheet">


	<link href="../css/business-casual.css" rel="stylesheet">


	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">
	<?php
		$Username = null;
		if(!empty($_SESSION["Username"]))
		{
			$Username = $_SESSION["Username"];
		}
	?>
</head>

<body>
	<div class="brand">Entregas Delivery</div>
	<div class="address-bar"><strong>Directo</strong> Y a la puerta de tu casa</div>
	<nav class="navbar navbar-default" role="navigation">
		<div class="container">

			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

				<a class="navbar-brand" href="index.html">Entregas Delivery</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="../index.php">Inicio</a></li>
					<li><a href="../bestseller.php">Productos más populares</a></li>
					<li><a href="../shop.php">Tienda</a></li>
					<li><a href="../about.php">Nosotros</a></li>
					<li><a href="#" onclick="ManagementOnclick();">Administrador</a></li>
					<li><a href="index.php" class="activo">Mapa</a></li>

					
				</ul>
			</div>

		</div>

		<div class="container">

			<div class="row">
				<div class="box">
					<div class="col-lg-12">
						<hr>
						<h2 class="intro-text text-center">Punto
							<strong>De Encuentro</strong>
						</h2>
						<hr>
					</div>
					<div class="col-md-6">
						<img class="img-responsive img-border-left" src="img/aumentar-ventas-delivery.png" alt="">
					</div>

					</form>
				</div>
				<div id="map" style="width: 100%; height: 80vh;"></div>
				<div class="outer-scontainer">

					<div class="col-md-6">
						<script>
							function initMap() {
								var mapOptions = {
									zoom: 18,
									center: {
										<?php echo 'lat:' . $latitudes[0] . ', lng:' . $longitudes[0]; ?>
									}, //{lat: --- , lng: ....}
									mapTypeId: google.maps.MapTypeId.SATELITE
								};

								var map = new google.maps.Map(document.getElementById('map'), mapOptions);

								var RouteCoordinates = [
									<?php
									$i = 0;
									while ($i < count($coordinates)) {
										echo $coordinates[$i];
										$i++;
									}
									?>
								];

								var RoutePath = new google.maps.Polyline({
									path: RouteCoordinates,
									geodesic: true,
									strokeColor: '#1100FF',
									strokeOpacity: 1.0,
									strokeWeight: 10
								});

								mark = 'img/mark.png';
								flag = 'img/flag.png';

								startPoint = {
									<?php echo 'lat:' . $latitudes[0] . ', lng:' . $longitudes[0]; ?>
								};
								endPoint = {
									<?php echo 'lat:' . $latitudes[$lastcount] . ', lng:' . $longitudes[$lastcount]; ?>
								};

								var marker = new google.maps.Marker({
									position: startPoint,
									map: map,
									icon: mark,
									title: "Start point!",
									animation: google.maps.Animation.BOUNCE
								});

								var marker = new google.maps.Marker({
									position: endPoint,
									map: map,
									icon: flag,
									title: "End point!",
									animation: google.maps.Animation.DROP
								});

								RoutePath.setMap(map);
							}

							google.maps.event.addDomListener(window, 'load', initialize);
						</script>

						<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-dFHYjTqEVLndbN2gdvXsx09jfJHmNc8&callback=initMap"></script>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>

			<footer>
				<div class="container">
					<div class="row">
						<div class="col-lg-12 text-center">
							<p>
							
								<br>
								<strong>
									<?php echo '<strong>'.$Username.'</strong>'; ?>
								<?php if($Username != null){echo '<a href="../ManageAccount.php?Role=User">Manage Account</a> |';} ?> 
								
									<a href="#">Volver arriba</a>
								</strong><br>
								Copyright &copy; Delivery
							</p>
						</div>
					</div>
				</div>
			</footer>


			<script src="js/jquery.js"></script>


			<script src="js/bootstrap.min.js"></script>
			<script>
				function ManagementOnclick() {
					if (confirm("Solo los administradores tienen permitido acceder a esta página. Inicie sesión como administrador.") == true) {
						window.open("../Login.php?Role=Admin", "_self", null, true);
					}
				}
			</script>









</body>

</html>
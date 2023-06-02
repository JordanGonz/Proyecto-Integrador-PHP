<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>About</title>

  
    <link href="css/bootstrap.min.css" rel="stylesheet">

 
    <link href="css/business-casual.css" rel="stylesheet">

   
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
                <li><a href="index.php">Inicio</a></li>
					<li><a href="bestseller.php">Productos más populares</a></li>
					<li><a href="shop.php">Tienda</a></li>
                    <li><a href="about.php" class="activo">Nosotros</a></li>
					<li><a href="#" onclick="ManagementOnclick();">Administrador</a></li>
                    <li ><a href="map/index.php" >Mapa</a></li>
					<?php if($Username == null){echo '<li><a href="register.php?ActionType=Register">Registrarse para pedidos</a></li>';} ?>
					<?php if($Username == null){echo '<li><a href="Login.php?Role=User">Ingresar</a></li>';} else {echo '<li><a href="Logout.php">Cerrar Sesión</a></li>';} ?>
                </ul>
            </div>
           
        </div>
     
    </nav>

    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Nosotros
                        <strong>Pedidos Delivery</strong>
                    </h2>
                    <hr>
                </div>
                <div class="col-md-6">
                    <img class="img-responsive img-border-left" src="img/aumentar-ventas-delivery.png" alt="">
                </div>
                <div class="col-md-6">
                    <p>
                    Bienvenido a nuestra aplicación de delivery, donde puedes disfrutar de tus comidas favoritas en la comodidad de tu hogar.
                    Con nuestra aplicación, puedes explorar una amplia variedad de restaurantes y menús en tu zona, realizar pedidos de forma fácil y rápida,
                    y recibir tu comida directamente en la puerta de tu casa.

                    Nuestra aplicación es fácil de usar y está diseñada para ofrecerte la mejor experiencia posible. 
                    Puedes ver fotos de los platos, leer comentarios de otros usuarios y seleccionar entre una variedad de opciones de pago seguro.
                     Además, puedes realizar un seguimiento de tu pedido en tiempo real y recibir actualizaciones sobre su estado.

                     ¡Buen provecho!
                    </p>
                    <p><a href="https://www.youtube.com/watch?v=puYsBFE91Fw">https://www.youtube.com/watch?v=puYsBFE91Fw</a></p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

    </div>
    

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                   <p>
					<?php echo '<strong>'.$Username.'</strong>'; ?>
					<br>
					<strong>
					<?php if($Username != null){echo '<a href="ManageAccount.php?Role=User">Manage Account</a> |';} ?> 
					<?php if($Username == null){echo '<a href="Login.php?Role=User">Login</a>';} else {echo '<a href="Logout.php">Logout</a>';} ?> | 
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
		
		function ManagementOnclick(){
			if(confirm("Solo los administradores tienen permitido acceder a esta página. Inicie sesión como administrador.") == true)
			{
				window.open("Login.php?Role=Admin","_self",null,true);
			}
		}
		
    </script>

</body>

</html>

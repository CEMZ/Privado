<?php
function head($title){
    session_start();
    if(!isset($_SESSION['user'])) header('Location: loginform.php');
    $usuario = $_SESSION['user'];
    $rol = $_SESSION['rol'];
	?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $title; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">

    <link rel="shortcut icon" type="image/ico" href="images/favicon.ico"/>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="index.php">
                        El divino maestro
                    </a>
                </li>
                <?php
                    switch ($_SESSION['rol']) {
                        case 1:{
                            ?>
                                <li>
                                    <a href="adminUsers.php">Usuarios</a>
                                    <?php
                                        if (strpos($_SERVER['REQUEST_URI'],'adminUsers')) {
                                            ?>
                                                <ul style="list-style-type: none;">
                                                    <li><a href="#" id="addUser">Agregar</a></li>
                                                    <li><a href="#" id="delUser">Eliminar</a></li>
                                                    <li><a href="#" id="updUser">Actualizar</a></li>
                                                </ul>
                                            <?php
                                        }
                                    ?>
                                </li>
                            <?php
                            break;
                        }
                        case 3:{
                            ?>
                                <li>
                                    <a href="adminFuel.php">Combustible</a>
                                    <?php
                                        if (strpos($_SERVER['REQUEST_URI'],'adminFuel')) {
                                            ?>
                                                <ul style="list-style-type: none;">
                                                    <li><a href="#" id="addFuel">Agregar</a></li>
                                                    <li><a href="#" id="delFuel">Eliminar</a></li>
                                                    <li><a href="#" id="updFuel">Actualizar</a></li>
                                                    <li><a href="#" id="reporte2">Reporte de rendimiento</a></li>
                                                </ul>
                                            <?php
                                        }
                                    ?>
                                </li>
                            <?php
                            break;
                        }
                        case 2:{
                            ?>
                                <li>
                                    <a href="adminMaintenance.php">Mantenimiento</a>
                                    <?php
                                        if (strpos($_SERVER['REQUEST_URI'],'adminMaintenance')) {
                                            ?>
                                                <ul style="list-style-type: none;">
                                                    <li><a href="#" id="addMain">Agregar</a></li>
                                                    <li><a href="#" id="delMain">Eliminar</a></li>
                                                    <li><a href="#" id="updMain">Actualizar</a></li>
                                                    <li><a href="#" id="reporte1">Reporte de Mantenimiento</a></li>
                                                </ul>
                                            <?php
                                        }
                                    ?>
                                </li>
                            <?php
                            break;
                        }
                        case 5:{
                            ?>
                                <li>
                                    <a href="adminVehiculos.php">Vehiculos</a>
                                    <?php
                                        if (strpos($_SERVER['REQUEST_URI'],'adminVehiculos')) {
                                            ?>
                                                <ul style="list-style-type: none;">
                                                    <li><a href="#" id="addVehi">Agregar</a></li>
                                                    <li><a href="#" id="delVehi">Eliminar</a></li>
                                                    <li><a href="#" id="updVehi">Actualizar</a></li>
                                                </ul>
                                            <?php
                                        }
                                    ?>
                                </li>
                            <?php
                            break;
                        }
                        case 4:{
                            ?>
                                <li>
                                    <a href="adminRutas.php">Rutas</a>
                                    <?php
                                        if (strpos($_SERVER['REQUEST_URI'],'adminRutas')) {
                                            ?>
                                                <ul style="list-style-type: none;">
                                                    <li><a href="#" id="addRuta">Agregar</a></li>
                                                    <li><a href="#" id="delRuta">Eliminar</a></li>
                                                    <li><a href="#" id="updRuta">Actualizar</a></li>
                                                    <li><a href="#" id="setRuta">Asignar Ruta</a></li>
                                                </ul>
                                            <?php
                                        }
                                    ?>
                                </li>
                            <?php
                            break;
                        }
                        case 22:{
                            ?>
                                <li>
                                    <a href="misRutas.php">Mis Rutas</a>
                                </li>
                            <?php
                            break;
                        }
                    }
                ?>
                <li>
                    <a href="logout.php">Salir</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
      <div id="page-content-wrapper">
        <div class="container-fluid">
            <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">
                <span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>
            </a>
	<?php
}

function footer($script){
	?>
        </div>
      </div>
	</div>
	<!-- /#wrapper -->

	<!-- jQuery -->
	<script src="js/jquery.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.min.js"></script>

	<!-- Menu Toggle Script -->
	<script>
		$("#menu-toggle").click(function(e) {
		    e.preventDefault();
		    $("#wrapper").toggleClass("toggled");
		});
        <?php
            echo $script;
        ?>
	</script>
</body>

</html>

	<?php
}
?>
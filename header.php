<?php
function head($title){
	?>
		<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<title><?php echo $title; ?></title>
			<!-- CSS de Bootstrap -->
			<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
			<link href="css/tema.css" rel="stylesheet" media="screen">
		</head>
		<body>

		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.php">El divino maestro</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<form class="navbar-form navbar-right" role="search">
						<div class="form-group">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Buscar">
								<span class="input-group-btn">
									<button type="submit" class="btn btn-primary">
										<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
									</button>
								</span>
							</div>
						</div>
					</form>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="login.php">Login</a></li>
						<li><a href="logout.php">Salir</a></li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>

			<div class="container-fluid">
				<div class="col-lg-3">
					<ul class="list-group">
						<li class="list-group-item">Control de Vehiculos</li>
						<li class="list-group-item">Control de Mantenimiento</li>
						<li class="list-group-item">Control de Ruta</li>
						<li class="list-group-item">Carga de Combustible</li>
					</ul>
				</div>

				<div class="col-lg-9">
	<?php
}

function footer(){
	?>
				</div>
			</div>
			<footer class="footer">
				<div class="container">
					<p class="text-muted">El Divino Maestro, Desarrollado por Christian Marin</p>
				</div>
			</footer>

			<!-- Librería jQuery requerida por los plugins de JavaScript -->
			<script src="js/jquery.js"></script>

			<!-- Todos los plugins JavaScript de Bootstrap (también puedes
			   incluir archivos JavaScript individuales de los únicos
			   plugins que utilices) -->
			<script src="js/bootstrap.min.js"></script>
		</body>
		</html>
	<?php
}
?>
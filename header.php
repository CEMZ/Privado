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
		  <link href="css/dashboard.css" rel="stylesheet">
		  <!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
		</head>
		<body>
		  <nav class="navbar navbar-inverse navbar-fixed-top">
		      <div class="container-fluid">
		        <div class="navbar-header">
		          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		            <span class="sr-only">Toggle navigation</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		          </button>
		          <a class="navbar-brand" href="#">El Divino Maestro</a>
		        </div>
		        <div class="input-group-btn">
			        <div id="navbar" class="navbar-collapse collapse">
			          	<form class="navbar-form navbar-right">
							<input type="text" class="form-control" placeholder="Buscar...">
							<span class="input-group-btn">
								<button class="btn btn-primary" type="button">
									<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
						        </button>
						    </span>
			          	</form>
			        </div>
		        </div>
		      </div>
		    </nav>
	<?php
}

function footer(){
	?>

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
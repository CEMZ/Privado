<?php
  if(isset($_SESSION['user'])){
    header('Location: index.php');
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/ico" href="images/favicon.ico"/>
  <title>Login</title>

  <!-- CSS de Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="css/signin.css" rel="stylesheet">

  <!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
</head>
<body>
  <div class="container">
    <form class="form-signin" method="post" action="login.php">
      <h2 class="form-signin-heading">Iniciar Sesi&oacute;n</h2>
      <label for="inputEmail" class="sr-only">Usuario</label>
      <input type="text" name="user" id="inputUsuario" class="form-control" placeholder="Usuario" required autofocus>
      <label for="inputPassword" class="sr-only">Contrase&ntilde;a</label>
      <input type="password" name="pass" id="inputPassword" class="form-control" placeholder="Contrasena" required>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
      <?php
      if(isset($_GET['error'])){
        ?>
            <div class="alert alert-danger" role="alert">
              <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
              <strong>&iexcl;Ups!</strong> Algo ha salido mal, intentalo de nuevo.
            </div>
        <?php
      }
      ?>
    </form>

  </div> <!-- /container -->


  <!-- Librería jQuery requerida por los plugins de JavaScript -->
  <script src="js/jquery.js"></script>

  <!-- Todos los plugins JavaScript de Bootstrap (también puedes
       incluir archivos JavaScript individuales de los únicos
       plugins que utilices) -->
  <script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php
  require_once('header.php');
  head("El divino maestro");
?>

  <div class="col-lg-12">
      <h1>Administraci&oacute;n "El divino maestro"</h1>
      <h3>Bienvenido <strong><?php echo $_SESSION['user']; ?></strong></h3>
  </div>

<?php
  footer('');
?>
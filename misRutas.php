<?php
require_once('header.php');
require_once('Usuario.php');
require_once('Ruta.php');
require_once('RutaConductor.php');
head('Mis rutas');
?>
<div class="row">
	<?php
		if(isset($_POST['btnUpdate'])){
			$update = new RutaConductor();
			$update->set($_POST['txtRuta'], $_SESSION['id'], $_POST['txtKilometraje'], $_POST['txtDescripcion']);
			$update->id = $_POST['txtId'];
			if($update->update()){
				?>
		        <div class="alert alert-success" role="alert">
		          <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
		          El registro ha sido actualizado con &eacute;xito.
		        </div>
		      <?php
		    } else {
		      ?>
		        <div class="alert alert-danger" role="alert">
		          <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
		          Ha habido un problema al actualizar registro, contacte con el administrador.
		        </div>
		      <?php
		    }
		}

		if(!isset($_GET['ruta'])){
	?>
	<div class="col-lg-5">
		<table class="table">
			<tr>
				<th>Nombre Ruta</th>
				<th>Distancia Real</th>
				<th>Mis observaciones</th>
			</tr>
			<?php
				$rutas = new Usuario();
				$rutas->id = $_SESSION['id'];
				$misRutas = $rutas->getRutas();
				$ruta = new Ruta();
				for($x = 0; $x < count($misRutas); $x++){
					$elemento = $misRutas[$x];
					$ruta->get($elemento[1]);
					?>
						<tr>
							<td><?php echo '<a href="misRutas.php?ruta='.$elemento[0].'">'.$ruta->nombre.'</a>'; ?></td>
							<td><?php echo '<a href="misRutas.php?ruta='.$elemento[0].'">'.$elemento[3].'</a>'; ?></td>
							<td><?php echo '<a href="misRutas.php?ruta='.$elemento[0].'">'.$elemento[4].'</a>'; ?></td>
						</tr>
					<?php
				}
			?>
		</table>
	</div>
	<?php 
		} else {
			$rutaC = new RutaConductor();
			$rutaC->get($_GET['ruta']);
			$ruta = new Ruta();
			$ruta->get($rutaC->ruta);
	?>
		<div class="col-lg-5">
			<h2><?php echo $ruta->nombre; ?></h2>
			<form action="misRutas.php" method="post">
				<input type="hidden" <?php echo 'value="'.$rutaC->id.'"'; ?> name="txtId">
				<input type="hidden" <?php echo 'value="'.$rutaC->ruta.'"'; ?> name="txtRuta">
	            <div class="form-group">
	                <label for="txtKilometraje">Distancia Real</label>
	                <input type="text" <?php echo 'value="'.$rutaC->kilometraje.'"'; ?> class="form-control" id="txtKilometraje" name="txtKilometraje" placeholder="Distancia" required autofocus>
	            </div>
	            <div class="form-group">
					<label for="txtDescripcion">Descripcion</label>
					<textarea class="form-control" name="txtDescripcion" rows="8">
						<?php echo $rutaC->descripcion; ?>
					</textarea>
				</div>
				<input type="submit" class="btn btn-primary btn-block" name="btnUpdate" value="Actualizar">
				<input type="reset" class="btn btn-default btn-block" value="Cancelar">
			</form>
		</div>
	<?php
		}
	?>
</div>
<?
footer('');
?>
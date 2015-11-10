<?php
require_once('header.php');
require_once('Usuario.php');
require_once('Ruta.php');
require_once('RutaConductor.php');
head('Administraci&oacute;n de Rutas');
?>
<div class="row">
	<?php
		if(isset($_POST['btnAddRuta'])){
		    $nuevo = new Ruta();
		    $nuevo->set($_POST['txtNombre'],$_POST['txtKilometraje'], $_POST['txtDescripcion']);
		    if($nuevo->create()){
		    	vitacora($_SESSION['id'], $_SESSION['user'], "add", $_SERVER['REQUEST_URI'], $_POST['txtNombre'].'.'.$_POST['txtKilometraje'].'.'.
		    $_POST['txtDescripcion']);
		      ?>
		        <div class="alert alert-success" role="alert">
		          <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
		          La ruta ha sido creado con &eacute;xito.
		        </div>
		      <?php
		    } else {
		      ?>
		        <div class="alert alert-danger" role="alert">
		          <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
		          Ha habido un problema al registrar Ruta, contacte con el administrador.
		        </div>
		      <?php
		    }
	  }
	  if(isset($_POST['btnDelRuta'])){
	      $eliminar = new Ruta();
	      if($eliminar->delete($_POST['selRuta'])){
	      	vitacora($_SESSION['id'], $_SESSION['user'], "delete", $_SERVER['REQUEST_URI'], $_POST['selRuta']);
	        ?>
	          <div class="alert alert-success" role="alert">
	            <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
	            La Ruta ha sido eliminado con &eacute;xito.
	          </div>
	        <?php
	      } else {
	        ?>
	          <div class="alert alert-danger" role="alert">
	            <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
	            Ha habido un problema al eliminar, contacte con el administrador.
	          </div>
	        <?php
	      }
	    }
	    if(isset($_POST['btnUpdRuta'])){
	    $upd = new Ruta();
	    $upd->set($_POST['txtNombre1'],$_POST['txtKilometraje1'], $_POST['txtDescripcion1']);
	    $upd->id = $_POST['txtId'];
	    if($upd->update()){ 
	    	vitacora($_SESSION['id'], $_SESSION['user'], "update", $_SERVER['REQUEST_URI'], $_POST['txtId'].'.'.$_POST['txtNombre1'].'.'.$_POST['txtKilometraje1'].'.'.$_POST['txtDescripcion1']);
	      ?>
	        <div class="alert alert-success" role="alert">
	          <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
	          La Ruta ha sido actualizado con &eacute;xito.
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
	  if(isset($_POST['btnSetRuta'])){
	  	$set = new RutaConductor();
	  	$set->set($_POST['selRuta'], $_POST['selUser'], 0, "");
	  	if($set->create()){
	  		vitacora($_SESSION['id'], $_SESSION['user'], "set", $_SERVER['REQUEST_URI'], $_POST['selRuta'].'.'.$_POST['selUser']);
	  	?>
	        <div class="alert alert-success" role="alert">
		          <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
		          La ruta ha sido asignada con &eacute;xito.
		        </div>
		      <?php
		    } else {
		      ?>
		        <div class="alert alert-danger" role="alert">
		          <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
		          Ha habido un problema al asignar Ruta, contacte con el administrador.
		        </div>
		      <?php
		    }
	  }
	?>
	<div class="col-lg-5" id="addForm" <?php if(!isset($_POST['btnSeleccion'])) { ?> style="display:block;" <?php } else { ?>
		style="display:none;" <?php } ?>>
		<form method="post" action="adminRutas.php">
			<div class="form-group">
				<label for="txtNombre">Nombre</label>
				<input type="text" class="form-control" id="txtNombre" name="txtNombre" placeholder="Nombre de la Ruta" required autofocus>
			</div>
			<div class="form-group">
				<label for="txtKilometraje">Distancia (Km)</label>
				<input type="text" class="form-control" id="txtKilometraje" name="txtKilometraje" placeholder="Distancia" required autofocus>
			</div>
			<div class="form-group">
				<label for="txtDescripcion">Descripcion</label>
				<textarea class="form-control" name="txtDescripcion" rows="8"></textarea>
			</div>
			<input type="submit" name="btnAddRuta" class="btn btn-primary btn-block" value="Agregar">
			<input type="reset" class="btn btn-default btn-block" value="Cancelar">
		</form>
	</div>
	<div class="col-lg-5" id="delForm" style="display:none;">
		<form action="adminRutas.php" method="post">
			<div class="form-group">
				<label for="selRuta">Rutas</label>
				<select id="selRuta" name="selRuta" class="form-control" required>
					<option></option>
					<?php
						$elementos = array();
						$rutas = new Ruta();
						$elementos = $rutas->getAll();
						$n = count($elementos);
						$x = 0;
						for($x = 0; $x < $n; $x++){
						echo '<option value="'.$elementos[$x]->id.'">'.$elementos[$x]->nombre.'</option>';
						}
					?>
				</select>
			</div>
			<input type="submit" name="btnDelRuta" value="Eliminar" class="btn btn-block btn-primary">
			<input type="reset" value="Cancelar" class="btn btn-block btn-default">
		</form>
	</div>
	<div class="col-lg-5" id="updForm" <?php if(!isset($_POST['btnSeleccion'])) { ?>style="display:none;" <?php } ?> >
		<form action="adminRutas.php" method="post">
			<div class="input-group">
				<select id="selRuta" name="selRuta" class="form-control" required>
						<option></option>
						<?php
							$elementos = array();
							$rutas = new Ruta();
							$elementos = $rutas->getAll();
							$n = count($elementos);
							$x = 0;
							for($x = 0; $x < $n; $x++){
							echo '<option value="'.$elementos[$x]->id.'">'.$elementos[$x]->nombre.'</option>';
							}
						?>
				</select>
				<span class="input-group-btn">
					<input type="submit" class="btn btn-default" type="button" name="btnSeleccion" value="Seleccionar"/>
				</span>
			</div>
		</form>
		<?php
			$modificar = new Ruta();
			if(isset($_POST['btnSeleccion'])){
				$modificar->get($_POST['selRuta']);
			}
		?>
		<form method="post" action="adminRutas.php">
			<input type="hidden" <?php echo 'value="'.$modificar->id.'"'; ?> name="txtId">
			<div class="form-group">
				<label for="txtNombre1">Nombre</label>
				<input type="text" <?php echo 'value="'.$modificar->nombre.'"'; ?> class="form-control" id="txtNombre1" name="txtNombre1" placeholder="Nombre de la Ruta" required autofocus>
			</div>
			<div class="form-group">
				<label for="txtKilometraje1">Distancia (Km)</label>
				<input type="text" <?php echo 'value="'.$modificar->kilometraje.'"'; ?> class="form-control" id="txtKilometraje1" name="txtKilometraje1" placeholder="Distancia" required autofocus>
			</div>
			<div class="form-group">
				<label for="txtDescripcion1">Descripcion</label>
				<textarea class="form-control" name="txtDescripcion1" rows="8"><?php echo $modificar->descripcion; ?></textarea>
			</div>
			<input type="submit" name="btnUpdRuta" class="btn btn-primary btn-block" value="Actualizar">
			<input type="reset" class="btn btn-default btn-block" value="Cancelar">
		</form>
	</div>
	<div class="col-lg-5" id="setForm" style="display:none;">
		<form action="adminRutas.php" method="post">
			<div class="form-group">
				<label for="selRuta">Rutas</label>
				<select id="selRuta" name="selRuta" class="form-control" required>
					<option></option>
					<?php
						$elementos = array();
						$rutas = new Ruta();
						$elementos = $rutas->getAll();
						$n = count($elementos);
						$x = 0;
						for($x = 0; $x < $n; $x++){
						echo '<option value="'.$elementos[$x]->id.'">'.$elementos[$x]->nombre.'</option>';
						}
					?>
				</select>
			</div>
			<div class="form-group">
                <label for="selUser">Conductor</label>
                <select id="selUser" name="selUser" class="form-control" required>
                  <option></option>
                  <?php
                    $elementos = array();
                    $usuarios = new Usuario();
                    $elementos = $usuarios->getConductores();
                    $n = count($elementos);
                    $x = 0;
                    for($x = 0; $x < $n; $x++){
                      echo '<option value="'.$elementos[$x]->id.'">'.$elementos[$x]->user.'</option>';
                    }
                  ?>
                </select>
              </div>
			<input type="submit" name="btnSetRuta" value="Asignar Ruta" class="btn btn-block btn-primary">
			<input type="reset" value="Cancelar" class="btn btn-block btn-default">
		</form>
	</div>
</div>
<?php
footer('
		$("#addRuta").click(function(){
			$("#addForm").css("display","block");
			$("#delForm").css("display","none");
			$("#updForm").css("display","none");
			$("#setForm").css("display","none");
		});
		$("#delRuta").click(function(){
			$("#addForm").css("display","none");
			$("#delForm").css("display","block");
			$("#updForm").css("display","none");
			$("#setForm").css("display","none");
		});
		$("#updRuta").click(function(){
			$("#addForm").css("display","none");
			$("#delForm").css("display","none");
			$("#updForm").css("display","block");
			$("#setForm").css("display","none");
		});
		$("#setRuta").click(function(){
			$("#addForm").css("display","none");
			$("#delForm").css("display","none");
			$("#updForm").css("display","none");
			$("#setForm").css("display","block");
		});
	');
?>
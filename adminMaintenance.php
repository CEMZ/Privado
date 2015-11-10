<?php
require_once('header.php');
require_once('Mantenimiento.php');
require_once('Vehiculo.php');
head('Mantenimiento de Veh&iacute;culos');
?>
<div class="row">
<?php
  if(isset($_POST['btnAddMain'])){
    $nuevo = new Mantenimiento();
    $nuevo->set($_POST['txtFactura'],$_POST['txtProveedor'],
    $_POST['txtFecha'],$_POST['txtMonto'],
    $_POST['txtDescripcion'],$_POST['selVehi'],
    $_POST['selTipo']);
    if($nuevo->create()){
    	vitacora($_SESSION['id'], $_SESSION['user'], "add", $_SERVER['REQUEST_URI'], $_POST['txtFactura'].'.'.$_POST['txtProveedor'].'.'.
    $_POST['txtFecha'].'.'.$_POST['txtMonto'].'.'.
    $_POST['txtDescripcion'].'.'.$_POST['selVehi'].'.'.
    $_POST['selTipo']);
      ?>
        <div class="alert alert-success" role="alert">
          <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
          El registro ha sido creado con &eacute;xito.
        </div>
      <?php
    } else {
      ?>
        <div class="alert alert-danger" role="alert">
          <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
          Ha habido un problema al registrar reparaci&oacute;n, contacte con el administrador.
        </div>
      <?php
    }
  }
  if(isset($_POST['btnDelMain'])){
      $eliminar = new Mantenimiento();
      if($eliminar->delete($_POST['selMain'])){
      	vitacora($_SESSION['id'], $_SESSION['user'], "delete", $_SERVER['REQUEST_URI'], $_POST['selMain']);
        ?>
          <div class="alert alert-success" role="alert">
            <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
            El registro ha sido eliminado con &eacute;xito.
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
    if(isset($_POST['btnUpdMain'])){
    $nuevo = new Mantenimiento();
    $nuevo->set($_POST['txtFactura1'],$_POST['txtProveedor1'],
    $_POST['txtFecha1'],$_POST['txtMonto1'],
    $_POST['txtDescripcion1'],$_POST['selVehi1'],
    $_POST['selTipo1']);
    $nuevo->id = $_POST['txtId'];
    if($nuevo->update()){ 
    	vitacora($_SESSION['id'], $_SESSION['user'], "update", $_SERVER['REQUEST_URI'], $_POST['txtId'].'.'.$_POST['txtFactura1'].'.'.$_POST['txtProveedor1'].'.'.
    $_POST['txtFecha1'].'.'.$_POST['txtMonto1'].'.'.
    $_POST['txtDescripcion1'].'.'.$_POST['selVehi1'].'.'.
    $_POST['selTipo1']);
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
?>
	<div class="col-lg-5" id="addForm" <?php if(!isset($_POST['btnSeleccion']) && !isset($_POST['btnFiltro'])) { ?> style="display:block;" <?php } else { ?>
	style="display:none;" <?php } ?>>
		<form method="post" acction="adminMaintenance.php">
			<div class="form-group">
				<label for="txtFactura">Factura</label>
				<input type="text" class="form-control" id="txtFactura" name="txtFactura" placeholder="# de Factura" required autofocus>
			</div>
			<div class="form-group">
				<label for="txtProveedor">Proveedor</label>
				<input type="text" class="form-control" id="txtProveedor" name="txtProveedor" placeholder="Nombre de Proveedor (MAYUSCULAS)" required autofocus>
			</div>
			<div class="form-group">
				<label for="txtFecha">Fecha de reparaci&oacute;n</label>
				<input type="text" class="form-control" id="txtFecha" name="txtFecha" placeholder="Fecha" required autofocus>
			</div>
			<div class="form-group">
				<label for="txtMonto">Mondo de reparaci&oacute;n</label>
				<input type="text" class="form-control" id="txtMonto" name="txtMonto" placeholder="Monto" required autofocus>
			</div>
			<div class="form-group">
				<label for="txtDescripcion">Descripcion (de sernecesario)</label>
				<textarea class="form-control" rows="8" name="txtDescripcion"></textarea>
			</div>
			<div class="form-group">
				<label for="selVehi">Vehiculo</label>
				<select id="selVehi" name="selVehi" class="form-control" required>
					<option></option>
					<?php
						$elementos = array();
						$vehiculos = new Vehiculo();
						$elementos = $vehiculos->getAll();
						$n = count($elementos);
						$x = 0;
						for($x = 0; $x < $n; $x++){
						echo '<option value="'.$elementos[$x]->id.'">'.$elementos[$x]->placa.'</option>';
						}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="selTipo">Tipo de Mantenimiento</label>
				<select id="selTipo" name="selTipo" class="form-control" required>
					<option></option>
					<option value="Servicio Mayor">Servicio Mayor</option>
					<option value="Servicio Menor">Servicio Menor</option>
				</select>
				<p class="help-block">Para agregar m&aacute;s tipos de mantenimiento contacte con el administrador.</p>
			</div>
			<input type="submit" name="btnAddMain" value="Agregar" class="btn btn-block btn-primary">
			<input type="reset" value="Cancelar" class="btn btn-block btn-default">
		</form>
	</div>
	<div class="col-lg-5" id="delForm" style="display:none;">
		<form method="post" action="adminMaintenance.php">
  			<div class="form-group">
				<label for="selMain">Entrada de Mantenimiento</label>
				<select id="selMain" name="selMain" class="form-control" required>
					<option></option>
					<?php
						$elementos = array();
						$mantenimientoss = new Mantenimiento();
						$elementos = $mantenimientoss->getAll();
						$n = count($elementos);
						$x = 0;
						for($x = 0; $x < $n; $x++){
						echo '<option value="'.$elementos[$x]->id.'">'.$elementos[$x]->factura.'</option>';
						}
					?>
				</select>
			</div>
			<input type="submit" name="btnDelMain" value="Eliminar" class="btn btn-block btn-primary">
			<input type="reset" value="Cancelar" class="btn btn-block btn-default">
		</form>
	</div>
	<div class="col-lg-5" id="updForm" <?php if(!isset($_POST['btnSeleccion'])) { ?>style="display:none;" <?php } ?> >
		<form method="post" acction="adminMaintenance.php">
			<div class="input-group">
				<select id="selMain2" name="selMain2" class="form-control" required>
				<option></option>
				<?php
					$x = 0;
					for($x = 0; $x < $n; $x++){
					echo '<option value="'.$elementos[$x]->id.'">'.$elementos[$x]->factura.'</option>';
					}
				?>
				</select>
				<span class="input-group-btn">
					<input type="submit" class="btn btn-default" type="button" name="btnSeleccion" value="Seleccionar"/>
				</span>
			</div>
		</form>
		<?php
					$modificar = new Mantenimiento();
					if(isset($_POST['btnSeleccion'])){
						$modificar->get($_POST['selMain2']);
					}
				?>
		<form method="post" acction="adminMaintenance.php">
			<input type="hidden" <?php echo 'value="'.$modificar->id.'"'; ?> name="txtId">
			<div class="form-group">
				<label for="txtFactura">Factura</label>
				<input type="text" <?php echo 'value="'.$modificar->factura.'"'; ?> class="form-control" id="txtFactura1" name="txtFactura1" placeholder="# de Factura" required autofocus>
			</div>
			<div class="form-group">
				<label for="txtProveedor">Proveedor</label>
				<input type="text" <?php echo 'value="'.$modificar->proveedor.'"'; ?> class="form-control" id="txtProveedor1" name="txtProveedor1" placeholder="Nombre de Proveedor (MAYUSCULAS)" required autofocus>
			</div>
			<div class="form-group">
				<label for="txtFecha">Fecha de reparaci&oacute;n</label>
				<input type="text" <?php echo 'value="'.$modificar->fecha.'"'; ?> class="form-control" id="txtFecha1" name="txtFecha1" placeholder="Fecha" required autofocus>
			</div>
			<div class="form-group">
				<label for="txtMonto">Mondo de reparaci&oacute;n</label>
				<input type="text" <?php echo 'value="'.$modificar->monto.'"'; ?> class="form-control" id="txtMonto1" name="txtMonto1" placeholder="Monto" required autofocus>
			</div>
			<div class="form-group">
				<label for="txtDescripcion1">Descripcion (de sernecesario)</label>
				<textarea class="form-control" rows="8" name="txtDescripcion1"><?php echo $modificar->descripcion; ?></textarea>
			</div>
			<div class="form-group">
				<label for="selVehi1">Vehiculo</label>
				<select id="selVehi1" name="selVehi1" class="form-control" required>
					<?php
						$vehiculo = new Vehiculo();
						$vehiculo->get($modificar->vehiculo);
						echo '<option value="'.$modificar->vehiculo.'">'.$vehiculo->placa.'</option>';
						$elementos = array();
						$vehiculos = new Vehiculo();
						$elementos = $vehiculos->getAll();
						$n = count($elementos);
						$x = 0;
						for($x = 0; $x < $n; $x++){
						echo '<option value="'.$elementos[$x]->id.'">'.$elementos[$x]->placa.'</option>';
						}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="selTipo1">Tipo de Mantenimiento</label>
				<select id="selTipo1" name="selTipo1" class="form-control" required>
					<option <?php echo 'value="'.$modificar->tipoMantenimiento.'"'; ?>><?php echo $modificar->tipoMantenimiento; ?></option>
					<option></option>
					<option value="Servicio Mayor">Servicio Mayor</option>
					<option value="Servicio Menor">Servicio Menor</option>
				</select>
				<p class="help-block">Para agregar m&aacute;s tipos de mantenimiento contacte con el administrador.</p>
			</div>
			<input type="submit" name="btnUpdMain" value="Actualizar" class="btn btn-block btn-primary">
			<input type="reset" value="Cancelar" class="btn btn-block btn-default">
		</form>
	</div>
	<div class="col-lg-8" id="divRep" <?php if(isset($_POST['btnFiltro'])) echo 'style="display:block;"' ?>>
		<form action="adminMaintenance.php" method="post">
			<div class="form-group">
				<label for="txtFecha1">Fecha 1</label>
				<input type="text" class="form-control" id="txtFecha1" name="txtFecha1" placeholder="Fecha 1" required autofocus>
			</div>
			<div class="form-group">
				<label for="txtFecha2">Fecha 2</label>
				<input type="text" class="form-control" id="txtFecha2" name="txtFecha2" placeholder="Fecha 2" required autofocus>
			</div>
			<input type="submit" name="btnFiltro" value="Filtrar" class="btn btn-block btn-primary">
		</form>
		<table class="table table-hover">
			<tr>
				<td>Factura</td>
				<td>Proveedor</td>
				<td>Fecha</td>
				<td>Monto</td>
				<td>Vehiculo</td>
				<td>Tipo de Mantenimiento</td>
			</tr>
		<?php
			if(isset($_POST['btnFiltro'])){
	  			$reporte = array();
	  			$main = new Mantenimiento();
	  			$reporte = $main->reporte($_POST['txtFecha1'],$_POST['txtFecha2']);
	  			$repVehiculo = new Vehiculo();
	  			for($x = 0; $x < count($reporte); $x++){
	  				$tupla = array();
	  				$tupla = $reporte[$x];
					$repVehiculo->get($tupla[4]);
					?>
						<tr>
							<td><?php echo $tupla[0]; ?></td>
							<td><?php echo $tupla[1]; ?></td>
							<td><?php echo $tupla[2]; ?></td>
							<td><?php echo $tupla[3]; ?></td>
							<td><?php echo $repVehiculo->placa; ?></td>
							<td><?php echo $tupla[5]; ?></td>
						</tr>
					<?php
	  			}
	  		}
		?>
	</div>
</div>
<?php
footer('
		$("#addMain").click(function(){
			$("#addForm").css("display","block");
			$("#delForm").css("display","none");
			$("#updForm").css("display","none");
			$("#divRep").css("display","none");
		});
		$("#delMain").click(function(){
			$("#addForm").css("display","none");
			$("#delForm").css("display","block");
			$("#updForm").css("display","none");
			$("#divRep").css("display","none");
		});
		$("#updMain").click(function(){
			$("#addForm").css("display","none");
			$("#delForm").css("display","none");
			$("#updForm").css("display","block");
			$("#divRep").css("display","none");
		});
		$("#reporte1").click(function(){
			$("#addForm").css("display","none");
			$("#delForm").css("display","none");
			$("#updForm").css("display","none");
			$("#divRep").css("display","block");
		});
    ');
?>
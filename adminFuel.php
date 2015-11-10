<?php
require_once('header.php');
require_once('Vehiculo.php');
require_once('Combustible.php');
head('Administraci&oacute;n de Combustible');
?>
	<div class="row">
		<?php
              if(isset($_POST['btnAddFuel'])){
                $nuevo = new Combustible();
                $nuevo->set($_POST['txtKinicial'],$_POST['txtCantidad'],
                $_POST['txtPrecio'],$_POST['txtTipo'],
                $_POST['txtFactura'],$_POST['txtProveedor'],
                $_POST['selVehi']);
                if($nuevo->create()){
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
                      Ha habido un problema al registrar compra, contacte con el administrador.
                    </div>
                  <?php
                }
              }
              if(isset($_POST['btnDelFuel'])){
                  $eliminar = new Combustible();
                  if($eliminar->delete($_POST['selFuel'])){
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
                if(isset($_POST['btnUpdFuel'])){
                $nuevo = new Combustible();
                $nuevo->set($_POST['txtKinicial1'],$_POST['txtCantidad1'],
                $_POST['txtPrecio1'],$_POST['txtTipo1'],
                $_POST['txtFactura1'],$_POST['txtProveedor1'],
                $_POST['selVehi1']);
                $nuevo->id = $_POST['txtId'];
                if($nuevo->update()){ 
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
            <div class="col-lg-5" id="addForm" <?php if(!isset($_POST['btnSeleccion'])) {
				?> style="display:display;" <?php 
				}
				else {
				?>
				style="display:none;"
				<?php
				}
				?> >
            	<form method="post" action="adminFuel.php">
					<div class="form-group">
						<label for="txtKinicial">Kilometraje Inicial</label>
						<input type="text" class="form-control" id="txtKinicial" name="txtKinicial" placeholder="Kilometraje inicial" required autofocus>
					</div>
					<div class="form-group">
						<label for="txtCantidad">Cantidad</label>
						<input type="text" class="form-control" id="txtCantidad" name="txtCantidad" placeholder="Cantidad" required autofocus>
					</div>
					<div class="form-group">
						<label for="txtPrecio">Precio</label>
						<input type="text" class="form-control" id="txtPrecio" name="txtPrecio" placeholder="Precio" required autofocus>
					</div>
					<div class="form-group">
						<label for="txtTipo">Tipo</label>
						<input type="text" class="form-control" id="txtTipo" name="txtTipo" placeholder="Tipo (MAYUSCULAS)" required autofocus>
					</div>
					<div class="form-group">
						<label for="txtFactura">Factura</label>
						<input type="text" class="form-control" id="txtFactura" name="txtFactura" placeholder="Factura" required autofocus>
					</div>
					<div class="form-group">
						<label for="txtProveedor">Proveedor</label>
						<input type="text" class="form-control" id="txtProveedor" name="txtProveedor" placeholder="Proveedor (MAYUSCULAS)" required autofocus>
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
					<input type="submit" name="btnAddFuel" value="Agregar" class="btn btn-block btn-primary">
					<input type="reset" value="Cancelar" class="btn btn-block btn-default">
				</form>
          	</div>
          	<div id="delForm" class="col-lg-5" style="display:none;">
          		<form method="post" action="adminFuel.php">
          			<div class="form-group">
						<label for="selFuel">Entrada de Combustible</label>
						<select id="selFuel" name="selFuel" class="form-control" required>
							<option></option>
							<?php
								$elementos = array();
								$combustibles = new Combustible();
								$elementos = $combustibles->getAll();
								$n = count($elementos);
								$x = 0;
								for($x = 0; $x < $n; $x++){
								echo '<option value="'.$elementos[$x]->id.'">'.$elementos[$x]->factura.'</option>';
								}
							?>
						</select>
					</div>
					<input type="submit" name="btnDelFuel" value="Eliminar" class="btn btn-block btn-primary">
					<input type="reset" value="Cancelar" class="btn btn-block btn-default">
				</form>
          	</div>
          	<div class="col-lg-5" id="updForm" <?php if(!isset($_POST['btnSeleccion'])) { ?>style="display:none;" <?php } ?> >
				<form method="post" action="adminFuel.php">
					<label for="selFuel1">Seleccionar entrada de Combustible</label>
					<div class="input-group">
						<select id="selFuel1" name="selFuel1" class="form-control" required>
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
					$modificar = new Combustible();
					if(isset($_POST['btnSeleccion'])){
						$modificar->get($_POST['selFuel1']);
					}
				?>
            	<form method="post" action="adminFuel.php">
            		<input type="hidden" <?php echo 'value="'.$modificar->id.'"'; ?> name="txtId">
					<div class="form-group">
						<label for="txtKinicial">Kilometraje Inicial</label>
						<input type="text" <?php echo 'value="'.$modificar->kinicial.'"'; ?> class="form-control" id="txtKinicial" name="txtKinicial1" placeholder="Kilometraje inicial" required autofocus>
					</div>
					<div class="form-group">
						<label for="txtCantidad">Cantidad</label>
						<input type="text" <?php echo 'value="'.$modificar->cantidad.'"'; ?> class="form-control" id="txtCantidad" name="txtCantidad1" placeholder="Cantidad" required autofocus>
					</div>
					<div class="form-group">
						<label for="txtPrecio">Precio</label>
						<input type="text" <?php echo 'value="'.$modificar->precio.'"'; ?> class="form-control" id="txtPrecio" name="txtPrecio1" placeholder="Precio" required autofocus>
					</div>
					<div class="form-group">
						<label for="txtTipo">Tipo</label>
						<input type="text" <?php echo 'value="'.$modificar->tipo.'"'; ?> class="form-control" id="txtTipo" name="txtTipo1" placeholder="Tipo (MAYUSCULAS)" required autofocus>
					</div>
					<div class="form-group">
						<label for="txtFactura">Factura</label>
						<input type="text" <?php echo 'value="'.$modificar->factura.'"'; ?> class="form-control" id="txtFactura" name="txtFactura1" placeholder="Factura" required autofocus>
					</div>
					<div class="form-group">
						<label for="txtProveedor">Proveedor</label>
						<input type="text" <?php echo 'value="'.$modificar->proveedor.'"'; ?> class="form-control" id="txtProveedor" name="txtProveedor1" placeholder="Proveedor (MAYUSCULAS)" required autofocus>
					</div>
					<div class="form-group">
						<label for="selVehi">Vehiculo</label>
						<select id="selVehi" name="selVehi1" class="form-control" required>
							<?php
								if($_POST['btnSeleccion']){
									$vehiculo = new Vehiculo();
									$vehiculo->get($modificar->vehiculo);
							?>
							<option <?php echo 'value="'.$vehiculo->id.'"'; ?>><?php echo $vehiculo->placa; ?></option>
							<?php } ?>
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
					<input type="submit" name="btnUpdFuel" value="Actualizar" class="btn btn-block btn-primary">
					<input type="reset" value="Cancelar" class="btn btn-block btn-default">
				</form>
          	</div>
          	<div id="divRep" class="col-lg-5" style="display:none;">
          		<table class="table table-hover">
          			<tr>
          				<td>Veh&iacute;culo</td>
          				<td>Promedio</td>
          			</tr>
          		<?php
          			$reporte = array();
          			$combustible = new Combustible();
          			$reporte = $combustible->reporte();
          			$repVehiculo = new Vehiculo();
          			for($x = 0; $x < count($reporte); $x++){
          				$tupla = array();
          				$tupla = $reporte[$x];
          				if($tupla[0] == $tupla[1]){
          					$repVehiculo->get($tupla[0]);
          					echo '<tr><td>'.$repVehiculo->placa.'</td><td>'.$tupla[2].'</td></tr>';
          				}
          			}
          		?>
          		</table>
          	</div>
	</div>
<?php
footer('
		$("#addFuel").click(function(){
			$("#addForm").css("display","block");
			$("#delForm").css("display","none");
			$("#updForm").css("display","none");
			$("#divRep").css("display","none");
		});
		$("#delFuel").click(function(){
			$("#addForm").css("display","none");
			$("#delForm").css("display","block");
			$("#updForm").css("display","none");
			$("#divRep").css("display","none");
		});
		$("#updFuel").click(function(){
			$("#addForm").css("display","none");
			$("#delForm").css("display","none");
			$("#updForm").css("display","block");
			$("#divRep").css("display","none");
		});
		$("#reporte2").click(function(){
			$("#addForm").css("display","none");
			$("#delForm").css("display","none");
			$("#updForm").css("display","none");
			$("#divRep").css("display","block");
		});
    ');
?>
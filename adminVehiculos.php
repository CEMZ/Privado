<?php
require_once('header.php');
require_once('Vehiculo.php');
head('Administracion de Veh&iacute;culos');
?>
  <div class="row">
    <?php
      if(isset($_POST['btnAddVehi'])){
        $nuevo = new Vehiculo();
        $nuevo->set($_POST['txtPlaca'], $_POST['txtKilometraje'], $_POST['txtSerie'],
              $_POST['txtMotor'], $_POST['txtAnio'], $_POST['txtColor'], $_POST['txtMarca']);
        if($nuevo->create()){
          ?>
            <div class="alert alert-success" role="alert">
              <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
              El Veh&iacute;culo ha sido creado con &eacute;xito.
            </div>
          <?php
        } else {
          ?>
            <div class="alert alert-danger" role="alert">
              <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
              Ha habido un problema al crear el Veh&iacue;culo, contacte con el administrador.
            </div>
          <?php
        }
      }
      if(isset($_POST['btnDelVehi'])){
        $eliminar = new Vehiculo();
        if($eliminar->delete($_POST['selVehi'])){
          ?>
            <div class="alert alert-success" role="alert">
              <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
              El Veh&iacute;culo ha sido eliminado con &eacute;xito.
            </div>
          <?php
        } else {
          ?>
            <div class="alert alert-danger" role="alert">
              <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
              Ha habido un problema al eliminar el Veh&iacue;culo, contacte con el administrador.
            </div>
          <?php
        }
      }
      if(isset($_POST['btnUpdVehi'])){
        $nuevo = new Vehiculo();
        $nuevo->set($_POST['txtPlaca1'], $_POST['txtKilometraje1'], $_POST['txtSerie1'],
              $_POST['txtMotor1'], $_POST['txtAnio1'], $_POST['txtColor1'], $_POST['txtMarca1']);
        $nuevo->id = $_POST['txtId'];
        if($nuevo->update()){
          ?>
            <div class="alert alert-success" role="alert">
              <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
              El Veh&iacute;culo ha sido actualizado con &eacute;xito.
            </div>
          <?php
        } else {
          ?>
            <div class="alert alert-danger" role="alert">
              <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
              Ha habido un problema al actualizar el Veh&iacue;culo, contacte con el administrador.
            </div>
          <?php
        }
      }
    ?>
    <div class="col-lg-5" id="addForm" <?php if(!isset($_POST['btnSeleccion'])) { 
          ?> style="display:block" <?php }
        else {
          ?> style="display:none;" <?php
        } ?> >
      <form method="post" action="adminVehiculos.php">
        <div class="form-group">
          <label for="txtPlaca">Placa</label>
          <input type="text" class="form-control" id="txtPlaca" name="txtPlaca" placeholder="# de Placa" required autofocus>
        </div>
        <div class="form‐group">
          <label for="txtKilometraje">Kilometraje</label>
          <input type="text" class="form-control" id="txtKilometraje" name="txtKilometraje" placeholder="Kilometraje de adquisici&oacute;n" required autofocus>
        </div>
        <div class="form‐group">
          <label for="txtSerie">Serie</label>
          <input type="text" class="form-control" id="txtSerie" name="txtSerie" placeholder="# de Serie" required autofocus>
        </div>
        <div class="form‐group">
          <label for="txtMotor">Motor</label>
          <input type="text" class="form-control" id="txtMotor" name="txtMotor" placeholder="# de serie del Motor" required autofocus>
        </div>
        <div class="form‐group">
          <label for="txtAnio">Modelo</label>
          <input type="text" class="form-control" id="txtAnio" name="txtAnio" placeholder="A&ntilde;o" required autofocus>
        </div>
        <div class="form‐group">
          <label for="txtColor">Color</label>
          <input type="text" class="form-control" id="txtColor" name="txtColor" placeholder="Color" required autofocus>
        </div>
        <div class="form‐group">
          <label for="txtMarca">Marca</label>
          <input type="text" class="form-control" id="txtMarca" name="txtMarca" placeholder="Marca" required autofocus>
        </div>
        <input type="submit" value="Agregar" name="btnAddVehi" class="btn btn-primary btn-block">
        <input type="reset" value="Cancelar" class="btn btn-default btn-block">
      </form>
    </div>

    <div class="col-lg-5" id="delForm" style="display:none;">
      <form method="post" action="adminVehiculos.php">
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
              <button class="btn btn-primary btn-block" id="btnDelVehi" name="btnDelVehi">Eliminar</button>
              <input type="reset" value="Cancelar" class="btn btn-default btn-block"/>
            </form>
    </div>

    <div class="col-lg-5" id="updForm" <?php if(!isset($_POST['btnSeleccion'])) { ?>style="display:none;" <?php } ?> >
            <form method="post" action="adminVehiculos.php">
              <label for="selVehi1">Seleccionar Usuario</label>
              <div class="input-group">
                  <select id="selVehi1" name="selVehi1" class="form-control" required>
                    <option></option>
                    <?php
                      $x = 0;
                      for($x = 0; $x < $n; $x++){
                        echo '<option value="'.$elementos[$x]->id.'">'.$elementos[$x]->placa.'</option>';
                      }
                    ?>
                  </select>
                  <span class="input-group-btn">
                    <input type="submit" class="btn btn-default" type="button" name="btnSeleccion" value="Seleccionar"/>
                  </span>
              </div>
            </form>
            <?php
              $modificar = new Vehiculo();
              if(isset($_POST['btnSeleccion'])){
                $modificar->get($_POST['selVehi1']);
              }
            ?>
      <form method="post" action="adminVehiculos.php">
        <input type="hidden" <?php echo 'value="'.$modificar->id.'"'; ?> name="txtId">
        <div class="form-group">
          <label for="txtPlaca">Placa</label>
          <input type="text" <?php echo 'value="'.$modificar->placa.'"'; ?> class="form-control" id="txtPlaca" name="txtPlaca1" placeholder="# de Placa" required autofocus>
        </div>
        <div class="form‐group">
          <label for="txtKilometraje">Kilometraje</label>
          <input type="text" <?php echo 'value="'.$modificar->kilometraje.'"'; ?> class="form-control" id="txtKilometraje" name="txtKilometraje1" placeholder="Kilometraje de adquisici&oacute;n" required autofocus>
        </div>
        <div class="form‐group">
          <label for="txtSerie">Serie</label>
          <input type="text" <?php echo 'value="'.$modificar->serie.'"'; ?> class="form-control" id="txtSerie" name="txtSerie1" placeholder="# de Serie" required autofocus>
        </div>
        <div class="form‐group">
          <label for="txtMotor">Motor</label>
          <input type="text" <?php echo 'value="'.$modificar->motor.'"'; ?> class="form-control" id="txtMotor" name="txtMotor1" placeholder="# de serie del Motor" required autofocus>
        </div>
        <div class="form‐group">
          <label for="txtAnio">Modelo</label>
          <input type="text" <?php echo 'value="'.$modificar->anio.'"'; ?> class="form-control" id="txtAnio" name="txtAnio1" placeholder="A&ntilde;o" required autofocus>
        </div>
        <div class="form‐group">
          <label for="txtColor">Color</label>
          <input type="text" <?php echo 'value="'.$modificar->color.'"'; ?> class="form-control" id="txtColor" name="txtColor1" placeholder="Color" required autofocus>
        </div>
        <div class="form‐group">
          <label for="txtMarca">Marca</label>
          <input type="text" <?php echo 'value="'.$modificar->marca.'"'; ?> class="form-control" id="txtMarca" name="txtMarca1" placeholder="Marca" required autofocus>
        </div>
        <input type="submit" value="Acutalizar" name="btnUpdVehi" class="btn btn-primary btn-block">
        <input type="reset" value="Cancelar" class="btn btn-default btn-block">
      </form>
    </div>
  </div>
<?php
footer('
          $("#addVehi").click(function(){
            $("#addForm").css("display","block");
            $("#delForm").css("display","none");
            $("#updForm").css("display","none");
          });
          $("#delVehi").click(function(){
            $("#addForm").css("display","none");
            $("#delForm").css("display","block");
            $("#updForm").css("display","none");
          });
          $("#updVehi").click(function(){
            $("#addForm").css("display","none");
            $("#delForm").css("display","none");
            $("#updForm").css("display","block");
          });
    ');
?>
<?php
  require_once('header.php');
  require_once('Usuario.php');
  head("El divino maestro");
?>

        <div class="row">
          <?php
              if(isset($_POST['btnAddUser'])){
                $nuevo = new Usuario();
                $nuevo->set($_POST['txtUsuario'],$_POST['txtContrasena'],
                $_POST['txtNombre'],$_POST['txtTelefono'],
                $_POST['txtDireccion'],$_POST['txtCui'],
                $_POST['txtFecha'],$_POST['selRol']);
                if($nuevo->create()){
                  ?>
                    <div class="alert alert-success" role="alert">
                      <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
                      El usuario ha sido creado con &eacute;xito.
                    </div>
                  <?php
                } else {
                  ?>
                    <div class="alert alert-danger" role="alert">
                      <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
                      Ha habido un problema al crear usuario, contacte con el administrador.
                    </div>
                  <?php
                }
              }
              if(isset($_POST['btnDelUser'])){
                  $eliminar = new Usuario();
                  if($eliminar->delete($_POST['selUser'])){
                    ?>
                      <div class="alert alert-success" role="alert">
                        <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
                        El usuario ha sido eliminado con &eacute;xito.
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
                if(isset($_POST['btnUpdUser'])){
                $nuevo = new Usuario();
                $nuevo->set($_POST['txtUsuario1'],$_POST['txtContrasena1'],
                $_POST['txtNombre1'],$_POST['txtTelefono1'],
                $_POST['txtDireccion1'],$_POST['txtCui1'],
                $_POST['txtFecha1'],$_POST['selRol1']);
                $nuevo->id = $_POST['txtId'];
                if($nuevo->update()){ 
                  ?>
                    <div class="alert alert-success" role="alert">
                      <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
                      El usuario ha sido actualizado con &eacute;xito.
                    </div>
                  <?php
                } else {
                  ?>
                    <div class="alert alert-danger" role="alert">
                      <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
                      Ha habido un problema al actualizar usuario, contacte con el administrador.
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
            <form method="post" action="adminUsers.php">
              <div class="form-group">
                <label for="txtUsuario">Usuario</label>
                <input type="text" class="form-control" id="txtUsuario" name="txtUsuario" placeholder="Nombre de Usuario" required autofocus>
              </div>
              <div class="form-group">
                <label for="txtContrasena">Contrase&ntilde;a</label>
                <input type="password" class="form-control" id="txtContrasena" name="txtContrasena" placeholder="Contrase&ntilde;a" required>
              </div>
              <div class="form-group">
                <label for="txtNombre">Nombre:</label>
                <input type="text" class="form-control" id="txtNombre" name="txtNombre" placeholder="Nombre Completo" required>
              </div>
              <div class="form-group">
                <label for="txtTelefono">Tel&eacute;fono</label>
                <input type="text" class="form-control" id="txtTelefono" name="txtTelefono" placeholder="N&uacte;mero Telef&oacute;nico" required>
              </div>
              <div class="form-group">
                <label for="txtDireccion">Direcci&oacute;n</label>
                <input type="text" class="form-control" id="txtDireccion" name="txtDireccion" placeholder="Direcci&oacute;n Fiscal" required>
              </div>
              <div class="form-group">
                <label for="txtCui">CUI</label>
                <input type="text" class="form-control" id="txtCui" name="txtCui" placeholder="C&oacute;digo &Uacute;nico de Identificaci&oacute;n" required>
              </div>
              <div class="form-group">
                <label for="txtFecha">Fecha de Nacimiento</label>
                <input type="text" class="form-control" id="txtFecha" name="txtFecha" placeholder="Fecha de Nacimiento" required>
              </div>
              <div class="form-group">
                <label for="selRol">Rol que desempe&ntilde;a</label>
                <select id="selRol" name="selRol" class="form-control" required>
                  <option></option>
                  <option value="1">Root</option>
                  <option value="2">Encargado de Mantenimientos</option>
                  <option value="3">Encargado de Combustible</option>
                  <option value="4">Encargado de Rutas</option>
                  <option value="5">Encargado de Vehiculos</option>
                  <option value="22">Conductor</option>
                </select>
              </div>
              <button class="btn btn-primary btn-block" id="btnAddUser" name="btnAddUser">Agregar</button>
              <input type="reset" value="Cancelar" class="btn btn-default btn-block"/>
            </form>
          </div>
          <div class="col-lg-5" id="delForm" style="display:none;">
            <form method="post" action="adminUsers.php">
              <div class="form-group">
                <label for="selUser">Usuario</label>
                <select id="selUser" name="selUser" class="form-control" required>
                  <option></option>
                  <?php
                    $elementos = array();
                    $usuarios = new Usuario();
                    $elementos = $usuarios->getAll();
                    $n = count($elementos);
                    $x = 0;
                    for($x = 0; $x < $n; $x++){
                      echo '<option value="'.$elementos[$x]->id.'">'.$elementos[$x]->user.'</option>';
                    }
                  ?>
                </select>
              </div>
              <button class="btn btn-primary btn-block" id="btnDelUser" name="btnDelUser">Eliminar</button>
              <input type="reset" value="Cancelar" class="btn btn-default btn-block"/>
            </form>
          </div>
          <div class="col-lg-5" id="updForm" <?php if(!isset($_POST['btnSeleccion'])) { ?>style="display:none;" <?php } ?> >
            <form method="post" action="adminUsers.php">
              <label for="selUser1">Seleccionar Usuario</label>
              <div class="input-group">
                  <select id="selUser1" name="selUser1" class="form-control" required>
                    <option></option>
                    <?php
                      $x = 0;
                      for($x = 0; $x < $n; $x++){
                        echo '<option value="'.$elementos[$x]->id.'">'.$elementos[$x]->user.'</option>';
                      }
                    ?>
                  </select>
                  <span class="input-group-btn">
                    <input type="submit" class="btn btn-default" type="button" name="btnSeleccion" value="Seleccionar"/>
                  </span>
              </div>
            </form>
            <?php
              $modificar = new Usuario();
              if(isset($_POST['btnSeleccion'])){
                $modificar->get($_POST['selUser1']);
              }
            ?>
            <form method="post" action="adminUsers.php">
              <input type="hidden" <?php echo 'value="'.$modificar->id.'"'; ?> name="txtId">
              <div class="form-group">
                <label for="txtUsuario1">Usuario</label>
                <input type="text" <?php echo 'value="'.$modificar->user.'"'; ?> class="form-control" id="txtUsuario1" name="txtUsuario1" placeholder="Nombre de Usuario" required autofocus>
              </div>
              <div class="form-group">
                <label for="txtContrasena1">Contrase&ntilde;a</label>
                <input type="password" class="form-control" id="txtContrasena1" name="txtContrasena1" placeholder="Contrase&ntilde;a" required>
              </div>
              <div class="form-group">
                <label for="txtNombre1">Nombre:</label>
                <input type="text" <?php echo 'value="'.$modificar->nombre.'"'; ?> class="form-control" id="txtNombre1" name="txtNombre1" placeholder="Nombre Completo" required>
              </div>
              <div class="form-group">
                <label for="txtTelefon1o">Tel&eacute;fono</label>
                <input type="text" <?php echo 'value="'.$modificar->telefono.'"'; ?> class="form-control" id="txtTelefono1" name="txtTelefono1" placeholder="N&uacte;mero Telef&oacute;nico" required>
              </div>
              <div class="form-group">
                <label for="txtDireccion1">Direcci&oacute;n</label>
                <input type="text" <?php echo 'value="'.$modificar->direccion.'"'; ?> class="form-control" id="txtDireccion1" name="txtDireccion1" placeholder="Direcci&oacute;n Fiscal" required>
              </div>
              <div class="form-group">
                <label for="txtCui1">CUI</label>
                <input type="text" <?php echo 'value="'.$modificar->cui.'"'; ?> class="form-control" id="txtCui1" name="txtCui1" placeholder="C&oacute;digo &Uacute;nico de Identificaci&oacute;n" required>
              </div>
              <div class="form-group">
                <label for="txtFecha1">Fecha de Nacimiento</label>
                <input type="text" <?php echo 'value="'.$modificar->fechanac.'"'; ?> class="form-control" id="txtFecha1" name="txtFecha1" placeholder="Fecha de Nacimiento" required>
              </div>
              <div class="form-group">
                <label for="selRol1">Rol que desempe&ntilde;a</label>
                <select id="selRol1" name="selRol1" class="form-control" required>
                  <option <?php echo 'value="'.$modificar->rol.'"'; ?>>
                    <?php
                      switch ($modificar->rol) {
                        case 1: echo 'Root'; break;
                        case 2: echo 'Encargado de Mantenimientos'; break;
                        case 3: echo 'Encargado de Combustible'; break;
                        case 4: echo 'Encargado de Rutas'; break;
                        case 5: echo 'Encargado de Vehiculos'; break;
                        case 22: echo 'Conductor'; break;
                      }
                    ?>
                  </option>
                  <option value="1">Root</option>
                  <option value="2">Encargado de Mantenimientos</option>
                  <option value="3">Encargado de Combustible</option>
                  <option value="4">Encargado de Rutas</option>
                  <option value="5">Encargado de Vehiculos</option>
                  <option value="22">Conductor</option>
                </select>
              </div>
              <input type="submit" class="btn btn-primary btn-block" name="btnUpdUser" value="Actualizar"/>
              <input type="reset" value="Cancelar" class="btn btn-default btn-block"/>
            </form>
          </div>
        </div>
<?php
  footer('
          $("#addUser").click(function(){
            $("#addForm").css("display","block");
            $("#delForm").css("display","none");
            $("#updForm").css("display","none");
          });
          $("#delUser").click(function(){
            $("#addForm").css("display","none");
            $("#delForm").css("display","block");
            $("#updForm").css("display","none");
          });
          $("#updUser").click(function(){
            $("#addForm").css("display","none");
            $("#delForm").css("display","none");
            $("#updForm").css("display","block");
          });
    ');
?>
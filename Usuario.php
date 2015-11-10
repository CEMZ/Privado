<?php
class Usuario{
	var $id;
	var $user;
	var $pass;
	var $nombre;
	var $telefono;
	var $direccion;
	var $cui;
	var $fechanac;
	var $rol;

	public function getRutas(){
		$respuesta = array();
		require_once('DataBase.php');
		$data = new DataBase();
		$data->open();
		$sql = "BEGIN GETRUTASCONDUCTOR(:id, :rc); END;";
		$sent = oci_parse($data->getConn(), $sql);
		$refcur = oci_new_cursor($data->getConn());
		oci_bind_by_name($sent, ':id', $this->id);
		oci_bind_by_name($sent, ':rc', $refcur, -1, OCI_B_CURSOR);
		if(!oci_execute($sent))
			return false;
		if(!oci_execute($refcur))
			return false;
		while (($row = oci_fetch_array($refcur, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
		    $elemento = array();
		    $elemento[] = $row['ID_RUTA_CONDUCTOR'];
		    $elemento[] = $row['ID_RUTA'];
		    $elemento[] = $row['ID_CONDUCTOR'];
		    $elemento[] = $row['KILOMETRAJE'];
		    $elemento[] = $row['DESCRIPCION'];
		    $respuesta[] = $elemento;
		}
		oci_free_statement($refcur);
		$data->free($sent);
		$data->close();
		return $respuesta;
	}

	public function get($id){
		require_once('DataBase.php');
		$data = new DataBase();
		$data->open();
		$sql = "BEGIN GETUSUARIO(:p_id, :usr); END;";
		$sent = oci_parse($data->getConn(), $sql);
		$refcur = oci_new_cursor($data->getConn());
		$this->id = $id;
		oci_bind_by_name($sent, ':p_id', $this->id);
		oci_bind_by_name($sent, ':usr', $refcur, -1, OCI_B_CURSOR);
		
		if(!oci_execute($sent))
			return false;
		if(!oci_execute($refcur))
			return false;

		while (($row = oci_fetch_array($refcur, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
		    $this->user = $row['USUARIO'];
		    $this->pass = $row['CONTRASENA'];
		    $this->nombre = $row['NOMBRE'];
		    $this->telefono = $row['TELEFONO'];
		    $this->direccion = $row['DIRECCION'];
		    $this->cui = $row['CUI'];
		    $this->fechanac = $row['FECHA_NAC'];
		    $this->rol = $row['ID_ROL'];
		}
		oci_free_statement($refcur);
		$data->free($sent);
		$data->close();
		return true;
	}

	public function getAll(){
		$respuesta = array();
		require_once('DataBase.php');
		$data = new DataBase();
		$data->open();
		$sql = "BEGIN GETALLUSERS(:rc); END;";
		$sent = oci_parse($data->getConn(), $sql);
		$refcur = oci_new_cursor($data->getConn());
		oci_bind_by_name($sent, ':rc', $refcur, -1, OCI_B_CURSOR);
		if(!oci_execute($sent))
			return false;
		if(!oci_execute($refcur))
			return false;
		while (($row = oci_fetch_array($refcur, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
		    $elemento = new Usuario();
		    $elemento->id = $row['ID_USUARIO'];
		    $elemento->user = $row['USUARIO'];
		    $respuesta[] = $elemento;
		}
		oci_free_statement($refcur);
		$data->free($sent);
		$data->close();
		return $respuesta;
	}

	public function getConductores(){
		$respuesta = array();
		require_once('DataBase.php');
		$data = new DataBase();
		$data->open();
		$sql = "BEGIN GETALLCONDUCTORES(:rc); END;";
		$sent = oci_parse($data->getConn(), $sql);
		$refcur = oci_new_cursor($data->getConn());
		oci_bind_by_name($sent, ':rc', $refcur, -1, OCI_B_CURSOR);
		if(!oci_execute($sent))
			return false;
		if(!oci_execute($refcur))
			return false;
		while (($row = oci_fetch_array($refcur, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
		    $elemento = new Usuario();
		    $elemento->id = $row['ID_USUARIO'];
		    $elemento->user = $row['USUARIO'];
		    $respuesta[] = $elemento;
		}
		oci_free_statement($refcur);
		$data->free($sent);
		$data->close();
		return $respuesta;
	}

	public function Usuario(){
		$this->id = 0;
		$this->user = "";
		$this->pass = "";
		$this->nombre = "";
		$this->telefono = "";
		$this->direccion = "";
		$this->cui = "";
		$this->fechanac = "";
		$this->rol = 0;
	}

	public function set($usuario, $contrasena, $nombre, $telefono, $direccion, $cui, $fechanac, $rol){
		$this->id = 0;
		$this->user = $usuario;
		$this->pass = $contrasena;
		$this->nombre = $nombre;
		$this->telefono = $telefono;
		$this->direccion = $direccion;
		$this->cui = $cui;
		if(strpos($fechanac,'-')!==false){
			$this->fechanac = $fechanac;
		} else {
			$date = split("/", $fechanac);
			$dia = $date[0];
			$mes = "";
			$anio = $date[2];
			switch ($date[1]) {
				case 1: $mes = "JAN"; break;
				case 2: $mes = "FEB"; break;
				case 3: $mes = "MAR"; break;
				case 4: $mes = "APR"; break;
				case 5: $mes = "MAY"; break;
				case 6: $mes = "JUN"; break;
				case 7: $mes = "JUL"; break;
				case 8: $mes = "AUG"; break;
				case 9: $mes = "SEP"; break;
				case 10: $mes = "OCT"; break;
				case 11: $mes = "NOV"; break;
				case 12: $mes = "DIC"; break;
			}
			$this->fechanac = $dia."-".$mes."-".$anio;
		}
		$this->fechanac;
		$this->rol = $rol;
	}

	public function create(){
		if($this->user!="" && $this->pass!=""){
			require_once('DataBase.php');
			$data = new DataBase();
			$data->open();
			$sql = "BEGIN ADDUSUARIO(:usuario, :contrasena, :nombre, :telefono, :direccion, :cui, :fechanac, :rol); END;";
			$sent = oci_parse($data->getConn(), $sql);
			oci_bind_by_name($sent, ':usuario', $this->user);
			oci_bind_by_name($sent, ':contrasena', $this->pass);
			oci_bind_by_name($sent, ':nombre', $this->nombre);
			oci_bind_by_name($sent, ':telefono', $this->telefono);
			oci_bind_by_name($sent, ':direccion', $this->direccion);
			oci_bind_by_name($sent, ':cui', $this->cui);
			oci_bind_by_name($sent, ':fechanac', $this->fechanac);
			oci_bind_by_name($sent, ':rol', $this->rol);
			if(!oci_execute($sent))
				return false;
			$data->free($sent);
			$data->close();
			return true;
		} else {
			return false;
		}
	}

	public function update(){
		if($this->user!="" && $this->pass!="" && $this->id != 0){
			require_once('DataBase.php');
			$data = new DataBase();
			$data->open();
			$sql = "BEGIN UPDATEUSUARIO(:id, :usuario, :contrasena, :nombre, :telefono, :direccion, :cui, :fechanac, :rol); END;";
			$sent = oci_parse($data->getConn(), $sql);
			oci_bind_by_name($sent, ':id', $this->id);
			oci_bind_by_name($sent, ':usuario', $this->user);
			oci_bind_by_name($sent, ':contrasena', $this->pass);
			oci_bind_by_name($sent, ':nombre', $this->nombre);
			oci_bind_by_name($sent, ':telefono', $this->telefono);
			oci_bind_by_name($sent, ':direccion', $this->direccion);
			oci_bind_by_name($sent, ':cui', $this->cui);
			oci_bind_by_name($sent, ':fechanac', $this->fechanac);
			oci_bind_by_name($sent, ':rol', $this->rol);
			if(!oci_execute($sent))
				return false;
			$data->free($sent);
			$data->close();
			return true;
		} else {
			return false;
		}
	}

	public function delete($id){
		require_once('DataBase.php');
		$data = new DataBase();
		$data->open();
		$sql = "BEGIN DELUSUARIO(:id); END;";
		$sent = oci_parse($data->getConn(), $sql);
		oci_bind_by_name($sent, ':id', $id);
		if(!oci_execute($sent))
			return false;
		$data->free($sent);
		$data->close();
		return true;
	}
}
?>
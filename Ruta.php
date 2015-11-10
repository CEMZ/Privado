<?php
class Ruta{
	var $id;
	var $nombre;
	var $kilometraje;
	var $descripcion;
	public function Ruta(){
		$this->id = 0;
		$this->nombre = "";
		$this->kilometraje = 0;
		$this->descripcion = "";
	}

	public function set($nombre, $kilometraje, $descripcion){
		$this->nombre = $nombre;
		$this->kilometraje = $kilometraje;
		$this->descripcion = $descripcion;
	}

	public function create(){
		if($this->kilometraje>0){
			require_once('DataBase.php');
			$data = new DataBase();
			$data->open();
			$sql = "BEGIN ADDRUTA(:nombre, :kilometraje, :descripcion); END;";
			$sent = oci_parse($data->getConn(), $sql);
			oci_bind_by_name($sent, ':nombre', $this->nombre);
			oci_bind_by_name($sent, ':kilometraje', $this->kilometraje);
			oci_bind_by_name($sent, ':descripcion', $this->descripcion);
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
		if($this->kilometraje>0 && $this->descripcion!="" && $this->id!=0){
			require_once('DataBase.php');
			$data = new DataBase();
			$data->open();
			$sql = "BEGIN UPDATERUTA(:id, :nombre, :kilometraje, :descripcion); END;";
			$sent = oci_parse($data->getConn(), $sql);
			oci_bind_by_name($sent, ':id', $this->id);
			oci_bind_by_name($sent, ':nombre', $this->nombre);
			oci_bind_by_name($sent, ':kilometraje', $this->kilometraje);
			oci_bind_by_name($sent, ':descripcion', $this->descripcion);
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
		$sql = "BEGIN DELRUTA(:id); END;";
		$sent = oci_parse($data->getConn(), $sql);
		oci_bind_by_name($sent, ':id', $id);
		if(!oci_execute($sent))
			return false;
		$data->free($sent);
		$data->close();
		return true;
	}

	public function get($id){
		require_once('DataBase.php');
		$data = new DataBase();
		$data->open();
		$sql = "BEGIN GETRUTA(:id, :rc); END;";
		$sent = oci_parse($data->getConn(), $sql);
		$refcur = oci_new_cursor($data->getConn());
		$this->id = $id;
		oci_bind_by_name($sent, ':id', $this->id);
		oci_bind_by_name($sent, ':rc', $refcur, -1, OCI_B_CURSOR);
		if(!oci_execute($sent))
			return false;
		if(!oci_execute($refcur))
			return false;
		while (($row = oci_fetch_array($refcur, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
			$this->nombre = $row['NOMBRE'];
			$this->kilometraje = $row['KILOMETRAJE'];
			$this->descripcion = $row['DESCRIPCION'];
		}
		oci_free_statement($refcur);
		$data->free($sent);
		$data->close();
	}

	public function getAll(){
		$respuesta = array();
		require_once('DataBase.php');
		$data = new DataBase();
		$data->open();
		$sql = "BEGIN GETALLRUTAS(:rc); END;";
		$sent = oci_parse($data->getConn(), $sql);
		$refcur = oci_new_cursor($data->getConn());
		oci_bind_by_name($sent, ':rc', $refcur, -1, OCI_B_CURSOR);
		if(!oci_execute($sent))
			return false;
		if(!oci_execute($refcur))
			return false;
		while (($row = oci_fetch_array($refcur, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
		    $elemento = new Ruta();
		    $elemento->id = $row['ID_RUTA'];
		    $elemento->nombre = $row['NOMBRE'];
		    $respuesta[] = $elemento;
		}
		oci_free_statement($refcur);
		$data->free($sent);
		$data->close();
		return $respuesta;
	}
}
?>
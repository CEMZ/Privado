<?php
class Conductor{
	var $id;
	var $nombre;
	var $cui;
	var $direccion;
	var $telefono;
	var $fechanac;

	public function Conductor(){
		$this->id = 0;
		$this->nombre = "";
		$this->cui = "";
		$this->direccion = "";
		$this->telefono = "";
		$this->fechanac = "";
	}

	public function set($nombre, $cui, $direccion, $telefono, $fechanac){
		$this->nombre = $nombre;
		$this->cui = $cui;
		$this->direccion = $direccion;
		$this->telefono = $telefono;
		$this->fechanac = $fechana;
	}

	public function create(){
		if($this->nombre != "" && $this->cui != ""){
			require_once('DataBase.php');
			$data = new DataBase();
			$data->open();
			$sql = "BEGIN ADDCONDUCTOR(:nombre, :cui, :direccion, :telefono, :fechanac); END;";
			$sent = oci_parse($data->getConn(), $sql);
			oci_bind_by_name($sent, ':nombre', $this->nombre);
			oci_bind_by_name($sent, ':cui', $this->cui);
			oci_bind_by_name($sent, ':direccion', $this->direccion);
			oci_bind_by_name($sent, ':telefono', $this->telefono);
			oci_bind_by_name($sent, ':fechanac', $this->fechanac);
			oci_execute($sent);
			$data->free($sent);
			$data->close();
		} else {
			return false;
		}
	}

	public function delete($id){
		require_once('DataBase.php');
		$data = new DataBase();
		$data->open();
		$sql = "BEGIN DELCONDUCTOR(:id); END;";
		$sent = oci_parse($data->getConn(), $sql);
		oci_bind_by_name($sent, ':id', $id);
		oci_execute($sent);
		$data->free($sent);
		$data->close();
	}

	public function update(){
		if($this->nombre != "" && $this->cui != "" && $this->id != 0){
			require_once('DataBase.php');
			$data = new DataBase();
			$data->open();
			$sql = "BEGIN UPDATECONDUCTOR(:id, :nombre, :cui, :direccion, :telefono, :fechanac); END;";
			$sent = oci_parse($data->getConn(), $sql);
			oci_bind_by_name($sent, ':id', $this->id);
			oci_bind_by_name($sent, ':nombre', $this->nombre);
			oci_bind_by_name($sent, ':cui', $this->cui);
			oci_bind_by_name($sent, ':direccion', $this->direccion);
			oci_bind_by_name($sent, ':telefono', $this->telefono);
			oci_bind_by_name($sent, ':fechanac', $this->fechanac);
			oci_execute($sent);
			$data->free($sent);
			$data->close();
		} else {
			return false;
		}
	}

	public function get($id){
		require_once('DataBase.php');
		$data = new DataBase();
		$data->open();
		$sql = "BEGIN UPDATECONDUCTOR(:id, :nombre, :cui, :direccion, :telefono, :fechanac); END;";
		$sent = oci_parse($data->getConn(), $sql);
		$this->id = $id;
		oci_bind_by_name($sent, ':id', $id);
		oci_bind_by_name($sent, ':nombre', $this->nombre);
		oci_bind_by_name($sent, ':cui', $this->cui);
		oci_bind_by_name($sent, ':direccion', $this->direccion);
		oci_bind_by_name($sent, ':telefono', $this->telefono);
		oci_bind_by_name($sent, ':fechanac', $this->fechanac);
		oci_execute($sent);
		$data->free($sent);
		$data->close();
	}
}
?>
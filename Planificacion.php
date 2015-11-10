<?php
class Planificacion{
	var $id;
	var $nombre;
	var $distancia;
	var $ruta;
	public function Planificacion(){
		$this->id = 0;
		$this->nombre = "";
		$this->distancia = 0;
		$this->ruta = 0;
	}

	public function set($nombre, $distancia, $ruta){
		$this->nombre = $nombre;
		$this->distancia = $distancia;
		$this->ruta = $ruta;
	}

	public function create(){
		if($this->mombre!="" && $this->ruta!=""){
			require_once('DataBase.php');
			$data = new DataBase();
			$data->open();
			$sql = "BEGIN ADDPLANIFICACION(:nombre, :distancia, :ruta); END;";
			$sent = oci_parse($data->getConn(), $sql);
			oci_bind_by_name($sent, ':nombre', $this->nombre);
			oci_bind_by_name($sent, ':distancia', $this->distancia);
			oci_bind_by_name($sent, ':ruta', $this->ruta);
			oci_execute($sent);
			$data->free($sent);
			$data->close();
		} else {
			return false;
		}
	}

	public function update(){
		if($this->mombre!="" && $this->ruta!="" && $this->id!=0){
			require_once('DataBase.php');
			$data = new DataBase();
			$data->open();
			$sql = "BEGIN UPDATEPLANIFICACION(:id, :nombre, :distancia, :ruta); END;";
			$sent = oci_parse($data->getConn(), $sql);
			oci_bind_by_name($sent, ':id', $this->id);
			oci_bind_by_name($sent, ':nombre', $this->nombre);
			oci_bind_by_name($sent, ':distancia', $this->distancia);
			oci_bind_by_name($sent, ':ruta', $this->ruta);
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
		$sql = "BEGIN DELPLANIFICACION(:id); END;";
		$sent = oci_parse($data->getConn(), $sql);
		oci_bind_by_name($sent, ':id', $this->id);
		oci_execute($sent);
		$data->free($sent);
		$data->close();
	}

	public function get($id){
		require_once('DataBase.php');
		$data = new DataBase();
		$data->open();
		$sql = "BEGIN GETPLANIFICACION(:id, :nombre, :distancia, :ruta); END;";
		$sent = oci_parse($data->getConn(), $sql);
		$this->id = $id;
		oci_bind_by_name($sent, ':id', $this->id);
		oci_bind_by_name($sent, ':nombre', $this->nombre);
		oci_bind_by_name($sent, ':distancia', $this->distancia);
		oci_bind_by_name($sent, ':ruta', $this->ruta);
		oci_execute($sent);
		$data->free($sent);
		$data->close();
	}
}
?>
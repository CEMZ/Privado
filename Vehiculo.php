<?php
class Vehiculo{
	var $id;
	var $placa;
	var $kilometraje;
	var $serie;
	var $motor;
	var $anio;
	var $color;
	var $marca;
	function Vehiculo(){
		$this->id = 0;
		$this->placa = "";
		$this->kilometraje = 0;
		$this->serie = "";
		$this->motor = "";
		$this->anio = 0;
		$this->color = "";
		$this->marca = "";
	}

	function set($placa, $kilometraje, $serie, $motor, $anio, $color, $marca){
		$this->placa = $placa;
		$this->kilometraje = $kilometraje;
		$this->serie = $serie;
		$this->motor = $motor;
		$this->anio = $anio;
		$this->color = $color;
		$this->marca = $marca;
	}

	function create(){
		if($this->placa != "" && $this->serie != "" && $this->color != ""){
			require_once('DataBase.php');
			$data = new DataBase();
			$data->open();
			$sql = "BEGIN ADDVEHICULO(:placa, :kilometraje, :serie, :motor, :anio, :color, :marca); END;";
			$sent = oci_parse($data->getConn(), $sql);
			oci_bind_by_name($sent, ':placa', $this->placa);
			oci_bind_by_name($sent, ':kilometraje', $this->kilometraje);
			oci_bind_by_name($sent, ':serie', $this->serie);
			oci_bind_by_name($sent, ':motor', $this->motor);
			oci_bind_by_name($sent, ':anio', $this->anio);
			oci_bind_by_name($sent, ':color', $this->color);
			oci_bind_by_name($sent, ':marca', $this->marca);
			if(!oci_execute($sent))
				return false;
			$data->free($sent);
			$data->close();
			return true;
		} else {
			return false;
		}
	}

	function delete($id){
		require_once('DataBase.php');
		$data = new DataBase();
		$data->open();
		$sql = "BEGIN DELVEHICULO(:id); END;";
		$sent = oci_parse($data->getConn(), $sql);
		oci_bind_by_name($sent, ':id', $id);
		if(!oci_execute($sent))
			return false;
		$data->free($sent);
		$data->close();
		return true;
	}

	function update(){
		if($this->placa != "" && $this->serie != "" && $this->color != "" && $this->id != 0){
			require_once('DataBase.php');
			$data = new DataBase();
			$data->open();
			$sql = "BEGIN UPDATEVEHICULO(:id, :placa, :kilometraje, :serie, :motor, :anio, :color, :marca); END;";
			$sent = oci_parse($data->getConn(), $sql);
			oci_bind_by_name($sent, ':id', $this->id);
			oci_bind_by_name($sent, ':placa', $this->placa);
			oci_bind_by_name($sent, ':kilometraje', $this->kilometraje);
			oci_bind_by_name($sent, ':serie', $this->serie);
			oci_bind_by_name($sent, ':motor', $this->motor);
			oci_bind_by_name($sent, ':anio', $this->anio);
			oci_bind_by_name($sent, ':color', $this->color);
			oci_bind_by_name($sent, ':marca', $this->marca);
			if(!oci_execute($sent))
				return false;
			$data->free($sent);
			$data->close();
			return true;
		} else {
			return false;
		}
	}

	public function getAll(){
		$respuesta = array();
		require_once('DataBase.php');
		$data = new DataBase();
		$data->open();
		$sql = "BEGIN GETALLVEHICULOS(:rc); END;";
		$sent = oci_parse($data->getConn(), $sql);
		$refcur = oci_new_cursor($data->getConn());
		oci_bind_by_name($sent, ':rc', $refcur, -1, OCI_B_CURSOR);
		if(!oci_execute($sent))
			return null;
		if(!oci_execute($refcur))
			return null;
		while (($row = oci_fetch_array($refcur, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
		    $elemento = new Vehiculo();
		    $elemento->id = $row['ID_VEHICULO'];
		    $elemento->placa = $row['PLACA'];
		    $respuesta[] = $elemento;
		}
		oci_free_statement($refcur);
		$data->free($sent);
		$data->close();
		return $respuesta;
	}

	function get($id){
		require_once('DataBase.php');
		$data = new DataBase();
		$data->open();
		$sql = "BEGIN GETVEHICULO(:id, :rc); END;";
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
			$this->id = $row['ID_VEHICULO'];
			$this->placa = $row['PLACA'];
			$this->kilometraje = $row['KILOMETRAJE'];
			$this->serie = $row['SERIE'];
			$this->motor = $row['MOTOR'];
			$this->anio = $row['ANIO'];
			$this->color = $row['COLOR'];
			$this->marca = $row['MARCA'];
		}
		oci_free_statement($refcur);
		$data->free($sent);
		$data->close();
		return true;
	}
}
?>
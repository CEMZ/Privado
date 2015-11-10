<?php
class RutaConductor{
	var $id;
	var $ruta;
	var $conductor;
	var $kilometraje;
	var $descripcion;
	public function RutaConductor(){
		$this->id = 0;
		$this->ruta = 0;
		$this->conductor = 0;
		$this->kilometraje = 0;
		$this->descripcion = "";
	}

	public function set($ruta, $conductor, $kilometraje, $descripcion){
		$this->ruta = $ruta;
		$this->conductor = $conductor;
		$this->kilometraje = $kilometraje;
		$this->descripcion = $descripcion;
	}

	public function create(){
		if($this->ruta>0 && $this->conductor>0){
			require_once('DataBase.php');
			$data = new DataBase();
			$data->open();
			$sql = "BEGIN ADDRUTACONDUCTOR(:ruta, :conductor, :kilometraje, :descripcion); END;";
			$sent = oci_parse($data->getConn(), $sql);
			oci_bind_by_name($sent, ':ruta', $this->ruta);
			oci_bind_by_name($sent, ':conductor', $this->conductor);
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
		if($this->ruta>0 && $this->conductor>0 && $this->id != 0){
			require_once('DataBase.php');
			$data = new DataBase();
			$data->open();
			$sql = "BEGIN UPDATERUTACONDUCTOR(:id, :ruta, :conductor, :kilometraje, :descripcion); END;";
			$sent = oci_parse($data->getConn(), $sql);
			oci_bind_by_name($sent, ':id', $this->id);
			oci_bind_by_name($sent, ':ruta', $this->ruta);
			oci_bind_by_name($sent, ':conductor', $this->conductor);
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
		$sql = "BEGIN DELRUTACONDUCTOR(:id); END;";
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
		$sql = "BEGIN GETRUTACONDUCTOR(:p_id, :rc); END;";
		$sent = oci_parse($data->getConn(), $sql);
		$refcur = oci_new_cursor($data->getConn());
		$this->id = $id;
		oci_bind_by_name($sent, ':p_id', $this->id);
		oci_bind_by_name($sent, ':rc', $refcur, -1, OCI_B_CURSOR);
		
		if(!oci_execute($sent))
			return false;
		if(!oci_execute($refcur))
			return false;

		while (($row = oci_fetch_array($refcur, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
		    $this->ruta = $row['ID_RUTA'];
		    $this->conductor = $row['ID_CONDUCTOR'];
		    $this->kilometraje = $row['KILOMETRAJE'];
		    $this->descripcion = $row['DESCRIPCION'];
		}
		oci_free_statement($refcur);
		$data->free($sent);
		$data->close();
		return true;
	}
}
?>
<?php
class Combustible{
	var $id;
	var $kinicial;
	var $cantidad;
	var $precio;
	var $tipo;
	var $factura;
	var $proveedor;
	var $vehiculo;
	public function Combustible(){
		$this->id = 0;
		$this->kinicial = 0;
		$this->cantidad = 0;
		$this->precio = 0;
		$this->tipo = "";
		$this->factura = "";
		$this->proveedor = "";
		$this->vehiculo = 0;
	}

	public function set($kinicial, $cantidad, $precio, $tipo, $factura, $proveedor, $vehiculo){
		$this->kinicial = $kinicial;
		$this->cantidad = $cantidad;
		$this->precio = $precio;
		$this->tipo = $tipo;
		$this->factura = $factura;
		$this->proveedor = $proveedor;
		$this->vehiculo = $vehiculo;
	}

	public function reporte(){
		require_once('DataBase.php');
		$data = new DataBase();
		$data->open();
		$sql = "SELECT * FROM REPORTE2";
		$sent = oci_parse($data->getConn(), $sql);
		if(!oci_execute($sent))
			return null;
		$elementos = array();
		while ($row = oci_fetch_array($sent, OCI_ASSOC+OCI_RETURN_NULLS)) {
			$fila = array();
			$fila[] = $row['VEHICULO'];
			$fila[] = $row['ID_VEHICULO'];
			$fila[] = $row['R_AVG'];
			$elementos[] = $fila;
		}
		return $elementos;
	}

	public function create(){
		require_once('DataBase.php');
		$data = new DataBase();
		$data->open();
		$sql = "BEGIN ADDCOMBUSTIBLE(:kinicial, :cantidad, :precio, :tipo, :factura, :proveedor, :vehiculo); END;";
		$sent = oci_parse($data->getConn(), $sql);
		oci_bind_by_name($sent, ':kinicial', $this->kinicial);
		oci_bind_by_name($sent, ':cantidad', $this->cantidad);
		oci_bind_by_name($sent, ':precio', $this->precio);
		oci_bind_by_name($sent, ':tipo', $this->tipo);
		oci_bind_by_name($sent, ':factura', $this->factura);
		oci_bind_by_name($sent, ':proveedor', $this->proveedor);
		oci_bind_by_name($sent, ':vehiculo', $this->vehiculo);
		if(!oci_execute($sent))
			return false;
		$data->free($sent);
		$data->close();
		return true;
	}

	public function update(){
		if($this->kinicial>0 && $this->cantidad>0 && $this->id != 0){
			require_once('DataBase.php');
			$data = new DataBase();
			$data->open();
			$sql = "BEGIN UPDATECOMBUSTIBLE(:id, :kinicial, :cantidad, :precio, :tipo, :factura, :proveedor, :vehiculo); END;";
			$sent = oci_parse($data->getConn(), $sql);
			oci_bind_by_name($sent, ':id', $this->id);
			oci_bind_by_name($sent, ':kinicial', $this->kinicial);
			oci_bind_by_name($sent, ':cantidad', $this->cantidad);
			oci_bind_by_name($sent, ':precio', $this->precio);
			oci_bind_by_name($sent, ':tipo', $this->tipo);
			oci_bind_by_name($sent, ':factura', $this->factura);
			oci_bind_by_name($sent, ':proveedor', $this->proveedor);
			oci_bind_by_name($sent, ':vehiculo', $this->vehiculo);
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
		$sql = "BEGIN DELCOMBUSTIBLE(:id); END;";
		$sent = oci_parse($data->getConn(), $sql);
		oci_bind_by_name($sent, ':id', $this->id);
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
		$sql = "BEGIN GETCOMBUSTIBLE(:id, :rc); END;";
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
			$this->kinicial = $row['KINICIAL'];
			$this->cantidad = $row['CANTIDAD'];
			$this->precio = $row['PRECIO'];
			$this->tipo = $row['TIPO'];
			$this->factura = $row['FACTURA'];
			$this->proveedor = $row['PROVEEDOR'];
			$this->vehiculo = $row['ID_VEHICULO'];
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
		$sql = "BEGIN GETALLFUELS(:rc); END;";
		$sent = oci_parse($data->getConn(), $sql);
		$refcur = oci_new_cursor($data->getConn());
		oci_bind_by_name($sent, ':rc', $refcur, -1, OCI_B_CURSOR);
		if(!oci_execute($sent))
			return false;
		if(!oci_execute($refcur))
			return false;
		while (($row = oci_fetch_array($refcur, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
		    $elemento = new Combustible();
		    $elemento->id = $row['ID_COMBUSTIBLE'];
		    $elemento->factura = $row['FACTURA'];
		    $respuesta[] = $elemento;
		}
		oci_free_statement($refcur);
		$data->free($sent);
		$data->close();
		return $respuesta;
	}
}
?>
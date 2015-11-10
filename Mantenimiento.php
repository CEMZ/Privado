<?php
class Mantenimiento{
	var $id;
	var $factura;
	var $proveedor;
	var $fecha;
	var $monto;
	var $descripcion;
	var $vehiculo;
	var $tipoMantenimiento;

	public function Mantenimiento(){
		$this->id = 0;
		$this->factura = "";
		$this->proveedor = "";
		$this->fecha = "";
		$this->monto = 0;
		$this->descripcion = "";
		$this->vehiculo = 0;
		$this->tipoMantenimiento = 0;
	}

	public function set($factura, $proveedor, $fecha, $monto, $descripcion, $vehiculo, $tipoMantenimiento){
		$this->factura = $factura;
		$this->proveedor = $proveedor;
		if(strpos($fecha,'-')!==false){
			$this->fecha = $fecha;
		} else {
			$date = split("/", $fecha);
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
			$this->fecha = $dia."-".$mes."-".$anio;
		}
		$this->monto = $monto;
		$this->descripcion = $descripcion;
		$this->vehiculo = $vehiculo;
		$this->tipoMantenimiento = $tipoMantenimiento;
	}

	public function create(){
		if($this->factura!="" && $this->proveedor!=""){
			require_once('DataBase.php');
			$data = new DataBase();
			$data->open();
			$sql = "BEGIN ADDMANTENIMIENTO(:factura, :proveedor, :fecha, :monto, :descripcion, :vehiculo, :tipo); END;";
			$sent = oci_parse($data->getConn(), $sql);
			oci_bind_by_name($sent, ':factura', $this->factura);
			oci_bind_by_name($sent, ':proveedor', $this->proveedor);
			oci_bind_by_name($sent, ':fecha', $this->fecha);
			oci_bind_by_name($sent, ':monto', $this->monto);
			oci_bind_by_name($sent, ':descripcion', $this->descripcion);
			oci_bind_by_name($sent, ':vehiculo', $this->vehiculo);
			oci_bind_by_name($sent, ':tipo', $this->tipoMantenimiento);
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
		$sql = "BEGIN GETALLMANTENIMIENTOS(:rc); END;";
		$sent = oci_parse($data->getConn(), $sql);
		$refcur = oci_new_cursor($data->getConn());
		oci_bind_by_name($sent, ':rc', $refcur, -1, OCI_B_CURSOR);
		if(!oci_execute($sent))
			return false;
		if(!oci_execute($refcur))
			return false;
		while (($row = oci_fetch_array($refcur, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
		    $elemento = new Mantenimiento();
		    $elemento->id = $row['ID_MANTENIMIENTO'];
		    $elemento->factura = $row['FACTURA'];
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
		$sql = "BEGIN GETMANTENIMIENTO(:id, :rc); END;";
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
			$this->factura = $row['FACTURA'];
			$this->proveedor = $row['PROVEEDOR'];
			$this->fecha = $row['FECHA_REPARACION'];
			$this->monto = $row['MONTO_REPARACION'];
			$this->descripcion = $row['DESCRIPCION'];
			$this->vehiculo = $row['ID_VEHICULO'];
			$this->tipoMantenimiento = $row['ID_TIPO_MANTENIMIENTO'];
		}
		oci_free_statement($refcur);
		$data->free($sent);
		$data->close();
	}

	public function reporte($fecha1, $fecha2){
		require_once('DataBase.php');
		$fecha1_1 = split("/", $fecha1);
		$fecha2_1 = split("/", $fecha2);
		$fecha1 = $fecha1_1[2]."-".$fecha1_1[1]."-".$fecha1_1[0];
		$fecha2 = $fecha2_1[2]."-".$fecha2_1[1]."-".$fecha2_1[0];
		$data = new DataBase();
		$data->open();
		$sql = "SELECT * FROM MANTENIMIENTO 
						WHERE FECHA_REPARACION 
						BETWEEN to_date('$fecha1','yyyy-MM-dd')
						AND to_date('$fecha2', 'yyyy-MM-dd')
						ORDER BY MONTO_REPARACION DESC";
		$sent = oci_parse($data->getConn(), $sql);
		if(!oci_execute($sent))
			return false;
		$elementos = array();
		while ($row = oci_fetch_array($sent, OCI_ASSOC+OCI_RETURN_NULLS)) {
			$fila = array();
			$fila[] = $row['FACTURA'];
			$fila[] = $row['PROVEEDOR'];
			$fila[] = $row['FECHA_REPARACION'];
			$fila[] = $row['MONTO_REPARACION'];
			$fila[] = $row['ID_VEHICULO'];
			$fila[] = $row['ID_TIPO_MANTENIMIENTO'];
			$elementos[] = $fila;
		}
		$data->free($sent);
		return $elementos;
	}

	public function delete($id){
		require_once('DataBase.php');
		$data = new DataBase();
		$data->open();
		$sql = "BEGIN DELMANTENIMIENTO(:id); END;";
		$sent = oci_parse($data->getConn(), $sql);
		oci_bind_by_name($sent, ':id', $id);
		if(!oci_execute($sent))
			return false;
		$data->free($sent);
		$data->close();
		return true;
	}

	public function update(){
		if($this->factura!="" && $this->proveedor!="" && $this->id != 0){
			require_once('DataBase.php');
			$data = new DataBase();
			$data->open();
			$sql = "BEGIN UPDMANTENIMIENTO(:id, :factura, :proveedor, :fecha, :monto, :descripcion, :vehiculo, :tipo); END;";
			$sent = oci_parse($data->getConn(), $sql);
			oci_bind_by_name($sent, ':id', $this->id);
			oci_bind_by_name($sent, ':factura', $this->factura);
			oci_bind_by_name($sent, ':proveedor', $this->proveedor);
			oci_bind_by_name($sent, ':fecha', $this->fecha);
			oci_bind_by_name($sent, ':monto', $this->monto);
			oci_bind_by_name($sent, ':descripcion', $this->descripcion);
			oci_bind_by_name($sent, ':vehiculo', $this->vehiculo);
			oci_bind_by_name($sent, ':tipo', $this->tipoMantenimiento);
			if(!oci_execute($sent))
				return false;
			$data->free($sent);
			$data->close();
			return true;
		} else {
			return false;
		}
	}
}
?>
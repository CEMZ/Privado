<?php

class DataBase{
	var $user;
	var $pass;
	var $db;
	var $connect;

	public function DataBase(){
		$this->user = "MAESTRO";
		$this->pass = "C12e04M90z_";
		$this->db = "192.168.253.136/XE";
	}

	public function open(){
		$this->connect = oci_connect($this->user, $this->pass, $this->db);
	}

	public function close(){
		oci_close($this->connect);
	}

	public function free($stid){
		oci_free_statement($stid);
	}

	public function getConn(){
		return $this->connect;
	}
}

/*$conn = oci_connect('MAESTRO', 'C12e04M90z_', '192.168.253.135/XE');

$stid = oci_parse($conn, 'select table_name from user_tables');
oci_execute($stid);

echo "<table>\n";
while (($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "  <td>".($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;")."</td>\n";
    }
    echo "</tr>\n";
}
echo "</table>\n";*/

?>
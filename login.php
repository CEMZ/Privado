<?php
	$username = $_POST['user'];
	$password = $_POST['pass'];
	$rol = 0;
	require_once('DataBase.php');
	$data = new DataBase();
	$data -> open();
	$id = 0;
	$sql = "BEGIN LOGIN(:user, :pass, :rol, :id); END;";
	$sent = oci_parse($data->getConn(), $sql);
	oci_bind_by_name($sent, ':user', $username);
	oci_bind_by_name($sent, ':pass', $password);
	oci_bind_by_name($sent, ':rol', $rol);
	oci_bind_by_name($sent, ':id', $id);
	oci_execute($sent);
	$data->free($sent);
	$data->close();
	if($rol > 0 && $id > 0){
		session_start();
		$_SESSION['id'] = $id;
		$_SESSION['user'] = $username;
		$_SESSION['rol'] = $rol;
		header('Location: index.php');
	} else {
		header('Location: loginform.php?error=1');
	}
?>
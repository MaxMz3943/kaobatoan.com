<?php
	session_start();
	$usuario = $_SESSION['correo'];
	if (isset($_SESSION["correo"])) {
    	$archivoJson = "Practica/".$usuario."_Compras.json";
    if (file_exists($archivoJson)) {
        unlink($archivoJson);
    }
	}
	unset($_SESSION['correo']);
	unset($_SESSION['Enter']);
	session_destroy();
	header("location:index.php");
?>
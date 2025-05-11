<?php
session_start();

if(isset($_SESSION['correo'])){
    $usuario = $_SESSION['correo'];
    $nombreArchivo = "Practica/".$usuario."_Compras.json";
    
    if(file_exists($nombreArchivo)){
        $archivo = file_get_contents($nombreArchivo);
        $productos = json_decode($archivo);
        
        // Eliminar la columna del carrito de compras
        unset($productos[count($productos)-1]);
        
        // Guardar los cambios en el archivo
        file_put_contents($nombreArchivo, json_encode($productos));
        
        header("location:carrito.php");
    }else{
        header("location:carrito.php");
    }
}else{
    header("location:carrito.php");
}

?>

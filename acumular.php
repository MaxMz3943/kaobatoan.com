<?php
session_start();
if ($_POST){
    $nombre = $_POST['nombre_c'];
    $precio = $_POST['precio_c'];
    $cantidad = $_POST['existencia_c'];
    $subTotal = $precio*$cantidad;
    $fechaHora = date("F_j_Y");
    $usuario = $_SESSION['correo']; 
    $pedido = array();
    $ruta = "Practica/".$usuario."_Compras.json";
    $regresar = $_POST['regresar'];

    if (!isset($_SESSION['correo'])) {
        header("location:carrito.php");
    }
    else{

    if (file_exists($ruta)){
        $archivo = file_get_contents($ruta);
        $pedido = json_decode($archivo, true); 

        $pedido[] = array ('nombre_c' => $nombre, 'precio_c' => $precio, 
        'existencia_c' => $cantidad, 'subTotal' => $subTotal);

        $json_string = json_encode($pedido);

        $file = $ruta;
        file_put_contents($file, $json_string);
        
    }else{
        $pedido[]=array('nombre_c' => $nombre, 'precio_c' => $precio, 'existencia_c' => $cantidad, 'subTotal' => $subTotal);
        $json_string = json_encode($pedido);

        $file = $ruta;
        file_put_contents($file, $json_string);
    }

    if($regresar == 'bolsos'){
        header("location:bolsos.php");
    }
    else{
        header("location:accesorios.php");
    }
    
}
}
?>
<?php
session_start();

if (isset($_SESSION["Enter"])) {
    $fechaGuardada = $_SESSION["Enter"];
    $ahora = date("Y-n-j H:i:s");
    $tiempo_transcurrido = (strtotime($ahora) - strtotime($fechaGuardada));
    if ($tiempo_transcurrido >= 64800000) {
        header("location:cerrarSesion.php");
    } else {
        $_SESSION["ultimoAcceso"] = $ahora;
    }
}

require('fpdf/fpdf.php'); // Incluir la clase FPDF

function generatePDF($data, $usuario, $conexion)
{
    $pdf = new FPDF();
    $pdf->AddPage();

    $query = "SELECT nom_usu FROM reg_usuarios WHERE correo_usu = '$usuario'";
    $result = mysqli_query($conexion, $query);
    $row = mysqli_fetch_assoc($result);
    $nombreUsuario = $row['nom_usu'];

    $pdf->Image('admin/img/logo.jpg', 10, 10, 50);    
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(50, 10, '');
    $pdf->Ln();
    $pdf->Cell(30, 10, 'Resumen de carrito de compras');
    $pdf->Ln();
    $pdf->Cell(30, 10, $nombreUsuario);
    $pdf->Ln();
    $pdf->Cell(70, 10, 'Producto', 1);
    $pdf->Cell(35, 10, 'Precio', 1);
    $pdf->Cell(35, 10, 'Cantidad', 1);
    $pdf->Cell(35, 10, 'Subtotal', 1);
    $pdf->Ln();

    // Tabla
    $total = 0;
    $pdf->SetFont('Arial', '', 12);
    foreach ($data as $row) {
        $pdf->Cell(70, 10, $row['nombre_c'], 1);
        $pdf->Cell(35, 10, $row['precio_c'], 1);
        $pdf->Cell(35, 10, $row['existencia_c'], 1);
        $pdf->Cell(35, 10, $row['subTotal'], 1);
        $pdf->Ln();
        $total += $row['subTotal'];
    }
    $iva = $total * 0.16;
    $subtotal = $total - $iva;
    $pdf->Cell(70, 10, '', 0);
    $pdf->Cell(35, 10, '', 0);
    $pdf->Cell(35, 10, 'IVA:', 1);
    $pdf->Cell(35, 10, $iva, 1);
    $pdf->Ln();
    $pdf->Cell(70, 10, '', 0);
    $pdf->Cell(35, 10, '', 0);
    $pdf->Cell(35, 10, 'Subtotal', 1); 
    $pdf->Cell(35, 10, $subtotal, 1);
    $pdf->Ln();
    $pdf->Cell(70, 10, '', 0);
    $pdf->Cell(35, 10, '', 0);
    $pdf->Cell(35, 10, 'Total', 1);
    $pdf->Cell(35, 10, $total, 1);
    $pdf->Ln();

    $ruta = "pedidos/" . $_SESSION['correo'] . date("Ymd_His") . ".pdf";

    // Crear el directorio "pedidos" si no existe
    if (!file_exists("pedidos")) {
        mkdir("pedidos", 0777, true);
    }
    $pdf->Output($ruta, "F"); // Guardar el PDF en el servidor
    $pdf->Output($ruta, "I");
    $query = "UPDATE pedidos SET pedido = '$ruta' WHERE usuario = '$usuario'";
    mysqli_query($conexion, $query);

    mysqli_close($conexion); // Cerrar la conexión a la base de datos

    // Eliminar el carrito en JSON
    $NombreArchivo = "Practica/" . $usuario . "_Compras.json";
    if (file_exists($NombreArchivo)) {
        unlink($NombreArchivo);
    }
}

if (isset($_SESSION['correo'])) {
    $usuario = $_SESSION['correo'];

    $servername = "127.0.0.1";
    $username = "u952456098_adminKaoba";
    $password = "8ou33OFa";
    $dbname = "u952456098_kaobaBD";

    $conexion = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }
    $archivojson = "Practica/" . $usuario . "_Compras.json";
    $carrito = file_get_contents($archivojson);
    $datos = json_decode($carrito, true);

    generatePDF($datos, $usuario, $conexion); // Llamar a la función generatePDF
}
?>

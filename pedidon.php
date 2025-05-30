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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $_Nombrep = $_POST['nombre'];
    $_Apellido = $_POST['apellido'];
    $_Correo = $_POST['correo'];
    $_Pais = $_POST['pais'];
    $_Calle = $_POST['calle'];
    $_Colonia = $_POST['colonia'];
    $_Tipovivienda = $_POST['tipo_vivienda'];
    $_Codigopostal = $_POST['codigo'];
    $_Ciudad = $_POST['ciudad'];
    $_Estado = $_POST['estado'];
    $_Telefono = $_POST['telefono'];
    $fecha = date("Y/m/d");
    $rastreo = '-';

    // Verificar si el estatus es "aprobado"
    if ($_POST['estatus'] === "aprobado") {
        $conexion = mysqli_connect("127.0.0.1", "u952456098_adminKaoba", "8ou33OFa") or die("Fallo la conexión.");
        mysqli_select_db($conexion, "u952456098_kaobaBD") or die("Error encontrando la Base de Datos.");

        $consulta = "INSERT INTO `pedidos` (`fecha`, `nombre`, `apellidos`, `correo`, `pais`, `calle`, `colonia`, `tipo_vivienda`, `codigo`, `cuidad`, `estado`, `telefono`, `estatus`, `rastreo`) VALUES ('$fecha', '$_Nombrep', '$_Apellido', '$_Correo', '$_Pais', '$_Calle', '$_Colonia', '$_Tipovivienda', '$_Codigopostal', '$_Ciudad', '$_Estado', '$_Telefono', '$_POST[estatus]', '$rastreo');";

        $Resultado = mysqli_query($conexion, $consulta);

        if ($Resultado == true) {
            echo '<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php">';
        } else {
            echo '<h1 class="errordt">ERROR</h1>';
        }

        mysqli_close($conexion);
    } else {
        echo "El estatus del pedido no es aprobado. Los datos no se guardarán.";
    }
} else {
    echo "Error en POST";
}
?>

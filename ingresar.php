<?php
session_start();
if (isset($_SESSION["correo"])) {
    header("location:perfil.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_Correo = $_POST['correo'];
    $_Password = $_POST['pass'];
    $_Correo = strtolower($_Correo);

    if (strlen($_Password) < 8) {
        echo '<script>alert("La contraseña debe tener al menos 8 caracteres")</script>';
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=login.php">';
        exit; // Detener la ejecución del script si la validación falla
    }

    $conexion = mysqli_connect("127.0.0.1", "u952456098_adminKaoba", "8ou33OFa")
        or die("Fallo en la conexión.");

    mysqli_select_db($conexion, "u952456098_kaobaBD")
        or die("Error encontrando la Base de Datos.");

    // Aplicar hash SHA-256 a la contraseña ingresada
    $_PasswordHashed = hash('sha256', $_Password);

    $stmt = mysqli_prepare($conexion, "SELECT * FROM `reg_usuarios` WHERE `correo_usu`=? AND `contra_usu`=?");
    mysqli_stmt_bind_param($stmt, "ss", $_Correo, $_PasswordHashed);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION["correo"] = $_Correo;
        $_SESSION["Enter"] = date("Y-m-j H:i:s");
        header("location:index.php");
    } else {
        echo '<script>alert("Datos de usuario incorrectos")</script>';
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=login.php">';
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
}

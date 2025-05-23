<?php 
    session_start();
    if(isset($_SESSION["correo"])) {
        header("location:perfil.php");
    }
    if(isset($_SESSION["Enter"])){
        $fechaGuardada = $_SESSION["Enter"];
        $ahora = date("Y-n-j H:i:s");
        $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));
        if($tiempo_transcurrido >= 64800000) {
            header("location:cerrarSesion.php");
        }else {
        $_SESSION["ultimoAcceso"] = $ahora;
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Kaoba Toan</title>
        <STYLE>A {text-decoration: none;} </STYLE>
        <link rel="stylesheet" type="text/css" href="estilo2.css">

<div class="login-page">
    <div class="form">
        <header>
            <h1 class="tittle">KAOBA TOAN</h1>
            <h4>Registrarse</h4> 
        </header>
      
      <form action="database.php" method="post" class="login-form">
        <input type="nombre" name="nombre" placeholder="Nombre Completo" required/>
        <input type="email" name="correo" placeholder="Correo Electronico" required/>
        <input type="password" name="pass"placeholder="Contraseña" minlength="8" maxlength="15" required/>
        <button class="btn first">REGISTRAR</button>

        <p class="message"><a href="login.php"><font color="black">Iniciar Sesión</font></a></p>
        <p class="message"><a href="index.php"><font color="black">Inicio</font></a></p>
      </form>
    </div>
  </div>
  </html>
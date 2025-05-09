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
  <STYLE>A {text-decoration: none;} </STYLE>
    <head>
        <meta charset="utf-8"/>
<title>Kaoba Toan</title>
        <link rel="stylesheet" type="text/css" href="estilo2.css">
<div class="login-page">
    <div class="form">
      
        <header>
          <h1 class="tittle" data-aos="fade-up">KAOBA TOAN</h1>
          <h4 data-aos="fade-up">Iniciar Sesión</h4>     
        </header>
      
      <form action="ingresar.php" method="post" class="login-form">
        <input type="text" name="correo" class="usuariotxt" placeholder="Correo" required/>
        <input type="password" name="pass" placeholder="Contraseña" minlength="8" maxlength="15" required/>
        <button class="btn first" data-aos="fade-up">INGRESAR</button>
        <p class="ingresar"><a href="registrar.php"><font color="black">Registrarse</font></a></p>
        <p class="ingresar"><a href="index.php"><font color="black">Inicio</font></a></p>
      </form>
    </div>
  </div>
  </html>
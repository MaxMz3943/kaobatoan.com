<?php 
  session_start();
  $usuario =$_SESSION['correo'];
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
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fecha = $_POST["fecha"];

?>
<!DOCTYPE html>
<html lang="es">
    <STYLE>A {text-decoration: none;} </STYLE> 
    <head>
        <meta charset="UTF-8">
        <title>Kaoba Toan</title>
    <link rel="stylesheet" href="estilo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<STYLE>A {text-decoration: none;} </STYLE>
<link rel="stylesheet" href="estilo5.css" />
    <script src="https://www.paypal.com/sdk/js?client-id=AVase57DOxeRWw23TSGvC_nvShSgXCi2AYZnPJdUn-bt5J776_fCNDXyUCtEMXLyT4LMh5cq6WIna8d2&currency=MXN"></script>
    </head>
  
    <body> 
    
  <header class="titucaz">
  <div class="contenido">
      <div class="cabecera">
          <table width="100%"><tr>
              <td width="80%"><h1 class="tituloc" data-aos="fade-down">KAOBA TOAN</h1></td>
              <td width="5%"><a href="carrito.php"><img src="img/icon3.png" alt="Carrito de Compras" /></a></td>
              <td width="4%"><a href="buscar.php"><img src="img/icon1.png" alt="Buscar" /></a></td>
              <td width="5%"><a href="login.php"><img src="img/icon2.png" alt="Iniciar sesión" /></a></td>
          </tr></table></div>
          <div class="dl-menu-style4" data-aos="fade-down">
              <link rel="stylesheet" href="estilo4.css">
                <ul>
                  <li><a href="index.php">HOME</a></li>
                  <li><a href="bolsos.php">BOLSOS</a></li>
                  <li><a href="accesorios.php">ACCESORIOS</a></li>
                  <li><a href="informacion.php">INFORMACIÓN</a></li>
                </ul>
              </div>

          
          <br>
</div></header>
        

<div class="formPedido">
  <form action="guardarPedido.php" method="POST">
    <h3>Datos para envío</h3><br><br>
    <input type="hidden" name="fecha" value="<?php echo $fecha; ?>">
    <input type="hidden" name="total" value="<?php echo $Total; ?>">

    <div class="form-group">
    <label for="nombre">Nombre:</label><br>
    <input type="text" class="form-control" id="nombre" name="nombre" required><br>
    </div>
    <div class="form-group">
    <label for="apellido">Apellidos:</label><br>
    <input type="text" class="form-control" id="apellido" name="apellido" required><br>
    </div>
    <div class="form-group">
    <label for="correo">Correo electrónico:</label><br>
    <input type="email" class="form-control" id="correo" name="correo" required><br>
    </div>
    <div class="form-group">
    <label for="pais">País:</label><br>
    <input type="text" class="form-control" id="pais" name="pais" required><br>
    </div>
    <div class="form-group">
    <label for="calle">Calle y número de casa:</label><br>
    <input type="text" class="form-control" id="calle" name="calle" required><br>
    </div>
    <div class="form-group">
    <label for="colonia">Colonia:</label><br>
    <input type="text" class="form-control" id="colonia" name="colonia"><br>
    </div>
    <div class="form-group">
    <label for="tipo_vivienda">Tipo de vivienda:</label><br>
    <input type="text" class="form-control" id="tipo_vivienda" name="tipo_vivienda"><br>
    </div>
    <div class="form-group">
    <label for="codigo">Código postal:</label><br>
    <input type="number" class="form-control" id="codigo" name="codigo" minlength="5" required><br>
    </div>
    <div class="form-group">
    <label for="ciudad">Ciudad:</label><br>
    <input type="text" class="form-control" id="ciudad" name="ciudad" required><br>
    </div>
    <div class="form-group">
    <label for="estado">Estado:</label><br>
    <input type="text" class="form-control" id="estado" name="estado" required><br>
    </div>  
    <div class="form-group">
    <label for="telefono">Teléfono:</label><br>
    <input type="tel" class="form-control" id="telefono" name="telefono"  minlength="10" maxlength="10" required><br>
  </div>
    <button type="submit" class="btn btn-primary" name="btnEnviar">Continuar</button></div></form>
</div>
</body>

<?php
}
?>
</html>
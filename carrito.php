<?php 
    session_start();
    $usuario= $_SESSION['correo'];
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
        <?php
              if (!isset($_SESSION['correo'])) {
                echo '<br><br><h1 class="errordt">¡Inicia sesión para crear tu carrito de compras!</h1><br><br>';
                echo '<div style="text-align: center; margin-bottom: 4em;"><a class="btn btn-primary" href="login.php">Iniciar sesión</a></div>';
                }
                else{
        ?>
          
          <section id="Cuadricula">
			<table class="table" id="tablajson">
                <thead class="table-blue">

                    <th>
                        Nombre
                    </th>
                    <th>
                        Precio
                    </th>
                    <th>
                        Cantidad
                    </th>
                    <th>
                        Subtotal
                    </th>
                    <th>
                    <th style="text-align: center;"><i class="fa-regular fa-trash-can"></i></th>
                    </th>
                </thead> 
                <?php
                $NombreArchivo="Practica/".$usuario."_Compras.json";
                $Total=0;
                if(file_exists($NombreArchivo)){
                    $archivo = file_get_contents($NombreArchivo);
                    $productos = json_decode($archivo);
                    $contador=0;
                    $Total = 0; // Mover la declaración aquí

                foreach ($productos as $producto){
                    echo '<tr>';
                    echo '<td><h5>'.$producto->{'nombre_c'}.'</h5></td>';
                    echo '<td><h5>$'.$producto->{'precio_c'}.'</h5></td>';
                    echo '<td><h5>'.$producto->{'existencia_c'}.'</h5></td>';
                    echo '<td><h5>$'.$producto->{'subTotal'}.'</h5></td>';
                    echo '<td><a href="borrarCarrito.php">Eliminar</a></td></tr>';
                    
                    $Total += $producto->{'subTotal'}; // Acumular el subtotal
                    $contador++;
                    $ProductosCantidad = $producto->{'nombre_c'}." ".$producto->{'existencia_c'};
                    $listaProductos = array();
                    array_push($listaProductos, $ProductosCantidad);
                }

                }else{
                    echo '<h3 class="errordt">¡No has agregado ningun producto a tu carrito de compras!</h3><br>';
                }
                ?>
            </table>
		</section>
        <br><br>
        <div style="width: 90%; margin: 0 auto;  text-align: center;">
        <section id="Total">
            <?php
               echo '<h4>Total a pagar: $'.$Total.' MXN </h4>';
            ?>
        </section>

        <br><br>

        <div id="paypal-button-container" style="width: 100%; margin-left: 24.5% ; text-align: center;"></div>

        <div id="botonesPaypal">
            <form id="envioForm" action="compra.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="fecha" id="fecha" value="">
                <input type="submit" value="Enviar" style="background: white; color: white; border: none;">
            </form>
        </div>
        
        <div style="width: 70%; margin: 0 auto; text-align: center;">
            
        
        <script src="https://www.paypal.com/sdk/js?client-id=AVase57DOxeRWw23TSGvC_nvShSgXCi2AYZnPJdUn-bt5J776_fCNDXyUCtEMXLyT4LMh5cq6WIna8d2&currency=MXN"></script>
        <script>
            paypal.Buttons({
                createOrder: function (data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: <?php echo $Total; ?>
                            }
                        }]
                    });
                },
                onApprove: function (data, actions) {
                    actions.order.capture().then(function (detalles) {
                        var fecha = new Date().toISOString().replace(/[-:.]/g, "").replace("T", "_").split(".")[0];
                        document.getElementById("fecha").value = fecha;
                        document.getElementById("envioForm").submit();
                    });
                },
                onCancel: function (data) {
                    alert("El pago ha sido cancelado");
                    console.log(data);
                }
            }).render('#paypal-button-container');
        </script>
    </div>
    </div>

<style>
    .btn btn-primary{
        background: #8f8888;
        width: 40%;
        border: none;
    }
    .btn btn-primary:hover{
        background: #6c757d;
    }
    #tablajson{
        width: 85%;
        margin: 0 auto;
        text-align: center;
    }
    #Total{
        text-align: center;
        margin: 1em 0;
    }
    #realizarCompra{
        text-align:center;
    }
</style>

<?php
}
include("include/footer.php");
?>
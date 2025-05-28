<?php 
	session_start();
    $usuario = $_SESSION['correo'];
	if (!isset($_SESSION["correo"])) {
    header("location:login.php");
	}

    include('include/header.php');
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
 <div id="perfil"> 
     <STYLE>A {text-decoration: none;} </STYLE>
 <a href="#"><img src="img/icon2.png" alt="Perfil" id="imgPerfil"/></a>
 <h2 class="correoPerfil"><?php echo $_SESSION["correo"];?></h2><br><br><br>
 <a href="cerrarSesion.php" id="btnCerrarSesion" class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" style="text-deccoration: none; color: black;">Cerrar Sesión</a>
</div>
<?php
    $conexion = mysqli_connect("127.0.0.1", "u952456098_adminKaoba", "8ou33OFa") or die("Fallo en la conexión.");
    mysqli_select_db($conexion, "u952456098_kaobaBD") or die("Error encontrando la Base de Datos.");


    // Preparar la consulta SQL con filtro por usuario
    $sql = "SELECT id_p, usuario, fecha, pedido, estatus, rastreo FROM pedidos WHERE usuario = '$usuario'";

    // Ejecutar la consulta
    $resultado = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($resultado) > 0) {
    // Imprimir la tabla HTML con los resultados
    echo '<br><br><table class="table" id="perfilPedidos">';
    echo '<thead>';
    echo '<tr>';
    echo '<th width="10%" scope="col" style="text-align: center;">ID</th>';
    echo '<th width="10%" scope="col" style="text-align: center;">Usuario</th>';
    echo '<th width="10%" scope="col" style="text-align: center;">Fecha</th>';
    echo '<th width="10%" scope="col" style="text-align: center;">Pedido</th>';
    echo '<th width="10%" scope="col" style="text-align: center;">Estatus</th>';
    echo '<th width="10%" scope="col" style="text-align: center;">Guía de Rastreo</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    // Recorrer los resultados y mostrar cada fila en la tabla
    while ($fila = mysqli_fetch_assoc($resultado)) {
        echo '<tr>';
        echo '<td>' . $fila['id_p'] . '</td>';
        echo '<td>' . $fila['usuario'] . '</td>';
        echo '<td>' . $fila['fecha'] . '</td>';
        echo '<td><a href="' . $fila['pedido'] . '">Ver Pedido</a></td>';
        echo '<td>' . $fila['estatus'] . '</td>';
        echo '<td>' . $fila['rastreo'] . '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
} else {
    echo '<br><br>';
    // No se encontraron resultados
    echo '<h4 align="center">No se han realizado pedidos para el usuario: ' . $usuario. '</h4>';
    echo '<br><br>';
}
    echo '<br><br>';
// Cerrar la conexión a la base de datos
mysqli_close($conexion);

     include('include/footer.php');
    ?>
    <style>
        #perfilPedidos td{
            text-align: center;
        }
        #perfilPedidos{
            margin: 0 auto;
        }
        #btnCerrarSesion:hover{
            color: white !important;
        }
    </style>
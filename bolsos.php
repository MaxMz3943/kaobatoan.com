<?php
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

<h1 class="tituloProductos" style="font-size: 2em;">Bolsos</h1>
<br>
<table class="mostrarProductos" width="90%" style="margin: 0 auto; text-align: center;">
    <tr>
        <?php
        $conexion = mysqli_connect("127.0.0.1","u952456098_adminKaoba","8ou33OFa") or die("Fallo en la conexión.");
        mysqli_select_db($conexion,"u952456098_kaobaBD") or die("Error encontrando la Base de Datos.");

        $Resultado = mysqli_query($conexion, "SELECT * FROM `catalogo` WHERE `categoria_c`='bolsos';");

        $contador = 0;
        $productosPorFila = 3;

        while($row = mysqli_fetch_array($Resultado)){
            $contador++;
            ?>
            <td style="margin: 0 auto;">
                <div class="producto" style="width: 90%; margin: 0 auto;">
                    <p style="font-size: 1.3em;" class="nomProducto"><?php echo $row['nombre_c'];?></p><br>
                    <img style="max-width: 80%; max-height: 80%" src="../img/catalogo/<?php echo $row['imagen_c']; ?>"><br><br>
                    <p>$ <?php echo $row['precio_c'];?> MXN</p><br><br>
                    <?php echo '<a href="Agregar.php?id='.$row['id'].'" class="btnAgregarBolso">Detalles</a>'; ?><br>
                </div>
                <div class="espacioProducto"></div>
            </td>
            <?php
            if($contador % $productosPorFila == 0){
                echo '</tr><div class="espacioP"></div><tr><br>';
            }
        }
        echo '</tr></table><br><br>';
        mysqli_close($conexion);            
        ?>
<style>
    .btnAgregarBolso{
        padding: 0.5em 1em;
        min-width: 80%;
        background: gray;
        color: white;
        margin: 0.5em auto 2em auto;
        text-decoration: none;
        border-radius: 5%;
    }
    .btnAgregarBolso:hover{
        color: gray;
        background: white;
        border: solid gray 1px;
    }
    .espacioProducto {
        height: 3em;
    }
    .mostrarProductos tr{
        border: none;
    }

</style>

<?php
include('include/footer.php');
?>

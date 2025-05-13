<?php
session_start();
include('include/header.php');

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
?>

<div id="contenido">
    <br><h1>Búsqueda de Productos</h1><br>

    <form method="GET" action="">
        <input type="text" name="query" placeholder="Buscar productos...">
        <button type="submit">Buscar</button>
    </form>
    <br>
    <table class="mostrarProductos" width="90%" style="margin: 0 auto; text-align: center;">
        <tr>

            <?php
            // Verificar si se envió una consulta de búsqueda
            if (isset($_GET['query'])) {
                // Obtener el término de búsqueda del formulario
                $searchTerm = $_GET['query'];

                // Realizar la conexión a la base de datos
                $conexion = mysqli_connect("127.0.0.1", "u952456098_adminKaoba", "8ou33OFa", "u952456098_kaobaBD");

                // Verificar la conexión a la base de datos
                if (!$conexion) {
                    die("Error en la conexión: " . mysqli_connect_error());
                }

                // Usar una consulta preparada para evitar la inyección de SQL
                $query = "SELECT * FROM catalogo WHERE nombre_c LIKE ?";
                $stmt = mysqli_prepare($conexion, $query);

                // Verificar si la preparación de la consulta fue exitosa
                if ($stmt) {
                    // Escapar el término de búsqueda para evitar la inyección de SQL
                    $searchTerm = '%' . mysqli_real_escape_string($conexion, $searchTerm) . '%';

                    // Asociar el parámetro a la consulta preparada
                    mysqli_stmt_bind_param($stmt, "s", $searchTerm);

                    // Ejecutar la consulta preparada
                    mysqli_stmt_execute($stmt);

                    // Obtener el resultado de la consulta preparada
                    $result = mysqli_stmt_get_result($stmt);

                    // Verificar si se encontraron resultados
                    if (mysqli_num_rows($result) > 0) {
                        // Mostrar los resultados
                        $contador = 0;
                        $productosPorFila = 3;

                        while ($row = mysqli_fetch_assoc($result)) {
                            $contador++;
                            ?>
                            <td style="margin: 0 auto; max-width: 33%;">
                                <div class="producto" style="width: 90%; margin: 0 auto; ma">
                                    <p style="font-size: 1.3em;" class="nomProducto"><?php echo $row['nombre_c']; ?></p><br>
                                    <img style="max-width: 80%; max-height: 80%" src="../img/catalogo/<?php echo $row['imagen_c']; ?>"><br><br>
                                    <p>$ <?php echo $row['precio_c']; ?> MXN</p><br><br>
                                    <?php echo '<a href="Agregar.php?id=' . $row['id'] . '" class="btnAgregarBolso">Detalles</a>'; ?><br>
                                </div>
                                <div class="espacioProducto"></div>
                            </td>
                            <?php
                            if ($contador % $productosPorFila == 0) {
                                echo '</tr><div class="espacioP"></div><tr><br>';
                            }
                        }
                    } else {
                        echo "No se encontraron resultados.";
                    }

                    // Cerrar la consulta preparada
                    mysqli_stmt_close($stmt);
                } else {
                    echo "Error en la preparación de la consulta.";
                }

                // Cerrar la conexión a la base de datos
                mysqli_close($conexion);
            }
            ?>
        </tr>
    </table><br><br>
</div>

<style>
    #contenido {
        border-top: solid black 1px;
        text-align: center;
    }

    #contenido h1 {
        font-size: 2em;
    }

    #contenido button {
        padding: 0 1em;

    }

    .btnAgregarBolso {
        padding: 0.5em 1em;
        min-width: 80%;
        background: gray;
        color: white;
        margin: 0.5em auto 2em auto;
        text-decoration: none;
        border-radius: 5%;
    }

    .btnAgregarBolso:hover {
        color: gray;
        background: white;
        border: solid gray 1px;
    }

    .espacioProducto {
        height: 3em;
    }

    .mostrarProductos tr {
        border: none;
    }

</style>

<?php
include('include/footer.php');
?>

<!DOCTYPE html>
<?php
    
    include('include/header.php');
    if(isset($_SESSION["Enter"])){
        $fechaGuardada = $_SESSION["Enter"];
        $ahora = date("Y-n-j H:i:s");
        $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));
        if($tiempo_transcurrido >= 64800000) {
            session_destroy();
            header("location:index.php");
        }else {
        $_SESSION["ultimoAcceso"] = $ahora;
        }
    }
    ?>

    <h1 class="tituloProductos">Bolsos</h1>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <table class="mostrarProductos">
    <STYLE>A {text-decoration: none;} </STYLE>
	<body>
    <header class="naranja">
        <table></td>

                <td align="center" width="60%">

               

            </tr></table>
			<nav>
          
            </nav>
		</header>
		<section class="Rivers">
				<?php 
                if(isset($_GET['id'])){
                    $id=$_GET['id'];
                
                    $conexion = mysqli_connect("127.0.0.1","u952456098_adminKaoba","8ou33OFa") or die("Fallo en la conexión.");
                    mysqli_select_db($conexion,"u952456098_kaobaBD") or die("Error encontrando la Base de Datos.");

                    $Resultado = mysqli_query($conexion, "SELECT * FROM `catalogo` WHERE `id`= '".$id."';");
                while($row = mysqli_fetch_array($Resultado)){ 
                    echo '<form action="acumular.php" method="POST" name="AgregarCarrito" class="AgregarCarrito" width="90%" style="margin: 0 auto;">';
						echo '<table width="100%" style="text-align:center; margin: 0 auto;"><tr>'; 
						echo '<td width="50%"><img name="imagen_c" src="../img/catalogo/'.$row['imagen_c'].'" class="imagen_c"></td>';
						echo '<td width="50%"><input type ="text" name="nombre_c" value="'.$row['nombre_c'].'" readonly="readonly" id="nomAgregar" style="text-align:center"><br><br>';
						echo '<p name="descripcion_c" style="text-align: center;">'.$row['descripcion_c'].'</p>';
						echo '$<input type ="number" name="precio_c" id="precioAgregar" value="'.$row['precio_c'].'" readonly="readonly" style="width: 30%;"> MXN<br><br>';
						echo '<label for="cantAgregar">Cantidad: </label>';
						echo '<input type="number" name="existencia_c" min="1" max="'.$row['existencia_c'].'" value="1" id="cantAgregar" style="text-align:center; margin-left: 1em;"><br>';
                        echo '<input type="hidden" name="regresar" value="'.$row['categoria_c'].'">';
                        echo '<br><input name ="Agregar" type ="submit" id="btnagregar" value ="Agregar" class ="btn btn-outline-success" style="margin: 0.5em; border: solid #198754 1px;"></td></tr></table>';
                    echo '</form>';
                   
                }
            }else{
                echo '<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php">';
            }
                mysqli_close($conexion);
                ?>
			</table>
            <br><br>
		</section>
        <br>
        <?php 
            include('include/footer.php');
         ?>
	</body>
    <style>
        .imagen_c{
            min-width: 70%;
            max-width: 80%;
        }
        .Rivers{
            margin-bottom: 3em;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }
        #btnagregar{
            margin-top: 1em;
        }

    </style>
</html>
<!DOCTYPE html>
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

    <h1 class="tituloProductos">Accesorios</h1>
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
                    echo '<form action="acumular.php" method="POST" name="AgregarCarrito" class="AgregarCarrito">';
						echo '<table><tr>'; 
						echo '<td width="60%"><img name="imagen_c" src="../img/catalogo/'.$row['imagen_c'].'"></td>';
						echo '<td width="40%"><input type ="text" name="nombre_c" value="'.$row['nombre_c'].'" readonly="readonly" id="nomAgregar"><br><br>';
						echo '<textarea name="descripcion_c" readonly="readonly">'.$row['descripcion_c'].'</textarea><br>';
						echo '$<input type ="number" name="precio_c" id="precioAgregar" value="'.$row['precio_c'].'" readonly="readonly"> MXN<br><br>';
						echo '<label for="existencia_c">Cantidad: </label>';
						echo '<input type="number" name="existencia_c" min="1" max="'.$row['existencia_c'].'" value="1" id="cantAgregar" autofocus>';
                        echo '<input type="hidden" name="regresar" value="'.$row['categoria_c'].'">';
                        echo '<input name ="Agregar" type ="submit" id = 
                        "btnagregar" value ="Agregar" class ="btn btn-outline-success"></td></tr></table>';
                    echo '</form>';
                   
                }
            }else{
                echo '<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php">';
            }
                mysqli_close($conexion);
                ?>

                <style>
                    .AgregarCarrito #cantAgregar{
                        width: 4em;
                    }
                </style>
			</table>
		</section>
	</body>
</html>
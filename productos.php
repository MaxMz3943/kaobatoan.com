<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<STYLE>A {text-decoration: none;} </STYLE>
<link rel="stylesheet" href="estilo5.css" />
<section id="Cuadricula">
			<table class="table" id="tablajson">
                <thead class="table-dark">
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
                        SubTotal
                    </th>
                    <th>
                    <th><i class="fa-regular fa-trash-can"></i></th>
                    </th>
                </thead>
                <?php
                $NombreArchivo="Practica/".date("F_j_Y")."_Compras.json";
                $Total=0;
                if(file_exists($NombreArchivo)){
                    $archivo = file_get_contents($NombreArchivo);
                    $productos = json_decode($archivo);
                    $contador=0;
                    foreach ($productos as $producto){
                        echo '<tr><td><h3>'.$producto->{'nombre_c'}.'</h3></td>';
                        echo '<td><h3>$'.$producto->{'precio_c'}.'</h3></td>';
                        echo '<td><h3>'.$producto->{'cantidad_c'}.'</h3></td>';
                        echo '<td><h3>$'.$producto->{'subTotal'}.'</h3></td>';
                        echo '<td><a href="borrar.php">Eliminar</a></h3></td></tr>';
                        $Total=$Total+$producto->{'subTotal'};
                        $contador++;
                      
                        
                    }
                }else{
                    echo'<META HTTP-EQUIV="REFRESH" CONTENT="3;URL=Tienda3.php">';
                }
                ?>
            </table>
		</section>
        <section id="Total">
            <?php
            echo 'Total a pagar: $'. $Total;
            
            ?>
        </section>

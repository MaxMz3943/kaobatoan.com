<?php
    include('include/header.php');
    session_start();
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
        <STYLE>A {text-decoration: none;} </STYLE>
        <link rel="stylesheet" type="text/css" href="estilo.css">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <section id="contIndex1">
            <p data-aos="flip-left"><a href="bolsos.php"><font color="white">COMPRAR</font></a></p>      
        </section>  
    <td width="70%">
            <link rel="stylesheet" type="text/css" href="estilo3.css">
                <div data-aos="fade-up">
                    <div id="scroll-horizontal">
                    <ul style="list-style:none;">
                        <li>
                            <img src="img/logo.png">
                        </li>
                    </li>
                </div>
                </div>
            </td> 
        </ul>
        <td>
            <h3  data-aos="fade-up" with="30%" height="30%" class="info">Somos fabricantes de Bolsos y Artículos de 100% hechos de piel y todos nuestros productos estan cincelaos a mano. 
                Fabricados en México, disfruta nuestros productos en venta.</td></div>
                    <div data-aos="fade-up"><img  class="foto" src="img/image.png" width="20px" height="20px"></h3></div>
                        <link rel="stylesheet" type="text/css" href="estilo.css"><td width="70%">
                            <div>
                                <div class="slider" data-aos="fade-up">
                                    <ul>
                                        <li>
                                            <img src="img/imgal1.jpg">
                                        </li>
                                        <li>
                                            <img src="img/imgal2.jpg">
                                        </li>
                                        <li>
                                            <img src="img/imgal3.png">
                                        </li>
                                        <li>
                                            <img src="img/imgal4.jpg">
                                        </li>
                                    </div>
                                </td> 
                            </ul>
                            <br><br>
                            <h1 class="titulo" data-aos="fade-up">¡Belleza Unica y Artesanal!</h1>
                            <p><font color="white">.</font><p>
                            <h3  data-aos="fade-up" with="30%" height="30%" class="infoa">Nuestros productos son 100% cincelados a mano, con el objetivo de transmitir el hermoso talento mexicano a través de nuestras piezas, y satisfacer las necesidades del cliente con un trabajo único artesanal sin dejar atrás la vanguardia y tendencias.</td></div>
                            <div id="scroll-horizontal">
                            <p><font color="white">.</font><p>
                            <img data-aos="fade-up" src="img/img5index.jpg"></div>
                            <br><h1 class="text-help" data-aos="fade-up">¿Necesitas Ayuda?</h1>
                            <p><font color="white">.</font><p>
                            <div class="wrap" data-aos="fade-up">
                            <button class="button" onclick="location.href='informacion.php#contacto'">Contáctenos</button>
                            </div>

                            <p><font color="white">.</font><p>
                            
                            <div id="scroll-horizontal"><img data-aos="fade-up" src="img/cliente.png" width="60px" height="60px"></div>
                        
                          <br>
                            <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
                            <script>
                            AOS.init();
                            </script>
                        <div id="contIndex3">
                        <?php
                            include('include/footer.php');
                        ?>
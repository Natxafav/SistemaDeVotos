<?php
// session_start();

include_once('../funciones.php');

conectar();
cabecera_html();
navegar();

// $flag_entrada = $_POST["flag_entrada"];
$flag_entrada = null;

if (empty($flag_entrada) || $flag_entrada === NULL) :

?>
    <form method="post" class="form-group m-1 d-flex justify-content-center align-items-center rounded  text-center bg-light " style="width: 400px;" action='jueces.php' enctype="multipart/form-data" name="form1" id="form1">
        <input type="hidden" name="flag_entrada" value=1>
        <input type="hidden" name="sel_chef" value=0>
    </form>

    <!-- Introducir votaciones -->
    <form method="post" class="form-group m-1 row d-flex justify-content-center align-items-center  rounded bg-light" action='nuevo_voto.php' enctype="multipart/form-data" name="form1" id="form1">

        <p class="form-control-group   ">
            <label for="chef" class=" h4 mr-5 labelchef">Cocinero: </label>
            <select name="chef" class="form-control" id="chef">
                <option value=''>Seleccione...</option>

                <?php
                //      ---------Muestra en el desplegable las opciones disponibles de cocineros--------
                $desplegable = "SELECT `nombre_cocinero`,`id_cocinero` FROM `cocineros`ORDER BY `nombre_cocinero`ASC";
                $consulta = mysqli_query($conexion, $desplegable);

                while ($row = mysqli_fetch_array($consulta)) {
                    echo "<option value='" . $row['id_cocinero'] . "'>" . $row['nombre_cocinero'] . "</option>";
                }
                ?>
            </select>
        </p>
        <!-- --------Trabajamos las recetas en función de el cocinero que se selecciona------- -->

        <div class="form-control-group   mr-5" id="DivRecetas">
            <label for="recetas" class="h4 label recetas">Recetas : </label>
            <select name="recetas" id="recetas" class="form-control mr-5 ">

                <script type="text/javascript">
                    $(document).ready(function() {
                        $("#chef").on('change', function() {
                            var js_chef = $(this).val()
                            if (js_chef != '') {
                                var parametros = {
                                    'flag_entrada': 1,
                                    'chef': js_chef
                                }
                                $.ajax({
                                    type: "POST",
                                    url: 'funcion_vista.php',
                                    data: parametros,
                                    success: function(response) {
                                        $('#DivRecetas').html(response)
                                    }
                                });

                            }

                        });
                    });
                </script>
            </select>
        </div>


        <p>
            <label for="puntos_totales" class=" h4 label puntos_totales">Puntuación: </label>
            <input type="number" name="puntos_totales" class="form-control mr-5 " id="puntos_totales" min='0' max='10' required>
        </p>

        <p>
            <button type="submit" id="enviar" class="btn btn-outline-primary mx-5" value="enviar">Registrar voto</button>
        </p>

    </form>

    <hr>
    <div class="container bg-image d-flex flex-row flex-wrap border border_secondary border-rounded  text-center" style='background-image: url("https://img.freepik.com/foto-gratis/ingredientes-comida-italiana_23-2148551669.jpg?w=1380&t=st=1664963852~exp=1664964452~hmac=c744a4d7e0285d2403bd69367701814ef5f7b0bd48494b2b2fc28c57d84603e6"); background-position: center; border-radius:13px;
    background-repeat: no-repeat; background-size: cover; min-width: 95%;'>
    <?php


    require_once('mostrar_votaciones.php');
endif;


    ?>

    </div>
    </body>

    </html>
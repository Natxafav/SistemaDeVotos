<?php
// session_start();
include_once('../funciones.php');

conectar();
cabecera_html();
navegar();
?>


<div class='out d-flex flex-row justify-content-start align-items-start m-auto flex-wrap'>
    <div class=' part d-flex justify-content-start align-items-start flex-wrap container border border_secondary border-rounded  bg-light p-3 ' style='width: 26%;'>
        <h3 class="d-block p-2 align-text-center " style='width:100%;'> Ranking de cocineros</h3>
        <?php

        $array_datos = array();

        if (!$conexion) {

            echo " No hay conexión";
        } else {
            //Selecciono BBDD y tabla deseada.

            $sql_cocineros = "SELECT * FROM cocineros";
            $datos_cocineros = mysqli_query($conexion, $sql_cocineros);
            $sql_recetas = "SELECT * FROM recetas";
            $datos_recetas = mysqli_query($conexion, $sql_recetas);
            //Guardo los datos de la petición en un array.
            while ($row = mysqli_fetch_array($datos_cocineros)) {
                $array_cocineros[] = $row;
            }

            //Ordeno de forma descendente los datos según la puntuación obtenida.
            foreach ($array_cocineros as $key => $row) {
                $aux[$key] = $row['puntos_totales'];
            }
            array_multisort($aux, SORT_DESC, $array_cocineros);


            //Guardo los datos de la petición en un array.
            while ($row = mysqli_fetch_array($datos_recetas)) {
                $array_recetas[] = $row;
            }

            //Ordeno de forma descendente los datos según la puntuación obtenida.
            foreach ($array_recetas as $key => $row) {
                $aux1[$key] = $row['puntos_totales'];
            }
            array_multisort($aux1, SORT_DESC, $array_recetas);
        }
        //muestro los datos por pantalla
        foreach ($array_cocineros as $value) {
            echo "<div class='fe container bg-image p-3 m-1 border border_secondary border-rounded text-white  text-center  d-flex flex-column justify-content-center align-items-end' style='width: 100%; height:45vh; min-height:400px; background-image: url(\"$value[7]\"); background-position: center; border-radius:13px; background-repeat: no-repeat; background-size: cover;'>
             <div class=' datos  d-flex flex-column justify-content-end align-items-end' style='width: 100%; height:100%;'>
            <div class='puntos'><h4 class='p-2'  style='text-shadow:  10px 0px 10px black, -10px 0px 10px black,10px 0px 10px black'>Puntuación: $value[5]</h4></div>
            
         <h4 class='p-2 ' style='text-shadow:  10px 0px 10px black, -10px 0px 10px black,10px 0px 10px black'>$value[1]</h4> <h4  class='p-2'  style='text-shadow:  10px 00px 10px black, -10px 0px 10px black,10px 0px 10px black,10px 0px 10px black'> $value[2] </h4>  </div></div>";
        }


        mysqli_close($conexion);
        ?>
    </div>


    <div class='d-flex justify-content-between align-items-start flex-wrap container border border_secondary border-rounded  bg-light p-3 ' style='width: 75%;'>
        <div class='d-block p-2 align-items-center' style='width: 75%;'>
            <h3 class="d-block p-2 align-self-center " style='width:100%;'> Ranking de recetas</h3>
        </div>
        <?php


        foreach ($array_recetas as $value) {
            echo "<div class='container p-3 m-3  bg-image  border border_secondary border-rounded text-white  text-center ' style='width: 30%; height:45vh; min-height:400px; background-image: url(\"$value[6]\"); background-position: center; border-radius:13px;
    background-repeat: no-repeat; background-size: cover;'> 
 <h4 class='p-2 text-left' style=' text-shadow: 10px 0px 10px black, -10px 0px 10px black,10px 0px 10px black'>Receta:<br>$value[2]</h4><h4 class='p-2 text-left' style=' text-shadow: 10px 0px 10px black, -10px 0px 10px black,10px 0px 10px black'>Descripción:<br>$value[3]</h4><h4 class='p-2 text-left' style='  text-shadow:  10px 0px 10px black, -10px 0px 10px black,10px 0px 10px black'>Cocinero:<br> $value[5]</h4> <h4 class='p-2 text-left ' style=' text-shadow: 10px 0px 10px black, -10px 0px 10px black,10px 0px 10px black'>Puntuación: $value[4]</h4>  </div>";
        }

        ?>
    </div>
</div>
</div>
</body>

</html>
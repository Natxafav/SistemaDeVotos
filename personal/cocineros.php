<?php

session_start();
include_once '../funciones.php';
conectar();
cabecera_html();
navegar();

?>
<nav>

</nav>
<div class="form-group bg-light   ">
    <form method="POST" class='form-group' action="crear_recetas.php" enctype="multipart/form-data">
        <p>

            <input type="text" class="form-control mr-5 " name="titulo" id="titulo" placeholder="Título de la receta" required>
        </p>
        <p>

            <input type="text" class="form-control mr-5 " name="Imagen" id="Imagen" placeholder="Imagen de la receta" required>
        </p>
        <p>

            <textarea name="descripcion" class="form-control mr-5 " id="descripcion" placeholder="Describe tu receta" required></textarea>
        </p>

        <button type="submit" class="btn btn-primary btn-lg mr-5" name="crear" id="crear">Crear receta</button>
    </form>
</div>
<div class="d-flex flex-row justify-content-start align-items-center m-auto flex-wrap">
    <?php

    //muestro todas las recetas del cocinero

    if (!$conexion) {

        echo " No hay conexión";
    } else {
        $array_recetas = array();
        //obtengo los datos de registro
        $id_cocinero = $_SESSION['id_cocinero'];

        $sql = "SELECT * FROM `recetas` WHERE `id_cocinero` LIKE '$id_cocinero' ";
        $datos = mysqli_query($conexion, $sql);

        //Guardo los datos de la petición en un array.
        while ($row = mysqli_fetch_array($datos)) {
            $array_recetas[] = $row;
        }

        //Ordeno de forma descendente los datos según la puntuación obtenida.
        if (!empty($array_recetas)) {

            foreach ($array_recetas as $key => $row) {
                $aux[$key] = $row['puntos_totales'];
            }
            array_multisort($aux, SORT_DESC, $array_recetas);
            //muestro por pantalla los datos de cada receta
            foreach ($array_recetas as $value) {
                echo "<div class=' bg-image container   p-3 m-1 border border_secondary border-rounded text-white  text-center ' style='width: 32%; height:35vh; background-image: url(\"$value[6]\");  background-position: center; border-radius:13px;
                    background-repeat: no-repeat; background-size: cover;'>
                

                    <form method='POST' action='borrar_datos.php'  class='form-control-group  m-3' enctype='multipart/form-data' name='form3' id='form3' >
                    <button type='submit' class='btn btn-outline-danger'>Borrar</button>
                    <h4 class=' text-left' style='text-shadow: 10px 0px 10px black, -10px 0px 10px black,10px 0px 10px black'>$value[2].</h4>
                 <h4 class=' text-left' style=' text-shadow: 10px 0px 10px black, -10px 0px 10px black,10px 0px 10px black'>$value[3].</h4>
                 <h4 class=' text-left' style=' text-shadow: 10px 0px 10px black, -10px 0px 10px black,10px 0px 10px black'> Puntuación: $value[4]</h4>

                 <input type='hidden' name='id_eliminar' id='id_eliminar' value='" . $value[0] . "' >

                </form></div>";
            }
        } else {
            echo 'No tienes recetas registradas.';
        }
    }
    mysqli_close($conexion);

    ?>
</div>
</body>

</html>
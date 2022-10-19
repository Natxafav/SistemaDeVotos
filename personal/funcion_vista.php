<?php
// Actualización del select recetas según select cocineros-----
session_start();
include_once('../funciones.php');

conectar();


$flag_entrada = $_POST["flag_entrada"];

if (isset($_POST) && !empty($_POST)) {

    if ($flag_entrada == 1) :
        $chef = $_POST["chef"];
?>
        <label for="recetas" class="h3">Recetas: </label>
        <select name="recetas" id="recetas" class="form-control mr-5 ">
            <option value=''>Seleccione receta...</option>
            <?php
            $desplegable_recetas = "SELECT * FROM `recetas` WHERE `id_cocinero`='" . $chef . "' ";

            $consulta_receta = mysqli_query($conexion, $desplegable_recetas);

            while ($row = mysqli_fetch_array($consulta_receta)) {

                echo "<option value='" . $row['id_receta'] . "'>" . $row["nombre_receta"] . "</option>";
            }

            ?>
        </select>
<?php


    endif;
} else {
    echo 'No hay acceso a datos';
}

mysqli_close($conexion);


?>
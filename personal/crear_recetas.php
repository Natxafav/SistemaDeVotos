
<?php
session_start();
include_once('../funciones.php');
errores();
conectar();

if (!$conexion) {
    echo " No hay conexión";
} else {
    //recibo datos de post  
    $nombre_receta = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $id_cocinero = $_SESSION['id_cocinero'];
    $nombre_cocinero = $_SESSION['nombre_cocinero'];
    $puntos = 0;
    $url = $_POST['Imagen'];

    //guardo valores en la BBDD
    $receta = "INSERT INTO `recetas`(`id_receta`, `id_cocinero`, `nombre_receta`, `descripcion`, `puntos_totales`, `nombre_cocinero`, `url_recetas`) VALUES (uuid(),'$id_cocinero' ,'$nombre_receta','$descripcion','$puntos','$nombre_cocinero', '$url') ";

    if (!mysqli_query($conexion, $receta)) {

        echo 'No se ha podido registrar la receta.';
    } else {
        echo 'Tu receta se ha registrado correctamente.';
        header(
            "Location: cocineros.php "
        );
    }


    mysqli_close($conexion);
}

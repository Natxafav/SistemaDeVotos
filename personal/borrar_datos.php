<?php
session_start();

include_once '../funciones.php';
conectar();
$id_eliminar = $_POST['id_eliminar'];
print_r($id_eliminar);
echo '<br>';
$status = $_SESSION['status'];
print_r($status);
echo '<br>';



if ($status === 'juez') {

    $arr_obtener_votos = array();
    $guardado_datos = "SELECT `id_receta`, `id_cocinero`,`puntos_totales` FROM `votos` WHERE `id_voto`='$id_eliminar' ";

    $res_votos = consulta($conexion, $guardado_datos, $arr_obtener_votos);
    $id_receta = $res_votos[0]['id_receta'];
    $id_cocinero = $res_votos[0]['id_cocinero'];
    $puntos_voto = $res_votos[0]['puntos_totales'];


    $arr_obtener_recetas = array();
    $get_puntos_recetas = "SELECT  `puntos_totales` FROM `recetas` WHERE `id_receta` like '$id_receta'";
    $res_recetas = consulta($conexion, $get_puntos_recetas, $arr_obtener_recetas);

    $puntos_receta = $res_recetas[0][0];
    $set_puntos_recetas = $puntos_receta - $puntos_voto;
}

if ($status === 'cocinero') {
    $obtener_receta = array();
    $guardado_datos1 = "SELECT `id_receta`, `id_cocinero`,`puntos_totales` FROM `recetas` WHERE `id_receta` LIKE'$id_eliminar' ";

    $resp = consulta($conexion, $guardado_datos1, $obtener_receta);

    //aigno los datos obtenidos a las variables
    $id_receta = $resp[0]['id_receta'];
    $id_cocinero = $resp[0]['id_cocinero'];
    $puntos_receta = $resp[0]['puntos_totales'];
}

$obtener_cocineros = array();
$get_puntos_cocineros = "SELECT  `puntos_totales` FROM `cocineros` WHERE `id_cocinero` like '$id_cocinero'";
$res_cocinero = consulta($conexion, $get_puntos_cocineros, $obtener_cocineros);

$puntos_cocinero = $res_cocinero[0][0];

if ($status === 'juez') {
    $set_puntos_cocineros = $puntos_cocinero - $puntos_receta;
} else if ($status === 'cocinero') {
    $set_puntos_cocineros = $puntos_cocinero - $puntos_receta;
}





$update_cocineros = "UPDATE `cocineros` SET `puntos_totales`='$set_puntos_cocineros' WHERE `id_cocinero`='$id_cocinero'; ";

if (mysqli_query($conexion, $update_cocineros)) {
    echo 'Datos modificados correctamente.';
} else {
    echo 'No modifica puntos cocineros.';
}
if ($status === 'cocinero') {

    $update_delete = "DELETE FROM `votos` WHERE `id_receta`='$id_eliminar'; ";
    $update_delete .= "DELETE FROM `recetas` WHERE `id_receta`='$id_eliminar'; ";
} else if ($status === 'juez') {
    $update_delete = "UPDATE `recetas` SET `puntos_totales`='$set_puntos_recetas' WHERE `id_receta`='$id_receta'; ";
    $update_delete .= "DELETE FROM `votos` WHERE `id_voto`='$id_eliminar'; ";
}

if (mysqli_multi_query($conexion, $update_delete)) {
    echo 'Datos modificados correctamente.';
    header(
        "Location: ranking_cocineros.php "
    );
} else {
    echo 'No elimina los datos .';
}

mysqli_close($conexion);

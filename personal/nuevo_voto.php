<?php

// session_start();

include_once('../funciones.php');
conectar();
errores();
cabecera_html();
navegar();

if (!$conexion) {
    echo " No hay conexión";
} else {
    var_dump($_POST);
    //recupero datos del post y sesion
    $id_receta = $_POST['recetas'];
    $id_chef = $_POST['chef'];
    $puntos = $_POST['puntos_totales']; //puntos asignados en este voto
    $id_juez = $_SESSION['id_juez'];

    $arr_datos_receta = array();
    $arr_datos_cocinero = array();
    //consulto los puntos actuales de cocinero y receta
    $datos_inic_receta = "SELECT `nombre_receta`, `nombre_cocinero`,`puntos_totales` FROM `recetas` WHERE `id_receta` LIKE'$id_receta' ";
    $cons_receta = mysqli_query($conexion, $datos_inic_receta);
    while ($row_datos = mysqli_fetch_array($cons_receta)) {
        $arr_datos_receta[] = $row_datos;
    }

    $datos_inic_cocinero = "SELECT  `puntos_totales` FROM `cocineros` WHERE `id_cocinero` LIKE '$id_chef' ";
    $cons_cocinero = mysqli_query($conexion, $datos_inic_cocinero);
    while ($row_datos1 = mysqli_fetch_array($cons_cocinero)) {
        $arr_datos_cocinero[] = $row_datos1;
    }

    $nombre_receta = $arr_datos_receta[0]['nombre_receta'];
    $nombre_cocinero = $arr_datos_receta[0]['nombre_cocinero'];
    $puntos_receta = $arr_datos_receta[0]['puntos_totales']; //puntos iniciales de la receta
    $puntos_cocinero = $arr_datos_cocinero[0]['puntos_totales'];
    $suma_receta = $puntos_receta + $puntos;
    $suma_cocinero = $puntos_cocinero + $puntos;


    //chequeo campos
    if (isset($arr_datos_cocinero) && !empty($arr_datos_cocinero) && isset($arr_datos_receta) && !empty($arr_datos_receta)) {

        //limito el voto por cliente/juez
        $chequeo = "SELECT `id_voto`, `id_juez`, `id_receta`, `nombre_receta`, `id_cocinero`, `nombre_cocinero`, `puntos_totales` FROM `votos` WHERE `id_receta` LIKE'$id_receta' and `id_juez`LIKE'$id_juez'";

        $datos_chequeo = mysqli_query($conexion, $chequeo);
        $arr_chequeo = array();
        while ($row = mysqli_fetch_array($datos_chequeo)) {
            $arr_voto[] = $row;
        }
        //En caso de obtener datos, ya se ha votado al cocinero.
        if (!empty($arr_voto)) {
            echo '<h4 class="control-label">Ya has realizado una votación a esta receta.</h4>';
        } else {
            //inserta voto con puntuación en la receta y el código
            $votos = "INSERT INTO `votos`(`id_voto`, `id_juez`, `id_receta`,`nombre_receta` , `id_cocinero`, `nombre_cocinero`, `puntos_totales`) VALUES (uuid(), '$id_juez','$id_receta','$nombre_receta','$id_chef', '$nombre_cocinero','$puntos'); ";

            $votos .= "UPDATE `recetas` SET `puntos_totales`='$suma_receta' WHERE `id_receta`='$id_receta'; ";
            $votos .= "UPDATE `cocineros` SET`puntos_totales`='$suma_cocinero' WHERE `id_cocinero`='$id_chef'; ";

            if (mysqli_multi_query($conexion, $votos)) {
                echo 'Voto emitido correctamente.';
                header(
                    "Location: jueces.php "
                );
            } else {
                echo '<h4 class="control-label">No se ha podido registrar el voto.</h4>';
            }
        }
    } else {
        echo 'Error al recibir los ratos. Por favor, realiza de nuevo la consulta.';
    }
    mysqli_close($conexion);
}

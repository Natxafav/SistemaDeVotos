<?php
require_once 'conexion.php';
$usuario = $_POST['usuario'];
$apellidos = $_POST['apellidos'];
$email = $_POST['email'];
$password = $_POST['password'];
$pass_hashed = password_hash($password, PASSWORD_BCRYPT);
$puntos = 0;
$tipo = $_POST['tipo'];

if (!$conexion) {
    echo "Error de conexión. Por favor, inténtelo más tarde.";
} else {
    //Selección del campo email de las tablas deseadas, consulta y guardado de datos.
    $sql1 = "SELECT email FROM jueces";
    $check_email = mysqli_query($conexion, $sql1);
    $arr_sql1 = array();
    while ($row1 = mysqli_fetch_array($check_email)) {
        $arr_sql1[] = $row1;
    }

    $sql2 = "SELECT email FROM cocineros";
    $check_email2 = mysqli_query($conexion, $sql2);
    $arr_sql2 = array();
    while ($row2 = mysqli_fetch_array($check_email2)) {
        $arr_sql2[] = $row2;
    }
    //Fusionar arrays
    $results = array();
    if (!empty($arr_sql1) || !empty($arr_sql2)) {
        $result = array_merge($arr_sql1, $arr_sql2);
    }

    //?________________Comprobar campo si se selecciona Juez_____________
    if ($tipo === "juez") {
        //Descarto error cuando no existen datos guardados.
        if (!empty($result)) {
            $email_exist = false;
            //Comparo campo único para descartar que exista el usuario.
            foreach ($result as $valor) {
                if ($valor['emal '] === $email) {
                    $email_exist = true;
                }
            }

            if ($email_exist) {
                echo "<h4>Ya existe un usuario con ese email.</h4>";
            } else {
                //Inserto datos en la BBDD y envío petición. 
                $insertar_datos = "INSERT INTO `jueces`(`id_juez`, `nombre_juez`, `apellidos_juez`, `email`, `password`, `status`) VALUES (CURRENT_TIMESTAMP(),'$usuario','$apellidos','$email','$pass_hashed', 'juez')";

                if (!mysqli_query($conexion, $insertar_datos)) {
                    echo "error al registrar juez" . "<br>";
                } else {
                    echo "Creado juez" . "<br>";
                    header("Location: ../../proyecto_laravel");
                }
            }
        } else {
            //Inserto datos en la BBDD. En caso de tabla vacía.
            $insertar_datos = "INSERT INTO `jueces`(`id_juez`, `nombre_juez`, `apellidos_juez`, `email`, `password`, , `status`) VALUES (CURRENT_TIMESTAMP(),'$usuario','$apellidos','$email','$pass_hashed', 'juez')";

            if (!mysqli_query($conexion, $insertar_datos)) {
                echo "error al registrar juez" . "<br>";
            } else {
                echo "Creado juez" . "<br>";
                header("Location: ../../proyecto_laravel");
            }
        }
    }

    //!----------------------------------------------------------------------------

    //?_________Comprobar campo si se selecciona Chef__________________

    if ($tipo === "cocinero") {
        //Descarto error cuando no existen datos guardados.
        if (!empty($result)) {
            $email_exist = false;
            //Comparo campo único para descartar que exista el usuario.
            foreach ($result as $valor) {
                if ($valor['emal '] === $email) {
                    $email_exist = true;
                }
            }

            if ($email_exist) {
                echo "<h4>Email exitente. No puede haber dos usuarios con el mismo email.</h4>";
            } else {
                //Inserto datos en la BBDD y envío la petición

                $datos_intr2 = "INSERT INTO `cocineros`(`id_cocinero`, `nombre_cocinero`, `apellidos_cocinero`, `email`, `password`, `puntos_totales`,  `status`) VALUES (CURRENT_TIMESTAMP(),'$usuario','$apellidos','$email','$pass_hashed',0, 'cocinero')";

                if (!mysqli_query($conexion, $datos_intr2)) {
                    echo "error al registrar cocinero" . "<br>";
                } else {
                    echo "Creado cocinero" . "<br>";
                    header("Location: ../../proyecto_laravel");
                }
            }
        } else {
            //Inserto datos en la BBDD. En caso de BBDD vacía.
            $datos_intr2 = "INSERT INTO `cocineros`(`id_cocinero`, `nombre_cocinero`, `apellidos_cocinero`, `email`, `password`, `puntos_totales`, `status`) VALUES (CURRENT_TIMESTAMP(),'$usuario','$apellidos','$email','$pass_hashed',0, 'cocinero')";

            if (!mysqli_query($conexion, $datos_intr2)) {
                echo "error al registrar cocinero" . "<br>";
            } else {
                echo "Creado cocinero" . "<br>";
                header("Location: ../../proyecto_laravel");
            }
        }
    }
    mysqli_close($conexion);
}

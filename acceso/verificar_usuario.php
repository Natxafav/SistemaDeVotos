<?php

session_start();
include '../funciones.php';
conectar();
cabecera_html();
navegar();

if (!$conexion) {
    echo "Error de conexión. Por favor, inténtelo más tarde.";
} else {

    $email = $_POST['email'];
    $pass = $_POST['password'];

    //Ejecuto consulta y guardo jueces/cocineros.
    $sql = "SELECT `id_juez`, `nombre_juez`, `apellidos_juez`, `email`, `password`, `status` FROM `jueces` WHERE `email`='$email'";
    $datos_email = mysqli_query($conexion, $sql);
    $array_datos = array();
    while ($row = mysqli_fetch_array($datos_email)) {
        $array_datos[] = $row;
    }

    //En caso de que el array de jueces no esté vacio chequeo.
    if (!empty($array_datos)) {
        //Verificamos usuario y creamos sesion de juez

        if ($email === $array_datos[0]['email'] && password_verify($pass, $array_datos[0]['password'])) {

            if (!empty($_SESSION)) {
                session_destroy();
            }
            $_SESSION["nombre_juez"] = $array_datos[0]["nombre_juez"];
            $_SESSION["id_juez"] = $array_datos[0]["id_juez"];
            $_SESSION["email"] = $array_datos[0]["email"];
            $_SESSION["status"] = $array_datos[0]["status"];
            header("Location: ../personal/jueces.php");
        } else if ($email === $array_datos[0]['email'] || password_verify($pass, $array_datos[0]['password'])) {

            echo 'Usuario y/o contraseña erróneos. ';
        }
        //en caso de que no se encuentren los datos en jueces, chequeamos cocineros
    } else {
        $sql2 = "SELECT `id_cocinero`, `nombre_cocinero`, `apellidos_cocinero`, `email`, `password`, `puntos_totales`, `status` FROM `cocineros` WHERE `email` LIKE '$email'";
        $datos_email2 = mysqli_query($conexion, $sql2);
        $array_datos2 = array();
        while ($row2 = mysqli_fetch_array($datos_email2)) {
            $array_datos2[] = $row2;
        }

        if (!empty($array_datos2)) {

            //Verificamos usuario y creamos sesion
            if ($email === $array_datos2[0]['email'] && password_verify($pass, $array_datos2[0]['password'])) {

                if (!empty($_SESSION)) {
                    session_destroy();
                }

                $_SESSION["nombre_cocinero"] = $array_datos2[0]["nombre_cocinero"];
                $_SESSION["id_cocinero"] = $array_datos2[0]["id_cocinero"];
                $_SESSION["email"] = $array_datos2[0]["email"];
                $_SESSION["status"] = $array_datos2[0]["status"];
                header("Location: ../personal/cocineros.php");
            } else if ($email === $array_datos2[0]['email'] || password_verify($pass, $array_datos2[0]['password'])) {

                echo "<h3 class='m-3'>Usuario y/o contraseña incorrectos. Inténtelo de nuevo.</h3> ";
            }
        } else {


            echo "<h3 class='m-3'>Usuario y/o contraseña incorrectos.</h3>";
        }
    }
    mysqli_close($conexion);
}
?>

</body>

</html>
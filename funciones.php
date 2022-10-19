<?php

use Mockery\Undefined;

function navegar()
{
    session_start();

    if ($_SESSION === null || empty($_SESSION) || !isset($_SESSION)) {
?>
        <nav class="navbar navbar-expand-lg navbar-light bg-light list-unstyled m-2">
            <a href='/php/rankingCocineros/acceso/registro.php' class="navbar-brand mx-3">Registro</a>
            <a href='/php/rankingCocineros/acceso/sesion.php' class="navbar-brand mx-3">Iniciar sesión</a>
        </nav>

        <?php

    } else if (isset($_SESSION) && !empty($_SESSION)) {
        $tipo = $_SESSION['status'];
        if ($tipo === 'juez') {
        ?>
            <nav class="navbar navbar-expand-lg navbar-light list-unstyled bg-light  m-2">
                <li class=" list-unstyled" id='tab-jueces'> <a href="/php/rankingCocineros/personal/jueces.php" class="navbar-brand mx-3">Mis votos</a></li>
                <li class=" list-unstyled" id='tab-ranking_cocineros'><a href="/php/rankingCocineros/personal/ranking_cocineros.php" class="navbar-brand mx-3">Ranking</a></li>
                <li class=" list-unstyled" id='tab-logout'> <a href="/php/rankingCocineros/acceso/logout.php" class="navbar-brand mx-3">Cerrar sesión</a></li>
            </nav>
        <?php
        } else if ($tipo === 'cocinero') { ?>

            <nav class="navbar navbar-expand-lg navbar-light list-unstyled bg-light  m-2">
                <li class=" list-unstyled" id='tab-cocineros'><a href="/php/rankingCocineros/personal/cocineros.php" class="navbar-brand mx-3">Mis recetas</a></li>
                <li class=" list-unstyled" id='tab-ranking_cocineros'><a href="/php/rankingCocineros/personal/ranking_cocineros.php" class="navbar-brand mx-3">Ranking</a></li>
                <li class=" list-unstyled" id='tab-logout'><a href="/php/rankingCocineros/acceso/logout.php" class="navbar-brand mx-3">Cerrar sesión</a></li>
            </nav>

<?php
        }
    }
}



function conectar()
{

    $server = "localhost";
    $user = "root";
    $password = "";
    $db = "proyectoLaravel";
    global $conexion;
    //    $conexion = mysqli_connect($server, $user, $password, $db) or die('ERROR CONEXION');
    try {
        $conexion = mysqli_connect($server, $user, $password, $db) or die('ERROR CONEXION');
        //Cofiguro idioma para caracteres especiales.
        mysqli_set_charset($conexion, "utf8");
    } catch (PDOException $e) {
        exit("Error: " . $e->getMessage());
    }
}
?>
<?php
function cabecera_html()
{
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <title>Títular</title>

    </head>
<?php

}

?>

<?php
function errores()
{
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
}

function consulta($conexion, $consulta, $arr_datos)
{
    $query = mysqli_query($conexion, $consulta);
    while ($row_datos = mysqli_fetch_array($query)) {
        $arr_datos[] = $row_datos;
    }
    return $arr_datos;
}

?>
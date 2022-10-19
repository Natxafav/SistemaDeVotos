<?php
// session_start();


include_once('../funciones.php');

conectar();
cabecera_html();

if (!$conexion) {
  echo " No hay conexión";
} else {
  // --------------Mostar votos realizados según id del juez-------------------
  $id_juez = ($_SESSION['id_juez']);

  $datos_filtro = "SELECT `id_voto`, `id_juez`, `id_receta`, `nombre_receta`, `id_cocinero`, `nombre_cocinero`, `puntos_totales` FROM `votos` WHERE `id_juez` LIKE '$id_juez'; ";


  $datos = mysqli_query($conexion, $datos_filtro);
  $datos_voto = array();
  while ($row = mysqli_fetch_array($datos)) {
    $datos_voto[] = $row;
  }


  if (!empty($datos_voto)) {
    foreach ($datos_voto as $value) {
      echo " <div class=' container   p-3 m-3   border border_secondary border-rounded  text-center bg-light' style='width: 31%; height:auto;border-radius:13px; opacity:0.75;'>  
        <form method='POST' action='borrar_datos.php' class='form-control-group  m-1' enctype='multipart/form-data' name='form2' id='form2'>
      <div class='d-flex flex-column'>  <div class='d-flex flex-sm-column' id='votos_juez'>
        <h3  class='text-left'style='opacity:1;'>Receta: $value[3] </h3>
        <h3 class='text-right'>Cocinero: $value[5]</h3>
        <h3 class='text-left'>Puntuación: $value[6]</h3>
        <input type='hidden' name='id_eliminar' id='id_eliminar' value='" . $value[0] . "' ></div>
       <button type='submit' class='btn btn-outline-danger' >Borrar</button>
       </div>
       
      </form>
        </div>";
    }
  } else {
    echo "<h4 class='text-white text-center ' style='width: 100%;'>No has realizado ninguna votación.</h4>";
  }

  mysqli_close($conexion);
}

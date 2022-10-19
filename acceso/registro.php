<?php
include('../funciones.php');
session_start();
conectar();
cabecera_html();
navegar();
errores();
?>

<body class='bg-image' style='background-image:url(https://img.freepik.com/foto-gratis/ingredientes-comida-italiana_23-2148551669.jpg?w=1380&t=st=1664969039~exp=1664969639~hmac=ecad555350c02ab5c9f8a3673d4999a34b5ee2858d29f808b9033372c4a5d0fb);background-position: center; border-radius:13px;
    background-repeat: no-repeat; background-size: cover; min-height:100vh;'>

    <div class="d-flex flex-row justify-content-center align-items-center m-5 mt-5">
        <form method="post" action="post.php" class="form-group d-flex flex-column justify-content-center  " style="width: 50vw;" enctype="multipart/form-data">

            <p class="well well-sm mx-5">

                <input type="text" name="usuario" class="form-control mr-5 " placeholder="Nombre" required>
            </p>
            <p class="form-horizontal mx-5">
                <input type="text" name="apellidos" class="form-control mr-5 " placeholder="Apellidos" required>
            </p>
            <p class="form-horizontal mx-5">

                <input type="email" name="email" class="form-control mr-5 " placeholder="Email" required>
            </p>
            <p class="form-horizontal mx-5">

                <input type="password" name="password" class="form-control mr-5 " placeholder="Password" required>
            </p>
            <p class="form-horizontal mx-5">
                <select class="form-control mr-5 " name="tipo" required>
                    <option value=''>Elige una opción:</option>
                    <option value="juez">Juez</option>
                    <option value="cocinero">Chef</option>


                </select>
            <p class="form-horizontal mx-5">

                <input type="text" name="url" class="form-control mr-5 " placeholder="Imagen" required>
            </p>

            <p class="pure-control-group mx-5">
                <button type="submit" class="btn btn-primary btn-lg mr-5" id="enviar" value="enviar">Registrar</button>
            </p>

        </form>
    </div>

</body>

</html>
<?php
include '../funciones.php';
cabecera_html();
navegar();
errores();
?>

<body class='bg-image' style='background-image:url(https://img.freepik.com/foto-gratis/ingredientes-comida-italiana_23-2148551669.jpg?w=1380&t=st=1664969039~exp=1664969639~hmac=ecad555350c02ab5c9f8a3673d4999a34b5ee2858d29f808b9033372c4a5d0fb);background-position: center; border-radius:13px;
    background-repeat: no-repeat; background-size: cover; min-height:100vh;'>
    <div class="d-flex flex-row justify-content-center align-items-center m-5">
        <form class="form-group row  " style="width: 500px;" id="formu_sesion" method=post action="verificar_usuario.php" enctype="multipart/form-data">
            <fieldset>
                <div class="form-control-group  m-5 ">

                    <input type="email" class="form-control mr-5" name='email' placeholder="Email Address" />
                </div>
                <p>
                <div class="form-control-group  m-5">

                    <input type="password" class="form-control mr-5 " name='password' placeholder="Password" />
                </div>
                <div class="col-md-12  m-5">
                    <button type="submit" class="btn btn-primary btn-lg mr-5">Enviar</button>
                </div>
            </fieldset>
        </form>
    </div>
</body>

</html>
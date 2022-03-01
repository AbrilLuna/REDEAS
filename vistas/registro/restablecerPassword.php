<?php
    require_once('../../controllers/funciones.php');
    $token = s($_GET['token']);
?>
<!DOCTYPE>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="preload" href="../../css/normalize.css" as="style"> 
        <link rel="stylesheet" href="../../css/normalize.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+Antique&display=swap" rel="stylesheet">
        <link rel="preload" href="../../css/style.css" as="style">
        <link href="../../css/style.css" rel="stylesheet">
        
        <title>Recuperar Password</title>
        <script type="text/javascript" src="../../js/jquery-3.5.1.min.js"></script>
    </head>
    <body class="contenedor-sesion">
        <header class="contenedor">
            <img class="sesion-logo" src="../../img/03_REDEAS_Color.png" alt="Logotipo">
        </header>
        <main class="contenedor">
            <div class="sesionI sombra">
                <h2>Restablece tu Password</h2>
                <form class="formulario" id="formulario">
                    <input type='hidden' name='restablecerPassword' id='restablecerPassword' value='restablecerPassword'>
                    <input type='hidden' name='token' id='token' value='<?php echo $token; ?>'>

                    <!--Password-->
                    <div class="formulario__datos" id="sesion-nuevoPassword">
                        <label for="password"  class="formulario__label">Nuevo password:</label>
                        <div class="formulario__datos-input">
                            <input type="password" class="formulario__input" name="nuevoPassword" id="nuevoPassword">
                            <i class="formulario__validacion-estado fas fa-times-circle"></i>
                        </div>
                        <p class="formulario__input-error">El password debe contener al menos 6 caracteres</p>
                    </div><!--Fin Password-->

                    <div class="formulario__mensaje" id="sesion-mensaje">
                        <p>
                            <i class="fas fa-exclamation-triangle"></i>
                            <b>Error:</b> Escribe un nuevo password.
                        </p>
                    </div>

                    <div class="formulario__datos formulario__datos-btn-enviar">
                        <button type="submit" class="boton2">Guardar</button>
                        <p class="formulario__mensaje-exito" id=sesion-mensaje-exito>Enviando datos...</p>
                    </div>
                </form>
                <div style="text-align: center; margin-top: 3rem;" class="sesion-datos">
                    <a href="iniciarSesion.html">CANCELAR</a>
                </div>
    
            </div>

        </main>
        <script src="../../js/formulario.js"></script>
        <script Src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
    </body>
</html>
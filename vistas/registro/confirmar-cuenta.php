<?php
    require_once('../../db/conexion.php');
    require_once('../../model/crud_usuario.php');
    require_once('../../controllers/usuario.php');
    require_once('../../controllers/funciones.php');
    require_once('../../classes/email.php');
    
    $crud= new CrudUsuario;
    $token = s($_GET['token']);
    $usuario = $crud->where('Token', $token);
           
    if(empty($usuario)) {
        //mensaje de error
        echo '<script language="javascript">alert("Token no valido, no se pudo confirmar la cuenta");window.location.href="../../index.html"</script>';
    }else {
        //Modificar usuario confirmado
        $usuario->setConfirmar(1);
        $usuario->setToken(null);
        $crud->actualizar($usuario);
    
        echo '<script language="javascript">alert("La cuenta ha sido confirmada correctamente, puedes iniciar sesión");window.location.href="iniciarSesion.html"</script>';
    }

?>

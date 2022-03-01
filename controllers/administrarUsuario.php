<?php 

require_once('../db/conexion.php');
require_once('../model/crud_usuario.php');
require_once('../model/usuarioFunciones.php');
require_once('usuario.php');
require_once('funciones.php');
require_once('../classes/email.php');

$crud= new CrudUsuario;
$funciones = new UsuarioFunciones;
$usuario = new Usuario;

if(isset($_POST['insertar'])){
    $usuario->setNombre($_POST['nombre']);
    $usuario->setApellidos($_POST['apellidos']);
    $usuario->setEmail($_POST['email']);
    $usuario->setPassword($funciones->hashPassword($_POST['password']));

    //$verficar = new Usuario;
    $verficar= $crud->existeUsuario($_POST['email']);

    
    if(empty($verficar)){
        $usuario->setToken($funciones->crearToken());

        $email = new Email($usuario->getNombre(), $usuario->getEmail(), $usuario->getToken());
        $email->enviarConfirmacion();

        $crud->insertar($usuario);
        echo 1;
        
    }else {
        echo 0;
    } 
    
}
if(isset($_POST['iniciaSesion'])){
    $email=$_POST['emailSesion'];
    //comprobar que el usuario existe 
    $usuario=$crud->where('Email', $email);

    if($usuario){
        //verificamos que el usuario este confirmado
        if($usuario->getConfirmar()){
            //verificar el password
            if($funciones->comprobarPassword($_POST['passwordSesion'], $usuario->getPassword())===true){
                //Autenticar usuario
                /*session_start();

                $_SESSION['id'] = $usuario->getId();
                $_SESSION['nombre'] = $usuario->getNombre() . " " . $usuario->getApellidos();
                $_SESSION['email'] = $usuario->getEmail();
                $_SESSION['login'] = true;*/

                //Redireccionamiento
                //aqui se agrega el administrador;
                echo "correcto";
            }
        }else {
            //cuenta no confirmada
            echo "confirmar";
        }

    }else {
        //usuario no encontrado
        echo "noEncontrado";
    }

    //debuguear($usuario);
}
if(isset($_POST['olvidePassword'])){
    if($_SERVER['REQUEST_METHOD']==='POST'){
        $email=$_POST['emailRecuperar'];
        //comprobar que el usuario existe 
        $usuario=$crud->where('Email', $email);
       
        if($usuario->getEmail() && $usuario->getConfirmar() === "1"){
            //Generar token
            $usuario->setToken($funciones->crearToken());
            //Actualizar los datos en la BD 
            $crud->actualizar($usuario);

            //Enviar Email
            $email = new Email($usuario->getNombre(), $usuario->getEmail(), $usuario->getToken());
            $email->enviarInstrucciones();

            echo "existe";
        }else {
            //Usuario no encontrado
            echo "noEncontrado";
        }
    }
}
if(isset($_POST['restablecerPassword'])){

    $tokenF=$_POST['token'];
    $usuario= $crud->where('Token', $tokenF);

    echo $tokenF;
    if(empty($usuario)){
        echo 'error';
    }else{

        $usuario->setPassword($funciones->hashPassword($_POST['nuevoPassword']));
        echo 'listo';
    }
}


?>
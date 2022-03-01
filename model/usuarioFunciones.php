<?php

    require_once('../controllers/funciones.php');
    class UsuarioFunciones{

        public function __construct(){}

        //Crear Token 
        public function crearToken() {
            $token = uniqid();

            return $token;
        }

        //Hashear Password
        public function hashPassword($password){
            $pass=password_hash($password, PASSWORD_BCRYPT);

            return $pass;
        }

        //Comprobar password
        public function comprobarPassword($passUser, $password){
            $resultado = password_verify($passUser, $password);
            
            return $resultado;
        }

    }
?>
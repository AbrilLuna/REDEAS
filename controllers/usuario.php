<?php
    class Usuario{
        private $id_usuario;
        private $nombre;
        private $apellidos;
        private $email;
        private $contrasena;
        private $confirmar;
        private $token;

        function __construct(){}

        public function getNombre(){
            return $this->nombre;
        }
        public function setNombre($nombre){
            $this->nombre = $nombre;
       }

        public function getApellidos(){
            return $this->apellidos;
        }
        public function setApellidos($apellidos){
            $this->apellidos = $apellidos;
        }

        public function getEmail(){
            return $this->email;
        }
        public function setEmail($email){
            $this->email = $email;
        }

        public function getPassword(){
            return $this->contrasena;
        }
        public function setPassword($passw){
            $this->contrasena = $passw;
        }

        public function getConfirmar(){
            return $this->confirmar;
        }
        public function setConfirmar($conf){
            $this->confirmar = $conf;
        }

        public function getToken(){
            return $this->token;
        }
        public function setToken($token){
            $this->token = $token;
        }


        public function getId(){
            return $this->id_usuario;
        }
        public function setId($id){
            $this->id_usuario = $id;
        }
    }
?>
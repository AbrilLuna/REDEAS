<?php
    class Evento{
        private $id_evento;
        private $id_miembro;
        private $nombre;
        private $organizacion;
        private $fecha;
        private $horarios;
        private $publico;
        private $descripcion;
        private $programa;
        private $modalidad;
        private $requisitos;
        private $costos;
        private $imagen;
        private $confirmado;

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

        public function getId(){
            return $this->id_usuario;
        }
        public function setId($id){
            $this->id_usuario = $id;
        }
    }
?>
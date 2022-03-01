<?php
    
    class CrudUsuario{

        public function __construct(){}

        //método para insertar los datos del usuario en la base de datos
        public function insertar($usuario){
            $conn=Db::conectar();
            $insert=$conn->prepare('INSERT INTO usuario values(NULL,:Nombre,:Apellidos,:Email,:Contrasena,:Confirmado,:Token)');
            $insert->bindValue('Nombre',$usuario->getNombre());
            $insert->bindValue('Apellidos',$usuario->getApellidos());
            $insert->bindValue('Email',$usuario->getEmail());
            $insert->bindValue('Contrasena',$usuario->getPassword());
            $insert->bindValue('Confirmado', 0);
            $insert->bindValue('Token', $usuario->getToken());

            $insert->execute();
        }

        //Actualizar datos de un usuario ya registrado
        public function actualizar($usuario){
            $conn=Db::conectar();
            $actualizar=$conn->prepare('UPDATE usuario SET Nombre=:Nombre, Apellidos=:Apellidos, Email=:Email, Contrasena=:Contrasena, Confirmado=:Confirmado, Token=:Token WHERE id_usuario=:id_usuario');
            $actualizar->bindValue('id_usuario', $usuario->getId());
            $actualizar->bindValue('Nombre', $usuario->getNombre());
            $actualizar->bindValue('Apellidos', $usuario->getApellidos());
            $actualizar->bindValue('Email', $usuario->getEmail());
            $actualizar->bindValue('Contrasena', $usuario->getPassword());
            $actualizar->bindValue('Confirmado', $usuario->getConfirmar());
            $actualizar->bindValue('Token', $usuario->getToken());

            $actualizar->execute();
        }

        //Revisa si el usuario ya existe
        public function existeUsuario($email){
           $conn=Db::conectar();
            $select=$conn->prepare('SELECT * FROM usuario WHERE Email=:Email LIMIT 1');
            $select->bindValue('Email',$email);
            $select->execute();
            $usuario=$select->fetch();  
            return $usuario;
        }

        //Busca Token
        public function where($columna, $valor){
            $conn=Db::conectar();
            $select=$conn->prepare('SELECT * FROM usuario WHERE '. $columna.'=:'.$columna .' LIMIT 1');
            $select->bindValue($columna,$valor);
            $select->execute();
            
            $usuario=$select->fetch(); 

            $myUser=new Usuario();
            $myUser->setId($usuario['id_usuario']);
            $myUser->setNombre($usuario['Nombre']);
            $myUser->setApellidos($usuario['Apellidos']);
            $myUser->setEmail($usuario['Email']);
            $myUser->setPassword($usuario['Contrasena']);
            $myUser->setConfirmar($usuario['Confirmado']);
            $myUser->setToken($usuario['Token']);

            return $myUser;
        }

    }
?>
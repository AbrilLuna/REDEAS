<?php

    require_once("class.phpmailer.php");

    class Email {
        public $email;
        public $nombre;
        public $token;

        public function __construct($nombre, $email, $token){
            $this->nombre = $nombre;
            $this->email = $email;
            $this->token = $token;
        }

        public function enviarConfirmacion() {
            //crear el objeto email 
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = '89ea0b041bc28b';
            $mail->Password = '5c8d8009b03d5d';

            $mail->From = "abrile.lu.98@gmail.com";
            $mail->AddAddress('cuentas@redeas', 'REDEAS.com');
            $mail->Subject = 'Confirma tu cuenta';

            //Set HTML
            $mail->isHTML(TRUE);
            $mail->CharSet ='UTF-8';

            $contenido = "<html>";
            $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has creado una cuenta en la plataforma REDEAS, solo debes confirmarla presionando el siguente enlace</p>";
            $contenido .= "<p>Presiona aquí: <a href='http://localhost/PracticasProfesionales/REDEAS/vistas/registro/confirmar-cuenta.php?token=" . $this->token . "'>Confirmar Cuenta</a> </p>";
            $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
            $contenido .= "</html";
            
            $mail->Body = $contenido;

            //Enviar Email
            $mail->send();
        }

        /**Enviar instrucciones para restablecer el Password */
        public function enviarInstrucciones() {
            //crear el objeto email 
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = '89ea0b041bc28b';
            $mail->Password = '5c8d8009b03d5d';

            $mail->From = "abrile.lu.98@gmail.com";
            $mail->AddAddress('cuentas@redeas', 'REDEAS.com');
            $mail->Subject = 'Restablece tu password';

            //Set HTML
            $mail->isHTML(TRUE);
            $mail->CharSet ='UTF-8';

            $contenido = "<html>";
            $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has solicitado restablecer tu password de tu cuenta de la plataforma REDEAS, en el siguienete enlace puedes hacerlo.</p>";
            $contenido .= "<p>Presiona aquí: <a href='http://localhost/PracticasProfesionales/REDEAS/vistas/registro/restablecerPassword.php?token=" . $this->token . "'>Restablecer Password</a> </p>";
            $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
            $contenido .= "</html";
            
            $mail->Body = $contenido;

            //Enviar Email
            $mail->send();
        }

    }
?>
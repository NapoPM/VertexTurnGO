<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{
    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token){

        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion(){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '8f5c5c02cf129d';
        $mail->Password = '624e17aaae5f33';

        $mail->setFrom('cuentas@turngo.com');
        $mail->addAddress('cuentas@turngo.com', 'TurnGo.com');
        $mail->Subject = 'Confirma Tu Cuenta';

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido.= "<p><strong>Hola ". $this->nombre ."</strong>Has Creado tu cuenta en TurnGO solo debes confiramr presionando el siguiente enlace</p>";
        $contenido.= "<a href='http://localhost:3000/confirmar-cuenta?token=" . $this->token . "'>Click Aquí</a>";
        $contenido.= "<p>Si tu no solicitaste esta cuenta, ignora el mensaje</p>";
        $contenido.= "</html>";
        $mail->Body = $contenido;
    

        $mail->send();
    }

}



?>
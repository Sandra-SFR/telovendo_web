<?php

class Email{

    /**
     * Envía email de confirmación de registro y devuelve mensaje de confirmación
     */
    public static function email_registrar($array_formdata){
        /*
        El código de envío de mail fue chequeado con un simulador de servidor SMTP y estaría
        funcionando correctamente.
        */
        $usuario = $array_formdata["user"];
        $name = $array_formdata["name"];
        $surname = $array_formdata["surname"];
        $email = $array_formdata["email"];
        $subject = 'Confirmación de registro: '.$email;
        $msg = "<!DOCTYPE html><html><head><meta charset='UTF-8'><style> *{font-family: 'Arial', Helvetica, sans-serif;}body{width:80%; margin: 0 auto;background-color: aqua;}td{border:1px solid black;}</style></head><body><header><h1>Confirmación de registro</h1></header><section><article><h3>Hola ".$name.":<br>Su Cuenta ha sido creada con éxito.</h3><p>Estos son sus datos:</p><table border='1'><tr><td>Usuario</td><td>Nombre</td><td>Apellido</td><td>Email</td></tr><tr><td>".$usuario."</td><td>".$name."</td><td>".$surname."</td><td>".$email."</td></tr><tr><td colspan='4'>Por seguridad, su contraseña ha sido codificada y no podemos acceder a la misma.</td></tr></table></article></section><footer><p>Ejercicio de Feedback - PHP-MYSQL</p><p>Ezequiel Garay</p></footer></body></html>";
        $headers = "MIME-Version 1.0 \r\n";
        $headers .= "Content-type: text/html; charset=ISO-8859-1 \r\n";
        $headers .= "From: AA2SFR <postmaster@localhost.com> \r\n";

        // Envía email.
        $resultado = mail($email, $subject, $msg, $headers);
        //Comprueba si el email ha sido enviado y devuelte el msg correspondiente.
        if($resultado){
            return $resultado = '<p class="ok-form">El registro ha sido exitoso. Recibirá un mail de confirmación a <b>'.$email.'</b></p>';
        }else{
            return $resultado = '<p class="ok-form">Su cuenta ha sido registrada pero ha habido un error al enviar el email.</b></p>';
        }

    }
    function enviar_correo_confirmacion($nombre, $correo_electronico) {
        // Dirección de correo electrónico a la que se enviará el mensaje de confirmación:
        $destinatario = $correo_electronico;

        // Asunto del correo electrónico:
        $asunto = "Confirmación de registro en mi sitio web";

        // Mensaje de correo electrónico con el código de confirmación:
        $mensaje = "Hola " . $nombre . ",\n\n";
        $mensaje .= "Gracias por registrarte en mi sitio web. Para confirmar tu registro, por favor ingresa el siguiente código en la página de confirmación:\n\n";
        $mensaje .= "Si no te registraste en nuestro sitio web, por favor ignora este correo electrónico.\n\n";
        $mensaje .= "Saludos cordiales,\n";
        $mensaje .= "El equipo de mi sitio web";

        // Encabezados de correo electrónico:
        $encabezados = "From: no-reply@mi-sitio-web.com\r\n";
        $encabezados .= "Reply-To: no-reply@mi-sitio-web.com\r\n";
        $encabezados .= "X-Mailer: PHP/" . phpversion();

        // Envía el correo electrónico:
        $resultado = mail($destinatario, $asunto, $mensaje, $encabezados);

        // Comprueba si el correo electrónico se envió correctamente:
        if ($resultado) {
            return "Se ha enviado un correo electrónico de confirmación a " . $correo_electronico . ". Por favor revisa tu correo electrónico y sigue las instrucciones para confirmar tu registro.";
        } else {
            return "Ha habido un error al enviar el correo electrónico de confirmación. Por favor intenta nuevamente más tarde.";
        }
    }

}

?>
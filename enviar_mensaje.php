<?php
// 1. CONFIGURACIÓN
// *******************************************
// Escribe el correo electrónico donde quieres recibir los mensajes:
$destinatario = "ecovisionsostenibleco@gmail.com"; 

// 2. RECUPERAR LOS DATOS DEL FORMULARIO
// *******************************************
$nombre   = $_POST['nombre'] ?? 'No especificado';
$email    = $_POST['email'] ?? 'No especificado';
$asunto   = $_POST['asunto'] ?? 'Mensaje de formulario de contacto';
$mensaje  = $_POST['mensaje'] ?? 'El usuario no escribió mensaje';

// 3. CONSTRUIR EL CUERPO DEL CORREO
// *******************************************
$cuerpo_mensaje = "Has recibido un nuevo mensaje a través del formulario de contacto de Ecovision Sostenible:\n\n";
$cuerpo_mensaje .= "Nombre: " . $nombre . "\n";
$cuerpo_mensaje .= "Email: " . $email . "\n";
$cuerpo_mensaje .= "Asunto: " . $asunto . "\n";
$cuerpo_mensaje .= "Mensaje:\n" . $mensaje;

// 4. CABECERAS DEL CORREO
// *******************************************
$cabeceras = "From: " . $nombre . " <" . $email . ">\r\n";
$cabeceras .= "Reply-To: " . $email . "\r\n";
$cabeceras .= "X-Mailer: PHP/" . phpversion();

// 5. ENVIAR EL CORREO y mostrar el resultado
// *******************************************

// La función 'mail()' de PHP intenta enviar el correo.
if (mail($destinatario, $asunto, $cuerpo_mensaje, $cabeceras)) {
    // Éxito: Simplemente mostramos un mensaje de confirmación.
    echo '
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <title>Confirmación de Envío</title>
            <style>
                body { font-family: Arial, sans-serif; text-align: center; padding-top: 50px; }
                .message-box { border: 1px solid #4CAF50; padding: 20px; margin: 20px auto; width: 80%; max-width: 500px; background-color: #E8F5E9; color: #388E3C; }
            </style>
        </head>
        <body>
            <div class="message-box">
                <h1>✅ Mensaje Enviado</h1>
                <p>¡Gracias, ' . htmlspecialchars($nombre) . '! Tu mensaje ha sido enviado correctamente.</p>
                <p>Te responderemos lo antes posible.</p>
                <p><a href="javascript:history.back()">Volver al formulario</a></p>
            </div>
        </body>
        </html>
    ';
} else {
    // Error: Mostramos un mensaje de error.
    echo '
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <title>Error de Envío</title>
            <style>
                body { font-family: Arial, sans-serif; text-align: center; padding-top: 50px; }
                .message-box { border: 1px solid #F44336; padding: 20px; margin: 20px auto; width: 80%; max-width: 500px; background-color: #FFEBEE; color: #D32F2F; }
            </style>
        </head>
        <body>
            <div class="message-box">
                <h1>❌ Error de Envío</h1>
                <p>Lo sentimos, hubo un problema al enviar tu mensaje. Por favor, inténtalo de nuevo más tarde o contáctanos por otro medio.</p>
                <p><a href="javascript:history.back()">Volver al formulario</a></p>
            </div>
        </body>
        </html>
    ';
}

// Nota: Eliminamos el 'exit;' y la redirección.
?>
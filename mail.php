<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Cargar las dependencias de PHPMailer
require './PHPMailer-master/src/Exception.php';
require './PHPMailer-master/src/PHPMailer.php';
require './PHPMailer-master/src/SMTP.php';

// Capturar los datos del formulario
$nombre = $_POST['nombre'];
$edad = $_POST['edad'];
$localidad = $_POST['localidad'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$afiliacion = $_POST['afiliacion'];

// Inicializar PHPMailer
$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP de Hostinger
    $mail->isSMTP();
    $mail->Host = 'smtp.hostinger.com';  // Asegúrate de usar el host SMTP correcto de Hostinger
    $mail->SMTPAuth = true;
    $mail->Username = 'info@medicinaprivadapremedic.com.ar';  // Usuario SMTP
    $mail->Password = 'Guido0001@';  // Contraseña SMTP
    $mail->SMTPSecure = 'ssl';  // Puede ser 'ssl' o 'tls' dependiendo de tu configuración
    $mail->Port = 465;  // Puerto SMTP, generalmente 465 para 'ssl' y 587 para 'tls'

        // Establecer la codificación de caracteres
        $mail->CharSet = 'UTF-8';  // Añade esta línea

    // Configuración del remitente y destinatarios
    $mail->setFrom('info@medicinaprivadapremedic.com.ar', 'Formulario Web');  // Remitente del correo
    $mail->addAddress('info@medicinaprivadapremedic.com.ar');  // Primera dirección en Hostinger
    $mail->addAddress('consultasplanespremedic@gmail.com');   // Segunda dirección en Gmail
    $mail->addReplyTo($email, $nombre);  // Dirección de respuesta

    // Contenido del correo
    $mail->isHTML(true);  // Activar el formato HTML
    $mail->Subject = 'Nueva solicitud desde la Web';
    $mail->Body    = "<h1>Solicitud de Asesoramiento</h1>
                      <p><strong>Nombre:</strong> $nombre</p>
                      <p><strong>Edad:</strong> $edad</p>
                      <p><strong>Localidad:</strong> $localidad</p>
                      <p><strong>Teléfono o WhatsApp:</strong> $telefono</p>
                      <p><strong>Email:</strong> $email</p>
                      <p><strong>Tipo de Afiliación:</strong> $afiliacion</p>";
    $mail->AltBody = "Nombre: $nombre\nEdad: $edad\nLocalidad: $localidad\nTeléfono o WhatsApp: $telefono\nEmail: $email\nTipo de Afiliación: $afiliacion";

    // Enviar el correo
    if ($mail->send()) {
        // Redirigir a la página de gracias después del envío exitoso
        header('Location: /gracias/');
        exit();  // Importante para detener la ejecución después de la redirección
    } else {
        echo 'Hubo un error al enviar el mensaje';
    }
} catch (Exception $e) {
    echo "El mensaje no pudo ser enviado. Error: {$mail->ErrorInfo}";
}
?>

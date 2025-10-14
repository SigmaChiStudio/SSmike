<?php
// ======================= ENVÍO DE MENSAJE DE CONTACTO (PHPMailer) =======================
// Este archivo se encarga de recibir los datos del formulario de contacto y enviar un correo electrónico
// usando la librería PHPMailer. Es utilizado para que los usuarios puedan contactar a la empresa desde la web.

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Incluye el autoloader de Composer para cargar PHPMailer y sus dependencias
require_once __DIR__ . '/../vendor/autoload.php';

// ======================= VALIDACIÓN Y SANITIZACIÓN DE ENTRADAS =======================
// Se obtienen y limpian los datos enviados por POST desde el formulario de contacto.
// htmlspecialchars previene inyección de código HTML/JS y trim elimina espacios extra.
$nombre = htmlspecialchars(trim($_POST['nombre'] ?? ''));
$telefono = htmlspecialchars(trim($_POST['cel'] ?? ''));
$correo = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_EMAIL); // Sanitiza el correo electrónico
$mensaje = htmlspecialchars(trim($_POST['mensaje'] ?? ''));

// Se arma el cuerpo del mensaje que se enviará por correo
$body = "Nombre: " . $nombre . "<br>Telefono: " . $telefono . "<br>Correo : " . $correo . "<br>Mensaje : " . $mensaje;

// ======================= CONFIGURACIÓN DE PHPMailer =======================
// Se crea una instancia de PHPMailer para enviar el correo
$mail = new PHPMailer(true);

try {
    // Opciones de seguridad para la conexión SMTP
    $mail->SMTPOptions = [
        'ssl' => [
            'verify_peer' => true,
            'verify_peer_name' => true,
            'allow_self_signed' => false
        ]
    ];
    $mail->SMTPDebug = 0; // No mostrar mensajes de depuración
    $mail->isSMTP(); // Usar SMTP
    $mail->Host = 'smtp.gmail.com'; // Servidor SMTP de Gmail
    $mail->SMTPAuth = true; // Habilita autenticación SMTP
    $mail->Username = 'correo@ejemplo.com'; // Tu correo remitente
    $mail->Password = 'tu_contraseña'; // Tu contraseña de correo
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Encriptación segura
    $mail->Port = 587; // Puerto SMTP para TLS

    // Configuración del remitente y destinatario
    $mail->setFrom('correo@ejemplo.com', 'Nombre Remitente'); // Cambia por tu correo y nombre
    $mail->addAddress('correo@ejemplo.com'); // Cambia por el correo destinatario

    // Configuración del contenido del correo
    $mail->isHTML(true); // El correo se enviará en formato HTML
    $mail->Subject = 'Asunto del correo'; // Asunto del correo
    $mail->Body = $body; // Cuerpo del mensaje

    // ======================= ENVÍO DEL CORREO =======================
    $mail->send();
    // Si el envío es exitoso, muestra un mensaje y regresa a la página anterior
    echo '<script>
    alert("El mensaje se envió correctamente");
    window.history.go(-1);
    </script>';
} catch (Exception $e) {
    // Si ocurre un error, muestra el mensaje de error de PHPMailer
    echo "Error en el envío: {$mail->ErrorInfo}";
}
?>

<?php
// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Asignar los datos del formulario a variables
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = strip_tags(trim($_POST["message"]));

    // Especificar a dónde enviar el correo electrónico
    $recipient = "jonathan.pena@zenithsigma.cl";

    // Construir el cuerpo del mensaje de correo electrónico
    $email_content = "Nombre: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Mensaje:\n$message\n";

    // Construir las cabeceras del correo electrónico
    $email_headers = "From: $name <$email>";

    // Enviar el correo electrónico
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        // El correo se envió correctamente
        http_response_code(200);
        echo "Thank You! Your message has been sent.";
    } else {
        // El correo no se pudo enviar
        http_response_code(500);
        echo "Oops! Something went wrong and we couldn't send your message.";
    }
} else {
    // No es un método POST, establecer un código de respuesta 403 (prohibido)
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}
?>

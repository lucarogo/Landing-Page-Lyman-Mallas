<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['contactName']));
    $email = htmlspecialchars(trim($_POST['contactEmail']));
    $subject = htmlspecialchars(trim($_POST['contactSubject']));
    $message = htmlspecialchars(trim($_POST['contactMessage']));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>Swal.fire({ icon: 'error', title: 'Correo no válido', text: 'Por favor, ingresa un correo electrónico válido.' });</script>";
        exit;
    }

    $to = 'lyman.mallas@gmail.com';
    $email_subject = "Nuevo mensaje de contacto: $subject";
    $email_body = "Has recibido un nuevo mensaje de contacto.\n\n" .
                  "Nombre: $name\n" .
                  "Correo: $email\n" .
                  "Asunto: $subject\n" .
                  "Mensaje:\n$message";

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    if (mail($to, $email_subject, $email_body, $headers)) {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Mensaje enviado!',
                    text: 'Tu mensaje fue enviado con éxito.',
                    confirmButtonColor: '#4CAF50'
                }).then(() => {
                    document.getElementById('contactForm').reset();
                });
              </script>";
    } else {
        echo "<script>Swal.fire({ icon: 'error', title: 'Error', text: 'Algo salió mal. Inténtalo de nuevo.' });</script>";
    }
} else {
    echo "<script>Swal.fire({ icon: 'error', title: 'Método no permitido', text: 'Por favor, usa el formulario para enviar el mensaje.' });</script>";
}
?>

<?php
require "../Config/db.php";

$email = $_POST["email"];

try {
    // Preparar y ejecutar la consulta
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        // Usuario encontrado, redirigir a preguntas de seguridad
        header('Location: ../View/login/SecurityQuestions.php?id=' . $user['id']);
    } else {
        // Usuario no encontrado, mostrar mensaje de error
        $message = "El correo electrónico no se encuentra registrado.";
        $messageType = "danger";
        header('Location: ../View/login/password.php?message=' . urlencode($message) . '&type=' . urlencode($messageType));
    }
} catch (\PDOException $e) {
    echo "Error en la consulta: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Perfil</title>
    <script src="../js/sweetalert2@9.js"></script>
</head>
<body>

<?php

require_once "../Config/db.php";

$pregunta1 = $_POST['ask1'];
$pregunta2 = $_POST['ask2'];
$pregunta3 = $_POST['ask3'];

$respuesta1 = $_POST['answer1'];
$respuesta2 = $_POST['answer2'];
$respuesta3 = $_POST['answer3'];

$id_user = $_POST['id_user'];

try {
    $stmt = $pdo->prepare("SELECT * FROM security_questions WHERE user_id = ?");
    $stmt->execute([$id_user]);
    $user = $stmt->fetch();

    if ($user) {
        // Actualizar las preguntas de seguridad del usuario
        $stmt = $pdo->prepare("UPDATE security_questions SET ask1 = ?, ask2 = ?, ask3 = ?, answer1 = ?, answer2 = ?, answer3 = ? WHERE user_id = ?");
        $stmt->execute([$pregunta1, $pregunta2, $pregunta3, $respuesta1, $respuesta2, $respuesta3, $id_user]);
        
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: 'Preguntas y respuestas actualizadas exitosamente.',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '" . $_SERVER['HTTP_REFERER'] . "'; // Redirigir a la página anterior
                }
            });
        </script>";
    } else {
        // Registrar las preguntas de seguridad del usuario
        $stmt = $pdo->prepare("INSERT INTO security_questions (ask1, ask2, ask3, answer1, answer2, answer3, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$pregunta1, $pregunta2, $pregunta3, $respuesta1, $respuesta2, $respuesta3, $id_user]);
        
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: 'Preguntas y respuestas registradas exitosamente.',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '" . $_SERVER['HTTP_REFERER'] . "'; // Redirigir a la página anterior
                }
            });
        </script>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Cerrar la conexión PDO
$pdo = null;

?>
</body>
</html>

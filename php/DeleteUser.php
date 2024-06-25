<?php
session_start();

require_once "../Config/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['id'];

    // Verificar si el usuario actual está intentando eliminar su propia cuenta
    if ($_SESSION['user_id'] == $userId) {
        // Si el usuario está intentando eliminar su propia cuenta, mostrar un mensaje de error y redirigir
        header('Location: ../View/Users.php?message=' . urlencode('No puedes eliminar tu propia cuenta mientras estás logeado.') . '&type=danger');
        exit();
    }

    // Consulta SQL para eliminar el usuario
    $sql = 'DELETE FROM users WHERE id = :id';

    // Preparar y ejecutar la consulta
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $userId]);

    // Redirigir con un mensaje de éxito
    header('Location: ../View/Users.php?message=' . urlencode('Usuario eliminado exitosamente.') . '&type=success');
    exit();
}
?>

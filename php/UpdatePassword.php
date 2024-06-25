<?php

require_once '../Config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_GET['id'];
    $password = $_POST['password'];

    // Hash de la nueva contraseña
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Actualizar la contraseña del usuario en la base de datos
        $stmt = $pdo->prepare('UPDATE users SET password = :password WHERE id = :id');
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            // Redirigir con mensaje de éxito
            header('Location: ../View/login/index.php?message=' . urlencode('La contraseña ha sido actualizada con éxito.') . '&type=success');
        } else {
            // Redirigir con mensaje de error
            header('Location: ../View/login/index.php?message=' . urlencode('Error al actualizar la contraseña.') . '&type=danger');
        }
        exit();
    } catch (PDOException $e) {
        // Redirigir con mensaje de error
        header('Location: ../View/login/index.php?message=' . urlencode('Error al actualizar la contraseña: ' . $e->getMessage()) . '&type=danger');
        exit();
    }
}

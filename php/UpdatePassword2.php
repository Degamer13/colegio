<?php
require_once "../Config/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $new_password = $_POST['password'];

    // Aquí puedes agregar la lógica para validar y procesar la nueva contraseña
    // Por ejemplo, encriptar la nueva contraseña
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    try {
        $query = "UPDATE users SET password = :password WHERE id = :user_id";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['password' => $hashed_password, 'user_id' => $user_id]);

        header('Location: ../View/perfil.php?password_updated=true');
        exit();
    } catch (Exception $e) {
        die('Error al actualizar la contraseña: ' . $e->getMessage());
    }
} else {
    header('Location: ../View/perfil.php?message=' . urlencode('Método no permitido.') . '&type=danger');
    exit();
}
?>

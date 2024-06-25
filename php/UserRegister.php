<?php
require '../Config/db.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role_id = $_POST['role_id'];

    // Validar si el username o el email ya existen
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM users WHERE username = ? OR email = ?');
    $stmt->execute([$username, $email]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        // Redirigir con mensaje de error
        header('Location: ../View/login/register.php?message=' . urlencode('El nombre de usuario o el correo electrónico ya están registrados.') . '&type=danger');
    } else {
        // Hash de la contraseña
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insertar el nuevo usuario en la base de datos
        $stmt = $pdo->prepare('INSERT INTO users (username, email, password, role_id) VALUES (?, ?, ?, ?)');
        $stmt->execute([$username, $email, $hashedPassword, $role_id]);

        // Redirigir con mensaje de éxito
        header('Location: ../View/login/index.php?message=' . urlencode('Usuario registrado con éxito.') . '&type=success');
    }
    exit();
}
?>

<?php
session_start();
require '../Config/db.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Buscar el usuario por correo electrónico
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Configurar la sesión
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role_id'] = $user['role_id'];

        // Redirigir según el role_id
        if ($user['role_id'] == 1) {
            header('Location: ../View/home.php');
        } else if ($user['role_id'] == 2) {
            header('Location: ../View/home.php');
        } else {
            // Redirigir con mensaje de error si el role_id no es válido
            header('Location: ../View/login/index.php?message=' . urlencode('Rol de usuario no válido.') . '&type=danger');
        }
    } else {
        // Redirigir con mensaje de error
        header('Location: ../View/login/index.php?message=' . urlencode('Correo electrónico o contraseña incorrectos.') . '&type=danger');
    }
    exit();
}
?>

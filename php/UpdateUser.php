<?php
session_start();
require_once "../Config/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['userId'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role_id = $_POST['role_id'];

    // Crear un array para almacenar los parámetros de la consulta
    $params = [
        'username' => $username,
        'email' => $email,
        'role_id' => $role_id,
        'id' => $userId
    ];

    // Crear la consulta SQL inicial
    $sql = 'UPDATE users SET username = :username, email = :email, role_id = :role_id';

    // Si se proporciona una nueva contraseña, agregarla a la consulta y encriptarla
    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql .= ', password = :password';
        $params['password'] = $hashedPassword;
    }

    // Completar la consulta SQL
    $sql .= ' WHERE id = :id';

    // Preparar y ejecutar la consulta
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    // Verificar si el usuario actualizó su propio nombre de usuario o email y actualizar la sesión
    if ($_SESSION['user_id'] == $userId) {
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
    }

    // Redirigir con un mensaje de éxito
    header('Location: ../View/Users.php?message=' . urlencode('Usuario actualizado exitosamente.') . '&type=success');
    exit();
}
?>


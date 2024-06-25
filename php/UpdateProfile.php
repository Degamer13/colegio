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
require '../Config/db.php';
session_start();

$id = $_GET['id'];
$username = $_POST['username'];
$email = $_POST['email'];

try {
    $query = "UPDATE users SET username = :username, email = :email WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Actualizar los datos de la sesión
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;

        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'Perfil actualizado correctamente'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '" . $_SERVER["HTTP_REFERER"] . "';
                    }
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al actualizar el perfil'
                });
              </script>";
    }
} catch (PDOException $e) {
    echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un problema al actualizar el perfil: " . $e->getMessage() . "'
            });
          </script>";
}
?>

</body>
</html>

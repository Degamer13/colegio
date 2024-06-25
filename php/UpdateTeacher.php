<?php
require_once "../Config/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idTeacher = $_POST['id_teacher'];
    $name1_teacher = $_POST['name1_teacher'];
    $name2_teacher = $_POST['name2_teacher'];
    $last_name1_teacher = $_POST['last_name1_teacher'];
    $last_name2_teacher = $_POST['last_name2_teacher'];
    $id_card_teacher = $_POST['id_card_teacher'];
    $email_teacher = $_POST['email_teacher'];
    $phone_teacher = $_POST['phone_teacher'];
    $degree_id = $_POST['degree_id'];

    $stmt = $pdo->prepare('UPDATE teachers SET name1_teacher = :name1_teacher, name2_teacher = :name2_teacher, last_name1_teacher = :last_name1_teacher, last_name2_teacher = :last_name2_teacher, id_card_teacher = :id_card_teacher, email_teacher = :email_teacher, phone_teacher = :phone_teacher, degree_id = :degree_id WHERE id_teacher = :idTeacher');
    $stmt->execute([
        'name1_teacher' => $name1_teacher,
        'name2_teacher' => $name2_teacher,
        'last_name1_teacher' => $last_name1_teacher,
        'last_name2_teacher' => $last_name2_teacher,
        'id_card_teacher' => $id_card_teacher,
        'email_teacher' => $email_teacher,
        'phone_teacher' => $phone_teacher,
        'degree_id' => $degree_id,
        'idTeacher' => $idTeacher
    ]);

    // Verificar si se realizó la actualización correctamente
    if ($stmt->rowCount() > 0) {
        // La actualización fue exitosa
        $successMessage = "El docente se actualizó correctamente.";
        // Redirigir a la página de docentes con el mensaje de éxito
        header('Location: ../View/Teachers.php?updated=true&message=' . urlencode($successMessage));
        exit();
    } else {
        // No se pudo actualizar el docente
        $errorMessage = "No se pudo actualizar el docente. Por favor, inténtalo de nuevo.";
        // Redirigir a la página de docentes con el mensaje de error
        header('Location: ../View/Teachers.php?message=' . urlencode($errorMessage));
        exit();
    }
}
?>

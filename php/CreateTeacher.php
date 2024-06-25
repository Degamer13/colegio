<?php

require_once"../Config/db.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name1_teacher = $_POST['name1_teacher'];
    $name2_teacher = $_POST['name2_teacher'];
    $last_name1_teacher = $_POST['last_name1_teacher'];
    $last_name2_teacher = $_POST['last_name2_teacher'];
    $id_card_teacher = $_POST['id_card_teacher'];
    $email_teacher = $_POST['email_teacher'];
    $phone_teacher = $_POST['phone_teacher'];
    $degree_id = $_POST['degree_id'];

    // Verificar si el email, teléfono o cédula ya existen
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM teachers WHERE email_teacher = :email_teacher OR id_card_teacher = :id_card_teacher');
    $stmt->execute(['email_teacher' => $email_teacher,'id_card_teacher' => $id_card_teacher]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        // Redirigir con mensaje de error
        header('Location: ../View/createTeacher.php?error=exists');
        exit();
    }

    $stmt = $pdo->prepare('INSERT INTO teachers (name1_teacher, name2_teacher, last_name1_teacher, last_name2_teacher, id_card_teacher, email_teacher, phone_teacher, degree_id) VALUES (:name1_teacher, :name2_teacher, :last_name1_teacher, :last_name2_teacher, :id_card_teacher, :email_teacher, :phone_teacher, :degree_id)');
    $stmt->execute([
        'name1_teacher' => $name1_teacher,
        'name2_teacher' => $name2_teacher,
        'last_name1_teacher' => $last_name1_teacher,
        'last_name2_teacher' => $last_name2_teacher,
        'id_card_teacher' => $id_card_teacher,
        'email_teacher' => $email_teacher,
        'phone_teacher' => $phone_teacher,
        'degree_id' => $degree_id
    ]);

    header('Location: ../View/Teachers.php?added=true');
    exit();
}
?>


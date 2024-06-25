<?php
require_once"../Config/db.php";


if (isset($_POST['delete_teacher_id'])) {
    $teacherId = $_POST['delete_teacher_id'];
    
    $stmt = $pdo->prepare('DELETE FROM teachers WHERE id_teacher = :id_teacher');
    $stmt->execute(['id_teacher' => $teacherId]);
    
    header('Location: ../View/Teachers.php?deleted=true');
    exit();
}
?>

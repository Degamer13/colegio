<?php
require_once '../Config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger los datos del formulario
    $id_report = $_POST['id_report'];
    $student_id = $_POST['student_id'];
    $lapse = $_POST['lapse'];
    $year_educ = $_POST['year_educ'];
    $qualification = $_POST['qualification'];
    $degree_id2 = $_POST['degree_id2'];
    $promovide = $_POST['promovide'];
    $description2 = $_POST['description2'];

    // Validar que todos los campos estén completos
    if (empty($id_report) || empty($student_id) || empty($lapse) || empty($year_educ) || empty($qualification) || empty($degree_id2) || empty($promovide) || empty($description2)) {
        header('Location: ../View/createNote.php?error=emptyfields');
        exit();
    }

    try {
        // Preparar la consulta SQL
        $sql = "UPDATE report_card SET student_id=?, lapse=?, year_educ=?, qualification=?, degree_id2=?, promovide=?, description2=? WHERE id_report=?";
        $stmt = $pdo->prepare($sql);
        
        // Ejecutar la consulta
        $stmt->execute([$student_id, $lapse, $year_educ, $qualification, $degree_id2, $promovide, $description2, $id_report]);

        // Redirigir al formulario con un mensaje de éxito
        header('Location: ../View/Notes4.php?updated=true');
    } catch (PDOException $e) {
        // Redirigir al formulario con un mensaje de error
        header('Location: ../View/admin/registro_nota.php?error=sqlerror');
    }
} else {
    // Redirigir al formulario si el método no es POST
    header('Location: ../View/admin/registro_nota.php');
    exit();
}
?>
<?php
require_once"../Config/db.php";


if (isset($_POST['delete_student_id'])) {
    $studentId = $_POST['delete_student_id'];
    
    $stmt = $pdo->prepare('DELETE FROM students WHERE id_student = :id_student');
    $stmt->execute(['id_student' => $studentId]);
    
    $previousPage = $_SERVER['HTTP_REFERER'];
$separator = (parse_url($previousPage, PHP_URL_QUERY) == NULL) ? '?' : '&';
header('Location: ' . $previousPage . $separator . 'deleted=true');
exit();


}
?>

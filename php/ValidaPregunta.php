<?php
require_once "../Config/db.php";
session_start();
$id = $_GET['id'];
$answer1 = $_POST["answer1"];
$answer2 = $_POST["answer2"];
$answer3 = $_POST['answer3'];

try {
    $stmt = $pdo->prepare("SELECT * FROM security_questions WHERE user_id = ? AND answer1 = ? AND answer2 = ? AND answer3 = ?");
    $stmt->execute([$id, $answer1, $answer2, $answer3]);
    $filas = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($filas["user_id"]) {

            header('location: ../View/login/ResetPassword.php?id='.$id);
            
        exit();
    } else {
        $message = "Una de las respuestas es incorrecta";
        header('Location: ../View/login/index.php?id=' . $id . '&message=' . urlencode($message) .'&type=danger');
        exit();
    }
} catch (PDOException $e) {
    $message = "Error al validar las respuestas de seguridad: " . $e->getMessage();
    header('Location: ../../View/responder_preguntas.php?id=' . $id . '&message=' . urlencode($message) . '&type=danger');
    exit();
}
?>

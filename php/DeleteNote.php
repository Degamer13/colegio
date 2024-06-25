<?php
require_once"../Config/db.php";


if (isset($_POST['delete_note_id'])) {
    $noteId = $_POST['delete_note_id'];
    
    $stmt = $pdo->prepare('DELETE FROM report_card WHERE id_report = :id_report');
    $stmt->execute(['id_report' => $noteId]);
    
   $previousPage = $_SERVER['HTTP_REFERER'];
$separator = (parse_url($previousPage, PHP_URL_QUERY) == NULL) ? '?' : '&';
header('Location: ' . $previousPage . $separator . 'deleted=true');
exit();
}
?>

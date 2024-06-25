<?php

require_once"../Config/db.php";

// Consulta para obtener los datos de la tabla degrees
$stmt = $pdo->query('SELECT * FROM students');
$students = $stmt->fetchAll();
?>
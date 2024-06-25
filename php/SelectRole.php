<?php

require_once"../Config/db.php";

// Consulta para obtener los datos de la tabla degrees
$stmt = $pdo->query('SELECT id_role, description FROM role');
$roles = $stmt->fetchAll();
?>
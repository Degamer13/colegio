<?php
require_once '../Config/db.php';

function countUsers($pdo) {
    try {
        $stmt = $pdo->query('SELECT COUNT(*) FROM users');
        $count = $stmt->fetchColumn();
        return $count;
    } catch (PDOException $e) {
        // Manejo de errores
        echo 'Error: ' . $e->getMessage();
        return 0;
    }
}

// Obtener el conteo de usuarios
$userCount = countUsers($pdo);

function countRoles($pdo) {
    try {
        $stmt = $pdo->query('SELECT COUNT(*) FROM role');
        $count1 = $stmt->fetchColumn();
        return $count1;
    } catch (PDOException $e) {
        // Manejo de errores
        echo 'Error: ' . $e->getMessage();
        return 0;
    }
}

// Obtener el conteo de roles
$roleCount = countRoles($pdo);

function countTeacher($pdo) {
    try {
        $stmt = $pdo->query('SELECT COUNT(*) FROM teachers');
        $count2 = $stmt->fetchColumn();
        return $count2;
    } catch (PDOException $e) {
        // Manejo de errores
        echo 'Error: ' . $e->getMessage();
        return 0;
    }
}

// Obtener el conteo de docentes
$teacherCount = countTeacher($pdo);

function countStudent($pdo) {
    try {
        $stmt = $pdo->query('SELECT COUNT(*) FROM students');
        $count3 = $stmt->fetchColumn();
        return $count3;
    } catch (PDOException $e) {
        // Manejo de errores
        echo 'Error: ' . $e->getMessage();
        return 0;
    }
}

// Obtener el conteo de estudiantes
$studentCount = countStudent($pdo);
?>



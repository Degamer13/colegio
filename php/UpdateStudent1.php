<?php
require_once "../Config/db.php";

// Verificar si se recibió una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se recibieron los datos del estudiante
    $student_fields = ['id_student', 'name1', 'name2', 'last_name1', 'last_name2', 'id_card', 'gender', 'birthdate', 'year', 'birthplace', 'state', 'country', 'nationality', 'address', 'another_squad', 'repeat_student', 'student_illness', 'student_lives_with', 'medical_assistance', 'currently_vaccinated', 'academic_activity', 'degree_id'];
    $representative_fields = ['student_id', 'mother', 'id_card_mother', 'year_mother', 'address_mother', 'status_mother', 'profession_mother', 'workplace_mother', 'room_phone_mother', 'mobile_phone_mother', 'work_phone_mother', 'father', 'id_card_father', 'year_father', 'address_father', 'status_father', 'profession_father', 'workplace_father', 'room_phone_father', 'mobile_phone_father', 'work_phone_father'];
    $responsible_fields = ['student_id2', 'responsible', 'id_card_responsible', 'year_responsible', 'address_responsible', 'profession_responsible', 'workplace_responsible'];
    $all_fields = array_merge($student_fields, $representative_fields, $responsible_fields);

    $missing_fields = array_diff($all_fields, array_keys($_POST));
    
    if (empty($missing_fields)) {
        try {
            // Iniciar la transacción
            $pdo->beginTransaction();

            // Actualizar estudiante
            $stmt = $pdo->prepare("UPDATE students SET name1 = ?, name2 = ?, last_name1 = ?, last_name2 = ?, id_card = ?, gender = ?, birthdate = ?, year = ?, birthplace = ?, state = ?, country = ?, nationality = ?, address = ?, another_squad = ?, repeat_student = ?, student_illness = ?, student_lives_with = ?, medical_assistance = ?, currently_vaccinated = ?, academic_activity = ?, degree_id = ? WHERE id_student = ?");
            $stmt->execute([
                $_POST['name1'], $_POST['name2'], $_POST['last_name1'], $_POST['last_name2'], $_POST['id_card'], $_POST['gender'], $_POST['birthdate'], $_POST['year'], $_POST['birthplace'], $_POST['state'], $_POST['country'], $_POST['nationality'], $_POST['address'], $_POST['another_squad'], $_POST['repeat_student'], $_POST['student_illness'], $_POST['student_lives_with'], $_POST['medical_assistance'], $_POST['currently_vaccinated'], $_POST['academic_activity'], $_POST['degree_id'], $_POST['id_student']
            ]);

            // Actualizar representante
            $stmt = $pdo->prepare("UPDATE representatives SET mother = ?, id_card_mother = ?, year_mother = ?, address_mother = ?, status_mother = ?, profession_mother = ?, workplace_mother = ?, room_phone_mother = ?, mobile_phone_mother = ?, work_phone_mother = ?, father = ?, id_card_father = ?, year_father = ?, address_father = ?, status_father = ?, profession_father = ?, workplace_father = ?, room_phone_father = ?, mobile_phone_father = ?, work_phone_father = ? WHERE student_id = ?");
            $stmt->execute([
                $_POST['mother'], $_POST['id_card_mother'], $_POST['year_mother'], $_POST['address_mother'], $_POST['status_mother'], $_POST['profession_mother'], $_POST['workplace_mother'], $_POST['room_phone_mother'], $_POST['mobile_phone_mother'], $_POST['work_phone_mother'], $_POST['father'], $_POST['id_card_father'], $_POST['year_father'], $_POST['address_father'], $_POST['status_father'], $_POST['profession_father'], $_POST['workplace_father'], $_POST['room_phone_father'], $_POST['mobile_phone_father'], $_POST['work_phone_father'], $_POST['student_id']
            ]);

            // Actualizar responsable
            $stmt = $pdo->prepare("UPDATE responsibles SET responsible = ?, id_card_responsible = ?, year_responsible = ?, address_responsible = ?, profession_responsible = ?, workplace_responsible = ? WHERE student_id2 = ?");
            $stmt->execute([
                $_POST['responsible'], $_POST['id_card_responsible'], $_POST['year_responsible'], $_POST['address_responsible'], $_POST['profession_responsible'], $_POST['workplace_responsible'], $_POST['student_id2']
            ]);

            // Confirmar la transacción
            $pdo->commit();
            
            header('Location: ../View/Students1.php?updated=true');
            exit();
        } catch (PDOException $e) {
            // Si hay un error, revertir la transacción
            $pdo->rollback();
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Faltan los siguientes campos: " . implode(", ", $missing_fields);
    }
} else {
    echo "Este script solo maneja solicitudes POST.";
}
?>
<?php
require_once "../View/layaouts/admin/Head.php";
session_start();
if (!isset($_SESSION['user_id']) || !in_array($_SESSION['role_id'], [1, 2])) {
    header('Location: ../View/login/index.php?message=' . urlencode('Acceso denegado.') . '&type=danger');
    exit();
}
require_once "../Config/db.php";

// Consulta para obtener los datos de los estudiantes y el docente de sexto grado
$sql = '
SELECT 
    s.id_student,
    s.name1, 
    s.last_name1, 
    s.id_card, 
    s.gender, 
    d.description AS degree_description,
    t.name1_teacher AS teacher_name,
    t.last_name1_teacher AS teacher_last_name,
    t.id_card_teacher AS teacher_id_card
FROM 
    students s 
LEFT JOIN 
    degrees d ON s.degree_id = d.id_degree
LEFT JOIN
    teachers t ON t.degree_id = d.id_degree
WHERE 
    d.description = "6to Grado";
';

$stmt = $pdo->query($sql);
$results = $stmt->fetchAll();
$students = [];
$teacher = null;

// Separate student and teacher data
foreach ($results as $result) {
    $students[] = $result;
    if ($teacher === null) {
        $teacher = [
            'teacher_name' => $result['teacher_name'],
            'teacher_last_name' => $result['teacher_last_name'],
            'teacher_id_card' => $result['teacher_id_card'],
        ];
    }
}

require_once "../View/layaouts/admin/nav.php";
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Lista de Estudiantes de Sexto Grado</h1>

            <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 'true'): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Estudiante eliminado exitosamente.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['added']) && $_GET['added'] == 'true'): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Estudiante agregado exitosamente.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['updated']) && $_GET['updated'] == 'true'): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Estudiante actualizado exitosamente.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                </div>
                <div class="card-body">
                    <?php if (!empty($students)): ?>
                        <table id="datatablesSimple" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Cédula</th>
                                    <th>Genero</th>
                                    <th>Grado</th>
                                    <th>Visualizar</th>
                                    <?php if ($_SESSION['role_id'] != 2): ?>
                                        <th>Actualizar</th>
                                        <th>Eliminar</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($students as $student): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($student['name1']); ?></td>
                                        <td><?php echo htmlspecialchars($student['last_name1']); ?></td>
                                        <td><?php echo htmlspecialchars($student['id_card']); ?></td>
                                        <td><?php echo htmlspecialchars($student['gender']); ?></td>
                                        <td><?php echo htmlspecialchars($student['degree_description']); ?></td>
                                        <td><a href="../View/viewStudent5.php?id=<?php echo $student['id_student']; ?>" class="btn btn-primary"><i class="fas fa-eye"></i></a></td>
                                        <?php if ($_SESSION['role_id'] != 2): ?>
                                            <td><a href="../View/editStudent5.php?id=<?php echo $student['id_student']; ?>" class="btn btn-success"><i class="fas fa-pen"></i></a></td>
                                            <td>
                                                <!-- Botón que activa el modal -->
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $student['id_student']; ?>">
                                                    <i class="fas fa-trash"></i>
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="deleteModal<?php echo $student['id_student']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo $student['id_student']; ?>" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel<?php echo $student['id_student']; ?>">Confirmar Eliminación</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                ¿Estás seguro de que quieres eliminar este estudiante? No podrás revertir esto.
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                                <form method="post" action="../php/DeleteStudent.php" style="display:inline;">
                                                                    <input type="hidden" name="delete_student_id" value="<?php echo $student['id_student']; ?>">
                                                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>No hay estudiantes de sexto grado registrados.</p>
                    <?php endif; ?>
                </div>
            </div>
            <?php if ($teacher): ?>
                <b style="text-transform: uppercase">Docente: <?php echo htmlspecialchars($teacher['teacher_name'] . ' ' . $teacher['teacher_last_name'] . ' ' . $teacher['teacher_id_card']); ?></b>
            <?php else: ?>
                <p>No hay datos del docente.</p>
            <?php endif; ?>
        </div>
    </main>

    <?php require_once "../View/layaouts/admin/Footer.php"; ?>
</div>

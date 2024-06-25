<?php
require_once "../View/layaouts/admin/Head.php";
session_start();

if (!isset($_SESSION['user_id']) || !in_array($_SESSION['role_id'], [1, 2])) {
    header('Location: ../View/login/index.php?message=' . urlencode('Acceso denegado.') . '&type=danger');
    exit();
}
require_once "../Config/db.php";

// Consulta para obtener los datos de la tabla teachers
$sql = '
    SELECT 
        t.id_teacher,
        t.name1_teacher, 
        t.name2_teacher,
        t.last_name1_teacher, 
        t.last_name2_teacher, 
        t.id_card_teacher, 
        t.email_teacher, 
        t.phone_teacher, 
        d.description AS degree_description
    FROM 
        teachers t
    LEFT JOIN 
        degrees d ON t.degree_id = d.id_degree
';

$stmt = $pdo->query($sql);
$teachers = $stmt->fetchAll();
require_once "../View/layaouts/admin/nav.php";
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Lista de Docentes</h1>

            <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 'true'): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Docente eliminado exitosamente.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['added']) && $_GET['added'] == 'true'): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Docente agregado exitosamente.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['updated']) && $_GET['updated'] == 'true'): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Docente actualizado exitosamente.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Cédula</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Grado</th>
                                <?php if ($_SESSION['role_id'] != 2): ?>
                                <th>Actualizar</th>
                                <th>Eliminar</th>
                                <?php endif; ?>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($teachers as $teacher): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($teacher['name1_teacher'].  ' ' .$teacher['name2_teacher']); ?></td>

                                    <td><?php echo htmlspecialchars($teacher['last_name1_teacher'].' '.$teacher['last_name2_teacher']); ?></td>
                                    <td><?php echo htmlspecialchars($teacher['id_card_teacher']); ?></td>
                                    <td><?php echo htmlspecialchars($teacher['email_teacher']); ?></td>
                                    <td><?php echo htmlspecialchars($teacher['phone_teacher']); ?></td>
                                    <td><?php echo htmlspecialchars($teacher['degree_description']); ?></td>
                                    <?php if ($_SESSION['role_id'] != 2): ?>
                                         <td><a href="../View/editTeacher.php?id=<?php echo $teacher['id_teacher']; ?>" class="btn btn-success"><i class="fas fa-pen"></i></a></td>
                                    <td>
                                        <!-- Botón que activa el modal -->
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $teacher['id_teacher']; ?>">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="deleteModal<?php echo $teacher['id_teacher']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo $teacher['id_teacher']; ?>" aria-hidden="true">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel<?php echo $teacher['id_teacher']; ?>">Confirmar Eliminación</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <div class="modal-body">
                                                ¿Estás seguro de que quieres eliminar este docente? No podrás revertir esto.
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <form method="post" action="../php/DeleteTeacher.php" style="display:inline;">
                                                    <input type="hidden" name="delete_teacher_id" value="<?php echo $teacher['id_teacher']; ?>">
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
                </div>
            </div>
        </div>
    </main>

    <?php require_once "../View/layaouts/admin/Footer.php"; ?>
</div>

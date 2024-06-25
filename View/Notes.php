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
SELECT r.id_report, s.name1, s.last_name1, s.id_card, r.lapse, r.year_educ, r.qualification, d.description, r.promovide, r.description2 
FROM report_card r 
JOIN students s ON r.student_id = s.id_student
JOIN degrees d ON r.degree_id2 = d.id_degree WHERE 
    d.description = "1er Grado";'
;

$stmt = $pdo->query($sql);
$notas = $stmt->fetchAll();
require_once "../View/layaouts/admin/nav.php";
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Lista de Notas de Primer Grado</h1>

            <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 'true'): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Nota eliminada exitosamente.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['added']) && $_GET['added'] == 'true'): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Nota agregada exitosamente.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['updated']) && $_GET['updated'] == 'true'): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Nota actualizada exitosamente.
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
                            
                    <th >Estudiante</th>
                    <th >Cedula</th>
                    <th >Lapso</th>
                    <th >Año Escolar</th>
                    <th >Nota</th>
                    <th >Grado</th>
                    <th >Promovido</th>
                    <th >Apreciación Cualitativa</th>
                                <?php if ($_SESSION['role_id'] != 2): ?>
                                <th>Actualizar</th>
                                <th>Pdf</th>
                                <th>Eliminar</th>
                                <?php endif; ?>
                                
                            </tr>
                        </thead>
                        <tbody>
                <?php foreach ($notas as $nota): ?>
                <tr>
                    <td><?php echo htmlspecialchars($nota['name1'] . ' ' . $nota['last_name1']); ?></td>
                    <td><?php echo htmlspecialchars($nota['id_card']); ?></td>
                    <td><?php echo htmlspecialchars($nota['lapse']); ?></td>
                    <td><?php echo htmlspecialchars($nota['year_educ']); ?></td>
                    <td><?php echo htmlspecialchars($nota['qualification']); ?></td>
                    
                    <td><?php echo htmlspecialchars($nota['description']); ?></td>
                    <td><?php echo htmlspecialchars($nota['promovide']); ?></td>
                    <td><?php echo htmlspecialchars($nota['description2']); ?></td>
          
               
         
                                    <?php if ($_SESSION['role_id'] != 2): ?>
                                        
                                         <td><a href="../View/editNote.php?id=<?php echo $nota['id_report']; ?>" class="btn btn-success"><i class="fas fa-pen"></i></a></td>
                                         <td><a  target='_blank' href="../View/pdfStudent.php?id=<?php echo $nota['id_report']; ?>" class="btn btn-warning"><i class="fas fa-file-pdf"></i></a></td>
                                    <td>
                                        <!-- Botón que activa el modal -->
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $nota['id_report']; ?>">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="deleteModal<?php echo $nota['id_report']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo $nota['id_report']; ?>" aria-hidden="true">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel<?php echo $nota['id_report']; ?>">Confirmar Eliminación</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <div class="modal-body">
                                                ¿Estás seguro de que quieres eliminar la nota? No podrás revertir esto.
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <form method="post" action="../php/DeleteNote.php" style="display:inline;">
                                                    <input type="hidden" name="delete_note_id" value="<?php echo $nota['id_report']; ?>">
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

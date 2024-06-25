<?php
require_once "../View/layaouts/admin/Head.php";
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
    header('Location: ../View/login/index.php?message=' . urlencode('Acceso denegado.') . '&type=danger');
    exit();
}
require_once "../Config/db.php";

// Consulta para obtener los datos de la tabla users y role
$sql = '
    SELECT 
        u.id,
        u.username, 
        u.email, 
        r.description AS role_description
    FROM 
        users u
    LEFT JOIN 
        role r ON u.role_id = r.id_role
';

$stmt = $pdo->query($sql);
$users = $stmt->fetchAll();
require_once "../View/layaouts/admin/nav.php";
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Lista de Usuarios</h1>

            <?php if (isset($_GET['message'])): ?>
                <div class="alert alert-dismissible fade show <?= $_GET['type'] === 'success' ? 'alert-success' : 'alert-danger' ?>" role="alert">
                    <?= htmlspecialchars($_GET['message']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Lista de Usuarios
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nombre de Usuario</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th>Actualizar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                                    <td><?php echo htmlspecialchars($user['role_description']); ?></td>
                                    <td>
                                        <a href="../View/editUser.php?id=<?php echo $user['id']; ?>" class="btn btn-success"><i class="fas fa-pen"></i></a>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $user['id']; ?>"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>

                                <!-- Modal -->
                                <div class="modal fade" id="deleteModal<?php echo $user['id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo $user['id']; ?>" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel<?php echo $user['id']; ?>">Confirmar Eliminación</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        ¿Estás seguro de que quieres eliminar este usuario? No podrás revertir esto.
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <form method="post" action="../php/DeleteUser.php" style="display:inline;">
                                            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <?php require_once "../View/layaouts/admin/Footer.php"; ?>
</div>

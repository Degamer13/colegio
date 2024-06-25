<?php
require_once "../View/layaouts/admin/Head.php";
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
    header('Location: ../View/login/index.php?message=' . urlencode('Acceso denegado.') . '&type=danger');
    exit();
}
require_once "../Config/db.php";
require_once "../php/SelectRole.php";

// Obtener los datos del usuario
$userId = $_GET['id'];
$stmt = $pdo->prepare('SELECT * FROM users WHERE id = :id');
$stmt->execute(['id' => $userId]);
$user = $stmt->fetch();

if (!$user) {
    header('Location: ../View/Users.php?message=' . urlencode('Usuario no encontrado.') . '&type=danger');
    exit();
}
require_once "../View/layaouts/admin/nav.php";
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <!-- Mostrar mensajes de éxito o error -->
            <br>
            <?php if (isset($_GET['message'])): ?>
                <div class="alert alert-dismissible fade show <?= $_GET['type'] === 'success' ? 'alert-success' : 'alert-danger' ?>" role="alert">
                    <?= htmlspecialchars($_GET['message']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <br>
            <div id="message" class="alert d-none" role="alert"></div>

            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <center><img src="../assets/img/logo.png" width="25%" alt=""></center>
                        <div class="card-header"><h3 class="text-center font-weight-light my-2">Actualizar Usuario</h3></div>
                        <div class="card-body">
                            <form action="../php/UpdateUser.php" method="post" onsubmit="return validarClave()">
                                <input type="hidden" name="userId" value="<?php echo $user['id']; ?>">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="inputUsername" type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required />
                                    <label for="inputUsername">Nombre de Usuario</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="inputEmail" type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required />
                                    <label for="inputEmail">Correo Electrónico</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="password" type="password" name="password" maxlength='15' minlength='8' placeholder="Deje en blanco si no desea cambiarla" />
                                    <label for="password">Contraseña (Deje en blanco si no desea cambiarla)</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="confirmPassword" type="password" maxlength='15' minlength='8' placeholder="Deje en blanco si no desea cambiarla" />
                                    <label for="confirmPassword">Confirmar Contraseña (Deje en blanco si no desea cambiarla)</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="roleSelect" name="role_id" required>
                                        <option value="">Selecciona un Rol</option>
                                        <?php foreach ($roles as $role): ?>
                                            <option value="<?php echo $role['id_role']; ?>" <?php if ($role['id_role'] == $user['role_id']) echo 'selected'; ?>>
                                                <?php echo $role['description']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mt-4 mb-0">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary btn-block">Actualizar Usuario</button>
                                    </div>
                                    </form>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                
            
                </main>

<?php
require_once "../View/layaouts/admin/Footer.php";
?>

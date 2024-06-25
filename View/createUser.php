<?php
require_once"../View/layaouts/admin/Head.php";

?>
<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
    header('Location: ../View/login/index.php?message=' . urlencode('Acceso denegado.') . '&type=danger');
    exit();
}
require_once"../Config/db.php";
require_once"../php/SelectRole.php";
?>
<?php
require_once"../View/layaouts/admin/nav.php"
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
                           <!-- Mostrar mensajes de éxito o error -->
                           <div id="message" class="alert d-none" role="alert"></div>
                          
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <center><img src="../assets/img/logo.png" width="25%" alt=""></center> 
                                    <div class="card-header"><h3 class="text-center font-weight-light my-2">Crear Usuario</h3></div>
                                    <div class="card-body">
                                   
    <form action="../php/CreateUser.php" method="post" onsubmit="return validarClave()">
   
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="text" placeholder="name@example.com" name="username" required />
                                                <label for="inputEmail">Nombre de Usuario</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="email" placeholder="name@example.com" name="email" required />
                                                <label for="inputEmail">Correo Electrónico</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="password"type="password" placeholder="name@example.com" name="password" maxlength='15' minlength='8' required />
                                                <label for="inputEmail">Contraseña</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="confirmPassword"  type="password" placeholder="name@example.com" maxlength='15' minlength='8'  required />
                                                <label for="inputEmail">Confirmar Contraseña</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                            <select class="form-select" id="degreeSelect" name="role_id" required >
            <option value="">Selecciona un Rol</option>
            <?php foreach ($roles as $role): ?>
                <option value="<?php echo $role['id_role']; ?>">
                    <?php echo $role['description']; ?>
                </option>
            <?php endforeach; ?>
        </select>
                                            </div>
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary btn-block">Crear Usuario</button>
                                                   
                                            </div>
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                
            
                </main>

<?php
require_once"../View/layaouts/admin/Footer.php";

?>
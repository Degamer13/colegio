<?php
require_once"../View/layaouts/admin/Head.php";

?>
<?php
session_start();
if (!isset($_SESSION['user_id']) || !in_array($_SESSION['role_id'], [1, 2])) {
    header('Location: ../View/login/index.php?message=' . urlencode('Acceso denegado.') . '&type=danger');
    exit();
}
?>
<?php
require_once"../Config/db.php";
require_once"../php/count.php";
require_once"../View/layaouts/admin/nav.php"
?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Contadores De Registros</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Contadores</li>
                        </ol>
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <h6>Bienvenido Usuario, <?= htmlspecialchars($_SESSION['username']) ?></h6>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
                        <div class="row">
                        <?php if ($_SESSION['role_id'] != 2): ?>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body ">Usuarios</div>
                                    <h1 class="text-center"><?php echo $userCount; ?></h1>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        
                                       
                                        <div class="small text-white">
                                      
    
</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Roles</div>
                                    <h1 class="text-center"><?php echo $roleCount; ?></h1>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                       
                                        <div class="small text-white">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Docentes</div>
                                    <h1 class="text-center"><?php echo $teacherCount; ?></h1>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                      
                                        <div class="small text-white"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Estudiantes</div>
                                    <h1 class="text-center"><?php echo $studentCount; ?></h1>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                      
                                        <div class="small text-white"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                        
                    </div>
                </main>

       <?php
require_once"../View/layaouts/admin/Footer.php";

?>
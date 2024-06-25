<?php
require_once"../View/layaouts/admin/Head.php";

?>
<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
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
                        <h1 class="mt-4">Acciones de Backups</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Backups</li>
                        </ol>
                       
                        <div class="row">
                        <?php if (isset($_GET['message'])): ?>
     
     <div class="alert alert-dismissible fade show <?= $_GET['type'] === 'success' ? 'alert-success' : 'alert-danger'  ?>" role="alert">
         <?= htmlspecialchars($_GET['message']) ?>
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>
 <?php endif; ?>
 
 <br>          
  <div class="col-sm-6 mb-3 mb-sm-0">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Respaldar Base de Datos</h5>
        <p class="card-text">Se generara un respaldo de la base de datos actual con la que se trabaja en la aplicación web</p>
        <a href="../php/ActionBackup.php" class="btn btn-primary">Respaldar</a>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Restaurar Base de datos</h5>
        <p class="card-text">se realizara una restauracion de la base de datos por medio de un respaldo anterior que se hizo.</p>
        <a href="restoreBackup.php" class="btn btn-primary">Restaurar</a>
      </div>
    </div>
  </div>
</div>
                
                        
                    </div>
                </main>

       <?php
require_once"../View/layaouts/admin/Footer.php";

?>
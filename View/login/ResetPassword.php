<?php
require_once "../../View/layaouts/Head.php";
require_once "../../Config/db.php"; // Asegúrate de incluir el archivo de conexión PDO
?>
<?php $id = $_GET['id']; ?>
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <center><img src="../../assets/img/logo.png" width="25%" alt=""></center> 
                            <div class="card-header"><h3 class="text-center font-weight-light my-4">Cambio de Contraseña</h3></div>
                            <div class="card-body">
                                <div class="small mb-3 text-muted">Por favor ingrese su nueva contraseña</div>
                                <form action="../../php/UpdatePassword.php?id=<?= $id; ?>" method="POST" onsubmit="return validarContraseña()" class="row g-3 needs-validation" novalidate>
                                    
                                    <?php
                                    try {
                                        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
                                        $stmt->execute([$id]);
                                        $resultadu = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        
                                        foreach ($resultadu as $fila) {
                                            echo "<label><b>Usuario: " . htmlspecialchars($fila['username']) . "</b></label>";
                                            echo "<div class='form-floating mb-3'>";
                                            echo "<input class='form-control' id='contraseña' type='password' name='password' maxlength='15' minlength='8'  required />";
                                            echo "<label for='contraseña'>Contraseña Nueva</label>";
                                          
                                            echo "</div>";
                                        }
                                    } catch (PDOException $e) {
                                        echo "<div class='alert alert-danger'>Error al obtener el usuario: " . htmlspecialchars($e->getMessage()) . "</div>";
                                    }
                                    ?>

<div class="mt-4 mb-0">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary btn-block">Cambiar Contraseña</button>
                                                   
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="index.php">¿Tener una cuenta? Ir a iniciar sesión</a></div>
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<?php
require_once "../../View/layaouts/Footer.php";
?>

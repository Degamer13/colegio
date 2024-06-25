<?php
require_once"../../View/layaouts/Head.php";
session_start();
?>
        <div id="layoutAuthentication">
        
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                    <br>
                         <?php if (isset($_GET['message'])): ?>
     
                            <div class="alert alert-dismissible fade show <?= $_GET['type'] === 'success' ? 'alert-success' : 'alert-danger'  ?>" role="alert">
                                <?= htmlspecialchars($_GET['message']) ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                        
                        <br>
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                   <center><img src="../../assets/img/logo.png" width="25%" alt=""></center> 
                                    <div class="card-header"><h3 class="text-center font-weight-light ">Iniciar Sesión</h3></div>
                                    <div class="card-body">
                                        <form action="../../php/ValidaUser.php" method="POST">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="email" placeholder="name@example.com" name="email"  required />
                                                <label for="inputEmail">Correo Electrónico</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" type="password" placeholder="Password" name="password"  required />
                                                <label for="inputPassword">Contraseña</label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                                <label class="form-check-label" for="inputRememberPassword">Recordar Contraseña</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.php">¿Has olvidado tu contraseña?</a>
                                                <button type="submit" class="btn btn-primary">Acceso</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="register.php">¿Necesito una cuenta? ¡Inscribirse!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <?php
require_once"../../View/layaouts/Footer.php";

?>
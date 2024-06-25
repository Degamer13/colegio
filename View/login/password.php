<?php
require_once"../../View/layaouts/Head.php";

?>
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <br>
                    <!-- Mostrar mensajes de éxito o error -->
        <?php if (isset($_GET['message'])): ?>
            <div class="alert alert-danger alert-dismissible fade show <?= htmlspecialchars($_GET['type']) ?>" role="alert">
                <?= htmlspecialchars($_GET['message']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">
                                    <center><img src="../../assets/img/logo.png" width="25%" alt=""></center> 
                                    <h3 class="text-center font-weight-light my-4">Recuperación de contraseña</h3></div>
                                    <div class="card-body">
                                        <div class="small mb-3 text-muted">Ingrese su dirección de correo electrónico y le enviaremos un enlace para restablecer su contraseña.</div>
                                        <form action="../../php/ValidaPassword.php" method="POST">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="email" name="email" placeholder="name@example.com" required />
                                                <label for="inputEmail">Correo Electrónico</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="index.php">Volver a iniciar sesión</a>
                                                <button type="submit" class="btn btn-primary">Restablecer Contraseña</button>
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
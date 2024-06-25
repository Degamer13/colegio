<?php
require_once"../../View/layaouts/Head.php";

?>

 <div id="layoutAuthentication">
     
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
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
                                <center><img src="../../assets/img/logo.png" width="25%" alt=""></center> 
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Crear una cuenta</h3></div>
                                    <div class="card-body">
                                   
    <form action="../../php/UserRegister.php" method="post" onsubmit="return validarClave()">
   
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
                                           <input type="hidden" value="2" name="role_id">
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary btn-block">Crear una cuenta</button>
                                                   
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
    <?php
require_once"../../View/layaouts/Footer.php";

?>
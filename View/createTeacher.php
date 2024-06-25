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
require_once"../php/SelectDegrees.php";
?>
<?php
require_once"../View/layaouts/admin/nav.php"
?>

<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                       
                       
                        
                        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        
                    <?php if (isset($_GET['error']) && $_GET['error'] == 'exists'): ?>
                        <br>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                El email, teléfono o cédula ya existen.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <center><img src="../assets/img/logo.png" width="20%" alt=""></center> 
                                    <div class="card-header"><h3 class="text-center font-weight-light my-2">Registrar Docente</h3></div>
                                    <div class="card-body">
                                        <form action="../php/CreateTeacher.php" method="post">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="letras" type="text" name="name1_teacher" oninput="soloLetras(event)" required placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Primer Nombre</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="letras" type="text" name="name2_teacher" oninput="soloLetras(event)" required placeholder="Enter your last name" />
                                                        <label for="inputLastName">Segundo Nombre</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="letras" type="text" name="last_name1_teacher" oninput="soloLetras(event)" required placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Primer Apellido</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="letras" type="text" name="last_name2_teacher" oninput="soloLetras(event)" required placeholder="Enter your last name" />
                                                        <label for="inputLastName">Segundo Apellido</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="numero"  type="text" name="id_card_teacher" minlength="6" maxlength="8" oninput="soloNumeros(event)" required placeholder="name@example.com" />
                                                <label for="inputEmail">Cedula De Identidad</label>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputPassword" type="email" name="email_teacher" required placeholder="Create a password" />
                                                        <label for="inputPassword">Correo Electronico</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="numero" type="text" name="phone_teacher" maxlength="11" oninput="soloNumeros(event)"  placeholder="Confirm password" />
                                                        <label for="inputPasswordConfirm">Numero de Telefono</label>
                                                    </div>
                                                    
                                                </div>
                                               
                                            </div>
                                            <div class="form-floating mb-3">
                                            <select class="form-select" id="degreeSelect" name="degree_id" required >
            <option value="">Selecciona un Grado</option>
            <?php foreach ($degrees as $degree): ?>
                <option value="<?php echo $degree['id_degree']; ?>">
                    <?php echo $degree['description']; ?>
                </option>
            <?php endforeach; ?>
        </select>
                                            </div>
                                            <div class="mt-4 mb-0">
                                                
                                                <div class="d-grid"><button type="submit" class="btn btn-primary btn-block">Registrar</button></div>
                                            </div>
                                        </form>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
                    </div>
                </main>

<?php
require_once"../View/layaouts/admin/Footer.php";

?>
<?php
require_once "../View/layaouts/admin/Head.php";

session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
    header('Location: ../View/login/index.php?message=' . urlencode('Acceso denegado.') . '&type=danger');
    exit();
}

require_once "../Config/db.php";
require_once "../php/SelectDegrees.php";

// Obtener los datos del docente
$teacherId = $_GET['id'];
$stmt = $pdo->prepare('SELECT * FROM teachers WHERE id_teacher = :id');
$stmt->execute(['id' => $teacherId]);
$teacher = $stmt->fetch();

if (!$teacher) {
    header('Location: index.php?message=' . urlencode('Docente no encontrado.') . '&type=danger');
    exit();
}
?>
<?php
require_once "../View/layaouts/admin/nav.php";
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
                                        <div class="card-header">
                                            <h3 class="text-center font-weight-light my-2">Actualizar Docente</h3>
                                        </div>
                                        <div class="card-body">
                                            <form action="../php/UpdateTeacher.php" method="post">
                                                <input type="hidden" name="id_teacher" value="<?php echo $teacher['id_teacher']; ?>">
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <div class="form-floating mb-3 mb-md-0">
                                                            <input class="form-control" id="letras" type="text" name="name1_teacher" oninput="soloLetras(event)" value="<?php echo $teacher['name1_teacher']; ?>" required placeholder="Enter your first name" />
                                                            <label for="inputFirstName">Primer Nombre</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating">
                                                            <input class="form-control" id="letras" type="text" name="name2_teacher" oninput="soloLetras(event)" value="<?php echo $teacher['name2_teacher']; ?>" required placeholder="Enter your last name" />
                                                            <label for="inputLastName">Segundo Nombre</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <div class="form-floating mb-3 mb-md-0">
                                                            <input class="form-control" id="letras" type="text" name="last_name1_teacher" oninput="soloLetras(event)" value="<?php echo $teacher['last_name1_teacher']; ?>" required placeholder="Enter your first name" />
                                                            <label for="inputFirstName">Primer Apellido</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating">
                                                            <input class="form-control" id="letras" type="text" name="last_name2_teacher" oninput="soloLetras(event)" value="<?php echo $teacher['last_name2_teacher']; ?>" required placeholder="Enter your last name" />
                                                            <label for="inputLastName">Segundo Apellido</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="inputEmail" type="number" name="id_card_teacher" minlength="6" maxlength="8" value="<?php echo $teacher['id_card_teacher']; ?>" required placeholder="Cedula De Identidad" />
                                                    <label for="inputEmail">Cedula De Identidad</label>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <div class="form-floating mb-3 mb-md-0">
                                                            <input class="form-control" id="inputPassword" type="email" name="email_teacher" value="<?php echo $teacher['email_teacher']; ?>" required placeholder="Correo Electronico" />
                                                            <label for="inputPassword">Correo Electronico</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating mb-3 mb-md-0">
                                                            <input class="form-control" id="inputPasswordConfirm" type="number"  maxlength="11" name="phone_teacher" value="<?php echo $teacher['phone_teacher']; ?>"  placeholder="Numero de Telefono" />
                                                            <label for="inputPasswordConfirm">Numero de Telefono</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <select class="form-select" id="degreeSelect" name="degree_id" required>
                                                        <option value="">Selecciona un Grado</option>
                                                        <?php foreach ($degrees as $degree): ?>
                                                            <option value="<?php echo $degree['id_degree']; ?>" <?php if ($degree['id_degree'] == $teacher['degree_id']) echo 'selected'; ?>>
                                                                <?php echo $degree['description']; ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="mt-4 mb-0">
                                                    <div class="d-grid">
                                                        <button type="submit" class="btn btn-primary btn-block">Actualizar</button>
                                                    </div>
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
        </div>
    </main>

    <?php
    require_once "../View/layaouts/admin/Footer.php";
    ?>
</div>

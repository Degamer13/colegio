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
require_once"../php/SelectStudents.php";
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
                        
                   <br>
                    <?php if (isset($_GET['added']) && $_GET['added'] == 'true'): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Nota agregada exitosamente.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <center><img src="../assets/img/logo.png" width="20%" alt=""></center> 
                                    <div class="card-header"><h3 class="text-center font-weight-light my-2">Registrar Nota</h3></div>
                                    <div class="card-body">
                                        <form action="../php/CreateNote.php" method="post">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <select class="form-select" name="student_id" id="basic-usage" required>
        <option selected value="">Selecciona un Estudiante</option>
        <?php foreach ($students as $student): ?>
            <option value="<?php echo $student['id_student']; ?>">
                <?php echo $student['name1'].' '. $student['last_name1']. ' ' . $student['id_card']; ?>
            </option>
        <?php endforeach; ?>
    </select>                                  
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                    <select class="form-select" name="lapse"  required>
  <option selected value="">Seleccione un Lapso</option>
  <option value="Primer Lapso">Primer Lapso</option>
  <option value="Segundo Lapso">Segundo Lapso</option>
  <option value="Tercer Lapso">Tercer Lapso</option>
</select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                            <input class="form-control"  type="text" name="year_educ"  required  />
                                                        <label for="inputPasswordConfirm">Año Escolar</label>
 

</div>
                                            <div class="form-floating mb-3">
                                            <select class="form-select" name="qualification"  required>
  <option selected value="">Seleccione una Nota</option>
  <option value="A">A</option>
  <option value="B">B</option>
  <option value="C">C</option>
  <option value="D">D</option>
  <option value="E">E</option>

</select>
                
                                            </div>
                                            
                                            <div class="form-floating mb-3">
                                            <select class="form-select" id="degreeSelect" name="degree_id2" required >
            <option selected value="">Selecciona un Grado</option>
            <?php foreach ($degrees as $degree): ?>
                <option value="<?php echo $degree['id_degree']; ?>">
                    <?php echo $degree['description']; ?>
                </option>
            <?php endforeach; ?>
        </select>
                                            </div>  
                                            <div class="form-floating mb-3">
                                            <select class="form-select"  name="promovide" required >
            <option selected value="">Promovido</option>
            <option value="1er Grado">1er Grado</option>
            <option value="2do Grado">2do Grado</option>
            <option value="3er Grado">3er Grado</option>
            <option value="4to Grado">4to Grado</option>
            <option value="5to Grado">5to Grado</option>
            <option value="6to Grado">6to Grado</option>
            <option value="Primer Año">Primer Año</option>
        </select>
                                            </div>  
                                          
                                            <div class="form-floating mb-3">
                                            <input class="form-control"  type="text" name="description2"  required  />
                                                        <label for="inputPasswordConfirm">Apreciación Cualitativa</label>
 

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
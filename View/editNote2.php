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
$notaId = $_GET['id'];
$stmt = $pdo->prepare('SELECT * FROM report_card r 
JOIN students s ON r.student_id = s.id_student
JOIN degrees d ON r.degree_id2 = d.id_degree 
WHERE r.id_report = :id');
$stmt->execute(['id' => $notaId]);
$notas = $stmt->fetch();

if (!$notas) {
    header('Location: index.php?message=' . urlencode('notas no encontrado.') . '&type=danger');
    exit();
}
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
                        
                   

                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <center><img src="../assets/img/logo.png" width="20%" alt=""></center> 
                                    <div class="card-header"><h3 class="text-center font-weight-light my-2">Actualizar Nota</h3></div>
                                    <div class="card-body">
                                        <form action="../php/UpdateNote2.php" method="post">
                                        <input type="hidden" name="id_report" value="<?php echo $notas['id_report']; ?>">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <select class="form-select" name="student_id" id="basic-usage" required>
  <option value="" selected disabled>Selecciona un Estudiante</option>
  <?php foreach ($students as $student): ?>
    <?php
    $studentFullName = $student['name1'] . ' ' . $student['last_name1'] . ' ' . $student['id_card'];
    $selected = ($student['id_student'] == $notas['student_id']) ? 'selected' : '';
    ?>
    <option value="<?php echo $student['id_student']; ?>" <?php echo $selected; ?>>
      <?php echo $studentFullName; ?>
    </option>
  <?php endforeach; ?>
</select>                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                    <select class="form-select" name="lapse" required>
  <option value="" selected disabled>Seleccione un Lapso</option>
  <?php foreach (['Primer Lapso', 'Segundo Lapso', 'Tercer Lapso'] as $nota): ?>
    <option value="<?php echo $nota; ?>" <?php echo ($nota == $notas['lapse']) ? 'selected' : ''; ?>>
      <?php echo $nota; ?>
    </option>
  <?php endforeach; ?>
 
</select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                            <input class="form-control"  type="text" name="year_educ" value="<?php echo $notas['year_educ']; ?>"  required  />
                                                        <label for="inputPasswordConfirm">Año Escolar</label>
 

</div>
                                            <div class="form-floating mb-3">
                                            <select class="form-select" name="qualification" required>
  <option value="" selected disabled>Seleccione una Nota</option>
  <?php foreach (['A', 'B', 'C', 'D', 'E'] as $nota): ?>
    <option value="<?php echo $nota; ?>" <?php echo ($nota == $notas['qualification']) ? 'selected' : ''; ?>>
      <?php echo $nota; ?>
    </option>
  <?php endforeach; ?>
</select>
                
                                            </div>
                                            
                                            <div class="form-floating mb-3">
                                            <select class="form-select" id="degreeSelect" name="degree_id2" required>
  <option value="" selected disabled>Selecciona un Grado</option>
  <?php foreach ($degrees as $degree): ?>
    <?php
    $selected = ($degree['id_degree'] == $notas['degree_id2']) ? 'selected' : '';
    ?>
    <option value="<?php echo $degree['id_degree']; ?>" <?php echo $selected; ?>>
      <?php echo $degree['description']; ?>
    </option>
  <?php endforeach; ?>
</select>
                                            </div>  
                                            <div class="form-floating mb-3">
                                            <select class="form-select" name="promovide" required>
  <option value="" selected disabled>Promovido</option>
  <?php foreach (['1er Grado', '2do Grado', '3er Grado', '4to Grado', '5to Grado', '6to Grado', 'Primer Año'] as $nota): ?>
    <option value="<?php echo $nota; ?>" <?php echo ($nota == $notas['promovide']) ? 'selected' : ''; ?>>
      <?php echo $nota; ?>
    </option>
  <?php endforeach; ?>
</select>
                
                                            </div>
                                            <div class="form-floating mb-3">
                                            <input class="form-control"  type="text" name="description2" value="<?php echo $notas['description2']; ?>"  required  />
                                                        <label for="inputPasswordConfirm">Apreciación Cualitativa</label>
 

</div>
                                            <div class="mt-4 mb-0">
                                                
                                                <div class="d-grid"><button type="submit" class="btn btn-primary btn-block">Actualizar</button></div>
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
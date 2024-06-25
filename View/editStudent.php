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
// Obtener el ID del estudiante desde la URL
$studentId = $_GET['id'];

// Obtener los datos del estudiante
$stmt = $pdo->prepare('SELECT * FROM students WHERE id_student = :id');
$stmt->execute(['id' => $studentId]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$student) {
    header('Location: index.php?message=' . urlencode('Estudiante no encontrado.') . '&type=danger');
    exit();
}

// Obtener los datos de los representantes relacionados
$stmt = $pdo->prepare('SELECT * FROM representatives WHERE student_id = :id');
$stmt->execute(['id' => $studentId]);
$representatives = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener los datos de los responsables relacionados
$stmt = $pdo->prepare('SELECT * FROM responsibles WHERE student_id2 = :id');
$stmt->execute(['id' => $studentId]);
$responsibles = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
                <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <center><img src="../assets/img/logo.png" width="20%" alt=""></center> 
                                    <div class="card-header"><h3 class="text-center font-weight-light my-2">Actualizar Estudiante</h3></div>
                                    <div class="card-body">
                                    <form id="multiStepForm" action="../php/UpdateStudent.php" method="POST">
        <div id="step1" class="step">
            <h3>Paso 1</h3>
            <div class="row mb-3">
            <h4 class="text-center">Datos del Alumno</h4>
            <input type="hidden" name="id_student" value="<?php echo $student['id_student']; ?>">
    
    
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="letras" type="text" name="name1" oninput="soloLetras(event)" value="<?php echo $student['name1']; ?>" required placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Primer Nombre</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="letras" type="text" name="name2" oninput="soloLetras(event)" value="<?php echo $student['name2']; ?>" required placeholder="Enter your last name" />
                                                        <label for="inputLastName">Segundo Nombre</label>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="letras" type="text" name="last_name1" oninput="soloLetras(event)" value="<?php echo $student['last_name1']; ?>" required placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Primer Apellido</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="letras" type="text" name="last_name2" oninput="soloLetras(event)" value="<?php echo $student['last_name2']; ?>" required placeholder="Enter your last name" />
                                                        <label for="inputLastName">Segundo Apellido</label>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="numero"  type="text" name="id_card" oninput="soloNumeros(event)"  minlength="8" maxlength="8" value="<?php echo $student['id_card']; ?>" required placeholder="name@example.com" />
                                                <label for="inputEmail">Cedula De Identidad</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                    <select class="form-select" id="degreeSelect" name="gender" required>
                <option value="" disabled <?php if (!$student['gender']) echo 'selected'; ?>>Selecciona un Genero</option>
    <option value="Masculino" <?php if ($student['gender'] === 'Masculino') echo 'selected'; ?>>Maculino</option>
    <option value="Femenino" <?php if ($student['gender'] === 'Femenino') echo 'selected'; ?>>Femenino</option>
</select>

                                                    </div>
                                                </div>
                                                
                                            </div>
            <button type="button" class="btn btn-primary" onclick="nextStep(2)">Siguiente</button>
        </div>
        <div id="step2" class="step hidden">
            <h3>Paso 2</h3>
            <div class="row mb-3">
            <h4 class="text-center">Datos del Alumno</h4>
                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" type="date" name="birthdate" value="<?php echo $student['birthdate']; ?>"  required placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Fecha de Nacimiento</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="numero" type="text"   name="year" minlength="1" maxlength="2" oninput="soloNumeros(event)" value="<?php echo $student['year']; ?>" readonly required placeholder="Enter your last name" />
                                                        <label for="inputLastName">Edad</label>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="form-floating mb-3">
                                            <input class="form-control" id="letras" type="text" name="birthplace" oninput="soloLetras(event)" value="<?php echo $student['birthplace']; ?>" required placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Lugar de Nacimiento</label>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="letras" type="text" value="<?php echo $student['country']; ?>" name="country" oninput="soloLetras(event)" required placeholder="Enter your first name" />
                                                        <label for="inputFirstName">País</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="letras" type="text" name="state" value="<?php echo $student['state']; ?>" oninput="soloLetras(event)" required placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Estado</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                    <select class="form-select" name="nationality" required>
    <option value="" disabled <?php if (!$student['nationality']) echo 'selected'; ?>>Nacionalidad</option>
    <option value="Extrajero" <?php if ($student['nationality'] === 'Extrajero') echo 'selected'; ?>>Extrajero</option>
    <option value="Venezolano" <?php if ($student['nationality'] === 'Venezolano') echo 'selected'; ?>>Venezolano</option>
</select>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                            <input class="form-control"  type="text" name="address" value="<?php echo $student['address']; ?>"  required placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Dirección</label>
                                            </div>
                                           
                                            
            <button type="button" class="btn btn-secondary" onclick="previousStep(1)">Anterior</button>
            <button type="button" class="btn btn-primary" onclick="nextStep(3)">Siguiente</button>
            
        </div>
        <div id="step3" class="step hidden">
            <h3>Paso 3</h3>
            <div class="row mb-3">
            <h4 class="text-center">Datos del Alumno</h4>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control"  id="letras" type="text" value="<?php echo $student['another_squad']; ?>" name="another_squad" oninput="soloLetras(event)" required placeholder="name@example.com" />
                                                <label for="inputEmail">Procede De Otro Plantel</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                    <select class="form-select" name="repeat_student" required>
    <option value="" disabled <?php if (!$student['repeat_student']) echo 'selected'; ?>>El Alumno Es Repitiente</option>
    <option value="Si" <?php if ($student['repeat_student'] === 'Si') echo 'selected'; ?>>Si</option>
    <option value="No" <?php if ($student['repeat_student'] === 'No') echo 'selected'; ?>>No</option>
</select>

                                                          </div>
                                                </div>
                                                
                                            </div>
                                            <div class="form-floating mb-3">
                                            <input class="form-control"  type="text" name="student_illness" value="<?php echo $student['student_illness']; ?>"  required placeholder="Enter your first name" />
                                                        <label for="inputFirstName">El Alumno Sufre De Alguna Enfermedad</label>
                                            </div>
            <div class="mb-3">
            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control"  id="letras" type="text" name="student_lives_with" value="<?php echo $student['student_lives_with']; ?>" oninput="soloLetras(event)" required placeholder="name@example.com" />
                                                <label for="inputEmail">El Alumno Vive Con</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                  
                                                    <input class="form-control"  id="letras" type="text" name="medical_assistance" value="<?php echo $student['medical_assistance']; ?>" oninput="soloLetras(event)" required placeholder="name@example.com" />
                                                <label for="inputEmail">El Alumno Tiene Asistencia Medica Especial</label>
                                                   
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <select class="form-select" name="currently_vaccinated" required>
    <option value="" disabled <?php if (!$student['currently_vaccinated']) echo 'selected'; ?>>El Alumno Se Ha Vacunado Actualmente</option>
    <option value="Si" <?php if ($student['currently_vaccinated'] === 'Si') echo 'selected'; ?>>Si</option>
    <option value="No" <?php if ($student['currently_vaccinated'] === 'No') echo 'selected'; ?>>No</option>
</select>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                  
                                                    <select class="form-select" name="academic_activity" required>
    <option value="" disabled <?php if (!$student['academic_activity']) echo 'selected'; ?>>El Alumno Ejecuta Actividades Extra-Academicas</option>
    <option value="Si" <?php if ($student['academic_activity'] === 'Si') echo 'selected'; ?>>Si</option>
    <option value="No" <?php if ($student['academic_activity'] === 'No') echo 'selected'; ?>>No</option>
</select>

                                                   
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="form-floating mb-3">
                                            <select class="form-select" id="degreeSelect" name="degree_id" required >
                                            <option value="">Selecciona un Grado</option>
                                                        <?php foreach ($degrees as $degree): ?>
                                                            <option value="<?php echo $degree['id_degree']; ?>" <?php if ($degree['id_degree'] == $student['degree_id']) echo 'selected'; ?>>
                                                                <?php echo $degree['description']; ?>
                                                            </option>
                                                        <?php endforeach; ?>
        </select>
                                            </div>
                                           
                                            
                                           <button type="button" class="btn btn-secondary" onclick="previousStep(2)">Anterior</button>
                                           <button type="button" class="btn btn-primary" onclick="nextStep(4)">Siguiente</button>
                                        
                                       </div>
                                    </div>
                                    <div id="step4" class="step hidden">
            <h3>Paso 4</h3>
            <div class="row mb-3">
            <?php foreach ($representatives as $representative): ?>
                <h4 class="text-center">Datos de los Padres</h4>
            <h5>Datos de la Madre</h5>
            <input type="hidden" name="student_id" value="<?php echo $representative['student_id']; ?>">
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="letras" type="text" name="mother" value="<?php echo $representative['mother']; ?>" oninput="soloLetras(event)"  placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Nombre de la Madre(*Opcional)</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="numero" type="text"   name="id_card_mother" minlength="6" maxlength="8" value="<?php echo $representative['id_card_mother']; ?>" oninput="soloNumeros(event)"  placeholder="Enter your last name" />
                                                        <label for="inputLastName">Cedula de la Madre(*Opcional)</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                    <input class="form-control" id="numero" type="text"   name="year_mother" minlength="2" maxlength="3" oninput="soloNumeros(event)" value="<?php echo $representative['year_mother']; ?>"  placeholder="Enter your last name" />
                                                        <label for="inputLastName">Edad de la Madre(*Opcional)</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                            <input class="form-control"  type="text" name="address_mother" value="<?php echo $representative['address_mother']; ?>"  placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Dirección(*Opcional)</label>
                                            </div>
            <div class="mb-3">
            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <select class="form-select" name="status_mother" >
    <option value=""  <?php if (!$representative['status_mother']) echo 'selected'; ?>>Estado Civil(*Opcional)</option>
    <option value="Soltero(a)" <?php if ($representative['status_mother'] === 'Soltero(a)') echo 'selected'; ?>>Soltero(a)</option>
    <option value="Casado(a)" <?php if ($representative['status_mother'] === 'Casado(a)') echo 'selected'; ?>>Casado(a)</option>
    <option value="Divorciado(a)" <?php if ($representative['status_mother'] === 'Divorciado(a)') echo 'selected'; ?>>Divorciado(a)</option>
    <option value="Viudo(a)" <?php if ($representative['status_mother'] === 'Viudo(a)') echo 'selected'; ?>>Viudo(a)</option>
</select>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                  
                                                    <input class="form-control"  id="letras" type="text"  value="<?php echo $representative['profession_mother']; ?>" name="profession_mother" oninput="soloLetras(event)"  placeholder="name@example.com" />
                                                <label for="inputEmail">Prof.U Ofic(*Opcional)</label>
                                                   
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="form-floating mb-3">
                                            <input class="form-control"  type="text" name="workplace_mother"  value="<?php echo $representative['workplace_mother']; ?>"  placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Lugar de Trabajo(*Opcional)
                                        
                                                        </label>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="numero" type="text"  maxlength="11"   name="room_phone_mother"  value="<?php echo $representative['room_phone_mother']; ?>" oninput="soloNumeros(event)"   placeholder="Enter your last name" />
                                                        <label for="inputLastName">Telef.Habitación(*Opcional)</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="numero" type="text"  maxlength="11"   name="mobile_phone_mother" oninput="soloNumeros(event)"  value="<?php echo $representative['mobile_phone_mother']; ?>"   placeholder="Enter your last name" />
                                                        <label for="inputLastName">Telef.Movil(*Opcional)</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                    <input class="form-control" id="numero" type="text"  maxlength="11"   name="work_phone_mother"  value="<?php echo $representative['work_phone_mother']; ?>" oninput="soloNumeros(event)"   placeholder="Enter your last name" />
                                                        <label for="inputLastName">Telef.Trabajo(*Opcional)</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <h5>Datos del Padre</h5>
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="letras" type="text"  value="<?php echo $representative['father']; ?>" name="father" oninput="soloLetras(event)"  placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Nombre del Padre(*Opcional)</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="numero" type="text"   name="id_card_father" maxlength="11" oninput="soloNumeros(event)"  value="<?php echo $representative['id_card_father']; ?>"  placeholder="Enter your last name" />
                                                        <label for="inputLastName">Cedula del Padre(*Opcional)</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                    <input class="form-control" id="numero" type="text"   name="year_father" minlength="2" maxlength="3" oninput="soloNumeros(event)"  value="<?php echo $representative['year_father']; ?>"   placeholder="Enter your last name" />
                                                        <label for="inputLastName">Edad del Padre(*Opcional)</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                            <input class="form-control"  type="text" name="address_father"  value="<?php echo $representative['address_father']; ?>"   placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Dirección(*Opcional)</label>
                                            </div>
            <div class="mb-3">
            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <select class="form-select" name="status_father" >
    <option value="" <?php if (!$representative['status_father']) echo 'selected'; ?>>Estado Civil(*Opcional)</option>
    <option value="Soltero(a)" <?php if ($representative['status_father'] === 'Soltero(a)') echo 'selected'; ?>>Soltero(a)</option>
    <option value="Casado(a)" <?php if ($representative['status_father'] === 'Casado(a)') echo 'selected'; ?>>Casado(a)</option>
    <option value="Divorciado(a)" <?php if ($representative['status_father'] === 'Divorciado(a)') echo 'selected'; ?>>Divorciado(a)</option>
    <option value="Viudo(a)" <?php if ($representative['status_father'] === 'Viudo(a)') echo 'selected'; ?>>Viudo(a)</option>
</select>
                         </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                  
                                                    <input class="form-control"  id="letras" type="text" name="profession_father" value="<?php echo $representative['profession_father']; ?>" oninput="soloLetras(event)"  placeholder="name@example.com" />
                                                <label for="inputEmail">Prof.U Ofic(*Opcional)</label>
                                                   
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="form-floating mb-3">
                                            <input class="form-control"  type="text" name="workplace_father" value="<?php echo $representative['workplace_father']; ?>"   placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Lugar de Trabajo(*Opcional)
                                        
                                                        </label>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="numero" type="text"   name="room_phone_father"   maxlength="11" value="<?php echo $representative['room_phone_father']; ?>" oninput="soloNumeros(event)"   placeholder="Enter your last name" />
                                                        <label for="inputLastName">Telef.Habitación(*Opcional)</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="numero" type="text"   name="mobile_phone_father"  maxlength="11" value="<?php echo $representative['mobile_phone_father']; ?>" oninput="soloNumeros(event)"  placeholder="Enter your last name" />
                                                        <label for="inputLastName">Telef.Movil(*Opcional)</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                    <input class="form-control" id="numero" type="text"   name="work_phone_father"  maxlength="11" value="<?php echo $representative['work_phone_father']; ?>" oninput="soloNumeros(event)"   placeholder="Enter your last name" />
                                                        <label for="inputLastName">Telef.Trabajo(*Opcional)</label>
                                                    </div>
                                                    <?php endforeach; ?>
                                                    </div>
                                                    </div>
                                                    </div>
                                           <button type="button" class="btn btn-secondary" onclick="previousStep(3)">Anterior</button>
                                           <button type="button" class="btn btn-primary" onclick="nextStep(5)">Siguiente</button>
                                           </div>
                                       </div>
                                
                            <div id="step5" class="step hidden">
                                <h3>Paso 5</h3>
                                     <div class="row mb-3">
           
                                        <h4 class="text-center">Datos del Representante en la Institución</h4>
                                        <?php foreach ($responsibles as $responsible): ?>
                                                                        <div class="col-md-4">
                                                                        <input type="hidden" name="student_id2" value="<?php echo $responsible['student_id2']; ?>">
                                                                    
                                                                      
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="letras" required type="text" name="responsible" value="<?php echo $responsible['responsible']; ?>"  oninput="soloLetras(event)" placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Nombre y Apellido</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="numero" type="text" required   name="id_card_responsible" minlength="6" maxlength="8" value="<?php echo $responsible['id_card_responsible']; ?>" oninput="soloNumeros(event)"  placeholder="Enter your last name" />
                                                        <label for="inputLastName">Cedula de Identidad</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                    <input class="form-control" id="numero" required type="text"   name="year_responsible" minlength="2" maxlength="3" value="<?php echo $responsible['year_responsible']; ?>" oninput="soloNumeros(event)"   placeholder="Enter your last name" />
                                                        <label for="inputLastName">Edad</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                            <input class="form-control"  type="text" required name="address_responsible" value="<?php echo $responsible['address_responsible']; ?>"  placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Dirección</label>
                                            </div>
            <div class="mb-3">
            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control"  id="letras" required type="text" name="profession_responsible" value="<?php echo $responsible['profession_responsible']; ?>" oninput="soloLetras(event)"  placeholder="name@example.com" />
                                                <label for="inputEmail">Prof.U Ofic</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                    <input class="form-control"  type="text"  name="workplace_responsible" value="<?php echo $responsible['workplace_responsible']; ?>"  placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Lugar de Trabajo(*Opcional)
                                                  
                                                        </label>
                                                        </div>
                                                              <?php endforeach; ?>
                                           
                                                        </div>     </div>
                                           <button type="button" class="btn btn-secondary" onclick="previousStep(4)">Anterior</button>
                                           <input type="submit" class="btn btn-success" value="Actualizar"></input>
                                           
                                       </div>
                          </form>
              
                </main>
            </div>
                    </div>
                </main>

<?php
require_once"../View/layaouts/admin/Footer.php";

?>
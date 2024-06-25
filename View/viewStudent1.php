<?php
require_once"../View/layaouts/admin/Head.php";

?>
<?php
session_start();
if (!isset($_SESSION['user_id']) || !in_array($_SESSION['role_id'], [1, 2])) {
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-2">Registro de Estudiante</h3></div>
                                    <div class="card-body">
                                    <form id="multiStepForm" action="../View/Students1.php">
        <div id="step1" class="step">
            <h3>Paso 1</h3>
            <div class="row mb-3">
            <h4 class="text-center">Datos del Alumno</h4>
            <input type="hidden" name="id_student" value="<?php echo $student['id_student']; ?>">
    
    
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input   class="form-control" id="letras"  type="text" disabled name="name1" oninput="soloLetras(event)" value="<?php echo $student['name1']; ?>" required placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Primer Nombre</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="letras" type="text" disabled name="name2" oninput="soloLetras(event)" value="<?php echo $student['name2']; ?>" required placeholder="Enter your last name" />
                                                        <label for="inputLastName">Segundo Nombre</label>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="letras" type="text" disabled name="last_name1" oninput="soloLetras(event)" value="<?php echo $student['last_name1']; ?>" required placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Primer Apellido</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="letras" type="text" disabled name="last_name2" oninput="soloLetras(event)" value="<?php echo $student['last_name2']; ?>" required placeholder="Enter your last name" />
                                                        <label for="inputLastName">Segundo Apellido</label>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="numero"  type="text" disabled name="id_card" oninput="soloNumeros(event)" value="<?php echo $student['id_card']; ?>" required placeholder="name@example.com" />
                                                <label for="inputEmail">Cedula De Identidad</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                    <input class="form-control" id="letras" type="text" disabled name="gender" oninput="soloLetras(event)" value="<?php echo $student['gender']; ?>" required placeholder="Enter your last name" />
                                                        <label for="inputLastName">Genero</label>
                                                 

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
                                                        <input class="form-control" type="date" disabled  name="birthdate" value="<?php echo $student['birthdate']; ?>"  required placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Fecha de Nacimiento</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="numero" disabled  type="text"   name="year" oninput="soloNumeros(event)" value="<?php echo $student['year']; ?>" readonly required placeholder="Enter your last name" />
                                                        <label for="inputLastName">Edad</label>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="form-floating mb-3">
                                            <input class="form-control" id="letras" type="text" disabled  name="birthplace" oninput="soloLetras(event)" value="<?php echo $student['birthplace']; ?>" required placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Lugar de Nacimiento</label>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="letras" disabled  type="text" value="<?php echo $student['country']; ?>" name="country" oninput="soloLetras(event)" required placeholder="Enter your first name" />
                                                        <label for="inputFirstName">País</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="letras" disabled  type="text" name="state" value="<?php echo $student['state']; ?>" oninput="soloLetras(event)" required placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Estado</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                    <input class="form-control"  type="text" name="nationality" disabled  value="<?php echo $student['nationality']; ?>"  required placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Nacionalidad</label>
                                               
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                            <input class="form-control"  type="text" name="address" disabled  value="<?php echo $student['address']; ?>"  required placeholder="Enter your first name" />
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
                                                    <input class="form-control"  id="letras" disabled type="text" value="<?php echo $student['another_squad']; ?>" name="another_squad" oninput="soloLetras(event)" required placeholder="name@example.com" />
                                                <label for="inputEmail">Procede De Otro Plantel</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                   
                                                    <input class="form-control"  id="letras" disabled type="text" value="<?php echo $student['repeat_student']; ?>" name="repeat_student" oninput="soloLetras(event)" required placeholder="name@example.com" />
                                                    <label for="inputEmail">El Alumno Es Repitiente</label>

                                                          </div>
                                                </div>
                                                
                                            </div>
                                            <div class="form-floating mb-3">
                                            <input class="form-control"  type="text" disabled name="student_illness" value="<?php echo $student['student_illness']; ?>"  required placeholder="Enter your first name" />
                                                        <label for="inputFirstName">El Alumno Sufre De Alguna Enfermedad</label>
                                            </div>
            <div class="mb-3">
            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control"  id="letras" disabled type="text" name="student_lives_with" value="<?php echo $student['student_lives_with']; ?>" oninput="soloLetras(event)" required placeholder="name@example.com" />
                                                <label for="inputEmail">El Alumno Vive Con</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                  
                                                    <input class="form-control"  id="letras" disabled type="text" name="medical_assistance" value="<?php echo $student['medical_assistance']; ?>" oninput="soloLetras(event)" required placeholder="name@example.com" />
                                                <label for="inputEmail">El Alumno Tiene Asistencia Medica Especial</label>
                                                   
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control"  id="letras" disabled type="text" name="currently_vaccinated" value="<?php echo $student['currently_vaccinated']; ?>" oninput="soloLetras(event)" required placeholder="name@example.com" />
                                                <label for="inputEmail">El Alumno Se Ha Vacunado Actualmente</label>
                                                   

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                    <input class="form-control"  id="letras" disabled type="text" name="academic_activity" value="<?php echo $student['academic_activity']; ?>" oninput="soloLetras(event)" required placeholder="name@example.com" />
                                                <label for="inputEmail">El Alumno Ejecuta Actividades Extra-Academicas</label>
                                                   

                                                   
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="form-floating mb-3">
                                                <?php
$degreeDescription = '';
foreach ($degrees as $degree) {
    if ($degree['id_degree'] == $student['degree_id']) {
        $degreeDescription = $degree['description'];
        break;
    }
}
?>
<input class="form-control"  id="letras" disabled type="text" name="academic_activity" value="<?php echo $degreeDescription; ?>" oninput="soloLetras(event)" required placeholder="name@example.com" />
<label for="inputEmail">Grado</label>
                                                                                       
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
                                                        <input class="form-control" id="letras" disabled type="text" name="mother" value="<?php echo $representative['mother']; ?>" oninput="soloLetras(event)"  placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Nombre de la Madre</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="numero" type="text" disabled   name="id_card_mother" value="<?php echo $representative['id_card_mother']; ?>" oninput="soloNumeros(event)"  placeholder="Enter your last name" />
                                                        <label for="inputLastName">Cedula de la Madre</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                    <input class="form-control" id="numero" type="text" disabled   name="year_mother" oninput="soloNumeros(event)" value="<?php echo $representative['year_mother']; ?>"  placeholder="Enter your last name" />
                                                        <label for="inputLastName">Edad de la Madre</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                            <input class="form-control"  type="text" name="address_mother" disabled value="<?php echo $representative['address_mother']; ?>"  placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Dirección</label>
                                            </div>
            <div class="mb-3">
            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control"  type="text" disabled name="status_mother" disabled  value="<?php echo $representative['status_mother']; ?>"   placeholder="Enter your first name" />
                                                    <label for="inputFirstName">Estado Civil</label>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                  
                                                    <input class="form-control"  id="letras" disabled type="text"  value="<?php echo $representative['profession_mother']; ?>" name="profession_mother" oninput="soloLetras(event)"  placeholder="name@example.com" />
                                                <label for="inputEmail">Prof.U Ofic</label>
                                                   
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="form-floating mb-3">
                                            <input class="form-control"  type="text" disabled name="workplace_mother"  value="<?php echo $representative['workplace_mother']; ?>"  placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Lugar de Trabajo
                                        
                                                        </label>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="numero" disabled type="text"   name="room_phone_mother"  value="<?php echo $representative['room_phone_mother']; ?>" oninput="soloNumeros(event)"   placeholder="Enter your last name" />
                                                        <label for="inputLastName">Telef.Habitación</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="numero" disabled type="text"   name="mobile_phone_mother" oninput="soloNumeros(event)"  value="<?php echo $representative['mobile_phone_mother']; ?>"   placeholder="Enter your last name" />
                                                        <label for="inputLastName">Telef.Movil</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                    <input class="form-control" id="numero" disabled type="text"   name="work_phone_mother"  value="<?php echo $representative['work_phone_mother']; ?>" oninput="soloNumeros(event)"   placeholder="Enter your last name" />
                                                        <label for="inputLastName">Telef.Trabajo</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <h5>Datos del Padre</h5>
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="letras" disabled type="text"  value="<?php echo $representative['father']; ?>" name="father" oninput="soloLetras(event)"  placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Nombre del Padre</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="numero" type="text" disabled  name="id_card_father" oninput="soloNumeros(event)"  value="<?php echo $representative['id_card_father']; ?>"  placeholder="Enter your last name" />
                                                        <label for="inputLastName">Cedula del Padre</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                    <input class="form-control" id="numero" type="text" disabled   name="year_father" oninput="soloNumeros(event)"  value="<?php echo $representative['year_father']; ?>"   placeholder="Enter your last name" />
                                                        <label for="inputLastName">Edad del Padre</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                            <input class="form-control"  type="text" name="address_father" disabled  value="<?php echo $representative['address_father']; ?>"   placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Dirección</label>
                                            </div>
            <div class="mb-3">
            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                              
                                                    <input class="form-control"  type="text" disabled name="status_father" disabled  value="<?php echo $representative['status_father']; ?>"   placeholder="Enter your first name" />
                                                    <label for="inputFirstName">Estado Civil</label>
                         </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                  
                                                    <input class="form-control"  id="letras" disabled type="text" name="profession_father" value="<?php echo $representative['profession_father']; ?>" oninput="soloLetras(event)"  placeholder="name@example.com" />
                                                <label for="inputEmail">Prof.U Ofic</label>
                                                   
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="form-floating mb-3">
                                            <input class="form-control"  type="text" disabled name="workplace_father" value="<?php echo $representative['workplace_father']; ?>"   placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Lugar de Trabajo
                                        
                                                        </label>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="numero" disabled type="text"   name="room_phone_father" value="<?php echo $representative['room_phone_father']; ?>" oninput="soloNumeros(event)"   placeholder="Enter your last name" />
                                                        <label for="inputLastName">Telef.Habitación</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="numero" type="text" disabled   name="mobile_phone_father" value="<?php echo $representative['mobile_phone_father']; ?>" oninput="soloNumeros(event)"  placeholder="Enter your last name" />
                                                        <label for="inputLastName">Telef.Movil</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                    <input class="form-control" id="numero" type="text" disabled   name="work_phone_father" value="<?php echo $representative['work_phone_father']; ?>" oninput="soloNumeros(event)"   placeholder="Enter your last name" />
                                                        <label for="inputLastName">Telef.Trabajo</label>
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
                                                        <input class="form-control" id="letras" disabled type="text" name="responsible" value="<?php echo $responsible['responsible']; ?>"  oninput="soloLetras(event)" required placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Nombre y Apellido</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="numero" type="text" disabled   name="id_card_responsible" value="<?php echo $responsible['id_card_responsible']; ?>" oninput="soloNumeros(event)" required placeholder="Enter your last name" />
                                                        <label for="inputLastName">Cedula de Identidad</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                    <input class="form-control" id="numero" type="text" disabled  name="year_responsible" value="<?php echo $responsible['year_responsible']; ?>" oninput="soloNumeros(event)"  required placeholder="Enter your last name" />
                                                        <label for="inputLastName">Edad</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                            <input class="form-control"  type="text" name="address_responsible" disabled value="<?php echo $responsible['address_responsible']; ?>"  required placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Dirección</label>
                                            </div>
            <div class="mb-3">
            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control"  id="letras" type="text" disabled name="profession_responsible" value="<?php echo $responsible['profession_responsible']; ?>" oninput="soloLetras(event)" required placeholder="name@example.com" />
                                                <label for="inputEmail">Prof.U Ofic</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                    <input class="form-control"  type="text" disabled name="workplace_responsible" value="<?php echo $responsible['workplace_responsible']; ?>" required placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Lugar de Trabajo
                                                  
                                                        </label>
                                                        </div>
                                                              <?php endforeach; ?>
                                           
                                                        </div>     </div>
                                           <button type="button" class="btn btn-secondary" onclick="previousStep(4)">Anterior</button>
                                           <input type="submit" class="btn btn-success" value="Finalizar"></input>
                                          
                                       </div>
                          </form>
              
                </main>
            </div>
                    </div>
                </main>

<?php
require_once"../View/layaouts/admin/Footer.php";

?>
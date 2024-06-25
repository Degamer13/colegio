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
                       
                    <?php if (isset($_GET['error']) && $_GET['error'] == 'exists' && isset($_GET['message'])): ?>
    <br>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo urldecode($_GET['message']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<br>
 <?php if (isset($_GET['added']) && $_GET['added'] == 'true'): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Estudiante agregado exitosamente.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
                        
                        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <center><img src="../assets/img/logo.png" width="20%" alt=""></center> 
                                    <div class="card-header"><h3 class="text-center font-weight-light my-2">Registrar Estudiante</h3></div>
                                    <div class="card-body">
                                    <form id="multiStepForm" action="../php/CreateStudent.php" method="POST">
        <div id="step1" class="step">
            <h3>Paso 1</h3>
            <div class="row mb-3">
            <h4 class="text-center">Datos del Alumno</h4>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="letras" type="text" name="name1" oninput="soloLetras(event)" required placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Primer Nombre</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="letras" type="text" name="name2" oninput="soloLetras(event)" required placeholder="Enter your last name" />
                                                        <label for="inputLastName">Segundo Nombre</label>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="letras" type="text" name="last_name1" oninput="soloLetras(event)" required placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Primer Apellido</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="letras" type="text" name="last_name2" oninput="soloLetras(event)" required placeholder="Enter your last name" />
                                                        <label for="inputLastName">Segundo Apellido</label>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="numero"  type="text" name="id_card" minlength="8" maxlength="8" oninput="soloNumeros(event)" required placeholder="name@example.com" />
                                                <label for="inputEmail">Cedula De Identidad</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                    <select class="form-select" id="degreeSelect" name="gender" required >
            <option  value="">Selecciona un Genero</option>
            <option value="Masculino">Masculino</option>
            <option value="Femenino">Femenino</option>
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
                                                        <input class="form-control" type="date" name="birthdate"  required placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Fecha de Nacimiento</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="numero" type="text"   name="year" minlength="1" maxlength="2" oninput="soloNumeros(event)" readonly required placeholder="Enter your last name" />
                                                        <label for="inputLastName">Edad</label>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="form-floating mb-3">
                                            <input class="form-control" id="letras" type="text" name="birthplace" oninput="soloLetras(event)" required placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Lugar de Nacimiento</label>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="letras" type="text" name="country" oninput="soloLetras(event)" required placeholder="Enter your first name" />
                                                        <label for="inputFirstName">País</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="letras" type="text" name="state" oninput="soloLetras(event)" required placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Estado</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                    <select class="form-select"  name="nationality" required >
            <option  value="">Nacionalidad</option>
            <option value="Extrajero">Extrajero</option>
            <option value="Venezolano">Venezolano</option>
        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                            <input class="form-control"  type="text" name="address"  required placeholder="Enter your first name" />
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
                                                    <input class="form-control"  id="letras" type="text" name="another_squad" oninput="soloLetras(event)" required placeholder="name@example.com" />
                                                <label for="inputEmail">Procede De Otro Plantel</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                    <select class="form-select"  name="repeat_student" required >
            <option  value="">El Alumno Es Repitiente</option>
            <option value="Si">Si</option>
            <option value="No">No</option>
        </select>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="form-floating mb-3">
                                            <input class="form-control"  type="text" name="student_illness"  required placeholder="Enter your first name" />
                                                        <label for="inputFirstName">El Alumno Sufre De Alguna Enfermedad</label>
                                            </div>
            <div class="mb-3">
            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control"  id="letras" type="text" name="student_lives_with" oninput="soloLetras(event)" required placeholder="name@example.com" />
                                                <label for="inputEmail">El Alumno Vive Con</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                  
                                                    <input class="form-control"  id="letras" type="text" name="medical_assistance" oninput="soloLetras(event)" required placeholder="name@example.com" />
                                                <label for="inputEmail">El Alumno Tiene Asistencia Medica Especial</label>
                                                   
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <select class="form-select"  name="currently_vaccinated" required >
            <option  value="">El Alumno Se Ha Vacunado Actualmente</option>
            <option value="Si">Si</option>
            <option value="No">No</option>
        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                  
                                                    <select class="form-select"  name="academic_activity" required >
            <option  value="">El Alumno Ejecuta Actividades Extra-Academicas</option>
            <option value="Si">Si</option>
            <option value="No">No</option>
        </select>
                                                   
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
                                           
                                            
                                           <button type="button" class="btn btn-secondary" onclick="previousStep(2)">Anterior</button>
                                           <button type="button" class="btn btn-primary" onclick="nextStep(4)">Siguiente</button>
                                        
                                       </div>
                                    </div>
                                    <div id="step4" class="step hidden">
            <h3>Paso 4</h3>
            <div class="row mb-3">
                <h4 class="text-center">Datos de los Padres</h4>
            <h5>Datos de la Madre</h5>
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="letras" type="text" name="mother" oninput="soloLetras(event)" placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Nombre de la Madre (*Opcional)</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="numero" type="text"   name="id_card_mother" oninput="soloNumeros(event)" minlength="6" maxlength="8" placeholder="Enter your last name" />
                                                        <label for="inputLastName">Cedula de la Madre(*Opcional)</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                    <input class="form-control" id="numero" type="text"   name="year_mother" oninput="soloNumeros(event)" minlength="2" maxlength="3"  placeholder="Enter your last name" />
                                                        <label for="inputLastName">Edad de la Madre(*Opcional)</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                            <input class="form-control"  type="text" name="address_mother"   placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Dirección(*Opcional)</label>
                                            </div>
            <div class="mb-3">
            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <select class="form-select"  name="status_mother"  >
            <option value="">Estado Civil(*Opcional)</option>
            <option value="Sotero(a)">Sotero(a)</option>
            <option value="Casado(a)">Casado(a)</option>
            <option value="Divorsiado(a)">Divorsiado(a)</option>
            <option value="Viudo(a)">Viudo(a)</option>
        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                  
                                                    <input class="form-control"  id="letras" type="text" name="profession_mother" oninput="soloLetras(event)"  placeholder="name@example.com" />
                                                <label for="inputEmail">Prof.U Ofic(*Opcional)</label>
                                                   
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="form-floating mb-3">
                                            <input class="form-control"  type="text" name="workplace_mother"  placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Lugar de Trabajo(*Opcional)
                                        
                                                        </label>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="numero" type="text"  maxlength="11"   name="room_phone_mother" oninput="soloNumeros(event)"  placeholder="Enter your last name" />
                                                        <label for="inputLastName">Telef.Habitación(*Opcional)</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="numero" type="text" maxlength="11"  name="mobile_phone_mother" oninput="soloNumeros(event)"   placeholder="Enter your last name" />
                                                        <label for="inputLastName">Telef.Movil(*Opcional)</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                    <input class="form-control" id="numero" type="text"  maxlength="11"  name="work_phone_mother" oninput="soloNumeros(event)"   placeholder="Enter your last name" />
                                                        <label for="inputLastName">Telef.Trabajo(*Opcional)</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <h5>Datos del Padre</h5>
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="letras" type="text" name="father" oninput="soloLetras(event)" placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Nombre del Padre(*Opcional)</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="numero" type="text"   name="id_card_father" minlength="6" maxlength="8" oninput="soloNumeros(event)" placeholder="Enter your last name" />
                                                        <label for="inputLastName">Cedula del Padre(*Opcional)</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                    <input class="form-control" id="numero" type="text"   name="year_father"  minlength="2" maxlength="3" oninput="soloNumeros(event)"   placeholder="Enter your last name" />
                                                        <label for="inputLastName">Edad del Padre(*Opcional)</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                            <input class="form-control"  type="text" name="address_father"   placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Dirección(*Opcional)</label>
                                            </div>
            <div class="mb-3">
            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <select class="form-select"  name="status_father"  >
            <option value="">Estado Civil(*Opcional)</option>
            <option value="Sotero(a)">Sotero(a)</option>
            <option value="Casado(a)">Casado(a)</option>
            <option value="Divorsiado(a)">Divorsiado(a)</option>
            <option value="Viudo(a)">Viudo(a)</option>
        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                  
                                                    <input class="form-control"  id="letras" type="text" name="profession_father" oninput="soloLetras(event)"  placeholder="name@example.com" />
                                                <label for="inputEmail">Prof.U Ofic(*Opcional)</label>
                                                   
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="form-floating mb-3">
                                            <input class="form-control"  type="text" name="workplace_father"   placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Lugar de Trabajo(*Opcional)
                                        
                                                        </label>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="numero" type="text" maxlength="11"  name="room_phone_father" oninput="soloNumeros(event)"   placeholder="Enter your last name" />
                                                        <label for="inputLastName">Telef.Habitación(*Opcional)</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="numero" type="text" maxlength="11"  name="mobile_phone_father" oninput="soloNumeros(event)"   placeholder="Enter your last name" />
                                                        <label for="inputLastName">Telef.Movil(*Opcional)</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                    <input class="form-control" id="numero" type="text" maxlength="11"  name="work_phone_father" oninput="soloNumeros(event)"   placeholder="Enter your last name" />
                                                        <label for="inputLastName">Telef.Trabajo(*Opcional)</label>
                                                    </div>
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
                                                                        <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="letras" type="text" required name="responsible" oninput="soloLetras(event)" placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Nombre y Apellido</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="numero" type="text" required  name="id_card_responsible"  minlength="6" maxlength="8" oninput="soloNumeros(event)"  placeholder="Enter your last name" />
                                                        <label for="inputLastName">Cedula de Identidad</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                    <input class="form-control" id="numero" type="text"  required  name="year_responsible"  minlength="2" maxlength="3" oninput="soloNumeros(event)" placeholder="Enter your last name" />
                                                        <label for="inputLastName">Edad</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                            <input class="form-control"  type="text" required name="address_responsible"   placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Dirección</label>
                                            </div>
            <div class="mb-3">
            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control"  id="letras" required type="text" name="profession_responsible" oninput="soloLetras(event)" placeholder="name@example.com" />
                                                <label for="inputEmail">Prof.U Ofic</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                    <input class="form-control"   type="text" name="workplace_responsible"   placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Lugar de Trabajo(*Opcional)
                                                  
                                                        </label>
                                                        </div>
                                           
                                                        </div>     </div>
                                           <button type="button" class="btn btn-secondary" onclick="previousStep(4)">Anterior</button>
                                         
                                           <input type="submit" class="btn btn-success" value="Registrar"></input>
                                       </div>
                          </form>
              
                </main>
            </div>
                    </div>
                </main>

<?php
require_once"../View/layaouts/admin/Footer.php";

?>
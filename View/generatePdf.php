<?php
require_once"../View/layaouts/admin/Head.php";

?>
<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
    header('Location: ../View/login/index.php?message=' . urlencode('Acceso denegado.') . '&type=danger');
    exit();
}
?>
<?php
require_once"../Config/db.php";
require_once"../php/count.php";
require_once"../View/layaouts/admin/nav.php"
?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Generador de Reportes Pdf</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Generar Documentos Pdf</li>
                        </ol>
                    
                        <div class="container mt-5">
    <div class="row">
        <div class="col-12 col-md-6 mb-2">
            <!-- Botón 1 -->
            <button type="button" class="btn btn-primary btn-lg w-100" data-bs-toggle="modal" data-bs-target="#modal1">
                Constacia de Inscripción
            </button>
        </div>

        <div class="col-12 col-md-6 mb-2">
            <!-- Botón 2 -->
            <button type="button" class="btn btn-primary btn-lg w-100" data-bs-toggle="modal" data-bs-target="#modal2">
                Constacia de Estudio
            </button>
        </div>

           <!-- Botón 3
           <div class="col-12 col-md-4 mb-2">
          
            <button type="button" class="btn btn-primary btn-lg w-100" data-bs-toggle="modal" data-bs-target="#modal3">
            Constacia de Prosecuación  
            </button>
        </div>
    </div>-->

    <!-- Modal 1 -->
    <div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="modal1Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal1Label">Constacia de Inscripción</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../View/constanciaInscripcion.php" method="POST" target="_blank">
                        <div class="mb-3">
                            <label for="input1" class="form-label">Cedula de Identidad</label>
                            <input class="form-control" id="numero" minlength="8" maxlength="8" type="text" name="id_card" oninput="soloNumeros(event)" required  />
                           
                        </div>
                        <button type="submit" class="btn btn-primary">Generar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 2 -->
    <div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal2Label">Constacia de Estudio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="../View/constanciaEstudio.php" method="POST" target="_blank">
                        <div class="mb-3">
                            <label for="input1" class="form-label">Cedula de Identidad</label>
                            <input class="form-control" id="numero"  minlength="8" maxlength="8" type="text" name="id_card" oninput="soloNumeros(event)" required  />
                           
                        </div>
                        <button type="submit" class="btn btn-primary">Generar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 3 
    <div class="modal fade" id="modal3" tabindex="-1" aria-labelledby="modal3Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal3Label">Constacia de Prosecuación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="../View/constanciaProsecuacion.php" method="POST" target="_blank">
                        <div class="mb-3">
                            <label for="input1" class="form-label">Cedula de Identidad</label>
                            <input class="form-control" id="numero"  type="text" name="id_card" oninput="soloNumeros(event)" required  />
                            <label for="input1" class="form-label">Periodo Academico</label>
                            <input class="form-control"   type="text" name="promo"  required  />
                            <label for="input1" class="form-label">Promovido A</label>
                            <select class="form-select" id="degreeSelect" name="grado" required >
            <option disabled value="">Selecciona un Grado</option>
           
                <option value="1er Grado">
                1er Grado
                </option>
                <option value="2do Grado">
                2do Grado
                </option>

                <option value="3er Grado">
                3er Grado
                </option>
                <option value="4to Grado">
                4to Grado
                </option>
                <option value="5to Grado">
                5to Grado
                </option>
                <option value="6to Grado">
                6to Grado
                </option>
                
                

           
        </select>
        <label for="input1" class="form-label">Literal</label>
        <select class="form-select" id="degreeSelect" name="cali" required >
                        <option disabled value="">Selecciona un Literal</option>
           
           <option value="A">
           A
           </option>
           <option value="B">
           B
           </option>

           <option value="C">
           C
           </option>
           <option value="D">
           D
           </option>
           <option value="E">
           E
           </option>
          
           
           

      
   </select>
                          
                        </div>
                       
                        <button type="submit" class="btn btn-primary">Generar</button>
                    </form>
                
            </div>
        </div>
    </div></div>-->
</div>
                       
                        
                    </div>
                </main>

       <?php
require_once"../View/layaouts/admin/Footer.php";

?>
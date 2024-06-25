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
                        <h1 class="mt-4">Restauración de Base de Datos</h1>
                        
    <div class="card bg-light" style="margin: 10px; ">
      
        <form class="needs-validation"  style="margin: 20px; " action="../php/Restore.php" method="POST">
          <div class="container">
          

          <div class="form-floating mb-3">
        
		<select class="form-select" name="restorePoint"  id="single-select-field" required>
			<option value="" disabled="" selected="">Selecciona un punto de restauración</option>
			<?php
				include_once '../Config/Conect.php';
				$ruta=BACKUP_PATH;
				if(is_dir($ruta)){
				    if($aux=opendir($ruta)){
				        while(($archivo = readdir($aux)) !== false){
				            if($archivo!="."&&$archivo!=".."){
				                $nombrearchivo=str_replace(".sql", "", $archivo);
				                $nombrearchivo=str_replace("-", ":", $nombrearchivo);
				                $ruta_completa=$ruta.$archivo;
				                if(is_dir($ruta_completa)){
				                }else{
				                    echo '<option value="'.$ruta_completa.'">'.$nombrearchivo.'</option>';
				                }
				            }
				        }
				        closedir($aux);
				    }
				}else{
				    echo $ruta." No es ruta válida";
				}
			?>
		</select>
        

            
       
            </div>
       
          
          

          <hr class="my-4">

          <button class=" btn btn-primary btn-lg col-12" type="submit">Subir</button>
        </form>
      </div>
    </div>
                    
                        
                    </div>             
</main>


       <?php
require_once"../View/layaouts/admin/Footer.php";

?>
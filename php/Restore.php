<?php
require_once "../Config/Conect.php";

$restorePoint=SGBD::limpiarCadena($_POST['restorePoint']);
$sql=explode(";",file_get_contents($restorePoint));
$totalErrors=0;
set_time_limit (60);
$con=mysqli_connect(SERVER, USER, PASS, BD);
$con->query("SET FOREIGN_KEY_CHECKS=0");
for($i = 0; $i < (count($sql)-1); $i++){
    if($con->query($sql[$i].";")){  }else{ $totalErrors++; }
}
$con->query("SET FOREIGN_KEY_CHECKS=1");
$con->close();
if($totalErrors<=0){
    session_start();
    session_unset();
    session_destroy();
    header('Location: ../View/login/index.php?message=' . urlencode('La base de datos fue restaurada de forma correcta') . '&type=success');
	
}else{
	?><script>
	alert("Ocurrio un error inesperado, no se pudo hacer la restauración completamente");
	window.location.href="../View/actionBackups.php";
  </script><?php
}
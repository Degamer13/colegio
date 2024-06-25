<?php
require '../Dompdf/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Verificar si se ha enviado el id_card por POST
if (isset($_POST['id_card'])) {
    $id_card = $_POST['id_card'];

    // Conexión a la base de datos (ajusta estos datos según tu configuración)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "colegio";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consultar los datos del estudiante según el id_card
    $sql = "SELECT students.name1, students.last_name1, students.id_card, students.year, 
    students.birthplace, students.state, degrees.description 
    FROM students 
    INNER JOIN degrees ON students.degree_id = degrees.id_degree 
    WHERE students.id_card = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id_card);
    $stmt->execute();
    $stmt->bind_result($name1, $last_name1, $id_card, $year1, $birthplace, $state, $description);
    $stmt->fetch();
    $stmt->close();
    $conn->close();

    if (empty($name1) && empty($last_name1) && empty($id_card) && empty($year1) && empty($birthplace) && empty($state) && empty($description)) {
        die("No se encontraron datos para el ID Card proporcionado.");
    }
    // Establecer el formateador de fecha
        $formatter = new IntlDateFormatter('es_ES', IntlDateFormatter::FULL, IntlDateFormatter::NONE, 'America/Caracas');
        $formatter->setPattern('d'); // Día
        $day = $formatter->format(time());

        $formatter->setPattern('MMMM'); // Mes en texto
        $month = $formatter->format(time());

        $formatter->setPattern('Y'); // Año
        $year = $formatter->format(time());
        $imagePath = 'http://' . $_SERVER['HTTP_HOST'] . '/Colegio/assets/img/logo.png'; // Asegúrate de que la imagen esté en esta ruta
        $imagePath1 = 'http://' . $_SERVER['HTTP_HOST'] . '/Colegio/assets/img/vene.jpg'; // Asegúrate de que la imagen esté en esta ruta
    // Crear una nueva instancia de Dompdf
    $options = new Options();
    $options->set('isRemoteEnabled', true);
    $dompdf = new Dompdf($options);

    // Crear el contenido HTML para el PDF
    $html = "
    <html>
    <head>
        <meta charset='UTF-8'>
        <style>
        .container {
            width: 100%;
            
        }
        
        .parrafo {
            width: 50%; /* Ajusta el ancho según tu preferencia */
            float: left; /* Coloca los divs uno al lado del otro */
            margin-right: 2%; /* Agrega un pequeño margen entre los divs */
            text-align: center;
        }
        
        
        h5{
           text-align: center;
        }
        h4{
          text-align: center;
        }
        
            .justificado {
                text-align: justify;
                text-indent: 30px; /* Cambia este valor según la sangría que desees */
        }

        .firma{
            text-align: center;
        }
           
        </style>
    </head>
    <body>
    
    <img  src='$imagePath1' alt='Logo' width='100' height='100'><img src='$imagePath' style='margin-left:70%;'alt='Logo' width='100' height='100'>
   
            <h5>REPÚBLICA BOLIVARIANA DE VENEZUELA <br>
            MINISTERIO DEL PODER POPULAR PARA LA EDUCACIÓN<br>
            E.B.N “PADRE JESUS NIETO”
            <br>
            CIUDAD BOLÍVAR – ESTADO BOLÍVAR<br>
            PARROQUIA CATEDRAL – MUNICIPIO ANGOSTURA DEL ORINOCO<br>
            CODIGO INSTITUCIONAL06-006567435<br>
            CODIGO DEA OD08540705<br>
            CODIGO ESTADISTICO 070595<br>
            </h5>
            </br>
            <h4>CONSTANCIA DE ESTUDIO </h4>
            </br>
            <p class='justificado'>La suscrita Directora  (e) de la <strong>Escuela Básica Nacional “PADRE JESUS NIETO” Licda, Mayra Romero Cedula de Identidad: 13.017.996,</strong> hace constar por medio de la presente  que el <strong>Alumno: </strong><strong style='text-transform: uppercase'> $name1 $last_name1,</strong>
             Cedula de <strong>Identidad/Escolar: $id_card,</strong> natural de: <strong style='text-transform: uppercase'>$birthplace, Edo. $state,</strong> y de <strong>$year1</strong> de Edad, está  cursando estudios en esta institución el : <strong style='text-transform: uppercase'>  $description </strong>Educación Básica en el año escolar: <strong>2023-2024.</strong></p>
             <br>
             <p>En Ciudad Bolívar, a los (<strong>$day</strong>) días  del mes de <strong>$month</strong> del año <strong>$year</strong>.</p>

             <br>
          
            <br><br><br><br><br>
            <div class='container'>
            <div class='parrafo'>
                <p>
                __________________<br>  
                Licda. Mayra Romero<br>
                C.I.N.:13.017.996<br>
                Directora ( e )  <br>
                Telef.:0412-8584797</p>
            </div>
            <div class='parrafo'>
                <p>SELLO<P>
            </div>
        </div>
	
  


      
        
    </body>
    </html>
    ";

    // Cargar el HTML en Dompdf
    $dompdf->loadHtml($html);

    // (Opcional) Configurar el tamaño del papel y la orientación
    $dompdf->setPaper('A4', 'portrait');

    // Renderizar el PDF
    $dompdf->render();

    // Enviar el PDF al navegador
    $dompdf->stream("Constacia de  Estudio.pdf", array("Attachment" => false));
} else {
    echo "No se proporcionó ningún ID Card.";
}
?>

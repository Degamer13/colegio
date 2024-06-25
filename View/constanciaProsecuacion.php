<?php
require '../Dompdf/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Verificar si se ha enviado el id_card por POST
if (isset($_POST['id_card'], $_POST['promo'], $_POST['grado'])) {
    $id_card = $_POST['id_card'];
    $promo = $_POST['promo'];
    $cali = $_POST['cali'];
    $grado = $_POST['grado'];

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
    students.birthplace, students.state, students.birthdate, degrees.description 
    FROM students 
    INNER JOIN degrees ON students.degree_id = degrees.id_degree 
    WHERE students.id_card = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id_card);
    $stmt->execute();
    $stmt->bind_result($name1, $last_name1, $id_card, $year1, $birthplace, $state, $birthdate, $description);
    $stmt->fetch();
    $stmt->close();
    $conn->close();

    if (empty($name1) && empty($last_name1) && empty($id_card) && empty($year1) && empty($birthplace) && empty($state) && empty($birthdate) && empty($description)) {
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
    $imagePath = 'http://' . $_SERVER['HTTP_HOST'] . '/Colegio/assets/img/escudo.png'; // Asegúrate de que la imagen esté en esta ruta

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
        h5{
            text-align: center;
        }
        h2{
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
    <center><img src='$imagePath' alt='Logo' width='100' height='100'></center>
   
        <h2>CONSTANCIA DE PROSECUCIÓN <br>
        EN EL NIVEL DE EDUCACIÓN PRIMARIA
        </h2>
        <br>
        <p class='justificado'>Quien suscribe <strong> MAYRA ROMERO </strong> titular de la Cédula de Identidad Nº <strong>13.017.996</strong> en su condición de C Director(a) del plantel: <strong> E.B.N. “PADRE JESUS NIETO” </strong>
        ubicado en el municipio: Angostura del Orinoco parroquia: Catedral adscrito al Centro de Desarrollo por la Calidad Educativa del estado Bolívar, certifica por medio de la presente que el (la) estudiante <strong style='text-transform: uppercase'> $name1 $last_name1 </strong> titular de la Cédula Escolar N°, Cédula de Identidad Nº o Pasaporte N° <strong> $id_card </strong>
        nacido (a) en <strong style='text-transform: uppercase'> $birthplace Edo. $state </strong> en fecha: <strong>$birthdate</strong> cursó el <strong style='text-transform: uppercase'>$description</strong> correspondiéndole el literal “<strong>$promo</strong>”, durante el periodo escolar <strong>$promo</strong>, siendo promovido (a) al <strong >$grado del Nivel de Educación Primaria</strong>, previo cumplimiento de los requisitos exigidos en la normativa legal vigente.</p>
        <br>
        <p>Constancia que se expide en Ciudad Bolívar a los  (<strong>$day</strong>) días del mes de <strong>$month</strong> del año <strong>$year</strong>.</p>

        <br>
        <table border='1'>
        <tr>
            <th>PLANTEL
PARA VALIDEZ A NIVEL NACIONAL
</th>
            <th>PLANTEL
PARA VALIDEZ A NIVEL NACIONAL	CENTRO DE DESARROLLO POR LA CALIDAD EDUCATIVA ESTADAL - BOLIVAR
PARA VALIDEZ A NIVEL INTERNACIONAL
</th>
        </tr>
        <tr>
            <td>DIRECTOR(A)</td>
            <td>DIRECTOR(A)</td>
        </tr>
        <tr>
            <td>Nombre y Apellido: Mayra Romero</td>
            <td>Nombre y Apellido:</td>
        </tr>
        <tr>
            <td>Número de C.I: 13.017.996</td>
            <td>Número de C.I:</td>
        </tr>
        <tr>
            <td>Firma y Sello: <br> <br><br><br><br></td>
            <td>Firma y Sello: <br> <br><br><br><br></td>
        </tr>
    </table>
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
    $dompdf->stream("Constancia de Prosecuacion.pdf", array("Attachment" => false));
} else {
    echo "No se proporcionó ningún ID Card.";
}
?>

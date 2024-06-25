<?php
require '../Dompdf/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Configuración de la base de datos
$host = 'localhost';
$db = 'colegio';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

// Conexión a la base de datos utilizando PDO
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Obtener el id_report desde la solicitud GET
$id_report = $_GET['id'];

// Consulta SQL para obtener los datos del estudiante y la descripción del degree
$sql = "
SELECT * FROM report_card r 
JOIN students s ON r.student_id = s.id_student
JOIN degrees d ON r.degree_id2 = d.id_degree 
WHERE r.id_report = :id
";

$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id_report]);
$student = $stmt->fetch();

if ($student) {
    // Establecer el formateador de fecha
    $formatter = new IntlDateFormatter('es_ES', IntlDateFormatter::FULL, IntlDateFormatter::NONE, 'America/Caracas');
    $formatter->setPattern('d'); // Día
    $dia = $formatter->format(time());

    $formatter->setPattern('MMMM'); // Mes en texto
    $mes = $formatter->format(time());

    $formatter->setPattern('Y'); // Año
    $anio = $formatter->format(time());
    $imagePath = 'http://' . $_SERVER['HTTP_HOST'] . '/Colegio/assets/img/logo.png'; // Asegúrate de que la imagen esté en esta ruta
    $imagePath1 = 'http://' . $_SERVER['HTTP_HOST'] . '/Colegio/assets/img/vene.jpg'; // Asegúrate de que la imagen esté en esta ru

    // Formatear la fecha de nacimiento
    $originalBirthdate = htmlspecialchars($student['birthdate']);
    $birthdate = new DateTime($originalBirthdate);
    $formattedBirthdate = $birthdate->format('d-m-Y');

    // Contenido HTML para el PDF
    $html = '
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <style>
        .justificado {
            text-align: justify;
            text-indent: 30px; /* Cambia este valor según la sangría que desees */
        }
        .container {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            border: none;
            padding: 10px;
            text-align: center;
        }
        </style>
    </head>
    <body>
    
    <img src="' . htmlspecialchars($imagePath1) . '" alt="Logo" width="100" height="100">
    <img src="' . htmlspecialchars($imagePath) . '" style="margin-left:70%;" alt="Logo" width="100" height="100">
    <center>
        <p>REPUBLICA BOLIVARIANA DE VENEZUELA <br>
        MINISTERIO DEL PODER POPULAR PARA LA EDUCACION <br>
        <strong>E.B.N. “PADRE JESUS NIETO”</strong><br>
        CIUDAD BOLIVAR – ESTADO BOLIVAR
        </p>
        <h3>INFORME DESCRIPTIVO</h3>
    </center>

    <p class="justificado">Quien suscribe, <strong>MAYRA ROMERO,</strong> N° de Cédula <strong>13.017.996,</strong> Directora (E) de la <strong>E.B.N. “PADRE JESUS NIETO”,</strong>
    hace constar, por medio de la presente que el (la) Alumno (a):, Registro Escolar /C.I. N° <strong style="text-transform: uppercase">' . htmlspecialchars($student['id_card']).' '.htmlspecialchars($student['name1']).' '.htmlspecialchars($student['last_name1']).'</strong> natural de <strong style="text-transform: uppercase">' . htmlspecialchars($student['birthplace']) . '</strong> Estado <strong style="text-transform: uppercase">' . htmlspecialchars($student['state']) . ' </strong>,
    nacido el <strong>' . $formattedBirthdate . ' </strong>, de <strong>' . htmlspecialchars($student['year']) . ' </strong> de Edad, cursante del <strong>' . htmlspecialchars($student['description']) . ' </strong> de Educación Primaria, durante el Año Escolar <strong>' . htmlspecialchars($student['year_educ']) . ' </strong> fue PROMOVIDO(A) al <strong>' . htmlspecialchars($student['promovide']) . ' </strong>, con el Código Literal <strong>' . htmlspecialchars($student['qualification']) . ' </strong>
    según el Artículo 44 de la Ley Orgánica de Educación y el Artículo 16 del Reglamento de Evaluación (Resolución N° 266 aún vigente).</p>
     
    <strong><p>APRECIACION CUALITATIVA:</p></strong>
    <p class="justificado"><u>' . htmlspecialchars($student['description2']) . '</u></p>
    <p class="justificado">En Ciudad Bolívar, a los <strong>(' . $dia . ')</strong> días del mes de <strong>' . $mes . '</strong> del <strong>' . $anio . '</strong>.</p>
        
    <br><br><br><br><br>
    <table class="container">
        <tr>
            <td class="left">
            _________________<br>
            Docente del Grado
            </td>
            <td class="middle">SELLO</td>
            <td class="right">
            _______________________<br>
            Director(a) del Plantel
            </td>
        </tr>
    </table>

    <strong><p class="justificado">ARTICULO N° 16:</p></strong>
    <p class="justificado">A: El alumno alcanzo todas las competencias y en algunos casos supero las expectativas previstas para el Grado.</p>
    <p class="justificado">B: El alumno alcanzo todas las competencias previstas para el Grado.</p>
    <p class="justificado">C: El alumno alcanzo la mayoría de las competencias previstas para el Grado.</p>
    <p class="justificado">D: El alumno alcanzo algunas de las competencias del Grado, pero requiere de un proceso de nivelación al Inicio del Nuevo Año Escolar para alcanzar las restantes.</p>
    <p class="justificado">E: El alumno no logro adquirir las competencias mínimas requeridas para ser promovido al Grado inmediato superior.</p>
    </body>
    </html>
    ';

    // Opciones para DOMPDF
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true);

    // Crear instancia de DOMPDF
    $dompdf = new Dompdf($options);

    // Cargar contenido HTML en DOMPDF
    $dompdf->loadHtml($html);

    // (Opcional) Configurar el tamaño del papel y la orientación
    $dompdf->setPaper('A4', 'portrait');

    // Renderizar el PDF
    $dompdf->render();

    // Enviar el PDF generado al navegador
    $dompdf->stream("Informe Descriptivo.pdf", ["Attachment" => false]);
} else {
    echo "No se encontraron datos para el ID del estudiante proporcionado.";
}
?>

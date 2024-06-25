<?php
require_once "../View/layaouts/admin/Head.php";

session_start();
if (!isset($_SESSION['user_id']) || !in_array($_SESSION['role_id'], [1, 2])) {
    header('Location: ../View/login/index.php?message=' . urlencode('Acceso denegado.') . '&type=danger');
    exit();
}

require_once "../Config/db.php";

// Obtener el id del usuario logeado
$user_id = $_SESSION['user_id'];

try {
    $query = "
        SELECT u.id, u.username, u.email, s.ask1, s.ask2, s.ask3, s.answer1, s.answer2, s.answer3
        FROM users u
        LEFT JOIN security_questions s ON u.id = s.user_id
        WHERE u.id = :user_id
    ";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['user_id' => $user_id]);
    $row = $stmt->fetch();

    if (!$row) {
        throw new Exception("No se encontraron datos para el usuario.");
    }
} catch (Exception $e) {
    die('Error al obtener datos del usuario: ' . $e->getMessage());
}

require_once "../php/count.php";
require_once "../View/layaouts/admin/nav.php";
?>

<div id='layoutSidenav_content'>
<main>
<div class='container-fluid px-4'>
<h1 class='mt-4'>Perfil de Usuario</h1>
<ol class='breadcrumb mb-4'></ol>

<div class='container'>

<div class='row g-5'>
<div class='col-md-5 col-lg-4 order-md-last'>
<h4 class='d-flex justify-content-between align-items-center mb-3'>
<span class='text-dark'>Información Del Perfil</span>
</h4>
<ul class='list-group mb-3'>
<li class='list-group-item d-flex justify-content-between lh-sm'>
<div>
<small class='text-muted'>Actualice la información de perfil y la dirección de correo electrónico de su cuenta.</small>
</div>
</li>
</ul>
</div>
<div class='col-md-7 col-lg-8'>
<form class='' method='POST' action='../php/UpdateProfile.php?id=<?= $row['id'] ?>'>
<div class='row g-3'>
<div class='col-12'>
<label for='username' class='form-label'>Nombre de Usuario</label>
<div class='input-group has-validation'>
<input type='text' class='form-control' id='username' name='username' placeholder='Escribir Nombre de Usuario' value="<?= htmlspecialchars($row['username']) ?>" required>

</div>
</div>

<div class='col-12'>
<label for='email' class='form-label'>Correo Eléctronico</label>
<input type='email' class='form-control' id='email' name='email' placeholder='you@example.com' value="<?= htmlspecialchars($row['email']) ?>" required>
<div class='invalid-feedback'>
Please enter a valid email address for shipping updates.
</div>
</div>
</div>
<br>
<div class='d-grid gap-2 d-md-flex justify-content-md-end'>
<button class='btn btn-outline-primary' type='submit'>Guardar</button>
</div>
<hr class='my-4'>
</form>
</div>
</div>
</div>

<div class='container'>
<div class='row g-5'>
<div class='col-md-5 col-lg-4 order-md-last'>
<h4 class='d-flex justify-content-between align-items-center mb-3'>
<span class='text-dark'>Actualizar Contraseña</span>
</h4>
<ul class='list-group mb-3'>
<li class='list-group-item d-flex justify-content-between lh-sm'>
<div>
<small class='text-muted'>Asegúrese de que su cuenta esté usando una contraseña larga y aleatoria para mantenerse seguro.</small>
</div>
</li>
</ul>
</div>
<div class='col-md-7 col-lg-8'>
    <form class='' method='POST' action='../php/UpdatePassword2.php' onsubmit='return validarClave(event)'>
        <div class='row g-3'>
            <div class='col-12'>
                <label for='clave' class='form-label'>Nueva Contraseña</label>
                <div class='input-group has-validation'>
                    <input type='password' class='form-control' id='clave' name='password' maxlength='15' minlength='8' placeholder='Escribir Contraseña Nueva' required>
                    <div class='invalid-feedback'>
                        Your password is required.
                    </div>
                </div>
            </div>
            <div class='col-12'>
                <label for='confirmacionClave' class='form-label'>Confirmar Contraseña</label>
                <input type='password' class='form-control' id='confirmacionClave' name='confirm_password' maxlength='15' minlength='8' placeholder='Escribir Contraseña de Nuevo' required>
                <div class='invalid-feedback'>
                    Please enter a valid password confirmation.
                </div>
            </div>
        </div>
        <br>
        <input type='hidden' name='user_id' value="<?= htmlspecialchars($row['id']) ?>">
        <div class='d-grid gap-2 d-md-flex justify-content-md-end'>
            <button class='btn btn-outline-primary' type='submit'>Guardar</button>
        </div>
        <hr class='my-4'>
    </form>
</div>
</div>
</div>

<div class='container'>
<div class='row g-5'>
<div class='col-md-5 col-lg-4 order-md-last'>
<h4 class='d-flex justify-content-between align-items-center mb-3'>
<span class='text-dark'>Preguntas de Seguridad</span>
</h4>
<ul class='list-group mb-3'>
<li class='list-group-item d-flex justify-content-between lh-sm'>
<div>
<small class='text-muted'>Asegúrese de establecer sus preguntas de seguridad para poder recuperar el acceso a su cuenta si es necesario.</small>
</div>
</li>
</ul>
</div>
<div class='col-md-7 col-lg-8'>
    <form class='' method='POST' action='../php/UpdateQuestyon.php'>
        <div class='row'>
            <div class='col'>
                <label for='ask1' class='form-label'>Pregunta N° 1</label>
                <input type='text' class='form-control' id='ask1' name='ask1' placeholder='Escribir Pregunta' value="<?= isset($row['ask1']) ? htmlspecialchars($row['ask1']) : '' ?>" required>
            </div>
            <br>
            <div class='col'>
                <label for='answer1' class='form-label'>Respuesta N° 1</label>
                <input type='text' class='form-control' id='answer1' name='answer1' placeholder='Escribir Respuesta'  required>
            </div>
        </div>
        <br>
        <div class='row'>
            <div class='col'>
                <label for='ask2' class='form-label'>Pregunta N° 2</label>
                <input type='text' class='form-control' id='ask2' name='ask2' placeholder='Escribir Pregunta' value="<?= isset($row['ask2']) ? htmlspecialchars($row['ask2']) : '' ?>" required>
            </div>
            <br>
            <div class='col'>
                <label for='answer2' class='form-label'>Respuesta N° 2</label>
                <input type='text' class='form-control' id='answer2' name='answer2' placeholder='Escribir Respuesta'  required>
            </div>
        </div>
        <br>
        <div class='row'>
            <div class='col'>
                <label for='ask3' class='form-label'>Pregunta N° 3</label>
                <input type='text' class='form-control' id='ask3' name='ask3' placeholder='Escribir Pregunta' value="<?= isset($row['ask3']) ? htmlspecialchars($row['ask3']) : '' ?>" required>
            </div>
            <br>
            <div class='col'>
                <label for='answer3' class='form-label'>Respuesta N° 3</label>
                <input type='text' class='form-control' id='answer3' name='answer3' placeholder='Escribir Respuesta' 
                 required>
            </div>
        </div>
        <br>
        <input type='hidden' class='form-control' name='id_user' value="<?= $row['id'] ?>">
        <br>
        <div class='d-grid gap-2 d-md-flex justify-content-md-end'>
            <button class='btn btn-outline-primary' type='submit'>Guardar</button>
        </div>
        <hr class='my-4'>
    </form>
</div>
</div>
</div>
</main>

<?php
require_once "../View/layaouts/admin/Footer.php";
?>
<script>
function validarClave(event) {
    const password = document.getElementById('clave').value;
    const confirmPassword = document.getElementById('confirmacionClave').value;

    if (password !== confirmPassword) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Las contraseñas no coinciden',
        });
        event.preventDefault(); // Evitar el envío del formulario
        return false;
    }
    return true;
}

<?php if (isset($_GET['password_updated']) && $_GET['password_updated'] == 'true'): ?>
Swal.fire({
    icon: 'success',
    title: 'Éxito',
    text: 'Contraseña actualizada exitosamente',
}).then(function() {
    window.location.href = window.location.href.split('?')[0]; // Redirige a la misma página sin parámetros GET
});
<?php endif; ?>
</script>

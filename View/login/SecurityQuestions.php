<?php
require_once "../../View/layaouts/Head.php";
require_once "../../Config/db.php";

$id = $_GET['id'];

// Inicializar variables de mensaje
$message = "";
$messageType = "";

// Obtener preguntas de seguridad usando PDO
try {
    $stmt = $pdo->prepare("SELECT * FROM users u LEFT JOIN security_questions s ON s.user_id = u.id WHERE u.id = ?");
    $stmt->execute([$id]);
    $preguntas = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$preguntas || empty($preguntas['ask1']) || empty($preguntas['ask2']) || empty($preguntas['ask3'])) {
        $message = "No posee preguntas de seguridad configuradas.";
        $messageType = "warning";
    }
} catch (PDOException $e) {
    $message = "Error al obtener las preguntas de seguridad: " . $e->getMessage();
    $messageType = "danger";
}
?>

<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <center><img src="../../assets/img/logo.png" width="25%" alt=""></center> 
                            <div class="card-header"><h3 class="text-center font-weight-light my-4">Preguntas de Seguridad</h3></div>
                            <div class="card-body">
                                <div class="small mb-3 text-muted">Por favor responda las siguientes preguntas de seguridad</div>
                            

                                <form action="../../php/ValidaPregunta.php?id=<?= $id; ?>" method="POST">
                                    <?php if ($preguntas && !empty($preguntas['ask1']) && !empty($preguntas['ask2']) && !empty($preguntas['ask3'])): ?>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" type="text" name="answer1" required />
                                            <label for="pregunta1"><?= htmlspecialchars($preguntas['ask1']); ?></label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" type="text" name="answer2" required />
                                            <label for="pregunta2"><?= htmlspecialchars($preguntas['ask2']); ?></label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" type="text" name="answer3" required />
                                            <label for="pregunta3"><?= htmlspecialchars($preguntas['ask3']); ?></label>
                                        </div>
                                    <?php endif; ?>
                                    <div class="mt-4 mb-0">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary btn-block">Responder</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center py-3">
                                <div class="small"><a href="index.php">¿Tener una cuenta? Ir a iniciar sesión</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php
require_once "../../View/layaouts/Footer.php";
?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    <?php if ($message): ?>
        Swal.fire({
            icon: '<?= $messageType; ?>',
            title: 'Aviso',
            text: '<?= $message; ?>',
        }).then(function() {
            window.location.href = "./index.php";
        });
    <?php endif; ?>
});
</script>

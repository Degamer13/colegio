<?php
session_start();
session_unset();
session_destroy();
header('Location: ../View/login/index.php?message=' . urlencode('Has cerrado sesión exitosamente.') . '&type=success');
exit();
?>
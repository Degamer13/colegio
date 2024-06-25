<br>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-dark mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted"> &copy; Copyright <strong><span>Escuela Basica Nacional "Padre Jesús Nieto"</span></strong>. Reservados todos los derechos</div>
                           
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="../../js/jquery-3.6.0.min.js"></script>
    <script src="../../js/popper.min.js"></script>
        <script src="../../js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../../js/scripts.js"></script>
          <!-- Custom JS for validation -->
    <script>
       javascript
function validarClave() {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirmPassword").value;

    if (password === confirmPassword) {
        Swal.fire({
            title: 'Las Contraseñas coinciden.',
            icon: 'success',
            confirmButtonText: 'Entendido'
        });
        return true;
    } else {
        Swal.fire({
            title: 'Las Contraseñas no coinciden.',
            text: 'Por favor, verifica la contraseña.',
            icon: 'error',
            confirmButtonText: 'Entendido'
        });
        return false;
    }
}
    </script>
    </body>
</html>


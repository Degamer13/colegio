<footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">&copy; Copyright <strong><span>Escuela Basica Nacional "Padre Jesús Nieto"</span></strong>. Reservados todos los derechos</div>
                           
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="./../js/jquery-3.6.0.min.js"></script>
 
    <script src="./../js/popper.min.js"></script>
 
        <script src="./../js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="./../js/scripts.js"></script>
        <script src="./../js/Chart.min.js" crossorigin="anonymous"></script>
        <script src="./../css/assets/demo/chart-area-demo.js"></script>
        <script src="./../css/assets/demo/chart-bar-demo.js"></script>
        <script src="./../js/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="./../js/datatables-simple-demo.js"></script>
        
        <script>
     
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
     <script>
        function soloLetras(event) {
            const input = event.target;
            const regex = /[^a-zA-ZñÑáéíóúÁÉÍÓÚüÜ'\s]/g;
            if (regex.test(input.value)) {
                input.value = input.value.replace(regex, '');
                Swal.fire({
                    icon: 'error',
                    title: 'Entrada inválida',
                    text: 'Solo se permiten letras, espacios y apóstrofes.'
                });
            }
        }
        function soloNumeros(event) {
        const input = event.target;
        const regex = /[^0-9]/g;
        if (regex.test(input.value)) {
            input.value = input.value.replace(regex, '');
            Swal.fire({
                icon: 'error',
                title: 'Entrada inválida',
                text: 'Solo se permiten números.'
            });
        }
    }
    </script>
  
   <script>
    function nextStep(step) {
    if (validateStep(step - 1)) {
        document.getElementById('step' + (step - 1)).classList.add('hidden');
        document.getElementById('step' + step).classList.remove('hidden');
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Campos incompletos',
            text: 'Por favor, rellene todos los campos requeridos.'
        });
    }
}

function previousStep(step) {
    document.getElementById('step' + (step + 1)).classList.add('hidden');
    document.getElementById('step' + step).classList.remove('hidden');
}

function validateStep(step) {
    let isValid = true;
    const stepDiv = document.getElementById('step' + step);
    const inputs = stepDiv.getElementsByTagName('input');

    for (let input of inputs) {
        if (input.hasAttribute('required') && !input.value.trim()) {
            isValid = false;
            break;
        }
    }

    return isValid;
}

   </script>
<script>
    document.querySelector('input[name="birthdate"]').addEventListener('change', function() {
        const dob = new Date(this.value);
        const ageInput = document.querySelector('input[name="year"]');
        const today = new Date();
        let age = today.getFullYear() - dob.getFullYear();
        const m = today.getMonth() - dob.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
            age--;
        }
        ageInput.value = age;
    });
</script>
<script>
    $(document).ready(function() {
        $('#basic-usage').select2({
            placeholder: 'Selecciona un Estudiante',
            allowClear: true
        });
    });
</script>

    </body>
</html>
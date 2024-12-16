<?php 
if (isset($_SESSION['pqrs'])) {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: 'PRS Registrado con exito',
                confirmButtonText: 'Ok'
            });
        });
    </script>";
    unset($_SESSION['pqrs']);
}
if (isset($_SESSION['regAcc'])) {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: 'Accidente registrado con exito',
                confirmButtonText: 'Ok'
            });
        });
    </script>";
    unset($_SESSION['regAcc']);
}
if (isset($_SESSION['regVia'])) {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: 'Solicitud registrada con exito',
                confirmButtonText: 'Ok'
            });
        });
    </script>";
    unset($_SESSION['regVia']);
}
?>
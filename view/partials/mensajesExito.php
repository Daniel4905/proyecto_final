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

if (isset($_SESSION['senNewM'])) {
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
    unset($_SESSION['senNewM']);
}

if (isset($_SESSION['senDan'])) {
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
    unset($_SESSION['senDan']);
}

if (isset($_SESSION['redDan'])) {
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
    unset($_SESSION['redDan']);
}

if (isset($_SESSION['redNew'])) {
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
    unset($_SESSION['redNew']);
}

?>
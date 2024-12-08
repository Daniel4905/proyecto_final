<?php
    
    include_once "../lib/helpers.php";
    include_once "../view/partials/head.php";
    if (!isset($_SESSION['auth'])) {
      header("Location: login.php");
    }
    echo "<body>";
            echo"<div class='wrapper'>";
                include_once "../view/partials/sidebar.php";
                        echo"<div class = 'container-fluid'>";
                            include_once "../view/partials/navbar.php";
                                echo"<div class='page-inner'>";
                                if(isset($_GET['modulo'])){
                                    resolve();
                                }else{
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
                                     echo "<h1>Bienvenido a AccidentEye</h1>";
                                     echo "<p>Selecciona una opción del menú para comenzar.</p>";
                                    //  include_once "../view/partials/content.php";
                                }
                                echo"</div>";
                        echo "</div>";
                       include_once "../view/partials/pqrs.php";
            echo "</div>";
        include_once "../view/partials/footer.php";
    echo "</body>";
    echo "</html>";
?>
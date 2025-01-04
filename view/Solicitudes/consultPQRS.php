<?php 
    if($_SESSION['rol'] != 1){
        echo "<h1>Tus PQRS registradas</h1>";
    }else{
        echo "<h1>PQRS registradas</h1>";
    }
?>
<div class="row mb-3">
    <div class="col-md-4">
        <label for="startDate" class="form-label">Fecha de inicio</label>
        <input type="date" class="form-control" id="fecha1" name="startDate">
    </div>
    <div class="col-md-4">
        <label for="endDate" class="form-label">Fecha de fin</label>
        <input type="date" class="form-control" id="fecha2" name="endDate">
    </div>
    <div class="col-md-4 d-flex align-items-end mt-1">
        <button type="button" class="btn btn-primary" id="consultar"
            data-url="<?= getUrl('PQRS', 'PQRS', 'filtroFecha', false, 'ajax'); ?>">Buscar</button>
    </div>
</div>
<div class="container-scroll-sols">
    <div class="accordion" id="pqrsAccordion">
        <?php
        if (isset($pqrs) && is_array($pqrs) && count($pqrs) > 0) {
            foreach ($pqrs as $index => $pq) {
                echo "<div class='accordion-item'>";
                echo "<h2 class='accordion-header' id='heading$index'>";
                echo "<button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#collapse$index' aria-expanded='false' aria-controls='collapse$index'>";
                if($_SESSION['rol'] == 1){
                    echo "ID: " . $pq['id_pqrs'] . " - " . $pq['desc_tipo_pqrs'];
                }else{
                    echo $pq['desc_tipo_pqrs']. " - " . $pq['fecha_hora']. " &nbsp; <i class='fa-regular fa-calendar'></i>";
                }
                echo "</button>";
                echo "</h2>";
                echo "<div id='collapse$index' class='accordion-collapse collapse' aria-labelledby='heading$index' data-bs-parent='#pqrsAccordion'>";
                echo "<div class='accordion-body'>";
                echo "<p><strong>Descripción:</strong> " . $pq['desc_pqrs'] . "</p>";
                if($_SESSION['rol'] == 1){
                    echo "<p><strong>Solicitante:</strong> " . $pq['usuario_nombre'] . "</p>";
                }
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<div class='alert alert-danger text-center'>No hay ninguna pqrs registrada</div>";
        }
        ?>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#consultar').click(function (event) {
            var fecha1 = $('#fecha1').val();
            var fecha2 = $('#fecha2').val();

            if (fecha1 === "" || fecha2 === "") {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Ninguna de las dos fechas pueden estar vacias",
                    confirmButtonText: 'Ok'
                });
            } else {
                let url = $(this).attr('data-url');
                $.ajax({
                    url: url,
                    data: "fecha1=" + fecha1 + "&fecha2=" + fecha2,
                    type: "POST",
                    success: function (resp) {
                        $('#pqrsAccordion').html(resp);

                    },
                    error: function (xhr, status, error) {
                        console.error("Error en la solicitud AJAX:", error);
                    }
                });
            }

        })
    });
</script>

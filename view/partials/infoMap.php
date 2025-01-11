<div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infoModalLabel">Instrucciones</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
                echo "<h4>¿Cómo realizar una solicitud?</h4>";
                echo "<p>1. Selecciona el icono de ubicación <img src='misc/img/ubicacion.png' width='20px'> que está en el panel derecho.</p>";
                echo "<p>2. Selecciona una zona del mapa.</p>";
                echo "<p>3. Escoge el tipo de solicitud.</p>";
                echo "<p>4. Llena el formulario.</p>";

                echo "<h4>¿Cómo ver la información de una solicitud?</h4>";
                echo "<p>1. Haz clic en el ícono de información <img src='misc/img/accidente.png' width='20px'> que está en el panel derecho.</p>";
                echo "<p>2. Selecciona el punto del mapa sobre el que deseas ver la información.</p>";
                echo "<p>3. También puedes hacerlo haciendo click <a href='".getUrl("Solicitudes", "Solicitudes", "getSolicitudConsult")."'>aquí</a>.</p>";
                ?>
                <h4>¿Como desplazarse en el mapa?</h4>
                <p>1. Selecciona el icono de movimiento <img src="misc/img/alpha_button_pan.png" width="20px" alt=""> que está en el panel derecho</p>
                <p>2. Haz click presionado sobre el mapa y mueve el mouse a libertad</p>
                <h4>¿Como aumentar zoom en el mapa?</h4>
                <p>1. Selecciona el icono de zoom <img src="misc/img/alpha_button_zoomIn.png" width="20px" alt=""> que está en el panel derecho</p>
                <p>2. Haz click sobre el</p>
                <h4>¿Como disminuir zoom en el mapa?</h4>
                <p>1. Selecciona el icono de zoom <img src="misc/img/alpha_button_zoomOut.png" width="20px" alt=""> que está en el panel derecho</p>
                <p>2. Haz click sobre el</p>
                <h4>Icono world <img src="misc/img/alpha_button_fullExtent.png" width="20px"></h4>
                <p>Sirve para volver a la posición inicial del mapa</p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
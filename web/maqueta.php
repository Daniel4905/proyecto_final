<div class="container-scrollMap" style="display: flex;">
    <div class="container-scrollMap mapaa"
        style="overflow:  auto; width: 600px; height: 530px; -moz-user-select: none; position: relative; margin-top: 40px; margin-left: 50px;"
        id="dc_main">

    </div>
    <div style="margin-left: 200px; margin-top: 10px;">

        <div id="layer1" class="container">
            <div style="overflow: auto; width: 150px; height:150px; -moz-user-select: none; position: relative; z-index: 100 margin-top: 30px;"
                id="dc_main2">

            </div>
        </div>
        <div id="layer2" class="container mt-4">
            <form name="select_layers">
                <div class="form-check d-none">
                    <input class="form-check-input" type="checkbox" name="layer[0]" value="Comunas" id="layerComunas"
                        checked onclick="chgLayers()">
                    <label class="form-check-label text-light" for="layerComunas">
                        Comunas
                    </label>
                </div>
                <div class="form-check d-none">
                    <input class="form-check-input" type="checkbox" name="layer[1]" value="Barrios" id="layerBarrios"
                        checked onclick="chgLayers()">
                    <label class="form-check-label text-light" for="layerBarrios">
                        Barrios
                </div>
                <div class="form-check d-none">
                    <input class="form-check-input" type="checkbox" name="layer[2]" value="Vias" id="layerVias" checked
                        onclick="chgLayers()">
                    <label class="form-check-label text-light" for="layerVias">
                        Malla vial
                    </label>
                </div>
                <div class="form-check d-none">
                    <input class="form-check-input" type="checkbox" name="layer[3]" value="Cali" id="layerCali" checked
                        onclick="chgLayers()">
                    <label class="form-check-label text-light" for="layerCali">
                        Cali
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="layer[4]" value="Accidentes"
                        id="layerAccidentes" checked onclick="chgLayers()">
                    <label class="form-check-label text-light" for="layerAccidentes">
                        Accidentes
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="layer[5]" value="Viadano" id="layerViadano"
                        checked onclick="chgLayers()">
                    <label class="form-check-label text-light" for="layerViadano">
                        Daños en la vía
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="layer[6]" value="Senial" id="layerSenNew"
                        checked onclick="chgLayers()">
                    <label class="form-check-label text-light" for="layerSenNew">
                        Nuevas señales
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="layer[7]" value="SenialDan" id="layerSenDan"
                        checked onclick="chgLayers()">
                    <label class="form-check-label text-light" for="layerSenNew">
                        Señales dañadas
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="layer[8]" value="ReductorDan" id="layerRedDan"
                        checked onclick="chgLayers()">
                    <label class="form-check-label text-light" for="layerRedDan">
                        Reductores dañados
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="layer[9]" value="ReductorNew" id="layerRedNew"
                        checked onclick="chgLayers()">
                    <label class="form-check-label text-light" for="layerRedDan">
                        Reductores Nuevos
                    </label>
                </div>
            </form>
        </div>

    </div>
</div>
<script type="text/javascript">
    //<![CDATA[
    myMap1 = new msMap(document.getElementById('dc_main'), 'standardRight');
    myMap1.setCgi('/cgi-bin/mapserv.exe');
    myMap1.setMapFile('/ms4w/Apache/htdocs/proyecto_final/web/Cali.map');
    //myMap1.setFullExtent(-76.62, -76.40, 3.31, 3.90);
    myMap1.setFullExtent(-76.50, -76.48, 3.42, 3.45);
    myMap1.setLayers('Barrios Comunas Vias Cali Accidentes Viadano Senial SenialDan ReductorDan ReductorNew');

    myMap2 = new msMap(document.getElementById('dc_main2'), 'standardRight');
    myMap2.setActionNone();
    //myMap2.setFullExtent(-76.62, -76.40, 3.31, 3.90);
    myMap2.setFullExtent(-76.50, -76.48, 3.42, 3.45);
    myMap2.setMapFile('/ms4w/Apache/htdocs/proyecto_final/web/Cali.map');
    myMap2.setLayers('Barrios Comunas Vias Cali Accidentes Viadano Senial SenialDan ReductorDan ReductorNew');
    myMap1.setReferenceMap(myMap2);

    myMap1.redraw();
    myMap2.redraw();

    chgLayers();

    var botonUbicacion = new msTool('Ubicacion', cursor, 'misc/img/ubicacion.png', ubiCar);
    myMap1.getToolbar(0).addMapTool(botonUbicacion);

    var botonInfo = new msTool('Ver detalles de accidente', cursor2, 'misc/img/accidente.png', verInfo);
    myMap1.getToolbar(0).addMapTool(botonInfo);

    var seleccionado = false;
    var seleccionado2 = false;


    function cursor() {
        myMap1.getTagMap().style.cursor = 'url("misc/img/pasador-de-ubicacion.png"), auto';
        seleccionado = true;
    }
    function cursor2() {
        myMap1.getTagMap().style.cursor = 'pointer';
        seleccionado2 = true;
    }

    function click2map(click_x, click_y) {

        const extent = myMap1.getExtent();
        const coor = extent.split(",");

        const xmin = parseFloat(coor[0]);
        const xmax = parseFloat(coor[1]);
        const ymin = parseFloat(coor[2]);
        const ymax = parseFloat(coor[3]);


        const mapWidth = myMap1.width();
        const mapHeight = myMap1.height();


        const x_pct = click_x / mapWidth;
        const y_pct = click_y / mapHeight;


        const x_map = xmin + (xmax - xmin) * x_pct;
        const y_map = ymax - (ymax - ymin) * y_pct;

        return [x_map, y_map];
    }

    var mapa = myMap1.getTagMap();

    function objectAjax() {
        var xmlhttp = false;

        try {
            xmlhttp = new ActiveXObject("Msxm2.XMLHttpRequest");
        } catch (e) {
            try {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (E) {
                xmlhttp = false;

            }
        }
        if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
            xmlhttp = new XMLHttpRequest();
            return xmlhttp;
        }

    }

    function ubiCar() {
        var x = myMap1.getClick_X(event);
        var y = myMap1.getClick_Y(event);

        if (seleccionado) {
            let coordenadas = click2map(x, y);
            c1 = coordenadas[0];
            c2 = coordenadas[1];

            consultar1 = new objectAjax();
            consultar1.open("GET", `ajax.php?modulo=Solicitudes&controlador=Solicitudes&funcion=getSolicitud`, true);

            consultar1.onreadystatechange = function () {
                if (consultar1.readyState === 4) {
                    document.getElementById('modal-container').innerHTML = consultar1.responseText;

                    let modal = new bootstrap.Modal(document.getElementById('modalSolicitud'));
                    modal.show();

                    let punto1 = document.getElementById("punto1");
                    let punto2 = document.getElementById("punto2");

                    if (punto1) {
                        punto1.value = c1;
                    } else {
                        console.error("No existe");
                    }
                    if (punto2) {
                        punto2.value = c2;
                    } else {
                        console.error("No existe2");
                    }

                }
            };
            consultar1.send(null);
            seleccionado = false;
            myMap1.getTagMap().style.cursor = "default";
        }
    }
    function verInfo() {
        var x = myMap1.getClick_X(event);
        var y = myMap1.getClick_Y(event);

        if (seleccionado2) {
            let coordenadas = click2map(x, y);
            c1 = coordenadas[0];
            c2 = coordenadas[1];

            consultar1 = new objectAjax();
            consultar1.open("GET", "ajax.php?modulo=Solicitudes&controlador=Solicitudes&funcion=getInfo&x=" + c1 + "&y=" + c2, true);

            consultar1.onreadystatechange = function () {
                if (consultar1.readyState === 4) {
                    document.getElementById('modal-detalles').innerHTML = consultar1.responseText;

                    let modal = new bootstrap.Modal(document.getElementById('detallesModal'));
                    modal.show();
                }
            };
            consultar1.send(null);
            // seleccionado2 = false;
            // myMap1.getTagMap().style.cursor = "default";
        }
    }

    var selecLayer = -1;
    var lyactive = false;
    var lejendactive = false;

    function chgLayers() {
        var list = "Layers ";
        var objForm = document.forms[0];
        for (i = 0; i < document.forms[0].length; i++) {
            if (objForm.elements["layer[" + i + "]"].checked) {
                list = list + objForm.elements["layer[" + i + "]"].value + " ";
            }
        }
        myMap1.setLayers(list);
        myMap1.redraw();
    }



    //]]>
</script>
<div id="modal-container"></div>
<div id="modal-detalles"></div>
<div class="container-scrollMap" style="display: flex;">
    <div class="container-scrollMap mapaa"
        style="overflow: hidden; width: 600px; height: 600px; -moz-user-select: none; position: relative; margin-top: 40px; margin-left: 50px;"
        id="dc_main">

    </div>
    <div style="margin-left: 200px; margin-top: 50px;">

        <div id="layer1" class="container">
            <div style="overflow: auto; width: 150px; height:150px; -moz-user-select: none; position: relative; z-index: 100 margin-top: 30px;"
                id="dc_main2">

            </div>
        </div>
        <div id="layer2" class="container mt-4">
            <form name="select_layers">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="layer[0]" value="Comunas" id="layerComunas"
                        checked onclick="chgLayers()">
                    <label class="form-check-label text-light" for="layerComunas">
                     Comunas
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="layer[1]" value="Barrios" id="layerBarrios"
                        checked onclick="chgLayers()">
                    <label class="form-check-label text-light" for="layerBarrios">
                        Barrios
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="layer[2]" value="Vias" id="layerVias" checked
                        onclick="chgLayers()">
                    <label class="form-check-label text-light" for="layerVias">
                       Malla vial
                    </label>
                </div>
                <div class="form-check">
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
    myMap1.setLayers('Barrios Comunas Vias Cali Accidentes Viadano');

    myMap2 = new msMap(document.getElementById('dc_main2'), 'standardRight');
    myMap2.setActionNone();
    //myMap2.setFullExtent(-76.62, -76.40, 3.31, 3.90);
    myMap2.setFullExtent(-76.50, -76.48, 3.42, 3.45);
    myMap2.setMapFile('/ms4w/Apache/htdocs/proyecto_final/web/Cali.map');
    myMap2.setLayers('Barrios Comunas Vias Cali Accidentes Viadano');
    myMap1.setReferenceMap(myMap2);

    myMap1.redraw();
    myMap2.redraw();

    chgLayers();

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
<?php
include_once '../model/Solicitudes/SolicitudesModel.php';


$obj = new SolicitudesModel();
// $sqlT = "SELECT * FROM tipo_choque";
// $tipoAc = $obj->consult($sqlT);
include_once '../view/Solicitudes/solicitudes.php';

?>
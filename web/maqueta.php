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
        <div id="layer2">
            <form action="" name="select_layers">
                <p align="left">
                    <input CHECKED onclick="chgLayers()" type="checkbox" name="layer[0]" value="Comunas">
                    <strong>Comunas</strong>
                </p>
                <p align="left">
                    <input CHECKED onclick="chgLayers()" type="checkbox" name="layer[1]" value="Barrios">
                    <strong>Barrios</strong>
                </p>
                <p align="left">
                    <input CHECKED onclick="chgLayers()" type="checkbox" name="layer[2]" value="Vias">
                    <strong>Malla vial</strong>
                </p>
                <p align="left">
                    <input CHECKED onclick="chgLayers()" type="checkbox" name="layer[3]" value="Cali">
                    <strong>Cali</strong>
                </p>
                <p align="left">
                    <input CHECKED onclick="chgLayers()" type="checkbox" name="layer[4]" value="Accidentes">
                    <strong>Accidentes</strong>
                </p>
                <p align="left">
                    <input CHECKED onclick="chgLayers()" type="checkbox" name="layer[5]" value="Viadano">
                    <strong>Daños en la via</strong>
                </p>

            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    //<![CDATA[
    myMap1 = new msMap(document.getElementById('dc_main'),'standardRight');
    myMap1.setCgi('/cgi-bin/mapserv.exe');
    myMap1.setMapFile('/ms4w/Apache/htdocs/proyecto_final/web/Cali.map');
    //myMap1.setFullExtent(-76.62, -76.40, 3.31, 3.90);
    myMap1.setFullExtent(-76.50, -76.48, 3.42, 3.45);
    myMap1.setLayers('Barrios Comunas Vias Cali Accidentes Viadano');

    myMap2 = new msMap(document.getElementById('dc_main2'),'standardRight');
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

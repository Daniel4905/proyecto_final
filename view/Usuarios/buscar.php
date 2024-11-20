<?php
foreach ($usuario as $usu) {
    $clase = "";
    $text = "";
    $disabled = "";
    echo "<tr>";
    echo "<td>" . $usu['usu_id'] . "</td>";
    echo "<td>" . $usu['usu_documento'] . "</td>";
    echo "<td>" . $usu['usu_nombre1'] . " " . $usu['usu_nombre2'] . "</td>";
    echo "<td>" . $usu['usu_apellido1'] . " " . $usu['usu_apellido2'] . "</td>";
    echo "<td>" . $usu['usu_correo'] . "</td>";
    echo "<td>" . $usu['usu_tel'] . "</td>";
    echo "<td>" . $usu['rol_nombre'] . "</td>";

    if ($_SESSION['id'] == $usu['usu_id'] || stristr($usu['rol_nombre'], "Admin")) {
        $disabled = "disabled";
    } else {
        $disabled = "";
    }

    //if(stristr($usu['rol_nombre'], "Admin")){
    //  $disabled = "disabled";
    //}
    if ($usu['est_id'] == 1) {
        $class = "btn btn-danger";
        $text = "Inhabilitar";


        //$estado = 2; 

    } else if ($usu['est_id'] == 2) {
        $class = "btn btn-success";
        $text = "Habilitar";


        //$estado = 1;  
    }


    // echo "<td><a href='".getUrl("Usuarios", "Usuarios", "desHabilitar", array("usu_id"=>$usu['usu_id'], "est_id"=>$estado))."'>";
    echo "<td>";
    if (!empty($class))
        echo "<button class='" . $class . "' id='cambiar_estado' data-url='" . getUrl("Usuarios", "Usuarios", "postUpdateStatus", false, "ajax") . "' data-id = '" . $usu['est_id'] . "' data-user='" . $usu['usu_id'] . "' $disabled>" . $text . "</button>" .
            "</td>";
    echo "<td>" .
        "<a href='" . getUrl("Usuarios", "Usuarios", "getUpdate", array("usu_id" => $usu['usu_id'])) . "'>" .
        "<button class='btn btn-primary'>Editar" .
        "</button>" .
        "</a>";
    echo "</td>";
    echo "</tr>";

}
?>
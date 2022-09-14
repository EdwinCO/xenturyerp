<?php
require_once ('includes/sql.php');
$depto=$_POST['depto'];

$munis=join_munid_table($depto);
$cadena="<select class='form-control form-control-user' id='estado' name='estado' required>";

foreach ($munis as $mun):
    $cadena=$cadena.'<option value='.$mun["str_nombre"].'>'.$mun["str_nombre"].'</option>';
endforeach;
echo  $cadena."</select>";
?>

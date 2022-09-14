<?php
require_once ('includes/sql.php');
$depto=$_POST['depto'];

$munis=join_munid_table($depto);
$cadena="<select class='form-control form-control-user' id='estado' name='estado' required>";

foreach ($munis as $mun):
$var = $mun["str_nombre"];
$cadena=$cadena."<option value=''</option>";
//$cadena=$cadena.'<option value='.$ver[0].'>'.utf8_encode($ver[2]).'</option>';
endforeach;
echo  $cadena."</select>";

?>

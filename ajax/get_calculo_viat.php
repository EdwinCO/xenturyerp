<?php
require_once ('includes/sql.php');
$fecini=new DateTime($_POST['fechaini']);
$fecfin=new DateTime($_POST['fechafin']);

$base_viat=find_viat();
$fecha1= new DateTime("2017-08-01");
$fecha2= new DateTime("2017-08-04");
$diff = $fecini->diff($fecfin);
$dias = $diff->days;

$cadena="<select class='form-control form-control-user' id='estado' name='estado' required>";

foreach ($munis as $mun):
$var = $mun["str_nombre"];
$cadena=$cadena."<option value=''</option>";
//$cadena=$cadena.'<option value='.$ver[0].'>'.utf8_encode($ver[2]).'</option>';
endforeach;
echo  $cadena."</select>";

?>

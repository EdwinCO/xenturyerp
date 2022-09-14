<?php
	require_once('includes/load.php');
	page_require_level(2);
?>
<?php
	$product=find_by_id('ot',(int)$_GET['id']);
	if(!$product){
		$session->msg("d"," ID vacío");
		redirect('ot.php');
	}
?>
<?php
	$delete_id=delete_by_id('proyecto',(int)$product['id']);
	if($delete_id){
		$session->msg("s"," Orden de trabajo eliminada.");
		redirect('ot.php');
	}else{
		$session->msg("d","La eliminación de la orden de trabajo falló.");
		redirect('ot.php');
	}
?>
<?php
	require_once('includes/load.php');
	page_require_level(2);
?>
<?php
	$product=find_by_id('proyecto',(int)$_GET['id']);
	if(!$product){
		$session->msg("d"," ID vacío");
		redirect('proyecto.php');
	}
?>
<?php
	$delete_id=delete_by_id('proyecto',(int)$product['id']);
	if($delete_id){
		$session->msg("s"," Proyecto eliminado.");
		redirect('proyecto.php');
	}else{
		$session->msg("d","La eliminación del proyecto falló.");
		redirect('proyecto.php');
	}
?>
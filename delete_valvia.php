<?php
	require_once('includes/load.php');
	page_require_level(2);
?>
<?php
	$product=find_by_id('val_viaticos',(int)$_GET['id']);
	if(!$product){
		$session->msg("d"," ID vacío");
		redirect('val_viaticos.php');
	}
?>
<?php
	$delete_id=delete_by_id('val_viaticos',(int)$product['id']);
	if($delete_id){
		$session->msg("s"," Base de viáticos eliminado.");
		redirect('val_viaticos.php');
	}else{
		$session->msg("d","La eliminación de la base de viáticos falló.");
		redirect('val_viaticos.php');
	}
?>
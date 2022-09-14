<?php
	$page_title='Editar valores viáticos';
	require_once('includes/load.php');
	page_require_level(2);
	$dates=max_date('val_viaticos','dat_fecfin');
	
	foreach($dates as $date){
	    $max_date = date('Y-m-d', strtotime($date['fecha']."+ 1 days"));
	}
?>
<?php
	$val_viaticos=find_by_id('val_viaticos',(int)$_GET['id']);
	
	if(!$val_viaticos){
		$session->msg("d"," ID de valores de viáticos perdido.");
		redirect('val_viaticos.php');
	}
?>
<?php
	if(isset($_POST['valviat'])){
	    $req_fields=array('alimen','alipar','hotel','lavand','fechafin');
		validate_fields($req_fields);
		if(empty($errors)){
		    $v_alimen=remove_junk($db->escape($_POST['alimen']));
		    $v_alipar=remove_junk($db->escape($_POST['alipar']));
		    $v_hotel=remove_junk($db->escape($_POST['hotel']));
		    $v_lavand=remove_junk($db->escape($_POST['lavand']));
		    $v_ffin=remove_junk($db->escape($_POST['fechafin']));
		    
			$query ="UPDATE val_viaticos SET";
			$query.=" val_alimen='{$v_alimen}',val_alimpar='{$v_alipar}',";
			$query.=" val_hotel='{$v_hotel}',val_lavand='{$v_lavand}',dat_fecfin='{$v_ffin}'";
			$query.=" WHERE id='{$val_viaticos['id']}'"; 
			$result=$db->query($query);
			if($result&&$db->affected_rows()===1){
				$session->msg('s',"Base de viáticos ha sido actualizado.");
				redirect('val_viaticos.php',false);
			}else{
				$session->msg('d','Actualización de base de viáticos fallida.');
				redirect('edit_valvia.php?id='.$val_viaticos['id'],false);
            }
		}else{
			$session->msg("d",$errors);
			redirect('edit_valvia.php?id='.$val_viaticos['id'],false);
		}
	}
	if(isset($_POST['back'])){
		header("Location: val_viaticos.php");
	}
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
	<div class="col-md-9">
		<?php echo display_msg($msg); ?>
	</div>
</div>
<center><img src="libs/images/logo.png" alt="logo"></center><br>
<div class="row" style="margin-left:20%;">
    <div class="panel panel-default">
		<div class="panel-heading">
			<strong>
				<span class="glyphicon glyphicon-th"></span>
				<span>Editar valor base de viáticos</span>
			</strong>
        </div>
        <div class="panel-body">
				<div class="col-md-12">
					<form method="post" action="edit_valvia.php?id=<?php echo (int)$val_viaticos['id'] ?>">
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-usd"></i><label for="qty"> Alimentación</label>
									</span>
									<input type="number" step="0,01" class="form-control" name="alimen" placeholder="Alimentación" value="<?php echo remove_junk($val_viaticos['val_alimen']); ?>">
								</div>
								<div class="col-md-4">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-usd"></i><label for="qty"> Alimentación parcial</label>
									</span>
									<input type="number" step="0,01" class="form-control" name="alipar" placeholder="Alimentación parcial" value="<?php echo remove_junk($val_viaticos['val_alimpar']); ?>">
								</div>
								<div class="col-md-4">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-usd"></i><label for="qty"> Hotel</label>
									</span>
									<input type="number" step="0,01" class="form-control" name="hotel" placeholder="Hotel" value="<?php echo remove_junk($val_viaticos['val_hotel']); ?>">
								</div>
								
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-usd"></i><label for="qty"> Lavandería</label>
									</span>
									<input type="number" step="0,01" class="form-control" name="lavand" placeholder="Lavandería" value="<?php echo remove_junk($val_viaticos['val_lavand']); ?>">
								</div>
								<div class="col-md-4"><label for="qty">Fecha final vigencia</label>
									<div class="input-group">
										<span class="input-group-addon">
										<i class="glyphicon glyphicon-calendar"></i>
										</span>
										<input type="text" class="form-control" min="<?php echo trim($max_date); ?>" name="fechafin" value="<?php echo remove_junk($val_viaticos['dat_fecfin']); ?>" placeholder="Fecha final vigencia" onkeydown="return false" onfocus="(this.type='date')" onblur="(this.type='text')">
									</div>
								</div>								
							</div>
						</div>
						
						<button type="submit" name="valviat" class="btn btn-danger" style="margin-left:200px">Actualizar</button>
						<button type="submit" name="back" class="btn btn-primary" style="margin-left:200px">Volver atras</button>
					</form>
				</div>
			</div>
    </div>
</div>
<?php include_once('layouts/footer.php'); ?>
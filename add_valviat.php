<?php
	$page_title='Agregar valores viáticos';
	require_once('includes/load.php');
	page_require_level(2);
	$dates=max_date('val_viaticos','dat_fecfin');
	
	foreach($dates as $date){
	    $max_date = date('Y-m-d', strtotime($date['fecha']."+ 1 days"));  
	}
	
?>
<?php
	if(isset($_POST['add_valviat'])){
	    $req_fields=array('alimen','alipar','hotel','lavand','fechafin');
		validate_fields($req_fields);
		if(empty($errors)){
			$v_alimen=remove_junk($db->escape($_POST['alimen']));
			$v_alipar=remove_junk($db->escape($_POST['alipar']));
			$v_hotel=remove_junk($db->escape($_POST['hotel']));
			$v_lavand=remove_junk($db->escape($_POST['lavand']));
			$v_ffin=remove_junk($db->escape($_POST['fechafin']));
			
			
			$date=make_date();
			$query="INSERT INTO val_viaticos (";
			$query.=" val_alimen, val_alimpar, val_hotel, val_lavand, dat_fecfin";
			$query.=") VALUES (";
			$query.=" '{$v_alimen}','{$v_alipar}','{$v_hotel}','{$v_lavand}','{$v_ffin}'";
			$query.=")";
			$query.=" ON DUPLICATE KEY UPDATE val_alimen='{$v_alimen}'"; 
			if($db->query($query)){
				$session->msg('s',"Base viáticos agregado.");
				redirect('val_viaticos.php',false);
			}else{
				$session->msg('d','Valores viáticos no agregados.');
				redirect('val_viaticos.php',false);
			}
		} else{
			$session->msg("d ",$errors);
			redirect('add_valviat.php',false);
		}
	}
	if(isset($_POST['back'])){
		header("Location: val_viaticos.php");
	}
?>
<?php include_once('layouts/header.php'); ?>
<center><img src="libs/images/logo.png" alt="logo"></center><br>
<div class="row">
	<div class="col-md-12">
		<?php echo display_msg($msg); ?>
	</div>
</div>
<div class="row" style="margin-left:20%;">
	<div class="col-md-9">
		<div class="panel panel-default">
			<div class="panel-heading">
				<strong>
					<span class="glyphicon glyphicon-th"></span>
					<span>Agregar valores base viáticos</span>
				</strong>
			</div>
			<div class="panel-body">
				<div class="col-md-12">
					<form method="post" action="add_valviat.php" class="clearfix">
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-usd"></i>
									</span>
									<input type="number" step="0,01" class="form-control" name="alimen" placeholder="Alimentación">
								</div>
								<div class="col-md-4">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-usd"></i>
									</span>
									<input type="number" step="0,01" class="form-control" name="alipar" placeholder="Alimentación parcial">
								</div>
								<div class="col-md-4">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-usd"></i>
									</span>
									<input type="number" step="0,01" class="form-control" name="hotel" placeholder="Hotel">
								</div>
								
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-usd"></i>
									</span>
									<input type="number" step="0,01" class="form-control" name="lavand" placeholder="Lavandería">
								</div>
								<div class="col-md-4">
									<div class="input-group">
										<span class="input-group-addon">
										<i class="glyphicon glyphicon-calendar"></i>
										</span>
										<input type="text" class="form-control" min="<?php echo trim($max_date); ?>" name="fechafin" placeholder="Fecha final vigencia" onkeydown="return false" onfocus="(this.type='date')" onblur="(this.type='text')">
									</div>
								</div>								
							</div>
						</div>
						
						<button type="submit" name="add_valviat" class="btn btn-danger" style="margin-left:200px">Agregar valores base</button>
						<button type="submit" name="back" class="btn btn-primary" style="margin-left:200px">Volver atras</button>
					</form>
				</div>
			</div>
		</div>
    </div>
</div>
<?php include_once('layouts/footer.php'); ?>
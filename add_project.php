<?php
	$page_title='Agregar proyecto';
	require_once('includes/load.php');
	page_require_level(2);
	$all_clients=find_all('clients');
	$all_photo=find_all('media');
?>
<?php
	if(isset($_POST['add_project'])){
		$req_fields=array('nombre','cliente','fechaini','fechafin', 'objeto');
		validate_fields($req_fields);
		if(empty($errors)){
			$p_name=remove_junk($db->escape($_POST['nombre']));
			$p_cli=remove_junk($db->escape($_POST['cliente']));
			$p_fini=remove_junk($db->escape($_POST['fechaini']));
			$p_ffin=remove_junk($db->escape($_POST['fechafin']));
			$p_objeto=remove_junk($db->escape($_POST['objeto']));
			
			$date=make_date();
			$query="INSERT INTO proyecto (";
			$query.=" str_nombre,id_cliente,dat_fecini,dat_fecfin, str_objeto";
			$query.=") VALUES (";
			$query.=" '{$p_name}','{$p_cli}','{$p_fini}','{$p_ffin}','{$p_objeto}'";
			$query.=")";
			$query.=" ON DUPLICATE KEY UPDATE str_nombre='{$p_name}'"; 
			if($db->query($query)){
				$session->msg('s',"Proyecto agregado.");
				redirect('add_project.php',false);
			}else{
				$session->msg('d','Proyecto no agregado.');
				redirect('proyecto.php',false);
			}
		} else{
			$session->msg("d",$errors);
			redirect('add_project.php',false);
		}
	}
	if(isset($_POST['back'])){
		header("Location: proyecto.php");
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
					<span>Agregar proyecto</span>
				</strong>
			</div>
			<div class="panel-body">
				<div class="col-md-12">
					<form method="post" action="add_project.php" class="clearfix">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-th-large"></i>
								</span>
								<input type="text" class="form-control" name="nombre" placeholder="Proyecto">
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<select class="form-control" name="cliente">
										<option value="">Selecciona un cliente</option>
										<?php foreach ($all_clients as $cli): ?>
										<option value="<?php echo (int)$cli['id'] ?>">
										<?php echo $cli['nombre'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="col-md-4">
									<div class="input-group">
										<span class="input-group-addon">
										<i class="glyphicon glyphicon-calendar"></i>
										</span>
										<input type="text" class="form-control" name="fechaini" placeholder="Fecha Inicio" onfocus="(this.type='date')" onblur="(this.type='text')">
									</div>
								</div>
								<div class="col-md-4">
									<div class="input-group">
										<span class="input-group-addon">
										<i class="glyphicon glyphicon-calendar"></i>
										</span>
										<input type="text" class="form-control" name="fechafin" placeholder="Fecha Fin" onfocus="(this.type='date')" onblur="(this.type='text')">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-th-large"></i>
										</span>
										<textarea maxlength="1000" id="w3review" class="form-control" name="objeto" rows="3" placeholder="Objeto"></textarea>
										
									</div>
								</div>
						
						<button type="submit" name="add_project" class="btn btn-danger" style="margin-left:200px">Agregar proyecto</button>
						<button type="submit" name="back" class="btn btn-primary" style="margin-left:200px">Volver atras</button>
					</form>
				</div>
			</div>
		</div>
    </div>
</div>
<?php include_once('layouts/footer.php'); ?>
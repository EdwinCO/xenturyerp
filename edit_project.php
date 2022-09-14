<?php
	$page_title='Editar producto';
	require_once('includes/load.php');
	page_require_level(2);
?>
<?php
	$project=find_by_id('proyecto',(int)$_GET['id']);
	$all_clients=find_all('clients');
	
	if(!$project){
		$session->msg("d"," ID de proyecto perdido.");
		redirect('proyecto.php');
	}
?>
<?php
	if(isset($_POST['project'])){
	    $req_fields=array('nombre','cliente','fechaini','fechafin','objeto');
		validate_fields($req_fields);
		if(empty($errors)){
		    $p_name=remove_junk($db->escape($_POST['nombre']));
		    $p_cli=remove_junk($db->escape($_POST['cliente']));
		    $p_fini=remove_junk($db->escape($_POST['fechaini']));
		    $p_ffin=remove_junk($db->escape($_POST['fechafin']));
		    $p_objeto=remove_junk($db->escape($_POST['objeto']));
		    
			$query ="UPDATE proyecto SET";
			$query.=" str_nombre='{$p_name}',id_cliente='{$p_cli}',";
			$query.=" dat_fecini='{$p_fini}',dat_fecfin='{$p_ffin}',str_objeto='{$p_objeto}'";
			$query.=" WHERE id='{$project['id']}'";
			$result=$db->query($query);
			if($result&&$db->affected_rows()===1){
				$session->msg('s',"El proyecto ha sido actualizado.");
				redirect('proyecto.php',false);
			}else{
				$session->msg('d','Actualización fallida.');
				redirect('edit_project.php?id='.$project['id'],false);
            }
		}else{
			$session->msg("d",$errors);
			redirect('edit_project.php?id='.$project['id'],false);
		}
	}
	if(isset($_POST['back'])){
		header("Location: proyecto.php");
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
				<span>Editar proyecto</span>
			</strong>
        </div>
        <div class="panel-body">
				<div class="col-md-12">
					<form method="post" action="edit_project.php?id=<?php echo (int)$project['id'] ?>">
						<div class="form-group"><label for="qty">Nombre proyecto</label>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-th-large"></i>
								</span>
								<input type="text" class="form-control" name="nombre" placeholder="Proyecto" value="<?php echo remove_junk($project['str_nombre']); ?>">
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4"><label for="qty">Cliente</label>
									<select class="form-control" name="cliente">
										<option value=""disabled>Selecciona un cliente</option>
										<?php foreach ($all_clients as $cli): ?>										
										<option value="<?php echo (int)$cli['id']; ?>" <?php if($project['id_cliente']===$cli['id']): echo "selected"; endif; ?>>
										<?php echo remove_junk($cli['nombre']); ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="col-md-4"><label for="qty">Fecha inicial</label>
									<div class="input-group">
										<span class="input-group-addon">
										<i class="glyphicon glyphicon-calendar"></i>
										</span>
										<input type="date" class="form-control" name="fechaini" data-date-format="" value="<?php echo remove_junk($project['dat_fecini']); ?>" onfocus="(this.type='date')" onblur="(this.type='text')">
									</div>
								</div>
								<div class="col-md-4"><label for="qty">Fecha final</label>
									<div class="input-group">
										<span class="input-group-addon">
										<i class="glyphicon glyphicon-calendar"></i>
										</span>
										<input type="date" class="form-control" name="fechafin" data-date-format="" value="<?php echo remove_junk($project['dat_fecfin']); ?>" onfocus="(this.type='date')" onblur="(this.type='text')">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group"><label for="qty">Objeto</label>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="glyphicon glyphicon-th-large"></i>
								</span>
								<textarea maxlength="1000" id="w3review" class="form-control" name="objeto" rows="3" placeholder="Objeto"><?php echo remove_junk($project['str_objeto']); ?></textarea>
							</div>
						</div>
						
						<button type="submit" name="project" class="btn btn-danger" style="margin-left:200px">Actualizar</button>
					<button type="submit" name="back" class="btn btn-primary" style="margin-left:200px">Volver atras</button>
					</form>
				</div>
			</div>
    </div>
</div>
<?php include_once('layouts/footer.php'); ?>
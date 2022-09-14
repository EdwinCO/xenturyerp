<?php
	$page_title='Lista de proyectos';
	require_once('includes/load.php');
	page_require_level(2);
	$projects=join_project_table();
?>
<?php include_once('layouts/header.php'); ?>
	<div class="row">
		<div class="col-md-12">
			<?php echo display_msg($msg); ?>
		</div>
		<center><img src="libs/images/logo.png" alt="logo"></center><br>
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading clearfix">
					<div class="pull-right">
						<a href="add_project.php" class="btn btn-primary">Agregar proyecto</a>
					</div>
				</div>
				<div class="panel-body">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th class="text-center" style="width: 10px;">Id</th>
								<th class="text-center" style="width: 20%;">Nombre</th>
								<th class="text-center" style="width: 20%;">Cliente</th>
								<th class="text-center" style="width: 10%;">Fecha inicio</th>
								<th class="text-center" style="width: 10%;">Fecha fin</th>
								<th class="text-center" style="width: 30%;">Objeto</th>
								<th class="text-center" style="width: 10px;">Acciones</th>
							</tr>
						</thead>
					<tbody>
						<?php foreach ($projects as $project):?>
						<tr>
							<td class="text-center"><?php echo $project['id']; ?></td>
							<td class="text-center"> <?php echo remove_junk($project['str_nombre']); ?></td>
							<td class="text-center"><?php echo remove_junk($project['id_cliente'])."-".remove_junk($project['nombre']); ?></td>
							<td class="text-center"><?php echo remove_junk($project['dat_fecini']); ?></td>
							<td class="text-center"><?php echo remove_junk($project['dat_fecfin']); ?></td>
							<td class="text-center"><?php echo remove_junk($project['str_objeto']); ?></td>
							<td class="text-center">
								<div class="btn-group">
									<a href="edit_project.php?id=<?php echo (int)$project['id']; ?>" style="margin-right:5px;" class="btn btn-info btn-xs" title="Editar" data-toggle="tooltip">
										<span class="glyphicon glyphicon-edit"></span>
									</a>
									<a onclick="javascript:return confirm('¿Confirmar Eliminación?');" href="delete_project.php?id=<?php echo (int)$project['id']; ?>" style="margin-left:5px;" class="btn btn-danger btn-xs" title="Eliminar" data-toggle="tooltip">
										<span class="glyphicon glyphicon-trash"></span>
									</a>
								</div>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
    </div>
</div>
<?php include_once('layouts/footer.php'); ?>
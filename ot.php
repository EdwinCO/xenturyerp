<?php
	$page_title='Lista de órdenes de trabajo';
	require_once('includes/load.php');
	page_require_level(2);
	$ots=join_ot_table();
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
						<a href="add_ot.php" class="btn btn-primary">Agregar orden de trabajo</a>
					</div>
				</div>
				<div class="panel-body">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th class="text-center" style="width: 10px;">OT</th>
								<th class="text-center" style="width: 20%;">Técnico</th>
								<th class="text-center" style="width: 10%;">Origen</th>
								<th class="text-center" style="width: 10%;">Destino</th>
								<th class="text-center" style="width: 10%;">Fecha inicio</th>
								<th class="text-center" style="width: 10%;">Fecha fin</th>
								<th class="text-center" style="width: 10%;">Viáticos</th>
								<th class="text-center" style="width: 10px;">Acciones</th>
							</tr>
						</thead>
					<tbody>
						<?php foreach ($ots as $ot):?>
						<tr>
							<td class="text-center"><?php echo $ot['id'].$ot['dia'].$ot['mes'].$ot['ano']; ?></td>
							<td class="text-center"> <?php echo remove_junk($ot['nombre']." ".$ot['apellidos']); ?></td>
							<td class="text-center"><?php echo remove_junk($ot['str_origen']); ?></td>
							<td class="text-center"><?php echo remove_junk($ot['str_destino']); ?></td>
							<td class="text-center"><?php echo remove_junk($ot['dat_fecini']); ?></td>
							<td class="text-center"><?php echo remove_junk($ot['dat_fecfin']); ?></td>
							<td class="text-center"><?php echo remove_junk($ot['enu_viaticos']); ?></td>
							<td class="text-center">
								<div class="btn-group">
									<a href="edit_ot.php?id=<?php echo (int)$ot['id']; ?>" style="margin-right:5px;" class="btn btn-info btn-xs" title="Editar" data-toggle="tooltip">
										<span class="glyphicon glyphicon-edit"></span>
									</a>
									<a onclick="javascript:return confirm('¿Confirmar Eliminación?');" href="delete_ot.php?id=<?php echo (int)$ot['id']; ?>" style="margin-left:5px;" class="btn btn-danger btn-xs" title="Eliminar" data-toggle="tooltip">
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
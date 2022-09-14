<?php
	$page_title='Valores de viáticos';
	require_once('includes/load.php');
	page_require_level(2);
	$valviats=join_valviat_table();
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
						<a href="add_valviat.php" class="btn btn-primary">Agregar valores base</a>
					</div>
				</div>
				<div class="panel-body">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th class="text-center" style="width: 5px;">Id</th>
								<th class="text-center" style="width: 10%;">Alimentación</th>
								<th class="text-center" style="width: 10%;">Alim. parcial</th>
								<th class="text-center" style="width: 10%;">Hotel</th>
								<th class="text-center" style="width: 10%;">Lavandería</th>
								<th class="text-center" style="width: 20%;">Vig. Hasta</th>
								<th class="text-center" style="width: 20px;">Acciones</th>
							</tr>
						</thead>
					<tbody>
						<?php foreach ($valviats as $valviat):?>
						<tr>
							<td class="text-center"><?php echo $valviat['id']; ?></td>
							<td class="text-center"><?php echo remove_junk(number_format($valviat['val_alimen'],2)); ?></td>
							<td class="text-center"><?php echo remove_junk(number_format($valviat['val_alimpar'],2)); ?></td>
							<td class="text-center"><?php echo remove_junk(number_format($valviat['val_hotel'],2)); ?></td>
							<td class="text-center"><?php echo remove_junk(number_format($valviat['val_lavand'],2)); ?></td>
							<td class="text-center"><?php echo remove_junk($valviat['dat_fecfin']); ?></td>
							<td class="text-center">
								<div class="btn-group">
									<a href="edit_valvia.php?id=<?php echo (int)$valviat['id']; ?>" style="margin-right:5px;" class="btn btn-info btn-xs" title="Editar" data-toggle="tooltip">
										<span class="glyphicon glyphicon-edit"></span>
									</a>
									<a onclick="javascript:return confirm('¿Confirmar Eliminación?');" href="delete_valvia.php?id=<?php echo (int)$valviat['id']; ?>" style="margin-left:5px;" class="btn btn-danger btn-xs" title="Eliminar" data-toggle="tooltip">
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
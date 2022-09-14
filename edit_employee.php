<?php
	$page_title='Editar empleado';
	require_once('includes/load.php');
	page_require_level(2);
?>
<?php
	$employee=find_by_id('employees',(int)$_GET['id']);
	$all_photo=find_all("media", "file_destino = 'employees'");
	if(!$employee){
		$session->msg("d","ID de empleado perdido.");
		redirect('employees.php');
		
	}
?>
<?php
	if(isset($_POST['employee'])){
	    $req_fields=array('nombre', 'apellidos', 'numper', 'numcor', 'tipdocumento', 'documento', 'eps',
	        'pensio', 'foto', 'lugar_nacimiento', 'fecha_nacimiento', 'domicilio',
	        'ciudad', 'region', 'nivest', 'titulacion', 'cargo', 'tarpro', 'tarcon', 'ceralt',
	        'cercoo', 'carnet_conducir', 'salari', 'tipcon', 'cueban', 'banco', 'nomcon',
	        'telcon', 'inicio_contrato', 'emaper', 'emacor');
		validate_fields($req_fields);
		if(empty($errors)){
			if(is_null($_POST['foto'])||$_POST['foto']===""){
				$foto='0';
			}else{
				$foto=$db->escape($_POST['foto']);
			}
			$nombre=$db->escape($_POST['nombre']);
			$apellidos=$db->escape($_POST['apellidos']);
			$numper=$db->escape($_POST['numper']);
			$numcor=$db->escape($_POST['numcor']);
			$tipdocumento=$db->escape($_POST['tipdocumento']);
			$documento=$db->escape($_POST['documento']);
			$eps=$db->escape($_POST['eps']);
			$pensio=$db->escape($_POST['pensio']);
			$lugar_nac=$db->escape($_POST['lugar_nacimiento']);
			$fecha_nac=$db->escape($_POST['fecha_nacimiento']);
			$domicilio=$db->escape($_POST['domicilio']);
			$ciudad=$db->escape($_POST['ciudad']);
			$region=$db->escape($_POST['region']);
			$nivest=$db->escape($_POST['nivest']);
			$titulo=$db->escape($_POST['titulacion']);
			$puesto=$db->escape($_POST['cargo']);
			$tarpro=$db->escape($_POST['tarpro']);
			$tarcon=$db->escape($_POST['tarcon']);
			$ceralt=$db->escape($_POST['ceralt']);
			$cercoo=$db->escape($_POST['cercoo']);
			$carnet=$db->escape($_POST['carnet_conducir']);
			$salari=$db->escape($_POST['salari']);
			$tipcon=$db->escape($_POST['tipcon']);
			$cueban=$db->escape($_POST['cueban']);
			$banco=$db->escape($_POST['banco']);
			$nomcon=$db->escape($_POST['nomcon']);
			$telcon=$db->escape($_POST['telcon']);
			$ini_con=$db->escape($_POST['inicio_contrato']);
			$fin_con=$db->escape($_POST['fin_contrato']);
			$emaper=$db->escape($_POST['emaper']);
			$emacor=$db->escape($_POST['emacor']);
			
			$date=make_date();
			$query ="UPDATE employees SET ";
			$query.="foto='{$foto}',nombre='{$nombre}',apellidos='{$apellidos}',str_telper='{$numper}',str_telcor='{$numcor}',str_tipdoc='{$tipdocumento}',
                    documento='{$documento}',lugar_nacimiento='{$lugar_nac}',fecha_nacimiento='{$fecha_nac}',domicilio='{$domicilio}',ciudad='{$ciudad}',
                    region='{$region}',carnet_conducir='{$carnet}',titulacion='{$titulo}',str_nivest='{$nivest}',puesto='{$puesto}',str_tarpro='{$tarpro}',
                    str_conte='{$tarcon}',str_ceralt='{$ceralt}',str_cooalt='{$cercoo}',str_nomcon='{$nomcon}',str_telcon='{$telcon}',str_eps='{$eps}',
                    str_fonpen='{$pensio}',flo_salari='{$salari}',str_tipcon='{$tipcon}',str_cueban='{$cueban}',str_banco='{$banco}',inicio_contrato='{$ini_con}',
                    fin_contrato='{$fin_con}',str_emaper='{$emaper}',str_emacor='{$emacor}'";
			$query.=" WHERE id='{$employee['id']}'";
			$result=$db->query($query);
			if($result&&$db->affected_rows()===1){
				$session->msg('s',"El empleado ha sido actualizado.");
				redirect('employees.php',false);
			}else{
				$session->msg('d','Actualización fallida.');
				redirect('edit_employee.php?id='.$employee['id'],false);
            }
		}else{
			$session->msg("d",$errors);
			redirect('edit_employee.php?id='.$employee['id'],false);
		}
	}
	if(isset($_POST['back'])){
		header("Location: employees.php");
	}
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
	<div class="col-md-12">
		<?php echo display_msg($msg); ?>
	</div>
</div>
<center><img src="libs/images/logo.png" alt="logo"></center><br>
<div class="row">
    <div class="panel panel-default">
		<div class="panel-heading">
			<strong>
				<span class="glyphicon glyphicon-th"></span>
				<span>Editar empleado</span>
			</strong>
        </div>
        <div class="panel-body">
			<div class="col-md-7">
				<form method="post" action="edit_employee.php?id=<?php echo (int)$employee['id'] ?>">
					<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-user"></i>
										</span>
										<input type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?php echo remove_junk($employee['nombre']); ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-th-large"></i>
										</span>
										<input type="text" class="form-control" name="apellidos" placeholder="Apellidos" value="<?php echo remove_junk($employee['apellidos']); ?>">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-phone-alt"></i>
										</span>
										<input type="text" class="form-control" name="numper" placeholder="Num. teléfono personal" value="<?php echo remove_junk($employee['str_telper']); ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-earphone"></i>
										</span>
										<input type="text" class="form-control" name="numcor" placeholder="Num. teléfono corporativo" value="<?php echo remove_junk($employee['str_telcor']); ?>">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-envelope"></i>
										</span>
										<input type="text" class="form-control" name="emaper" placeholder="Correo electrónico personal" value="<?php echo remove_junk($employee['str_emaper']); ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-cloud"></i>
										</span>
										<input type="text" class="form-control" name="emacor" placeholder="Correo electrónico corp." value="<?php echo remove_junk($employee['str_emacor']); ?>">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-compressed"></i>
										</span>
										<select class="form-control" name="tipdocumento">
											<option value=""disabled>Tipo documento identidad</option>
											<option value="Cédula de Ciudadanía"<?php if($employee['str_tipdoc']=="Cédula de Ciudadanía"){echo "SELECTED";} ?>>Cédula de Ciudadanía</option>
											<option value="Cédula de Extranjería"<?php if($employee['str_tipdoc']=="Cédula de Extranjería"){echo "SELECTED";} ?>>Cédula de Extranjería</option>
											<option value="Pasaporte"<?php if($employee['str_tipdoc']=="Pasaporte"){echo "SELECTED";} ?>>Pasaporte</option>							
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-bookmark"></i>
										</span>
										<input type="text" class="form-control" name="documento" placeholder="Documento" value="<?php echo remove_junk($employee['documento']); ?>">
									</div>
								</div>								
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-plus-sign"></i>
										</span>
										<input type="text" class="form-control" name="eps" placeholder="Afiliación EPS" value="<?php echo remove_junk($employee['str_eps']); ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-ok-sign"></i>
										</span>
										<input type="text" class="form-control" name="pensio" placeholder="Fondo de Pensiones y Cesantías" value="<?php echo remove_junk($employee['str_fonpen']); ?>">
									</div>
								</div>								
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-camera"></i>
										</span>
										<select class="form-control" name="foto">
											<option value=""disabled>Foto empleado</option>
											<option value="0">Sin imagen</option>
											<?php foreach($all_photo as $foto): ?>
											<option value="<?php echo (int)$foto['id'] ?>" <?php if($employee['foto']===$foto['id']): echo "selected"; endif; ?>>
											<?php echo $foto['file_name'] ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-map-marker"></i>
										</span>
										<input type="text" class="form-control" name="lugar_nacimiento" placeholder="Lugar de nacimiento" value="<?php echo remove_junk($employee['lugar_nacimiento']); ?>">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-calendar"></i>
										</span>
										<input type="text" class="form-control" name="fecha_nacimiento" placeholder="Fecha de nacimiento" value="<?php echo remove_junk($employee['fecha_nacimiento']); ?>" onfocus="(this.type='date')" onblur="(this.type='text')">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-pushpin"></i>
										</span>
										<input type="text" class="form-control" name="domicilio" placeholder="Domicilio" value="<?php echo remove_junk($employee['domicilio']); ?>">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-dashboard"></i>
										</span>
										<input type="text" class="form-control" name="ciudad" placeholder="Ciudad" value="<?php echo remove_junk($employee['ciudad']); ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-globe"></i>
										</span>
										<input type="text" class="form-control" name="region" placeholder="Departamento" value="<?php echo remove_junk($employee['region']); ?>">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-credit-card"></i>
										</span>
										<select class="form-control" name="nivest" placeholder="Nivel de estudios">
											<option value=""disabled selected>Nivel de estudios</option>
											<option value="Bachiller"<?php if($employee['str_nivest']=="Bachiller"){echo "SELECTED";} ?>>Bachiller</option>
											<option value="Técnico"<?php if($employee['str_nivest']=="Técnico"){echo "SELECTED";} ?>>Técnico</option>
											<option value="Tecnólogo"<?php if($employee['str_nivest']=="Tecnólogo"){echo "SELECTED";} ?>>Tecnólogo</option>
											<option value="Universitario"<?php if($employee['str_nivest']=="Universitario"){echo "SELECTED";} ?>>Universitario</option>
											<option value="Postgrado"<?php if($employee['str_nivest']=="Postgrado"){echo "SELECTED";} ?>>Postgrado</option>
											<option value="Maestría"<?php if($employee['str_nivest']=="Maestría"){echo "SELECTED";} ?>>Maestría</option>
											<option value="Doctorado"<?php if($employee['str_nivest']=="Doctorado"){echo "SELECTED";} ?>>Doctorado</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-list-alt"></i>
										</span>
										<input type="text" class="form-control" name="titulacion" placeholder="Titulación" value="<?php echo remove_junk($employee['titulacion']); ?>">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-briefcase"></i>
										</span>
										<select class="form-control" name="cargo" placeholder="Cargo en la empresa">
											<option value=""disabled selected>Cargo en la empresa</option>
											<option value="Técnico TIC"<?php if($employee['puesto']=="Técnico TIC"){echo "SELECTED";} ?>>Técnico TIC</option>
											<option value="Técnico EER"<?php if($employee['puesto']=="Técnico EER"){echo "SELECTED";} ?>>Técnico EER</option>
											<option value="Tecnólogo CE"<?php if($employee['puesto']=="Tecnólogo CE"){echo "SELECTED";} ?>>Tecnólogo CE</option>
											<option value="SGSST"<?php if($employee['puesto']=="SGSST"){echo "SELECTED";} ?>>SGSST</option>
											<option value="Auxiliar adtivo"<?php if($employee['puesto']=="Auxiliar adtivo"){echo "SELECTED";} ?>>Auxiliar adtivo</option>
											<option value="Gerente Proyecto"<?php if($employee['puesto']=="Gerente Proyecto"){echo "SELECTED";} ?>>Gerente Proyecto</option>
											<option value="Coordinador de campo"<?php if($employee['puesto']=="Coordinador de campo"){echo "SELECTED";} ?>>Coordinador de campo</option>
											<option value="Líder de zona"<?php if($employee['puesto']=="Líder de zona"){echo "SELECTED";} ?>>Líder de zona</option>
											<option value="CEO"<?php if($employee['puesto']=="CEO"){echo "SELECTED";} ?>>CEO</option>
											<option value="Director Operaciones"<?php if($employee['puesto']=="Director Operaciones"){echo "SELECTED";} ?>>Director Operaciones</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-education"></i>
										</span>
										<select class="form-control" name="tarpro" placeholder="Tarjeta Profesional">
											<option value=""disabled selected>Tarjeta Profesional</option>
											<option value="si"<?php if($employee['str_tarpro']=="si"){echo "SELECTED";} ?>>Si</option>
											<option value="no"<?php if($employee['str_tarpro']=="no"){echo "SELECTED";} ?>>No</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-education"></i>
										</span>
										<select class="form-control" name="tarcon" placeholder="Tarjeta CONTE">
											<option value=""disabled selected>Tarjeta CONTE</option>
											<option value="si"<?php if($employee['str_conte']=="si"){echo "SELECTED";} ?>>Si</option>
											<option value="no"<?php if($employee['str_conte']=="no"){echo "SELECTED";} ?>>No</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-education"></i>
										</span>
										<select class="form-control" name="ceralt" placeholder="Cert. trabajo en alturas">
											<option value=""disabled selected>Cert. trabajo en alturas</option>
											<option value="si"<?php if($employee['str_ceralt']=="si"){echo "SELECTED";} ?>>Si</option>
											<option value="no"<?php if($employee['str_ceralt']=="no"){echo "SELECTED";} ?>>No</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-education"></i>
										</span>
										<select class="form-control" name="cercoo" placeholder="Cert. coord. Alturas">
											<option value=""disabled selected>Certificado coodinador alturas</option>
											<option value="si"<?php if($employee['str_cooalt']=="si"){echo "SELECTED";} ?>>Si</option>
											<option value="no"<?php if($employee['str_cooalt']=="no"){echo "SELECTED";} ?>>No</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-road"></i>
										</span>
										<select class="form-control" name="carnet_conducir" placeholder="Carnet de conducir">
											<option value=""disabled selected>Carnet de conducir</option>
											<option value="si"<?php if($employee['carnet_conducir']=="si"){echo "SELECTED";} ?>>Si</option>
											<option value="no"<?php if($employee['carnet_conducir']=="no"){echo "SELECTED";} ?>>No</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-usd"></i>
										</span>									
										<input type="number" step="0,10" class="form-control" name="salari" placeholder="Salario báse" value="<?php echo remove_junk($employee['flo_salari']); ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-paperclip"></i>
										</span>
										<select class="form-control" name="tipcon" placeholder="Tipo de contrato">
											<option value=""disabled selected>Tipo de contrato</option>
											<option value="Obra o Labor"<?php if($employee['str_tipcon']=="Obra o Labor"){echo "SELECTED";} ?>>Obra o Labor</option>
											<option value="Indefinido"<?php if($employee['str_tipcon']=="Indefinido"){echo "SELECTED";} ?>>Indefinido</option>
											<option value="Prestación de servicios"<?php if($employee['str_tipcon']=="Prestación de servicios"){echo "SELECTED";} ?>>Prestación de servicios</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-bitcoin"></i>
										</span>
										<input type="text" class="form-control" name="cueban" placeholder="Cuenta bancaria" value="<?php echo remove_junk($employee['str_cueban']); ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-check"></i>
										</span>
										<input type="text" class="form-control" name="banco" placeholder="Tipo de cuenta / Banco" value="<?php echo remove_junk($employee['str_banco']); ?>">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-hand-right"></i>
										</span>
										<input type="text" class="form-control" name="nomcon" placeholder="Nombre persona de contacto" value="<?php echo remove_junk($employee['str_nomcon']); ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-phone-alt"></i>
										</span>
										<input type="text" class="form-control" name="telcon" placeholder="Num. teléfono persona contacto" value="<?php echo remove_junk($employee['str_telcon']); ?>">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-calendar"></i>
										</span>
										<input type="text" class="form-control" name="inicio_contrato" value="<?php echo remove_junk($employee['inicio_contrato']); ?>" onfocus="(this.type='date')" onblur="(this.type='text')">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-calendar"></i>
										</span>
										<input type="text" class="form-control" name="fin_contrato" value="<?php echo remove_junk($employee['fin_contrato']); ?>" onfocus="(this.type='date')" onblur="(this.type='text')">
									</div>
								</div>
							</div>
						</div>
					<button type="submit" name="employee" class="btn btn-danger" style="margin-left:200px">Actualizar</button>
					<button type="submit" name="back" class="btn btn-primary" style="margin-left:200px">Volver atras</button>
				</form>
			</div>
        </div>
    </div>
</div>
<?php include_once('layouts/footer.php'); ?>
<?php
	$page_title='Agregar empleado';
	require_once('includes/load.php');
	page_require_level(2);
	$all_photo=find_all("media", "file_destino = 'employees'");
?>
<?php
    if(isset($_POST['submit'])){
        $photo=new Media();
        $photo->upload($_FILES['file_upload']);
        if($photo->process_emp()){
            $session->msg('s','Imagen subida al servidor.');
            redirect('add_employee.php');
        }else{
            $session->msg('d',join($photo->errors));
            redirect('add_employee.php');
        }
    }




	if(isset($_POST['add_employee'])){
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
			$query="INSERT INTO employees (foto, nombre, apellidos, str_telper, str_telcor, str_tipdoc, documento, lugar_nacimiento, fecha_nacimiento, domicilio, 
                    ciudad, region, carnet_conducir, titulacion, str_nivest, puesto, str_tarpro, str_conte, str_ceralt, str_cooalt, str_nomcon, str_telcon, str_eps, 
                    str_fonpen, flo_salari, str_tipcon, str_cueban, str_banco, inicio_contrato, fin_contrato, str_emaper, str_emacor";
			$query.=") VALUES (";
			$query.="'{$foto}','{$nombre}','{$apellidos}','{$numper}','{$numcor}','{$tipdocumento}','{$documento}','{$lugar_nac}','{$fecha_nac}','{$domicilio}',
                    '{$ciudad}','{$region}','{$carnet}','{$titulo}','{$nivest}','{$puesto}','{$tarpro}','{$tarcon}','{$ceralt}','{$cercoo}','{$nomcon}','{$telcon}','{$eps}',
                    '{$pensio}','{$salari}','{$tipcon}','{$cueban}','{$banco}','{$ini_con}','{$fin_con}','{$emaper}','{$emacor}'";
			$query.=")";
			$query.=" ON DUPLICATE KEY UPDATE nombre='{$nombre}'";
			if($db->query($query)){
				$session->msg('s',"Empleado agregado.");
				redirect('add_employee.php',false);
			}else{
				$session->msg('d','Empleado no agragado.');
				redirect('employees.php',false);
			}
		} else{
			$session->msg("d",$errors);
			redirect('add_employee.php',false);
		}
	}
	if(isset($_POST['back'])){
		header("Location: employees.php");
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
					<span>Agregar empleado</span>
				</strong>
			</div>
			
			<div class="panel-body">
			
			
    			<div class="col-md-12">
            		<div class="panel panel-default">
            			<div class="panel-heading">
            				<div class="panel-heading clearfix">
            					<span class="glyphicon glyphicon-camera"></span>
            					<span>Seleccionar foto</span>
            				</div>
            			</div>
            			<div class="panel-body">
            				<div class="row">            					
            					<div class="col-md-8">
            						<form class="form" action="add_employee.php" method="POST" enctype="multipart/form-data">
            							<div class="form-group">
            								<input type="file" name="file_upload" multiple="multiple" class="btn btn-default btn-file"/>
            							</div>
            							<div class="form-group">
            								<button type="submit" name="submit" class="btn btn-warning">Subir</button>
            							</div>
            						</form>
            					</div>
            				</div>
            			</div>
            		</div>
            	</div>
			
			
				<div class="col-md-12">
					<form method="post" action="add_employee.php" class="clearfix">
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-user"></i>
										</span>
										<input type="text" class="form-control" name="nombre" placeholder="Nombre">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-th-large"></i>
										</span>
										<input type="text" class="form-control" name="apellidos" placeholder="Apellidos">
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
										<input type="text" class="form-control" name="numper" placeholder="Num. teléfono personal">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-earphone"></i>
										</span>
										<input type="text" class="form-control" name="numcor" placeholder="Num. teléfono corporativo">
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
										<input type="text" class="form-control" name="emaper" placeholder="Correo electrónico personal">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-cloud"></i>
										</span>
										<input type="text" class="form-control" name="emacor" placeholder="Correo electrónico corp.">
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
											<option value=""disabled selected>Tipo documento identidad</option>
											<option value="Cédula de Ciudadanía">Cédula de Ciudadanía</option>
											<option value="Cédula de Extranjería">Cédula de Extranjería</option>
											<option value="Pasaporte">Pasaporte</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-bookmark"></i>
										</span>
										<input type="text" class="form-control" name="documento" placeholder="Documento">
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
										<input type="text" class="form-control" name="eps" placeholder="Afiliación EPS">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-ok-sign"></i>
										</span>
										<input type="text" class="form-control" name="pensio" placeholder="Fondo de Pensiones y Cesantías">
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
											<option value="">Foto del empleado</option>
											<?php foreach ($all_photo as $foto): ?>
											<option value="<?php echo (int)$foto['id'] ?>">
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
										<input type="text" class="form-control" name="lugar_nacimiento" placeholder="Lugar de nacimiento">
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
										<input type="text" class="form-control" name="fecha_nacimiento" placeholder="Fecha de nacimiento" onfocus="(this.type='date')" onblur="(this.type='text')">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-pushpin"></i>
										</span>
										<input type="text" class="form-control" name="domicilio" placeholder="Domicilio">
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
										<input type="text" class="form-control" name="ciudad" placeholder="Ciudad">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-globe"></i>
										</span>
										<input type="text" class="form-control" name="region" placeholder="Departamento">
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
											<option value="Bachiller">Bachiller</option>
											<option value="Técnico">Técnico</option>
											<option value="Tecnólogo">Tecnólogo</option>
											<option value="Universitario">Universitario</option>
											<option value="Postgrado">Postgrado</option>
											<option value="Maestría">Maestría</option>
											<option value="Doctorado">Doctorado</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-list-alt"></i>
										</span>
										<input type="text" class="form-control" name="titulacion" placeholder="Titulación">
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
											<option value="Técnico TIC">Técnico TIC</option>
											<option value="Técnico EER">Técnico EER</option>
											<option value="Tecnólogo CE">Tecnólogo CE</option>
											<option value="SGSST">SGSST</option>
											<option value="Auxiliar adtivo">Auxiliar adtivo</option>
											<option value="Gerente Proyecto">Gerente Proyecto</option>
											<option value="Coordinador de campo">Coordinador de campo</option>
											<option value="Líder de zona">Líder de zona</option>
											<option value="CEO">CEO</option>
											<option value="Director Operaciones">Director Operaciones</option>
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
											<option value="si">Si</option>
											<option value="no">No</option>
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
											<option value="si">Si</option>
											<option value="no">No</option>
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
											<option value="si">Si</option>
											<option value="no">No</option>
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
											<option value="si">Si</option>
											<option value="no">No</option>
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
											<option value="si">Si</option>
											<option value="no">No</option>
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
									
										<input type="number" step="0,10" class="form-control" name="salari" placeholder="Salario báse">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-paperclip"></i>
										</span>
										<select class="form-control" name="tipcon" placeholder="Tipo de contrato">
											<option value=""disabled selected>Tipo de contrato</option>
											<option value="Obra o Labor">Obra o Labor</option>
											<option value="Indefinido">Indefinido</option>
											<option value="Prestación de servicios">Prestación de servicios</option>
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
										<input type="text" class="form-control" name="cueban" placeholder="Cuenta bancaria">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-check"></i>
										</span>
										<input type="text" class="form-control" name="banco" placeholder="Tipo de cuenta / Banco">
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
										<input type="text" class="form-control" name="nomcon" placeholder="Nombre persona de contacto">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-phone-alt"></i>
										</span>
										<input type="text" class="form-control" name="telcon" placeholder="Num. teléfono persona contacto">
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
										<input type="text" class="form-control" name="inicio_contrato" placeholder="Incio del contrato" onfocus="(this.type='date')" onblur="(this.type='text')">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-calendar"></i>
										</span>
										<input type="text" class="form-control" name="fin_contrato" placeholder="Fin del contrato" onfocus="(this.type='date')" onblur="(this.type='text')">
									</div>
								</div>
							</div>
						</div>
						<button type="submit" name="add_employee" class="btn btn-danger" style="margin-left:100px">Agregar empleado</button>
						<button type="submit" name="back" class="btn btn-primary" style="margin-left:300px">Cancelar</button>
					</form>
				</div>
			</div>
		</div>
    </div>
</div>
<?php include_once('layouts/footer.php'); ?>
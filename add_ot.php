<?php
	$page_title='Agregar OT';
	require_once('includes/load.php');
	page_require_level(2);
	$all_empl=find_all('employees');
	$all_pys=find_all('proyecto');
?>
<?php
	if(isset($_POST['submit'])){
	    $req_fields=array('tecnico', 'fechagen','sede','origen','destino','viaticos','fechaini','fechafin');
		validate_fields($req_fields);
		if(empty($errors)){
		    $p_tec=remove_junk($db->escape($_POST['tecnico']));
			$p_fgen=remove_junk($db->escape($_POST['fechagen']));
			$p_sede=remove_junk($db->escape($_POST['sede']));
			$p_ori=remove_junk($db->escape($_POST['origen']));
			$p_dest=remove_junk($db->escape($_POST['destino']));
			$p_viat=remove_junk($db->escape($_POST['viaticos']));
			$p_fini=remove_junk($db->escape($_POST['fechaini']));
			$p_ffin=remove_junk($db->escape($_POST['fechafin']));
			$p_obs=remove_junk($db->escape($_POST['observ']));
			$p_py= $_POST['skills']; 
			
			$date=make_date();
			$query="INSERT INTO ot (";
			$query.=" dat_fecgen,id_empleado,str_sede,str_origen, str_destino, dat_fecini, dat_fecfin,enu_viaticos,str_observ";
			$query.=") VALUES (";
			$query.=" '{$p_fgen}','{$p_tec}','{$p_sede}','{$p_ori}','{$p_dest}','{$p_fini}','{$p_ffin}','{$p_viat}','{$p_obs}'";
			$query.=")";
			$query.=" ON DUPLICATE KEY UPDATE dat_fecgen='{$p_fgen}'"; 
			if($db->query($query)){
			    $otlast=$db->insert_id();
			    foreach ($p_py as $p):
    			    $query1="INSERT INTO otxproyecto (";
    			    $query1.=" int_ot,int_py";
    			    $query1.=") VALUES (";
    			    $query1.=" '{$otlast}','{$p}'";
    			    $query1.=")";
    			    if($db->query($query1)){
    			        $session->msg('s',"OT por PY agregado.");
    			    }
			    endforeach;
			    $session->msg('s',"OT agregada.");
				redirect('add_ot.php',false);
			}else{
				$session->msg('d','OT no agregada.');
				redirect('ot.php',false);
			}
		} else{
			$session->msg("d",$errors);
			redirect('add_ot.php',false);
		}
	}
	if(isset($_POST['back'])){
		header("Location: ot.php");
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
					<span>Agregar orden de trabajo</span>
				</strong>
			</div>
			<div class="panel-body">
				<div class="col-md-12">
					 <form method="post" action="add_ot.php" id="multiple_select_form">
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<select class="form-control" name="tecnico">
										<option value="">Seleccione el técnico</option>
										<?php foreach ($all_empl as $emp): ?>
										<option value="<?php echo (int)$emp['id'] ?>">
										<?php echo $emp['nombre']." ".$emp['apellidos'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="col-md-4">
									<div class="input-group">
										<span class="input-group-addon">
										<i class="glyphicon glyphicon-calendar"></i>
										</span>
										<input readonly type="text" class="form-control" name="fechagen" placeholder="Fecha generado" value="<?php echo date("Y-m-d H:i:s");?>">
									</div>
								</div>
								<div class="col-md-4">
									<div class="input-group">
										<span class="input-group-addon">
										<i class="glyphicon glyphicon-calendar"></i>
										</span>
										<input type="text" class="form-control" name="sede" placeholder="Sede OT">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<div class="input-group">
										<span class="input-group-addon">
										<i class="glyphicon glyphicon-calendar"></i>
										</span>
										<input type="text" class="form-control" name="origen" placeholder="Origen">
									</div>
								</div>
								<div class="col-md-4">
									<div class="input-group">
										<span class="input-group-addon">
										<i class="glyphicon glyphicon-calendar"></i>
										</span>
										<input type="text" class="form-control" name="destino" placeholder="Destino">
									</div>
								</div>
								<div class="col-md-4">
									<div class="input-group">
										<span class="input-group-addon">
										<i class="glyphicon glyphicon-calendar"></i>
										</span>
										<select name="skills[]" id="skills[]" class="form-control" size="2" data-live-search="true" multiple>
											<?php foreach ($all_pys as $all_py): ?>
    										<option value="<?php echo (int)$all_py['id'] ?>">
    										<?php echo $all_py['str_nombre']; ?></option>
    										<?php endforeach; ?>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<div class="input-group">
										<span class="input-group-addon">
										<i class="glyphicon glyphicon-calendar"></i>
										</span>
										<input type="text" class="form-control" name="fechaini" id="fechaini" placeholder="Fecha de inicio OT" onfocus="(this.type='date')" onblur="(this.type='text')">
									</div>
								</div>
								<div class="col-md-4">
									<div class="input-group">
										<span class="input-group-addon">
										<i class="glyphicon glyphicon-calendar"></i>
										</span>
										<input type="text" class="form-control" name="fechafin" id="fechafin" placeholder="Fecha finalización OT" onfocus="(this.type='date')" onblur="(this.type='text')">
									</div>
								</div>
								<div class="col-md-4">
									<div class="input-group">
										<span class="input-group-addon">
										<i class="glyphicon glyphicon-calendar"></i>
										</span>
										<select class="form-control" name="viaticos" id="viaticos"placeholder="Genera viáticos">
											<option value=""disabled selected>Genera viáticos</option>
											<option value="si">Si</option>
											<option value="no">No</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-th-large"></i>
										</span>
										<textarea maxlength="300" id="w3review" class="form-control" name="observ" rows="3" placeholder="Observaciones"></textarea>
									</div>
						</div>
						<div hidden id="liq_viaticos">
    						<div class="form-group">
    							<div class="row">
    								<div class="col-md-2">
    									<span class="input-group-addon">
    										<i class="glyphicon glyphicon-th"></i><label for="qty"> Días</label>
    									</span>
    									<input type="number" step="0,01" class="form-control" name="dias" placeholder="Días"">
    								</div>
    								<div class="col-md-2">
    									<span class="input-group-addon">
    										<i class="glyphicon glyphicon-transfer"></i><label for="qty"> Tr. Interm.</label>
    									</span>
    									<input type="number" step="0,01" class="form-control" name="interm" placeholder="Intermunicipal" >
    								</div>
    								<div class="col-md-2">
    									<span class="input-group-addon">
    										<i class="glyphicon glyphicon-modal-window"></i><label for="qty"> Tr. Sitio</label>
    									</span>
    									<input type="number" step="0,01" class="form-control" name="sitio" placeholder="Sitio">
    								</div>
    								<div class="col-md-2">
    									<span class="input-group-addon">
    										<i class="glyphicon glyphicon-sound-stereo"></i><label for="qty"> Tr. Term.</label>
    									</span>
    									<input type="number" step="0,01" class="form-control" name="term" placeholder="Terminales" >
    								</div>
    								<div class="col-md-2">
    									<span class="input-group-addon">
    										<i class="glyphicon glyphicon-leaf"></i><label for="qty"> Aliment.</label>
    									</span>
    									<input type="number" step="0,01" class="form-control" name="alim" placeholder="Alimentación" >
    								</div>
    								<div class="col-md-2">
    									<span class="input-group-addon">
    										<i class="glyphicon glyphicon-warning-sign"></i><label for="qty" font-size="10px"> Lavand.</label>
    									</span>
    									<input type="number" step="0,01" class="form-control" name="lavan" placeholder="Lavandería" >
    								</div>
    								
    							</div>
    						</div>		
    						<div class="form-group">
    								<div class="col-md-2">
    									<span class="input-group-addon">
    										<i class="glyphicon glyphicon-header"></i><label for="qty" font-size="10px"> Hotel.</label>
    									</span>
    									<input type="number" step="0,01" class="form-control" name="Hotel" placeholder="Hotel" >
    								</div>
    								<div class="input-group">
    										<span class="input-group-addon">
    											<i class="glyphicon glyphicon-th-large"></i>
    										</span>
    										<textarea maxlength="200" id="w3review" class="form-control" name="observ" rows="3" placeholder="Observaciones"></textarea>
    								</div>
    						</div>	
						</div>
						
							
								
     					<input type="submit" name="submit" class="btn btn-info" value="Aceptar" />					
						<button type="submit" name="back" class="btn btn-primary" style="margin-left:200px">Cancelar</button>
					</form>
				</div>
			</div>
		</div>
    </div>
</div>
<script>
 $(document).ready(function(){
	$("#viaticos").on("change",function(){
     var valorSelect=$(this).val()//obtenemos el valor seleccionado en una variable
     if (valorSelect == "si")
     {var valorFecIn=document.getElementById("fechaini").value;//obtenemos el valor de fecha inicial
      var valorFecFi=document.getElementById("fechafin").value;//obtenemos el valor de fecha final
      if((valorFecIn != "") && (valorFecIn != ""))
      {$.ajax({
        url:"ajax/get_calculo_viat.php",
        type:"POST",
        data:{fechaini:valorFecIn, fechafin:valorFecFi},//enviamos lo seleccionado
    
        success:function(respuesta){
         console.log( respuesta)
         $("#liq_viaticos").html(respuesta);//en el div con el id respuestas mostramos los resultados del callback
        }
       })
      }
      else
      {document.getElementById("viaticos").value = ""; alert ("Antes de definir si tiene viáticos, debe asignar las fechas de inicio y fin");   
      }
     }
	 alert ("El valor es "+valorSelect);   
    })

	
 })
</script>
<?php include_once('layouts/footer.php'); ?>
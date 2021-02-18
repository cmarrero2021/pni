<?php
if (is_null($perfil)){
	$perfil=[];
	$id_perfil_investigador=0;
	$rif_investigador='""';
	$id_nivel_academico=0;
	$id_estatus_academico=0;
	$id_institucion_educativa=0;
	$id_especialidad_salud=0;
	$id_area_conocimiento=0;
	$id_sub_area=0;
	$clase = " bgc-granada color-error ";
} else {
	$id_perfil_investigador=$perfil["id_perfil_investigador"];
	$rif_investigador=$perfil["rif_investigador"];
	$id_nivel_academico=$perfil["id_nivel_academico"];
	$id_estatus_academico=$perfil["id_estatus_academico"];
	$id_institucion_educativa=$perfil["id_institucion_educativa"];
	$id_especialidad_salud=$perfil["id_especialidad_salud"];
	$id_area_conocimiento=$perfil["id_area_conocimiento"];
	$id_sub_area=$perfil["id_sub_area"];
	$clase = "";
}
$dir = "assets/documentos/".$this->session->userdata("cedula")."/";
$ced = glob($dir.$this->session->userdata("cedula")."_cedula.*");
if ($ced) {
	$img_cedula = 1;
} else {
	$img_cedula=0;
}
$rif = glob($dir.$this->session->userdata("cedula")."_rif.*");
if ($rif) {
	$img_rif = 1;
} else {
	$img_rif=0;
}
$foto = glob($dir.$this->session->userdata("cedula")."_foto.*");
if ($foto) {
	$img_foto = '<img src="'.base_url().$foto[0].'"  class="img-responsive img-thumbnail" />';
	$img_foto1=1;
} else {
	$img_foto="";
	$img_foto1=0;
}
$titulo1 = glob($dir.$this->session->userdata("cedula")."_titulo.*");
if ($titulo) {
	$img_titulo = 1;
} else {
	$img_titulo=0;
}
if ($salud == 1) {
	$estesp = "";
} else {
	$estesp = "style='display:none;'";
}
?>
<script type="text/javascript">
</script>
<body class="cuerpo-r">
	<img src="<?php echo base_url(); ?>assets/img/logo_pni-01.png" class="logo-pni">
	<div class="container margen-login">
		<form id="frm_registro">
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label class="verdeclaro" for="cedula">Cédula de Identidad</label>
						<input type="text" name="cedula" id="cedula" class="form-control borde-v-3" value="<?php echo $this->session->userdata('cedula'); ?>" readonly>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<?php if ($img_cedula == 0) { ?>
							<div class="row">
								<label class="verdeclaro" for="pnombre">Cargar Documento</label>
							</div>
							<div class="col-md-9">
								<input type="file" name="cargar_cedula" id="cargar_cedula" class="form-control" style="width:100%;">
								<img src="<?php echo base_url(); ?>/assets/img/buscar.gif" id="porc_cedula" style="display:none;">
							</div>
							<?php } else { ?>}
							<div class="col-md-9">
								<label class="verdeclaro documento_cargado" id="recargar_cedula" style="cursor:pointer;"> <br/>YA SE HA CARGADO LA CÉDULA DE IDENTIDAD. SI DESEA SUSTITUIR EL DOCUMENTO, PRESIONE AQUÍ</label>
							</div>
						<?php } ?>
					</div>
				</div>
				<div class="col-md-2" id = "img_cedula">
					<?php echo $img_cedula; ?>
				</div>		
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label class="verdeclaro" for="rif">RIF</label>
						<input type="text" name="rif" id="rif" class="form-control borde-v-3 <?php echo $clase; ?>" value = <?php echo $rif_investigador; ?>>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<?php if ($img_rif ==0) { ?>
							<div class="row">
								<label class="verdeclaro" for="cargar_rif">Cargar Documento</label>
							</div>
							<div class="col-md-9">
								<input type="file" name="cargar_rif" id="cargar_rif" class="form-control <?php echo $clase; ?>" style="width:100%;"><img src="<?php echo base_url(); ?>/assets/img/buscar.gif" id="porc_rif" style="display:none;">
							</div>
						<?php } else { ?>
							<div class="col-md-9">
								<label class="verdeclaro documento_cargado" id="recargar_rif" style="cursor:pointer;"><br/>YA SE HA CARGADO EL RIF. SI DESEA SUSTITUIR EL DOCUMENTO, PRESIONE AQUÍ</label>
							</div>
						<?php } ?>
					</div>
				</div>
				<div class="col-md-2" id = "img_rif">
					<?php echo $img_rif; ?>
				</div>	
			</div>
			<div class="row">
				<div class="col-md-10">
					<div class="form-group">
						<?php if ($img_foto1 == 0) { ?>
							<div class="row">
								<label class="verdeclaro" for="cargar_foto">Cargar Foto</label>
							</div>
							<div class="col-md-9">
								<input type="file" name="cargar_foto" id="cargar_foto" class="form-control <?php echo $clase; ?>" style="width:100%;"><img src="<?php echo base_url(); ?>/assets/img/buscar.gif" id="porc_foto" style="display:none;">
							</div>
						<?php } else { ?>
							<div class="col-md-5 col-md-offset-4">
								<label class="verdeclaro documento_cargado"  id="recargar_foto" style="cursor:pointer;margin-left:-7%;">YA SE HA CARGADO LA FOTOGRAFÍA. SI DESEA SUSTITUIR EL DOCUMENTO, PRESIONE AQUÍ</label>
							</div>
						<?php } ?>
					</div>
				</div>
				<div class="col-md-2" id = "img_foto" style="margin-left:-8.2%;">
					<?php echo $img_foto; ?>
				</div>	
			</div>
			<hr>
			<br/>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label class="verdeclaro" for="niveles">Nivel Académico</label>
						<select id="niveles" name="niveles" class="form-control borde-v-3 bgc-granada
						color-error"></select>
					</div>
				</div>				
				<div class="col-md-3">
					<div class="form-group">
						<label class="verdeclaro" for="estatus">Estatus Académico</label>
						<select id="estatus" name="estatus" class="form-control borde-v-3 bgc-granada
						color-error"></select>
					</div>
				</div>
				<div class="col-md-3" id="inst_ed" style="display:none;">
					<div class="form-group">
						<label class="verdeclaro" for="institucion_educativa">Institución Educativa</label>
						<select name="institucion_educativa" id="institucion_educativa" class="form-control borde-v-3 bgc-granada color-error"></select>
					</div>
				</div>
			</div>
			<div class="row" id="tit" style="display:none;">
				<div class="col-md-10">
					<div class="form-group">
						<?php if($img_titulo ==0) { ?>
							<div class="row">
								<label class="verdeclaro" for="cargar_titulo">Cargar Último Título Académico Obtenido</label>
							</div>
							<div class="col-md-9">
								<input type="file" name="cargar_titulo" id="cargar_titulo" class="form-control <?php echo $clase; ?>" style="width:100%;"><img src="<?php echo base_url(); ?>/assets/img/buscar.gif" id="porc_titulo" style="display:none;">
							</div>
						<?php } else { ?>
							<div class="col-md-9">
								<label class="verdeclaro documento_cargado"  id="recargar_titulo" style="cursor:pointer;"><br/>YA SE HA CARGADO EL ÚLTIMO TÍTULO. SI DESEA SUSTITUIR EL DOCUMENTO, PRESIONE AQUÍ</div>	
								<?php } ?>
							</div>
						</div>
						<div class="col-md-2" id = "img_titulo" style="margin-left:-8.2%;">
							<?php echo $img_titulo; ?>
						</div>	
					</div>
					<br/>
					<div class="row">
						<div class="col-md-3" id="area_con" style="display:none;" >
							<div class="form-group">
								<label class="verdeclaro" for="areas">Área de Conocimiento</label>
								<select id="areas" name="areas" class="form-control borde-v-3 bgc-granada color-error"></select>
							</div>
						</div>	
						<div class="col-md-3" id="subarea" style="display:none;">
							<div class="form-group">
								<label class="verdeclaro" for="sub_areas">Sub Área de Conocimiento</label>
								<select id="sub_areas" name="sub_areas" class="form-control borde-v-3 bgc-granada color-error"></select>
							</div>
						</div>
						<div class="col-md-3" id="esp" style="display:none;">
							<div class="form-group">
								<label class="verdeclaro" for="especialidad">Especialidad</label>
								<select id="especialidad" name="especialidad" class="form-control bgc-granada color-error borde-v-3"></select>
							</div>
						</div>
					</div>
					<div>
						<div class="row">
							<div class="col-md-2">
								<div class="form-group">
									<?php
									$valor = strlen($rif_investigador)==2?'REGISTRAR':'ACTUALIZAR';
									?>
									<input type="button" name="aceptar" id="aceptar" class="form-control" style="display:none;" value="<?php echo $valor; ?>" >
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</body>
	<script type="text/javascript">
		if (<?php echo $img_cedula; ?> ==1) {
			$("#img_cedula").html('<input type="checkbox" checked class="check-grande" readonly style="margin-top:20%;">');
		} else {
			$("#img_cedula").html('<input type="checkbox" class="check-grande" readonly style="margin-top:20%;">');
		}

		if (<?php echo $img_rif; ?> ==1) {
			$("#img_rif").html('<input type="checkbox" checked class="check-grande" readonly style="margin-top:20%;">');
		} else {
			$("#img_rif").html('<input type="checkbox" class="check-grande" readonly style="margin-top:20%;">');
		}
		if (<?php echo $img_titulo; ?> ==1) {
			$("#img_titulo").html('<input type="checkbox" checked class="check-grande" readonly style="margin-top:20%;">');
			$("#tit").show();
		} else {
			$("#img_titulo").html('<input type="checkbox" class="check-grande" readonly style="margin-top:20%;">');
		}
		if (<?php echo $id_nivel_academico; ?> >= 3) {
			$("#area_con").show()
			$("#subarea").show()
			if ($("#areas").val()==9) {
				$("#est").show();
			} else {
				$("#est").hide();
			}
		} else {
			$("#area_con").hide()
			$("#subarea").hide()
			$("#est").hide();
		}
		if (<?php echo count($perfil); ?> > 0) {
			$("#aceptar").show();
		}
		$.ajax({
			url: 'get_niveles',
			type: 'post',
			dataType: 'json',
		})
		.done(function(data) {
			$('#niveles').append('<option value=""></option>');
			$(data).each(function (i, val) {
				var selected = "";
				if (val["id_nivel_academico"] == <?php echo $id_nivel_academico; ?>) {
					selected = "selected";
					$("#niveles").removeClass('bgc-granada');
					$("#niveles").removeClass('color-error');
					var nivel = <?php echo $id_nivel_academico; ?>;
					switch(nivel) {
						case 3:
						$("#inst_ed").show();
						$("#inst_ed").show();
						$("#tit").show();
						$("#area_con").show();
						$("#subarea").show();
						break;
						case 4:
						$("#inst_ed").show();
						$("#tit").show();				
						$("#area_con").show();				
						$("#subarea").show();
						break;
					}
				}
				$('#niveles').append('<option value='+val["id_nivel_academico"]+' '+selected+'>'+val["nivel_academico"]+'</option>');
			})
		});
		$.ajax({
			url: 'get_estatus',
			type: 'post',
			dataType: 'json',
		})
		.done(function(data) {
			$('#estatus').append('<option value=""></option>');
			$(data).each(function (i, val) {
				var selected = "";
				if (val["id_estatus_academico"] == <?php echo $id_estatus_academico; ?>) {
					selected = "selected";
					$("#estatus").removeClass('bgc-granada');
					$("#estatus").removeClass('color-error');
				}
				$('#estatus').append('<option value='+val["id_estatus_academico"]+' '+selected+'>'+val["estatus_academico"]+'</option>');
			})
		});
		$.ajax({
			url: 'get_institucion_educativa',
			type: 'post',
			dataType: 'json',
		})
		.done(function(data) {
			var n=0;
			$('#institucion_educativa').append('<option value=""></option>');
			$(data).each(function (i, val) {
				var selected = "";
				if (val["id_institucion_educativa"] == <?php echo empty($id_institucion_educativa)?0:$id_institucion_educativa; ?>) {
					selected = "selected";
					$("#institucion_educativa").removeClass('bgc-granada');
					$("#institucion_educativa").removeClass('color-error');
				}
				$('#institucion_educativa').append('<option value='+val["id_institucion_educativa"]+' '+selected+'>'+val["nombre_institucion_educativa"]+'</option>');
			})
		});
		$.ajax({
			url: 'get_especialidad_salud',
			type: 'post',
			dataType: 'json',
		})
		.done(function(data) {
			$('#especialidad').append('<option value=""></option>');
			$(data).each(function (i, val) {
				var selected = "";
				if (val["id_especialidad_salud"] == <?php echo empty($id_especialidad_salud)?0:$id_especialidad_salud; ?>) {
					selected = "selected";
					$("#especialidad").removeClass('bgc-granada');
					$("#especialidad").removeClass('color-error');
				}
				$('#especialidad').append('<option value='+val["id_especialidad_salud"]+' '+selected+'>'+val["nombre_especialidad_salud"]+'</option>');
			})
		});
		$.ajax({
			url: 'get_areas',
			type: 'post',
			dataType: 'json',
		})
		.done(function(data) {
			$('#areas').append('<option value=""></option>');
			$(data).each(function (i, val) {
				var selected = "";
				if (val["id_area_conocimiento"] == <?php echo empty($id_area_conocimiento)?0:$id_area_conocimiento; ?>) {
					selected = "selected";
					$("#areas").removeClass('bgc-granada');
					$("#areas").removeClass('color-error');
				}
				$('#areas').append('<option value='+val["id_area_conocimiento"]+' '+selected+'>'+val["area_conocimiento"]+'</option>');
			})
		});
		var area = <?php echo empty($id_area_conocimiento)?0:$id_area_conocimiento; ?>;
		$.ajax({
			url: 'get_sub_areas/'+area,
			type: 'post',
			dataType: 'json',
		})
		.done(function(data) {
			$(data).each(function (i, val) {
				var selected = "";
				if (val["id_sub_area"] == <?php echo empty($id_sub_area)?0:$id_sub_area; ?>) {
					selected = "selected";
					$("#sub_areas").removeClass('bgc-granada');
					$("#sub_areas").removeClass('color-error');
				}
				$('#sub_areas').append('<option value='+val["id_sub_area"]+' '+selected+'>'+val["sub_area"]+'</option>');
			})
		});
		$("#areas").on('click',function() {
			if ($(this).val()==9 && $("#niveles").val()>3) {
				$("#esp").show();
			} else {
				$("#esp").hide();
			}
			$("#sub_areas").children().remove();
			var area = $(this).val();
			$.ajax({
				url: 'get_sub_areas/'+area,
				type: 'post',
				dataType: 'json',
			})
			.done(function(data) {
				$(data).each(function (i, val) {
					var selected = "";
					if (val["id_sub_area"] == <?php echo empty($id_sub_area)?0:$id_sub_area; ?>) {
						selected = "selected";
						$("#sub_areas").removeClass('bgc-granada');
						$("#sub_areas").removeClass('color-error');
					}
					$('#sub_areas').append('<option value='+val["id_sub_area"]+' '+selected+'>'+val["sub_area"]+'</option>');
				})
			});
		});
		$("#niveles").on('click change blur',function() {
			var nivel = $(this).val();
			if (nivel < 3) {
				$("#tit").hide();
				$("#inst_ed").hide();
				$("#esp").hide();
				$("#area_con").hide();
				$("#subarea").hide();
			} else if (nivel == 3) {
				$("#tit").show();
				$("#inst_ed").show();
				$("#esp").hide();
				$("#area_con").show();
				$("#subarea").show();
			} else {
				$("#tit").show();
				$("#inst_ed").show();
				if ($("#areas").val() ==9) {
					$("#esp").show();
				} else {
					$("#esp").hide();
				}
				$("#area_con").show();
				$("#subarea").show();
			}
		});
		$('#cargar_cedula,#img_cedula,#rif,#cargar_rif,#img_rif,#cargar_foto,#img_foto,#cargar_titulo,#img_titulo,#niveles,#estatus,#institucion_educativa,#especialidad,#areas,#sub_areas').on('click change blur keyup', function(e) {
			console.log($(this).val());
			if($(this).val() == '') {
				$(this).addClass("bgc-granada");
				$(this).addClass("color-error");
			} else {
				$(this).removeClass("bgc-granada");
				$(this).removeClass("color-error");			
			}
			if (verificar()) {
				$("#aceptar").show();
			} else {
				$("#aceptar").hide();
			}
			if ($(this).attr('id')=="rif") {
				if (e.type=='keyup') {
					var datos = new String($(this).val());
					datos = datos.toUpperCase(datos);
					if (datos.length > 10) {
						datos = datos.substr(0,10);				
					} 
					$(this).val(datos);
				} else if (e.type == 'blur') {
					var rif = $(this).val().trim();
					var mensaje ="";
					if (rif.length == 0 && mensaje.length == 0) {
						mensaje = "El RIF no puede estar vacio";
					}
					if (rif.length > 0 && rif.length < 10 && mensaje.length == 0) {
						mensaje = "El RIF debe tener 10 caracteres";
					}
					if (rif.substr(0,1) != 'V' && rif.substr(0,1) != 'E') {
						mensaje = "El RIF comenzar con las letras V o E";
					}
					if (isNaN(rif.substr(1,9))) {
						mensaje = "Los 9 dígitos siguientes a la primera letra del RIF deben ser números";	
					}
					var existe = false;
					$.ajax({
						url: 'verificar_rif',
						type: 'post',
						data: {rif: rif},
					})
					.done(function(data) {
						if (data==1) {
							mensaje = "El rif ya esxiste en la base de datos";
							if (mensaje.length > 0) {
								$($("#rif")).addClass("bgc-granada");
								$($("#rif")).addClass("color-error");
								$($("#rif")).val(mensaje);
							} else {
								$($("#rif")).removeClass("bgc-granada");
								$($("#rif")).removeClass("color-error");
							}			
						}
					});			
					if (mensaje.length > 0) {
						$(this).addClass("bgc-granada");
						$(this).addClass("color-error");
						$(this).val(mensaje);
					} else {
						$(this).removeClass("bgc-granada");
						$(this).removeClass("color-error");
					}				
				}
			}
			if ($(this).attr('id')=='cargar_cedula') {
				if (e.type=='change') {
					documento1("cedula");
				}
			}
			if ($(this).attr('id')=='cargar_rif') {
				if (e.type=='change') {
					documento1("rif");
				}
			}
			if ($(this).attr('id')=='cargar_foto') {
				if (e.type=='change') {
					documento1("foto");

				}
			}
			if ($(this).attr('id')=='niveles') {
				if(e.type=="change") {
					if (isNaN($(this).val())) {
						$(this).addClass("bgc-granada");
						$(this).addClass("color-error");
					} else {
						$(this).removeClass("bgc-granada");
						$(this).removeClass("color-error");
					}	
				}
			}
			if ($(this).attr('id')=='estatus') {
				if(e.type=="change") {
					if (isNaN($(this).val())) {
						$(this).addClass("bgc-granada");
						$(this).addClass("color-error");
					} else {
						$(this).removeClass("bgc-granada");
						$(this).removeClass("color-error");
					}	
				}
			}
			if($(this).attr('id')=='institucion_educativa' && ($('#niveles').val()==3 || $("#niveles").val()==4)) {
				if(e.type=="change") {
					if (isNaN($(this).val())) {
						$(this).addClass("bgc-granada");
						$(this).addClass("color-error");
					} else {
						$(this).removeClass("bgc-granada");
						$(this).removeClass("color-error");
					}	
				}
			}
			if($(this).attr('id')=='cargar_titulo' && ($('#niveles').val()==3 || $("#niveles").val()==4)) {
				if (e.type=='change') {
					documento1("titulo");
				}
			}
			if ($("#especialidad option").length > 0){
				if ($(this).attr('id')=='especialidad' && $("#niveles").val()==4) {
					if(e.type=="change") {
						if (isNaN($(this).val())) {
							$(this).addClass("bgc-granada");
							$(this).addClass("color-error");
						} else {
							$(this).removeClass("bgc-granada");
							$(this).removeClass("color-error");
						}	
					}
				}
			}
			if ($(this).attr('id')=='areas' && $("#niveles").val()==4) {
				if(e.type=="change") {
					if (isNaN($(this).val())) {
						$(this).addClass("bgc-granada");
						$(this).addClass("color-error");
					} else {
						$(this).removeClass("bgc-granada");
						$(this).removeClass("color-error");
					}	
				}
			}
			if ($(this).attr('id')=='sub_areas' && $("#niveles").val()==4) {
				if(e.type=="change") {
					if (isNaN($(this).val())) {
						$(this).addClass("bgc-granada");
						$(this).addClass("color-error");
					} else {
						$(this).removeClass("bgc-granada");
						$(this).removeClass("color-error");
					}	
				}
			}
		});
$("#aceptar").on('click',function() {
	$.each($(":text"), function() {
		var cont0 = $(this).val();
		cont1 = cont0.replace(new RegExp(/'/, 'g'), "");
		$(this).val(cont1);
	});
	$.each($("textarea"), function() {
		var cont0 = $(this).val();
		cont1 = cont0.replace(new RegExp(/'/, 'g'), "");
		$(this).val(cont1);
	});	
	var cedula = $("#cedula").val();
	var rif = $("#rif").val();
	var niveles = $("#niveles").val();
	var estatus = $("#estatus").val();
	var institucion_educativa = $("#institucion_educativa").val();
	var especialidad = $("#especialidad").val();
	var areas = $("#areas").val();
	var sub_areas = $("#sub_areas").val();
	var img_cedula = $("#img_cedula").html().length==10?0:1;
	var img_cedula = $("#img_cedula").html().length==10?0:1;
	var img_rif = $("#img_rif").html().length==10?0:1;
	var img_foto = $("#img_foto").html().length==10?0:1;
	var img_titulo = $("#img_titulo").html().length==10?0:1;
	console.log("pancho");
	if (<?php echo count($perfil); ?> > 0) {
		var url="actualizar_perfl_investigador";
		titulo_registro="PERFIL ACTUALIZADO";
		mensaje_registro="Se ha actualizado exitosamente el perfil del investigador; ahora será redirigido para completar el perfil profesional; para ello presione el siguiente enlace: <a href ='http://pni/perfil/perfil_profesional' class='casfaltohumedo'>http://pni/perfil/perfil_profesional</a>";
		titulo_error="ERROR AL ACTUALIZAR";
		mensaje_error="Ha ocurrido un error al tratar de actualizar el perfil del investigador";
	} else {
		var url="agregar_perfl_investigador";
		titulo_registro="PERFIL REGISTRADO";
		mensaje_registro="Se ha registrado exitosamente el perfil del investigador; ahora será redirigido para completar el perfil profesional; para ello presione el siguiente enlace: <a href ='http://pni/perfil/perfil_profesional'>http://pni/perfil/perfil_profesional</a>";
		titulo_error="ERROR AL REGISTRAR";
		mensaje_error="Ha ocurrido un error al tratar de registrar el perfil del investigador";
	}
	$.ajax({
		url: url,
		type: 'post',
		data: {cedula: cedula,rif:rif,niveles:niveles,estatus:estatus,institucion_educativa:institucion_educativa,especialidad:especialidad,areas:areas,sub_areas:sub_areas,img_cedula:img_cedula,img_rif:img_rif,img_foto:img_foto,img_titulo:img_titulo},
	})
	.done(function(data) {
		swal(titulo_registro,mensaje_registro,"success");
	})
	.fail(function() {
		swal(titulo_error,mensaje_error,"error");
	});
});
$("#recargar_cedula").on("click",function() {
	documento2("cedula");
});
$("#recargar_rif").on("click",function() {
	documento2("rif");
});
$("#recargar_foto").on("click",function() {
	documento2("foto");
});
$("#recargar_titulo").on("click",function() {
	documento2("titulo");
});
function documento1(tipo) {
	var file_data = $("#cargar_"+tipo).prop("files")[0];
	var form_data = new FormData();
	form_data.append("file",file_data);
	switch (tipo) {
		case "cedula":
		$("#porc_cedula").show();
		break;
		case "rif":
		$("#porc_rif").show();
		break;
		case "foto":
		$("#porc_foto").show();
		break;
		case "titulo":
		$("#porc_titulo").show();
		break;
	}
	$.ajax({
		xhr: function() {
			var xhr = new window.XMLHttpRequest();
			xhr.upload.addEventListener("progress", function(evt) {
				if (evt.lengthComputable) {
					var percentComplete = (evt.loaded / evt.total) * 100;
				}
			}, false);
			return xhr;
		},
		url:"<?php echo base_url(); ?>perfil/cargar_documento1/"+tipo,
		method:"POST",
		data:form_data,
		contentType: false,
		cache: false,
		processData:false,
		success:function(data) {
			switch (tipo) {
				case "cedula":
				$("#porc_cedula").hide();
				break;
				case "rif":
				$("#porc_rif").hide();
				break;
				case "foto":
				$("#porc_foto").hide();
				break;
				case "titulo":
				$("#porc_titulo").hide();
				break;
			}
			if (data.indexOf("img") > -1) {
				if (data !=="img") {
					if (tipo == "foto") {
						$('#img_'+tipo).html(data);
					} else {
						$('#img_'+tipo).html('<input type="checkbox" checked class="check-grande" readonly style="margin-top:20%;">');
					}
				} else {
					$('#img_'+tipo).html('<input type="checkbox" checked class="check-grande" readonly style="margin-top:20%;">');
					swal("¡ARCHIVO SUBIDO EXITOSAMENTE","","success");
				}
			} else {
				if (data=="") {
					swal("¡ARCHIVO MAYOR A 2 Mb!","No se pudo subir el archivo, ya que el tamaño del  mismo debe ser menor o igual a 2 Mb","error");
				} else {
					swal("¡ARCHIVO NO PERMITIDO!","Sólo puede subir archivos PNG, JPG, JPEG o PDF","error");	
				}
			}
		}
	});				
	if ($("#cargar_"+tipo)[0].files.length < 1) {
		$("#cargar_"+tipo).addClass("bgc-granada");
		$("#cargar_"+tipo).addClass("color-error");
		$("#cargar_"+tipo).val(mensaje);
	} else {
		$("#cargar_"+tipo).removeClass("bgc-granada");
		$("#cargar_"+tipo).removeClass("color-error");
	}
}
function documento2(tipo) {
	Swal({
		title: 'Seleccionar archivo',
		showCancelButton: true,
		confirmButtonText: 'Cargar Archivo',
		cancelButtonText: 'Cancelar',
		input: 'file',
		onBeforeOpen: () => {
			$(".swal2-file").change(function () {
				var reader = new FileReader();
				reader.readAsDataURL(this.files[0]);
			});
		}
	}).then((file) => {
		if (file.value) {
			var file_data = $('.swal2-file')[0].files[0];
			var form_data = new FormData();
			form_data.append("file",file_data);
			switch (tipo) {
				case "cedula":
				$("#porc_cedula").show();
				break;
				case "rif":
				$("#porc_rif").show();
				break;
				case "foto":
				$("#porc_foto").show();
				break;
				case "titulo":
				$("#porc_titulo").show();
				break;
			}
			$.ajax({
				xhr: function() {
					var xhr = new window.XMLHttpRequest();
					xhr.upload.addEventListener("progress", function(evt) {
						if (evt.lengthComputable) {
							var percentComplete = (evt.loaded / evt.total) * 100;
						}
					}, false);
					return xhr;
				},
				url:"<?php echo base_url(); ?>perfil/cargar_documento1/"+tipo,
				method:"POST",
				data:form_data,
				contentType: false,
				cache: false,
				processData:false,
				success:function(data) {
					switch (tipo) {
						case "cedula":
						$("#porc_cedula").hide();
						break;
						case "rif":
						$("#porc_rif").hide();
						break;
						case "foto":
						$("#porc_foto").hide();
						break;
						case "titulo":
						$("#porc_titulo").hide();
						break;
					}
					if (data.indexOf("img") > -1) {
						if (data !=="img") {
							if (tipo == "foto") {
								$('#img_'+tipo).html(data);
							} else {
								$('#img_'+tipo).html('<input type="checkbox" checked class="check-grande" readonly style="margin-top:20%;">');
							}
						} else {
							$('#img_'+tipo).html('<input type="checkbox" checked class="check-grande" readonly style="margin-top:20%;">');
							
						} 
						swal("¡ARCHIVO SUBIDO EXITOSAMENTE","","success");
					} else {
						if (data=="") {
							swal("¡ARCHIVO MAYOR A 2 Mb!","No se pudo subir el archivo, ya que el tamaño del  mismo debe ser menor o igual a 2 Mb","error");
						} else {
							swal("¡ARCHIVO NO PERMITIDO!","Sólo puede subir archivos PNG, JPG, JPEG o PDF","error");	
						}
					}
				}
			});		
		}
	})	
}
function verificar() {
	var bachiller = 0;
	var tsu = 0
	var licenciado = 0;
	if ($('#img_cedula').html().length > 10) {
		bachiller++;
		tsu++;
		licenciado++;
	}
	if ($('#rif').val().length > 0) {
		bachiller++;
		tsu++;
		licenciado++;
	}
	if ($('#img_rif').html().length > 10) {
		bachiller++;
		tsu++;
		licenciado++;
	}
	if ($('#img_foto').html().length > 10) {
		bachiller++;
		tsu++;
		licenciado++;
	}
	if ($('#img_titulo').html().length > 0) {
		tsu++;
		licenciado++;
	}
	if ($('#estatus').val().length > 0) {
		bachiller++;
		tsu++;
		licenciado++;
	}	
	if ($('#niveles').val().length > 0) {
		bachiller++;
		tsu++;
		licenciado++;
	}
	if ($('#institucion_educativa').val().length > 0) {
		tsu++;
		licenciado++;
	}
	if ($("#especialidad").length) {
		if ($('#especialidad').val().length > 0) {
			licenciado++;
		}
	}
	if ($('#areas').val().length > 0) {
		licenciado++;
	}
	if ($("#sub_areas option").length > 1 && $('#sub_areas').val().length > 0) {
		licenciado++;
	}
	if ($("#especialidad option").length > 0) {
		licenciado++;
	}
	if ($("#niveles").val() < 3 && bachiller == 6) {
		return true;
	} else if($("#niveles").val() == 3 && tsu == 8) {
		return true;
	} else if($("#niveles").val() > 3 && licenciado == 11 && $("#areas").val != 9) {	
		return true;
	} else if($("#niveles").val() > 3 && licenciado == 12 && $("#esp").is(":visible")) {
		return true;
	} else {
		return false;
	}
}
</script>

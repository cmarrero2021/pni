<?php
if ($actual) {
	$previo = count($actual);
} else {
	$previo = 0;	
}
$fase = $actual[0]["id_fase"];
$publicado = 0;
if ($previo == 0) {
	$actual[0]["id_investigacion_actual"] = 0;
	$actual[0]["ci_investigador"] = 0;
	$actual[0]["titulo_investigacion"] = 0;
	$actual[0]["id_tipo_institucion"] = 0;
	$actual[0]["id_centro"] = 0;
	$actual[0]["id_linea_investigacion"] = 0;
	$actual[0]["resultado_investigacion"] = 0;
	$actual[0]["id_tipo_investigacion"] = 0;
	$actual[0]["id_fase"] = 0;
	$actual[0]["tiempo_investigacion"] = 0;
	$actual[0]["id_unidad_tiempo"] = 0;
	$actual[0]["id_com_etica"] = 0;
} else if ($actual[0]["id_fase"]  == 1) {
	$actual[0]["id_com_etica"] = 0;
	$actual[0]["id_inst_etica"] = 0;
	$actual[0]["d_inst_etica"] = 0;
} else if ($actual[0]["id_fase"]  == 2) {
	$actual[0]["tiempo_investigacion"] = 0;
	$actual[0]["id_unidad_tiempo"] = 0;
} else if ($actual[0]["id_fase"]  == 3) {	
	$actual[0]["tiempo_investigacion"] = 0;
	$actual[0]["id_unidad_tiempo"] = 0;	
	if ($actual[0]["publicado"]) {
		$publicado =1;
	}
}
if (!is_null($actual[0]["resultado_investigacion"])) {
	$actual[0]["resultado_investigacion"]=nl2br($actual[0]["resultado_investigacion"]);
}
if (!is_null($actual[0]["objetivo_investigacion"])) {
	$actual[0]["objetivo_investigacion"]=str_replace("\n","",$actual[0]["objetivo_investigacion"]);
}
if (!is_null($actual[0]["impacto_investigacion"])) {
	$actual[0]["impacto_investigacion"]=str_replace("\n","",$actual[0]["impacto_investigacion"]);
}
if (!is_null($actual[0]["enlace_publicacion"])) {
	$actual[0]["enlace_publicacion"]=str_replace("\n","",$actual[0]["enlace_publicacion"]);
}
$grupo_inv=str_replace("-", "", $grupo[0]["grupo"]);
?>
<body class="cuerpo-r">
	<img src="<?php echo base_url(); ?>assets/img/logo_pni-01.png" class="logo-pni">
	<div class="container margen-login">
		<form id="frm_registro">
			<!-- INVESTIGACIÓN ACTUAL -->
			<label class="verdeclaro"style="font-size:150%;">GESTIÓN DE LA INVESTIGACIÓN ACTUAL (CARGAR SÓLO SI ESTÁ RELACIONADA A <?php echo $grupo_inv; ?>)</label>
			<hr>
			<?php include "seccion_investigacion_actual.php"; ?>
		</form>
	</div>
</body>
<script type="text/javascript">
	$(document).ready(function() {
		var grupo_inv;
		grupo_inv = '<?php echo $grupo_inv; ?>';
		alert(grupo_inv);
		switch(grupo_inv) {
			case 'COVID-19':
			var documento = "<?php echo base_url(); ?>assets/documentos/ficha_proyecto-covid.doc";
			break;
			case 'CLACSO':
			var documento = "<?php echo base_url(); ?>assets/documentos/ficha_proyecto-clacso.doc";
			break;
		}
		$(".vacio").attr('href', documento);

		if (<?php echo $previo; ?>>0) {
			$("#pdf").show();
		}
		if (<?php echo $publicado; ?>== 1) {
			$("input").attr('disabled',false);
			$('#chk_pub').prop('checked', true).change()
			$("#cpub").show();
			$("#ccfi").hide();
			$("#etq_enla_pub").show();
			$("#enlace").val("<?php echo $actual[0]['enlace_publicacion']; ?>");
			$("#enlace").removeClass("bgc-granada");
			$("#enlace").removeClass("color-error");
			$("input").attr('disabled',true);
			$("#pdf").attr('disabled',false);
		}
		if (<?php echo $previo; ?> == 0) {
			$("textarea").val('');
		}
		$('#tiempo_investigacion').on('keydown keypress',function(e){
			if(e.key.length === 1){
				if($(this).val().length < 3 && !isNaN(parseFloat(e.key))){
					$(this).val($(this).val() + e.key);
				}
				return false;
			}
		});	
		$('#tiempo_investigacione').on('keydown keypress',function(e){
			if(e.key.length === 1){
				if($(this).val().length < 3 && !isNaN(parseFloat(e.key))){
					$(this).val($(this).val() + e.key);
				}
				return false;
			}
		});	
		$("#ced_res").removeClass("bgc-granada");
		$("#nom_res").removeClass("bgc-granada");
		$("#ape_res").removeClass("bgc-granada");
		$("#ced_res").removeClass("color-error");
		$("#nom_res").removeClass("color-error");
		$("#ape_res").removeClass("color-error");
		$(this).removeClass("bgc-granada");
		$(this).removeClass("color-error");
		$("#titulo_investigacion").on("keyup",function() {
			var datos = new String($(this).val());
			datos = datos.toUpperCase(datos);
			$(this).val(datos);
		});
		if (<?php echo $previo; ?> > 0 && <?php echo $actual[0]["id_fase"]; ?> == 3) {
			$("#resul_invc").text("<?php echo $actual[0]['resultado_investigacion']; ?>");
			$("#impacto").text("<?php echo $actual[0]['impacto_investigacion']; ?>");
			$("#resul_invc").removeClass("bgc-granada");
			$("#resul_invc").removeClass("color-error");
			$("#impacto").removeClass("bgc-granada");
			$("#impacto").removeClass("color-error");
		}
		$('#com_etica').append('<option value=""></option>');
		$('#com_etica').append('<option value=1>NO</option>');
		$('#com_etica').append('<option value=2>INSTITUCIÓN INVESTIGACION</option>');
		$('#com_etica').append('<option value=3>INSTITUCIÓN EDUCATIVA</option>');
		$('#com_etica').append('<option value=4>INSTITUCIÓN SALUD</option>');
		if(<?php echo $previo; ?> > 0) {
			$("#com_etica").removeClass("bgc-granada");
			$("#com_etica").removeClass("color-error");
			$('#com_etica').val(<?php echo $actual[0]["id_com_etica"]; ?>);
			if (<?php echo $actual[0]["id_com_etica"]; ?> > 1) {
				$.ajax({
					url: "get_insti_etica",
					type: 'post',
					dataType: 'json',
					data: {
						"id_tipo_etica":"<?php echo $actual[0]["id_com_etica"]; ?>",
						"id_centro":"<?php echo $actual[0]["id_centro"]; ?>"
					}
				})
				.done(function(data) {
					var fila = '<option value='+data[0]["id_institucion"]+'  selected>'+data[0]["institucion"]+'</option>'
					$("#inst_etica").append(fila);
					$("#inst_etica").removeClass("bgc-granada");
					$("#inst_etica").removeClass("color-error");
				});
			}
		}
		$('#com_eticac').append('<option value=""></option>');
		$('#com_eticac').append('<option value=1>NO</option>');
		$('#com_eticac').append('<option value=2>INSTITUCIÓN INVESTIGACION</option>');
		$('#com_eticac').append('<option value=3>INSTITUCIÓN EDUCATIVA</option>');
		$('#com_eticac').append('<option value=4>INSTITUCIÓN SALUD</option>');
		if (<?php echo $actual[0]["id_fase"]; ?> == 3){
			$('#com_eticac').val(<?php echo $actual[0]["id_com_etica"]; ?>);
			$("#com_eticac").removeClass("bgc-granada");
			$("#com_eticac").removeClass("color-error");
			$.ajax({
				url: "get_insti_etica",
				type: 'post',
				dataType: 'json',
				data: {
					"id_tipo_etica":<?php echo $actual[0]["id_com_etica"]; ?>,
					"id_centro":<?php echo $actual[0]["id_centro"]; ?>
				}
			})
			.done(function(data) {
				var fila = '<option value='+data[0]["id_institucion"]+'  selected>'+data[0]["institucion"]+'</option>'
				$("#inst_eticac").append(fila);
				$("#inst_eticac").removeClass("bgc-granada");
				$("#inst_eticac").removeClass("color-error");
				$("#in_etc").show();
				$("#inst_eticac").show();
			})
			.fail(function(data) {
				// console-log("error");
				// consolelog(data);
			});
			
		}
		$('#ced_res').on('keydown keypress',function(e){
			if(e.key.length === 1){
				if($(this).val().length < 8 && !isNaN(parseFloat(e.key))){
					$(this).val($(this).val() + e.key);
				}
				return false;
			}
		});
		$('#nom_res').keyup(function() {
			var datos = new String($('#nom_res').val());
			datos = datos.toUpperCase(datos);
			$('#nom_res').val(datos);
		})
		$('#ape_res').keyup(function(e) {
			var datos = new String($('#ape_res').val());
			datos = datos.toUpperCase(datos);
			$('#ape_res').val(datos);
		})
		$("#btn-gRes").on("click",function() {
			var cant_filas = $("#responsables > tbody >tr").length;
			var fila_nueva = "<tr id='fila_"+cant_filas+"'><td>"+$("#ced_res").val()+"</td><td>"+$("#nom_res").val()+"</td><td>"+$("#ape_res").val()+"</td>"+"<td id='btn-bRes"+cant_filas+"'><i class='fa fa-trash fa-2 cdanger' aria-hidden='true' style='cursor:pointer;' id='pepe'"+cant_filas+" onclick='eliminar_fila("+cant_filas+");'></i></td></tr>";
			$("#responsables tbody").append(fila_nueva);
			$("#ced_res").val('');
			$("#nom_res").val('');
			$("#ape_res").val('');
			$("#nom_res").prop('readonly',false);
			$("#ape_res").prop('readonly',false);
			$("#ced_res").focus();
		});
		$('#ced_res').on('blur',function() {
			var cedula = $('#ced_res').val();
			$.ajax({
				url: 'buscar_responsables',
				type: 'post',
				dataType: 'json',
				data: {cedula: cedula},
			})
			.done(function(data) {
				$("#nom_res").val(data["pnombre"]);
				$("#ape_res").val(data["papellido"]);
				if (data["pnombre"]=="") {
					$("#nom_res").prop("readonly",false);
					$("#ape_res").prop("readonly",false);
				} else {
					$("#nom_res").prop("readonly",true);
					$("#ape_res").prop("readonly",true);
				}
			});
		});
		$("#fecha_culminacion").on("change keyup click blur", function() {
			if ($(this).val().length > 0) {
				$(this).removeClass("bgc-granada");
				$(this).removeClass("color-error");
			} else {
				$(this).addClass("bgc-granada");
				$(this).addClass("color-error");
			}
		});
		$('#cerrar').on('click', function () {
			$("#userModal textarea").each(function() {
				$(this).val('');
				$(this).addClass("bgc-granada");
				$(this).addClass("color-error");
			});
			$("#userModal select").each(function() {
				$(this).val('');
				$(this).addClass("bgc-granada");
				$(this).addClass("color-error");
			});
			$("#usuarios_form input:text").each(function() {
				$(this).val('');
				$(this).addClass("bgc-granada");
				$(this).addClass("color-error");
			});
			$("#usuarios_form input:date").each(function() {
				$(this).val('');
				$(this).addClass("bgc-granada");
				$(this).addClass("color-error");
			});
			$("#userModal input:checkbox").each(function() {
				$(this).bootstrapToggle('off');
				$(this).prop("checked", false);
			});
			$("input[type=date]").val("");
		})
		$("#cuantas_investigaciones").on("click change blur",function() {
			if($(this).val()=='' || $(this).val()==1) {
				$("#tabla").hide();
			} else {
				$("#tabla").show();
			}
		});
		$.ajax({
			url: 'select_sencillo',
			type: 'post',
			dataType: 'json',
			data: {
				"tabla":"tiempo_investigacion",
				"id":"id_tiempo_investigacion",
				"valor":"tiempo_investigacion"
			}
		})
		.done(function(data) {
			select_sencillo(data,"tiempo_investigacion","id_tiempo_investigacion","tiempo_investigacion");
		});
		$.ajax({
			url: 'select_sencillo',
			type: 'post',
			dataType: 'json',
			data: {
				"tabla":"tipo_institucion",
				"id":"id_tipo_institucion",
				"valor":"tipo_institucion"
			}
		})
		.done(function(data) {
			select_sencillo(data,"tip_inst","id_tipo_institucion","tipo_institucion");
		});

		$.ajax({
			url: 'select_sencillo',
			type: 'post',
			dataType: 'json',
			data: {
				"tabla":"tipo_investigacion",
				"id":"id_tipo_investigacion",
				"valor":"tipo_investigacion"
			}
		})
		.done(function(data) {
			select_sencillo(data,"tipo_inv","id_tipo_investigacion","tipo_investigacion");
		});
		$.ajax({
			url: 'select_sencillo',
			type: 'post',
			dataType: 'json',
			data: {
				"tabla":"fases",
				"id":"id_fase",
				"valor":"fase"
			}
		})
		.done(function(data) {
			select_sencillo(data,"fase_inv","id_fase","fase");
		});

		$.ajax({
			url: 'select_sencillo',
			type: 'post',
			dataType: 'json',
			data: {
				"tabla":"cantidad_investigaciones",
				"id":"id_cantidad_investigacion",
				"valor":"cantidad_investigacion"
			}
		})
		.done(function(data) {
			select_sencillo(data,"cuantas_investigaciones","id_cantidad_investigacion","cantidad_investigacion");
		});
		$.ajax({
			url: 'select_sencillo',
			type: 'post',
			dataType: 'json',
			data: {
				"tabla":"politicas_publicas",
				"id":"id_politica_publica",
				"valor":"politica_publica"
			}
		})
		.done(function(data) {
			select_sencillo(data,"pol_pub","id_politica_publica","politica_publica");
		});
		$("#fase_inv").on("change",function() {
			$("#sal_etica").hide();
			$("#in_et").hide();
			var fase = $(this).val();
			switch (fase) {
				case "1":
				$("#fase_diseno").show();
				$("#fase_ejecucion").hide();
				$("#fase_culminacion").hide();
				$("#cobjetivos_inv").hide();
				$("#cresul_inv").show();
				$("#pub").hide();
				$("#cpub").hide();
				$("#ftici").hide();
				$("#tiempoc").hide();
				$("#lbl_resul_inv").text("Resultados esperados de la investigación");
				$("#resul_inv").attr("placeholder","Resultados esperados de la investigación");			
				$("#lbl_obj_inv").text("Objetivos de la investigación");
				$("#objetivos_inv").attr("placeholder","Introduzca los objetivos de la investigación");
				if (<?php echo $previo; ?> > 0) {
					$("#des_fichad").hide();
					$("#car_fichad").hide();
					$("#chk_fichad").show();
				} else {
					$("#des_fichad").show();
					$("#car_fichad").show();
					$("#chk_fichad").hide();
				}
				break;
				case "2":
				$("#fase_diseno").hide();
				$("#fase_ejecucion").show();
				$("#fase_culminacion").hide();
				$("#cobjetivos_inv").show();
				$("#objetivos_inv").show();
				$("#cresul_inv").show();
				$("#tiempoc").hide();
				$("#lbl_resul_inv").text("Objetivos de la investigación");
				$("#resul_inv").attr("placeholder","Introduzca los objetivos de la investigación");
				$("#lbl_obj_inv").text("Resultados esperados de la investigación ");
				$("#objetivos_inv").attr("placeholder","Introduzca los resultados esperados de la investigación");	
				$("#pub").hide();
				$("#cpub").hide();
				$("#ftici").show();
				$("#com_etica").show();
				if (<?php echo $previo; ?> > 0) {
					if (<?php echo $actual[0]["id_com_etica"]; ?> > 1) {
						$("#in_et").show();
					}
					$("#des_fic_inv_eje").hide();
					$("#car_fic_inv_eje").hide();
					$("#car_doc_inv_eje").hide();
					$("#chk_fichae").show();
					$("#chk_invesd").show();
					$("#cobjetivos_inv").removeClass("col-md-3");
					$("#cobjetivos_inv").addClass("col-md-8");
				}
				$("#tiempoe").hide();
				$("#tiempoc").hide();
				// $("#des_fic_inv_eje").hide();
				// $("#car_fic_inv_eje").hide();
				// $("#car_doc_inv_eje").hide();
				// $("#chk_fichae").show();
				// $("#chk_invesd").show();
				// $("#cobjetivos_inv").removeClass("col-md-3");
				// $("#cobjetivos_inv").addClass("col-md-8");
				break;
				case "3":
				$("#fase_diseno").hide();
				$("#fase_ejecucion").hide();
				$("#fase_culminacion").show();
				$("#cresul_inv").hide();
				$("#pub").show();
				$("#ftici").hide();
				// $("#tiempoc").show();
				$("#tiempoc").hide();
				$("#lbl_resul_inv").text("Resultados esperados de la investigación");
				$("#resul_inv").attr("placeholder","Resultados esperados de la investigación");			
				$("#lbl_obj_inv").text("Objetivos de la investigación");
				$("#objetivos_inv").attr("placeholder","Introduzca los objetivos de la investigación");	
				break;
				default:
				$("#fase_diseno").hide();
				$("#fase_ejecucion").hide();
				$("#fase_culminacion").hide();
				$("#cresul_inv").hide();
				$("#pub").hide();
				$("#cpub").hide();
				$("#ftici").hide();
				$("#tiempoc").hide();
				$("#lbl_resul_inv").text("Resultados esperados de la investigación");
				$("#resul_inv").attr("placeholder","Resultados esperados de la investigación");			
				$("#lbl_obj_inv").text("Objetivos de la investigación");
				$("#objetivos_inv").attr("placeholder","Introduzca los objetivos de la investigación");					
				break;
			}
		})
		$("#tip_inst").on("change",function(){
			var tipo = $(this).val();
			$("#cen_salud").find("option").remove();
			switch(tipo) {
				case "1":
				$("#salud").show();
				$("#comunas").hide();
				$("#no_salud").hide();
				break;
				case "2":
				$.ajax({
					url: 'select_sencillo',
					type: 'post',
					dataType: 'json',
					data: {
						"tabla":"instituciones_investigacion",
						"id":"id_institucion_investigacion",
						"valor":"nombre_institucion_investigacion",
						"orden":1
					}
				})
				.done(function(data) {
					select_sencillo(data,"cen_salud","id_institucion_investigacion","nombre_institucion_investigacion");
				});				
				$("#salud").hide();
				$("#comunas").hide();
				$("#no_salud").show();
				$("#otros").text("Institución Investigación");
				break;
				case "3":
				$.ajax({
					url: 'select_sencillo',
					type: 'post',
					dataType: 'json',
					data: {
						"tabla":"instituciones_educativas",
						"id":"id_institucion_educativa",
						"valor":"nombre_institucion_educativa",
						"orden":1
					}
				})
				.done(function(data) {
					select_sencillo(data,"cen_salud","id_institucion_educativa","nombre_institucion_educativa");
				});	
				$("#salud").hide();
				$("#comunas").hide();
				$("#no_salud").show();
				$("#otros").text("Institución Educativa");
				break;		
				case "4":
				$("#salud").hide();
				$("#comunas").show();
				$("#no_salud").hide();
				break;
			}
		})
		$("#chk_pub").on('change', function() {
			if($(this).prop("checked")) {
				$("#cpub").show();
			} else {
				$("#cpub").hide();
			}
		});
		$("input:text").on("change keyup ",function(e) {
			if ($(this).val() == "" && $(this).attr("id") !="nom_res") {
				$(this).addClass("bgc-granada");
				$(this).addClass("color-error");
			} else {
				$(this).removeClass("bgc-granada");
				$(this).removeClass("color-error");	
			}
		});
		$("#enlace").on("keyup",function() {
			var datos = new String($(this).val());
			datos = datos.toLowerCase(datos);
			$(this).val(datos);
		});
		$("textarea").on("change keyup ",function(e) {
			if ($(this).val() == "") {
				$(this).addClass("bgc-granada");
				$(this).addClass("color-error");		
			} else {
				$(this).removeClass("bgc-granada");
				$(this).removeClass("color-error");		
			}
			var datos = new String($(this).val());
			datos = datos.toUpperCase(datos);
			$(this).val(datos);
		});
		$.ajax({
			url: 'select_sencillo',
			type: 'post',
			dataType: 'json',
			data: {
				"tabla":"tipo_comuna",
				"id":"id_tipo_comuna",
				"valor":"tipo_comuna"
			}
		})
		.done(function(data) {
			select_sencillo(data,"tip_com","id_tipo_comuna","tipo_comuna");
		});
		$.ajax({
			url: 'select_sencillo',
			type: 'post',
			dataType: 'json',
			data: {
				"tabla":"tipo_comuna",
				"id":"id_tipo_comuna",
				"valor":"tipo_comuna"
			}
		})
		.done(function(data) {
			select_sencillo(data,"tip_comcol","id_tipo_comuna","tipo_comuna");
		});
		if (<?php echo $previo; ?> >0) {
			if (<?php echo $actual[0]["id_tipo_institucion"]; ?> == 1) {
				var id_edo_sal = "";
				var id_mun_sal = "";
				var id_par_sal = "";
				var val_edo_sal = "";
				var val_mun_sal = "";
				var val_par_sal = "";
				var censal = <?php echo $actual[0]["id_centro"]; ?>;
				$.ajax({
					url: 'get_edo_mun_par_por_centro',
					type: 'post',
					dataType: 'json',
					data: {id_centro: censal},
				})
				.done(function(datos) {
					id_edo_sal = datos[0]["cod_estado"];
					id_mun_sal = datos[0]["cod_municipio"];
					id_par_sal = datos[0]["cod_parroquia"];
					val_edo_sal = datos[0]["nombre_estado"];
					val_mun_sal = datos[0]["nombre_municipio"];
					val_par_sal = datos[0]["nombre_parroquia"];
					var aGeo = new Array(3);
					aGeo[0]=new Array(3);
					aGeo[1]=new Array(3);
					aGeo[2]=new Array(3);
					aGeo[0]["control"] = "est_salud";
					aGeo[0]["id"] = id_edo_sal;
					aGeo[0]["valor"] = val_edo_sal;
					aGeo[1]["control"] = "mun_salud";
					aGeo[1]["id"] = id_mun_sal;
					aGeo[1]["valor"] = val_mun_sal;		
					aGeo[2]["control"] = "par_salud";
					aGeo[2]["id"] = id_par_sal;
					aGeo[2]["valor"] = val_par_sal;
					for (n=0;n<aGeo.length;n++) {
						control = aGeo[n];
						$('#'+aGeo[n]["control"]).find("option").remove();
						$('#'+aGeo[n]["control"]).append('<option value=""></option>');
						var selected = " selected ";
						$('#'+aGeo[n]["control"]).append('<option value='+aGeo[n]["id"]+' '+selected+'>'+aGeo[n]["valor"]+'</option>');
						$("#"+aGeo[n]["control"]).removeClass('bgc-granada');
						$("#"+aGeo[n]["control"]).removeClass('color-error');
					}
				});
				$.ajax({
					url: 'get_nombre_salud',
					type: 'post',
					dataType: 'json',
					data: {id_centro: censal},
				})
				.done(function(data) {
					$('#centro').find("option").remove();
					$('#centro').append('<option value=""></option>');
					var selected = " selected ";
					$('#centro').append('<option value='+cen_salud+' '+selected+'>'+data[0]["nombre_centro"]+'</option>');
					$('#centro').removeClass('bgc-granada');
					$('#centro').removeClass('color-error');
				});
			}
		}
		$.ajax({
			url: 'select_sencillo',
			type: 'post',
			dataType: 'json',
			data: {
				"tabla":"estados_salud",
				"id":"cod_estado",
				"valor":"nombre_estado"
			}
		})
		.done(function(data) {
			select_sencillo(data,"est_salud","cod_estado","nombre_estado");
		});
		if (<?php echo $previo; ?> ==0) {
			var estado = $(this).val();
			$.ajax({
				url: 'get_munsalud',
				type: 'post',
				dataType: 'json',
				data: {"estado": estado},
			})
			.done(function(data) {
				$('#mun_salud').find('option').remove();
				select_sencillo(data,"mun_salud","cod_municipio","nombre_municipio");
			});
		}
		$.ajax({
			url: 'select_sencillo',
			type: 'post',
			dataType: 'json',
			data: {
				"tabla":"estados_salud",
				"id":"cod_estado",
				"valor":"nombre_estado"
			}
		})
		.done(function(data) {
			select_sencillo(data,"est_etica","cod_estado","nombre_estado");
		});
		$("select").on("click change ",function(e) {
			if ($(this).val() == "") {
				$(this).addClass("bgc-granada");
				$(this).addClass("color-error");		
			} else {
				$(this).removeClass("bgc-granada");
				$(this).removeClass("color-error");		
			}
			switch ($(this).attr('id')) {
				case "est_salud":
				if (<?php echo $previo; ?> == 0){
					var estado = $(this).val();
					$.ajax({
						url: 'get_munsalud',
						type: 'post',
						dataType: 'json',
						data: {"estado": estado},
					})
					.done(function(data) {
						$('#mun_salud').find('option').remove();
						select_sencillo(data,"mun_salud","cod_municipio","nombre_municipio");
					});
				}
				break;
				case "mun_salud":
				var estado = $("#est_salud").val();
				var municipio = $("#mun_salud").val();
				$.ajax({
					url: 'get_parsalud',
					type: 'post',
					dataType: 'json',
					data: {"estado": estado,"municipio": municipio},
				})
				.done(function(data) {
					$('#par_salud').find('option').remove();
					select_sencillo(data,"par_salud","cod_parroquia","nombre_parroquia");
				});
				break;
				case "par_salud":
				var estado = $("#est_salud").val();
				var municipio = $("#mun_salud").val();
				var parroquia = $("#par_salud").val();
				$.ajax({
					url: 'get_censalud',
					type: 'post',
					dataType: 'json',
					data: {"estado": estado,"municipio": municipio,"parroquia":parroquia},
				})
				.done(function(data) {
					$('#centro').find('option').remove();
					select_sencillo(data,"centro","cod_centro_salud","nombre_centro");
				});		
				break;
				case "est_etica":
				var estado = $(this).val();
				$.ajax({
					url: 'get_munsalud',
					type: 'post',
					dataType: 'json',
					data: {"estado": estado},
				})
				.done(function(data) {
					$('#mun_salud').find('option').remove();
					select_sencillo(data,"mun_etica","cod_municipio","nombre_municipio");
				});
				break;
				case "mun_etica":
				var estado = $("#est_etica").val();
				var municipio = $("#mun_etica").val();
				$.ajax({
					url: 'get_parsalud',
					type: 'post',
					dataType: 'json',
					data: {"estado": estado,"municipio": municipio},
				})
				.done(function(data) {
					$('#par_salud').find('option').remove();
					select_sencillo(data,"par_etica","cod_parroquia","nombre_parroquia");
				});
				break;
				case "par_etica":
				var estado = $("#est_etica").val();
				var municipio = $("#mun_etica").val();
				var parroquia = $("#par_etica").val();
				$.ajax({
					url: 'get_censalud',
					type: 'post',
					dataType: 'json',
					data: {"estado": estado,"municipio": municipio,"parroquia":parroquia},
				})
				.done(function(data) {
					select_sencillo(data,"centro_etica","cod_centro_salud","nombre_centro");
				});		
				break;			
				case "tip_comcol":
				var tipo = $("#tip_comcol").val();
				$.ajax({
					url: 'get_comuna',
					type: 'post',
					dataType: 'json',
					data: {"tipo": tipo},
				})
				.done(function(data) {
					$('#com_col').find('option').remove();
					select_sencillo(data,"com_col","id_comuna","comuna");
				});	
				break;
				// case "tip_com":
				// var tipo = $("#tip_com").val();
				// $.ajax({
				// 	url: 'get_comuna',
				// 	type: 'post',
				// 	dataType: 'json',
				// 	data: {"tipo": tipo},
				// })
				// .done(function(data) {
				// 	$('#comuna').find('option').remove();
				// 	select_sencillo(data,"comuna","id_comuna","comuna");
				// });	
				// break;
				case "com_etica":
				var tipo = $("#com_etica").val();
				switch(tipo) {
					case "2":				
					if (<?php echo $previo; ?> == 0) {
						$("#inst_etica").find("option").remove();
						$("#sal_etica").hide();
						$("#in_et").show();				
						$.ajax({
							url: 'select_sencillo',
							type: 'post',
							dataType: 'json',
							data: {
								"tabla":"instituciones_investigacion",
								"id":"id_institucion_investigacion",
								"valor":"nombre_institucion_investigacion",
								"orden":1
							}
						})
						.done(function(data) {
							select_sencillo(data,"inst_etica","id_institucion_investigacion","nombre_institucion_investigacion",1);
						});
					}
					break;
					case "3":
					$("#sal_etica").hide();
					$("#in_et").show();
					$("#inst_etica").find("option").remove();
					$.ajax({
						url: 'select_sencillo',
						type: 'post',
						dataType: 'json',
						data: {
							"tabla":"instituciones_educativas",
							"id":"id_institucion_educativa",
							"valor":"nombre_institucion_educativa"
						}
					})
					.done(function(data) {
						select_sencillo(data,"inst_etica","id_institucion_educativa","nombre_institucion_educativa",1);
					});
					break;
					case "4":
					$("#sal_etica").show();
					$("#in_et").hide();
					break;
					default:
					$("#sal_etica").hide();
					$("#in_et").hide();
					break;
				}
				break;
				case "com_eticac":
				var tipo = $("#com_eticac").val();
				switch(tipo) {
					case "2":				
					$("#inst_eticac").find("option").remove();
					$("#sal_etica").hide();
					$("#in_etc").show();				
					$.ajax({
						url: 'select_sencillo',
						type: 'post',
						dataType: 'json',
						data: {
							"tabla":"instituciones_investigacion",
							"id":"id_institucion_investigacion",
							"valor":"nombre_institucion_investigacion",
							"orden":1
						}
					})
					.done(function(data) {
						select_sencillo(data,"inst_eticac","id_institucion_investigacion","nombre_institucion_investigacion",1);
					});
					break;
					case "3":
					$("#sal_etica").hide();
					$("#in_etc").show();
					$("#inst_eticac").find("option").remove();
					if (<?php echo $previo; ?> ==0) {
						$.ajax({
							url: 'select_sencillo',
							type: 'post',
							dataType: 'json',
							data: {
								"tabla":"instituciones_educativas",
								"id":"id_institucion_educativa",
								"valor":"nombre_institucion_educativa"
							}
						})
						.done(function(data) {
							select_sencillo(data,"inst_eticac","id_institucion_educativa","nombre_institucion_educativa",1);
						});
						
					}
					break;
					case "4":
					$("#in_etc").hide();
					break;
					default:
					$("#in_etc").hide();
					break;
				}			
			}
		});
});
$.ajax({
	url: 'select_sencillo',
	type: 'post',
	dataType: 'json',
	data: {
		"tabla":"lineas_presidenciales",
		"id":"id_lineas_presidenciales",
		"valor":"nombre_lineas_presidenciales"
	}
})
.done(function(data) {
	$("#lin_invp").find("option").remove();
	select_sencillo(data,"lin_invp","id_lineas_presidenciales","nombre_lineas_presidenciales");
});	

$.ajax({
	url: 'select_sencillo',
	type: 'post',
	dataType: 'json',
	data: {
		"tabla":"lineas_investigacion",
		"id":"id_linea_investigacion",
		"valor":"linea_investigacion"
	}
})
.done(function(data) {
	select_sencillo(data,"linea_investigacion","id_linea_investigacion","linea_investigacion");
});
$.ajax({
	url: 'select_sencillo',
	type: 'post',
	dataType: 'json',
	data: {
		"tabla":"tipo_investigacion",
		"id":"id_tipo_investigacion",
		"valor":"tipo_investigacion"
	}
})
.done(function(data) {
	select_sencillo(data,"tipo_investigacion","id_tipo_investigacion","tipo_investigacion");
});
$.ajax({
	url: 'select_sencillo',
	type: 'post',
	dataType: 'json',
	data: {
		"tabla":"fases",
		"id":"id_fase",
		"valor":"fase"
	}
})
.done(function(data) {
	select_sencillo(data,"fase","id_fase","fase");
});
$.ajax({
	url: 'select_sencillo',
	type: 'post',
	dataType: 'json',
	data: {
		"tabla":"unidades_tiempo",
		"id":"id_unidad_tiempo",
		"valor":"unidad_tiempo"
	}
})
.done(function(data) {
	select_sencillo(data,"unidad_tiempod","id_unidad_tiempo","unidad_tiempo");
});
$.ajax({
	url: 'select_sencillo',
	type: 'post',
	dataType: 'json',
	data: {
		"tabla":"unidades_tiempo",
		"id":"id_unidad_tiempo",
		"valor":"unidad_tiempo"
	}
})
.done(function(data) {
	select_sencillo(data,"unidad_tiempoc","id_unidad_tiempo","unidad_tiempo");
});
$.ajax({
	url: 'select_sencillo',
	type: 'post',
	dataType: 'json',
	data: {
		"tabla":"unidades_tiempo",
		"id":"id_unidad_tiempo",
		"valor":"unidad_tiempo"
	}
})
.done(function(data) {
	select_sencillo(data,"unidad_tiempoe","id_unidad_tiempo","unidad_tiempo");
});
var tipo_i = <?php echo $institucion["id_tipo_institucion"]; ?>;
switch (tipo_i) {
	case 2:
	var tabla = "instituciones_investigacion";
	var id = "id_institucion_investigacion";
	var valor = "abreviatura_institucion_investigacion";
	break;
	case 3:
	var tabla = "instituciones_educativas";
	var id = "id_institucion_educativa";
	var valor = "nombre_institucion_educativa";
	break;
	case 4:
	var tabla = "otras";
	var id = "id_otras";
	var valor = "nombre_otras";
	break;
}
$.ajax({
	url: 'select_sencillo',
	type: 'post',
	dataType: 'json',
	data: {
		"tabla":tabla,
		"id":id,
		"valor":valor
	}
})
.done(function(data) {
	select_sencillo(data,"centro",id,valor);
});
if (<?php echo $previo; ?> == 0){
	var tipo = <?php echo $actual[0]["id_tipo_institucion"]; ?>;
	$.ajax({
		url: 'get_comuna',
		type: 'post',
		dataType: 'json',
		data: {"tipo": tipo},
	})
	.done(function(data) {
		$('#comuna').find('option').remove();
		select_sencillo(data,"comuna","id_comuna","comuna");
	});	
} else {
	$.ajax({
		url: 'select_sencillo',
		type: 'post',
		dataType: 'json',
		data: {
			"tabla":"comunas",
			"id":"id_comuna",
			"valor":"comuna"
		}
	})
	.done(function(data) {
		select_sencillo(data,"comuna","id_comuna","comuna");
	});
}
function select_sencillo(data,control,id,valor) {
	$('#'+control).append('<option value=""></option>');
	if (<?php echo $previo; ?> > 0) {
		if (control =="cen_salud" && <?php echo $actual[0]["id_tipo_institucion"]; ?> ==2) {
			var id_institucion_investigacion = <?php echo $actual[0]["id_centro"]; ?>;
		} else if (control =="cen_salud" && <?php echo $actual[0]["id_tipo_institucion"]; ?> ==3) {
			var id_institucion_educativa = <?php echo $actual[0]["id_centro"]; ?>;
		}
		var  id_centro=<?php echo $actual[0]["id_centro"]; ?>;
		var id_linea_investigacion=<?php echo $actual[0]["id_linea_investigacion"]; ?>;
		var id_tipo_investigacion=<?php echo $actual[0]["id_tipo_investigacion"]; ?>;
		var id_tipo_institucion=<?php echo $actual[0]["id_tipo_institucion"]; ?>;
		var  id_fase=<?php echo $actual[0]["id_fase"]; ?>;
		var unidad_tiempo=<?php echo $actual[0]["id_unidad_tiempo"]; ?>;
		var id_unidad_tiempo=<?php echo $actual[0]["id_unidad_tiempo"]; ?>;
		var id_tiempo_investigacion=<?php echo $actual[0]["id_unidad_tiempo"]; ?>;
		var id_lineas_presidenciales = 1;
		if (<?php echo $actual[0]["id_tipo_institucion"]; ?> == 4 && control == "comuna") {
			$('#'+control).find("option").remove();
			$('#'+control).append('<option value=""></option>');
			$(data).each(function (i, val) {
				if (val["id_comuna"] == <?php echo $actual[0]["id_centro"]; ?>) {
					var selected = " selected ";
				} else {
					var selected = "";
				}
				$('#'+control).append('<option value='+val[id]+' '+selected+'>'+val[valor]+'</option>');
				$("#"+control).removeClass('bgc-granada');
				$("#"+control).removeClass('color-error');
			});
		}
		if (<?php echo $actual[0]["id_tipo_institucion"]; ?> == 4 && control == "tip_com") {
			var tipo = <?php echo $actual[0]["id_tipo_institucion"]; ?>;
			var id_centro = <?php echo $actual[0]["id_centro"]; ?>;
			var tipo_c = "";
			$.ajax({
				url: 'get_datos_comuna',
				type: 'post',
				dataType: 'json',
				data: {id_comuna: id_centro},
			})
			.done(function(datos) {
				tipo_c = datos[0]["id_tipo_comuna"];
				$('#'+control).find("option").remove();
				$('#'+control).append('<option value=""></option>');
				$(data).each(function (i, val) {
					if (val[id] == tipo_c) {
						var selected = " selected ";
					} else {
						var selected = "";
					}
					$('#'+control).append('<option value='+val[id]+' '+selected+'>'+val[valor]+'</option>');
					$("#"+control).removeClass('bgc-granada');
					$("#"+control).removeClass('color-error');
				});
			});
		}
		if (($("#"+control).is(":visible") || control =="unidad_tiempod") && control !== "tip_com" && control !== "comuna" && control !== "est_salud" && control !== "mun_salud" && control !== "par_salud") {
			$('#'+control).find("option").remove();
			$('#'+control).append('<option value=""></option>');
			$(data).each(function (i, val) {
				if (val[id] == eval(id)) {
					var selected = " selected ";
				} else {
					var selected = "";
				}
				$('#'+control).append('<option value='+val[id]+' '+selected+'>'+val[valor]+'</option>');
				$("#"+control).removeClass('bgc-granada');
				$("#"+control).removeClass('color-error');
			});
		}
	} else {
		$(data).each(function (i, val) {
			$("#"+control).addClass('bgc-granada');
			$("#"+control).addClass('color-error');
			$('#'+control).append('<option value='+val[id]+'>'+val[valor]+'</option>');
		});
	}
	$("#"+control).trigger("change");
	$("#"+control).trigger("click");
}
$("body").on('change click keyup', 'textarea,:input,select',function(e) {
	obj = false;
	var cant =0;
	$('body').each(function() {
		obj = $('body').find('.bgc-granada');
		$(obj).each(function() {
			if ($(this).is(":visible")) {
				cant++;
			}
		});
		if (cant>0 || <?php echo $previo; ?> > 0 ) {
			$("#btnGuardar").hide();
		} else {
			$("#btnGuardar").show();
		}
	});
});
$("#btnGuardar").on("click",function() {
	if($("#responsables tr").length > 2) {
		var titulo_investigacion = $("#titulo_investigacion").val();
		var tip_inst = $("#tip_inst").val();
		var lin_invp = $("#lin_invp").val();
		if ($("#fase_inv").val()==2) {
			var resul_inv = $("#objetivos_inv").val();
		} else {
			var resul_inv = $("#resul_inv").val();
		}
		var tipo_inv = $("#tipo_inv").val();
		var fase_inv = $("#fase_inv").val();
		var objetivos = $("#objetivos").is(":visible")?$("#resul_inv").val():0;
		var publicado = $("#enlace").is(":visible")?$("#enlace").prop("checked"):0;
		var publicado = $("#chk_pub").prop("checked");
		var enlace = $("#enlace").is(":visible")?$("#enlace").val():0;
		var centro = $("#centro").is(":visible")?$("#centro").val():0;
		var cen_salud = $("#cen_salud").is(":visible")?$("#cen_salud").val():0;
		var comuna = $("#comuna").is(":visible")?$("#comuna").val():0;
		var tip_com = $("#tip_com").is(":visible")?$("#tip_com").val():0;
		var objetivos_inv = $("#objetivos_inv").is(":visible")?$("#resul_inv").val():0;
		var tiempo_investigacione = $("#tiempo_investigacione").is(":visible")?$("#tiempo_investigacione").val():0;
		var unidad_tiempoe = $("#unidad_tiempoe").is(":visible")?$("#unidad_tiempoe").val():0;
		var com_etica = $("#com_etica").is(":visible")?$("#com_etica").val():0;
		var inst_etica = $("#inst_etica").is(":visible")?$("#inst_etica").val():0;
		var resul_invc = $("#resul_invc").is(":visible")?$("#resul_invc").val():0;
		var impacto = $("#impacto").is(":visible")?$("#impacto").val():0;
		var com_eticac = $("#com_eticac").is(":visible")?$("#com_eticac").val():0;
		var inst_eticac = $("#inst_eticac").is(":visible")?$("#inst_eticac").val():0;
		var centro_etica = $("#centro_etica").is(":visible")?$("#centro_etica").val():0;
		var responsables = new Array();
		$("#responsables tr").each(function(fila,tr) {
			responsables[fila]={
				"cedula":$(tr).find('td:eq(0)').text(),
				"nombre":$(tr).find('td:eq(1)').text(),
				"apellido":$(tr).find('td:eq(2)').text(),
			}
		});
		if ($("#tiempo_investigacion").is(":visible")) {
			var tiempo_investigacion = $("#tiempo_investigacion").val()
		} else if ($("#tiempo_investigacionc").is(":visible")) {
			var tiempo_investigacion = $("#tiempo_investigacionc").val()
		} else {
			var tiempo_investigacion = 	0;
		}
		if ($("#unidad_tiempod").is(":visible")) {
			var unidad_tiempo = $("#unidad_tiempod").val()
		} else if ($("#tiempo_investigacionc").is(":visible")) {
			var unidad_tiempo = $("#unidad_tiempoc").val()
		} else {
			var unidad_tiempo = 0;
		}
		responsables.shift();
		responsables.shift();
		$.ajax({
			url: 'registrar_investigacion_act',
			type: 'post',
			dataType: 'json',
			data: {
				titulo_investigacion:titulo_investigacion,
				tip_inst:tip_inst,
				lin_invp:lin_invp,
				resul_inv:resul_inv,
				tipo_inv:tipo_inv,
				fase_inv:fase_inv,
				centro:centro,
				cen_salud:cen_salud,
				comuna:comuna,
				tip_com:tip_com,
				tiempo_investigacion:tiempo_investigacion,
				unidad_tiempo:unidad_tiempo,
				objetivos_inv:objetivos_inv,
				tiempo_investigacione:tiempo_investigacione,
				unidad_tiempoe:unidad_tiempoe,
				com_etica:com_etica,
				inst_etica:inst_etica,
				resul_invc:resul_invc,
				impacto:impacto,
				com_eticac:com_eticac,
				inst_eticac:inst_eticac,
				centro_etica:centro_etica,
				enlace:enlace,
				publicado:publicado,
				responsables:responsables
			},
		})
		.done(function(data) {
			if (data !== "YA LA INVESTIGACIÓN FUE REGISTRADA PREVIAMENTE"){
				swal("¡INVESTIGACIÓN AGREGADA EXITOSAMENTE!","La investigación ha sido cargada exitosamente; puede continuar cargando otras investigaciones, aunque le recordamos que sólo debe cargar las de los tres últimos años","success").then((e)=>{
					location.reload();
				});
			} else {
				swal("LA INVESTIGACION FUE REGISTRADA PREVIAMENTE","","");
			}
		})
		.fail(function() {
			swal("¡ERROR EN AL CARGA DE LA INVESTIGACIÓN!","La investigación no se ha podido cargar; intente de nuevo","error");
		});
	} else {
		swal("¡NO HA INCLUIDO RESPONSABLES!","Debe incluir al menos un responsable de la investigación; incluya al menos uno y vuelva a intentar","warning");
	}
});
$("#dcargar_ficha").on("change",function() {
	documento1("ficha","ficha_diseno","d");
});
$("#ecargar_ficha").on("change",function() {
	documento1("ficha","ficha_ejecucion","e");
});
$("#ecargar_proyecto").on("change",function() {
	documento1("proyecto","proyecto_ejecucion","e");
});
$("#ccargar_proyecto").on("change",function() {
	documento1("proyecto","proyecto_culminado","c");
});
function documento1(tipo,nombre,prefijo) {
	var file_data = $("#"+prefijo+"cargar_"+tipo).prop("files")[0];
	var form_data = new FormData();
	form_data.append("file",file_data);
	switch(nombre) {
		case "ficha_diseno":
		$("#porc_dcargar_ficha").show();
		break;
		case "ficha_ejecucion":
		$("#porc_ecargar_ficha").show();
		break;
		case "proyecto_ejecucion":
		$("#porc_ecargar_proyecto").show();
		break;
		case "proyecto_culminado":
		$("#porc_ccargar_proyecto").show();
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
		url:"<?php echo base_url(); ?>perfil/cargar_documento2/"+nombre,
		method:"POST",
		data:form_data,
		contentType: false,
		cache: false,
		processData:false,
		success:function(data) {
			switch(nombre) {
				case "ficha_diseno":
				$("#porc_dcargar_ficha").hide();
				break;
				case "ficha_ejecucion":
				$("#porc_ecargar_ficha").hide();
				break;
				case "proyecto_ejecucion":
				$("#porc_ecargar_proyecto").hide();
				break;
				case "proyecto_culminado":
				$("#porc_ccargar_proyecto").hide();
				break;
			}
			if (data.indexOf("img") > -1) {
				swal("¡ARCHIVO SUBIDO EXITOSAMENTE","","success");				
			} else {
				if (data=="<p>El archivo subido excede el tamaño máximo permitido por tu configuración de PHP.</p>") {
					swal("¡ARCHIVO MAYOR A 2 Mb!","No se pudo subir el archivo, ya que el tamaño del  mismo debe ser menor o igual a 2 Mb","error");
				} else {
					swal("¡ARCHIVO NO PERMITIDO!","Sólo puede subir archivos PDF","error");	
				}
			}

			// if (data.indexOf("img") > -1) {
			// 	swal("FICHA CARGADA","La ficha ha sido cargada exitosamente","success");
			// } else {
			// 	swal("¡ARCHIVO MAYOR A 2 Mb!","No se pudo subir el archivo, ya que el tamaño del  mismo debe ser menor o igual a 2 Mb","error");
			// }
		}
	});
	// console.log(2);
	// if ($("#cargar_"+tipo)[0].files.length < 1) {
	// 	$("#cargar_"+tipo).addClass("bgc-granada");
	// 	$("#cargar_"+tipo).addClass("color-error");
	// 	$("#cargar_"+tipo).val(mensaje);
	// } else {
	// 	$("#cargar_"+tipo).removeClass("bgc-granada");
	// 	$("#cargar_"+tipo).removeClass("color-error");
	// }
}
function eliminar_fila(fila)  {
	$("#fila_"+fila).remove();
}

if (<?php echo $previo; ?> > 0) {
	$("#titulo_investigacion").val("<?php echo $actual[0]['titulo_investigacion']; ?>");
	$("#titulo_investigacion").removeClass("bgc-granada");
	$("#titulo_investigacion").removeClass("color-error");
	$("#resul_inv").val("<?php echo $actual[0]['resultado_investigacion']; ?>");
	$("#resul_inv").removeClass("bgc-granada");
	$("#resul_inv").removeClass("color-error");
	$("#tiempo_investigacion").val("<?php echo $actual[0]['tiempo_investigacion']; ?>");
	$("#tiempo_investigacion").removeClass("bgc-granada");
	$("#tiempo_investigacion").removeClass("color-error");
	if (<?php echo $actual[0]["id_fase"]; ?> == 1 ) {
	} else if (<?php echo $actual[0]["id_fase"]; ?> == 2 ) {
		$("#objetivos_inv").val("<?php echo $actual[0]['objetivo_investigacion']; ?>");
		$("#objetivos_inv").removeClass("bgc-granada");
		$("#objetivos_inv").removeClass("color-error");
	} else if (<?php echo $actual[0]["id_fase"]; ?> == 3 ) {
	} else if (<?php echo $actual[0]["id_fase"]; ?> == 4 ) {
	}
	var cri = "";
	var nri = "";
	var ari = "";
	$('#responsables tr:last').remove();
	<?php 
	if ($responsables) {
		for ($n=0;$n<count($responsables);++$n) { 
			?>
			cri = <?php echo $responsables[$n]['ci_responsable_investigacion']; ?>;
			nri = <?php echo "'".$responsables[$n]['nombre_responsable_investigacion']."'"; ?>;
			ari = <?php echo "'".$responsables[$n]['apellido_responsable_investigacion']."'"; ?>;
			var fila = "<tr><td>"+cri+"</td><td>"+"'"+nri+"'"+"</td><td>"+"'"+ari+"'"+"</td></tr>";
			fila = fila.replace(/'/g,"");
			$("#responsables tbody").append(fila);
		<?php } }?>
		$("select").attr('disabled',true);
		$("textarea").attr('disabled',true);
		$("input").attr('disabled',true);
		$("#pdf").attr('disabled',false);
		$("#btnGuardar").hide();
		$("#pdf").on("click",function() {
			var pdf=new Array();
			var etiqu = new Array();
			var valor = new Array();
			var n = 0;
			// var newArray=['Ungrouped'];
			// console.log(newArray);
			// console.log(newArray.length);
			// var add_input_grp = $("input").val();
			// newArray.push(add_input_grp);
			// console.log(newArray);
			// console.log(newArray.length);

			$("*").each(function () {  
				if ($(this).is(":visible") && ($(this).prop('nodeName')=="TEXTAREA"|| $(this).prop('nodeName')=="SELECT" || $(this).prop('nodeName')=="INPUT")) {
					etiqu.push($(this).prev().html());
					if ($(this).prop('nodeName')=="SELECT") {
						valor.push($(this).find('option:selected').text());
					} else {
						valor.push($(this).val());
					}
					n++;
				}
			});
			var cedu_resp = new Array();
			var nomb_resp = new Array();
			var apel_resp = new Array();
			$("#responsables >tbody>tr").each(function() {
				var m = 0;
				$(this).find("td").each(function(){
					switch(m) {
						case 0:
						cedu_resp.push($(this).html());
						break;
						case 1:
						nomb_resp.push($(this).html());
						break;
						case 2:
						apel_resp.push($(this).html());
						break;				
					}
					m++;
				});
			});
		// var pdf = new Array();
		var pdf = {};
		pdf["etiquetas"] = new Array();
		pdf["valores"] = new Array();
		pdf["cedu_resp"] = new Array();
		pdf["nomb_resp"] = new Array();
		pdf["apel_resp"] = new Array();
		pdf["etiquetas"].push(etiqu);
		pdf["valores"].push(valor);
		pdf["cedu_resp"].push(cedu_resp);
		pdf["nomb_resp"].push(nomb_resp);
		pdf["apel_resp"].push(apel_resp);
		$.ajax({
			type: "POST",
			dataType: 'text',
			dataType: 'json',
			url: "http://pni/perfil/pdf_inv_actual/",
			data: {pdf:pdf},
			success: function(pdf) {
				window.open(pdf, '_blank');
			}
		});
	});
	}
</script>
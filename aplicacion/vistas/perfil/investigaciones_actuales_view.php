<?php
$grupo_inv=str_replace("-", "", $grupo[0]["grupo"]);
?>
<body class="cuerpo-r">
	<img src="<?php echo base_url(); ?>assets/img/logo_pni-01.png" class="logo-pni">
	<div class="container margen-login">
		<form id="frm_registro">
			<!-- INVESTIGACIÓN ACTUAL -->
			<!--<label class="verdeclaro"style="font-size:150%;">GESTIÓN DE LA INVESTIGACIÓN ACTUAL (CARGAR SÓLO SI ESTÁ RELACIONADA A <?php echo $grupo_inv; ?>)</label>-->
			<label class="verdeclaro"style="font-size:150%;">GESTIÓN DE LA INVESTIGACIÓN ACTUAL</label>
			<hr>
			<container id="tabla" <?php echo $ocultar; ?>>
				<div class="row">
					<div class="container table-responsive">
						<table id="item-list" class="table table-bordered table-striped table-hover display" style="width:70%">
							<thead class="bgc-dark clight">
								<tr>
									<th>ACCIONES</th>
									<th>ID</th>
									<th>TÍTULO</th>
									<th>LÍNEA DE INVESTIGACIÓN</th>
									<th>FASE ACTUAL</th>
									<th>TIPO DE INVESTIGACIÓN</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</container>
			<?php include("modal_editar_investigaciones_actuales_view.php"); ?>
		</form>
	</div>
</body>
<script type="text/javascript">
	///////////////
	var accion_guardar;
	var url;
	var ajustarTamaño;
	var listo_textarea=false;
	var listo_select=false;
	var listo_text=false;
	function fecha_actual() {
		var x = new Date();
		var titulo = "investigaciones_actuales_"+x.getFullYear()+""+("0"+(x.getMonth() +1)).slice(-2)+""+("0"+x.getDate()).slice(-2)+"_"+("0"+x.getHours()).slice(-2)+""+("0"+x.getMinutes()).slice(-2)+""+("0"+x.getSeconds()).slice(-2);
		return titulo;		
	}
	$.fn.DataTable.ext.pager.numbers_length = 3;
	$(document).ready(function() {
		$('#item-list').DataTable({
			"lengthMenu": [[5, 10, 20, 50, 100, 200, -1], [5, 10, 20, 50, 100, 200,  "Todos"]],
			"iDisplayLength": 10,
			"columnDefs": [
			{ width: "25%", targets: 0 }
			],
			"ajax": {
				url : "listar_investigaciones_actales",
				type : 'get'
			},		
			"dom": 'lrfBitp',
			buttons: [
			{
				text: "<i class='btn btn-xs fa fa-plus fa-2x bgc-asfaltohumedo clight'></i>",
				titleAttr: "Agregar nueva investigación actual",
				action: function (e, dt, node, config) {
					$("#usuarios_form").each(function() {
						$(this).reset();
					});
					accion_guardar = 'add';
					$('#usuarios_form').trigger("reset");
					$("#ced_res").val('');
					$("#nom_res").val('');
					$("#ape_res").val('');
					$("textarea").val('');
					$("#usuarios_form select").val('');
					$(':input').val('');
					$("checkbox").prop("checked",false);
					$('#apl_pol_pub').bootstrapToggle('off');
					$('#publicada').bootstrapToggle('off');
					$(":text").val('');
					if($('#responsables').find("tr").length > 2) {
						$('#responsables tr:last').remove();
					}
					// $('#userModal').modal('show');
					$('#userModal').modal('show');
					$('.modal-title').text('Agregar una investigación actual');
				}
			},
			{ extend: 'excel', text: '<i class="fa fa-file-excel-o"></i>',titleAttr: "Exportar a Excel", 
			exportOptions: {
				columns: [1,2,3,4,5]
			},
			filename: function() {
				var x = new Date();
				var titulo = "auditoria_"+x.getFullYear()+""+("0"+(x.getMonth() +1)).slice(-2)+""+("0"+x.getDate()).slice(-2)+"_"+("0"+x.getHours()).slice(-2)+""+("0"+x.getMinutes()).slice(-2)+""+("0"+x.getSeconds()).slice(-2);
				return titulo;
			}},
			{ extend: 'pdf', text: '<i class="fa fa-file-pdf-o"></i>',titleAttr: "Exportar a PDF", 
			exportOptions: {
				columns: [1,2,3,4,5]
			},
			filename: function() {
				var x = new Date();
				var titulo = "investigaciones_actuales_"+x.getFullYear()+""+("0"+(x.getMonth() +1)).slice(-2)+""+("0"+x.getDate()).slice(-2)+"_"+("0"+x.getHours()).slice(-2)+""+("0"+x.getMinutes()).slice(-2)+""+("0"+x.getSeconds()).slice(-2);
				return titulo;
			}},
			{ extend: 'print', text: '<i class="fa fa-print"></i>',titleAttr: "Imprimir", 
			exportOptions: {
				columns: [1,2,3,4,5]
			},
		}
		],
		"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
			// if (aData[7]=="ADMINISTRADOR") {
			// 	$('td', nRow).css('background-color', '#abf5bc')
			// } else if (aData[7]=="SUPERVISOR") {
			// 	$('td', nRow).css('background-color', '#f5c8ab')
			// } 
			// switch(aData[8]){
			// 	case 'NO':
			// 	$('td', nRow).css('background-color', '#f2bfc4')
			// 	break;
			// }
		},
		"language": {
			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ".",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
				"sFirst":    "Primero",
				"sLast":     "Último",
				"sNext":     "Siguiente",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		},
		"aaSorting": [ [1,'asc'] ]
	});
		$("#item-list_info").css("color","white");
		$("label:contains('Mostrar')").css("color","white");	
		$("label:contains('registros')").css("color","white");	
		$("label:contains('Buscar')").css("color","white");
		$("a:contains('Siguiente')").css("color","white");
		$(':input[type = search]').css('color','black');
		$("select[name='item-list_length']").css("color","black");
	});
$(document).ready(function() {
	var grupo_inv;
	grupo_inv = '<?php echo $grupo_inv; ?>';
	switch(grupo_inv) {
		case 'COVID19':
		var documento = "<?php echo base_url(); ?>assets/documentos/ficha_proyecto-covid.doc";
		break;
		case 'CLACSO':
		var documento = "<?php echo base_url(); ?>assets/documentos/ficha_proyecto-clacso.doc";
		break;
	}
	$(".vacio").attr('href', documento);
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
	$('#com_etica').append('<option value=""></option>');
	$('#com_etica').append('<option value=1>NO</option>');
	$('#com_etica').append('<option value=2>INSTITUCIÓN INVESTIGACION</option>');
	$('#com_etica').append('<option value=3>INSTITUCIÓN EDUCATIVA</option>');
	$('#com_etica').append('<option value=4>INSTITUCIÓN SALUD</option>');
	$('#com_eticac').append('<option value=""></option>');
	$('#com_eticac').append('<option value=1>NO</option>');
	$('#com_eticac').append('<option value=2>INSTITUCIÓN INVESTIGACION</option>');
	$('#com_eticac').append('<option value=3>INSTITUCIÓN EDUCATIVA</option>');
	$('#com_eticac').append('<option value=4>INSTITUCIÓN SALUD</option>');
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
			$("#des_fichad").show();
			$("#car_fichad").show();
			$("#chk_fichad").hide();
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
			$("#tiempoe").hide();
			$("#tiempoc").hide();
			break;
			case "3":
			$("#fase_diseno").hide();
			$("#fase_ejecucion").hide();
			$("#fase_culminacion").show();
			$("#cresul_inv").hide();
			$("#pub").show();
			$("#ftici").hide();
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
			var estado = $("#est_salud").val();
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
				if (typeof(data)==='object') {
					select_sencillo(data,"mun_etica","cod_municipio","nombre_municipio");
				}
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
			case "com_etica":
			var tipo = $("#com_etica").val();
			switch(tipo) {
				case "2":				
					// if (<?php echo $previo; ?> == 0) {
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
					// }
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
					// if (<?php echo $previo; ?> ==0) {
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
						
					// }
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
function select_sencillo(data,control,id,valor) {
	$('#'+control).append('<option value=""></option>');
	$(data).each(function (i, val) {
		$("#"+control).addClass('bgc-granada');
		$("#"+control).addClass('color-error');
		$('#'+control).append('<option value='+val[id]+'>'+val[valor]+'</option>');
	});
	$("#"+control).trigger("change");
	$("#"+control).trigger("click");
	var encontrado = [];
	$("#"+control+" option").each(function() {
		if($.inArray(this.value, encontrado) != -1) $(this).remove();
		encontrado.push(this.value);
	});
	$("#"+control+" option").each(function() {
		if(this.value == 'undefined') $(this).remove();
	});
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
		if (cant>0) {
			$("#btnGuardar").hide();
		} else {
			$("#btnGuardar").show();
		}
	});
});
$("#btnGuardar").on("click",function() {
	if($("#responsables tr").length > 2) {
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
		.fail(function(data) {
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
		}
	});
}
function eliminar_fila(fila)  {
	$("#fila_"+fila).remove();
}
</script>
<?php
if (isset($tiempo[0]["id_tiempo_investigacion"])) {
	$ocultar = " style='display:block;' ";
	$tmp_cnt = 1;
} else {
	$ocultar = " style='display:none;' ";
	$tmp_cnt = 0;
	$tiempo[0]["id_tiempo_investigacion"]=0;
	$cantidad[0]["id_cantidad_investigacion"]=0;
}
//echo "<div class='verdeclaro' style='margin-bottom:5%;'><h2><strong>".str_replace("-", "", $grupo[0]["grupo"])."</strong></h2></div>";
echo "<div class='verdeclaro' style='margin-bottom:5%;'><h2><strong>Perfil de la Investigación</strong></h2></div>";
?>
<body class="cuerpo-r">
	<img src="<?php echo base_url(); ?>assets/img/logo_pni-01.png" class="logo-pni">
	<div class="container margen-login">
		<form id="frm_registro">
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label class="verdeclaro" for="tiempo_investigacion">Tiempo dedicado a la investigación</label>
						<select id="tiempo_investigacion" name="tiempo_investigacion" class="form-control borde-v-3 bgc-granada
						color-error"></select>
					</div>
				</div>
				<div class="col-md-3" id="cant_inv">
					<div class="form-group">
						<label class="verdeclaro" for="cuantas_investigaciones">Cantidad de Investigaciones previas</label>
						<select id="cuantas_investigaciones" name="cuantas_investigaciones" class="form-control borde-v-3 bgc-granada
						color-error"></select>
					</div>
				</div>				
			</div>
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
									<th>FECHA CULMINACIÓN</th>
									<th>RESULTADO</th>
									<th>IMPACTO EN POLITICAS PÚBLICAS</th>
									<th>CUÁL POLÍTICA PÚBLICA</th>
									<th>LÍNEA DE INVESTIGACIÓN</th>
									<th>OBJETIVO DE LA INVESTIGACIÓN</th>
									<th>TIPO DE INVESTIGACIÓN</th>
									<th>FASE ACTUAL</th>
									<th>TIEMPO INVESTIGACIÓN</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</container>
			<br/>
			<div class="row">
				<div class="col-md-2 col-md-offset-9">
					<button type="button" class="btn btn-success" id="trayectoria" style="display:none;">REGISTRAR TRAYECTORIA</button>
				</div>
			</div>
			<!--  -->
			<?php include "modal.php" ; ?>
			<?php include "modal_view.php" ; ?>
			<!--  -->
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
		var titulo = "investigaciones_"+x.getFullYear()+""+("0"+(x.getMonth() +1)).slice(-2)+""+("0"+x.getDate()).slice(-2)+"_"+("0"+x.getHours()).slice(-2)+""+("0"+x.getMinutes()).slice(-2)+""+("0"+x.getSeconds()).slice(-2);
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
				url : "get_investigaciones",
				type : 'GET'
			},		
			"dom": 'lrfBitp',
			buttons: [
			{
				text: "<i class='btn btn-xs fa fa-plus fa-2x bgc-asfaltohumedo clight'></i>",
				titleAttr: "Agregar nuevo usuario",
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
					$("checkbox").prop("checked",false);
					$('#apl_pol_pub').bootstrapToggle('off');
					$('#publicada').bootstrapToggle('off');
					$(":text").val('');
					if($('#responsables').find("tr").length > 2) {
						$('#responsables tr:last').remove();
					}
					$('#userModal').modal('show');
					$('.modal-title').text('Agregar una investigación');
				}
			},
			{ extend: 'excel', text: '<i class="fa fa-file-excel-o"></i>',titleAttr: "Exportar a Excel", 
			exportOptions: {
				columns: [1,2,3,4,5,6,7,8,9]
			},
			filename: function() {
				var x = new Date();
				var titulo = "auditoria_"+x.getFullYear()+""+("0"+(x.getMonth() +1)).slice(-2)+""+("0"+x.getDate()).slice(-2)+"_"+("0"+x.getHours()).slice(-2)+""+("0"+x.getMinutes()).slice(-2)+""+("0"+x.getSeconds()).slice(-2);
				return titulo;
			}},
			{ extend: 'pdf', text: '<i class="fa fa-file-pdf-o"></i>',titleAttr: "Exportar a PDF", 
			exportOptions: {
				columns: [1,2,3,4,5,6,7,8,9]
			},
			filename: function() {
				var x = new Date();
				var titulo = "auditoria_"+x.getFullYear()+""+("0"+(x.getMonth() +1)).slice(-2)+""+("0"+x.getDate()).slice(-2)+"_"+("0"+x.getHours()).slice(-2)+""+("0"+x.getMinutes()).slice(-2)+""+("0"+x.getSeconds()).slice(-2);
				return titulo;
			}},
			{ extend: 'print', text: '<i class="fa fa-print"></i>',titleAttr: "Imprimir", 
			exportOptions: {
				columns: [1,2,3,4,5,6,7,8,9]
			},
		}
		],
		"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
			if (aData[7]=="ADMINISTRADOR") {
				$('td', nRow).css('background-color', '#abf5bc')
			} else if (aData[7]=="SUPERVISOR") {
				$('td', nRow).css('background-color', '#f5c8ab')
			} 
			switch(aData[8]){
				case 'NO':
				$('td', nRow).css('background-color', '#f2bfc4')
				break;
			}
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
	$("textarea").val('');
	$("#titulo_investigacion").on("keyup",function() {
		var datos = new String($(this).val());
		datos = datos.toUpperCase(datos);
		$(this).val(datos);
	});
	$("#publicada").on("change",function() {
		if ($("#publicada").prop("checked")) {
			$("#enlace").show();
		} else {
			$("#enlace").hide();
		}
	})
	$('#enlace_publicacion').keyup(function() {
		var datos = new String($('#enlace_publicacion').val());
		datos = datos.toLowerCase(datos);
		$('#enlace_publicacion').val(datos);
	})
	$('#tiempo_dinvestigacion').on('keydown keypress',function(e){
		if(e.key.length === 1){
			if($(this).val().length < 3 && !isNaN(parseFloat(e.key))){
				$(this).val($(this).val() + e.key);
			}
			return false;
		}
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
	function eliminar_fila(fila)  {
		$("#fila_"+fila).remove();
	}
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
			$("#nom_res").removeClass("bgc-granada");
			$("#ape_res").removeClass("bgc-granada");		
			$("#nom_res").removeClass("color-error");
			$("#ape_res").removeClass("color-error");
			if (data["pnombre"].length > 0){
				$("#nom_res").prop("readonly",true);
				$("#ape_res").prop("readonly",true);
			} else {
				$("#nom_res").prop("readonly",false);
				$("#ape_res").prop("readonly",false);
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

	$("#tiempo_investigacion").on("click change blur",function() {
		if($("#cuantas_investigaciones").val()=='' || $("#cuantas_investigaciones").val()==1 || $("#tiempo_investigacion").val()=='' || $("#tiempo_investigacion").val()==1) {
			$("#tabla").hide();
		} else {
			$("#tabla").show();
		}

	});	
	$("#cuantas_investigaciones").on("click change blur",function() {
		if(($("#cuantas_investigaciones").val()=='' || $("#cuantas_investigaciones").val()==1) && ($("#tiempo_investigacion").val()=='' || $("#tiempo_investigacion").val()<2)) {
			$("#tabla").hide();
		} else {
			$("#tabla").show();
		}
		if($("#cuantas_investigaciones").val()=='' || $("#cuantas_investigaciones").val()>1) {
			$("#trayectoria").hide();
		} else {
			$("#trayectoria").show();
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
	$("#fase").on("change",function() {
		var val=$(this).val();
		if (val == 3) {
			$("#lb_tiempo").text("Tiempo que duró la investigación"); 
		} else {
			$("#lb_tiempo").text("Tiempo investigación"); 		
		}
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
			break;
			case "2":
			$("#fase_diseno").hide();			
			$("#fase_ejecucion").show();
			$("#fase_culminacion").hide();
			break;
			case "3":
			$("#fase_diseno").hide();			
			$("#fase_ejecucion").hide();
			$("#fase_culminacion").show();

			break;
			default:
			$("#fase_diseno").hide();
			$("#fase_ejecucion").hide();
			$("#fase_culminacion").hide();
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
	$("#apl_pol_pub").on('change', function() {
		if($(this).prop("checked")) {
			$("#responsable_investigacion").removeClass("col-md-6");
			$("#responsable_investigacion").addClass("col-md-3");
			// $("#responsable_investigacion").css("width","100%");
			$("#cpol").show();
		} else {
			$("#cpol").hide();
			$("#responsable_investigacion").removeClass("col-md-3");
			$("#responsable_investigacion").addClass("col-md-6");
			// $("#responsable_investigacion").css("width","150%");
		}
	});
	$("input:text").on("change keyup ",function(e) {
		if ($(this).val() == "") {
			$(this).addClass("bgc-granada");
			$(this).addClass("color-error");		
		} else {
			$(this).removeClass("bgc-granada");
			$(this).removeClass("color-error");		
		}
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
			////////////////////////////////
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
			case "tip_com":
			var tipo = $("#tip_com").val();
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
			break;
			case "com_etica":
			var tipo = $("#com_etica").val();
			switch(tipo) {
				case "2":				
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
			////
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
				break;
				case "4":
				$("#sal_etica").show();
				$("#in_etc").hide();
				break;
				default:
				$("#sal_etica").hide();
				$("#in_etc").hide();
				break;
			}			
			////

		}
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
	select_sencillo(data,"unidad_tiempo","id_unidad_tiempo","unidad_tiempo");
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
	$('#'+control).find("option").remove();
	$('#'+control).append('<option value=""></option>');
	$(data).each(function (i, val) {
		var selected = "";
		var tiempo = <?php echo $tiempo[0]["id_tiempo_investigacion"]; ?>;
		var cantidad = <?php echo $cantidad[0]["id_cantidad_investigacion"]; ?>;
		if ( tiempo > 0){
			if (control == "tiempo_investigacion") {
				if (val["id_tiempo_investigacion"] == tiempo) {
					selected = "selected";
					$("#tiempo_investigacion").removeClass('bgc-granada');
					$("#tiempo_investigacion").removeClass('color-error');
				}
			}
			if (control == "cuantas_investigaciones") {
				if (val["id_cantidad_investigacion"] == cantidad) {
					selected = "selected";
					$("#cuantas_investigaciones").removeClass('bgc-granada');
					$("#cuantas_investigaciones").removeClass('color-error');
				}
			}
		}
		$('#'+control).append('<option value='+val[id]+' '+selected+'>'+val[valor]+'</option>');
	});
}

$(".modal-body").on('change click', 'textarea,:input,select',function(e) {
	obj = false;
	var cant =0;
	$('.modal-body').each(function() {
		obj = $('.modal-body').find('.bgc-granada');
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
$("#trayectoria").on("click",function() {
	var ci = $("#cuantas_investigaciones").val();
	var ti = $("#tiempo_investigacion").val();
	$.ajax({
		url: 'registrar_trayectoria',
		type: 'post',
		data: {ci: ci,ti:ti},
	})
	.done(function(data) {
		swal("TRAYECTORIA REGISTRADA","Se ha registrado exitosamente la trayectoria del investigador","success");
	})
	.fail(function(data) {
		swal("NO SE HA PODIDO REGISTRAR LA TRAYECTORIA DEL INVESTIGADOR","Ha ocurrido un error al registrar la trayectoria del investigador; por favor intente de nuevo mas tarde","error");
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
		var fecha_culminacion= $("#fecha_culminacion").val();
		var resultado_investigacion= $("#resultado_investigacion").val();
		var linea_investigacion= $("#linea_investigacion").val();
		var tipo_investigacion= $("#tipo_investigacion").val();
		var objetivo_investigacion= $("#objetivo_investigacion").val();
		var tip_inst= $("#tip_inst").val();
		var cen_salud= $("#cen_salud").val();
		var fase= $("#fase").val();
		var tiempo_dinvestigacion= $("#tiempo_dinvestigacion").val();
		var unidad_tiempo= $("#unidad_tiempo").val();
		var apl_pol_pub = $("#apl_pol_pub").prop("checked");
		var pol_pub = $("#pol_pub").is(":visible") ? $("#pol_pub").val() : 0;
		var publicada = $("#publicada").prop("checked");
		var tiempo_investigacion = $("#tiempo_investigacion").val();
		var cantidad_investigacion = $("#cuantas_investigaciones").val();
		var enlace_publicacion = $("#enlace_publicacion").is(":visible") ? $("#enlace_publicacion").val() : '';
		var cen_salud= $("#cen_salud").is(":visible") ? $("#cen_salud").val() : 0;
		var est_salud = $("#est_salud").is(":visible") ? $("#est_salud").val() : 0;
		var mun_salud = $("#mun_salud").is(":visible") ? $("#mun_salud").val() : 0;
		var par_salud = $("#par_salud").is(":visible") ? $("#par_salud").val() : 0;
		var centro = $("#centro").is(":visible") ? $("#centro").val() : 0;
		var tip_com = $("#tip_com").is(":visible") ? $("#tip_com").val() : 0;
		var comuna = $("#comuna").is(":visible") ? $("#comuna").val() : 0;
		var responsables = new Array();
		$("#responsables tr").each(function(fila,tr) {
			responsables[fila]={
				"cedula":$(tr).find('td:eq(0)').text(),
				"nombre":$(tr).find('td:eq(1)').text(),
				"apellido":$(tr).find('td:eq(2)').text(),
			}
		});
		responsables.shift();
		responsables.shift();
		$.ajax({
			url: 'registrar_investigacion',
			type: 'post',
			dataType: 'json',
			data: {
				titulo_investigacion:titulo_investigacion,
				fecha_culminacion:fecha_culminacion,
				resultado_investigacion:resultado_investigacion,
				linea_investigacion:linea_investigacion,
				tipo_investigacion:tipo_investigacion,
				objetivo_investigacion:objetivo_investigacion,
				tip_inst:tip_inst,
				cen_salud:cen_salud,
				fase:fase,
				tiempo_dinvestigacion:tiempo_dinvestigacion,
				unidad_tiempo:unidad_tiempo,
				apl_pol_pub:apl_pol_pub,
				pol_pub:pol_pub,
				publicada:publicada,
				enlace_publicacion:enlace_publicacion,
				cen_salud:cen_salud,
				est_salud:est_salud,
				mun_salud:mun_salud,
				par_salud:par_salud,
				centro:centro,
				tip_com:tip_com,
				comuna:comuna,
				responsables:responsables,
				tiempo_investigacion:tiempo_investigacion,
				cantidad_investigacion:cantidad_investigacion
			},
		})
		.done(function() {
			$('#item-list').dataTable().api().ajax.reload();
			swal("¡INVESTIGACIÓN AGREGADA EXITOSAMENTE!","La investigación ha sido cargada exitosamente; puede continuar cargando otras investigaciones, aunque le recordamos que sólo debe cargar las de los tres últimos años","success").then((e)=>{
				$('#usuarios_form').trigger("reset");
				$("#ced_res").val('');
				$("#nom_res").val('');
				$("#ape_res").val('');
				$("textarea").val('');
				$("select").val('');
				$("checkbox").prop("checked",false);
				$('#apl_pol_pub').bootstrapToggle('off');
				$('#publicada').bootstrapToggle('off');
				$(":text").val('');
				$('#responsables tr:last').remove();
			});
		})
		.fail(function() {
			swal("¡ERROR EN AL CARGA DE LA INVESTIGACIÓN!","La investigación no se ha podido cargar; intente de nuevo","error");
		});
	} else {
		swal("¡NO HA INCLUIDO RESPONSABLES!","Debe incluir al menos un responsable de la investigación; incluya al menos uno y vuelva a intentar","error");
	}
});

function ver(id) {
	$.ajax({
		url: 'get_ficha_proyecto',
		type: 'post',
		dataType: 'json',
		data: {id:id},
	})
	.done(function(data) {
		$("#ftitulo_investigacion").val(data[0]["titulo_investigacion"]);
		$("#ffecha_culminacion").val(data[0]["fecha_culminacion"]);
		$("#fresultado_investigacion").val(data[0]["resultado_investigacion"]);
		$("#fapl_pol_pub").val(data[0][""]);
		$("#flinea_investigacion").val(data[0]["linea_investigacion"]);
		$("#ftipo_investigacion").val(data[0]["tipo_investigacion"]);
		$("#fobjetivo_investigacion").val(data[0]["objetivo_investigacion"]);
		$("#ftip_inst").val(data[0]["tipo_institucion"]);
		$("#fpublicada").val(data[0]["publicada"]);
		$("#fenlace_publicacion").val(data[0]["link_publicacion"]);
		$("#ffase").val(data[0]["fase"]);
		$("#fapl_pol_pub").val(data[0]["pol_pub"]);
		$("#fpol_pub").val(data[0]["politica_publica"]);
		$("#ftiempo_dinvestigacion").val(data[0]["tiempo_investigacion"] + " " + data[0]["unidad_tiempo"]);
		switch(data[0]["tipo_institucion"]) {
			case "INSTITUCIÓN SALUD":
			$("#titulo_centro").html("Institución de Salud");
			$("#fcentro").val(data[0]["nombre_centro"]);
			break;
			case "INSTITUCIÓN INVESTIGACIÓN":
			$("#titulo_centro").html("Institución de Investigación");
			$("#fcentro").val(data[0]["nombre_institucion_investigacion"]);
			break;
			case "INSTITUCIÓN EDUCATIVA":
			$("#titulo_centro").html("Institución Educativa");
			$("#fcentro").val(data[0]["nombre_institucion_educativa"]);
			break;
			case "OTROS":
			$("#titulo_centro").html("Comunas");
			$("#fcentro").val(data[0]["comuna"]);
			break;
		}
		$("#ftitulo_investigacion").prop("readonly",true);
		$("#ffecha_culminacion").prop("readonly",true);
		$("#fresultado_investigacion").prop("readonly",true);
		$("#fapl_pol_pub").prop("readonly",true);
		$("#flinea_investigacion").prop("readonly",true);
		$("#ftipo_investigacion").prop("readonly",true);
		$("#fobjetivo_investigacion").prop("readonly",true);
		$("#ftip_inst").prop("readonly",true);
		$("#fpublicada").prop("readonly",true);
		$("#fenlace_publicacion").prop("readonly",true);
		$("#ffase").prop("readonly",true);
		$("#fapl_pol_pub").prop("readonly",true);
		$("#fpol_pub").prop("readonly",true);
		$("#ftiempo_dinvestigacion").prop("readonly",true);
		$("#titulo_centro").prop("readonly",true);
		$("#fcentro").prop("readonly",true);
		$.ajax({
			url: 'get_responsables_proyecto',
			type: 'post',
			dataType: 'json',
			data: {id:id},
		})
		.done(function(datos) {
			$("#fresponsables").html('');
			$(datos).each(function(i,val) {
				$("#fresponsables").append('<tr><td>'+val["ci_responsable_investigacion"]+'</td><td>'+val["nombre_responsable_investigacion"]+'</td><td>'+val["apellido_responsable_investigacion"]+'</td></tr>');
			});
		})
		.fail(function(data) {
		})
		.always(function() {
		});
	})
	.fail(function(data) {
	})
	.always(function() {
	});
	$('#viewModal').modal('show');
	$('.modal-title').text('Ficha de la investigación');
}
function suspender(id) {
	Swal.fire({
		title: '¿Está seguro de eliminar la investigación?',
		text: "No será posible revertir esta operación",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Continuar',
		cancelButtonText: 'Cancelar',
	}).then((result) => {
		if(result.value) {
			$.ajax({
				url: 'suspender_investigacion',
				type: 'post',
				dataType: 'json',
				data: {id:id},
			})
			.done(function() {
				$('#item-list').dataTable().api().ajax.reload();
			})
			.fail(function() {
			});

		}

	})

}
</script>
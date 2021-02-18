<script type="text/javascript">
</script>
<?php include("modal_ficha_investigadores_view.php"); ?>
<container>
	<div class="row">
		<div class="container table-responsive">
			<table id="item-list" class="table table-bordered table-striped table-hover display" style="width:70%">
				<thead class="bgc-dark clight">
					<tr>
						<th>ACCIONES</th>
						<th>CÉDULA</th>
						<th>NOMBRES</th>
						<th>APELLIDOS</th>
						<th>CORREO</th>
						<th>PERFIL INVESTIGADOR</th>
						<th>PERFIL INVESTIGACIÓN</th>
						<th>INVESTIGACIÓN ACTUAL</th>
						<th>FECHA REGISTRO</th>
					</tr>
					<tr>
						<th></th>
						<th><label class="solo-imprimir">CÉDULA</label></th>
						<th><label class="solo-imprimir">NOMBRES</label></th>
						<th><label class="solo-imprimir">APELLIDOS</label></th>
						<th><label class="solo-imprimir">CORREO</label></th>
						<th><label class="solo-imprimir">PERFIL INVESTIGADOR</label></th>
						<th><label class="solo-imprimir">PERFIL INVESTIGACIÓN</label></th>
						<th><label class="solo-imprimir">INVESTIGACIÓN ACTUAL</label></th>
						<th><label class="solo-imprimir">FECHA REGISTRO</label></th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
</container>
<script type="text/javascript">
	var accion_guardar;
	var url;
	var ajustarTamaño;
	function fecha_actual() {
		var x = new Date();
		var titulo = "modulos_investigador_"+x.getFullYear()+""+("0"+(x.getMonth() +1)).slice(-2)+""+("0"+x.getDate()).slice(-2)+"_"+("0"+x.getHours()).slice(-2)+""+("0"+x.getMinutes()).slice(-2)+""+("0"+x.getSeconds()).slice(-2);
		return titulo;		
	}
	function fecha_emision() {
		var x = new Date();
		var titulo = ("0"+x.getDate()).slice(-2)+"/"+("0"+(x.getMonth() +1)).slice(-2)+"/"+x.getFullYear()+" "+("0"+x.getHours()).slice(-2)+":"+("0"+x.getMinutes()).slice(-2)+":"+("0"+x.getSeconds()).slice(-2);
		return titulo;		
	}
	$.fn.DataTable.ext.pager.numbers_length = 3;
	$(document).ready(function() {
		$('#item-list').DataTable({
			///////////////////////////////////////
			initComplete: function () {
				this.api().columns([5,6,7]).every( function () {
					var column = this;
					var select = $('<select class="casfaltohumedo no-imprimir"><option value=""></option></select>')
					.appendTo( $(column.header()).empty() )
					.on( 'change', function () {
						var val = $.fn.dataTable.util.escapeRegex(
							$(this).val()
							);
						column
						.search( val ? '^'+val+'$' : '', true, false )
						.draw();
					} );

					column.data().unique().sort().each( function ( d, j ) {
						select.append( '<option class="no-imprimir" value="'+d+'">'+d+'</option>' )
					} );
				} );
			},
		///////////////////////////////////////
		"lengthMenu": [[5, 10, 20, 50, 100, 200, -1], [5, 10, 20, 50, 100, 200,  "Todos"]],
		"iDisplayLength": 10,
		"columnDefs": [
		{ width: "25%", targets: 4 }
		],
		"ajax": {
			url : "listar_investigadores",
			type : 'GET'
		},		
		"dom": 'lrfBitp',
		buttons: [
			/*
					{
				text: "<i class='btn btn-xs fa fa-plus fa-2x bgc-asfaltohumedo clight'></i>",
				titleAttr: "Agregar nuevo usuario",
				action: function (e, dt, node, config) {
					// $("#usuarios_form")[0].reset();
					// accion_guardar = 'add';
					// $('#usuarios_form').trigger("reset");
					// $("#cedula").prop("readonly",false);
					// $("#correo").prop("readonly",false);
					// $("#cant").removeClass('fa fa-check');
					// $("#cant").removeClass('csuccess');
					// $("#cant").addClass('fa fa-times');
					// $("#cant").addClass('cdanger');
					// $("#num").removeClass('fa fa-check');
					// $("#num").removeClass('csuccess');
					// $("#num").addClass('fa fa-times');
					// $("#num").addClass('cdanger');
					// $("#esp").removeClass('fa fa-check');
					// $("#esp").removeClass('csuccess');
					// $("#esp").addClass('fa fa-times');
					// $("#esp").addClass('cdanger');
					// $("#min").removeClass('fa fa-check');
					// $("#min").removeClass('csuccess');
					// $("#min").addClass('fa fa-times');
					// $("#min").addClass('cdanger');
					// $("#may").removeClass('fa fa-check');
					// $("#may").removeClass('csuccess');
					// $("#may").addClass('fa fa-times');
					// $("#may").addClass('cdanger');
					// $("#inst").hide();
					// $("#clave").show();
					// $("#confirmar").show();
					// $("label:contains('Clave')").show();
					// $("label:contains('Confirmar')").show();
					// $("#btnGuardar").css("display","none");
					// $("#id_usuario").html('');
					// $("#cont-etq-usuario").css("display","none");
					// $('#userModal').modal('show');
					// $('.modal-title').text('Agregar un nuevo usuario');
				}
			},*/
			{ extend: 'excelHtml5', text: '<i class="fa fa-file-excel-o"></i>',titleAttr: "Exportar a Excel", 
			customize: function (xlsx) {
				var sheet = xlsx.xl.worksheets['sheet1.xml'];
				$('c[r=A1] t', sheet).text('MÓDULOS COMPLETADOS POR LOS INVESTIGADORES AL '+fecha_emision());
				$('c[r=A2] t', sheet).text('CÉDULA');
				$('c[r=B2] t', sheet).text('NOMBRES');
				$('c[r=C2] t', sheet).text('APELLIDOS');
				$('c[r=D2] t', sheet).text('CORREO DEL INVESTIGADOR');
				$('c[r=E2] t', sheet).text('PERFIL DEL INVESTIGADOR');
				$('c[r=F2] t', sheet).text('PERFIL DE LA INVESTIGACIÓN');
				$('c[r=G2] t', sheet).text('INVESTIGACIÓN ACTUAL');
				$('c[r=H2] t', sheet).text('FECHA REGISTRO INICIAL');
				$('row:first c', sheet).attr( 's','7');
			},
			exportOptions: {
				columns: [1,2,3,4,5,6,7,8],
				format: {
					header:  function (data, columnIdx) {
						return ' ';
					},
				}
			},
			filename: function() {
				var x = new Date();
				var titulo = "modulos_investigador_"+x.getFullYear()+""+("0"+(x.getMonth() +1)).slice(-2)+""+("0"+x.getDate()).slice(-2)+"_"+("0"+x.getHours()).slice(-2)+""+("0"+x.getMinutes()).slice(-2)+""+("0"+x.getSeconds()).slice(-2);
				return titulo;
			}},
			{ extend: 'pdf', text: '<i class="fa fa-file-pdf-o"></i>',titleAttr: "Exportar a PDF", 
			exportOptions: {
				columns: [1,2,3,4,5,6,7,8]
			},
			filename: function() {
				var x = new Date();
				var titulo = "auditoria_"+x.getFullYear()+""+("0"+(x.getMonth() +1)).slice(-2)+""+("0"+x.getDate()).slice(-2)+"_"+("0"+x.getHours()).slice(-2)+""+("0"+x.getMinutes()).slice(-2)+""+("0"+x.getSeconds()).slice(-2);
				return titulo;
			}},
			{ extend: 'print', text: '<i class="fa fa-print fa-3"></i>',titleAttr: "Imprimir", 
			exportOptions: {
				columns: [1,2,3,4,5,6,7]
			},
			customize: function (win) {
				// $(win.document.body).find('table').addClass('display').css('font-size', '9px');
				$(win.document.body).find('tr:nth-child(odd) td').each(function(index){
					$(this).css('background-color','#D0D0D0');
				});
				$(win.document.body).find('select').each(function(index){
					$(this).css('display','none');				
				});
				$(win.document.body).find('option').each(function(index){
					$(this).css('display','none');				
				});
				// $(win.document.body).find('h1').css('text-align','center');
				$(win.document.body).find('h1').css('display','none');
			}
		}
		],
		"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
			if (aData[4]=="SI" && aData[5]=="SI" && aData[6]=="SI") {
				$('td', nRow).css('background-color', '#abf5bc')
			} else if ((aData[4]=="SI" && aData[5]=="SI") || (aData[4]=="SI" && aData[6]=="SI") || (aData[5]=="SI" && aData[6]=="SI")) {
				$('td', nRow).css('background-color', '#b6f2ef');
			} else if ((aData[4]=="SI" && aData[5]=="NO" && aData[6]=="NO") || (aData[4]=="NO" && aData[5]=="SI" && aData[6]=="NO") || (aData[4]=="NO" && aData[5]=="NO" && aData[6]=="SI") ) {
				$('td', nRow).css('background-color', '#f7f7cd');
			}
			// else if (aData[7]=="SUPERVISOR") {
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

// $('select').css('color','#000;');
// $(".buttons-print").on("click",function(e) {
	// $("button[title='Imprimir']").on("click",function(e) {
	// 	e.preventDefault();
	// 	alert("PEPE");
	// });
	function ver(cedula) {
	// $('#userModal').modal('show');
	// $('.modal-title').text('Ficha del Investigador');
	
	// accion_guardar = 'update';
	// $("#id_registro").show();
	// alert(cedula);
	$.ajax({
		url: base_url+"perfil/get_investigador/"+cedula,
		type: 'get',
		dataType: 'json'
	})
	.done(function(data) {
		console.log(data);
		console.log("pinvd: "+data["pinvd"].length);
		$("#ci_investigador").html(data["inv"][0]["ci_investigador"]);
		$("#pnombre").html(data["inv"][0]["pnombre"]);
		$("#snombre").html(data["inv"][0]["snombre"]);
		$("#papellido").html(data["inv"][0]["papellido"]);
		$("#sapellido").html(data["inv"][0]["sapellido"]);
		$("#nombre_genero").html(data["inv"][0]["nombre_genero"]);
		$("#fecha_nac").html(data["inv"][0]["fecha_nac"]);
		$("#nombre_estado").html(data["inv"][0]["nombre_estado"]);
		$("#estado").html(data["inv"][0]["estado"]);
		$("#municipio").html(data["inv"][0]["municipio"]);
		$("#parroquia").html(data["inv"][0]["parroquia"]);
		$("#codigo_postal").html(data["inv"][0]["codigo_postal"]);
		$("#telefono").html(data["inv"][0]["telefono"]);
		$("#celular").html(data["inv"][0]["celular"]);
		$("#correo").html(data["inv"][0]["correo"]);
		$("#profesion").html(data["inv"][0]["profesion"]);
		$("#tipo_institucion").html(data["inv"][0]["tipo_institucion"]);
		$("#nombre_institucion").html(data["inv"][0]["nombre_institucion"]);
		$("#modo_investigacion").html(data["inv"][0]["modo_investigacion"]);
		$("#fecha_creacion").html(data["inv"][0]["fecha_creacion"]);
		if (data["pinvd"].length >0) {
			$("#academico").show();
			$("#consigno_foto").html(data["pinvd"][0]["consigno_foto"]);
			$("#rif_investigador").html(data["pinvd"][0]["rif_investigador"]);
			$("#nivel_academico").html(data["pinvd"][0]["nivel_academico"]);
			$("#estatus_academico").html(data["pinvd"][0]["estatus_academico"]);
			$("#nombre_institucion_educativa").html(data["pinvd"][0]["nombre_institucion_educativa"]);
			$("#nombre_especialidad_salud").html(data["pinvd"][0]["nombre_especialidad_salud"]);
			$("#area_conocimiento").html(data["pinvd"][0]["area_conocimiento"]);
			$("#sub_area").html(data["pinvd"][0]["sub_area"]);
			$.ajax({
				url: 'verificar_archivos1',
				type: 'post',
				dataType: 'json',
				data: {cedula: cedula},
			})
			.done(function(data) {
				var ext_foto = data[0]["ext_foto"];
				var ext_cedula = data[0]["ext_cedula"];
				var ext_rif = data[0]["ext_rif"];
				var ext_titulo = data[0]["ext_titulo"];
				var mostrar_foto = ext_foto=='pdf'?base_url+"assets/img/pdf-foto.png":base_url+data[0]["foto_mini"];
				$("#img_foto").attr("src",mostrar_foto);
				$("#aimg_foto").attr("href",data[0]["foto"]);
				$("#aimg_foto").attr("download",cedula+"_foto."+ext_foto);
				var mostrar_cedula = ext_cedula=='pdf'?base_url+"assets/img/pdf-cedula.png":base_url+data[0]["cedula_mini"];
				$("#img_cedula").attr("src",mostrar_cedula);
				$("#aimg_cedula").attr("href",data[0]["foto"]);
				$("#aimg_cedula").attr("download",cedula+"_cedula."+ext_cedula);
				var mostrar_rif = ext_rif=='pdf'?base_url+"assets/img/pdf-rif.png":base_url+data[0]["rif_mini"];
				$("#img_rif").attr("src",mostrar_rif);
				$("#aimg_rif").attr("href",data[0]["foto"]);
				$("#aimg_rif").attr("download",cedula+"_rif."+ext_rif);
				var mostrar_titulo = ext_titulo=='pdf'?base_url+"assets/img/pdf-titulo.png":base_url+data[0]["titulo_mini"];
				$("#img_titulo").attr("src",mostrar_titulo);
				$("#aimg_titulo").attr("href",data[0]["foto"]);
				$("#aimg_titulo").attr("download",cedula+"_titulo."+ext_titulo);
			});
		} else {
			$("#academico").hide();
		}
		$('#userModal').modal('show');
		$('.modal-title').text('Información del Investigador');
	})
	.fail(function() {
		swal(
			'¡ERROR EN LA OPERACIÓN!',
			'El registro no se ha podido procesar',
			'error'
			);
		$("#userModal").modal('hide');
	});
}
</script>
	var accion_guardar;
	var url;
	function fecha_actual() {
		var x = new Date();
		var titulo = "eventos_"+x.getFullYear()+""+("0"+(x.getMonth() +1)).slice(-2)+""+("0"+x.getDate()).slice(-2)+"_"+("0"+x.getHours()).slice(-2)+""+("0"+x.getMinutes()).slice(-2)+""+("0"+x.getSeconds()).slice(-2);
		return titulo;		
	}
	$.fn.DataTable.ext.pager.numbers_length = 3;
	$(document).ready(function() {
		$('#item-list').DataTable({
			"lengthMenu": [[5, 10, 20, 50, 100, 200, -1], [5, 10, 20, 50, 100, 200,  "Todos"]],
			"iDisplayLength": 10,
			"columnDefs": [
			{ visible: false, targets: 3 },
			{ visible: false, targets: 7 },
			{ visible: false, targets: 8 },
			{ visible: false, targets: 9 },
			{ visible: false, targets: 10 },
			],
			"ajax": {
				url : "get_auditoria_evento",
				type : 'GET'
			},	
			"dom": 'lrfBitp',
			buttons: [
			{ extend: 'excel', text: '<i class="fa fa-file-excel-o"></i>',titleAttr: "Exportar a Excel", 
			exportOptions: {
				columns: [1,2,3,4,5,6,7,8,9,10,11,12]
			},
			filename: function() {
				var x = new Date();
				var titulo = "auditoria_"+x.getFullYear()+""+("0"+(x.getMonth() +1)).slice(-2)+""+("0"+x.getDate()).slice(-2)+"_"+("0"+x.getHours()).slice(-2)+""+("0"+x.getMinutes()).slice(-2)+""+("0"+x.getSeconds()).slice(-2);
				return titulo;
			}},
			{ extend: 'pdf', text: '<i class="fa fa-file-pdf-o"></i>',titleAttr: "Exportar a PDF", 
			exportOptions: {
				columns: [1,2,3,4,5,6,7,8,9,10,11,12]
			},
			filename: function() {
				var x = new Date();
				var titulo = "auditoria_"+x.getFullYear()+""+("0"+(x.getMonth() +1)).slice(-2)+""+("0"+x.getDate()).slice(-2)+"_"+("0"+x.getHours()).slice(-2)+""+("0"+x.getMinutes()).slice(-2)+""+("0"+x.getSeconds()).slice(-2);
				return titulo;
			}},
			],
			"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
				if (aData[11]=="ELIMINAR") {
					$('td', nRow).css('background-color', '#f2bfc4')
				} else if (aData[11]=="INSERTAR") {
					$('td', nRow).css('background-color', '#abf5bc')
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
			"aaSorting": [ [1,'desc'] ]
		});
		$("#item-list_info").css("color","white");
		$("label:contains('Mostrar')").css("color","white");	
		$("label:contains('registros')").css("color","white");	
		$("label:contains('Buscar')").css("color","white");
		$("a:contains('Siguiente')").css("color","white");
		$(':input[type = search]').css('color','black');
		$("select[name='item-list_length']").css("color","black");
	});
	function ficha_auditoria(id) {
		$.ajax({
			url: base_url+"auditoria/ficha_evento/" + id,
			type: 'GET',
			dataType: 'JSON',
		})
		.done(function(data) {
			$('#id_auditoria_ficha').text(data.event_id);
			$('#fechahora_ficha').text(data.action_tstamp_tx);
			$('#cedula_ficha').text(data.ci_usuario);
			$('#login_ficha').text(data.session_user_name);
			$('#usuario_ficha').text(data.nombre_usuario);
			$('#tabla_ficha').text(data.table_name);
			$('#ip_ficha').text(data.client_addr);
			$('#puerto_ficha').text(data.client_port);
			$('#sql_ficha').html(data.client_query);
			$('#data_ficha').html(data.row_data);
			$('#evento_ficha').text(data.action);
			$('#cambio_ficha').text(data.changed_fields);
			$('#vistaModal').modal('show');
			$('.modal-title').text('Ficha de Auditoria');
		})
		.fail(function() {
			swal(
				'¡ERROR EN LA OPERACIÓN!',
				'No se ha podido obtener la data asicrónica',
				'error'
				);
			$("#userModal").modal('hide');			

		});
	}
	$(document).ready(function() {
		$("#auditoria").on('keyup', function() {
			var observaciones = $(this).val().toUpperCase();
			$(this).val(observaciones.toUpperCase());
		})
	});
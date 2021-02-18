	var accion_guardar;
	var url;
	function fecha_actual() {
		var x = new Date();
		var titulo = "ingresos_"+x.getFullYear()+""+("0"+(x.getMonth() +1)).slice(-2)+""+("0"+x.getDate()).slice(-2)+"_"+("0"+x.getHours()).slice(-2)+""+("0"+x.getMinutes()).slice(-2)+""+("0"+x.getSeconds()).slice(-2);
		return titulo;		
	}
	$.fn.DataTable.ext.pager.numbers_length = 3;
	$(document).ready(function() {
		$('#item-list').DataTable({
			"lengthMenu": [[5, 10, 20, 50, 100, 200, -1], [5, 10, 20, 50, 100, 200,  "Todos"]],
			"iDisplayLength": 10,
			"columnDefs": [
			{ width: "5%", targets: 0 },
			],
			"ajax": {
				url : "get_auditoria_ingreso",
				type : 'GET'
			},	
			"dom": 'lrfBitp',
			buttons: [
			{ extend: 'excel', text: '<i class="fa fa-file-excel-o"></i>',titleAttr: "Exportar a Excel", 
			exportOptions: {
				columns: [1,2,3,4,5,6,7]
			},
			filename: function() {
				var x = new Date();
				var titulo = "auditoria_"+x.getFullYear()+""+("0"+(x.getMonth() +1)).slice(-2)+""+("0"+x.getDate()).slice(-2)+"_"+("0"+x.getHours()).slice(-2)+""+("0"+x.getMinutes()).slice(-2)+""+("0"+x.getSeconds()).slice(-2);
				return titulo;
			}},
			{ extend: 'pdf', text: '<i class="fa fa-file-pdf-o"></i>',titleAttr: "Exportar a PDF", 
			exportOptions: {
				columns: [1,2,3,4,5,6,7]
			},
			filename: function() {
				var x = new Date();
				var titulo = "auditoria_"+x.getFullYear()+""+("0"+(x.getMonth() +1)).slice(-2)+""+("0"+x.getDate()).slice(-2)+"_"+("0"+x.getHours()).slice(-2)+""+("0"+x.getMinutes()).slice(-2)+""+("0"+x.getSeconds()).slice(-2);
				return titulo;
			}},
			{ extend: 'print', text: '<i class="fa fa-print"></i>',titleAttr: "Imprimir", 
			exportOptions: {
				columns: [1,2,3,4,5,6,7]
			},
		}
		],
		"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
			if (aData[7]=="SUSPENDIDO") {
				$('td', nRow).css('background-color', '#f2bfc4')
			} else if (aData[7]=="INGRESO FALLIDO") {
				$('td', nRow).css('background-color', '#f5c8ab')
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
			url: base_url+"auditoria/ficha_ingreso/" + id,
			type: 'GET',
			dataType: 'JSON',
		})
		.done(function(data) {
			$('#id_auditoria_ficha').text(data.id_auditoria_acceso);
			$('#usuario_ficha').text(data.login_usuario);
			$('#ingreso_ficha').text(data.ingreso);
			$('#ingresado_ficha').text(data.ingresado);
			$('#salida_ficha').text(data.salida);
			$('#expirado_ficha').html(data.expirado);
			$('#status_ficha').text(data.status);
			$('#vistaModal').modal('show');
			$('.modal-title').text('Ficha de Auditoria de Ingresos');
		})
		.fail(function() {
			console.log("error");
			alert('Error get data from ajax');
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
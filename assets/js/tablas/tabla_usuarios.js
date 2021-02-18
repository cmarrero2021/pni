	var accion_guardar;
	var url;
	var ajustarTamaño;
	function fecha_actual() {
		var x = new Date();
		var titulo = "usuarios_"+x.getFullYear()+""+("0"+(x.getMonth() +1)).slice(-2)+""+("0"+x.getDate()).slice(-2)+"_"+("0"+x.getHours()).slice(-2)+""+("0"+x.getMinutes()).slice(-2)+""+("0"+x.getSeconds()).slice(-2);
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
				url : "get_usuarios",
				type : 'GET'
			},		
			"dom": 'lrfBitp',
			buttons: [
			{
				text: "<i class='btn btn-xs fa fa-plus fa-2x bgc-asfaltohumedo clight'></i>",
				titleAttr: "Agregar nuevo usuario",
				action: function (e, dt, node, config) {
					$("#usuarios_form")[0].reset();
					accion_guardar = 'add';
					$('#usuarios_form').trigger("reset");
					$("#cedula").prop("readonly",false);
					$("#correo").prop("readonly",false);
					$("#cant").removeClass('fa fa-check');
					$("#cant").removeClass('csuccess');
					$("#cant").addClass('fa fa-times');
					$("#cant").addClass('cdanger');
					$("#num").removeClass('fa fa-check');
					$("#num").removeClass('csuccess');
					$("#num").addClass('fa fa-times');
					$("#num").addClass('cdanger');
					$("#esp").removeClass('fa fa-check');
					$("#esp").removeClass('csuccess');
					$("#esp").addClass('fa fa-times');
					$("#esp").addClass('cdanger');
					$("#min").removeClass('fa fa-check');
					$("#min").removeClass('csuccess');
					$("#min").addClass('fa fa-times');
					$("#min").addClass('cdanger');
					$("#may").removeClass('fa fa-check');
					$("#may").removeClass('csuccess');
					$("#may").addClass('fa fa-times');
					$("#may").addClass('cdanger');
					$("#inst").hide();
					$("#clave").show();
					$("#confirmar").show();
					$("label:contains('Clave')").show();
					$("label:contains('Confirmar')").show();
					$("#btnGuardar").css("display","none");
					$("#id_usuario").html('');
					$("#cont-etq-usuario").css("display","none");
					$('#userModal').modal('show');
					$('.modal-title').text('Agregar un nuevo usuario');
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
	function suspender(id) {
		var tabla = $('#item-list').DataTable();
		var filas = tabla.rows().count();
		var fila = 0;
		for (n=0;n<filas;n++) {
			if (tabla.cell(n,1).data() == id) {
				fila = n;
			}
		}
		var usuario = tabla.cell(fila,3).data() + " " +tabla.cell(fila,4).data();
		swal({
			title: '¿Está seguro de suspender al usuario '+usuario+'?',
			text: "Una vez que lo haga, el mismo no podrá ingresar al sistema",
			type: 'warning',
			dangerMode: true,
			showCancelButton: true,
			confirmButtonColor: '#d33',
			cancelButtonColor: '#3085d6',
			confirmButtonText: 'Suspender',
			cancelButtonText: 'Cancelar',
		}).then(result => {
			if (result.value) {
				var url;
				url = base_url+'usuarios/suspender_usuario/'+id;
				$.ajax({
					url: url,
					type: 'POST',
					dataType: 'JSON',
				})
				.done(function(data) {
					$('#userModal').modal('hide');
					$('#item-list').dataTable().api().ajax.reload();
					swal(
						'¡Registro Eliminado!',
						'El registro ha sido eliminado.',
						'success'
						);					
				})
				.fail(function() {
					swal(
						'¡ERROR EN LA OPERACIÓN!',
						'El registro no se pudo eliminar',
						'error'
						);
				})
				.always(function() {
				});
			}
		})
	}
	function editar(id) {
		accion_guardar = 'update';
		$("#id_registro").show();
		$.ajax({
			url: base_url+"usuarios/obtener_usuario/" + id,
			type: 'GET',
			dataType: 'JSON'
		})
		.done(function(data) {
			$('#usuarios_form').trigger("reset");
			$("#cedula").val(data.ci_usuario);
			$("#nombres").val(data.nombre_usuario);
			$("#apellidos").val(data.apellido_usuario);
			$("#correo").val(data.login_usuario);
			$("#telefono").val(data.telefono_usuario);
			if (data.activo == "t") {
				$("#activo").prop("checked",true);
			} else {
				$("#activo").prop("checked",false);
			}
			$("#roles").val(data.id_grupo);
			$("#cedula").prop("readonly",true);
			$("#correo").prop("readonly",true);
			$("#clave").hide();
			$("#confirmar").hide();
			$("label:contains('Clave')").hide();
			$("label:contains('Confirmar')").hide();
			$("#btnGuardar").css("display","block");
			$("#id_usuario").html(data.id_usuario);
			$("#cont-etq-usuario").css("display","block");
			$('#userModal').modal('show');
			$('.modal-title').text('Editar usuario');
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
	$('#cedula').on('keydown keypress',function(e){
		if(e.key.length === 1){
			if($(this).val().length < 8 && !isNaN(parseFloat(e.key))){
				$(this).val($(this).val() + e.key);
				campo($(this));
			}
			return false;
		}
	});
	$("#nombres").on('keyup',function() {
		$(this).val(function (_, val) {
			campo($(this));
			return val.toUpperCase();
		});
	});
	$("#apellidos").on('keyup',function() {
		$(this).val(function (_, val) {
			campo($(this));
			return val.toUpperCase();
		});
	});
	$("#correo").on('keyup',function() {
		$(this).val(function (_, val) {
			campo($(this));
			return val.toLowerCase();
		});
	});
	$('#telefono').on('keydown keypress',function(e){
		if(e.key.length === 1){
			if($(this).val().length < 11 && !isNaN(parseFloat(e.key))){
				$(this).val($(this).val() + e.key);
				campo($(this));
			}
			return false;
		}
	});
	$("#clave").on("focus",function() {
		$("#inst").show();
	});
	$("#clave").on('keyup',function(e) {
		var tecla = String.fromCharCode(e.which);
		if ($(this).val().length >= 8) {
			$("#cant").removeClass('fa fa-times');
			$("#cant").removeClass('cdanger');
			$("#cant").addClass('fa fa-check');
			$("#cant").addClass('csuccess');				
		} else {
			$("#cant").removeClass('fa fa-check');
			$("#cant").removeClass('csuccess');
			$("#cant").addClass('fa fa-times');
			$("#cant").addClass('cdanger');
		}
		if (!$(this).val().match(/\d/)) {
			$("#num").removeClass('fa fa-check');
			$("#num").removeClass('csuccess');
			$("#num").addClass('fa fa-times');
			$("#num").addClass('cdanger');
		}
		if (!$(this).val().match(/[^\w]/)) {
			$("#esp").removeClass('fa fa-check');
			$("#esp").removeClass('csuccess');
			$("#esp").addClass('fa fa-times');
			$("#esp").addClass('cdanger');
		}
		if (!$(this).val().match(/[a-z]/)) {
			$("#min").removeClass('fa fa-check');
			$("#min").removeClass('csuccess');
			$("#min").addClass('fa fa-times');
			$("#min").addClass('cdanger');
		}
		if (!$(this).val().match(/[A-Z]/)) {
			$("#may").removeClass('fa fa-check');
			$("#may").removeClass('csuccess');
			$("#may").addClass('fa fa-times');
			$("#may").addClass('cdanger');
		}
		campo($(this));
	});
	$("#clave").on("keypress",function(e) {
		var tecla = String.fromCharCode(e.which);
		if ( tecla.match(/[^\w]/)) {
			$("#esp").removeClass('fa fa-times');
			$("#esp").removeClass('cdanger');
			$("#esp").addClass('fa fa-check');
			$("#esp").addClass('csuccess');				
		}				
		if ($.isNumeric(tecla)) {
			$("#num").removeClass('fa fa-times');
			$("#num").removeClass('cdanger');
			$("#num").addClass('fa fa-check');
			$("#num").addClass('csuccess');
		}
		if (e.keyCode >= 65 && e.keyCode <= 90) {
			$("#may").removeClass('fa fa-times');
			$("#may").removeClass('cdanger');
			$("#may").addClass('fa fa-check');
			$("#may").addClass('csuccess');
		}
		if (e.charCode >= 97 && e.charCode <= 122) {
			$("#min").removeClass('fa fa-times');
			$("#min").removeClass('cdanger');
			$("#min").addClass('fa fa-check');
			$("#min").addClass('csuccess');
		}
	});
	$("#confirmar").on('keyup',function(e) {
		campo($(this));
	});
	$("#cedula").on("blur",function() {	
		if($(this).val().length <7 || $(this).val().length >8) {
			$(this).addClass("bgc-granada");
			$(this).addClass("color-error");
			$(this).val("Debe contener entre 7 y 8 dígitos");
		} else {
			$(this).removeClass("bgc-granada");
			$(this).removeClass("color-error");
		}
		var ced = $(this).val();
		var url = base_url+"registro/revisar_cedula/"+ced;
		$.ajax({
			url: url,
			type: 'get',
		})
		.done(function(data) {
			if(data !== "0") {
				$("#cedula").addClass("bgc-granada");
				$("#cedula").addClass("color-error");
				$("#cedula").val("La CI ya se encuentra registrada");
			} else {
				var url = base_url+"registro/buscar_cne/"+ced
				$.ajax({
					url: url,
					type: 'get',
					dataType: 'json',
				})
				.done(function(data) {
					var pnombre = data["primer_nombre"];
					var snombre = data["segundo_nombre"];
					var papellido = data["primer_apellido"];
					var sapellido = data["segundo_apellido"];
					var nombres = data["primer_nombre"] + " " + data["segundo_nombre"];
					var apellidos = data["primer_apellido"] + " " + data["segundo_apellido"];
					nombres = nombres.trim();
					apellidos = apellidos.trim();
					$("#nombres").val(nombres);
					$("#apellidos").val(apellidos);

				})
			}
		});	
	});
	$("#nombres").on("blur",function() {
		if($(this).val().trim().length == 0) {
			$(this).addClass("bgc-granada");
			$(this).addClass("color-error");
			$(this).val("No puede estar vacio");
		} else {
			$(this).removeClass("bgc-granada");
			$(this).removeClass("color-error");
		}
	});
	$("#apellidos").on("blur",function() {
		if($(this).val().trim().length == 0) {
			$(this).addClass("bgc-granada");
			$(this).addClass("color-error");
			$(this).val("No puede estar vacio");
		} else {
			$(this).removeClass("bgc-granada");
			$(this).removeClass("color-error");
		}
	});
	$("#correo").on("blur",function() {
		if($(this).val().indexOf('@', 0) == -1 || $(this).val().indexOf('.', 0) == -1) {
			$(this).addClass("bgc-granada");
			$(this).addClass("color-error");
			$(this).val("Formato erróneo de correo");
		} else {
			var cor = $(this).val();
			var url = base_url+"registro/revisar_correo/"+cor;
			$.ajax({
				url: url,
				type: 'get',
			})
			.done(function(data) {
				if(data !== "0") {
					$("#correo").addClass("bgc-granada");
					$("#correo").addClass("color-error");
					$("#correo").val("El correo ya se encuentra registrado");
				} else {					
					$("#correo").removeClass("bgc-granada");
					$("#correo").removeClass("color-error");
				}
			});		
		}
	});
	$("#telefono").on("blur",function() {
		var tel = $(this).val().trim();
		var mensaje ="";
		if (tel.length !=11 && mensaje.length == 0) {
			mensaje = "Debe tener 11 dígitos";
		}
		if ( tel.substr(0,1) != 0 && mensaje.length == 0) {
			mensaje = "Debe comenzar por 0";
		}
		if ( !tel.match(/\d+$/) && mensaje.length == 0) {
			mensaje = "Sólo puede contener números";
		}
		if (mensaje.length > 0) {
			$(this).addClass("bgc-granada");
			$(this).addClass("color-error");
			$(this).val(mensaje);
		} else {
			$(this).removeClass("bgc-granada");
			$(this).removeClass("color-error");
		}
	});
	$("#clave").on("blur",function() {
		var clv = $(this).val().trim();
		var mensaje ="";
		if (clv.length == 0 && mensaje.length == 0) {
			mensaje = "No puede estar vacia";
		}
		if ( clv.length < 8 && mensaje.length == 0) {
			mensaje = "Debe tener al menos 8 caracteres";
		}
		if ( !clv.match(/[A-z]/) && mensaje.length == 0) {
			mensaje = "Debe contener letras";
		}
		if ( !clv.match(/[A-Z]/) && mensaje.length == 0) {
			mensaje = "Debe contener al menos una letra mayúscula";
		}
		if ( !clv.match(/[a-z]/) && mensaje.length == 0) {
			mensaje = "Debe contener al menos una letra minúscula";
		}
		if ( !clv.match(/[^\w]/) && mensaje.length == 0) {
			mensaje = "Debe contener al menos un caracter especial";
		}
		if ( !clv.match(/\d/) && mensaje.length == 0) {
			mensaje = "Debe contener al menos un número";
		}
		var clave1 = $("#clave").val().trim()
		var clave2 = $("#confirmar").val().trim()
		if (clave1 != clave2 && clave1.length > 0 && clave2.length > 0  && mensaje.length == 0) {
			mensaje = "La clave y su confirmación no coinciden. Intente de nuevo";
		}
		if (mensaje.length > 0) {
			$("#mensaje").css("display","block");
			$("#mensaje").val(mensaje);
		} else {
			$("#mensaje").css("display","none");
			$("#mensaje").val("");
		}
		$("#inst").hide();
	});
	$("#confirmar").on("blur",function() {
		var clv = $(this).val().trim();
		var mensaje ="";
		if (clv.length == 0 && mensaje.length == 0) {
			mensaje = "No puede estar vacia";
		}
		if ( clv.length < 8 && mensaje.length == 0) {
			mensaje = "Debe tener al menos 8 caracteres";
		}
		if ( !clv.match(/[A-z]/) && mensaje.length == 0) {
			mensaje = "Debe contener letras";
		}
		if ( !clv.match(/[A-Z]/) && mensaje.length == 0) {
			mensaje = "Debe contener al menos una letra mayúscula";
		}
		if ( !clv.match(/[a-z]/) && mensaje.length == 0) {
			mensaje = "Debe contener al menos una letra minúscula";
		}
		if ( !clv.match(/[^\w]/) && mensaje.length == 0) {
			mensaje = "Debe contener al menos un caracter especial";
		}
		if ( !clv.match(/\d/) && mensaje.length == 0) {
			mensaje = "Debe contener al menos un número";
		}
		var clave1 = $("#clave").val().trim()
		var clave2 = $("#confirmar").val().trim()
		if (clave1 != clave2 && clave1.length > 0 && clave2.length > 0  && mensaje.length == 0) {
			mensaje = "La clave y su confirmación no coinciden. Intente de nuevo";
		}
		if (mensaje.length > 0) {
			$("#mensaje").css("display","block");
			$("#mensaje").val(mensaje);
		} else {
			$("#mensaje").css("display","none");
			$("#mensaje").val("");
		}
	});
	function campo(obj) {
		var form = $(obj).parents("#usuarios_form");
		var check = checkCampos(form);
		var errores = document.getElementsByClassName("bgc-granada").length;
		var err = false;
		if (errores > 1 ) {
			err = true;
		}
		if($("#mensaje").css("display")=="block") {
			var err_clv = true;
		} else {
			var err_clv = false;
		}
		if(check && !err && !err_clv) {
			$("#btnGuardar").css("display","block");
		} else {
			$("#btnGuardar").css("display","none");
		}			
	}
	function checkCampos(obj) {
		var camposRellenados = true;
		obj.find("input").each(function() {
			var id = $(this).prop("id");
			if (id =="mensaje" || id=='activo') {
				return true;
			}
			if( $(this).val().length == 0 ) {
				camposRellenados = false;
				return false;
			} else {
				camposRellenados = true;
				return true;
			}
		});
		if(camposRellenados == false) {
			return false;
		} else {
			return true;
		}
	}
	$("#btnGuardar").on('click',function() {
		/////////////////////////
		if (accion_guardar == 'add') {
			url=base_url+'usuarios/agregar_usuarios';
		} else {
			var id = $("#id_usuario").html();
			url=base_url+'usuarios/actualizar_usuario/'+id;
		}
		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'JSON',
			data: $('#usuarios_form').serialize()
		})
		.done(function(data) {
			$('#item-list').dataTable().api().ajax.reload();
			mod = "userModal";
			if (accion_guardar == 'add') {
				var msg = 'El registro ha sido guardado';
			} else {
				var msg = 'El registro ha sido actualizado';
			}
			swal(
				'¡OPERACIÓN EXITOSA!',
				msg,
				'success'
				);
			$("#"+mod).modal('hide');
			$("#usuarios_form")[0].reset();
		})
		.fail(function(data) {
			swal(
				'¡ERROR EN LA OPERACIÓN!',
				'El registro no se ha podido procesar',
				'error'
				);
			$("#userModal").modal('hide');
		})
		.always(function() {
		});
		////////////////////////
	});
// btnGuardar

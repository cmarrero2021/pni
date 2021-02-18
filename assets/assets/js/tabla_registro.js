var validacion = 0;
var mensaje ="";
$(document).ready(function() {
	$("#nombre").prop("readonly","true");
	$(".breadcrumb").width('37%');
	$("#main-content").css("margin-left","22%");
	$("#error_correo").hide();
	$("#error_correo").html('');
	$("#usuario").on('keyup', function() {
		var usuario = $(this).val().toLowerCase();
		$(this).val(usuario.toLowerCase());
	});
	$("#correo").on('keyup', function() {
		var correo = $(this).val().toLowerCase();
		$(this).val(correo.toLowerCase());
	});
	$("#correo2").on('keyup', function() {
		var correo2 = $(this).val().toLowerCase();
		$(this).val(correo2.toLowerCase());
	});
	$("#nombre").on('keyup', function() {
		var nombre = $(this).val().toUpperCase();
		$(this).val(nombre.toUpperCase());
	});
	$("#apellido").on('keyup', function() {
		var apellido = $(this).val().toUpperCase();
		$(this).val(apellido.toUpperCase());
	});
	$("#correo").on('blur', function() {
		validar_correo("correo","error_correo");
	});
	$("#correo2").on('blur', function() {
		validar_correo("correo2","error_correo2");
		comparar_correo("error_correo2");
	});
	$('#clave').blur(function() {
		validar_clave("clave","error_clave");
	});
	$('#clave2').blur(function() {
		validar_clave("clave2","error_clave2");
		comparar_clave("error_clave2");
	});
	// $('#telefono').blur(function() {
	// 	validar_telefono("telefono","error_telefono",2);
	// });

	// $('#telefono2').blur(function() {
	// 	validar_telefono("telefono2","error_telefono2",2);
	// });

	$('#celular').blur(function() {
		validar_telefono("celular","error_celular",4);
	});
	$('#celular2').blur(function() {
		validar_telefono("celular2","error_celular2",4);
	});
	$("#cedula").focus(function() {
		$("#cargando").hide();
	});
	$("#cedula").focusout(function() {
		var ci = $("#cedula").val().trim();
		mensaje ="";
		$.ajax({
			url: 'registro/verificar_cedula/'+ci,
			dataType: 'text',
			async:true,
			success: function(data) {
				valor = data.split(":");
				val = valor[1].replace("}","").replace('"','').replace('"','');
				mensaje = "";
				if (val == 1) {
					mensaje = "El numero de cédula ya está registrado";
					$("#nombre").val('');
				} else {
					var mensaje ="";
					if ((ci.length <7 || ci.length > 8) && mensaje.length==0) {
						mensaje = "El número de la cédula debe tener 7 u 8 dígitos";
					}
					if ((!/^([0-9])*$/.test(ci)) && mensaje.length==0) {
						mensaje = "El número de la cédula sólo puede contener números";
					}
				}
				if (mensaje.length == 0) {
					$("#error_cedula").html('');
					$("#cargando").show();
					$.ajax({
						url: 'registro/buscar_cne/'+ci,
						type: 'POST',
						dataType: 'TEXT',
						data: ci,
					})
					.done(function(data) {
						if (data.trim().length > 0 && data != '""') {
							$("#nombre").val(data.replace(/['"]+/g, ''));
							$("#nombre").attr("placeholder","");
							$("#nombre").prop('readonly', true);
						} else {
							$("#nombre").attr("placeholder","No se pudo indetificar al usuario por su número de cédula; introduzca el nombre del usuario");
							$("#nombre").prop('readonly', false);
						}
					})
					.fail(function() {
						$("#nombre").prop('readonly', false);
					})
					.always(function() {
						$("#cargando").hide();
					});
				}
				$("#error_cedula").html(mensaje);
			},
			error: function(data){
			}
		});	
	});
	$("#usuario").on('blur', function() {
		validar_usuario();
	});
	$("#enviar").on('click',function() {
		var registro = unescape(decodeURIComponent($("#registro_form").serialize())).split('&');
		var validar = true;
		for (n= (registro.length -1) ; n>=0; n--) {
			var reg = registro[n].split("=");
			campo = reg[0];
			lcampo = campo.length;
			if (($("#"+reg[0]).val().length = 0 || $("#error_"+campo).html().length > 0) && val) {
				validar = false;
				swal(
					'¡EL CAMPO '+reg[0]+" ESTÁ VACIO O TIENE UN ERROR!",
					'Revise e intente de nuevo',
					'error'
					);	
			} 

		}
		var datos = unescape(decodeURIComponent($("#registro_form").serialize()));
		if (validar) {
			$.ajax({
				url: 'registro/registrar_usuario',
				type: 'POST',
				dataType:'TEXT',
				data:datos
			})
			.done(function() {
				swal(
					'¡OPERACIÓN EXITOSA!',
					'El usuario ha sido registrado; le ha sido enviado un correo de confirmación; recuerde que debe confirmar su correo para poder acceder al sistema',
					'success'
					);
				$("#userModal").modal('hide');
				// redirect();
				window.location.href = base_url+"login";
			})
			.fail(function() {

			})
			.always(function() {

			});
		}

	});
	function comparar_correo(div) {
		var correo1 = $("#correo").val().trim()
		var correo2 = $("#correo2").val().trim()
		if (correo1 != correo2) {
			$("#"+div).hide();
			$("#"+div).html("El correo y su confirmación no coinciden. Revise e intente de nuevo");
			$("#"+div).show();
		} else {
			$("#error_correo").hide();
			$("#error_correo").html('');
			$("#error_correo2").hide();
			$("#error_correo2").html('');
		}
	}
	function validar_correo(correo,div) {
		var email = $("#"+correo).val().trim();
		if (email.length > 0 ){
			var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
			$.ajax({
				url: "registro/verificar_correo/"+email,
				type: 'POST',
				dataType: 'TEXT',
				// data: {param1: 'value1'},
			})
			.done(function(data) {
				valor = data.split(":");
				val = valor[1].replace("}","").replace('"','').replace('"','');
				mensaje = "";
				if (val == 1) {
					$("#"+div).hide();
					$("#"+div).html("La dirección de correo ya ha sido registrada");
					$("#"+div).show();				
				} else {
					if (regex.test($("#"+correo).val().trim())) {
						$("#"+div).hide();
						$("#"+div).html('');
					} else {
						$("#"+div).hide();
						$("#"+div).html("Dirección de correo inválida. Revise e intente de nuevo");
						$("#"+div).show();
					}
				}
			})
			.fail(function() {
			})
			.always(function() {
			});
		} else {
			$("#"+div).hide();
			$("#"+div).html("No puede dejar la dirección de correo vacia");
			$("#"+div).show();
		}	
	}
	function validar_telefono(campo,div,pref) {
		var clv = $("#"+campo).val().trim();
		var mensaje ="";
		if (clv.length !=11 && mensaje.length == 0) {
			mensaje = "El número telefónico debe tener 11 dígitos, comenzando con 0";
		}
		if ( clv.substr(0,1) != 0 && mensaje.length == 0) {
			mensaje = "El número telefónico debe comenzar por 0";
		}
		if ( clv.substr(1,1) != pref && mensaje.length == 0) {
			mensaje = "El segundo dígito del número telefónico debe ser "+pref;
		}
		if ( !clv.match(/\d+$/) && mensaje.length == 0) {
			mensaje = "El número telefónico sólo puede contener números";
		}
		if (campo == "telefono" || campo=="telefono2") {
			var telefono1 = $("#telefono").val().trim();
			var telefono2 = $("#telefono2").val().trim();
		} else {
			var telefono1 = $("#celular").val().trim();
			var telefono2 = $("#celular2").val().trim();

		}
		if (telefono1 != telefono2 && telefono1.length > 0 && telefono2.length > 0) {
			mensaje = "El número de teléfono y su cnfirmación no coinciden. Revise e intente de nuevo";
		}
		if (mensaje.length==0) {
			$("#"+div).hide();
			$("#"+div).html('');
		} else {
			$("#"+div).hide();
			$("#"+div).html(mensaje);
			$("#"+div).show();
		}
	}
	function validar_clave(campo,div) {
		var clv = $("#"+campo).val().trim();
		var mensaje ="";
		if (clv.length == 0 && mensaje.length == 0) {
			mensaje = "La clave no puede estar vacia";
		}
		if ( clv.length < 8 && mensaje.length == 0) {
			mensaje = "La clave debe tener al menos 8 caracteres";
		}
		if ( !clv.match(/[A-z]/) && mensaje.length == 0) {
			mensaje = "La clave debe contener letras";
		}
		if ( !clv.match(/[A-Z]/) && mensaje.length == 0) {
			mensaje = "La clave debe contener al menos una letra mayúscula";
		}
		if ( !clv.match(/[a-z]/) && mensaje.length == 0) {
			mensaje = "La clave debe contener al menos una letra minúscula";
		}

		if ( !clv.match(/[^\w]/) && mensaje.length == 0) {
			mensaje = "La clave debe contener al menos un caracter especial";
		}
		if ( !clv.match(/\d/) && mensaje.length == 0) {
			mensaje = "La clave debe contener al menos un número";
		}
		if (mensaje.length==0) {
			$("#"+div).hide();
			$("#"+div).html('');
		} else {
			$("#"+div).hide();
			$("#"+div).html(mensaje);
			$("#"+div).show();
		}
	}
	function comparar_clave(div) {
		var clave1 = $("#clave").val().trim()
		var clave2 = $("#clave2").val().trim()
		if (clave1 != clave2 && clave1.length > 0 && clave2.length > 0) {
			$("#"+div).hide();
			$("#"+div).html("La clave y su cnfirmación no coinciden. Intente de nuevo");
			$("#"+div).show();
		} else {
			$("#error_clave").hide();
			$("#error_clave").html('');
			$("#error_clave2").hide();
			$("#error_clave2").html('');
		}
	}
	function validar_usuario() {
		var usuario = $("#usuario").val().trim();
		var mensaje ="";
		if (usuario.length == 0 && mensaje.length == 0) {
			mensaje = "El nombre de usuario no puede estar vacio";
		} else {
			$.ajax({
				url: 'registro/revisar_usuario/'+usuario,
				type: 'POST',
				data: usuario,
			})
			.done(function(data) {
				if (data.length > 4 ) {
					$("#error_usuario").html("El nombre de usuario "+usuario+" ya está en uso; intente de nuevo con uno distinto");
				} else {
					$("#error_usuario").html('');
				}
			})
			.fail(function(data) {
			})
			.always(function() {
			});
		}
	}
	function guardar(){
		if (accion_guardar == 'add') {
			url=base_url+'motivo/ajax_agregar';
		} else {
			url=base_url+'motivo/ajax_actualizar';
		}
		var motivo = $('#motivo').val();
		if (motivo =="") {
			swal(
				'¡ERROR EN LA OPERACIÓN',
				'Debe indicar el nombre del motivo',
				'error'
				);			
		} else {
			$.ajax({
				url: url,
				type: 'POST',
				dataType: 'JSON',
				data: $('#motivo_form').serialize(),
			})
			.done(function() {

			})
			.fail(function() {
				swal(
					'¡ERROR EN LA OPERACIÓN!',
					'El registro no se ha podido procesar',
					'error'
					);
			})
			.always(function() {
			});
		}
	}

});
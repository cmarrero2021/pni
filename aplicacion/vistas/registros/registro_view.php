<?php
if ($this->session->userdata("cedula") !==null) {
	$registrado = 1;
} else {
	$registrado = 0;
}
?>
<body class="cuerpo-r">
	<img src="<?php echo base_url(); ?>assets/img/logo_pni-01.png" class="logo-pni2">
	<div class="container margen-login">
		<form id="frm_registro">
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label class="verdeclaro" for="cedula">Cédula de Identidad</label>
						<div class="row">
							<div class="col-xm-12 cols-sm-12 col-md-12">
								<input type="text" name="cedula" id="cedula" class="form-control borde-v-3" placeholder="Cédula de Identidad">
							</div>
							<div class="col-xm-1 cols-sm-1 col-md-1" style="display:block;margin-left:-10%;margin-top:-2%"><img id="verced" src="<?php echo base_url(); ?>assets/img/buscar.gif" style="display:none;" width="40px">
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="verdeclaro" for="pnombre">Primer Nombre</label>
						<input type="text" name="pnombre" id="pnombre" class="form-control borde-v-3" placeholder="Primer Nombre">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="verdeclaro" for="snombre">Segundo nombre</label>
						<input type="text" name="snombre" id="snombre" class="form-control" placeholder="Segundo nombre">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="verdeclaro" for="papellido">Primer Apellido</label>
						<input type="text" name="papellido" id="papellido" class="form-control borde-v-3" placeholder="Primer Apellido">
					</div>
				</div>		
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label class="verdeclaro" for="sapellido">Segundo Apellido</label>
						<input type="text" name="sapellido" id="sapellido" class="form-control" placeholder="Segundo Apellido">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="verdeclaro" for="genero">Género</label>
						<select id="genero" name="genero" class="form-control borde-v-3"></select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="verdeclaro" for="fnac">Fecha de Nacimiento</label>
						<input type="date" name="fnac" id="fnac" class="form-control borde-v-3" placeholder="Fecha de Nacimiento">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="verdeclaro" for="ecivil">Estado Civil</label>
						<select id="ecivil" name="ecivil" class="form-control borde-v-3"></select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label class="verdeclaro" for="estado">Estado</label>
						<select id="estado" name="estado" class="form-control borde-v-3"></select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="verdeclaro" for="municipio">Municipio</label>
						<select id="municipio" name="municipio" class="form-control borde-v-3"></select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="verdeclaro" for="parroquia">Parroquia</label>
						<select id="parroquia" name="parroquia" class="form-control borde-v-3"></select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="verdeclaro" for="cpostal">Código Postal</label>
						<select id="cpostal" name="cpostal" class="form-control borde-v-3"></select>
					</div>
				</div>
			</div>
			<div class="row" style="z-index: 1000;">
				<div class="col-md-3">
					<div class="form-group">
						<label class="verdeclaro" for="telefono">Teléfono</label>
						<input type="text" name="telefono" id="telefono" class="form-control borde-v-3" placeholder="Teléfono">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="verdeclaro" for="celular">Celular</label>
						<input type="text" name="celular" id="celular" class="form-control borde-v-3" placeholder="Celular">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="verdeclaro" for="correo">Correo</label>
						<input type="email" name="correo" id="correo" class="form-control borde-v-3" placeholder="Correo" required>
					</div>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label class="verdeclaro" for="profesion">Profesion</label>
						<select id="profesion" name="profesion" class="form-control borde-v-3"></select>
					</div>
				</div>				
				<div class="col-md-3">
					<div class="form-group">
						<label class="verdeclaro" for="tinst">Tipo de Institución</label>
						<select id="tinst" name="tinst" class="form-control borde-v-3"></select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="verdeclaro" for="institucion">Nombre Institución de Adscripción</label>
						<input type="text" name="institucion" id="institucion" class="form-control borde-v-3" placeholder="Nombre de la Institución">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="verdeclaro" for="invcolind">Cómo investiga</label>
						<select id="invcolind" name="invcolind" class="form-control borde-v-3"></select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label class="verdeclaro" for="invcolind">Sector empleo</label>
						<select id="sector_empleo" name="sector_empleo" class="form-control borde-v-3"></select>
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<label class="verdeclaro" for="tipo_investigador">Tipo de investigador</label>
						<select id="tipo_investigador" name="tipo_investigador" class="form-control borde-v-3" multiple="multiple"></select>
					</div>
				</div>	



			</div>

			<div class="row">
				<div class="col-md-5 col-md-offset-1">
					<div class="form-group">
						<label class="verdeclaro" for="intinv">Tiene interés investigar en</label>
						<select id="intinv" name="intinv" class="form-control borde-v-3" multiple="multiple"></select>
					</div>
				</div>	
				<div class="col-md-5">
					<div class="form-group">
						<label class="verdeclaro" for="invact">Investigación actual:</label>
						<select id="invact" name="invact" class="form-control borde-v-3" multiple="multiple"></select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group" style="margin-top:1%;">
						<label class="verdeclaro" for="mensaje"></label>
						<input type="text" name="mensaje" id="mensaje" class="form-control bgc-granada color-error-ro" style="display:none;text-align: right;" readonly>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label class="verdeclaro" for="clave">Clave</label>
						<input type="password" name="clave" id="clave" class="form-control borde-v-3" placeholder="Introduzca su clave">
					</div>
					<div id="inst" class="row" style="background-color:#ddd;margin-right:-120%;margin-left:5%;padding-right:1%;display:none;">
						<ul>
							<i id="cant" class="fa fa-times cdanger" aria-hidden="true"></i>La clave debe tener al menos 8 caracteres<br/>
							<i id="min" class="fa fa-times cdanger" aria-hidden="true"></i>La clave debe tener al menos una minúscula<br/>
							<i id="may" class="fa fa-times cdanger" aria-hidden="true"></i>La clave debe tener al menos una mayúscula<br/>
							<i id="num" class="fa fa-times cdanger" aria-hidden="true"></i>La clave debe tener al menos un número<br/>
							<i id="esp" class="fa fa-times cdanger" aria-hidden="true"></i>La clave debe tener al menos un caracter especial
						</ul>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label class="verdeclaro" for="confirmar">Confirme su clave</label>
						<input type="password" name="confirmar" id="confirmar" class="form-control borde-v-3" placeholder="Confirme su clave">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group" id="aceptar" style="display:none;">
						<label class="verdeclaro" for="aceptar">REVISE SUS DATOS</label>
						<input type="button" name="aceptar_btn" id="aceptar_btn" class="form-control" value="REGISTRAR" > 
					</div>
				</div>
				<div class="col-md-4">
					<img id="envcor" src="<?php echo base_url(); ?>assets/img/buscar.gif" style="display:none;" width="80px">
				</div>
			</form>
		</div>
	</body>
	<script type="text/javascript">
		var cat_digitos = 0;
		$(document).ready(function() {
			url = base_url+"registro/obtener_genero";
			$.ajax({
				url: url,
				type: 'get',
				dataType: 'json',
			})
			.done(function(data) {
				$('#genero').append('<option value=0 selected>Seleccione el género</option>'); 
				$(data).each(function (i, val) {
					$('#genero').append('<option value='+val["id_genero"]+'>'+val["nombre_genero"]+'</option>');
				});
			});
			url = base_url+"registro/obtener_edociv";
			$.ajax({
				url: url,
				type: 'get',
				dataType: 'json',
			})
			.done(function(data) {
				$('#ecivil').append('<option value=0>Seleccione el estado civil</option>'); 
				$(data).each(function (i, val) {
					$('#ecivil').append('<option value='+val["id_estado_civil"]+'>'+val["nombre_estado"]+'</option>');
				});
			});
			url = base_url+"registro/obtener_estado";
			$.ajax({
				url: url,
				type: 'get',
				dataType: 'json',
			})
			.done(function(data) {
				$('#estado').append('<option value=0>Seleccione el estado</option>'); 
				$(data).each(function (i, val) {
					$('#estado').append('<option value='+val["id_estado"]+'>'+val["estado"]+'</option>');
				});
			});
			url = base_url+"registro/obtener_profesion";
			$.ajax({
				url: url,
				type: 'get',
				dataType: 'json',
			})
			.done(function(data) {
				$('#profesion').append('<option value=0>Seleccione la profesión</option>'); 
				$(data).each(function (i, val) {
					if (val["profesion"]==='OTRA') {
						$('#profesion').append('<option value='+val["id_profesion"]+'>'+val["profesion"]+'</option>');
					}
				});
				$(data).each(function (i, val) {
					if (val["profesion"] !=='OTRA') {
						$('#profesion').append('<option value='+val["id_profesion"]+'>'+val["profesion"]+'</option>');
					}
				});
			});
			url = base_url+"registro/obtener_tipo_institucion";
			$.ajax({
				url: url,
				type: 'get',
				dataType: 'json',
			})
			.done(function(data) {
				$('#tinst').append('<option value=0>Seleccione el tipo de institución</option>'); 
				$(data).each(function (i, val) {
					$('#tinst').append('<option value='+val["id_tipo_institucion"]+'>'+val["tipo_institucion"]+'</option>');
				});
			});
			url = base_url+"registro/obtener_linea_investigacion";
			$.ajax({
				url: url,
				type: 'get',
				dataType: 'json',
			})
			.done(function(data) {
				var n=0;
				var grupo = "";
				$(data).each(function (i, val) {
					if (n==0 || n==7 || n==12) {
						$('#intinv').append('<optgroup label='+val["grupo"]+'>');
					}
					$('#intinv').append('<option value='+val["id_lineas_presidenciales"]+'>'+val["nombre_lineas_presidenciales"]+'</option>');
					if (n==6 || n==11 || n== 18) {
						$('#intinv').append('</optgroup>');
					}
					n++;
				});
				n=0;
				grupo = "";				
				$(data).each(function (i, val) {
					if (n==0 || n==7 || n==12) {
						$('#invact').append('<optgroup label='+val["grupo"]+'>');
					}
					$('#invact').append('<option value='+val["id_lineas_presidenciales"]+'>'+val["nombre_lineas_presidenciales"]+'</option>');
					if (n==6 || n==11 || n==18) {
						$('#invact').append('</optgroup>');
					}
					n++;
				});
			});		
			url = base_url+"registro/obtener_modo_investigacion";
			$.ajax({
				url: url,
				type: 'get',
				dataType: 'json',
			})
			.done(function(data) {
				$('#invcolind').append('<option value=0>Seleccione la manera de investigar</option>'); 
				$(data).each(function (i, val) {
					$('#invcolind').append('<option value='+val["id_modo_investigacion"]+'>'+val["modo_investigacion"]+'</option>');
				});
			});
			url = base_url+"registro/obtener_sector_empleo";
			$.ajax({
				url: url,
				type: 'get',
				dataType: 'json',
			})
			.done(function(data) {
				$('#sector_empleo').append('<option value=0>Seleccione el sector de empleo</option>'); 
				$(data).each(function (i, val) {
					$('#sector_empleo').append('<option value='+val["id_sector_empleo"]+'>'+val["sector_empleo"]+'</option>');
				});
			});
			url = base_url+"registro/obtener_tipo_investigador";
			$.ajax({
				url: url,
				type: 'get',
				dataType: 'json',
			})
			.done(function(data) {
				$(data).each(function (i, val) {
					$('#tipo_investigador').append('<option value='+val["id_tipo_investigador"]+'>'+val["tipo_investigador"]+'</option>');
				});
			});
			$('#municipio').append('<option value=0>Seleccione un estado para seleccionar el municipio</option>');
			$('#parroquia').append('<option value=0>Seleccione un municipio para seleccionar la parroquia</option>');
			$('#cpostal').append('<option value=0>Seleccione una parroquia para seleccionar el código postal</option>');
			$("#estado").on("change",function(){
				var estado = $(this).val();
				var url = base_url+"registro/obtener_municipios/"+estado;
				$.ajax({
					url: url,
					type: 'get',
					dataType: 'json',
				})
				.done(function(data) {
					$('#municipio').find('option').not(':first').remove();
					$('#parroquia').find('option').not(':first').remove();
					$('#postal').find('option').not(':first').remove();
					$(data).each(function (i, val) {
						$('#municipio').append('<option value='+val["id_municipio"]+'>'+val["municipio"]+'</option>');
					});
				})
				campo($(this));
			});
			$("#municipio").on("change",function(){
				var municipio = $(this).val();
				var url = base_url+"registro/obtener_parroquias/"+municipio;
				$.ajax({
					url: url,
					type: 'get',
					dataType: 'json',
				})
				.done(function(data) {
					$('#parroquia').find('option').not(':first').remove();
					$('#postal').find('option').not(':first').remove();
					$(data).each(function (i, val) {
						$('#parroquia').append('<option value='+val["id_parroquia"]+'>'+val["parroquia"]+'</option>');
					});
				})
				campo($(this));
			});
			$("#parroquia").on("change",function(){
				var parroquia = $(this).val();
				var url = base_url+"registro/obtener_zonas/"+parroquia;
				$.ajax({
					url: url,
					type: 'get',
					dataType: 'json',
				})
				.done(function(data) {
					$('#postal').find('option').not(':first').remove();
					$(data).each(function (i, val) {
						$('#cpostal').append('<option value='+val["id_zona"]+'>'+val["codigo_postal"]+'</option>');
					});
				})
				campo($(this));
			});
			$('#cedula').on('keydown keypress',function(e){
				if(e.key.length === 1){
					if($(this).val().length < 8 && !isNaN(parseFloat(e.key))){
						$(this).val($(this).val() + e.key);
					}
					return false;
				}
			});
			$('#rif').keyup(function() {
				var datos = new String($(this).val());
				datos = datos.toUpperCase(datos);

				$(this).val(datos);
			});
			$('#institucion').keyup(function() {
				var datos = new String($(this).val());
				datos = datos.toUpperCase(datos);
				$(this).val(datos);
			});
			$('#pnombre').keyup(function() {
				var datos = new String($('#pnombre').val());
				datos = datos.toUpperCase(datos);
				$('#pnombre').val(datos);
			})
			$('#snombre').keyup(function() {
				var datos = new String($('#snombre').val());
				datos = datos.toUpperCase(datos);
				$('#snombre').val(datos);
			})
			$('#papellido').keyup(function() {
				var datos = new String($('#papellido').val());
				datos = datos.toUpperCase(datos);
				$('#papellido').val(datos);
			})
			$('#sapellido').keyup(function() {
				var datos = new String($('#sapellido').val());
				datos = datos.toUpperCase(datos);
				$('#sapellido').val(datos);
			})
			$('#telefono').on('keydown keypress',function(e){
				if(e.key.length === 1){
					if($(this).val().length < 11 && !isNaN(parseFloat(e.key))){
						$(this).val($(this).val() + e.key);
					}
					return false;
				}
			});
			$('#celular').on('keydown keypress',function(e){
				if(e.key.length === 1){
					if($(this).val().length < 11 && !isNaN(parseFloat(e.key))){
						$(this).val($(this).val() + e.key);
					}
					return false;
				}
			});
			$('#correo').keyup(function() {
				var datos = new String($('#correo').val());
				datos = datos.toLowerCase(datos);
				$('#correo').val(datos);
			})
			$('#ninst').keyup(function() {
				var datos = new String($('#ninst').val());
				datos = datos.toUpperCase(datos);
				$('#ninst').val(datos);
			})
			$('#rinst').keyup(function() {
				var datos = new String($('#rinst').val());
				datos = datos.toUpperCase(datos);
				$('#rinst').val(datos);
			})
			$("#genero").on("change",function() {
				campo($(this));
			});
			$("#ecivil").on("change",function() {
				campo($(this));
			});
			$("#profesion").on("change",function() {
				campo($(this));
			});
			$("#tinst").on("change",function() {
				campo($(this));
			});
			$("#intinv").on("change",function() {
				campo($(this));
			});
			$("#invact").on("change",function() {
				campo($(this));
			});
			$("#invcolind").on("change",function() {
				if ($(this).val()==4) {
					$("#invact").val('');
					$("#invact").prop("disabled","true");
				} else {
					$("#invact").removeAttr("disabled");
				}
				campo($(this));
			});
			$("#cpostal").on("change",function() {
				campo($(this));
			});
			$("#frm_registro input").keyup(function() {
				campo($(this));
			});
			function campo(obj) {
				var form = $(obj).parents("#frm_registro");
				var check = checkCampos(form);
				var count = 0;
				$('select').each(function(){
					var id = $(this).prop("id");
					var modo = $("#invcolind").val();
					if (modo == 4 && (id == "intinv" || id == "invact")) {
						count ++; 
					} else {
						if((!$.isArray($(this).val()) && $(this).val() > 0) || ($.isArray($(this).val()) && $(this).val().length > 0&& $(this).val().length < 4) ) {
							count ++; 
						} else {
							count --;
						}
					}
				})
				if(count >= 11) {
					var check1=true;
				} else {
					var check1=false;
				}
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
				if(check && check1 && !err && !err_clv) {
					$("#aceptar").css("display","block");
				} else {
					$("#aceptar").css("display","none");
				}
				if ("<?php echo $mostrar; ?>"=="block") {
					$("#aceptar").css("display","block");
				}
			}
			function checkCampos(obj) {
				var camposRellenados = true;
				obj.find("input").each(function() {
					var id = $(this).prop("id");
					if (id == "snombre" || id =="sapellido" || id =="mensaje" || id =="interes" || id =="actual") {
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
						$("#cedula").parent().removeClass('col-xs-12');
						$("#cedula").parent().removeClass('col-sm-12');
						$("#cedula").parent().removeClass('col-md-12');
						$("#cedula").parent().addClass('col-xs-8');
						$("#cedula").parent().addClass('col-sm-8');
						$("#cedula").parent().addClass('col-md-11');
						$("#verced").show();
						$.ajax({
							url: url,
							type: 'get',
							dataType: 'json',
							async:false,
						})
						.done(function(data) {
							var pnombre = data["primer_nombre"];
							var snombre = data["segundo_nombre"];
							var papellido = data["primer_apellido"];
							var sapellido = data["segundo_apellido"];
							var fnac = data["fecha_nacimiento"];
							var genero = data["sexo"];
							if (data["primer_nombre"] === '') {
								$("#pnombre").val('');
								$("#snombre").val('');
								$("#papellido").val('');
								$("#sapellido").val('');
								$("#fnac").val('');
								$("#genero").val('');
							} else {
								$("#pnombre").val(pnombre);
								$("#snombre").val(snombre);
								$("#papellido").val(papellido);
								$("#sapellido").val(sapellido);
								$("#fnac").val(fnac);
								$("#genero").val(genero);
							}
							$("#cedula").parent().removeClass('col-xs-8');
							$("#cedula").parent().removeClass('col-sm-8');
							$("#cedula").parent().removeClass('col-md-11');
							$("#cedula").parent().addClass('col-xs-12');
							$("#cedula").parent().addClass('col-sm-12');
							$("#cedula").parent().addClass('col-md-12');
							$("#verced").hide();
						})
					}
				});		
			});
			$("#pnombre").on("blur",function() {
				if($(this).val().trim().length == 0) {
					$(this).addClass("bgc-granada");
					$(this).addClass("color-error");
					$(this).val("No puede estar vacio");
				} else {
					$(this).removeClass("bgc-granada");
					$(this).removeClass("color-error");
				}
			});
			$("#papellido").on("blur",function() {
				if($(this).val().trim().length == 0) {
					$(this).addClass("bgc-granada");
					$(this).addClass("color-error");
					$(this).val("No puede estar vacio");
				} else {
					$(this).removeClass("bgc-granada");
					$(this).removeClass("color-error");
				}
			});

			$("#ninst").on("blur",function() {
				if($(this).val().trim().length == 0) {
					$(this).addClass("bgc-granada");
					$(this).addClass("color-error");
					$(this).val("No puede estar vacio");
				} else {
					$(this).removeClass("bgc-granada");
					$(this).removeClass("color-error");
				}
			});
			$("#rif").on("blur",function() {
				var rif = $(this).val().trim();
				var mensaje ="";
				if (rif.length ==10 && mensaje.length == 0) {
					mensaje = "La dirección no puede estar vacia";
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
			$("#celular").on("blur",function() {
				var clv = $(this).val().trim();
				var mensaje ="";
				if (clv.length !=11 && mensaje.length == 0) {
					mensaje = "Debe tener 11 dígitos";
				}
				if ( clv.substr(0,2) != 04 && mensaje.length == 0) {
					mensaje = "Debe comenzar por 04";
				}
				if ( !clv.match(/\d+$/) && mensaje.length == 0) {
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
			$("#clave").on("focus",function() {
				$("#inst").show();
			});
			$("#clave").on("keyup",function(e) {
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
					$("#aceptar").show();
				}
			});
			$("#aceptar_btn").on("click",function() {
				////////////////////////
				$("select").each(function() {
					var control = $(this).attr("id");
					if (control !="perinv") {
						var idControl = "#"+control+" option:selected";
						var seleccionado = $(idControl).text();
						if (seleccionado.length==0 || seleccionado.indexOf("Seleccione")==0 ) {
							$(this).addClass('bgc-granada');
							$(this).addClass('color-error');
						} else {
							$(this).removeClass('bgc-granada');
							$(this).removeClass('color-error');
						}
					}
				});
				$("input:text").each(function() {
					var id = $(this).attr("id");
					if (id !="snombre" && id !="sapellido" && id !="mensaje") {
						var cont = $(this).val().trim().length;
						if (cont ==0) {
							$(this).addClass('bgc-granada');
							$(this).addClass('color-error');
						} else {
							$(this).removeClass('bgc-granada');
							$(this).removeClass('color-error');
						}
					}
				});
				$("input[type='date']").each(function() {
					var id = $(this).attr("id");
					var cont = $(this).val().trim().length;
					if (cont ==0) {
						$(this).addClass('bgc-granada');
						$(this).addClass('color-error');
					} else {
						$(this).removeClass('bgc-granada');
						$(this).removeClass('color-error');

					}
				});
				$("input[type='email']").each(function() {
					var id = $(this).attr("id");
					var cont = $(this).val().trim().length;
					if (cont ==0) {
						$(this).addClass('bgc-granada');
						$(this).addClass('color-error');
					} else {
						$(this).removeClass('bgc-granada');
						$(this).removeClass('color-error');
					}
				});
				var continuar = true;
				$('*').each(function() {
					var id = $(this).attr('id');
					if (
						$(this).hasClass('bgc-granada') && 
						id != "mensaje" || 
						(
							$(this).prop('nodeName')=="INPUT" &&  
							(
								$(this).attr('type')=="text" || 
								$(this).attr('type')=="date" || 
								$(this).attr('type')=="email" || 
								$(this).attr('type')=="password"
								) 
							&&
							(
								$(this).val() == "No puede estar vacio" ||
								$(this).val() == "La CI ya se encuentra registrada" ||
								$(this).val() == "No puede estar vacio" ||
								$(this).val() == "La CI ya se encuentra registrada" ||
								$(this).val() == "Debe comenzar por 02" ||
								$(this).val() == "Debe comenzar por 04" ||
								$(this).val() == "Debe tener 11 dígitos" ||
								$(this).val() == "Formato erróneo de correo"
								)
							)
						)
					{
						$(this).addClass('bgc-granada');
						$(this).addClass('color-error');
						continuar = false;
					}
				});
				if (continuar) {
					url = base_url+"registro/insertar_investigador";
					$("#envcor").show();
					$(this).hide();
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
					$.ajax({
						url: url,
						type: 'post',
						dataType: 'text',
						async:false,
						data: {
							cedula:$("#cedula").val(),
							pnombre:$("#pnombre").val(),
							snombre:$("#snombre").val(),
							papellido:$("#papellido").val(),
							sapellido:$("#sapellido").val(),
							genero:$("#genero").val(),
							fnac:$("#fnac").val(),
							ecivil:$("#ecivil").val(),
							estado:$("#estado").val(),
							municipio:$("#municipio").val(),
							parroquia:$("#parroquia").val(),
							cpostal:$("#cpostal").val(),
							telefono:$("#telefono").val(),
							celular:$("#celular").val(),
							correo:$("#correo").val(),
							profesion:$("#profesion").val(),
							tinst:$("#tinst").val(),
							institucion:$("#institucion").val(),
							intinv:$("#intinv").val(),
							invact:$("#invact").val(),
							invcolind:$("#invcolind").val(),
							mensaje:$("#mensaje").val(),
							clave:$("#clave").val(),
							confirmar:$("#confirmar").val()
						},
					})
					.done(function(data) {
						var correo = $("#correo").val();
						swal({
							title: 'REGISTRO EXITOSO!',
							text: 'Se ha creado exitosamente el registro y se ha mandando un correo de verificación a '+correo,
							icon: "success",
						}).then(redirigir => {
							$("#frm_registro").find('input:text, input:password, input:file, select, textarea').val('');
							$("#frm_registro").find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
							window.location.href=base_url;
						})
					})
					.fail(function(data) {
						$(this).show();
						swal(
							'¡REGISTRO FALLIDO!',
							'Ha ocurrido un error al intentar guardar el registro',
							'error'
							);					
					})
					.always(function() {
						$("#envcor").hide();
					});
				} else {
					swal(
						'¡HA DEJADO UN CAMPO REQUERIDO VACIO O CON ERROR!',
						'Revise los campos marcados en rojo y suministre la información solicitada',
						'error'
						);	
				}
			});

$("#intinv").click(function() {
	if ($("#intinv").val().length > 3) {
		swal('SOLO PUEDE SELECCIONAR 3 OPCIONES','','error');
		$("#intinv").val('');
	}
});
$("#invact").click(function() {
	if ($("#invact").val().length > 3) {
		swal('SOLO PUEDE SELECCIONAR 3 OPCIONES','','error');
		$("#invact").val('');
	}
});
});
</script>
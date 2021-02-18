<?php
$inv1 = $investigador["inv1"];
$act1 = $investigador["act1"];
if (count($investigador) > 2) {
	$editar = " readonly ";
} else {
	$editar = "";
}
$interes='"'.str_replace("}","",str_replace("{", "", $investigador["inv1"])).'"';
$actual='"'.str_replace("}","",str_replace("{", "", $investigador["act1"])).'"';
?>
<script type="text/javascript">
	swal(
		'RECUERDE QUE SI ACTUALIZA SUS DATOS DEBE INTRODUCIR DE NUEVO SU CLAVE O APROVECHAR PARA CAMBIARLA',
		'',
		'info'
		);	
	</script>
	<body class="cuerpo-r">
		<img src="<?php echo base_url(); ?>assets/img/logo_pni-01.png" class="logo-pni">
		<div class="container margen-login">
			<form id="frm_registro">
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label class="verdeclaro" for="cedula">Cédula de Identidad</label>
							<input type="text" name="cedula" id="cedula" class="form-control borde-v-3" value="<?php echo $investigador['ci_investigador']; ?>" readonly>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="verdeclaro" for="pnombre">Primer Nombre</label>
							<input type="text" name="pnombre" id="pnombre" class="form-control borde-v-3" value="<?php echo $investigador['pnombre']; ?>">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="verdeclaro" for="snombre">Segundo nombre</label>
							<input type="text" name="snombre" id="snombre" class="form-control" value="<?php echo $investigador['snombre']; ?>">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="verdeclaro" for="papellido">Primer Apellido</label>
							<input type="text" name="papellido" id="papellido" class="form-control borde-v-3" value="<?php echo $investigador['papellido']; ?>">
						</div>
					</div>		
				</div>
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label class="verdeclaro" for="sapellido">Segundo Apellido</label>
							<input type="text" name="sapellido" id="sapellido" class="form-control" value="<?php echo $investigador['sapellido']; ?>">
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
							<input type="date" name="fnac" id="fnac" class="form-control borde-v-3" value="<?php echo $investigador['fecha_nac']; ?>">
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
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label class="verdeclaro" for="telefono">Teléfono</label>
							<input type="text" name="telefono" id="telefono" class="form-control borde-v-3" value="<?php echo $investigador['telefono']; ?>">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="verdeclaro" for="celular">Celular</label>
							<input type="text" name="celular" id="celular" class="form-control borde-v-3" value="<?php echo $investigador['celular']; ?>">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="verdeclaro" for="correo">Correo</label>
							<input type="email" name="correo" id="correo" class="form-control borde-v-3" value="<?php echo $investigador['correo']; ?>" required readonly>
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
							<label class="verdeclaro" for="institucion">Nombre Institución</label>
							<input type="text" name="institucion" id="institucion" class="form-control borde-v-3" value="<?php echo $investigador['nombre_institucion']; ?>">
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
					<div class="col-md-5 col-md-offset-1">
						<div class="form-group">
							<label class="verdeclaro" for="intinv">Tiene interés investigar en</label>
							<select id="intinv" name="intinv" class="form-control borde-v-3" multiple="multiple"></select>
						</div>
					</div>	
					<div class="col-md-5">
						<div class="form-group">
							<label class="verdeclaro" for="invact">Actualmente realiza investigación en</label>
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
							<label class="verdeclaro" for="clave">Introduzca su clave</label>
							<input type="password" name="clave" id="clave" class="form-control borde-v-3" placeholder="Introduzca su clave">
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label class="verdeclaro" for="confirmar">Confirme su clave</label>
							<input type="password" name="confirmar" id="confirmar" class="form-control borde-v-3" placeholder="Confirme su clave">
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group" style="margin-top:4%;">
							<label class="verdeclaro" for="aceptar">REVISE SUS DATOS</label>
							<input type="button" name="aceptar" id="aceptar" class="form-control" style="display:none;" value="REGISTRAR" >
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>
<script type="text/javascript">
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
				var selected = "";
				if (val["id_genero"] == <?php echo $investigador['id_genero']; ?>) {
					selected = "selected";
				}
				$('#genero').append('<option value='+val["id_genero"]+' '+selected+'>'+val["nombre_genero"]+'</option>');
			})
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
				selected = "";
				if (val["id_estado_civil"] == <?php echo $investigador['id_civil']; ?>) {
					selected = "selected";
				}				
				$('#ecivil').append('<option value='+val["id_estado_civil"]+' '+selected+'>'+val["nombre_estado"]+'</option>');
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
				selected = "";
				if (val["id_estado"] == <?php echo $investigador['id_estado']; ?>) {
					selected = "selected";
				}	
				$('#estado').append('<option value='+val["id_estado"]+' '+selected+'>'+val["estado"]+'</option>');
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
				selected = "";
				if (val["id_profesion"] == <?php echo $investigador['id_profesion']; ?>) {
					selected = "selected";
				}					
				$('#profesion').append('<option value='+val["id_profesion"]+' '+selected+'>'+val["profesion"]+'</option>');
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
				selected = "";
				if (val["id_tipo_institucion"] == <?php echo $investigador['id_tipo_institucion']; ?>) {
					selected = "selected";
				}				
				$('#tinst').append('<option value='+val["id_tipo_institucion"]+' '+selected+'>'+val["tipo_institucion"]+'</option>');
			});
		});
		///////////////
			url = base_url+"registro/obtener_linea_investigacion";
			$.ajax({
				url: url,
				type: 'get',
				dataType: 'json',
			})
			.done(function(data) {
				var n=0;
				var grupo = "";
				grp = [];
				$(data).each(function (z, val) {
					grp.push(val["grupo"]);
				});			
				var ogrupos = {};
				for (var y=0; y<grp.length;y++) {
					ogrupos[grp[y]]=1+(ogrupos[grp[y]] || 0);
				}
				///EN GRUPOS TENGO LA CANTIDAD DE REGISTROS POR GRUPO
				///USARLO PARA CREAR LAS OPCIONES
				var agrupos = $.map(ogrupos,function(value) {
					return[value];
				});
				$(data).each(function (i, val) {
					var interes = <?php echo $interes; ?>;
					var selected = "";
					if (interes == i) {
						selected = " selected";
					}
					if (n==0 || n==7 || n==12) {
						$('#intinv').append('<optgroup label='+val["grupo"]+'>');
					}
					$('#intinv').append('<option value='+val["id_lineas_presidenciales"]+' '+selected+'>'+val["nombre_lineas_presidenciales"]+'</option>');
					if (n==6 || n==11 || n==18) {
						$('#intinv').append('</optgroup>');
					}
					n++;
				});
				n=0;
				grupo = "";	
				$(data).each(function (i, val) {
					var actual = <?php echo $actual; ?>;
					var selected = "";
					if (actual == i) {
						selected = " selected";
					}
					if (n==0 || n==7 || n==12) {
						$('#invact').append('<optgroup label='+val["grupo"]+'>');
					}
					$('#invact').append('<option value='+val["id_lineas_presidenciales"]+' '+selected+'>'+val["nombre_lineas_presidenciales"]+'</option>');
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
		///////////////

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
		///////////////
		/*
		url = base_url+"registro/obtener_linea_investigacion";
		$.ajax({
			url: url,
			type: 'get',
			dataType: 'json',
		})
		.done(function(data) {
			$(data).each(function (i, val) {
				var interes = <?php echo $interes; ?>;
				var indice = interes.indexOf(val["id_lineas_presidenciales"]);
				selected = "";
				if (indice > -1) {
					selected = "selected";
				}
				$('#intinv').append('<option value='+val["id_lineas_presidenciales"]+' '+selected+'>'+val["nombre_lineas_presidenciales"]+'</option>');
			});
			$('#intinv').find('option').get(0).remove();
			$(data).each(function (i, val) {
				var actual = <?php echo $actual; ?>;
				var indice = actual.indexOf(val["id_lineas_presidenciales"]);
				selected = "";
				if (indice > -1) {
					selected = "selected";
				}
				selected = "";
				if (indice > -1) {
					selected = "selected";
				}				
				$('#invact').append('<option value='+val["id_lineas_presidenciales"]+' '+selected+'>'+val["nombre_lineas_presidenciales"]+'</option>');
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
				selected = "";
				if (val["id_modo_investigacion"] == <?php echo $investigador['id_modo_investifgacion']; ?>) {
					selected = "selected";
				}					
				$('#invcolind').append('<option value='+val["id_modo_investigacion"]+' '+selected+'>'+val["modo_investigacion"]+'</option>');
			});
		});
		*/
		$('#municipio').append('<option value=0>Seleccione un estado para seleccionar el municipio</option>');
		$('#parroquia').append('<option value=0>Seleccione un municipio para seleccionar la parroquia</option>');
		$('#cpostal').append('<option value=0>Seleccione una parroquia para seleccionar el código postal</option>');
		var largo_municipio = $('#municipio > option').length;
		var largo_parroquia = $('#parroquia > option').length;
		var largo_cpostal = $('#cpostal > option').length;
		//////////////////////MUNICIPIO
		var estado = <?php echo $investigador["id_estado"]; ?>;
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
				selected = "";
				if (val["id_municipio"] == <?php echo $investigador['id_municipio']; ?>) {
					selected = "selected";
				}					
				$('#municipio').append('<option value='+val["id_municipio"]+' '+selected+'>'+val["municipio"]+'</option>');
			});
		});	
		//////////////////////PARROQUIA
		var municipio = <?php echo $investigador["id_municipio"]; ?>;
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
				selected = "";
				if (val["id_parroquia"] == <?php echo $investigador['id_parroquia']; ?>) {
					selected = "selected";
				}					
				$('#parroquia').append('<option value='+val["id_parroquia"]+' '+selected+'>'+val["parroquia"]+'</option>');
			});
		});
		//////////////////////ZONA POSTAL
		var parroquia = <?php echo $investigador["id_parroquia"]; ?>;
		var url = base_url+"registro/obtener_zonas/"+parroquia;
		$.ajax({
			url: url,
			type: 'get',
			dataType: 'json',
		})
		.done(function(data) {
			$('#postal').find('option').not(':first').remove();
			$(data).each(function (i, val) {
				selected = "";
				if (val["id_zona"] == <?php echo $investigador['id_zona']; ?>) {
					selected = "selected";
				}					
				$('#cpostal').append('<option value='+val["id_zona"]+' '+selected+'>'+val["codigo_postal"]+'</option>');
			});
		})
		campo($(this));	
		//////////////////////ZONA POSTAL
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
					$('#municipio').append('<option value='+val["id_municipio"]+' '+selected+'>'+val["municipio"]+'</option>');
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
					$('#parroquia').append('<option value='+val["id_parroquia"]+' '+selected+'>'+val["parroquia"]+'</option>');
				});
			});
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
					$('#cpostal').append('<option value='+val["id_zona"]+' '+selected+'>'+val["codigo_postal"]+'</option>');
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
			if ($(this).val() ==4) {
				$("#invact").prop("disabled","true");
				$("#invact").val('');
			} else {
				$("#invact").removeAttr('disabled');
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
			});
			if(count == 11) {
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
		}
		function checkCampos(obj) {
			var camposRellenados = true;
			obj.find("input").each(function() {
				var id = $(this).prop("id");
				if (id == "snombre" || id =="sapellido" || id =="mensaje" || (id="invact") && $("#invcolind").val() == 4) {
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
				$(this).removeClass("bgc-granada");
				$(this).removeClass("color-error");
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
		$("#aceptar").on("click",function() {
			var url="";
			function def_url(x){
				if (x==1) {
					url = base_url+"registro/actualizar_investigador";
				} else {
					url = base_url+"registro/insertar_investigador";
				}
			}
			var cedula = $("#cedula").val();
			url_inv = base_url+'registro/get_investigador';
			$.ajax({
				url: url_inv,
				type: "POST",
				async: false,
				global:false,
				data: {cedula : cedula},
				success: function(data){
					var datos = jQuery.parseJSON(data);
					if (datos["cant"] == 1) {
						def_url(1);
					} else {
						def_url(0);
					}
				}
			});
			$.ajax({
				url: url,
				type: 'post',
				dataType: 'text',
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
			.done(function() {
				var correo = $("#correo").val();
				swal(
					'¡ACTUALIZACIÓN EXITOSA!',
					'Se ha actualizado exitosamente el registro y se ha mandando un correo de verificación a '+correo,
					'success'
					);				
			})
			.fail(function(data) {
				swal(
					'ACTUALIZACIÓN FALLIDA!',
					'Ha ocurrido un error al intentar actualizar el registro',
					'error'
					);					
			})
			.always(function() {
			});
		});
		function buscar_investigador() {
			var cedula = $("#cedula").val();
			url_inv = base_url+'registro/get_investigador';
			$.ajax({
				url: url_inv,
				type: 'post',
				dataType: 'json',
				data: {cedula:cedula},
			})
			.done(function(data) {
				if (data["cant"] > 0) {
					return base_url+"registro/actualizar_investigador";
				} else {
					return base_url+"registro/insertar_investigador";
				}
			});
		}
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

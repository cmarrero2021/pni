<body class="cuerpo-r" style="overflow:visible !important;">
	<img src="<?php echo base_url(); ?>assets/img/logo_pni-01.png" class="logo-pni2">
	<div class="container margen-login verdeclaro">
		<h3> SE LE ENVIARÁ UN CORREO A SU DIRECCIÓN ELECTRÓNICA REGISTRADA CON CON LA NUEVA CLAVE PROVISIONAL, LA CUAL DEBERÁ SER CAMBIADA EN SU PRÓXIMO INGRESO AS SISTEMA </h3>
		<div class = "row">
			<div class = "col-md-4 col-md-offset-3 text-right">
				<input type = "email" class="form-control" id="txrec_clave" placeholder="Introduzca la dirección de correo">
			</div>
			<div class="col-md-2">
				<input type = "button"  class="form-control"  id="btnrec_clave" value="Reiniciar clave">
			</div>
		</div>
		<br/>
		<div class="row">
			<div class="col-md-6 col-md-offset-8">
				<a href = "<?php echo base_url(); ?>" class="link_suspendido"><i class="fa fa-home"> </i>&nbsp;Ir a la página de inicio</a>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
	$("#txrec_clave").on('keyup', function () {
		$(this).val(function (_, val) {
			return val.toLowerCase();
		});
	});
	$("#txrec_clave").on("blur",function(){
		$("#cargando").fadeIn(1000);
		var email = $(this).val().trim();
		var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
		if($(this).val().indexOf('@', 0) == -1 || $(this).val().indexOf('.', 0) == -1) {
			$(this).addClass("bgc-granada");
			$(this).addClass("color-error");
			$(this).val("Formato erróneo de correo");
		} else {
			$.ajax({
				url: "verificar_correo/"+email,
				type: 'POST',
				dataType: 'TEXT',
			})
			.done(function(data) {
				var existe = jQuery.parseJSON(data);
				if (existe.correo == 1) {
					var url='enviar_correo_verificacion/'+email;
					$.ajax({
						url: url,
						type: 'POST',
						dataType: 'TEXT',
					})
					.done(function(data) {
						swal({
							title: 'SE HA ENVIADO UN CORREO DE RECUPERACIÓN DE CLAVE A '+email,
							text: 'Revise su correo y siga las instrucciones',
							icon: "success",
						}).then(redirigir => {
							$("#cargando").fadeOut(1000);
							window.location.href="https://pni.oncti.gob.ve/";
						})
					})
					.fail(function(data) {
						swal(
							'¡HA OCURRIDO UN ERROR',
							'Revise e introduzca una dirección de correo válida',
							'error'
							);
					})
					.always(function() {
					});

				} else {
					swal(
						'¡LA DIRECCIÓN DE CORREO NO ESTÁ REGISTRADA',
						'Revise e introduzca una dirección de correo registrada',
						'error'
						);
				}
			})
			.fail(function(data) {
			})
			.always(function() {
			});

		}
	});
</script>

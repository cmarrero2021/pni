<script>
	$(document).ready(function(){
		$('#image_captcha').on('click', function(){
			$.get('<?php echo base_url().'login/refresh'; ?>', function(data){
				$('#image_captcha').html(data);
			});
		});
	});
</script>
<?php 
$p=1;
$usuario = get_cookie('usuario');
$clave = get_cookie('clave');
if (isset($usuario) && isset($clave)) {
	$valusuario = "value='".$usuario."'";
	$valclave = "value='".$clave."'";
} else {
	$valusuario = "";
	$valclave = "";
}
?>
<body class="cuerpo-r">
	<script type="text/javascript">
		var img = '<img src="'+base_url+'assets/img/logo_pni-01.png" class="logo-pni">';
	</script>	
	<div style="background-color:#ffffff;width:100%;">
		<img src="<?php echo base_url(); ?>assets/img/cintillo.png" class="img-responsive no-imprimir" style="width:100% !important;margin-bottom:-10%;">
	</div>
	<div class="container">
		<div class="row">
			<div class="row margen-login">
				<div class="row">
					<div class = "col-xs-12 col-sm-12 col-md-12 pull-right text-right casfaltohumedo"  style="margin-top:5%;">
						<a  href="<?php echo base_url(); ?>registro"><strong><label style="cursor:pointer;font-size:150%;-webkit-text-stroke-width: 1px;-webkit-text-stroke-color: black;">REGISTRARSE</label></strong></a>
					</div>
				</div>
				<div class="col-md-4">
					<img src="<?php echo base_url(); ?>assets/img/logo_pni-01.png" class="img-responsive" style="width:75%;">
				</div>
				<div class = "col-md-4 col-md-offset-1">
					<div class="row text-center">
						<label style="color:white;">INGRESE SUS DATOS DE USUARIO</label>
					</div>
					<div class="row">
						<form action="" method="post">
							<div lass="form-group">
								<label for="usuario"></label>
								<input type="text" name="usuario" id="usuario" class="form-control" placeholder="correo electrónico" <?php echo $usuario ?>>
							</div>
							<div class="form-group">
								<label for="clave"></label>
								<input type="password" name="clave" id="clave" class="form-control" placeholder="Clave" <?php echo $clave ?>>
							</div>
							<!-- -->
							<div>
								<?php
								$p = str_replace("width: 150px; height: 45px; border: 0;", "width: 150px; height: 45px; border: 0; display:block;margin:auto;", $captchaImg);
								$captchaImg = $p;
								?>
								<p id="image_captcha" style="cursor:pointer;display:block;margin:auto;"><?php echo $captchaImg; ?></p>
							</div>
							<div>
								<input type="text" name="captcha" id="captcha" class="form-control" placeholder="PRESIONE EN EL CAPTCHA PARA REFRESCAR">
							</div>
							<!-- -->
							<button type="submit" class="form-control btn btn-elegant c-dark" style="background-color: #222d32; color:#b8c7ce;" name="submit">Ingresar</button>
						</form>
						<br/>					
						<div class="text-center">
							<a href="assets/documentos/registro.pdf" download="Instructivo Regristro PNI">Descargar instructivo</a>
							<div class="text-center">
								<a href="assets/documentos/gaceta_41864.pdf" download="Gaceta Oficial 41.864">Descargar Gaceta 41.864</a>
							</div>
							<div class="text-center">
								<a href="assets/documentos/gaceta_41909.pdf" download="Gaceta Oficial 41.909">Descargar Gaceta 41.909</a>
							</div>
							<div class="text-center">
								<a href="assets/documentos/COMUNICADO_OFICIAL_CONVOCATORIA_DIRIGIDA_A_CENTROS_CLACSO_VENEZUELA.pdf" download="Convocatoria CLACSO">Descargar Convocatoria CLACSO</a>
							</div>
							<div class="text-center">
								<a href="assets/documentos/TERMINOS_DE_REFERENCIA_CONVOCATORIA_DIRIGIDA_CLACSO_MPPCT.pdf" download="Términos de Referencia CLACSO">Descargar Términos de Referencia CLACSO</a>
							</div>
							<br/>
							<div class="text-center">
								<a href="registro/recuperar_clave">¿Olvidó su clave?</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</body>
		<?php if(isset($scripts)) {foreach($scripts as $script) { echo $script; } } ?>

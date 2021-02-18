<?php
$investigador = $investigador["cant"];
$investigacion = $investigacion["cant"];
$registro = $registro["cant"];
$actual = $actual["cant"];
if (($registro == 0) || ($investigador > 0 && $investigacion > 0 && $actual > 0)) {
	$listo = 1;
} else {
	$listo = 0;
}
?><body class="cuerpo-r">
	<h3 class="verdeclaro text-center">
		<?php echo $this->session->userdata("nombre"); ?><br/>BIENVENIDO AL SISTEMA NACIONAL DE INVESTIGADORES E INVESTIGADORAS
	</h3>
	<img src="<?php echo base_url(); ?>assets/img/logo_pni-01.png.png" style="margin-left:30%;width:40%;">
</body>
<script type="text/javascript">
	if (<?php echo $listo; ?> == 0) {
		var estilo = "style='cursor:pointer;color:#500'";
		var base = base_url;
		if (<?php echo $investigador; ?> < 1) {
			var pir = "<a href='"+base+"/perfil/perfil_investigador'"+estilo+" >PERFIL DEL INVESTIGADOR</a>";
			var est_pir="POR COMPLETAR";
		} else {
			var pir = "PERFIL DEL INVESTIGADOR";
			var est_pir="LISTO";
		}
		if (<?php echo $investigacion; ?> < 1) {
			var pin = "<a href='"+base+"perfil/perfil_investigacion'"+estilo+" >PERFIL DE LA INVESTIGACIÓN</a>";
			var est_pin="POR COMPLETAR";
		} else {
			var pin = "PERFIL DE LA INVESTIGACIÓN";
			var est_pin="LISTO";
		}
		if (<?php echo $actual; ?> < 1) {
			var pia = "<a href='"+base+"perfil/investigacion_actual'"+estilo+"> INVESTIGACIÓN ACTUAL</a>";
			var est_pia="POR COMPLETAR";
		} else {
			var pia = "INVESTIGACIÓN ACTUAL";
			var est_pia="LISTO";
		}
		var tabla="<label>Le invitamos a completar la carga de los perfiles</label><table><theading><th width='70%'></th><th width='30%'></th></theading><tbody><tr><td>REGISTRO INICIAL</td><td>LISTO</td></tr><tr style='background-color:#dee;'><td>"+pir+"</td><td>"+est_pir+"</td></tr><tr><td>"+pin+"</td><td>"+est_pin+"</td></tr><tr style='background-color:#dee;'><td>"+pia+"</td><td>"+est_pia+"</td></tr></tbody></table>";
		swal({
			title:"FASES COMPLETADAS DE LA CARGA DEL PERFIL",
			text:"Le invitamos a completar la carga de los perfiles",
			html: tabla,
			icon:"info"
		});
	}
	
</script>
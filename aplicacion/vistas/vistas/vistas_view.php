<script>
	$(document).ready(function () {
		var campos = $("#seleccionCampos").fieldChooser($("#camposDisponibles"), $("#camposSeleccionados"),"mostrarCampos");
		var condicion = $("#seleccionCondicion").fieldChooser($("#condicionDisponible"), $("#condicionSeleccionado"),"mostrarCondiciones");
		var orden = $("#seleccionOrden").fieldChooser($("#ordenDisponible"), $("#ordenSeleccionado"),"mostrarOrden");
	});
</script>
<div class="row text-center">
	<?php
	foreach ($vistas as $v) {
		echo "<label style='background-color:".$v["color"].";'>&nbsp;&nbsp;".$v["alias_vista"]."&nbsp;&nbsp;</label>";
	}
	?>
</div>
<div class="row">
	<div class="col-md-4">
		<div class="row text-center">
			<label class="verdeclaro">CAMPOS DISPONIBLES</label>
		</div>
		<div class="row">
			<div id="seleccionCampos" tabIndex="1" class="seleccionCampos bgc-oceanobaltico">
				<div id="camposDisponibles">
					<?php
					foreach($campos as $c) {
						echo "<div style='background-color:".$c["color"].";'>".$c["alias_campo"]."<span style='display:none;'>".$c["vista"].".".$c["campo"]."</span></div>";
					}
					?>
				</div>
				<div id="camposSeleccionados">
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="row text-center">
			<label class="verdeclaro">CONDICIONES</label>
		</div>
		<div class="row">
			<div id="seleccionCondicion" tabIndex="1" class="seleccionCampos bgc-asfaltohumedo">
				<div id="condicionDisponible">
					<?php
					foreach($campos as $c) {
						if (strstr($c["alias_campo"], "CÉDULA") && (!strstr($c["alias_campo"], "CONSIGN"))) {
							echo "<div style='background-color:".$c["color"].";'>".$c["alias_campo"]."<span style='display:none;'>".$c["vista"].".".$c["campo"]."</span></div>";
						}
					}
					?>
				</div>
				<div id="condicionSeleccionado">
				</div>
			</div>
		</div>
	</div>	
	<div class="col-md-4">
		<div class="row text-center">
			<label class="verdeclaro">ORDEN</label>
		</div>
		<div class="row">
			<div id="seleccionOrden" tabIndex="1" class="seleccionCampos bgc-azulmedianoche-intenso">
				<div id="ordenDisponible">
					<?php
					foreach($campos as $c) {
						echo "<div style='background-color:".$c["color"].";'>".$c["alias_campo"]."<span style='display:none;'>".$c["vista"].".".$c["campo"]."</span></div>";
					}
					?>
				</div>
				<div id="ordenSeleccionado">
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-4 verdeclaro" id="mostrarCampos">
		CAMPOS DEL REPORTE
	</div>
	<div class="col-md-4 verdeclaro" id="mostrarCondiciones">
		CAMPOS DE LA CONDICIÓN
	</div>
	<div class="col-md-4 verdeclaro" id="mostrarOrden">
		CAMPOS PARA ORDENAR
	</div>
</div>
<div class="text-center">
	<i class="fa fa-print fa-5x fa-lg verdeclaro" aria-hidden="true" style="cursor:pointer;margin:1%;" title="Imprimir Reporte" id="imprimir">&nbsp;&nbsp;&nbsp;</i>
<!-- 	<i class="fa fa-save fa-5x fa-lg verdeclaro" style="cursor:pointer;margin:1%;"  title="Guardar Reporte">&nbsp;&nbsp;&nbsp;</i>
	<i class="fa fa-upload fa-5x fa-lg verdeclaro" aria-hidden="true" style="cursor:pointer;margin:1%;" title="Cargar Reporte">&nbsp;&nbsp;&nbsp;</i>
-->	<i class="fa fa-refresh fa-5x fa-lg verdeclaro" style="cursor:pointer;margin:1%;" title="Reiniciar Ventana" id="recargar">&nbsp;&nbsp;&nbsp;</i>
</div>
<script type="text/javascript">
	var vistas = <?php echo json_encode($vistas); ?>;
	var campos = <?php echo json_encode($campos); ?>;
	$('#camposSeleccionados').bind('DOMSubtreeModified',function(event) {
		contenido = "";
		var cantElementos = $("#camposSeleccionados").find("span").length -1;
		var n= 0;
		$('#camposSeleccionados').find('span').filter(function() {
			if (contenido.indexOf($(this).html()) == -1) {
				var coma = n<cantElementos?",":"";
				contenido += $(this).html()+coma;
			}
		});
		contenido = cantElementos == 0?'':contenido;
		$("#mostrarCampos").html(contenido);
	});
	$('#condicionSeleccionado').bind('DOMSubtreeModified',function(event) {
		contenido = "";
		var cantElementos = $("#condicionSeleccionado").find("span").length -1;
		var n= 0;
		$('#condicionSeleccionado').find('span').filter(function() {
			if (contenido.indexOf($(this).html()) == -1) {
				var coma = n<cantElementos?",":"";
				contenido += $(this).html()+coma;
			}
		});
		contenido = cantElementos == 0?'':contenido;
		$("#mostrarCondiciones").html(contenido);
	});
	$('#ordenSeleccionado').bind('DOMSubtreeModified',function(event) {
		contenido = "";
		$('#ordenSeleccionado').find('span').filter(function() {
			if (contenido.indexOf($(this).html()) == -1) {
				contenido += $(this).html()+",";
			}
		});
		$("#mostrarOrden").html(contenido);
	});
	$("#imprimir").on("click",function() {
		Swal.fire({
			title: 'INTRODUZCA EL TÍTULO DEL REPORTE',
			html: "<input type='text' id='titulo_reporte'>",
			icon: 'info',
			showCancelButton: true,
			allowOutsideClick: false,
			allowEscapeKey: false,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Continuar con la generación del reporte',
			cancelButtonText: 'Cancelar la emisión del reporte'
		}).then((result) => {
			if (result.value && $("#titulo_reporte").val().length > 0) {
				////////////////////
				var titulo_reporte = $("#titulo_reporte").val();
				contenido = "";
				var cantElementos = $("#camposSeleccionados").find("span").length -1;
				var n= 0;
				$('#camposSeleccionados').find('span').filter(function() {
					if (contenido.indexOf($(this).html()) == -1) {
						var coma = n<cantElementos?",":"";
						contenido += $(this).html()+coma;
					}
				});
				contenido = cantElementos == 0?'':contenido;
				var camposSQL = contenido.substring(0, contenido.length - 1);
				var acamposSQL = camposSQL.split(",");
				var titCampos = "";
				for (n=0;n<acamposSQL.length;n++) {
					var vis = acamposSQL[n].substr(0,acamposSQL[n].indexOf("."));
					var cam = acamposSQL[n].substr(acamposSQL[n].indexOf(".")+1);
					for (m=0;m<campos.length;m++){
						if (campos[m]["vista"] == vis && campos[m]["campo"]===cam) {
							var coma = n<acamposSQL.length-1?",":"";
							var tit = campos[m]["alias_campo"];
							titCampos += campos[m]["alias_campo"].substr(campos[m]["alias_campo"].indexOf(".")+1)+coma;
						}
					}
				}
				contenido = "";
				var cantElementos = $("#condicionSeleccionado").find("span").length -1;
				var n= 0;
				$('#condicionSeleccionado').find('span').filter(function() {
					if (contenido.indexOf($(this).html()) == -1) {
						var coma = n<cantElementos?",":"";
						contenido += $(this).html()+coma;
					}
				});
				contenido = cantElementos == 0?'':contenido;
				var condicionSQL = contenido.substring(0, contenido.length - 1);
				if (condicionSQL.length == 0) {
					condicionSQL = "";
				} else {
					condicionSQL = " WHERE "+condicionSQL.replace(",","=")+" ";
				}
				$('#ordenSeleccionado').find('span').filter(function() {
					if (contenido.indexOf($(this).html()) == -1) {
						contenido += $(this).html()+",";
					}
				});
				var ordenSQL = contenido.substring(0, contenido.length - 1);
				var tab = camposSQL.split(",");
				for (n=0;n<tab.length;n++) {
					tab[n]=tab[n].substring(0,tab[n].indexOf('.'));
				}
				let set = new Set(tab.map(JSON.stringify));
				let atablas=Array.from(set).map(JSON.parse);
				var tablas = "";
				for (n=0;n<atablas.length;n++) {
					tablas += atablas[n]+",";
				}
				if ($("#mostrarOrden").html().length > 0) {
					ordenSQL = " ORDER BY "+ordenSQL;
				} else {
					ordenSQL = "";
				}
				if (atablas.length > 1 && condicionSQL.length == 0) {
					swal("!NO HAY CONDICION DE UNIÓN!","Ha indicado más de una tabla sin ninguna condición que las una; por favor indique una condición de unión entre las tablas, por ejemplo, la cédula de los investigadores en ambas tablas","error");
				} else {
					var tablas = tablas.substring(0, tablas.length - 1);
					var sql = "SELECT "+camposSQL+" FROM "+tablas+condicionSQL+ordenSQL;
					$.ajax({
						url: 'vistas/generar_reporte',
						type: 'post',
						dataType:'text',
						data: {sql: sql},
					})
					.done(function(data) {
						var datos = JSON.parse(data);
						var url=base_url+"assets/php/ventana.php?data="+data+"&titulos="+titCampos+"&titulo_reporte="+titulo_reporte;
						window.open(url,"_blank","toolbar=no,scrollbars=yes,resizable=yes,top=0,left=0,width=1024,height=780");
					})
					.fail(function(data) {
					});
				}				
			} else if ($("#titulo_reporte").val().length == 0 && result.value) {
				swal("¡TÍTULO VACIO!","¡El título del reporte no puede estar vacio!","error");
			} else if (!result.value) {
				swal("","Se ha cancelado la emisión del reporte","error");

			}
		})
	});
$("#recargar").on("click",function() {
	location.reload();
});
</script>
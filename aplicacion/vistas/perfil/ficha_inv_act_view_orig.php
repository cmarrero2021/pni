<style type="text/css">
	body {
		display:block;	
	}
	tr {
		font-size:100%;
	}
	.borde {
		outline: 1px solid #000000 !important;
	}
	table {
		border-collapse: collapse;
	}
	.c5 {
		width:5% !important;
	}
	.c6 {
		width:6% !important;
	}
	.c10 {
		width:10% !important; 
	}
	.c30 {
		width:20% !important;
	}
	.c60 {
		width:60% !important;
	}
	div.page_break {
		page-break-before: always;
	}
</style>
<body style="font-family: sans-serif;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
	<img src="assets/img/cintillo.png" style="width:100%;">
	<hr>
	<div style="margin-bottom: -5%;">
		<img src="assets/img/logo-pni-mio-01.png"  style="width:10%;">
	</div>
	<div style="position:absolute;margin-top:-30% !important;z-index: 10">
		<div style="text-align: center;"><h4>DATOS DEL INVESTIGADOR</h4></div>
		<table width='100%' style="text-align: left;">
			<tr style="background-color:#ddd;"><td>CÉDULA DEL INVESTIGADOR</td><td><?php echo $investigador_actual["ci_investigador"]; ?></td>
			</tr>
			<tr style="background-color:#fff;"><td>NOMBRE DEL INVESTIGADOR</td><td><?php echo $investigador_actual["pnombre"]." ".$investigador_actual["snombre"]." ".$investigador_actual["papellido"]." ".$investigador_actual["sapellido"]; ?></td>
			</tr>
			<tr style="background-color:#ddd;"><td>FECHA DE REGISTRO DE LA INVESTIGACIÓN</td><td><?php echo $investigador_actual["fecha_registro"]; ?></td>
			</tr>
		</table>
		<div style="text-align: center; margin-top: -50%;"><h4>FICHA DE LA INVESTIGACIÓN ACTUAL</h4></div>
		<?php
		$etiquetas=$pdf["etiquetas"];
		$valores=$pdf["valores"];
		$cedula=$pdf["cedu_resp"];
		$nombre=$pdf["nomb_resp"];
		$apellido=$pdf["apel_resp"];
		if ($valores[0]=="CULMINADO") {
			$inv = strlen($valores[13]) > 0?"SI":"NO";
			array_splice($valores, 11, 0, $inv);
		}
		echo "<table width='100%'>";
		for ($n=0;$n<count($valores[0]);$n++) {
			if (strlen($valores[0][$n]) > 300) {
				$valores[0][$n]=substr($valores[0][$n],0,300)."...";
			}
			if ($n%2==0){
				$back =" style='background-color:#fff;'";
			}else{
				$back =" style='background-color:#ddd;'";
			}
			echo "<tr $back><td>".$etiquetas[0][$n]."</td><td>".$valores[0][$n]."</td></tr>";
		}
		echo "</table>";
		echo "<br/>";
		echo "<table width='100%'><thead><tr><th>RESPONSABLES DE LA INVESTIGACIÓN</th></tr></thead></table><br/>";
		echo "<table width='100%' border='1'><thead><tr><th>CEDULA</th><th>NOMBRE</th><th>APELLIDO</th></tr></thead><tbody>";
		for ($n=0;$n<count($cedula[0]);$n++) {
			echo "<tr><td>".$cedula[0][$n]."</td><td>".$nombre[0][$n]."</td><td>".$apellido[0][$n]."</td></tr>";
		}
		echo "</tbody></table>";
		?>
	</div>
</body>
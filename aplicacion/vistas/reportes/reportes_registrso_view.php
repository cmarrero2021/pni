<body class="cuerpo-r" style="overflow:visible !important;">
	<img src="<?php echo base_url(); ?>assets/img/logo_pni-01.png" class="logo-pni2">
	<div class="container margen-login verdeclaro">
		<h3> SELECCIONE LA FECHA DE INICIO DEL REPORTE Y LA FECHA DE FINALIZACIÓN; SI QUIERE EL REPORTE DE UN SÓLO DIA, COLOQUE LA MISMA FECHA DE INICIO Y DE FINALIZACIÓN </h3>
		<form method="post" id="frmExcel">
			<div class="row">
				<div class="col-md-8 col-md-offset-3">
					<!-- <div class="col-md-8 col-md-offset-2"> -->
						<div id="myButtons" class="btn-group" data-toggle="buttons">
							<label class="btn btn-success active">
								<input type="radio" name="options" id="registro" autocomplete="off" checked> REGISTROS
							</label>
							<label class="btn btn-success">
								<input type="radio" name="options" id="investigador" autocomplete="off">PERFIL INVESTIGADOR
							</label>
							<label class="btn btn-success">
								<input type="radio" name="options" id="investigacion" autocomplete="off">PERFIL INVESTIGACIÓN
							</label>				
							<label class="btn btn-success">
								<input type="radio" name="options" id="actual" autocomplete="off">INVESTIGACIÓN ACTUAL
							</label>
						</div>
					</div>
				</div>				
				<div class = "row">
					<div class = "col-md-2 col-md-offset-3">
						<div class="form-group">
							<label class="verdeclaro" for="fini">Fecha de Inicio</label>
							<input type="date" name="fini" id="fini" class="form-control borde-v-3">
						</div>
					</div>
					<div class = "col-md-2">
						<div class="form-group">
							<label class="verdeclaro" for="ffin">Fecha de Finalización</label>
							<input type="date" name="ffin" id="ffin" class="form-control borde-v-3">
						</div>
					</div>
					<div class="col-md-2" style="margin-top:2%;">
						<input type = "button"  class="form-control" id="btnExcel" value="Generar Excel" onClick="">
					</div>
				</div>
			</form>
			<br/>
		</div>
	</body>
	<script type="text/javascript">
		var resp="registro";
		$("#chkRegistro").on("change",function() {
			if ($(this).prop("checked")) {
				$('#chkPerfilInvestigador').bootstrapToggle('off');
				$('#chkPerfilInvestigacion').bootstrapToggle('off');
				$('#chkInvestigaciónActual').bootstrapToggle('off');
				var url = "generar_excel_registros";
			}
		});
		$("#myButtons :input").change(function() {
			resp = $(this).attr("id");
		});
		$("#btnExcel").on("click",function(e){
			e.preventDefault();
			switch (resp) {
				case "registro":
				var url = "generar_excel_registros";
				break;
				case "investigador":
				var url = "generar_excel_investigador";
				break;		
				case "investigacion":
				var url = "generar_excel_investigacion";
				break;
				case "actual":
				var url = "generar_excel_actual";
				break;
			}
			$('#frmExcel').attr('action', url).submit();
		});
	</script>
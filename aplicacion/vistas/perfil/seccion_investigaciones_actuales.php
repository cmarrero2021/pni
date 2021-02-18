<form id="actual_form">
	<div class="row">
		<div class="col-md-3" >
			<div class="form-group">
				<label class="casfaltohumedo" for="fase_inv">Fase actual de la Investigación</label>
				<select id="fase_inv" name="fase_inv" class="form-control borde-v-3 bgc-granada color-error"></select>
			</div>
		</div>
		<div class="col-md-8">
			<div class="form-group">
				<label class="casfaltohumedo" for="titulo_investigacion">Título de la investigación</label>
				<input type="text" id="titulo_investigacion" name="titulo_investigacion" class="form-control borde-v-3 bgc-granada
				color-error" placeholder="Introduzca el título de la investigación">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 table-responsive text-nowrap">
			<div class="form-group">
				<label class="casfaltohumedo" for="responsable_investigacion">Responsables(s) de la investigación
				</label>
				<table id="responsables" class="table w-auto casfaltohumedo" style="background: transparent !important;">
					<thead class="casfaltohumedo">
						<th>CÉDULA</th><th>NOMBRES</th><th>APELLIDOS</th><th colspan="2"></th>
					</thead>
					<tbody>
						<tr>
							<td><input type="number" id="ced_res" class="no-boton" style="background:transparent;"></td><td><input type="text" id="nom_res" style="background:transparent;"></td><td><input type="text" id="ape_res" style="background:transparent;"></td><td><i class="fa fa-check fa-5 csuccess" aria-hidden="true" style="cursor:pointer;" id="btn-gRes"></i></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-2" >
			<div class="form-group">
				<label class="casfaltohumedo" for="tip_inst">Tipo de Institución</label>
				<select id="tip_inst" name="tip_inst" class="form-control borde-v-3 bgc-granada color-error"></select>
			</div>
		</div>
		<div id="salud" style="display:none;">
			<div class="col-md-2">
				<div class="form-group">
					<label class="casfaltohumedo" for="est_salud">Estado</label>
					<select id="est_salud" name="est_salud" class="form-control borde-v-3 bgc-granada
					color-error"></select>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label class="casfaltohumedo" for="mun_salud">Municipio</label>
					<select id="mun_salud" name="mun_salud" class="form-control borde-v-3 bgc-granada
					color-error"></select>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label class="casfaltohumedo" for="par_salud">Parroquia</label>
					<select id="par_salud" name="par_salud" class="form-control borde-v-3 bgc-granada
					color-error"></select>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label class="casfaltohumedo" for="centro">Institución Salud</label>
					<select id="centro" name="centro" class="form-control borde-v-3 bgc-granada
					color-error"></select>
				</div>
			</div>
		</div>
		<div id="comunas" style="display:none;">
			<div class="col-md-3">
				<div class="form-group">
					<label class="casfaltohumedo" for="tip_com">Tipo de Comuna</label>
					<select id="tip_com" name="tip_com" class="form-control borde-v-3 bgc-granada
					color-error"></select>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label class="casfaltohumedo" for="comuna">Comuna</label>
					<select id="comuna" name="comuna" class="form-control borde-v-3 bgc-granada
					color-error"></select>
				</div>
			</div>
		</div>
		<div id="no_salud" style="display:none;">
			<div class="col-md-3">
				<div class="form-group">
					<label class="casfaltohumedo" for="cen_salud" id="otros">Centro</label>
					<select id="cen_salud" name="cen_salud" class="form-control borde-v-3 bgc-granada
					color-error"></select>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3" >
			<div class="form-group">
				<label class="casfaltohumedo" for="lin_invp">Línea de Investigación</label>
				<select id="lin_invp" name="lin_invp" class="form-control borde-v-3 bgc-granada color-error"></select>
			</div>
		</div>
		<div class="col-md-5" id="cresul_inv">
			<div class="form-group">
				<label class="casfaltohumedo" for="resul_inv" id="lbl_resul_inv">Resultados esperados de la investigación
				</label>
				<textarea id="resul_inv" name="resul_inv" class="form-control borde-v-3 bgc-granada
				color-error" placeholder="Introduzca los resultados de la investigación" rows=4 required>
			</textarea>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3" >
			<div class="form-group">
				<label class="casfaltohumedo" for="tipo_inv">Tipo de Investigación</label>
				<select id="tipo_inv" name="tipo_inv" class="form-control borde-v-3 bgc-granada color-error"></select>
			</div>
		</div>
		<div class="col-md-3" id="tiempoc">
			<div class="form-group">
				<label class="casfaltohumedo" for="tic">Tiempo de la investigación</label>
				<div id="tic">
					<span class="col-md-6">
						<input type="text" class="form-control borde-v-3 bgc-granada color-error" id ="tiempo_investigacionc" name="tiempo_investigacionc" placeholder="Cantidad">
					</span>
					<span class="col-md-6">
						<select id="unidad_tiempoc" name="unidad_tiempoc" class="form-control borde-v-3 bgc-granada
						color-error"></select>
					</span>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row" id="fase_diseno" style="display:none;">
	<div class="col-md-3" id="des_fichad">
		<a class="vacio casfaltohumedo" href="<?php echo base_url(); ?>assets/documentos/ficha_proyecto.doc" download><label  style="cursor:pointer;">Por favor descargue este documento, llénelo adecuadamente y carguelo en el sistema</label></a>
	</div>
	<div class="col-md-3" id="car_fichad">
		<div class="form-group">
			<div class="row">
				<label class="casfaltohumedo" for="dcargar_ficha">Cargar Ficha de la Investigación</label>
			</div>
			<div class="col-md-9">
				<input type="file" name="dcargar_ficha" id="dcargar_ficha" class="form-control" style="margin-left:-10% !important;"><img src="<?php echo base_url(); ?>/assets/img/buscar.gif" id="porc_dcargar_ficha" style="display:none;">
			</div>
		</div>
	</div>
	<div class="col-md-4" id="chk_fichad" style="display:none;">
		<div class="form-group">
			<div class="row" style="margin-top:9%;">
				<label class="casfaltohumedo" for="dcargar_ficha">LA FICHA DE LA INVESTIGACIÓN HA SIDO CARGADA</label>&nbsp;&nbsp;&nbsp;<i class="fa fa-check fa-5 casfaltohumedo" aria-hidden="true" id="btn-gRes"></i>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label class="casfaltohumedo" for="ti">Tiempo estimado de la investigación</label>
			<div id="ti">
				<span class="col-md-6">
					<input type="text" class="form-control borde-v-3 bgc-granada color-error" id ="tiempo_investigacion" name="tiempo_investigacion">
				</span>
				<span class="col-md-6">
					<select id="unidad_tiempod" name="unidad_tiempod" class="form-control borde-v-3 bgc-granada
					color-error"></select>
				</span>
			</div>
		</div>
	</div>
</div>
<div class="row" id="fase_ejecucion" style="display:none;">
	<div class="col-md-3" id="cobjetivos_inv" style="display:block;">
		<div class="form-group">
			<label class="casfaltohumedo" for="objetivos_inv" id="lbl_obj_inv">Objetivos de la investigación
			</label>
			<textarea id="objetivos_inv" name="objetivos_inv" class="form-control borde-v-3 bgc-granada
			color-error" placeholder="Introduzca los objetivos de la investigación" rows=4 required></textarea>
		</div>
	</div>
	<div class="col-md-4" id="des_fic_inv_eje" style="margin-top:3%;">
		<a class="vacio casfaltohumedo" href="<?php echo base_url(); ?>assets/documentos/ficha_proyecto.doc" download><label  style="cursor:pointer;">Por favor descargue este documento, llénelo adecuadamente y carguelo en el sistema</label></a>
	</div>
	<div class="col-md-5">
		<div class="row">
			<div class="row">
				<div class="col-md-10" id="car_fic_inv_eje">
					<div class="row">
						<div class="form-group">
							<label class="casfaltohumedo" for="ecargar_ficha" style="margin-left:3%;">Cargue la Ficha de la Investigación</label>
						</div>
						<div class="col-md-12">
							<input type="file" name="ecargar_ficha" id="ecargar_ficha" class="form-control" style="margin-left:0%;width:100%;"><img src="<?php echo base_url(); ?>/assets/img/buscar.gif" id="porc_ecargar_ficha" style="display:none;width:200% !important;">
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-10" id="car_doc_inv_eje">
					<div class="row">
						<div class="form-group">
							<label class="casfaltohumedo" for="ecargar_proyecto" style="margin-left:3%;">Cargue la Ficha de la Investigación</label>
						</div>
						<div class="col-md-12">
							<input type="file" name="ecargar_proyecto" id="ecargar_proyecto" class="form-control" style="margin-left:0%;width:100%;"><img src="<?php echo base_url(); ?>/assets/img/buscar.gif" id="porc_ecargar_proyecto" style="display:none;width:200% !important;">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-4 col-md-offset-3" id="chk_fichae" style="display:none;margin-top:-14%;">
		<div class="row">
			<div class="form-group">
				<div class="row" style="margin-top:9%;">
					<div class="col-md-12">
						<label class="casfaltohumedo" for="dcargar_ficha">LA FICHA DE LA INVESTIGACIÓN HA SIDO CARGADA</label>&nbsp;&nbsp;&nbsp;<i class="fa fa-check fa-5 casfaltohumedo" aria-hidden="true" id="btn-gRes"></i>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row" style="margin-top:9%;">
					<div class="col-md-12">
						<label class="casfaltohumedo" for="dcargar_ficha">LA INVESTIGACIÓN HA SIDO CARGADA</label>&nbsp;&nbsp;&nbsp;<i class="fa fa-check fa-5 casfaltohumedo" aria-hidden="true" id="btn-gRes"></i>
					</div>
				</div>
			</div>
		</div>
	</div>


</div>
<div class="row" id="ftici" style="display:none;">
	<div class="col-md-3" id="tiempoe">
		<div class="form-group">
			<label class="casfaltohumedo" for="tici"  style="margin-left:5%;">Indique el tiempo que duró la investigación</label>
			<div id="tici">
				<span class="col-md-6">
					<input type="text" class="form-control borde-v-3 bgc-granada color-error" id ="tiempo_investigacione" name="tiempo_investigacione">
				</span>
				<span class="col-md-6">
					<select id="unidad_tiempoe" name="unidad_tiempoe" class="form-control borde-v-3 bgc-granada
					color-error"></select>
				</span>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label class="casfaltohumedo" for="com_etica">Si pasó por el Comité de Ética de alguna institución, indique el tipo</label>
			<select id="com_etica" name="com_etica" class="form-control borde-v-3 bgc-granada color-error"></select>
		</div>
	</div>
	<div class="col-md-3" id="in_et" style="display:none;">
		<div class="form-group">
			<label class="casfaltohumedo" for="inst_etica">Institución del Comité de Ética que revisó la investigación</label>
			<select id="inst_etica" name="inst_etica" class="form-control borde-v-3 bgc-granada color-error"></select>
		</div>
	</div>
</div>
<div class="row" id="fase_culminacion" style="display:none;">
	<div class="col-md-6">
		<div class="form-group">
			<label class="casfaltohumedo" for="resul_invc">Resultado Obtenido
			</label>
			<textarea id="resul_invc" name="resul_invc" class="form-control borde-v-3 bgc-granada
			color-error" placeholder="Introduzca el resultado obtenido de la investigación" rows=4 required></textarea>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="casfaltohumedo" for="impacto">Aplicación
			</label>
			<textarea id="impacto" name="impacto" class="form-control borde-v-3 bgc-granada
			color-error" placeholder="Introduzca los resultados de la investigación" rows=4 required></textarea>
		</div>
	</div>
	<div class="col-md-4" id="ccfi">
		<div class="form-group">
			<div class="row">
				<label class="casfaltohumedo" for="ccargar_proyecto">Cargar Ficha de la Investigacion</label>
			</div>
			<div class="col-md-9" style="margin-top:8%;">
				<input type="file" name="ccargar_proyecto" id="ccargar_proyecto" class="form-control" style="margin-left:-10% !important;"><img src="<?php echo base_url(); ?>/assets/img/buscar.gif" id="porc_ccargar_proyecto" style="display:none;">
			</div>
		</div>
	</div>
	<div class="col-md-4" id="etq_enla_pub" style="display:none;margin-top: 5%;">;
		<label class="casfaltohumedo" for="enlace">La investigación ha sido cargada&nbsp;&nbsp;&nbsp;</label><i class="fa fa-check fa-5 csuccess" aria-hidden="true"></i>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label class="casfaltohumedo" for="com_eticac">Si pasó por el Comité de Ética de alguna institución, indique el tipo</label>
			<select id="com_eticac" name="com_eticac" class="form-control borde-v-3 bgc-granada color-error" style="margin-top:3%;"></select>
		</div>
	</div>
	<div class="col-md-3" id="in_etc" style="display:block;">
		<div class="form-group">
			<label class="casfaltohumedo" for="inst_eticac">Institución del Comité de Ética que revisó la investigación</label>
			<select id="inst_eticac" name="inst_eticac" class="form-control borde-v-3 bgc-granada color-error" style="margin-top:3%;"></select>
		</div>
	</div>	
</div>
<div class="row" id="sal_etica" style="display:none;">
	<div class="col-md-2">
		<div class="form-group">
			<label class="casfaltohumedo" for="est_etica">Estado</label>
			<select id="est_etica" name="est_etica" class="form-control borde-v-3 bgc-granada
			color-error"></select>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<label class="casfaltohumedo" for="mun_etica">Municipio</label>
			<select id="mun_etica" name="mun_etica" class="form-control borde-v-3 bgc-granada
			color-error"></select>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<label class="casfaltohumedo" for="par_etica">Parroquia</label>
			<select id="par_etica" name="par_etica" class="form-control borde-v-3 bgc-granada
			color-error"></select>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label class="casfaltohumedo" for="centro_etica">Institución Salud</label>
			<select id="centro_etica" name="centro_etica" class="form-control borde-v-3 bgc-granada
			color-error"></select>
		</div>
	</div>
</div>
<div class="row" id="pub" style="display:none;">
	<div class="col-md-1">
		<div class="form-group text-center">
			<label class="casfaltohumedo" for="chk_pub">Publicado</label><br/>
			<input type="checkbox" id="chk_pub">
			<script type="text/javascript">
				$(function() {
					$("#chk_pub").bootstrapToggle({
						on: 'Si',
						off: 'No',
						onstyle: 'success'
					});
				});
			</script>
		</div>
	</div>
	<div class="col-md-5" id="cpub" style="display:none;">
		<div class="form-group" id="enla_pub">
			<label class="casfaltohumedo" for="enlace">Enlace de la publicación</label>
			<input type="text" id="enlace" name="enlace" class="form-control borde-v-3 bgc-granada
			color-error" placeholder="Introduzca el enlace de la publicación">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-2 pull-right">
		<div class="form-group">
			<input type="button" name="btnGuardar" id="btnGuardar" class="form-control" style="display:none;" value="REGISTRAR" >
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-2 pull-right" style="font-size: 400%;">

		<img src = "<?php echo base_url(); ?>assets/img/icons8-pdf-2-64.png" style="cursor:pointer;display:none;" id="pdf">
	</div>
</div>

</form>

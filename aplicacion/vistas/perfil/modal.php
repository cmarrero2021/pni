<div class="modal fade" role="dialog" aria-labelledby="" aria-hidden="true"  id="userModal" >
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="width:90%;">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="">Title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="la la-remove"></span>
				</button>
			</div>
			<form class="m-form m-form--fit form--label-align-right" id="usuarios_form">
				<div class="modal-body">
					<!-- CONTENIDO -->
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label class="casfaltohumedo" for="titulo_investigacion">Título de la investigación</label>
								<input type="text" id="titulo_investigacion" name="titulo_investigacion" class="form-control borde-v-3 bgc-granada
								color-error" placeholder="Introduzca el título de la investigación">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="casfaltohumedo" for="titulo_investigacion">Fecha de Culminación</label>
								<input type="date" id="fecha_culminacion" name="fecha_culminacion" class="form-control borde-v-3 bgc-granada
								color-error">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="casfaltohumedo" for="resultado_investigacion">Resultado de la investigación</label>
								<textarea id="resultado_investigacion" name="resultado_investigacion" class="form-control borde-v-3 bgc-granada
								color-error" placeholder="Introduzca el resultado de la investigación" rows=4>
							</textarea>
						</div>
					</div>
					<div class="row">

						<div class="col-md-3">
							<div class="form-group text-center">
								<label class="casfaltohumedo" for="apl_pol_pub">¿Tiene aplicación en alguna política pública?</label><br/>
								<input type="checkbox" id="apl_pol_pub">
								<script type="text/javascript">
									$(function() {
										$("#apl_pol_pub").bootstrapToggle({
											on: 'Si',
											off: 'No',
											onstyle: 'success'
										});
									});
								</script>
							</div>
						</div>
						
						<div class="col-md-3" id="cpol" style="display:none;">
							<div class="form-group">
								<label class="casfaltohumedo" for="pol_pub">Cuál Política Pública</label>
								<select id="pol_pub" name="pol_pub" class="form-control borde-v-3 bgc-granada
								color-error"></select>
							</div>
						</div>	
						<div class="col-md-6">
							<div class="form-group">
								<label class="casfaltohumedo" for="responsable_investigacion">Responsables(s) de la investigación
								</label>
								<table id="responsables" class="table w-auto casfaltohumedo" style="background: transparent !important;width:90%;">
									<thead class="casfaltohumedo">
										<th>CÉDULA</th><th>NOMBRES</th><th>APELLIDOS</th><th>
										</thead>
										<tbody>
											<tr>
												<td><input type="number" id="ced_res" class="no-boton borde-v-3" ></td><td><input type="text" id="nom_res" class="borde-v-3"  ></td><td><input type="text" id="ape_res" class="borde-v-3"  ></td><td><i class="fa fa-check fa-2 csuccess" aria-hidden="true" style="cursor:pointer;" id="btn-gRes"></i></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label class="casfaltohumedo" for="linea_investigacion">Línea de investigacion</label>
								<select id="linea_investigacion" name="linea_investigacion" class="form-control borde-v-3 bgc-granada
								color-error"></select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="casfaltohumedo" for="tipo_investigacion">Tipo de investigación</label>
								<select id="tipo_investigacion" name="tipo_investigacion" class="form-control borde-v-3 bgc-granada
								color-error"></select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="casfaltohumedo" for="objetivo_investigacion">Objetivos de la investigación</label>
								<textarea id="objetivo_investigacion" name="objetivo_investigacion" class="form-control borde-v-3 bgc-granada
								color-error" placeholder="Introduzca el objetivo de la investigación" rows=4 required></textarea>
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
						<div class="col-md-3">
							<div class="form-group text-center">
								<label class="casfaltohumedo" for="publicada">Investigación publicada</label><br/>
								<input type="checkbox" id="publicada">
								<script type="text/javascript">
									$(function() {
										$("#publicada").bootstrapToggle({
											on: 'Si',
											off: 'No',
											onstyle: 'success'
										});
									});
								</script>
							</div>
						</div>	
						<div class="col-md-3" id="enlace" style="display:none;">
							<div class="form-group">
								<label class="casfaltohumedo" for="enlace_publicacion">Enlace de la publicación</label>
								<input type="text" id="enlace_publicacion" name="enlace_publicacion" class="form-control borde-v-3 bgc-granada
								color-error" placeholder="Introduzca el título de la investigación">
							</div>
						</div>					
						<div class="col-md-3">
							<div class="form-group">
								<label class="casfaltohumedo" for="fase">Fase actual</label>
								<select id="fase" name="fase" class="form-control borde-v-3 bgc-granada
								color-error"></select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="casfaltohumedo" for="ti" id="lb_tiempo">Tiempo investigación</label>
								<div id="ti">
									<span class="col-md-4">
										<input type="text" class="form-control borde-v-3 bgc-granada color-error" id ="tiempo_dinvestigacion" name="tiempo_dinvestigacion">
									</span>
									<span class="col-md-8">
										<select id="unidad_tiempo" name="unidad_tiempo" class="form-control borde-v-3 bgc-granada
										color-error"></select>
									</span>
								</div>
							</div>
						</div>
					</div>

					<!-- CONTENIDO -->
				</div>
				<br/>
				<div class="modal-footer" style="width:90%;">
					<div class="row pull-right">

						<div class="col-md-2">
							<button type="button" id="btnGuardar" class="btn btn-success" style="display:none;">Guardar</button>
						</div>						
						<div class="col-md-2 col-md-offset-4">
							<button type="button" class="btn btn-danger" id="cerrar" data-dismiss="modal">Cerrar</button>
						</div>
					</div>
				</div> 
			</form>
		</div>
	</div>
</div>
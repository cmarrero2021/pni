<div class="modal fade" role="dialog" aria-labelledby="" aria-hidden="true"id ="viewModal" >
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="width:90%;">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="ftitulo">Ficha del Proyecto</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="la la-remove"></span>
				</button>
			</div>
			<form class="m-form m-form--fit form--label-align-right" id="tusuarios_form">
				<div class="modal-body">
					<!-- CONTENIDO -->
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label class="casfaltohumedo" for="ftitulo_investigacion">Título de la investigación</label>
								<input type="text" id="ftitulo_investigacion" name="ftitulo_investigacion" class="form-control
								">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="casfaltohumedo" for="ftitulo_investigacion">Fecha de Culminación</label>
								<input type="text" id="ffecha_culminacion" name="ffecha_culminacion" class="form-control
								">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="casfaltohumedo" for="fresultado_investigacion">Resultado de la investigación</label>
								<textarea id="fresultado_investigacion" name="fresultado_investigacion" class="form-control 
								"rows=4 style="color:#f00;">
							</textarea>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group text-center">
								<label class="casfaltohumedo" for="fapl_pol_pub">¿Tiene aplicación en política pública?</label><br/>
								<input type="text" id="fapl_pol_pub">
							</div>
						</div>
						<div class="col-md-3" id="fcpol">
							<div class="form-group">
								<label class="casfaltohumedo" for="fpol_pub">Cuál Política Pública</label>
								<input type="text" id="fpol_pub" name="fpol_pub">
							</div>
						</div>	
						<div class="col-md-6">
							<div class="form-group">
								<label class="casfaltohumedo" for="fresponsable_investigacion">Responsables(s) de la investigación
								</label>
								<table id="fresponsables" class="table w-auto casfaltohumedo" style="background: transparent !important;width:90%;">
									<thead class="casfaltohumedo">
										<th>CÉDULA</th><th>NOMBRES</th><th>APELLIDOS</th><th>
										</thead>
										<tbody>

										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label class="casfaltohumedo" for="flinea_investigacion">Línea de investigacion</label>
								<input type="text" id="flinea_investigacion" name="flinea_investigacion" class="form-control
								">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="casfaltohumedo" for="ftipo_investigacion">Tipo de investigación</label>
								<input type="text" id="ftipo_investigacion" name="ftipo_investigacion" class="form-control
								">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="casfaltohumedo" for="fobjetivo_investigacion">Objetivos de la investigación</label>
								<textarea id="fobjetivo_investigacion" name="fobjetivo_investigacion" class="form-control
								" placeholder="Introduzca el objetivo de la investigación" rows=4  style="color:#f00;"></textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2" >
							<div class="form-group">
								<label class="casfaltohumedo" for="ftip_inst">Tipo de Institución</label>
								<input type="text" id="ftip_inst" name="ftip_inst" class="form-control ">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="casfaltohumedo" for="fcentro" id="titulo_centro"></label>
								<input type="text" id="fcentro" name="fcentro" class="form-control
								">
							</div>
						</div>
					</div>
					<div id="fcomunas" style="display:none;">
						<div class="col-md-3">
							<div class="form-group">
								<label class="casfaltohumedo" for="ftip_com">Tipo de Comuna</label>
								<input type="text" id="ftip_com" name="ftip_com" class="form-control
								">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="casfaltohumedo" for="fcomuna">Comuna</label>
								<input type="text" id="fcomuna" name="fcomuna" class="form-control
								">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group text-center">
								<label class="casfaltohumedo" for="fpublicada">Investigación publicada</label><br/>
								<input type="text" id="fpublicada" class="form-control">
							</div>
						</div>	
						<div class="col-md-3" id="enlace">
							<div class="form-group">
								<label class="casfaltohumedo" for="fenlace_publicacion">Enlace de la publicación</label>
								<input type="text" id="fenlace_publicacion" name="fenlace_publicacion" class="form-control">
							</div>
						</div>					
						<div class="col-md-3">
							<div class="form-group">
								<label class="casfaltohumedo" for="ffase">Fase actual</label>
								<input type="text" id="ffase" name="ffase" class="form-control">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="casfaltohumedo" for="ti">Tiempo investigación</label>
								<div id="fti">
									<input type="text" class="form-control " id ="ftiempo_dinvestigacion" name="ftiempo_dinvestigacion">
								</div>
							</div>
						</div>
					</div>					
					<!-- CONTENIDO -->
				</div>
				<br/>
				<div class="modal-footer" style="width:90%;">
					<div class="row pull-right">
						<div class="col-md-2 col-md-offset-4">
							<button type="button" class="btn btn-danger" id="cerrar" data-dismiss="modal">Cerrar</button>
						</div>
					</div>
				</div> 
			</form>
		</div>
	</div>
</div>
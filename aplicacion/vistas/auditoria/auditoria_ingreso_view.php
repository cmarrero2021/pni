<container>
	<div class="row">
		<div class="container table-responsive">
			<table id="item-list" class="table table-bordered table-striped table-hover display" style="width:70%">
				<thead class="bgc-dark clight">
					<tr>
						<th>VER</th>
						<th>ID</th>
						<th>USUARIO</th>
						<th>FECHA HORA INGRESO</th>
						<th>INGRESO</th>
						<th>FECHA HORA SALIDA</th>
						<th>EXPIRÓ SESIÓN</th>
						<th>STATUS</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
</container>
<div id="vistaModal" class="modal fade" tabindex="-1">  
	<div class="modal-dialog">  
		<div class="modal-content">  
			<div class="modal-header">  
				<button type="button" class="close" data-dismiss="modal">&times;</button>  
				<h4 class="modal-title"></h4>  
			</div>  
			<div class="modal-body">  
				<div class="container">
					<div class="row">
						<div class="col-sm-4 col-md-1">
							<label>ID</label>
						</div>
						<div class="col-sm-5 col-md-3">
							<label><span id="id_auditoria_ficha"></span></label>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4 col-md-1" style="background-color:#ccc;">
							<label>USUARIO</label>
						</div>
						<div class="col-sm-5 col-md-5" style="background-color:#ccc;">
							<label><span id="usuario_ficha"></span></label>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4 col-md-1">
							<label>INGRESO</label>
						</div>
						<div class="col-sm-5 col-md-3">
							<label><span id="ingreso_ficha"></span></label>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4 col-md-1" style="background-color:#ccc;">
							<label>INGRESADO</label>
						</div>
						<div class="col-sm-5 col-md-5" style="background-color:#ccc;">
							<label><span id="ingresado_ficha"></span></label>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-4 col-md-1">
							<label>SALIDA</label>
						</div>
						<div class="col-sm-5 col-md-5">
							<label><span id="salida_ficha"></span></label>
						</div>
					</div>				
					<div class="row">
						<div class="col-sm-4 col-md-1" style="background-color:#ccc;">
							<label>EXPIRADO</label>
						</div>
						<div class="col-sm-5 col-md-5" style="background-color:#ccc;">
							<label><span id="expirado_ficha"></span></label>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4 col-md-1">
							<label>STATUS</label>
						</div>
						<div class="col-sm-5 col-md-5">
							<label><span id="status_ficha"></span></label>
						</div>
					</div>
				</div>
			</div>  
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>  
			</div>  
		</div>  
	</div>  
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/tablas/tabla_auditoria_ingreso.js"></script>
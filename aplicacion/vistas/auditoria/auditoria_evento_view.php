<container>
	<div class="row">
		<div class="container table-responsive">
			<table id="item-list" class="table table-bordered table-striped table-hover display" style="width:70%">
				<thead class="bgc-dark clight">
					<tr>
						<th>VER</th>
						<th>ID</th>
						<th>FECHA HORA</th>
						<th>CÉDULA</th>
						<th>LOGIN</th>
						<th>USUARIO</th>
						<th>TABLA</th>
						<th>IP</th>
						<th>PUERTO</th>
						<th>CONSULTA</th>
						<th>DATA</th>
						<th>EVENTO</th>
						<th>CAMBIOS</th>
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
						<div class="col-sm-2 col-md-1">
							<label>ID</label>
						</div>
						<div class="col-sm-7 col-md-4">
							<label><span id="id_auditoria_ficha"></span></label>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-2 col-md-1" style="padding-right: 13%;background-color:#ccc;">
							<label>FECHA</label>
						</div>
						<div class="col-sm-7 col-md-4" style="padding-right: 13%;background-color:#ccc;">
							<label><span id="fechahora_ficha"></span></label>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-2 col-md-1">
							<label>CÉDULA</label>
						</div>
						<div class="col-sm-7 col-md-4">
							<label><span id="cedula_ficha"></span></label>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-2 col-md-1" style="padding-right: 13%;background-color:#ccc;">
							<label>LOGIN</label>
						</div>
						<div class="col-sm-7 col-md-4" style="padding-right: 13%;background-color:#ccc;">
							<label><span id="login_ficha"></span></label>
						</div>
					</div>
					<div id="macaddress">
						<div class="row">
							<div class="col-sm-2 col-md-1">
								<label>USUARIO</label>
							</div>
							<div class="col-sm-7 col-md-4">
								<label><span id="usuario_ficha"></span></label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-2 col-md-1" style="padding-right: 13%;background-color:#ccc;">
							<label>TABLA</label>
						</div>
						<div class="col-sm-7 col-md-4" style="padding-right: 13%;background-color:#ccc;">
							<label><span id="tabla_ficha"></span></label>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-2 col-md-1">
							<label>IP</label>
						</div>
						<div class="col-sm-7 col-md-4">
							<label><span id="ip_ficha"></span></label>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-2 col-md-1" style="padding-right: 13%;background-color:#ccc;">
							<label>PUERTO</label>
						</div>
						<div class="col-sm-7 col-md-4" style="background-color:#ccc;">
							<label><span id="puerto_ficha"></span></label>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-2 col-md-1">
							<label>CONSULTA</label>
						</div>
						<div class="col-sm-7 col-md-4">
							<textarea id="sql_ficha" cols="50" rows = "10" style="font-weight: bold;max-width:100%;"></textarea>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-2 col-md-1">
							<label>DATA</label>
						</div>
						<div class="col-sm-7 col-md-4">
							<textarea id="data_ficha" rows = "10" cols="50" style="font-weight: bold;max-width:100%;"></textarea>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-2 col-md-1" style="padding-right: 13%;background-color:#ccc;">
							<label>EVENTO</label>
						</div>
						<div class="col-sm-7 col-md-4" style="background-color:#ccc;">
							<label><span id="evento_ficha"></span></label>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-2 col-md-1">
							<label>CAMBIOS</label>
						</div>
						<div class="col-sm-7 col-md-4">
							<label><span id="cambio_ficha"></span></label>
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/tablas/tabla_auditoria_evento.js"></script>
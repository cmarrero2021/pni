<div id="userModal" class="modal fade" tabindex="-1" style="width:1250px;">  
	<div class="modal-dialog">  
		<form method="post" id="usuarios_form" autocomplete="off">  
			<div class="modal-content">  
				<div class="modal-header">  
					<button type="button" class="close" data-dismiss="modal">&times;</button>  
					<h4 class="modal-title"></h4>  
				</div>  
				<div class="modal-body">
					<div class="row"  id="cont-etq-usuario" style="display:none;">
						<div class="col-md-4 text-right">
							<label>ID Usuario</label>
						</div>
						<div class="col-md-6">
							<label id="id_usuario"></label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 text-right">
							<label>Cédula de Identidad</label>
						</div>
						<div class="col-md-6">
							<input type="text" name="cedula" id="cedula" class="form-control" placeholder="Cédula de Identidad" required>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 text-right">
							<label>Nombres</label>
						</div>
						<div class="col-md-6">
							<input type="text" name="nombres" id="nombres" class="form-control" placeholder="Nombres" required>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 text-right">
							<label>Apellidos</label>
						</div>
						<div class="col-md-6">
							<input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="Apellidos" required>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 text-right">
							<label>Correo</label>
						</div>
						<div class="col-md-6">
							<input type="text" name="correo" id="correo" class="form-control" placeholder="Correo" required>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 text-right">
							<label>Teléfono</label>
						</div>
						<div class="col-md-6">
							<input type="text" name="telefono" id="telefono" class="form-control" placeholder="Teléfono" required>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 text-right">
							<label>Rol</label>
						</div>
						<div class="col-md-6 form-group">
							<?php echo form_dropdown('roles',$roles,'',array('id' =>'roles','class' =>'form-control')); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 text-right">
							<label>Activo</label>
						</div>
						<div class="col-md-6 checkbox" required>
							<label>
								<input id="activo" name = "activo" type="checkbox" value=true checked>
								<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
							</label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 text-right">
							<label></label>
						</div>
						<div class="col-md-6">
							<input type="text" name="mensaje" id="mensaje" class="form-control bgc-granada color-error" style="display:none;">
						</div>
					</div>						
				</div>						
				<div class="row">
					<div class="col-md-4 text-right">
						<label>Clave</label>
					</div>
					<div class="col-md-6">
						<input type="password" name="clave" id="clave" class="form-control" placeholder="Introduzca su clave" required>
						<!-- -->
						<div id="inst" class="row" style="background-color:#ddd;margin-right:-15%;margin-left:-50%;padding-right:1%;display:none;">
							<ul>
								<i id="cant" class="fa fa-times cdanger" aria-hidden="true"></i>La clave debe tener al menos 8 caracteres<br/>
								<i id="min" class="fa fa-times cdanger" aria-hidden="true"></i>La clave debe tener al menos una minúscula<br/>
								<i id="may" class="fa fa-times cdanger" aria-hidden="true"></i>La clave debe tener al menos una mayúscula<br/>
								<i id="num" class="fa fa-times cdanger" aria-hidden="true"></i>La clave debe tener al menos un número<br/>
								<i id="esp" class="fa fa-times cdanger" aria-hidden="true"></i>La clave debe tener al menos un caracter especial
							</ul>
						</div>
						<!-- -->
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 text-right">
						<label>Confirmar</label>
					</div>
					<div class="col-md-6">
						<input type="password" name="confirmar" id="confirmar" class="form-control" placeholder="Confirme su Clave" required>
					</div>
				</div>
				<div class="modal-footer">
					<div class="row">
						<div class="col-md-2 col-md-offset-4">
							<button type="button" name="btnGuardar" id="btnGuardar" class="btn btn-success" style="display:none;"> Guardar</button>
						</div>
						<div class="col-md-2">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
						</div>
					</div>
				</div>  
			</div> 
		</form>  
	</div>  
</div>
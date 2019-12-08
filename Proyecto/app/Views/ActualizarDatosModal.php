
<div class="modal fade" id="ModalActualizarDatos" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">	
	<div class="modal-dialog modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalScrollableTitle">Actualizar mis datos</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="formUpdate" >
					<div class="form-row">
						<div class="form-group col-md-6">
							<label>Nombres</label>
							<input type="text" class="form-control" id="inputMiNombre" name="inputMiNombre" >
						</div>
						<div class="form-group col-md-6">
							<label>Apellidos</label>
							<input type="text" class="form-control" id="inputMiApellidos" name="inputMiApellidos" >
						</div>
					</div>   

					<div class="form-row">
						<div class="form-group col-md-4">
							<label>Tipo de documento</label>
							<select id="inputMiTipoDocumento" name="inputMiTipoDocumento" class="form-control" >
								<option  value=1>CC</option>
								<option  value=2>TI</option>
								<option  value=3>CE</option>
								<option  value=4>TP</option>
								<option  value=5>Otro</option>
							</select>
						</div>

						<div class="form-group col-md-8">
							<label>Número de documento</label>
							<div class="input-group">
								<input type="text" id="inputMiNumeroDocumento" name="inputMiNumeroDocumento" class="form-control" >
								<div class="input-group-prepend">
									<div class="input-group-text"><i class="fas fa-id-card"></i></div>
								</div> 
							</div>
						</div> 
					</div>       

					<div class="form-group">
						<label>Correo electrónico</label>
						<div class="input-group">
							<input type="email" class="form-control" id="inputMiCorreo" name="inputMiCorreo" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" disabled>
							<div class="input-group-prepend">
								<div class="input-group-text" id="btnGroupAddon"><i class="fas fa-at icono"></i></div>
							</div> 
						</div>
					</div>

									
					
				</div>
				<div class="modal-footer">
					<div class="form-group" id="mensajeMisDatos"></div>	
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-primary" name="btnActualizarMisDatos" id="btnActualizarMisDatos">
						Actualizar
					</button>
				</div>	
			</form>
		</div>
	</div>
</div>

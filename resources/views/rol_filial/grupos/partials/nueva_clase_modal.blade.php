<!-- Modal -->
		<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  {!! Form::open(['route'=>'grupos.nueva_clase'] ) !!}
			
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">@lang('grupo.nuevaclase')</h4>
			  </div>
			  <div class="modal-body">
				
				<div class="form-group row">
			      <label for="inputEmail3" class="col-sm-2 col-form-label">@lang('grupo.descripcion')</label>
			      <div class="col-sm-10">
			       
				{!! Form::text('descripcion',null,array('class'=>'form-control', 'id' => 'nombre')) !!}
					</div>			
                </div>

                <div class="form-group row">
			      <label for="inputEmail3" class="col-sm-2 col-form-label">@lang('grupo.grupo')</label>
			      <div class="col-sm-10">
			       
				{!! Form::select('grupo_id',$grupos->toArray(),null,array('class' => 'form-control', 'id'=>'grupo_id')) !!}
							
                </div>
                </div>

                <div class="form-group row">
			      <label for="inputEmail3" class="col-sm-2 col-form-label">@lang('grupo.docente')</label>
			      <div class="col-sm-10">
			       
				{!! Form::select('docente_id',$docentes->toArray(),null,array('class' => 'form-control', 'id'=>'docente_id')) !!}
							
                </div>
                </div>


                  <div class="form-group row">
			      <label for="inputEmail3" class="col-sm-2 col-form-label">@lang('grupo.horacomienzo')</label>
			      <div class="col-sm-10">
			      	{!! Form::hidden('fecha',null,array('class'=>'form-control', 'id' => 'start')) !!}
			    	<input class="form-control" name="horario_desde" type="time" value="12:00" >
				</div>			
                </div>

                 <div class="form-group row">
			      <label for="inputEmail3" class="col-sm-2 col-form-label">@lang('grupo.horafin')</label>
			      <div class="col-sm-10">
			    	<input class="form-control" name="horario_hasta" type="time" value="12:00" >
				</div>			
                </div>

				
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">@lang('grupo.cerrar')</button>
				<button type="submit" class="btn btn-success">@lang('grupo.guardar')</button>
			  </div>
			{!! Form::close() !!}
			</div>
		  </div>
		</div>
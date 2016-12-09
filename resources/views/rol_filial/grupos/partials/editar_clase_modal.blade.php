

<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			 {!! Form::open(['route'=>'grupos.editar_clase'] ) !!}
			
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">@lang('grupo.editarclase')</h4>
			  </div>
			  <div class="modal-body">
				
			  	<div class="form-group row">
			      <label for="inputEmail3" class="col-sm-2 col-form-label">@lang('grupo.descripcion')</label>
			      <div class="col-sm-10">
			      	{!! Form::hidden('clase_id',null,array('class'=>'form-control', 'id' => 'clase_id')) !!}
			        {!! Form::text('descripcion',null,array('class'=>'form-control', 'id' => 'descripcion')) !!}
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
			    	<input class="form-control" name="horario_desde" type="time" id="horario_desde" >
				</div>			
                </div>

                 <div class="form-group row">
			      <label for="inputEmail3" class="col-sm-2 col-form-label">@lang('grupo.horafin')</label>
			      <div class="col-sm-10">
			    	<input class="form-control" name="horario_hasta" type="time" id="horario_hasta" >
				</div>			
                </div>

             
				<div class="form-group row">
			      <label for="inputEmail3" class="col-sm-2 col-form-label">@lang('grupo.acciones')</label>
			       <div class="col-sm-10">
				   	<ul>
					  <li><a id="clase_matricula">@lang('grupo.pasarasistencia')</a></li>
					  <li><a id="clase_borrar">@lang('grupo.borrarclase')</a></li>
					 </ul>
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

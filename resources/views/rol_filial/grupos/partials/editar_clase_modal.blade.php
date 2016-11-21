

<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			 {!! Form::open(['route'=>'grupos.editar_clase'] ) !!}
			
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Editar clase </h4>
			  </div>
			  <div class="modal-body">
				
			  	<div class="form-group row">
			      <label for="inputEmail3" class="col-sm-2 col-form-label">Descripcion</label>
			      <div class="col-sm-10">
			      	{!! Form::hidden('clase_id',null,array('class'=>'form-control', 'id' => 'clase_id')) !!}
			        {!! Form::text('descripcion',null,array('class'=>'form-control', 'id' => 'descripcion')) !!}
				  </div>
			    </div>


                <div class="form-group row">
			    <label for="inputEmail3" class="col-sm-2 col-form-label">Docente</label>
			    <div class="col-sm-10">
			    	{!! Form::select('docente_id',$docentes->toArray(),null,array('class' => 'form-control', 'id'=>'docente_id')) !!}
				</div>			
                </div>

                <div class="form-group row">
			      <label for="inputEmail3" class="col-sm-2 col-form-label">Hora comienzo</label>
			      <div class="col-sm-10">
			    	<input class="form-control" name="horario_desde" type="time" id="horario_desde" >
				</div>			
                </div>

                 <div class="form-group row">
			      <label for="inputEmail3" class="col-sm-2 col-form-label">Hora fin</label>
			      <div class="col-sm-10">
			    	<input class="form-control" name="horario_hasta" type="time" id="horario_hasta" >
				</div>			
                </div>

             
				<div class="form-group row">
			      <label for="inputEmail3" class="col-sm-2 col-form-label">Acciones</label>
			       <div class="col-sm-10">
				   	<ul>
					  <li><a id="clase_matricula">Pasar asistencia</a></li>
					  <li><a id="clase_borrar">Borrar clase</a></li>
					 </ul>
					</div>	
				 </div> 				
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save changes</button>
			  </div>
			{!! Form::close() !!}
			</div>
		  </div>
		</div>

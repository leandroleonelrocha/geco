<!-- Modal -->
		<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  {!! Form::open(['route'=>'grupos.nueva_clase'] ) !!}
			
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Nueva clase</h4>
			  </div>
			  <div class="modal-body">
				
				<div class="form-group row">
			      <label for="inputEmail3" class="col-sm-2 col-form-label">Descripcion</label>
			      <div class="col-sm-10">
			       
				{!! Form::text('descripcion',null,array('class'=>'form-control', 'id' => 'nombre')) !!}
					</div>			
                </div>

                <div class="form-group row">
			      <label for="inputEmail3" class="col-sm-2 col-form-label">Grupo</label>
			      <div class="col-sm-10">
			       
				{!! Form::select('grupo_id',$grupos->toArray(),null,array('class' => 'form-control', 'id'=>'grupo_id')) !!}
							
                </div>
                </div>

                <div class="form-group row">
			      <label for="inputEmail3" class="col-sm-2 col-form-label">Docente</label>
			      <div class="col-sm-10">
			       
				{!! Form::select('docente_id',$docentes->toArray(),null,array('class' => 'form-control', 'id'=>'docente_id')) !!}
							
                </div>
                </div>


                <div class="form-group row">
			      <label for="inputEmail3" class="col-sm-2 col-form-label">Horario desde</label>
			      <div class="col-sm-10">
			       
				{!! Form::text('horario_desde',null,array('class' => 'form-control', 'id'=>'horario_desde')) !!}
							
                </div>
                </div>


                <div class="form-group row">
			      <label for="inputEmail3" class="col-sm-2 col-form-label">Horario hasta</label>
			      <div class="col-sm-10">
			    {!! Form::hidden('fecha',null,array('class' => 'form-control', 'id'=>'start')) !!}
				   
				{!! Form::text('horario_hasta',null,array('class' => 'form-control', 'id'=>'horario_hasta')) !!}
							
                </div>
                </div>


				<div class="form-group row">
			      <label for="inputEmail3" class="col-sm-2 col-form-label">Color</label>
			      <div class="col-sm-10">
			       
					  <select name="color" class="form-control" id="color">
						  <option value="">Choose</option>
						  <option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
						  <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
						  <option style="color:#008000;" value="#008000">&#9724; Green</option>				  
						  <option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
						  <option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
						  <option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
						  <option style="color:#000;" value="#000">&#9724; Black</option>
						  
						</select>
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
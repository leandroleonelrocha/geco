
{!! Form::open(['route'=> 'filial.preinformes_nuevoDatosMedio_post', 'method'=>'post']) !!}
	<div class="col-md-6 form-group">
		<label>Medio</label> 
	<!-- 	                        				<button class="add_input_medio btn-xs btn-success">+</button>   
		<div class="input_fields_medio">
			<input type="text" name="medio[]" class="form-control">
		</div> -->
	    {!!Form::text('medio',null,array('class'=>'form-control')) !!}
	</div>

	 <div class="box-footer col-xs-12">
		<button type="submit" class="btn btn-success">@lang('preinforme.crear')</button>
	</div>
{!! Form::close() !!}

<table id="example1" class="table table-bordered table-striped">
	<thead> <tr>
		<th>@lang('preinforme.listamedios')</th>
	</tr> </thead>

	<tbody>
		@foreach($medios as $m)
			<tr role="row" class="odd">
			<td class="sorting_1">{{ $m->medio }}</td>
			</tr>
		@endforeach
	</tbody>
</table>
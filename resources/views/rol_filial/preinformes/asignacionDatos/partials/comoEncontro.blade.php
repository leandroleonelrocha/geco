{!! Form::open(['route'=> 'filial.preinformes_nuevoDatosEncontro_post', 'method'=>'post']) !!}
	<div class="col-md-6 form-group">
		<label>@lang('preinforme.encontro')</label>
		<!--                                             <button class="add_input_encontro btn-xs btn-success">+</button>
		<div class="input_fields_encontro">
		    <input type="text" name="como_encontro[]" class="form-control">
		</div>  -->
		{!!Form::text('como_encontro',null,array('class'=>'form-control')) !!}
	</div>

	<div class="box-footer col-xs-12">
		<button type="submit" class="btn btn-success">@lang('preinforme.crear')</button>
	</div>
{!! Form::close() !!}

<table id="example1" class="table table-bordered table-striped">
	<thead> <tr>
		<th>@lang('preinforme.listacomoencontro')</th>
	</tr> </thead>

	<tbody>
		@foreach($comoEncontro as $cE)
			<tr role="row" class="odd">
				<td class="sorting_1">{{ $cE->como_encontro }}</td>
			</tr>
		@endforeach
	</tbody>
</table>	
{!! Form::open(['route'=> 'filial.cambioMail_post', 'method'=>'post']) !!}
	<div class="col-md-12 form-group">
		<label>@lang('filial.cuenta')</label>
		<input type="hidden" name="id" value="{{$filial->id}}">
		<input type="hidden" name="maila" value="{{$filial->mail}}">
	    {!! Form::email('mail',$filial->mail,array('class'=>'form-control')) !!}
	</div>

	<div class="box-footer col-xs-12">
	    <button type="submit" class="btn btn-success">@lang('filial.guardar')</button>
	</div>
{!! Form::close() !!}
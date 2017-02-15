@extends('template')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">@lang('preinforme.asignardatos')</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
							<div class="nav-tabs-custom col-xs-12">
								<ul class="nav nav-tabs">
									<li class="active"><a href="#tab_1" data-toggle="tab">Medios</a></li>
									
									<li><a href="#tab_2" data-toggle="tab">@lang('preinforme.encontro')</a></li>	
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="tab_1">
										{!! Form::open(['route'=> 'filial.preinformes_nuevoDatosMedio_post', 'method'=>'post']) !!}
										<div class="col-md-6 form-group">
	                        				<label>Medio</label> 
	                        				<!-- <button class="add_input_medio btn-xs btn-success">+</button>   
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

									</div><!-- /.tab-pane -->
									<div class="tab-pane" id="tab_2">
										{!! Form::open(['route'=> 'filial.preinformes_nuevoDatosEncontro_post', 'method'=>'post']) !!}
										<div class="col-md-6 form-group">
                                			<label>@lang('preinforme.encontro')</label> 
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
									</div><!-- /.tab-pane -->
								</div><!-- tab-content -->
							</div><!-- nav-tabs-custom -->
                        </div>
                    </div>



                </div><!-- Fin box-body -->
            </div> <!-- Fin box -->
        </div> <!-- Fin col -->
    </div> <!-- Fin row -->

@endsection
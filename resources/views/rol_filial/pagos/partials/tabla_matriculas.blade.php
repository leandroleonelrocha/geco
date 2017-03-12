<table id="example1" class="table table-bordered table-striped">
						<thead> <tr>
						<th>@lang('matricula.numero')</th>
						<th>@lang('matricula.asesor')</th>
						<th>@lang('matricula.persona')</th>
						<th>@lang('matricula.terminado')</th>
						<th>@lang('matricula.cancelado')</th>
						<th class="no-print"></th>
						</tr> </thead>
						<tbody>
						@foreach($matriculas as $matricula)
							<tr>
								<td>{{$matricula->id}}</td>
								<td>{{$matricula->Asesor->apellidos}} {{$matricula->Asesor->nombres}}</td>
								<td>{{$matricula->Persona->apellidos}} {{$matricula->Persona->nombres}}</td>
								<td>
									<?php if($matricula->terminado == 0) { ?>
										<span> @lang('matricula.no') </span>
									<?php }else{ ?>
										<span> @lang('matricula.si') </span>
									<?php } ?>
								</td>

								<td>
									<?php if($matricula->cancelado == 0) ?>
										<span> @lang('matricula.no') </span>
									<?php }else{ ?>
										<span> @lang('matricula.si') </span>
									<?php } ?>
								</td>
								<td class="text-center">

								<a href="{{route('filial.pagos',$matricula->id)}}" class="btn btn-success">@lang('matricula.verpagos')</a>

								</td>
							</tr>
						@endforeach
						</tbody>
					</table>	
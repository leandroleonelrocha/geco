@extends('template')

@section('content')

	<div class="row">
    <div class="col-xs-12">
      <div class="box-tools pull-right no-print destino">
       
      </div>
    </div> <!-- Fin col -->
  </div> <!-- Fin row -->

	<div class="row">
		<div class="col-xs-12">
			
			<div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab">@lang('matricula.listadomatricula')</a></li>
                  <li><a href="#tab_2" data-toggle="tab">@lang('impresiones/morosidad.listado')</a></li>
                  <li><a href="#tab_3" data-toggle="tab">@lang('impresiones/libro_iva.libro')</a></li>
                </ul>

                <div class="tab-content">

                <div class="tab-pane active" id="tab_1">
               		@include('rol_filial.pagos.partials.tabla_matriculas')
                </div><!-- /.tab-pane -->
                
                <div class="tab-pane" id="tab_2">
                	@include('rol_filial.pagos.partials.tabla_morosidad')
                </div><!-- /.tab-content -->

                <div class="tab-pane" id="tab_3">
                	@include('rol_filial.pagos.partials.tabla_libro_iva')
                </div><!-- /.tab-content -->

                </div><!-- nav-tabs-custom -->
            </div><!-- /.col -->

		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection

@section('js')
<script type="text/javascript">
	 $('.daterangerp').daterangepicker();
	 $('.dateranger2').daterangepicker();

   alert('asdasd');
  //$("#enlaceajax").click(function(evento){
    //  evento.preventDefault();
      $(".destino").load("{{ URL::to('/filial/carrito') }}");
   
  //}); 


</script>
<script type="text/javascript" src="{{asset('js/functions/buscar_morosos.js')}}"></script>
<script type="text/javascript" src="{{asset('js/functions/buscar_libro_iva.js')}}"></script>
@endsection
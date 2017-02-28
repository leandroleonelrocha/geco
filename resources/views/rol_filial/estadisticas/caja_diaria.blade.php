@extends('template')

@section('content')
	
	<section class="invoice">
          <!-- title row -->
          <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                <i class="fa fa-bank"></i> 
               {{$filial->Cadena->nombre}}
               - {{$filial->fullname}}

                <small class="pull-right">Fecha: {{helpersgetFecha($fecha)}}</small>
              </h2>
            </div><!-- /.col -->
          </div>
         	<div class="col-xs-12">
              <p class="lead">@lang('estadistica.planilla')</p>
            </div><!-- /.col -->

          <!-- Table row -->
          <div class="row">
            <div class="col-xs-12 table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>@lang('estadistica.recibo')</th>
                    <th>@lang('estadistica.matricula')</th>
                    <th>@lang('estadistica.grupo')</th>
                    <th>@lang('estadistica.ayn')</th>
                    <th>@lang('estadistica.importe')</th>
                  </tr>
                </thead>
                <tbody>
                
                	@foreach($pagos as $recibo)
                  <tr>
                    <td>{{$recibo->ReciboTipo->recibo_tipo}}</td>
                    <td>{{$recibo->Pago->Matricula->id}}</td>
                    <td>
 
                      @if($recibo->Pago->Matricula->carrera_id != null)
                        {{$recibo->Pago->Matricula->Carrera->nombre}}
                      @else
                        {{$recibo->Pago->Matricula->Curso->nombre}}
                      @endif

                    </td>
                    <td>{{$recibo->Pago->Matricula->Persona->fullname}}</td>
                    <td>$ {{$recibo->monto}}</td>
                  </tr>
                 	@endforeach
                </tbody>
              </table>
            </div><!-- /.col -->
          </div><!-- /.row -->

          <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
             
            </div><!-- /.col -->
            <div class="col-xs-6">
            
              <div class="table-responsive">
                <table class="table">
                  <tbody><tr>
                    <th style="width:50%">@lang('estadistica.cuotas')</th>
                    <td>
                      <?php
                        $total=0;
                        foreach ($pagos as $recibo) {

                        $total += $recibo['monto'];
                        }
                        echo '$ ' .$total;
                      ?>
                    </td>
                  </tr>
                  <tr>
                    <th>@lang('estadistica.recargos')</th>
                    <td>
                      <?php
                        $total=0;
                        foreach ($pagos as $recibo) {
                        $total += $recibo->Pago['recargo_adicional'];
                        }
                        echo '$ ' .$total;
                      ?>
                    </td>
                  </tr>
                
                  <tr>
                    <th>@lang('estadistica.total')</th>
                    <td>
                      <?php
                        $total=0;
                        foreach ($pagos as $recibo) {
                        $total += $recibo['monto'];
                        }
                        echo '$ ' .$total;
                      ?>
                    </td>
                  </tr>
                </tbody></table>
              </div>
            </div><!-- /.col -->
          </div><!-- /.row -->

         
        </section>
@endsection
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
              <p class="lead">PLANILLA DE CAJA DIARIA</p>
            </div><!-- /.col -->

          <!-- Table row -->
          <div class="row">
            <div class="col-xs-12 table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>RECIBO</th>
                    <th>MATRICULA</th>
                    <th>GRUPO</th>
                    <th>APELLIDO Y NOMBRE</th>
                    <th>IMPORTE</th>
                  </tr>
                </thead>
                <tbody>
                
                	@foreach($pagos as $pago)
                  <tr>
                    <td>{{$pago->Recibo}}</td>
                    <td>{{$pago->Matricula->id}}</td>
                    <td><?php 
											if ($pago->Matricula->carrera_id != null) echo $matricula->Carrera->nombre;
											else echo $pago->Matricula->Curso->nombre;
											?></td>
                    <td>{{$pago->Matricula->Persona->fullname}}</td>
                    <td>$ {{$pago->monto_pago}}</td>
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
                    <th style="width:50%">Cuotas:</th>
                    <td>
                      <?php
                        $total=0;
                        foreach ($pagos as $pago) {
                        $total += $pago['monto_pago'];
                        }
                        echo '$ ' .$total;
                      ?>
                    </td>
                  </tr>
                  <tr>
                    <th>Recargos</th>
                    <td>
                      <?php
                        $total=0;
                        foreach ($pagos as $pago) {
                        $total += $pago['recargo_adicional'];
                        }
                        echo '$ ' .$total;
                      ?>
                    </td>
                  </tr>
                
                  <tr>
                    <th>Total:</th>
                    <td>
                       <?php
                        $total=0;
                        foreach ($pagos as $pago) {
                        $total += $pago['monto_pago'];
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
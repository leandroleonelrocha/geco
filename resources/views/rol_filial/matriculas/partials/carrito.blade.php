<!-- Button trigger modal
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
  Launch demo modal
</button>
 -->

<div class="modal fade" id="ModalEdit"  role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">@lang('impresiones/recibo.carrito')</h5>
        
      </div>
      <div class="modal-body">
        <div class="table-responsive">
                            <table class="table no-margin">

                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>@lang('impresiones/recibos.npago')</th>
                                  <th>@lang('impresiones/recibo.recargo')</th>
                                  <th>@lang('impresiones/recibos.descuento')</th>
                                  <th>@lang('impresiones/recibos.monto')</th>
                                </tr>
                              </thead>
                              <tbody>

                                 <?php
                                  $model           = Session::get('pagos');
                                 
                                 ?>
                                
                               
                                @if(count($model) > 0)
                                  @foreach($model as $pago)

                                  <tr>
                                    <td>
                                    @if($pago['nro_pago'] == 0)
                                    <a href="#">@lang('matricula.matricula')</a>
                                    
                                    @else
                                    <a href="#">@lang('matricula.numerodepago'): {{$pago['nro_pago']}}</a>
                                    @endif

                                    </td>
                                    <td>$ {{$pago['cuanto_pago'] }}</td>
                                    <td>$ + {{$pago['recargo_adicional']}}</td>
                                    <td>$ - {{$pago['descuento_adicional'] }}</td>
                                    <td>$ {{$pago['cuanto_pago'] + $pago['recargo_adicional'] - $pago['descuento_adicional'] }}
                                  </td>
                                    
                                  </tr>
                                
                                  @endforeach
                                  
                                  <tr><td>@lang('impresiones/recibo.total')</td><td></td><td></td>
                                  <td></td>
                                  <td>
                                  <?php
                                      $total=0;
                                      foreach ($model as $pago) {
                                         
                                          $total += $pago['cuanto_pago'] + $pago['recargo_adicional'];
                                          $total -= $pago['descuento_adicional'];
                                      }
                                      echo '$ ' .$total;
                                  ?>
                                  </td>
                                  </tr>


                                @endif
                                                                
                              </tbody>
                            </table>

      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('impresiones/recibo.cerrar')</button>
       <a href="{{route('filial.carrito_imprimir')}}" target="_blank" type="button" class="btn btn-primary">@lang('impresiones/recibo.confirmar')</a>
      </div>
    </div>
  </div>
</div>


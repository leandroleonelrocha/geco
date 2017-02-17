<!-- Button trigger modal
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
  Launch demo modal
</button>
 -->

<div class="modal fade" id="ModalEdit"  role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        
      </div>
      <div class="modal-body">
        <div class="table-responsive">
                            <table class="table no-margin">

                              <thead>
                                <tr>
                                  <th>Order ID</th>
                                  <th>Recargo</th>
                                  <th>Descuento</th>
                                  <th>Monto</th>
                                </tr>
                              </thead>
                              <tbody>

                                 <?php
                                  $model           = Session::get('pagos');
                               
                                 ?>
                               
                                @if(count($model) > 0)
                                  @foreach($model as $pago)
                                  
                                  <tr>
                                    <td><a href="pages/examples/invoice.html">Numero de pago: {{$pago['pago']}}</a></td>
                                    <td>$ {{$pago['recargo_adicional']}}</td>
                                    <td>$ {{$pago['descuento_adicional'] }}</td>
                                    <td>$ {{$pago['monto_a_pagar'] + $pago['recargo_adicional'] - $pago['descuento_adicional'] }}</td>
                                    
                                  </tr>
                                
                                  @endforeach
                                  <?php
                                    $total = $pago['monto_a_pagar'] + $pago['recargo_adicional'] - $pago['descuento_adicional'];

                                  ?>
                                  <tr><td>TOTAL</td><td></td><td></td>
                                  <td>
                                  $ {{$total}}
                                  </td>
                                  </tr>


                                @endif
                                                                
                              </tbody>
                            </table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
        
        <a href="{{route('filial.carrito_imprimir')}}" target="_blank" type="button" class="btn btn-primary">Guardar</a>
      </div>
    </div>
  </div>
</div>


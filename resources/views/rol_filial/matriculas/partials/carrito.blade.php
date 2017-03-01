<!-- Button trigger modal
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
  Launch demo modal
</button>
 -->

<div class="modal fade" id="ModalEdit"  role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Carrito de pagos</h5>
        
      </div>
      <div class="modal-body">
        <div class="table-responsive">
                            <table class="table no-margin">

                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Pagó</th>
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
                                    <td>
                                    @if($pago['nro_pago'] == 0)
                                    <a href="#">Matricula</a>
                                    
                                    @else
                                    <a href="#">Numero de pago: {{$pago['nro_pago']}}</a>
                                    @endif

                                    </td>
                                    <td>$ {{$pago['cuanto_pago'] }}</td>
                                    <td>$ + {{$pago['recargo_adicional']}}</td>
                                    <td>$ - {{$pago['descuento_adicional'] }}</td>
                                    <td>$ {{$pago['cuanto_pago'] + $pago['recargo_adicional'] - $pago['descuento_adicional'] }}
                                  </td>
                                    
                                  </tr>
                                
                                  @endforeach
                                  
                                  <tr><td>TOTAL</td><td></td><td></td>
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
       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       <a href="{{route('filial.carrito_imprimir')}}" target="_blank" type="button" class="btn btn-primary">Confirmar</a>
      </div>
    </div>
  </div>
</div>


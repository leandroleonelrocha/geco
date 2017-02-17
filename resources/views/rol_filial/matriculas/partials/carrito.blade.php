<!-- Button trigger modal
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
  Launch demo modal
</button>
 -->
<!-- Modal -->
<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <table class="table no-margin">
                              <thead>
                                <tr>
                                  <th>Order ID</th>
                                  <th>Item</th>
                                  <th>Status</th>
                                  <th>Popularity</th>
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
                                  <td>Call of Duty IV</td>
                                  <td><span class="label label-success">Monto: {{ $pago['monto_a_pagar']}}</span></td>
                                  <td><div class="sparkbar" data-color="#00a65a" data-height="20"><canvas width="34" height="20" style="display: inline-block; width: 34px; height: 20px; vertical-align: top;"></canvas></div></td>
                                </tr>
                                @endforeach
                                @endif
                               
                                 
                              </tbody>
                            </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

 


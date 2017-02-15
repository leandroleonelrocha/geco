<!-- Button trigger modal
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
  Launch demo modal
</button>
 -->



<div class="modal fade" id="ModalEdit"  role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
      <div class="modal-content">
       {!! Form::open(['route'=>'grupos.editar_clase'] ) !!}
      
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">@lang('grupo.editarclase')</h4>
        </div>
        <div class="modal-body">
          <div class="modal-body">
                            <div class="box box-info">
                        <div class="box-header with-border">
                          <h3 class="box-title">Latest Orders</h3>
                          <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                          </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                          <div class="table-responsive">
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
                          </div><!-- /.table-responsive -->
                        </div><!-- /.box-body -->
                        <div class="box-footer clearfix">
                          <a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
                          <a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
                        </div><!-- /.box-footer -->
                      </div>
                  </div>
              
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('grupo.cerrar')</button>
        <button type="submit" class="btn btn-success">@lang('grupo.guardar')</button>
        </div>
      {!! Form::close() !!}
      </div>
      </div>
    </div>


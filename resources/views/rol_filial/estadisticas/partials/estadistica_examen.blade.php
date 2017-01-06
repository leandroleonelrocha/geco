<div class="row">
	<div class="col-md-12">
		<div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Bordered Table</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered">
                    
                    <tr>
                      <th style="width: 10px">Acta</th>
                      <th>Grupo</th>
                      <th>Exámenes</th>
                      <th>Resultado</th>
                      <th style="width: 40px">Promedio</th>
                    </tr>
                   	@foreach($examenes as $examen)
                    <tr>
                      <td>{{$examen->nro_acta}}		</td>
                      <td>{{$examen->descripcion}}	</td>
                      <td>{{$examen->cantidad}}		</td>
                      </td>
                      <td>
                        <div class="progress progress-xs">
                          <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                        </div>
                      </td>
                      <td><span class="badge bg-red">{{$examen->promedio}}</span></td>
                    </tr>
                    @endforeach
                 
                  </table>
        </div><!-- /.box-body -->
    </div>
</div>        
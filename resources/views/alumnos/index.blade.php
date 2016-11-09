
@extends('template')
@section('content-header')
    <h1>
        Listado de areas.

        <small>Preview page</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Widgets</li>
    </ol>
@endsection

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Data Table With Full Features</h3>
    </div><!-- /.box-header -->
        <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Rendering engine</th>
                        <th>Browser</th>
                        <th>Platform(s)</th>
                        <th>Engine version</th>
                        <th>CSS grade</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Triasdasdent</td>
                        <td>Intasdernet
                          Explasdasdorer 4.0</td>
                        <td>Wasdasin 95+</td>
                        <td> 4</td>
                        <td>Xasd</td>
                      </tr>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Rendasering engine</th>
                        <th>Browasser</th>
                        <th>Platform(s)</th>
                        <th>Engasine version</th>
                        <th>CSS grade</th>
                      </tr>
                    </tfoot>
        </table>
    </div><!-- /.box-body -->
</div><!-- /.box -->
@endsection


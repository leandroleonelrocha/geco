<div class="row">
            <div class="col-lg-4 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3>@if(isset($total_filial) ){{$total_filial}}@endif
                  </h3>
                  <p>@lang('estadistica.filiales')</p>
                </div>
                <div class="icon">
                  <i class="fa fa-institution "></i>
                </div>
                <a href="#" class="small-box-footer">@lang('estadistica.masinformacion') <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-4 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>@if(isset($total_persona) ){{$total_persona}}@endif</h3>
                  <p>@lang('estadistica.personas')</p>
                </div>
                <div class="icon">
                  <i class="fa fa-users"></i>
                </div>
                <a href="#" class="small-box-footer">@lang('estadistica.masinformacion') <i class="fa fa-arrow-circle-right"></i></a>
              </div>

            </div><!-- ./col -->
            <div class="col-lg-4 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>@if(isset($total_asesor) ){{$total_persona}}@endif</h3>
                  <p>@lang('estadistica.asesores')</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">@lang('estadistica.masinformacion') <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->



          
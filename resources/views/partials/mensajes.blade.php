<div class="row">
    <div class="col-xs-12">
        {{-- Errors --}}
        @if ($errors->count() > 0)
            <div class="alert alert-danger">
                <strong>@lang('mensaje.mensajeerror')</strong><br />
                <ul>
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Success --}}
        @if (session()->has('msg_ok'))
            <div class="alert alert-success">
                <strong>@lang('mensaje.exito')</strong><br />
                {{ session('msg_ok') }}
            </div>
        @endif

        @if (session()->has('msg_error'))
            <div class="alert alert-danger">
                <strong>@lang('mensaje.error')</strong><br />
                {{ session('msg_error') }}
            </div>
        @endif

        @if(session()->has('estado_cuenta'))
             <div class="alert alert-danger">
                <h4><i class="icon fa fa-ban"></i> @lang('mensaje.alerta')</h4>
                <strong>@lang('mensaje.alerta') {{session('estado_cuenta')}} </strong><br />
               
            </div>
        @endif



    </div>
</div>
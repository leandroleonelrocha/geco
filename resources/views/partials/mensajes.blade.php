<div class="row">
    <div class="col-xs-12">
        {{-- Errors --}}
        @if ($errors->count() > 0)
            <div class="alert alert-danger">
                <strong>Error! Se han encontrado los siguientes errores:</strong><br />
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
                <strong>Éxito!</strong><br />
                {{ session('msg_ok') }}
            </div>
        @endif

        @if (session()->has('msg_error'))
            <div class="alert alert-danger">
                <strong>Error!</strong><br />
                {{ session('msg_error') }}
            </div>
        @endif



    </div>
</div>
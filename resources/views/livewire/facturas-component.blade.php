<div class="container my-5">
    @if (session('success'))
        <div class="alert alert-primary" role="alert">
            {{ session('success') }}
        </div>
    @endif
    {{-- <div class="d-flex justify-content-end mb-3">
        <a href="#" class="btn btn-danger"
            onclick="event.preventDefault(); if(confirm('¿Estás seguro de que deseas cerrar sesión?')) { document.getElementById('logout-form').submit(); }">Cerrar
            sesión</a>
        <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
            @csrf
        </form>
    </div> --}}
    <div class="card">

        <div class="card-header" id="top_header">
            <h5>Registro de Servicios</h5>
            {{-- <a href="{{ route('backoffice-recomendador-list') }}">Lista de facturas Recomendador</a> --}}
            {{-- <a href="{{ route('dashboard') }}">Men&uacute;</a> --}}

            <div class="row mt-2">
                <div class="col-md-2">
                    <input type="text" wire:model.live="id_recomendador" class="form-control" placeholder="ID" autocomplete="off">
                </div>
                <div class="col-md-2">
                    <input type="text" wire:model.live="id_nit" class="form-control" placeholder="NIT" autocomplete="off">
                </div>
                <div class="col-md-2">
                    <input type="text" wire:model.live="id_cedula" class="form-control" placeholder="Cédula" autocomplete="off">
                </div>
                <div class="col-md-2">
                    <input type="text" wire:model.live="id_nombre" class="form-control" placeholder="Nombre" autocomplete="off">
                </div>
            </div>
        </div>
        {{-- @isset($RegistroFactura)
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-12">
                                <span class="fw-bold">#</span>
                                {{ $RegistroFactura->id }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <span class="fw-bold">Usuario:</span>
                                {{ $RegistroFactura->recomendador->nombre }} <br>
                                <span class="fw-bold">Correo:</span>
                                {{ $RegistroFactura->recomendador->correo }}
                            </div>
                            <div class="col-4">
                                <span class="fw-bold">Celular:</span>
                                {{ $RegistroFactura->recomendador->celular }} <br>
                                <span class="fw-bold">Cedula:</span>
                                {{ $RegistroFactura->recomendador->cedula }} <br>
                                <span class="fw-bold">Número bonos:</span>
                                {{ $RegistroFactura->num_bonos }}
                            </div>
                            <div class="col-4">
                                <span class="fw-bold">Fecha:</span>
                                {{ $RegistroFactura->created_at }}
                            </div>
                            <div class="col-4">
                                <span class="fw-bold">Ciudad:</span>
                                {{ $RegistroFactura->recomendador->ciudad }}
                            </div>
                            <div class="col-4">
                                <span class="fw-bold">Punto de venta:</span>
                                {{ $RegistroFactura->recomendador->pdv->nombre_comercial }}
                            </div>
                            <div class="col-4">
                                <span class="fw-bold">NIT:</span>
                                {{ $RegistroFactura->recomendador->pdv->nit }}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                @php
                                    $foto_factura = str_replace('public/', '', $RegistroFactura->foto_factura);
                                @endphp
                                <div class="form-group d-flex flex-column">
                                    <label for="">Foto de factura:</label>
                                    <a href="{{ asset("storage/$foto_factura") }}" target="_blank">
                                        <img src="{{ asset("storage/$foto_factura") }}" height="250"
                                            width="250">
                                    </a>
                                </div>
                                <div class="form-group d-flex flex-column">
                                    <label for="">Número de factura: {{ $RegistroFactura->num_factura }}</label>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group mb-2">
                                    <label for="">Observaciones:</label>
                                    <textarea wire:model.lazy="observaciones" cols="30" rows="3" class="form-control"></textarea>
                                    @error('observaciones')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button class="btn btn-success" wire:click="validacionRegistro(1)"
                                    wire:confirm="¿Estas segur@ de APROBAR esta factura?"> Aprobar factura</button>
                                <button class="btn btn-danger" wire:click="validacionRegistro(0)"
                                    wire:confirm="¿Estas segur@ de RECHAZAR esta factura?"> Rechazar factura</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset --}}
        <div class="card-body">
            @foreach ($RegistroFacturas as $RegistroFactura)
                <div class="card my-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <span class="fw-bold">#</span>
                                {{ $RegistroFactura->id }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <span class="fw-bold">Usuario:</span>
                                {{ $RegistroFactura->user->nombre }} <br>
                                <span class="fw-bold">Correo:</span>
                                {{ $RegistroFactura->user->correo }} <br>
                            </div>
                            <div class="col-3">
                                <span class="fw-bold">Celular:</span>
                                {{ $RegistroFactura->user->celular }} <br>
                                <span class="fw-bold">Cedula:</span>
                                {{ $RegistroFactura->user->cedula }} <br>
                                <span class="fw-bold">Número bonos:</span>
                                {{ $RegistroFactura->num_bonos }}
                            </div>
                            <div class="col-3">
                                <span class="fw-bold">Fecha:</span>
                                {{ $RegistroFactura->created_at }} <br>
                            </div>
                            <div class="col-2">
                                <button wire:click="getRegistro({{ $RegistroFactura->id }})" class="btn btn-primary get_registro_btn">
                                    Ver mas </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="card-body">
                {{ $RegistroFacturas->links() }}
            </div>
        </div>
    </div>
</div>

<script>
    const topHeader = document.getElementById('top_header');
    const getRegistroBtn = document.querySelectorAll('.get_registro_btn');
    getRegistroBtn.forEach(btn => {
        btn.addEventListener('click', () => {
            topHeader.scrollIntoView();
        });
    });
</script>

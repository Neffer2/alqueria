<div class="container my-5">
    @if (session('success'))
        <div class="alert alert-primary" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="card"> 
        <div class="card-header">
            <h3>Registro de Premios</h3>
        </div>
        @isset($RegistroFactura)
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
                                {{ $RegistroFactura->user->nombre }} {{ $RegistroFactura->user->apellido }} <br>
                                <span class="fw-bold">Correo:</span>
                                {{ $RegistroFactura->user->email }} <br>
                            </div>
                            <div class="col-3">
                                <span class="fw-bold">Celular:</span>
                                {{ $RegistroFactura->user->telefono }} <br>
                                <span class="fw-bold">Cedula:</span>
                                {{ $RegistroFactura->user->documento }} <br>
                            </div>
                            <div class="col-3">
                                <span class="fw-bold">Fecha:</span>
                                {{ $RegistroFactura->created_at }} <br>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group d-flex flex-column">
                                            <label for="">Foto de factura:</label>
                                            <a href='{{ asset("storage/".str_replace('public/', '', $RegistroFactura->foto_factura)."") }}' target="_blank">
                                                <img src='{{ asset("storage/".str_replace('public/', '', $RegistroFactura->foto_factura)."") }}' height="250"
                                                    width="250">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Foto de producto:</label>
                                        <a href='{{ asset("storage/".str_replace('public/', '', $RegistroFactura->foto_producto)."") }}' target="_blank">
                                            <img src='{{ asset("storage/".str_replace('public/', '', $RegistroFactura->foto_producto)."") }}' height="250"
                                                width="250">
                                        </a>
                                    </div>
                                </div>
                                <div class="form-group d-flex flex-column">
                                    <label for="">Número de factura:</label>
                                    <input type="text" wire:model.lazy="num_factura" class="form-control">
                                    @error('num_factura')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
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
        @endisset
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
                                {{ $RegistroFactura->user->nombre }} {{ $RegistroFactura->user->apellido }} <br>
                                <span class="fw-bold">Correo:</span>
                                {{ $RegistroFactura->user->email }} <br>
                            </div>
                            <div class="col-3">
                                <span class="fw-bold">Celular:</span>
                                {{ $RegistroFactura->user->telefono }} <br>
                                <span class="fw-bold">Cedula:</span>
                                {{ $RegistroFactura->user->documento }} <br>
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

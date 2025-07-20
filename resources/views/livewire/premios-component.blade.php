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
        @isset($RegistroPremio)
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-12">
                                <span class="fw-bold">#</span>
                                {{ $RegistroPremio->id }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <span class="fw-bold">Usuario:</span>
                                {{ $RegistroPremio->user->nombre }} {{ $RegistroPremio->user->apellido }} <br>
                                <span class="fw-bold">Correo:</span>
                                {{ $RegistroPremio->user->email }} <br>
                            </div>
                            <div class="col-3">
                                <span class="fw-bold">Celular:</span>
                                {{ $RegistroPremio->user->telefono }} <br>
                                <span class="fw-bold">Cedula:</span>
                                {{ $RegistroPremio->user->documento }} <br>
                            </div>
                            <div class="col-3">
                                <span class="fw-bold">Fecha:</span>
                                {{ $RegistroPremio->created_at }} <br>
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
                                            <a href='{{ asset("storage/".str_replace('public/', '', $RegistroPremio->factura->foto_factura)."") }}' target="_blank">
                                                <img src='{{ asset("storage/".str_replace('public/', '', $RegistroPremio->factura->foto_factura)."") }}' height="250"
                                                    width="250">
                                            </a>
                                        </div>
                                    </div> 
                                    <div class="col-md-6">
                                        <label for="">Foto de producto:</label>
                                        <a href='{{ asset("storage/".str_replace('public/', '', $RegistroPremio->factura->foto_producto)."") }}' target="_blank">
                                            <img src='{{ asset("storage/".str_replace('public/', '', $RegistroPremio->factura->foto_producto)."") }}' height="250"
                                                width="250">
                                        </a>
                                    </div>
                                </div>
                                <div class="form-group d-flex flex-column">
                                    <label for="">Número de factura {{ $RegistroPremio->factura->num_factura }}:</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-2">
                                    <label for="">C&oacute;digo de premio:</label>
                                    <input type="text" wire:model.lazy="num_premio" class="form-control">
                                    @error('num_premio')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-2">
                                    <label for="">Observaciones:</label>
                                    <textarea disabled cols="30" rows="2" class="form-control">{{ $RegistroPremio->observaciones }}</textarea>
                                </div>
                                <button class="btn btn-success" wire:click="validacionRegistro(1)"
                                    wire:confirm="¿Estas segur@ de APROBAR esta factura?"> Marcar como entregado </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
        <div class="card-body">
            @foreach ($RegistroPremios as $RegistroPremio)
                <div class="card my-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <span class="fw-bold">#</span>
                                {{ $RegistroPremio->id }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <span class="fw-bold">Usuario:</span>
                                {{ $RegistroPremio->user->nombre }} {{ $RegistroPremio->user->apellido }} <br>
                                <span class="fw-bold">Correo:</span>
                                {{ $RegistroPremio->user->email }} <br>
                            </div>
                            <div class="col-3">
                                <span class="fw-bold">Celular:</span>
                                {{ $RegistroPremio->user->telefono }} <br>
                                <span class="fw-bold">Cedula:</span>
                                {{ $RegistroPremio->user->documento }} <br>
                            </div>
                            <div class="col-3">
                                <span class="fw-bold">Fecha:</span>
                                {{ $RegistroPremio->created_at }} <br>
                            </div>
                            <div class="col-2">
                                <button wire:click="getRegistro({{ $RegistroPremio->id }})" class="btn btn-primary get_registro_btn">
                                    Ver mas </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="card-body">
                {{ $RegistroPremios->links() }}
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

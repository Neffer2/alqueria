<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Factura;

class FacturasComponent extends Component
{
    // Models
    public $num_factura, $nombre, $cedula, $email, $fecha_inicio;

    public function render()
    {
        $filters_user = [];
        $filters_factura = [];

        if ($this->num_factura) {
            $filters_factura[] = ['num_factura', 'like', '%' . $this->num_factura . '%'];
        }

        if ($this->nombre) {
            $filters_user[] = ['nombre', 'like', '%' . $this->nombre . '%'];
        }

        if ($this->cedula) {
            $filters_user[] = ['cedula', 'like', '%' . $this->cedula . '%'];
        }

        if ($this->email) {
            $filters_user[] = ['correo', 'like', '%' . $this->email . '%'];
        }

        // Filtro por fecha
        if (!empty($this->fecha_inicio)) {
            $filters_factura[] = ['created_at', '>=', date('Y-m-d', strtotime($this->fecha_inicio))];
        }

        $RegistroFacturas = Factura::whereHas('user', function ($query) use ($filters_user) {
            $query->where($filters_user);
        })->where($filters_factura)->orderBy('id', 'desc')->paginate(10);

        return view('livewire.facturas-component', compact('RegistroFacturas'));
    }

    // public function getRegistro($registro_id)
    // {
    //     $this->RegistroServicio = RegistroServicio::find($registro_id);
    // }
}

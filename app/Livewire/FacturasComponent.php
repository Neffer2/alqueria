<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Factura;
use App\Models\RegistroPremio;

class FacturasComponent extends Component
{
    // Models
    public $num_factura, $nombre, $cedula, $email, $fecha_inicio, $observaciones;

    // Useful var
    public $RegistroFactura;

    public function render()
    {
        $filters_user = [];
        $filters_factura = [];

        $filters_factura[] = ['id_estado', 2];

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

    public function getRegistro($registro_id)
    {
        $this->RegistroFactura = Factura::find($registro_id);
    } 

    public function validacionRegistro($status){
        if ($status) {    
            $this->validate([
                'num_factura' => 'required|string|max:255|unique:facturas,num_factura',
                'observaciones' => 'nullable|string|max:1000',
            ]); 

            $this->RegistroFactura->id_estado = 1;

            $registroPremio = RegistroPremio::create([
                'id_user' => $this->RegistroFactura->id_user,
                'id_factura' => $this->RegistroFactura->id
            ]);
        }
        else {
            $this->validate([
                'num_factura' => 'nullable|string|max:255|unique:facturas,num_factura',
                'observaciones' => 'required|string|max:1000',
            ]); 

            $this->RegistroFactura->id_estado = 3;
        }
        
        $this->RegistroFactura->num_factura = $this->num_factura;
        $this->RegistroFactura->observaciones = $this->observaciones;
        $this->RegistroFactura->save();
        $this->resetFields();
    
        if ($status) {
            return redirect()->back()->with('success', 'Factura aprobada validada exitosamente.');
        } else {
            return redirect()->back()->with('success', 'Factura rechazada validada exitosamente.');
        }
    }

    public function resetFields()
    {
        $this->num_factura = '';
        $this->nombre = '';
        $this->cedula = '';
        $this->email = '';
        $this->observaciones = '';
        $this->RegistroFactura = null;
    }
}

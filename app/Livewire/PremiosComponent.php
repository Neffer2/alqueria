<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Factura;
use App\Models\RegistroPremio;

class PremiosComponent extends Component
{
    // Models
    public $num_factura, $nombre, $cedula, $email, $num_premio;

    // Useful var
    public $RegistroPremio;

    public function render()
    {
        $filters_user = [];
        $filters_factura = [];

        // if ($this->num_factura) {
        //     $filters_factura[] = ['num_factura', 'like', '%' . $this->num_factura . '%'];
        // }

        // if ($this->nombre) {
        //     $filters_user[] = ['nombre', 'like', '%' . $this->nombre . '%'];
        // }

        // if ($this->cedula) {
        //     $filters_user[] = ['cedula', 'like', '%' . $this->cedula . '%'];
        // }

        // if ($this->email) {
        //     $filters_user[] = ['correo', 'like', '%' . $this->email . '%'];
        // }

        // $RegistroPremios = RegistroPremio::whereHas('user', function ($query) use ($filters_user) {
        //     $query->where($filters_user);
        // })->orWhereHas('factura', function ($query) use ($filters_factura) {
        //     $query->where($filters_factura);
        // })->where('id_estado', 2)->orderBy('id', 'desc')->paginate(10); 

        $RegistroPremios = RegistroPremio::where('id_estado', 2)->orderBy('id', 'desc')->paginate(10); 
        
        return view('livewire.premios-component', compact('RegistroPremios'));
    }

    public function getRegistro($registro_id)
    {
        $this->RegistroPremio = RegistroPremio::find($registro_id);
    } 

    public function validacionRegistro($status){
        $this->validate([
            'num_premio' => 'required|string|max:255|unique:registro_premios,num_premio'
        ]); 

        $this->RegistroPremio->id_estado = 1; // Aprobado
        $this->RegistroPremio->num_premio = $this->num_premio;
        $this->RegistroPremio->save();

        return redirect()->route('premios')->with('success', 'Registro de premio validado exitosamente.');
    } 
}
 
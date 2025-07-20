<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroPremio extends Model
{
    use HasFactory;
    protected $table = 'registro_premios';
    protected $fillable = [
        'id_user',
        'id_factura',
        'id_estado'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function factura()
    {
        return $this->belongsTo(Factura::class, 'id_factura');
    }
}

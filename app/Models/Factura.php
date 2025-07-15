<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    protected $table = 'facturas';

    protected $fillable = [
        'id_user',
        'num_factura',
        'foto_factura',
        'foto_producto',
        'id_estado'
    ];
}

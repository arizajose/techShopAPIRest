<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $table = "detalleventas";

    // protected $fillable = [];

    // public $timestamps = false;

    //Relaciones con otros Model
    public function venta()
    {
        return $this->belongsTo(DetalleVenta::class);
    }
}

<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model{
    protected $table = "ventas";
    protected $primaryKey = 'venta_id';
    protected $casts = ['venta_id' => 'string'];
    // protected $fillable = [];

    // public $timestamps = false;

    //Relaciones con otros Model
    public function detalleVenta(){
      return $this->hasMany(DetalleVenta::class);
    }
}

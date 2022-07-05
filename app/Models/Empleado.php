<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model{
    protected $table = "empleados";
    protected $primaryKey = 'empleado_id';
    protected $casts = ['empleado_id' => 'string'];

    // protected $fillable = [];

    // public $timestamps = false;
}

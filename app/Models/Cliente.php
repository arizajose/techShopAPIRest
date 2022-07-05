<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model{
    protected $table = "clientes";
    protected $primaryKey = 'cliente_id';
    protected $casts = ['cliente_id' => 'string'];

    // protected $fillable = [];

    // public $timestamps = false;
}

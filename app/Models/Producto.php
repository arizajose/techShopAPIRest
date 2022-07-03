<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model{
    protected $table = "productos";
    protected $primaryKey = 'producto_id';
    protected $casts = ['producto_id' => 'string'];
    // protected $fillable = [];

    // public $timestamps = false;
}

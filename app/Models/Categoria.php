<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'tipo',
        'id_empresa',
        'disabled'
    ];
    public function empresa() {
        return $this->belongsTo('App\Models\Empresa');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    protected const Estados = ["creacion", "progreso", "fin"];
    public $timestamps = false;

    public function getEstado()
    {
        return $this::Estados[$this->estado];
    }

    public static function getEstados()
    {
        return Incidencia::Estados;
    }

    protected $fillable = [
        'nombre',
        'apellidos',
        'dni',
        'telefono',
        'email',
        'adjuntar_imagen',
        'descripcion',
        'id_cat',
        'ubicacion',
        'estado',
        'fecha_creacion',
        'fecha_resolucion'
    ];

    public function categoria() {
        return $this->belongsTo('App\Models\Categoria');
    }
}

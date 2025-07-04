<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Programa
 * 
 * Representa los programas de formación del SENA.
 * Cada programa pertenece a un área específica y puede tener múltiples fichas.
 * 
 * @property int $id_programa Identificador único del programa
 * @property string $nombre_programa Nombre del programa de formación
 * @property bool $estado Estado activo/inactivo del programa
 * @property int $area_id ID del área a la que pertenece
 * @property \Carbon\Carbon $fecha_creacion Fecha de creación del programa
 * @property \Carbon\Carbon $fecha_modificacion Fecha de última modificación
 */
class Programa extends Model
{
    /**
     * Clave primaria personalizada
     * 
     * @var string
     */
    protected $primaryKey = 'id_programa';

    /**
     * Deshabilitar timestamps automáticos
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * Los atributos que son asignables masivamente.
     * 
     * @var array
     */
    protected $fillable = [
        'nombre_programa',
        'estado',
        'area_id',
        'fecha_creacion',
        'fecha_modificacion',
    ];

    /**
     * Relación con Area
     * Un programa pertenece a un área específica
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id', 'id_area');
    }

    /**
     * Relación con Fichas
     * Un programa puede tener múltiples fichas de formación
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fichas()
    {
        return $this->hasMany(Ficha::class, 'programa_id', 'id_programa');
    }

    public function modulos()
    {
        return $this->hasMany(Modulo::class, 'programa_id', 'id_programa');
    }
}

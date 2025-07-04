<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Area
 * 
 * Representa las áreas de formación del SENA.
 * Cada área pertenece a una sede específica y puede tener múltiples programas.
 * 
 * @property int $id_area Identificador único del área
 * @property string $nombre_area Nombre del área de formación
 * @property bool $estado Estado activo/inactivo del área
 * @property \Carbon\Carbon $fecha_creacion Fecha de creación del área
 * @property \Carbon\Carbon $fecha_modificacion Fecha de última modificación
 * @property int $sede_id ID de la sede a la que pertenece
 */
class Area extends Model
{
    /**
     * Clave primaria personalizada
     * 
     * @var string
     */
    protected $primaryKey = 'id_area';

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
        'nombre_area',
        'estado',
        'fecha_creacion',
        'fecha_modificacion',
        'sede_id',
    ];

    /**
     * Relación con Sede
     * Un área pertenece a una sede específica
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sede()
    {
        return $this->belongsTo(Sede::class, 'sede_id', 'id_sede');
    }

    /**
     * Relación con Programas
     * Un área puede tener múltiples programas de formación
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function programas()
    {
        return $this->hasMany(Programa::class, 'area_id', 'id_area');
    }
}

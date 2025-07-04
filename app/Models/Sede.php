<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Sede
 * 
 * Representa las sedes del SENA donde se imparten programas de formación.
 * Cada sede pertenece a un centro específico y puede tener múltiples áreas.
 * 
 * @property int $id_sede Identificador único de la sede
 * @property string $nombre_sede Nombre de la sede
 * @property string $direccion_sede Dirección física de la sede
 * @property bool $estado Estado activo/inactivo de la sede
 * @property int $centro_id ID del centro al que pertenece
 * @property \Carbon\Carbon $fecha_creacion Fecha de creación de la sede
 * @property \Carbon\Carbon $fecha_modificacion Fecha de última modificación
 */
class Sede extends Model
{
    /**
     * Clave primaria personalizada
     * 
     * @var string
     */
    protected $primaryKey = 'id_sede';

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
        'nombre_sede',
        'direccion_sede',
        'estado',
        'centro_id',
        'fecha_creacion',
        'fecha_modificacion',
    ];

    /**
     * Relación con Centro
     * Una sede pertenece a un centro específico
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function centro()
    {
        return $this->belongsTo(Centro::class, 'centro_id', 'id_centro');
    }

    /**
     * Relación con Areas
     * Una sede puede tener múltiples áreas de formación
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function areas()
    {
        return $this->hasMany(Area::class, 'sede_id', 'id_sede');
    }
}

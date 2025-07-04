<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Centro
 * 
 * Representa los centros del SENA en el sistema de bodega.
 * Cada centro pertenece a un municipio y puede tener múltiples sedes.
 * Los centros son la unidad organizacional principal del SENA.
 * 
 * @property int $id_centro Identificador único del centro
 * @property string $nombre_centro Nombre del centro del SENA
 * @property bool $estado Estado activo/inactivo del centro
 * @property \Carbon\Carbon $fecha_creacion Fecha de creación del registro
 * @property \Carbon\Carbon $fecha_modificacion Fecha de última modificación
 * @property int $municipio_id ID del municipio al que pertenece
 */
class Centro extends Model
{
    /**
     * Clave primaria personalizada
     * 
     * @var string
     */
    protected $primaryKey = 'id_centro';

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
        'nombre_centro',
        'estado',
        'fecha_creacion',
        'fecha_modificacion',
        'municipio_id',
    ];

    /**
     * Relación con Municipio
     * Un centro pertenece a un municipio
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'municipio_id', 'id_municipio');
    }

    /**
     * Relación con Sedes
     * Un centro puede tener múltiples sedes
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sedes()
    {
        return $this->hasMany(Sede::class, 'centro_id', 'id_centro');
    }
} 
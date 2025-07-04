<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo TipoMovimiento
 * 
 * Representa los tipos de movimientos de inventario (entradas y salidas).
 * Cada tipo define la naturaleza del movimiento en el inventario.
 * 
 * @property int $id_tipo_movimiento Identificador único del tipo de movimiento
 * @property string $nombre_tipo_movimiento Nombre del tipo de movimiento
 * @property bool $estado Estado activo/inactivo del tipo
 * @property \Carbon\Carbon $fecha_creacion Fecha de creación del tipo
 * @property \Carbon\Carbon $fecha_modificacion Fecha de última modificación
 */
class TipoMovimiento extends Model
{
    /**
     * Clave primaria personalizada
     * 
     * @var string
     */
    protected $primaryKey = 'id_tipo_movimiento';

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
        'nombre_tipo_movimiento',
        'estado',
        'fecha_creacion',
        'fecha_modificacion',
    ];

    /**
     * Relación con Movimientos
     * Un tipo de movimiento puede tener múltiples movimientos
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function movimientos()
    {
        return $this->hasMany(Movimiento::class, 'tipo_movimiento_id', 'id_tipo_movimiento');
    }
}

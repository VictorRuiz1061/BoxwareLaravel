<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Movimiento
 * 
 * Representa los movimientos de inventario (entradas y salidas).
 * Cada movimiento registra la cantidad de material que entra o sale
 * del inventario, con su tipo correspondiente.
 * 
 * @property int $id_movimiento Identificador único del movimiento
 * @property bool $estado Estado activo/inactivo del movimiento
 * @property int $cantidad Cantidad de material movida
 * @property \Carbon\Carbon $fecha_creacion Fecha de creación del movimiento
 * @property \Carbon\Carbon $fecha_modificacion Fecha de última modificación
 * @property int $tipo_movimiento_id ID del tipo de movimiento
 * @property int $material_id ID del material movido
 */
class Movimiento extends Model
{
    /**
     * Clave primaria personalizada
     * 
     * @var string
     */
    protected $primaryKey = 'id_movimiento';

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
        'estado',
        'cantidad',
        'fecha_creacion',
        'fecha_modificacion',
        'tipo_movimiento_id',
        'material_id',
    ];

    /**
     * Relación con TipoMovimiento
     * Un movimiento pertenece a un tipo específico
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipoMovimiento()
    {
        return $this->belongsTo(TipoMovimiento::class, 'tipo_movimiento_id', 'id_tipo_movimiento');
    }

    /**
     * Relación con Material
     * Un movimiento está asociado a un material específico
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id', 'id_material');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'id_usuario');
    }

    public function sitio()
    {
        return $this->belongsTo(Sitio::class, 'sitio_id', 'id_sitio');
    }
}

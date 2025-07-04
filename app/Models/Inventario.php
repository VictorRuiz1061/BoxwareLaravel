<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Inventario
 * 
 * Representa el inventario de materiales en sitios específicos.
 * Controla el stock disponible de cada material en cada ubicación.
 * 
 * @property int $id_inventario Identificador único del registro de inventario
 * @property int $stock Cantidad disponible en stock
 * @property string $placa_sena Placa o código SENA del elemento
 * @property string $descripcion Descripción del elemento en inventario
 * @property int $sitio_id ID del sitio donde se encuentra
 */
class Inventario extends Model
{
    /**
     * Clave primaria personalizada
     * 
     * @var string
     */
    protected $primaryKey = 'id_inventario';

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
        'stock',
        'placa_sena',
        'descripcion',
        'sitio_id',
    ];

    /**
     * Relación con Sitio
     * Un registro de inventario pertenece a un sitio específico
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sitio()
    {
        return $this->belongsTo(Sitio::class, 'sitio_id', 'id_sitio');
    }
}

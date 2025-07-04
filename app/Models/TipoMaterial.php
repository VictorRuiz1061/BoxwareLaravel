<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo TipoMaterial
 * 
 * Representa los tipos de materiales que categorizan los elementos del inventario.
 * Cada tipo define características específicas para un grupo de materiales.
 * 
 * @property int $id_tipo_material Identificador único del tipo de material
 * @property string $nombre_tipo_material Nombre del tipo de material
 * @property bool $estado Estado activo/inactivo del tipo
 * @property \Carbon\Carbon $fecha_creacion Fecha de creación del tipo
 * @property \Carbon\Carbon $fecha_modificacion Fecha de última modificación
 */
class TipoMaterial extends Model
{
    /**
     * Clave primaria personalizada
     * 
     * @var string
     */
    protected $primaryKey = 'id_tipo_material';

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
        'nombre_tipo_material',
        'estado',
        'fecha_creacion',
        'fecha_modificacion',
    ];

    /**
     * Relación con Materiales
     * Un tipo de material puede tener múltiples materiales
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function materiales()
    {
        return $this->hasMany(Material::class, 'tipo_material_id', 'id_tipo_material');
    }
}

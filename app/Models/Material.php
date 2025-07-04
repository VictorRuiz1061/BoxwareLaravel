<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Material
 * 
 * Representa los materiales del inventario del SENA.
 * Cada material tiene características específicas, puede ser perecedero
 * y pertenece a una categoría y tipo específico.
 * 
 * @property int $id_material Identificador único del material
 * @property string $codigo_sena Código interno del SENA para el material
 * @property string $nombre_material Nombre del material
 * @property string $descripcion_material Descripción detallada del material
 * @property string $unidad_medida Unidad de medida del material
 * @property bool $producto_peresedero Indica si el material es perecedero
 * @property bool $estado Estado activo/inactivo del material
 * @property \Carbon\Carbon $fecha_vencimiento Fecha de vencimiento del material
 * @property string|null $imagen Ruta de la imagen del material
 * @property \Carbon\Carbon $fecha_creacion Fecha de creación del registro
 * @property \Carbon\Carbon $fecha_modificacion Fecha de última modificación
 * @property int $categoria_id ID de la categoría del material
 * @property int $tipo_material_id ID del tipo de material
 */
class Material extends Model
{
    /**
     * Clave primaria personalizada
     * 
     * @var string
     */
    protected $primaryKey = 'id_material';

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
        'codigo_sena',
        'nombre_material',
        'descripcion_material',
        'unidad_medida',
        'producto_peresedero',
        'estado',
        'fecha_vencimiento',
        'imagen',
        'fecha_creacion',
        'fecha_modificacion',
        'categoria_id',
        'tipo_material_id',
    ];

    /**
     * Relación con CategoriaElemento
     * Un material pertenece a una categoría
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categoria()
    {
        return $this->belongsTo(CategoriaElemento::class, 'categoria_id', 'id_categoria_elemento');
    }

    /**
     * Relación con TipoMaterial
     * Un material pertenece a un tipo específico
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipoMaterial()
    {
        return $this->belongsTo(TipoMaterial::class, 'tipo_material_id', 'id_tipo_material');
    }

    /**
     * Relación con Movimientos
     * Un material puede tener múltiples movimientos
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function movimientos()
    {
        return $this->hasMany(Movimiento::class, 'material_id', 'id_material');
    }
}

# 📚 Documentación de Rutas - Sistema de Bodega SENA

## 📋 Índice
- [Rutas API](#rutas-api)
- [Rutas Web](#rutas-web)
- [Comandos de Consola](#comandos-de-consola)
- [Autenticación y Autorización](#autenticación-y-autorización)

---

## 🚀 Rutas API

### 🔓 Rutas Públicas (Sin Autenticación)

| Método | Ruta | Controlador | Descripción |
|--------|------|-------------|-------------|
| `POST` | `/api/login` | `AuthController@login` | Inicio de sesión de usuario |
| `POST` | `/api/register` | `AuthController@register` | Registro de nuevos usuarios |

### 🔒 Rutas Protegidas (Con Autenticación)

#### 👤 Gestión de Sesión
| Método | Ruta | Controlador | Descripción |
|--------|------|-------------|-------------|
| `GET` | `/api/user` | `AuthController@user` | Obtener información del usuario actual |
| `POST` | `/api/logout` | `AuthController@logout` | Cerrar sesión del usuario |

#### 📖 Catálogos (Solo Lectura)
| Método | Ruta | Controlador | Descripción |
|--------|------|-------------|-------------|
| `GET` | `/api/categorias-elementos` | `CategoriaElementoController@index` | Listar categorías de elementos |
| `GET` | `/api/municipios` | `MunicipioController@index` | Listar municipios |
| `GET` | `/api/centros` | `CentroController@index` | Listar centros del SENA |
| `GET` | `/api/sedes` | `SedeController@index` | Listar sedes |
| `GET` | `/api/areas` | `AreaController@index` | Listar áreas de formación |
| `GET` | `/api/programas` | `ProgramaController@index` | Listar programas de formación |
| `GET` | `/api/modulos` | `ModuloController@index` | Listar módulos del sistema |
| `GET` | `/api/tipo-materiales` | `TipoMaterialController@index` | Listar tipos de materiales |
| `GET` | `/api/caracteristicas` | `CaracteristicaController@index` | Listar características |
| `GET` | `/api/tipos-sitio` | `TipoSitioController@index` | Listar tipos de sitios |
| `GET` | `/api/tipos-movimiento` | `TipoMovimientoController@index` | Listar tipos de movimientos |

#### 📦 Gestión de Inventario (CRUD Completo)
| Método | Ruta | Controlador | Descripción |
|--------|------|-------------|-------------|
| `GET` | `/api/materiales` | `MaterialController@index` | Listar materiales |
| `POST` | `/api/materiales` | `MaterialController@store` | Crear material |
| `GET` | `/api/materiales/{id}` | `MaterialController@show` | Ver material específico |
| `PUT` | `/api/materiales/{id}` | `MaterialController@update` | Actualizar material |
| `DELETE` | `/api/materiales/{id}` | `MaterialController@destroy` | Eliminar material |

| Método | Ruta | Controlador | Descripción |
|--------|------|-------------|-------------|
| `GET` | `/api/sitios` | `SitioController@index` | Listar sitios |
| `POST` | `/api/sitios` | `SitioController@store` | Crear sitio |
| `GET` | `/api/sitios/{id}` | `SitioController@show` | Ver sitio específico |
| `PUT` | `/api/sitios/{id}` | `SitioController@update` | Actualizar sitio |
| `DELETE` | `/api/sitios/{id}` | `SitioController@destroy` | Eliminar sitio |

| Método | Ruta | Controlador | Descripción |
|--------|------|-------------|-------------|
| `GET` | `/api/inventarios` | `InventarioController@index` | Listar inventario |
| `POST` | `/api/inventarios` | `InventarioController@store` | Crear registro de inventario |
| `GET` | `/api/inventarios/{id}` | `InventarioController@show` | Ver inventario específico |
| `PUT` | `/api/inventarios/{id}` | `InventarioController@update` | Actualizar inventario |
| `DELETE` | `/api/inventarios/{id}` | `InventarioController@destroy` | Eliminar inventario |

| Método | Ruta | Controlador | Descripción |
|--------|------|-------------|-------------|
| `GET` | `/api/movimientos` | `MovimientoController@index` | Listar movimientos |
| `POST` | `/api/movimientos` | `MovimientoController@store` | Crear movimiento |
| `GET` | `/api/movimientos/{id}` | `MovimientoController@show` | Ver movimiento específico |
| `PUT` | `/api/movimientos/{id}` | `MovimientoController@update` | Actualizar movimiento |
| `DELETE` | `/api/movimientos/{id}` | `MovimientoController@destroy` | Eliminar movimiento |

| Método | Ruta | Controlador | Descripción |
|--------|------|-------------|-------------|
| `GET` | `/api/fichas` | `FichaController@index` | Listar fichas |
| `POST` | `/api/fichas` | `FichaController@store` | Crear ficha |
| `GET` | `/api/fichas/{id}` | `FichaController@show` | Ver ficha específica |
| `PUT` | `/api/fichas/{id}` | `FichaController@update` | Actualizar ficha |
| `DELETE` | `/api/fichas/{id}` | `FichaController@destroy` | Eliminar ficha |

### 👑 Rutas de Administrador (Middleware IsAdmin)

#### 👥 Gestión de Usuarios y Roles
| Método | Ruta | Controlador | Descripción |
|--------|------|-------------|-------------|
| `GET` | `/api/usuarios` | `UsuarioController@index` | Listar usuarios |
| `POST` | `/api/usuarios` | `UsuarioController@store` | Crear usuario |
| `GET` | `/api/usuarios/{id}` | `UsuarioController@show` | Ver usuario específico |
| `PUT` | `/api/usuarios/{id}` | `UsuarioController@update` | Actualizar usuario |
| `DELETE` | `/api/usuarios/{id}` | `UsuarioController@destroy` | Eliminar usuario |

| Método | Ruta | Controlador | Descripción |
|--------|------|-------------|-------------|
| `GET` | `/api/roles` | `RolController@index` | Listar roles |
| `POST` | `/api/roles` | `RolController@store` | Crear rol |
| `GET` | `/api/roles/{id}` | `RolController@show` | Ver rol específico |
| `PUT` | `/api/roles/{id}` | `RolController@update` | Actualizar rol |
| `DELETE` | `/api/roles/{id}` | `RolController@destroy` | Eliminar rol |

#### 🔐 Gestión de Permisos
| Método | Ruta | Controlador | Descripción |
|--------|------|-------------|-------------|
| `GET` | `/api/permisos` | `PermisoController@index` | Listar permisos |
| `POST` | `/api/permisos` | `PermisoController@store` | Crear permiso |
| `GET` | `/api/permisos/{id}` | `PermisoController@show` | Ver permiso específico |
| `PUT` | `/api/permisos/{id}` | `PermisoController@update` | Actualizar permiso |
| `DELETE` | `/api/permisos/{id}` | `PermisoController@destroy` | Eliminar permiso |

#### 📚 Gestión Completa de Catálogos
Los administradores tienen acceso completo a todos los catálogos (CRUD completo):

- `/api/categorias-elementos` (excepto index)
- `/api/municipios` (excepto index)
- `/api/centros` (excepto index)
- `/api/sedes` (excepto index)
- `/api/areas` (excepto index)
- `/api/programas` (excepto index)
- `/api/modulos` (excepto index)
- `/api/tipo-materiales` (excepto index)
- `/api/caracteristicas` (excepto index)
- `/api/tipos-sitio` (excepto index)
- `/api/tipos-movimiento` (excepto index)

---

## 🌐 Rutas Web

### 🔓 Rutas Públicas
| Método | Ruta | Descripción |
|--------|------|-------------|
| `GET` | `/` | Página principal (redirige a login) |
| `GET` | `/login` | Página de inicio de sesión |

### 🔒 Rutas Protegidas
| Método | Ruta | Descripción | Middleware |
|--------|------|-------------|------------|
| `GET` | `/admin` | Panel de administración | `auth` |
| `GET` | `/welcome` | Página de bienvenida | `auth` |

---

## ⚡ Comandos de Consola

### 🔧 Comandos de Mantenimiento
| Comando | Descripción |
|---------|-------------|
| `php artisan inspire` | Mostrar frase inspiradora |
| `php artisan sistema:limpiar` | Limpiar y optimizar el sistema |
| `php artisan sistema:estado` | Verificar estado del sistema |
| `php artisan sistema:seed-demo` | Generar datos de demostración |

---

## 🔐 Autenticación y Autorización

### Middleware Utilizados

#### `IsUserAuth`
- **Propósito**: Verificar que el usuario esté autenticado
- **Aplicación**: Todas las rutas protegidas de la API
- **Comportamiento**: Redirige al login si no está autenticado

#### `IsAdmin`
- **Propósito**: Verificar que el usuario tenga rol de administrador
- **Aplicación**: Rutas exclusivas de administración
- **Comportamiento**: Deniega acceso si no es administrador

#### `throttle`
- **Propósito**: Limitar intentos de acceso
- **Aplicación**: 
  - Login: 5 intentos por minuto
  - Registro: 3 intentos por minuto

### Flujo de Autenticación

1. **Login**: `POST /api/login`
   - Valida credenciales
   - Crea sesión
   - Retorna información del usuario

2. **Verificación**: `GET /api/user`
   - Verifica sesión activa
   - Retorna datos del usuario

3. **Logout**: `POST /api/logout`
   - Invalida sesión
   - Limpia tokens

---

## 📝 Notas Importantes

### Códigos de Respuesta HTTP
- `200`: Operación exitosa
- `201`: Recurso creado exitosamente
- `204`: Operación exitosa sin contenido
- `401`: No autenticado
- `403`: No autorizado
- `404`: Recurso no encontrado
- `422`: Error de validación
- `500`: Error interno del servidor

### Formato de Respuestas
Todas las respuestas API están en formato JSON con la siguiente estructura:

```json
{
    "success": true,
    "message": "Operación exitosa",
    "data": {
        // Datos del recurso
    }
}
```

### Validaciones
- Todos los endpoints de creación y actualización incluyen validaciones
- Los errores de validación retornan código 422 con detalles
- Las validaciones están definidas en los controladores y Request classes

---

## 🚀 Uso de las Rutas

### Ejemplo de Login
```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email": "admin@sena.edu.co", "password": "password"}'
```

### Ejemplo de Obtener Materiales
```bash
curl -X GET http://localhost:8000/api/materiales \
  -H "Authorization: Bearer {token}" \
  -H "Accept: application/json"
```

### Ejemplo de Crear Material
```bash
curl -X POST http://localhost:8000/api/materiales \
  -H "Authorization: Bearer {token}" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "codigo_sena": "MAT001",
    "nombre_material": "Laptop",
    "descripcion_material": "Laptop para prácticas",
    "unidad_medida": "Unidad",
    "producto_peresedero": false,
    "estado": true,
    "fecha_vencimiento": "2025-12-31",
    "categoria_id": 1,
    "tipo_material_id": 1
  }'
``` 
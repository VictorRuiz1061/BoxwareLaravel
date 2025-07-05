# 🚀 BodegaSena API - Guía Completa para Postman

## 📋 Configuración Base

- **Base URL**: `http://localhost:8000`
- **Content-Type**: `application/json`
- **Authorization**: `Bearer {{access_token}}`

## 🔐 Autenticación

### 1. Login
```http
POST /api/login
Content-Type: application/json

{
  "email": "admin@sena.edu.co",
  "password": "123456"
}
```

### 2. Registro
```http
POST /api/register
Content-Type: application/json

{
  "nombre": "Juan",
  "apellido": "Pérez",
  "email": "juan.perez@sena.edu.co",
  "password": "123456",
  "password_confirmation": "123456",
  "telefono": "3001234567",
  "direccion": "Calle 123 #45-67",
  "fecha_nacimiento": "1990-01-15",
  "rol_id": 2
}
```

### 3. Obtener Usuario Actual
```http
GET /api/user
Authorization: Bearer {{access_token}}
```

### 4. Cerrar Sesión
```http
POST /api/logout
Authorization: Bearer {{access_token}}
```

## 👥 Usuarios

### Listar Usuarios
```http
GET /api/usuarios
Authorization: Bearer {{access_token}}
```

### Crear Usuario
```http
POST /api/usuarios
Authorization: Bearer {{access_token}}
Content-Type: application/json

{
  "nombre": "María",
  "apellido": "García",
  "email": "maria.garcia@sena.edu.co",
  "password": "123456",
  "password_confirmation": "123456",
  "telefono": "3009876543",
  "direccion": "Carrera 45 #12-34",
  "fecha_nacimiento": "1985-05-20",
  "estado": true,
  "rol_id": 2
}
```

### Obtener Usuario
```http
GET /api/usuarios/{id}
Authorization: Bearer {{access_token}}
```

### Actualizar Usuario
```http
PUT /api/usuarios/{id}
Authorization: Bearer {{access_token}}
Content-Type: application/json

{
  "nombre": "María Actualizada",
  "apellido": "García López",
  "telefono": "3009876543",
  "direccion": "Nueva Dirección 123",
  "estado": true
}
```

### Eliminar Usuario
```http
DELETE /api/usuarios/{id}
Authorization: Bearer {{access_token}}
```

## 🎭 Roles

### Listar Roles
```http
GET /api/roles
Authorization: Bearer {{access_token}}
```

### Crear Rol
```http
POST /api/roles
Authorization: Bearer {{access_token}}
Content-Type: application/json

{
  "nombre_rol": "Instructor",
  "estado": true,
  "fecha_creacion": "2024-01-15",
  "fecha_modificacion": "2024-01-15"
}
```

### Obtener Rol
```http
GET /api/roles/{id}
Authorization: Bearer {{access_token}}
```

### Actualizar Rol
```http
PUT /api/roles/{id}
Authorization: Bearer {{access_token}}
Content-Type: application/json

{
  "nombre_rol": "Instructor Senior",
  "estado": true
}
```

### Eliminar Rol
```http
DELETE /api/roles/{id}
Authorization: Bearer {{access_token}}
```

## 📦 Materiales

### Listar Materiales
```http
GET /api/materiales
Authorization: Bearer {{access_token}}
```

### Crear Material
```http
POST /api/materiales
Authorization: Bearer {{access_token}}
Content-Type: application/json

{
  "codigo_sena": "MAT001",
  "nombre_material": "Computador Portátil",
  "descripcion_material": "Computador portátil para uso académico",
  "unidad_medida": "Unidad",
  "producto_peresedero": false,
  "estado": true,
  "fecha_vencimiento": "2025-12-31",
  "imagen": "laptop.jpg",
  "fecha_creacion": "2024-01-15",
  "fecha_modificacion": "2024-01-15",
  "categoria_id": 1,
  "tipo_material_id": 1
}
```

### Obtener Material
```http
GET /api/materiales/{id}
Authorization: Bearer {{access_token}}
```

### Actualizar Material
```http
PUT /api/materiales/{id}
Authorization: Bearer {{access_token}}
Content-Type: application/json

{
  "nombre_material": "Computador Portátil Actualizado",
  "descripcion_material": "Descripción actualizada",
  "estado": true
}
```

### Eliminar Material
```http
DELETE /api/materiales/{id}
Authorization: Bearer {{access_token}}
```

## 🏢 Áreas

### Listar Áreas
```http
GET /api/areas
Authorization: Bearer {{access_token}}
```

### Crear Área
```http
POST /api/areas
Authorization: Bearer {{access_token}}
Content-Type: application/json

{
  "nombre_area": "Sistemas",
  "estado": true,
  "fecha_creacion": "2024-01-15",
  "fecha_modificacion": "2024-01-15",
  "sede_id": 1
}
```

### Obtener Área
```http
GET /api/areas/{id}
Authorization: Bearer {{access_token}}
```

### Actualizar Área
```http
PUT /api/areas/{id}
Authorization: Bearer {{access_token}}
Content-Type: application/json

{
  "nombre_area": "Sistemas y Telecomunicaciones",
  "estado": true
}
```

### Eliminar Área
```http
DELETE /api/areas/{id}
Authorization: Bearer {{access_token}}
```

## 🔧 Módulos

### Listar Módulos
```http
GET /api/modulos
Authorization: Bearer {{access_token}}
```

### Crear Módulo
```http
POST /api/modulos
Authorization: Bearer {{access_token}}
Content-Type: application/json

{
  "rutas": "/inventario",
  "descripcion_ruta": "Gestión de inventario",
  "mensaje_cambio": "Acceso al módulo de inventario",
  "imagen": "inventario.png",
  "estado": true,
  "es_submenu": false,
  "modulo_padre_id": null,
  "fecha_creacion": "2024-01-15",
  "fecha_accion": "2024-01-15"
}
```

### Obtener Módulo
```http
GET /api/modulos/{id}
Authorization: Bearer {{access_token}}
```

### Actualizar Módulo
```http
PUT /api/modulos/{id}
Authorization: Bearer {{access_token}}
Content-Type: application/json

{
  "descripcion_ruta": "Gestión completa de inventario",
  "estado": true
}
```

### Eliminar Módulo
```http
DELETE /api/modulos/{id}
Authorization: Bearer {{access_token}}
```

## 🛡️ Permisos

### Listar Permisos
```http
GET /api/permisos
Authorization: Bearer {{access_token}}
```

### Crear Permiso
```http
POST /api/permisos
Authorization: Bearer {{access_token}}
Content-Type: application/json

{
  "nombre": "Gestión de Inventario",
  "estado": true,
  "puede_ver": true,
  "puede_crear": true,
  "puede_editar": true,
  "puede_eliminar": false,
  "modulo_id": 1,
  "rol_id": 2,
  "fecha_creacion": "2024-01-15"
}
```

### Obtener Permiso
```http
GET /api/permisos/{id}
Authorization: Bearer {{access_token}}
```

### Actualizar Permiso
```http
PUT /api/permisos/{id}
Authorization: Bearer {{access_token}}
Content-Type: application/json

{
  "puede_eliminar": true,
  "estado": true
}
```

### Eliminar Permiso
```http
DELETE /api/permisos/{id}
Authorization: Bearer {{access_token}}
```

## 📊 Inventario

### Listar Inventario
```http
GET /api/inventario
Authorization: Bearer {{access_token}}
```

### Crear Registro de Inventario
```http
POST /api/inventario
Authorization: Bearer {{access_token}}
Content-Type: application/json

{
  "stock": 50,
  "placa_sena": "SENA-001-2024",
  "descripcion": "Inventario inicial de computadores",
  "sitio_id": 1
}
```

### Obtener Registro de Inventario
```http
GET /api/inventario/{id}
Authorization: Bearer {{access_token}}
```

### Actualizar Inventario
```http
PUT /api/inventario/{id}
Authorization: Bearer {{access_token}}
Content-Type: application/json

{
  "stock": 45,
  "descripcion": "Stock actualizado después de movimiento"
}
```

### Eliminar Registro de Inventario
```http
DELETE /api/inventario/{id}
Authorization: Bearer {{access_token}}
```

## 🔄 Movimientos

### Listar Movimientos
```http
GET /api/movimientos
Authorization: Bearer {{access_token}}
```

### Crear Movimiento
```http
POST /api/movimientos
Authorization: Bearer {{access_token}}
Content-Type: application/json

{
  "estado": true,
  "cantidad": 5,
  "fecha_creacion": "2024-01-15",
  "fecha_modificacion": "2024-01-15",
  "tipo_movimiento_id": 1,
  "material_id": 1
}
```

### Obtener Movimiento
```http
GET /api/movimientos/{id}
Authorization: Bearer {{access_token}}
```

### Actualizar Movimiento
```http
PUT /api/movimientos/{id}
Authorization: Bearer {{access_token}}
Content-Type: application/json

{
  "cantidad": 10,
  "estado": true
}
```

### Eliminar Movimiento
```http
DELETE /api/movimientos/{id}
Authorization: Bearer {{access_token}}
```

## 🏭 Sitios

### Listar Sitios
```http
GET /api/sitios
Authorization: Bearer {{access_token}}
```

### Crear Sitio
```http
POST /api/sitios
Authorization: Bearer {{access_token}}
Content-Type: application/json

{
  "nombre_sitio": "Almacén Principal",
  "ubicacion": "Edificio A - Piso 1",
  "ficha_tecnica": "Especificaciones técnicas del almacén",
  "estado": true,
  "tipo_sitio_id": 1,
  "fecha_creacion": "2024-01-15",
  "fecha_modificacion": "2024-01-15"
}
```

### Obtener Sitio
```http
GET /api/sitios/{id}
Authorization: Bearer {{access_token}}
```

### Actualizar Sitio
```http
PUT /api/sitios/{id}
Authorization: Bearer {{access_token}}
Content-Type: application/json

{
  "nombre_sitio": "Almacén Principal Actualizado",
  "ubicacion": "Edificio A - Piso 2"
}
```

### Eliminar Sitio
```http
DELETE /api/sitios/{id}
Authorization: Bearer {{access_token}}
```

## 🏷️ Tipos de Material

### Listar Tipos de Material
```http
GET /api/tipos-material
Authorization: Bearer {{access_token}}
```

### Crear Tipo de Material
```http
POST /api/tipos-material
Authorization: Bearer {{access_token}}
Content-Type: application/json

{
  "nombre_tipo_material": "Equipos de Cómputo",
  "estado": true,
  "fecha_creacion": "2024-01-15",
  "fecha_modificacion": "2024-01-15"
}
```

### Obtener Tipo de Material
```http
GET /api/tipos-material/{id}
Authorization: Bearer {{access_token}}
```

### Actualizar Tipo de Material
```http
PUT /api/tipos-material/{id}
Authorization: Bearer {{access_token}}
Content-Type: application/json

{
  "nombre_tipo_material": "Equipos de Cómputo y Periféricos",
  "estado": true
}
```

### Eliminar Tipo de Material
```http
DELETE /api/tipos-material/{id}
Authorization: Bearer {{access_token}}
```

## 🔄 Tipos de Movimiento

### Listar Tipos de Movimiento
```http
GET /api/tipos-movimiento
Authorization: Bearer {{access_token}}
```

### Crear Tipo de Movimiento
```http
POST /api/tipos-movimiento
Authorization: Bearer {{access_token}}
Content-Type: application/json

{
  "nombre_tipo_movimiento": "Entrada",
  "estado": true,
  "fecha_creacion": "2024-01-15",
  "fecha_modificacion": "2024-01-15"
}
```

### Obtener Tipo de Movimiento
```http
GET /api/tipos-movimiento/{id}
Authorization: Bearer {{access_token}}
```

### Actualizar Tipo de Movimiento
```http
PUT /api/tipos-movimiento/{id}
Authorization: Bearer {{access_token}}
Content-Type: application/json

{
  "nombre_tipo_movimiento": "Entrada por Compra",
  "estado": true
}
```

### Eliminar Tipo de Movimiento
```http
DELETE /api/tipos-movimiento/{id}
Authorization: Bearer {{access_token}}
```

## 🏗️ Tipos de Sitio

### Listar Tipos de Sitio
```http
GET /api/tipos-sitio
Authorization: Bearer {{access_token}}
```

### Crear Tipo de Sitio
```http
POST /api/tipos-sitio
Authorization: Bearer {{access_token}}
Content-Type: application/json

{
  "nombre_tipo_sitio": "Almacén",
  "estado": true,
  "fecha_creacion": "2024-01-15",
  "fecha_modificacion": "2024-01-15"
}
```

### Obtener Tipo de Sitio
```http
GET /api/tipos-sitio/{id}
Authorization: Bearer {{access_token}}
```

### Actualizar Tipo de Sitio
```http
PUT /api/tipos-sitio/{id}
Authorization: Bearer {{access_token}}
Content-Type: application/json

{
  "nombre_tipo_sitio": "Almacén Central",
  "estado": true
}
```

### Eliminar Tipo de Sitio
```http
DELETE /api/tipos-sitio/{id}
Authorization: Bearer {{access_token}}
```

## 🏫 Sedes

### Listar Sedes
```http
GET /api/sedes
Authorization: Bearer {{access_token}}
```

### Crear Sede
```http
POST /api/sedes
Authorization: Bearer {{access_token}}
Content-Type: application/json

{
  "nombre_sede": "Sede Principal",
  "direccion": "Calle 123 #45-67",
  "telefono": "6012345678",
  "estado": true,
  "fecha_creacion": "2024-01-15",
  "fecha_modificacion": "2024-01-15",
  "centro_id": 1
}
```

### Obtener Sede
```http
GET /api/sedes/{id}
Authorization: Bearer {{access_token}}
```

### Actualizar Sede
```http
PUT /api/sedes/{id}
Authorization: Bearer {{access_token}}
Content-Type: application/json

{
  "nombre_sede": "Sede Principal Actualizada",
  "telefono": "6019876543"
}
```

### Eliminar Sede
```http
DELETE /api/sedes/{id}
Authorization: Bearer {{access_token}}
```

## 📚 Programas

### Listar Programas
```http
GET /api/programas
Authorization: Bearer {{access_token}}
```

### Crear Programa
```http
POST /api/programas
Authorization: Bearer {{access_token}}
Content-Type: application/json

{
  "nombre_programa": "Técnico en Sistemas",
  "codigo_programa": "TS001",
  "descripcion": "Programa de formación en sistemas",
  "estado": true,
  "fecha_creacion": "2024-01-15",
  "fecha_modificacion": "2024-01-15",
  "area_id": 1
}
```

### Obtener Programa
```http
GET /api/programas/{id}
Authorization: Bearer {{access_token}}
```

### Actualizar Programa
```http
PUT /api/programas/{id}
Authorization: Bearer {{access_token}}
Content-Type: application/json

{
  "nombre_programa": "Técnico en Sistemas Actualizado",
  "descripcion": "Descripción actualizada del programa"
}
```

### Eliminar Programa
```http
DELETE /api/programas/{id}
Authorization: Bearer {{access_token}}
```

## 📋 Fichas

### Listar Fichas
```http
GET /api/fichas
Authorization: Bearer {{access_token}}
```

### Crear Ficha
```http
POST /api/fichas
Authorization: Bearer {{access_token}}
Content-Type: application/json

{
  "numero_ficha": "2024001",
  "nombre_ficha": "Ficha Sistemas 2024",
  "fecha_inicio": "2024-01-15",
  "fecha_fin": "2024-12-15",
  "estado": true,
  "fecha_creacion": "2024-01-15",
  "fecha_modificacion": "2024-01-15",
  "programa_id": 1
}
```

### Obtener Ficha
```http
GET /api/fichas/{id}
Authorization: Bearer {{access_token}}
```

### Actualizar Ficha
```http
PUT /api/fichas/{id}
Authorization: Bearer {{access_token}}
Content-Type: application/json

{
  "nombre_ficha": "Ficha Sistemas 2024 Actualizada",
  "fecha_fin": "2025-01-15"
}
```

### Eliminar Ficha
```http
DELETE /api/fichas/{id}
Authorization: Bearer {{access_token}}
```

## 📊 Categorías de Elementos

### Listar Categorías
```http
GET /api/categorias-elementos
Authorization: Bearer {{access_token}}
```

### Crear Categoría
```http
POST /api/categorias-elementos
Authorization: Bearer {{access_token}}
Content-Type: application/json

{
  "nombre_categoria": "Equipos de Cómputo",
  "descripcion_categoria": "Computadores, laptops y equipos relacionados",
  "estado": true,
  "fecha_creacion": "2024-01-15",
  "fecha_modificacion": "2024-01-15"
}
```

### Obtener Categoría
```http
GET /api/categorias-elementos/{id}
Authorization: Bearer {{access_token}}
```

### Actualizar Categoría
```http
PUT /api/categorias-elementos/{id}
Authorization: Bearer {{access_token}}
Content-Type: application/json

{
  "nombre_categoria": "Equipos de Cómputo y Periféricos",
  "descripcion_categoria": "Descripción actualizada"
}
```

### Eliminar Categoría
```http
DELETE /api/categorias-elementos/{id}
Authorization: Bearer {{access_token}}
```

## 🔧 Características

### Listar Características
```http
GET /api/caracteristicas
Authorization: Bearer {{access_token}}
```

### Crear Característica
```http
POST /api/caracteristicas
Authorization: Bearer {{access_token}}
Content-Type: application/json

{
  "nombre_caracteristica": "Procesador",
  "valor_caracteristica": "Intel Core i7",
  "estado": true,
  "fecha_creacion": "2024-01-15",
  "fecha_modificacion": "2024-01-15",
  "material_id": 1
}
```

### Obtener Característica
```http
GET /api/caracteristicas/{id}
Authorization: Bearer {{access_token}}
```

### Actualizar Característica
```http
PUT /api/caracteristicas/{id}
Authorization: Bearer {{access_token}}
Content-Type: application/json

{
  "valor_caracteristica": "Intel Core i9",
  "estado": true
}
```

### Eliminar Característica
```http
DELETE /api/caracteristicas/{id}
Authorization: Bearer {{access_token}}
```

## 🏢 Centros

### Listar Centros
```http
GET /api/centros
Authorization: Bearer {{access_token}}
```

### Crear Centro
```http
POST /api/centros
Authorization: Bearer {{access_token}}
Content-Type: application/json

{
  "nombre_centro": "Centro de Biotecnología Industrial",
  "direccion": "Calle 456 #78-90",
  "telefono": "6056789012",
  "estado": true,
  "fecha_creacion": "2024-01-15",
  "fecha_modificacion": "2024-01-15",
  "municipio_id": 1
}
```

### Obtener Centro
```http
GET /api/centros/{id}
Authorization: Bearer {{access_token}}
```

### Actualizar Centro
```http
PUT /api/centros/{id}
Authorization: Bearer {{access_token}}
Content-Type: application/json

{
  "nombre_centro": "Centro de Biotecnología Industrial Actualizado",
  "telefono": "6051234567"
}
```

### Eliminar Centro
```http
DELETE /api/centros/{id}
Authorization: Bearer {{access_token}}
```

## 🌍 Municipios

### Listar Municipios
```http
GET /api/municipios
Authorization: Bearer {{access_token}}
```

### Crear Municipio
```http
POST /api/municipios
Authorization: Bearer {{access_token}}
Content-Type: application/json

{
  "nombre_municipio": "Bogotá",
  "codigo_dane": "11001",
  "estado": true,
  "fecha_creacion": "2024-01-15",
  "fecha_modificacion": "2024-01-15"
}
```

### Obtener Municipio
```http
GET /api/municipios/{id}
Authorization: Bearer {{access_token}}
```

### Actualizar Municipio
```http
PUT /api/municipios/{id}
Authorization: Bearer {{access_token}}
Content-Type: application/json

{
  "nombre_municipio": "Bogotá D.C.",
  "codigo_dane": "11001"
}
```

### Eliminar Municipio
```http
DELETE /api/municipios/{id}
Authorization: Bearer {{access_token}}
```

## 📝 Notas Importantes

### Códigos de Respuesta
- **200**: Operación exitosa
- **201**: Recurso creado exitosamente
- **204**: Recurso eliminado exitosamente
- **400**: Error de validación
- **401**: No autorizado
- **404**: Recurso no encontrado
- **500**: Error interno del servidor

### Formato de Respuesta Exitosa
```json
{
  "success": true,
  "message": "Operación exitosa",
  "data": {
    // Datos del recurso
  }
}
```

### Formato de Respuesta de Error
```json
{
  "success": false,
  "message": "Error de validación",
  "errors": {
    "campo": ["Mensaje de error específico"]
  }
}
```

### Variables de Entorno para Postman
1. `base_url`: `http://localhost:8000`
2. `access_token`: El token obtenido del login

### Configuración de Autenticación
Después de hacer login, guarda el token en la variable `access_token` para usarlo en todas las demás peticiones.

¡Listo! Con esta guía puedes probar todos los endpoints de tu API BodegaSena desde Postman. 🚀 
# Instrucciones para usar el sistema de tokens con Postman

## 📋 Resumen de cambios implementados

Se ha implementado un sistema de autenticación con tokens usando **Laravel Sanctum**. Ahora cuando inicies sesión, recibirás un token que deberás usar para acceder a las rutas protegidas.

## 🚀 Cómo funciona

### 1. Iniciar sesión y obtener el token

**Endpoint:** `POST /api/login`

**Body (JSON):**
```json
{
    "email": "usuario@example.com",
    "password": "tu_contraseña"
}
```

**Respuesta exitosa:**
```json
{
    "success": true,
    "message": "Login exitoso",
    "token": "1|ABC123DEF456GHI789JKL012MNO345PQR678STU901VWX234YZ567",
    "token_type": "Bearer",
    "user": {
        "id": 1,
        "nombre": "Juan",
        "apellido": "Pérez",
        "email": "usuario@example.com",
        "rol": {
            "id_rol": 1,
            "nombre": "Administrador"
        }
    }
}
```

### 2. Usar el token en Postman

Una vez que tengas el token, debes incluirlo en todas las requests a endpoints protegidos:

**Método 1: Header Authorization**
- En la pestaña "Headers"
- Agrega un header con:
  - **Key:** `Authorization`
  - **Value:** `Bearer TU_TOKEN_AQUI`

**Método 2: Authorization Tab**
- Ve a la pestaña "Authorization"
- Selecciona "Bearer Token"
- Pega tu token en el campo "Token"

### 3. Endpoints disponibles

#### Rutas públicas (no requieren token):
- `POST /api/login` - Iniciar sesión
- `POST /api/register` - Registrar usuario

#### Rutas protegidas (requieren token):
- `GET /api/user` - Obtener información del usuario actual
- `POST /api/logout` - Cerrar sesión actual
- `POST /api/logout-all` - Cerrar sesión en todos los dispositivos
- `GET /api/dashboard/*` - Todas las rutas del dashboard

## 📝 Ejemplos prácticos para Postman

### Ejemplo 1: Login
```
POST http://localhost:8000/api/login
Content-Type: application/json

{
    "email": "admin@bodegasena.com",
    "password": "password123"
}
```

### Ejemplo 2: Obtener información del usuario
```
GET http://localhost:8000/api/user
Authorization: Bearer 1|ABC123DEF456GHI789JKL012MNO345PQR678STU901VWX234YZ567
```

### Ejemplo 3: Cerrar sesión
```
POST http://localhost:8000/api/logout
Authorization: Bearer 1|ABC123DEF456GHI789JKL012MNO345PQR678STU901VWX234YZ567
```

### Ejemplo 4: Cerrar sesión en todos los dispositivos
```
POST http://localhost:8000/api/logout-all
Authorization: Bearer 1|ABC123DEF456GHI789JKL012MNO345PQR678STU901VWX234YZ567
```

## 🔧 Configuración recomendada en Postman

### Crear una Collection Variable
1. En tu collection de Postman, ve a la pestaña "Variables"
2. Crea una variable llamada `auth_token`
3. Después de hacer login, copia el token y pégalo en el valor de la variable
4. En tus requests, usa `{{auth_token}}` en lugar del token completo

### Script de Pre-request para automatizar
Puedes agregar este script en el Pre-request Script de tu collection:

```javascript
// Si no tienes token, haz login automáticamente
if (!pm.collectionVariables.get("auth_token")) {
    pm.sendRequest({
        url: pm.environment.get("base_url") + "/api/login",
        method: "POST",
        header: {
            "Content-Type": "application/json"
        },
        body: {
            mode: "raw",
            raw: JSON.stringify({
                email: "admin@bodegasena.com",
                password: "password123"
            })
        }
    }, (err, response) => {
        if (response.json().success) {
            pm.collectionVariables.set("auth_token", response.json().token);
        }
    });
}
```

## ⚠️ Notas importantes

1. **Guarda tu token**: El token se genera solo una vez al hacer login
2. **Expira**: Los tokens tienen un tiempo de vida limitado
3. **Seguridad**: Nunca compartas tu token ni lo incluyas en código público
4. **Logout**: Siempre cierra sesión cuando termines para invalidar el token
5. **Múltiples dispositivos**: Usa `logout-all` para cerrar sesión en todos los dispositivos

## 🐛 Solución de problemas

### Error: "Token no proporcionado"
- Verifica que estés incluyendo el header `Authorization`
- Asegúrate de usar el formato `Bearer TOKEN`

### Error: "Token inválido"
- El token puede haber expirado
- Haz login nuevamente para obtener un nuevo token

### Error: "Usuario no autorizado o inactivo"
- Tu cuenta puede estar desactivada
- Contacta al administrador

## 🎯 Tips para testing

1. **Guarda requests comunes**: Crea requests básicos (login, logout, user info)
2. **Usa environments**: Configura diferentes entornos (desarrollo, producción)
3. **Organiza por folders**: Agrupa requests relacionados en carpetas
4. **Automatiza**: Usa scripts para manejar tokens automáticamente 
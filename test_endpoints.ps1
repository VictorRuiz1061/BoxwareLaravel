# 🚀 Script de Pruebas para BodegaSena API
# PowerShell script para probar endpoints rápidamente

# Configuración
$baseUrl = "http://localhost:8000"
$headers = @{
    "Content-Type" = "application/json"
    "Accept" = "application/json"
}

# Variable para el token (se establecerá después del login)
$token = ""

Write-Host "🔐 === TESTING BODEGASENA API ===" -ForegroundColor Green

# Función para hacer login
function Test-Login {
    $loginData = @{
        email = "admin@sena.edu.co"
        password = "123456"
    } | ConvertTo-Json

    try {
        $response = Invoke-RestMethod -Uri "$baseUrl/api/login" -Method POST -Body $loginData -Headers $headers
        if ($response.access_token) {
            $script:token = $response.access_token
            $script:headers["Authorization"] = "Bearer $token"
            Write-Host "✅ Login exitoso - Token obtenido" -ForegroundColor Green
            return $true
        }
    } catch {
        Write-Host "❌ Error en login: $($_.Exception.Message)" -ForegroundColor Red
        return $false
    }
}

# Función para obtener usuario actual
function Test-GetUser {
    try {
        $response = Invoke-RestMethod -Uri "$baseUrl/api/user" -Method GET -Headers $headers
        Write-Host "✅ Usuario actual obtenido: $($response.nombre)" -ForegroundColor Green
    } catch {
        Write-Host "❌ Error obteniendo usuario: $($_.Exception.Message)" -ForegroundColor Red
    }
}

# Función para probar endpoint de materiales
function Test-Materials {
    # Crear material
    $materialData = @{
        codigo_sena = "TEST001"
        nombre_material = "Material de Prueba"
        descripcion_material = "Descripción de prueba"
        unidad_medida = "Unidad"
        producto_peresedero = $false
        estado = $true
        fecha_vencimiento = "2025-12-31"
        imagen = "test.jpg"
        fecha_creacion = "2024-01-15"
        fecha_modificacion = "2024-01-15"
        categoria_id = 1
        tipo_material_id = 1
    } | ConvertTo-Json

    try {
        $response = Invoke-RestMethod -Uri "$baseUrl/api/materiales" -Method POST -Body $materialData -Headers $headers
        Write-Host "✅ Material creado exitosamente" -ForegroundColor Green
        
        # Listar materiales
        $materials = Invoke-RestMethod -Uri "$baseUrl/api/materiales" -Method GET -Headers $headers
        Write-Host "✅ Materiales listados: $($materials.Count) encontrados" -ForegroundColor Green
        
    } catch {
        Write-Host "❌ Error con materiales: $($_.Exception.Message)" -ForegroundColor Red
    }
}

# Función para probar endpoint de roles
function Test-Roles {
    $roleData = @{
        nombre_rol = "Rol de Prueba"
        estado = $true
        fecha_creacion = "2024-01-15"
        fecha_modificacion = "2024-01-15"
    } | ConvertTo-Json

    try {
        $response = Invoke-RestMethod -Uri "$baseUrl/api/roles" -Method POST -Body $roleData -Headers $headers
        Write-Host "✅ Rol creado exitosamente" -ForegroundColor Green
        
        # Listar roles
        $roles = Invoke-RestMethod -Uri "$baseUrl/api/roles" -Method GET -Headers $headers
        Write-Host "✅ Roles listados: $($roles.Count) encontrados" -ForegroundColor Green
        
    } catch {
        Write-Host "❌ Error con roles: $($_.Exception.Message)" -ForegroundColor Red
    }
}

# Función principal
function Start-APITest {
    Write-Host "🔥 Iniciando pruebas de API..." -ForegroundColor Yellow
    
    # Probar login
    if (Test-Login) {
        # Probar obtener usuario
        Test-GetUser
        
        # Probar diferentes endpoints
        Write-Host "`n📦 Probando Materiales..." -ForegroundColor Cyan
        Test-Materials
        
        Write-Host "`n🎭 Probando Roles..." -ForegroundColor Cyan
        Test-Roles
        
        Write-Host "`n🎉 Pruebas completadas!" -ForegroundColor Green
    } else {
        Write-Host "❌ No se pudo hacer login. Verifica las credenciales." -ForegroundColor Red
    }
}

# Ejecutar pruebas
Start-APITest

# Información adicional
Write-Host "`n📋 INFORMACIÓN ADICIONAL:" -ForegroundColor Blue
Write-Host "• Base URL: $baseUrl" -ForegroundColor White
Write-Host "• Token: $($token.Substring(0, 10))..." -ForegroundColor White
Write-Host "• Usar el token en Authorization: Bearer $token" -ForegroundColor White
Write-Host "`n📖 Consulta 'postman_endpoints.md' para más detalles" -ForegroundColor Yellow 
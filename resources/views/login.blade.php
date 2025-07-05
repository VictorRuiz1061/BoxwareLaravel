<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Iniciar Sesión - Sistema de Bodega SENA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .input-focus:focus {
            border-color: #374151;
            box-shadow: 0 0 0 1px #374151;
        }
        .btn-hover:hover {
            background-color: #1f2937;
        }
    </style>
</head>
<body class="min-h-screen bg-gray-50 flex items-center justify-center p-4">
    <!-- Contenedor principal -->
    <div class="w-full max-w-md">
        <!-- Tarjeta de login -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-12 h-12 bg-gray-100 rounded-full mb-4">
                    <i class="fas fa-warehouse text-lg text-gray-600"></i>
                </div>
                <h1 class="text-2xl font-semibold text-gray-900 mb-1">Bodega SENA</h1>
                <p class="text-sm text-gray-600">Sistema de Gestión de Inventario</p>
            </div>

            <!-- Formulario de login -->
            <form id="loginForm" class="space-y-5">
                <!-- Campo Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Correo Electrónico
                    </label>
                    <div class="relative">
                        <input 
                            type="email" 
                            id="email" 
                            name="email"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md text-gray-900 placeholder-gray-500 focus:outline-none input-focus transition-colors"
                            placeholder="usuario@sena.edu.co"
                            required
                        >
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i class="fas fa-envelope text-gray-400 text-sm"></i>
                        </div>
                    </div>
                </div>

                <!-- Campo Contraseña -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Contraseña
                    </label>
                    <div class="relative">
                        <input 
                            type="password" 
                            id="password" 
                            name="password"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md text-gray-900 placeholder-gray-500 focus:outline-none input-focus transition-colors"
                            placeholder="••••••••"
                            required
                        >
                        <button 
                            type="button" 
                            id="togglePassword"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 transition-colors"
                        >
                            <i class="fas fa-eye text-sm" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                <!-- Checkbox Recordar -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center text-gray-700 text-sm">
                        <input type="checkbox" id="remember" class="mr-2 rounded border-gray-300 text-gray-900 focus:ring-gray-500">
                        Recordar sesión
                    </label>
                    <a href="#" class="text-sm text-gray-600 hover:text-gray-900 transition-colors">
                        ¿Olvidaste tu contraseña?
                    </a>
                </div>

                <!-- Botón de envío -->
                <button 
                    type="submit" 
                    id="submitBtn"
                    class="w-full py-2 px-4 bg-gray-900 hover:bg-gray-800 text-white font-medium rounded-md btn-hover transition-colors flex items-center justify-center"
                >
                    <span id="btnText">Iniciar Sesión</span>
                    <div id="loadingSpinner" class="hidden ml-2">
                        <i class="fas fa-spinner fa-spin"></i>
                    </div>
                </button>
            </form>

            <!-- Enlaces adicionales -->
            <div class="mt-6 text-center">
                <p class="text-gray-600 text-sm">
                    ¿No tienes cuenta? 
                    <a href="/register" class="text-gray-900 font-medium hover:underline transition-colors">
                        Regístrate aquí
                    </a>
                </p>
            </div>

            <!-- Mensajes de resultado -->
            <div id="result" class="mt-4 text-center"></div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-6">
            <p class="text-gray-500 text-xs">
                © 2024 Servicio Nacional de Aprendizaje SENA
            </p>
        </div>
    </div>

    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        });

        // Form submission
        document.getElementById('loginForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            const loadingSpinner = document.getElementById('loadingSpinner');
            const resultDiv = document.getElementById('result');
            
            // Get form data
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const remember = document.getElementById('remember').checked;
            
            // Validate inputs
            if (!email || !password) {
                showMessage('Por favor, completa todos los campos', 'error');
                return;
            }
            
            // Show loading state
            submitBtn.disabled = true;
            btnText.textContent = 'Iniciando sesión...';
            loadingSpinner.classList.remove('hidden');
            
            try {
                const response = await fetch('/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ 
                        email, 
                        password, 
                        remember 
                    })
                });
                
                const data = await response.json();
                
                if (response.ok) {
                    showMessage('¡Inicio de sesión exitoso! Redirigiendo...', 'success');
                    
                    // Store user data if needed
                    if (data.user) {
                        localStorage.setItem('user', JSON.stringify(data.user));
                    }
                    
                    // Redirect after delay
                    setTimeout(() => {
                        window.location.href = '/admin';
                    }, 1500);
                } else {
                    showMessage(data.message || 'Error en las credenciales', 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showMessage('Error de conexión. Intenta nuevamente.', 'error');
            } finally {
                // Reset button state
                submitBtn.disabled = false;
                btnText.textContent = 'Iniciar Sesión';
                loadingSpinner.classList.add('hidden');
            }
        });

        // Show message function
        function showMessage(message, type) {
            const resultDiv = document.getElementById('result');
            const icon = type === 'success' ? 'fas fa-check-circle' : 'fas fa-exclamation-circle';
            const color = type === 'success' ? 'text-green-600' : 'text-red-600';
            
            resultDiv.innerHTML = `
                <div class="flex items-center justify-center space-x-2 ${color} text-sm">
                    <i class="${icon}"></i>
                    <span>${message}</span>
                </div>
            `;
            
            // Auto-hide after 5 seconds
            setTimeout(() => {
                resultDiv.innerHTML = '';
            }, 5000);
        }
    </script>
</body>
</html>
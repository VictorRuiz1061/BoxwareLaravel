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
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="min-h-screen gradient-bg flex items-center justify-center p-4">
    <!-- Fondo animado -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
    </div>

    <!-- Contenedor principal -->
    <div class="relative w-full max-w-md">
        <!-- Tarjeta de login -->
        <div class="glass-effect rounded-3xl shadow-2xl p-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 rounded-full mb-4">
                    <i class="fas fa-warehouse text-2xl text-white"></i>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">Bodega SENA</h1>
                <p class="text-white/80">Sistema de Gestión de Inventario</p>
            </div>

            <!-- Formulario de login -->
            <form id="loginForm" class="space-y-6">
                <!-- Campo Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-white/90 mb-2">
                        <i class="fas fa-envelope mr-2"></i>Correo Electrónico
                    </label>
                    <div class="relative">
                        <input 
                            type="email" 
                            id="email" 
                            name="email"
                            class="w-full px-4 py-3 bg-white/20 border border-white/30 rounded-xl text-white placeholder-white/60 focus:outline-none input-focus transition-all duration-300"
                            placeholder="usuario@sena.edu.co"
                            required
                        >
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i class="fas fa-user text-white/60"></i>
                        </div>
                    </div>
                </div>

                <!-- Campo Contraseña -->
                <div>
                    <label for="password" class="block text-sm font-medium text-white/90 mb-2">
                        <i class="fas fa-lock mr-2"></i>Contraseña
                    </label>
                    <div class="relative">
                        <input 
                            type="password" 
                            id="password" 
                            name="password"
                            class="w-full px-4 py-3 bg-white/20 border border-white/30 rounded-xl text-white placeholder-white/60 focus:outline-none input-focus transition-all duration-300"
                            placeholder="••••••••"
                            required
                        >
                        <button 
                            type="button" 
                            id="togglePassword"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-white/60 hover:text-white transition-colors"
                        >
                            <i class="fas fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                <!-- Checkbox Recordar -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center text-white/80 text-sm">
                        <input type="checkbox" id="remember" class="mr-2 rounded border-white/30 bg-white/20">
                        Recordar sesión
                    </label>
                    <a href="#" class="text-white/80 text-sm hover:text-white transition-colors">
                        ¿Olvidaste tu contraseña?
                    </a>
                </div>

                <!-- Botón de envío -->
                <button 
                    type="submit" 
                    id="submitBtn"
                    class="w-full py-3 bg-white/20 hover:bg-white/30 text-white font-semibold rounded-xl btn-hover transition-all duration-300 flex items-center justify-center"
                >
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    <span id="btnText">Iniciar Sesión</span>
                    <div id="loadingSpinner" class="hidden ml-2">
                        <i class="fas fa-spinner fa-spin"></i>
                    </div>
                </button>
            </form>

            <!-- Enlaces adicionales -->
            <div class="mt-6 text-center">
                <p class="text-white/80 text-sm">
                    ¿No tienes cuenta? 
                    <a href="/register" class="text-white font-semibold hover:underline transition-colors">
                        Regístrate aquí
                    </a>
                </p>
            </div>

            <!-- Mensajes de resultado -->
            <div id="result" class="mt-4 text-center"></div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-6">
            <p class="text-white/60 text-sm">
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
            const color = type === 'success' ? 'text-green-400' : 'text-red-400';
            
            resultDiv.innerHTML = `
                <div class="flex items-center justify-center space-x-2 ${color}">
                    <i class="${icon}"></i>
                    <span>${message}</span>
                </div>
            `;
            
            // Auto-hide after 5 seconds
            setTimeout(() => {
                resultDiv.innerHTML = '';
            }, 5000);
        }

        // Add input animations
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('scale-105');
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('scale-105');
            });
        });
    </script>
</body>
</html>

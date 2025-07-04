<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Registro - Sistema de Bodega SENA</title>
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
        .form-step {
            display: none;
        }
        .form-step.active {
            display: block;
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
    <div class="relative w-full max-w-lg">
        <!-- Tarjeta de registro -->
        <div class="glass-effect rounded-3xl shadow-2xl p-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 rounded-full mb-4">
                    <i class="fas fa-user-plus text-2xl text-white"></i>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">Crear Cuenta</h1>
                <p class="text-white/80">Únete al Sistema de Bodega SENA</p>
            </div>

            <!-- Indicador de progreso -->
            <div class="flex justify-center mb-6">
                <div class="flex space-x-2">
                    <div class="w-3 h-3 bg-white rounded-full step-indicator active" data-step="1"></div>
                    <div class="w-3 h-3 bg-white/40 rounded-full step-indicator" data-step="2"></div>
                    <div class="w-3 h-3 bg-white/40 rounded-full step-indicator" data-step="3"></div>
                </div>
            </div>

            <!-- Formulario de registro -->
            <form id="registerForm" class="space-y-6">
                <!-- Paso 1: Información Personal -->
                <div class="form-step active" id="step1">
                    <h3 class="text-lg font-semibold text-white mb-4">Información Personal</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="nombre" class="block text-sm font-medium text-white/90 mb-2">
                                <i class="fas fa-user mr-2"></i>Nombre
                            </label>
                            <input 
                                type="text" 
                                id="nombre" 
                                name="nombre_usuario"
                                class="w-full px-4 py-3 bg-white/20 border border-white/30 rounded-xl text-white placeholder-white/60 focus:outline-none input-focus transition-all duration-300"
                                placeholder="Tu nombre"
                                required
                            >
                        </div>
                        
                        <div>
                            <label for="apellido" class="block text-sm font-medium text-white/90 mb-2">
                                <i class="fas fa-user mr-2"></i>Apellido
                            </label>
                            <input 
                                type="text" 
                                id="apellido" 
                                name="apellido_usuario"
                                class="w-full px-4 py-3 bg-white/20 border border-white/30 rounded-xl text-white placeholder-white/60 focus:outline-none input-focus transition-all duration-300"
                                placeholder="Tu apellido"
                                required
                            >
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <label for="email" class="block text-sm font-medium text-white/90 mb-2">
                            <i class="fas fa-envelope mr-2"></i>Correo Electrónico
                        </label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email"
                            class="w-full px-4 py-3 bg-white/20 border border-white/30 rounded-xl text-white placeholder-white/60 focus:outline-none input-focus transition-all duration-300"
                            placeholder="usuario@sena.edu.co"
                            required
                        >
                    </div>
                    
                    <div class="flex justify-end mt-6">
                        <button 
                            type="button" 
                            class="px-6 py-2 bg-white/20 hover:bg-white/30 text-white font-semibold rounded-xl btn-hover transition-all duration-300"
                            onclick="nextStep()"
                        >
                            Siguiente <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>

                <!-- Paso 2: Seguridad -->
                <div class="form-step" id="step2">
                    <h3 class="text-lg font-semibold text-white mb-4">Seguridad</h3>
                    
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
                    
                    <div class="mt-4">
                        <label for="password_confirmation" class="block text-sm font-medium text-white/90 mb-2">
                            <i class="fas fa-lock mr-2"></i>Confirmar Contraseña
                        </label>
                        <div class="relative">
                            <input 
                                type="password" 
                                id="password_confirmation" 
                                name="password_confirmation"
                                class="w-full px-4 py-3 bg-white/20 border border-white/30 rounded-xl text-white placeholder-white/60 focus:outline-none input-focus transition-all duration-300"
                                placeholder="••••••••"
                                required
                            >
                        </div>
                    </div>
                    
                    <!-- Indicador de fortaleza de contraseña -->
                    <div class="mt-4">
                        <div class="flex space-x-2">
                            <div class="flex-1 h-2 bg-white/20 rounded-full overflow-hidden">
                                <div id="passwordStrength" class="h-full bg-red-400 transition-all duration-300" style="width: 0%"></div>
                            </div>
                        </div>
                        <p id="passwordText" class="text-xs text-white/60 mt-1">Fortaleza de la contraseña</p>
                    </div>
                    
                    <div class="flex justify-between mt-6">
                        <button 
                            type="button" 
                            class="px-6 py-2 bg-white/20 hover:bg-white/30 text-white font-semibold rounded-xl btn-hover transition-all duration-300"
                            onclick="prevStep()"
                        >
                            <i class="fas fa-arrow-left mr-2"></i> Anterior
                        </button>
                        <button 
                            type="button" 
                            class="px-6 py-2 bg-white/20 hover:bg-white/30 text-white font-semibold rounded-xl btn-hover transition-all duration-300"
                            onclick="nextStep()"
                        >
                            Siguiente <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>

                <!-- Paso 3: Confirmación -->
                <div class="form-step" id="step3">
                    <h3 class="text-lg font-semibold text-white mb-4">Confirmación</h3>
                    
                    <div class="bg-white/10 rounded-xl p-4 mb-4">
                        <h4 class="text-white font-semibold mb-2">Resumen de tu cuenta:</h4>
                        <div class="space-y-2 text-white/80 text-sm">
                            <p><strong>Nombre:</strong> <span id="summaryNombre"></span></p>
                            <p><strong>Apellido:</strong> <span id="summaryApellido"></span></p>
                            <p><strong>Email:</strong> <span id="summaryEmail"></span></p>
                        </div>
                    </div>
                    
                    <div class="flex items-center mb-4">
                        <input type="checkbox" id="terms" class="mr-3 rounded border-white/30 bg-white/20">
                        <label for="terms" class="text-white/80 text-sm">
                            Acepto los <a href="#" class="text-white font-semibold hover:underline">términos y condiciones</a>
                        </label>
                    </div>
                    
                    <div class="flex justify-between">
                        <button 
                            type="button" 
                            class="px-6 py-2 bg-white/20 hover:bg-white/30 text-white font-semibold rounded-xl btn-hover transition-all duration-300"
                            onclick="prevStep()"
                        >
                            <i class="fas fa-arrow-left mr-2"></i> Anterior
                        </button>
                        <button 
                            type="submit" 
                            id="submitBtn"
                            class="px-6 py-2 bg-white/20 hover:bg-white/30 text-white font-semibold rounded-xl btn-hover transition-all duration-300 flex items-center"
                        >
                            <i class="fas fa-user-plus mr-2"></i>
                            <span id="btnText">Crear Cuenta</span>
                            <div id="loadingSpinner" class="hidden ml-2">
                                <i class="fas fa-spinner fa-spin"></i>
                            </div>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Enlaces adicionales -->
            <div class="mt-6 text-center">
                <p class="text-white/80 text-sm">
                    ¿Ya tienes cuenta? 
                    <a href="/login" class="text-white font-semibold hover:underline transition-colors">
                        Inicia sesión aquí
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
        let currentStep = 1;
        const totalSteps = 3;

        // Navegación entre pasos
        function nextStep() {
            if (validateCurrentStep()) {
                if (currentStep < totalSteps) {
                    document.getElementById(`step${currentStep}`).classList.remove('active');
                    currentStep++;
                    document.getElementById(`step${currentStep}`).classList.add('active');
                    updateStepIndicators();
                    
                    if (currentStep === 3) {
                        updateSummary();
                    }
                }
            }
        }

        function prevStep() {
            if (currentStep > 1) {
                document.getElementById(`step${currentStep}`).classList.remove('active');
                currentStep--;
                document.getElementById(`step${currentStep}`).classList.add('active');
                updateStepIndicators();
            }
        }

        function updateStepIndicators() {
            document.querySelectorAll('.step-indicator').forEach((indicator, index) => {
                if (index + 1 <= currentStep) {
                    indicator.classList.add('bg-white');
                    indicator.classList.remove('bg-white/40');
                } else {
                    indicator.classList.remove('bg-white');
                    indicator.classList.add('bg-white/40');
                }
            });
        }

        function validateCurrentStep() {
            if (currentStep === 1) {
                const nombre = document.getElementById('nombre').value;
                const apellido = document.getElementById('apellido').value;
                const email = document.getElementById('email').value;
                
                if (!nombre || !apellido || !email) {
                    showMessage('Por favor, completa todos los campos', 'error');
                    return false;
                }
                
                if (!isValidEmail(email)) {
                    showMessage('Por favor, ingresa un email válido', 'error');
                    return false;
                }
            } else if (currentStep === 2) {
                const password = document.getElementById('password').value;
                const passwordConfirmation = document.getElementById('password_confirmation').value;
                
                if (!password || !passwordConfirmation) {
                    showMessage('Por favor, completa los campos de contraseña', 'error');
                    return false;
                }
                
                if (password !== passwordConfirmation) {
                    showMessage('Las contraseñas no coinciden', 'error');
                    return false;
                }
                
                if (password.length < 6) {
                    showMessage('La contraseña debe tener al menos 6 caracteres', 'error');
                    return false;
                }
            }
            
            return true;
        }

        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        function updateSummary() {
            document.getElementById('summaryNombre').textContent = document.getElementById('nombre').value;
            document.getElementById('summaryApellido').textContent = document.getElementById('apellido').value;
            document.getElementById('summaryEmail').textContent = document.getElementById('email').value;
        }

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

        // Password strength indicator
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthBar = document.getElementById('passwordStrength');
            const strengthText = document.getElementById('passwordText');
            
            let strength = 0;
            let text = 'Muy débil';
            let color = 'bg-red-400';
            
            if (password.length >= 6) strength += 25;
            if (password.match(/[a-z]/)) strength += 25;
            if (password.match(/[A-Z]/)) strength += 25;
            if (password.match(/[0-9]/)) strength += 25;
            
            if (strength >= 100) {
                text = 'Muy fuerte';
                color = 'bg-green-400';
            } else if (strength >= 75) {
                text = 'Fuerte';
                color = 'bg-green-500';
            } else if (strength >= 50) {
                text = 'Media';
                color = 'bg-yellow-400';
            } else if (strength >= 25) {
                text = 'Débil';
                color = 'bg-orange-400';
            }
            
            strengthBar.style.width = strength + '%';
            strengthBar.className = `h-full ${color} transition-all duration-300`;
            strengthText.textContent = text;
        });

        // Form submission
        document.getElementById('registerForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            if (!document.getElementById('terms').checked) {
                showMessage('Debes aceptar los términos y condiciones', 'error');
                return;
            }
            
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            const loadingSpinner = document.getElementById('loadingSpinner');
            
            // Get form data
            const formData = {
                nombre_usuario: document.getElementById('nombre').value,
                apellido_usuario: document.getElementById('apellido').value,
                email: document.getElementById('email').value,
                password: document.getElementById('password').value,
                password_confirmation: document.getElementById('password_confirmation').value,
                estado: true,
                rol_id: 2 // Rol de usuario por defecto
            };
            
            // Show loading state
            submitBtn.disabled = true;
            btnText.textContent = 'Creando cuenta...';
            loadingSpinner.classList.remove('hidden');
            
            try {
                const response = await fetch('/api/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(formData)
                });
                
                const data = await response.json();
                
                if (response.ok) {
                    showMessage('¡Cuenta creada exitosamente! Redirigiendo al login...', 'success');
                    
                    setTimeout(() => {
                        window.location.href = '/login';
                    }, 2000);
                } else {
                    if (data.errors) {
                        const errorMessages = Object.values(data.errors).flat().join(', ');
                        showMessage(errorMessages, 'error');
                    } else {
                        showMessage(data.message || 'Error al crear la cuenta', 'error');
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                showMessage('Error de conexión. Intenta nuevamente.', 'error');
            } finally {
                // Reset button state
                submitBtn.disabled = false;
                btnText.textContent = 'Crear Cuenta';
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
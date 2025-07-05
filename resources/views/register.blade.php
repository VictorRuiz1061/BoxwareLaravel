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
        .input-focus:focus {
            border-color: #374151;
            box-shadow: 0 0 0 1px #374151;
        }
        .btn-hover:hover {
            background-color: #1f2937;
        }
        .form-step {
            display: none;
        }
        .form-step.active {
            display: block;
        }
    </style>
</head>
<body class="min-h-screen bg-gray-50 flex items-center justify-center p-4">
    <!-- Contenedor principal -->
    <div class="w-full max-w-lg">
        <!-- Tarjeta de registro -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-12 h-12 bg-gray-100 rounded-full mb-4">
                    <i class="fas fa-user-plus text-lg text-gray-600"></i>
                </div>
                <h1 class="text-2xl font-semibold text-gray-900 mb-1">Crear Cuenta</h1>
                <p class="text-sm text-gray-600">Únete al Sistema de Bodega SENA</p>
            </div>

            <!-- Indicador de progreso -->
            <div class="flex justify-center mb-6">
                <div class="flex space-x-2">
                    <div class="w-2 h-2 bg-gray-900 rounded-full step-indicator active" data-step="1"></div>
                    <div class="w-2 h-2 bg-gray-300 rounded-full step-indicator" data-step="2"></div>
                    <div class="w-2 h-2 bg-gray-300 rounded-full step-indicator" data-step="3"></div>
                </div>
            </div>

            <!-- Formulario de registro -->
            <form id="registerForm" class="space-y-5">
                <!-- Paso 1: Información Personal -->
                <div class="form-step active" id="step1">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Información Personal</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">
                                Nombre
                            </label>
                            <input 
                                type="text" 
                                id="nombre" 
                                name="nombre_usuario"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md text-gray-900 placeholder-gray-500 focus:outline-none input-focus transition-colors"
                                placeholder="Tu nombre"
                                required
                            >
                        </div>
                        
                        <div>
                            <label for="apellido" class="block text-sm font-medium text-gray-700 mb-2">
                                Apellido
                            </label>
                            <input 
                                type="text" 
                                id="apellido" 
                                name="apellido_usuario"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md text-gray-900 placeholder-gray-500 focus:outline-none input-focus transition-colors"
                                placeholder="Tu apellido"
                                required
                            >
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Correo Electrónico
                        </label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md text-gray-900 placeholder-gray-500 focus:outline-none input-focus transition-colors"
                            placeholder="usuario@sena.edu.co"
                            required
                        >
                    </div>
                    
                    <div class="flex justify-end mt-6">
                        <button 
                            type="button" 
                            class="px-4 py-2 bg-gray-900 hover:bg-gray-800 text-white font-medium rounded-md btn-hover transition-colors"
                            onclick="nextStep()"
                        >
                            Siguiente <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>

                <!-- Paso 2: Seguridad -->
                <div class="form-step" id="step2">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Seguridad</h3>
                    
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
                    
                    <div class="mt-4">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            Confirmar Contraseña
                        </label>
                        <div class="relative">
                            <input 
                                type="password" 
                                id="password_confirmation" 
                                name="password_confirmation"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md text-gray-900 placeholder-gray-500 focus:outline-none input-focus transition-colors"
                                placeholder="••••••••"
                                required
                            >
                        </div>
                    </div>
                    
                    <!-- Indicador de fortaleza de contraseña -->
                    <div class="mt-4">
                        <div class="flex space-x-2">
                            <div class="flex-1 h-2 bg-gray-200 rounded-full overflow-hidden">
                                <div id="passwordStrength" class="h-full bg-red-500 transition-all duration-300" style="width: 0%"></div>
                            </div>
                        </div>
                        <p id="passwordText" class="text-xs text-gray-500 mt-1">Fortaleza de la contraseña</p>
                    </div>
                    
                    <div class="flex justify-between mt-6">
                        <button 
                            type="button" 
                            class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-md transition-colors"
                            onclick="prevStep()"
                        >
                            <i class="fas fa-arrow-left mr-2"></i> Anterior
                        </button>
                        <button 
                            type="button" 
                            class="px-4 py-2 bg-gray-900 hover:bg-gray-800 text-white font-medium rounded-md btn-hover transition-colors"
                            onclick="nextStep()"
                        >
                            Siguiente <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>

                <!-- Paso 3: Confirmación -->
                <div class="form-step" id="step3">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Confirmación</h3>
                    
                    <div class="bg-gray-50 rounded-lg p-4 mb-4">
                        <h4 class="text-gray-900 font-medium mb-2">Resumen de tu cuenta:</h4>
                        <div class="space-y-2 text-gray-600 text-sm">
                            <p><strong>Nombre:</strong> <span id="summaryNombre"></span></p>
                            <p><strong>Apellido:</strong> <span id="summaryApellido"></span></p>
                            <p><strong>Email:</strong> <span id="summaryEmail"></span></p>
                        </div>
                    </div>
                    
                    <div class="flex items-center mb-4">
                        <input 
                            type="checkbox" 
                            id="terms" 
                            class="mr-2 rounded border-gray-300 text-gray-900 focus:ring-gray-500"
                            required
                        >
                        <label for="terms" class="text-sm text-gray-700">
                            Acepto los términos y condiciones
                        </label>
                    </div>
                    
                    <div class="flex justify-between">
                        <button 
                            type="button" 
                            class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-md transition-colors"
                            onclick="prevStep()"
                        >
                            <i class="fas fa-arrow-left mr-2"></i> Anterior
                        </button>
                        <button 
                            type="submit" 
                            id="submitBtn"
                            class="px-4 py-2 bg-gray-900 hover:bg-gray-800 text-white font-medium rounded-md btn-hover transition-colors flex items-center"
                        >
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
                <p class="text-gray-600 text-sm">
                    ¿Ya tienes cuenta? 
                    <a href="/login" class="text-gray-900 font-medium hover:underline transition-colors">
                        Inicia sesión aquí
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
                    indicator.classList.add('bg-gray-900');
                    indicator.classList.remove('bg-gray-300');
                } else {
                    indicator.classList.remove('bg-gray-900');
                    indicator.classList.add('bg-gray-300');
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
            let color = 'bg-red-500';
            
            if (password.length >= 6) strength += 25;
            if (password.match(/[a-z]/)) strength += 25;
            if (password.match(/[A-Z]/)) strength += 25;
            if (password.match(/[0-9]/)) strength += 25;
            
            if (strength >= 100) {
                text = 'Muy fuerte';
                color = 'bg-green-500';
            } else if (strength >= 75) {
                text = 'Fuerte';
                color = 'bg-green-600';
            } else if (strength >= 50) {
                text = 'Media';
                color = 'bg-yellow-500';
            } else if (strength >= 25) {
                text = 'Débil';
                color = 'bg-orange-500';
            }
            
            strengthBar.style.width = strength + '%';
            strengthBar.className = `h-full ${color} transition-all duration-300`;
            strengthText.textContent = text;
        });

        // Form submission
        document.getElementById('registerForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            // Validar que todos los campos requeridos estén completos
            const requiredFields = ['nombre', 'apellido', 'email', 'password', 'password_confirmation'];
            let isValid = true;
            
            requiredFields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                if (!field.value.trim()) {
                    field.classList.add('border-red-500');
                    isValid = false;
                } else {
                    field.classList.remove('border-red-500');
                }
            });
            
            if (!isValid) {
                showMessage('Por favor, completa todos los campos requeridos', 'error');
                return;
            }
            
            if (!document.getElementById('terms').checked) {
                showMessage('Debes aceptar los términos y condiciones', 'error');
                return;
            }
            
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            const loadingSpinner = document.getElementById('loadingSpinner');
            
            // Get form data
            const formData = {
                nombre_usuario: document.getElementById('nombre').value.trim(),
                apellido: document.getElementById('apellido').value.trim(),
                email: document.getElementById('email').value.trim(),
                password: document.getElementById('password').value,
                password_confirmation: document.getElementById('password_confirmation').value,
                estado: true,
                rol_id: 3 // Rol de usuario por defecto
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
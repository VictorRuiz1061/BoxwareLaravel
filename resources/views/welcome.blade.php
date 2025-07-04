<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sistema de Bodega SENA - Gestión de Inventario</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .hero-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        .feature-icon {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-warehouse text-white text-sm"></i>
                    </div>
                    <span class="text-xl font-bold text-gray-900">Bodega SENA</span>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#inicio" class="text-gray-700 hover:text-blue-600 transition-colors">Inicio</a>
                    <a href="#caracteristicas" class="text-gray-700 hover:text-blue-600 transition-colors">Características</a>
                    <a href="#acerca" class="text-gray-700 hover:text-blue-600 transition-colors">Acerca de</a>
                    <a href="#contacto" class="text-gray-700 hover:text-blue-600 transition-colors">Contacto</a>
                </div>

                <!-- Auth Buttons -->
                <div class="flex items-center space-x-4">
                    <a href="/login" class="text-gray-700 hover:text-blue-600 transition-colors">
                        Iniciar Sesión
                    </a>
                    <a href="/register" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                        Registrarse
                    </a>
                </div>

                <!-- Mobile menu button -->
                <button class="md:hidden text-gray-700 hover:text-blue-600">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="inicio" class="gradient-bg hero-pattern relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Hero Content -->
                <div class="text-white">
                    <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                        Sistema de Gestión de 
                        <span class="text-yellow-300">Bodega SENA</span>
                    </h1>
                    <p class="text-xl md:text-2xl mb-8 text-white/90 leading-relaxed">
                        Optimiza el control de inventario, gestiona materiales y mejora la eficiencia operativa de tu centro de formación.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="/login" class="bg-white text-blue-600 hover:bg-gray-100 px-8 py-4 rounded-lg font-semibold text-lg transition-colors inline-flex items-center justify-center">
                            <i class="fas fa-rocket mr-2"></i>
                            Comenzar Ahora
                        </a>
                        <a href="#caracteristicas" class="border-2 border-white text-white hover:bg-white hover:text-blue-600 px-8 py-4 rounded-lg font-semibold text-lg transition-colors inline-flex items-center justify-center">
                            <i class="fas fa-play mr-2"></i>
                            Ver Demo
                        </a>
                    </div>
                </div>

                <!-- Hero Image -->
                <div class="relative">
                    <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-8 shadow-2xl">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white/20 rounded-lg p-4 text-center">
                                <i class="fas fa-boxes text-3xl text-white mb-2"></i>
                                <p class="text-white font-semibold">Inventario</p>
                                <p class="text-white/80 text-sm">Control total</p>
                            </div>
                            <div class="bg-white/20 rounded-lg p-4 text-center">
                                <i class="fas fa-chart-line text-3xl text-white mb-2"></i>
                                <p class="text-white font-semibold">Reportes</p>
                                <p class="text-white/80 text-sm">Análisis en tiempo real</p>
                            </div>
                            <div class="bg-white/20 rounded-lg p-4 text-center">
                                <i class="fas fa-users text-3xl text-white mb-2"></i>
                                <p class="text-white font-semibold">Usuarios</p>
                                <p class="text-white/80 text-sm">Gestión de roles</p>
                            </div>
                            <div class="bg-white/20 rounded-lg p-4 text-center">
                                <i class="fas fa-shield-alt text-3xl text-white mb-2"></i>
                                <p class="text-white font-semibold">Seguridad</p>
                                <p class="text-white/80 text-sm">Acceso controlado</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Floating Elements -->
        <div class="absolute top-20 left-10 w-20 h-20 bg-white/10 rounded-full blur-xl"></div>
        <div class="absolute bottom-20 right-10 w-32 h-32 bg-white/10 rounded-full blur-xl"></div>
    </section>

    <!-- Features Section -->
    <section id="caracteristicas" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Características Principales
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Descubre todas las herramientas que hacen del Sistema de Bodega SENA la solución perfecta para la gestión de inventario.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-gray-50 rounded-xl p-8 card-hover transition-all duration-300">
                    <div class="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-boxes text-2xl feature-icon"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Gestión de Inventario</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Control completo del inventario con seguimiento en tiempo real, alertas de stock bajo y gestión de ubicaciones.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-gray-50 rounded-xl p-8 card-hover transition-all duration-300">
                    <div class="w-16 h-16 bg-green-100 rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-exchange-alt text-2xl feature-icon"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Movimientos de Stock</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Registro detallado de entradas y salidas con trazabilidad completa y autorizaciones por roles.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-gray-50 rounded-xl p-8 card-hover transition-all duration-300">
                    <div class="w-16 h-16 bg-purple-100 rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-chart-bar text-2xl feature-icon"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Reportes y Estadísticas</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Generación de reportes personalizados, gráficos interactivos y análisis de tendencias del inventario.
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="bg-gray-50 rounded-xl p-8 card-hover transition-all duration-300">
                    <div class="w-16 h-16 bg-yellow-100 rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-users text-2xl feature-icon"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Gestión de Usuarios</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Sistema de roles y permisos, control de acceso y auditoría de actividades de los usuarios.
                    </p>
                </div>

                <!-- Feature 5 -->
                <div class="bg-gray-50 rounded-xl p-8 card-hover transition-all duration-300">
                    <div class="w-16 h-16 bg-red-100 rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-bell text-2xl feature-icon"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Alertas y Notificaciones</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Sistema de alertas automáticas para stock bajo, vencimientos y movimientos importantes.
                    </p>
                </div>

                <!-- Feature 6 -->
                <div class="bg-gray-50 rounded-xl p-8 card-hover transition-all duration-300">
                    <div class="w-16 h-16 bg-indigo-100 rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-mobile-alt text-2xl feature-icon"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Acceso Móvil</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Interfaz responsive que permite acceder al sistema desde cualquier dispositivo móvil.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 gradient-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
                <div class="text-white">
                    <div class="text-4xl font-bold mb-2" id="stats-materiales">0</div>
                    <p class="text-white/80">Materiales Registrados</p>
                </div>
                <div class="text-white">
                    <div class="text-4xl font-bold mb-2" id="stats-movimientos">0</div>
                    <p class="text-white/80">Movimientos Mensuales</p>
                </div>
                <div class="text-white">
                    <div class="text-4xl font-bold mb-2" id="stats-usuarios">0</div>
                    <p class="text-white/80">Usuarios Activos</p>
                </div>
                <div class="text-white">
                    <div class="text-4xl font-bold mb-2" id="stats-centros">0</div>
                    <p class="text-white/80">Centros de Formación</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="acerca" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                        Acerca del Sistema de Bodega SENA
                    </h2>
                    <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                        El Sistema de Bodega SENA es una solución integral desarrollada específicamente para los centros de formación del Servicio Nacional de Aprendizaje, diseñada para optimizar la gestión de inventario y mejorar la eficiencia operativa.
                    </p>
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                        Nuestro sistema proporciona herramientas avanzadas para el control de materiales, seguimiento de movimientos y generación de reportes, todo en una plataforma moderna y fácil de usar.
                    </p>
                    
                    <div class="grid grid-cols-2 gap-6">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-green-500 text-xl"></i>
                            <span class="text-gray-700">Fácil de usar</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-green-500 text-xl"></i>
                            <span class="text-gray-700">Seguro y confiable</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-green-500 text-xl"></i>
                            <span class="text-gray-700">Soporte técnico</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-green-500 text-xl"></i>
                            <span class="text-gray-700">Actualizaciones regulares</span>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <div class="bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl p-8 text-white">
                        <h3 class="text-2xl font-bold mb-4">¿Por qué elegir nuestro sistema?</h3>
                        <ul class="space-y-4">
                            <li class="flex items-start space-x-3">
                                <i class="fas fa-star text-yellow-300 mt-1"></i>
                                <span>Desarrollado específicamente para el SENA</span>
                            </li>
                            <li class="flex items-start space-x-3">
                                <i class="fas fa-star text-yellow-300 mt-1"></i>
                                <span>Cumple con los estándares de calidad institucionales</span>
                            </li>
                            <li class="flex items-start space-x-3">
                                <i class="fas fa-star text-yellow-300 mt-1"></i>
                                <span>Integración con sistemas existentes</span>
                            </li>
                            <li class="flex items-start space-x-3">
                                <i class="fas fa-star text-yellow-300 mt-1"></i>
                                <span>Soporte técnico especializado</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contacto" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Contáctanos
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    ¿Tienes preguntas sobre el sistema? Nuestro equipo está aquí para ayudarte.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Contact Info -->
                <div>
                    <h3 class="text-2xl font-semibold text-gray-900 mb-6">Información de Contacto</h3>
                    <div class="space-y-6">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-map-marker-alt text-blue-600"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Dirección</h4>
                                <p class="text-gray-600">Servicio Nacional de Aprendizaje SENA</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-envelope text-green-600"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Email</h4>
                                <p class="text-gray-600">soporte@sena.edu.co</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-phone text-purple-600"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Teléfono</h4>
                                <p class="text-gray-600">+57 1 5461500</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="bg-white rounded-xl p-8 shadow-sm">
                    <h3 class="text-2xl font-semibold text-gray-900 mb-6">Envíanos un Mensaje</h3>
                    <form class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nombre</label>
                                <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Tu nombre">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="tu@email.com">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Asunto</label>
                            <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Asunto del mensaje">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Mensaje</label>
                            <textarea rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Tu mensaje"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold transition-colors">
                            Enviar Mensaje
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-warehouse text-white text-sm"></i>
                        </div>
                        <span class="text-xl font-bold">Bodega SENA</span>
                    </div>
                    <p class="text-gray-400">
                        Sistema integral de gestión de inventario para centros de formación del SENA.
                    </p>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Enlaces Rápidos</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#inicio" class="hover:text-white transition-colors">Inicio</a></li>
                        <li><a href="#caracteristicas" class="hover:text-white transition-colors">Características</a></li>
                        <li><a href="#acerca" class="hover:text-white transition-colors">Acerca de</a></li>
                        <li><a href="#contacto" class="hover:text-white transition-colors">Contacto</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Recursos</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Documentación</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Manual de Usuario</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">FAQ</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Soporte</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Síguenos</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-blue-600 transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-blue-400 transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-blue-700 transition-colors">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-red-600 transition-colors">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2024 Servicio Nacional de Aprendizaje SENA. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Load stats
        function loadStats() {
            // Simulate loading stats
            const stats = {
                materiales: 1250,
                movimientos: 3420,
                usuarios: 156,
                centros: 117
            };

            // Animate stats
            Object.keys(stats).forEach(key => {
                const element = document.getElementById(`stats-${key}`);
                if (element) {
                    animateNumber(element, 0, stats[key], 2000);
                }
            });
        }

        function animateNumber(element, start, end, duration) {
            const startTime = performance.now();
            const difference = end - start;

            function updateNumber(currentTime) {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);
                
                const current = Math.floor(start + (difference * progress));
                element.textContent = current.toLocaleString();

                if (progress < 1) {
                    requestAnimationFrame(updateNumber);
                }
            }

            requestAnimationFrame(updateNumber);
        }

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in');
                    
                    // Load stats when stats section is visible
                    if (entry.target.id === 'stats-section') {
                        loadStats();
                    }
                }
            });
        }, observerOptions);

        // Observe elements for animation
        document.querySelectorAll('.card-hover, .gradient-bg').forEach(el => {
            observer.observe(el);
        });

        // Mobile menu toggle
        document.querySelector('.md\\:hidden').addEventListener('click', function() {
            // Add mobile menu functionality here
            console.log('Mobile menu clicked');
        });

        // Form submission
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();
            // Add form submission logic here
            alert('Gracias por tu mensaje. Nos pondremos en contacto contigo pronto.');
        });

        // Load initial stats
        loadStats();
    </script>
</body>
</html> 
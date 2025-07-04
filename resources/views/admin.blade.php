<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - Sistema de Bodega SENA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .sidebar {
            transition: all 0.3s ease;
        }
        .sidebar.collapsed {
            width: 4rem;
        }
        .main-content {
            transition: all 0.3s ease;
        }
        .main-content.expanded {
            margin-left: 4rem;
        }
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Sidebar -->
    <div id="sidebar" class="sidebar fixed top-0 left-0 h-full w-64 bg-white shadow-lg z-50">
        <!-- Logo -->
        <div class="flex items-center justify-between p-4 border-b border-gray-200">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-warehouse text-white text-sm"></i>
                </div>
                <span class="text-lg font-bold text-gray-800" id="logo-text">Bodega SENA</span>
            </div>
            <button id="sidebar-toggle" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- Navigation -->
        <nav class="mt-6">
            <div class="px-4 space-y-2">
                <!-- Dashboard -->
                <a href="#dashboard" class="nav-item flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors active" data-section="dashboard">
                    <i class="fas fa-tachometer-alt w-5"></i>
                    <span class="nav-text">Dashboard</span>
                </a>

                <!-- Inventario -->
                <a href="#inventario" class="nav-item flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors" data-section="inventario">
                    <i class="fas fa-boxes w-5"></i>
                    <span class="nav-text">Inventario</span>
                </a>

                <!-- Materiales -->
                <a href="#materiales" class="nav-item flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors" data-section="materiales">
                    <i class="fas fa-tools w-5"></i>
                    <span class="nav-text">Materiales</span>
                </a>

                <!-- Movimientos -->
                <a href="#movimientos" class="nav-item flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors" data-section="movimientos">
                    <i class="fas fa-exchange-alt w-5"></i>
                    <span class="nav-text">Movimientos</span>
                </a>

                <!-- Usuarios -->
                <a href="#usuarios" class="nav-item flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors" data-section="usuarios">
                    <i class="fas fa-users w-5"></i>
                    <span class="nav-text">Usuarios</span>
                </a>

                <!-- Reportes -->
                <a href="#reportes" class="nav-item flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors" data-section="reportes">
                    <i class="fas fa-chart-bar w-5"></i>
                    <span class="nav-text">Reportes</span>
                </a>

                <!-- Configuración -->
                <a href="#configuracion" class="nav-item flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors" data-section="configuracion">
                    <i class="fas fa-cog w-5"></i>
                    <span class="nav-text">Configuración</span>
                </a>
            </div>
        </nav>

        <!-- User Profile -->
        <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-200">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-user text-white text-sm"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate" id="user-name">Usuario</p>
                    <p class="text-xs text-gray-500 truncate" id="user-role">Administrador</p>
                </div>
                <button id="logout-btn" class="text-gray-500 hover:text-red-600 transition-colors">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div id="main-content" class="main-content ml-64 min-h-screen">
        <!-- Top Bar -->
        <header class="bg-white shadow-sm border-b border-gray-200 px-6 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900" id="page-title">Dashboard</h1>
                    <p class="text-gray-600" id="page-description">Panel de control del sistema de bodega</p>
                </div>
                <div class="flex items-center space-x-4">
                    <!-- Notifications -->
                    <button class="relative p-2 text-gray-500 hover:text-gray-700 transition-colors">
                        <i class="fas fa-bell text-lg"></i>
                        <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>

                    <!-- Search -->
                    <div class="relative">
                        <input type="text" placeholder="Buscar..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>
            </div>
        </header>

        <!-- Content Sections -->
        <div class="p-6">
            <!-- Dashboard Section -->
            <div id="dashboard-section" class="section active">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                                <i class="fas fa-boxes text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Total Materiales</p>
                                <p class="text-2xl font-bold text-gray-900" id="total-materiales">0</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 text-green-600">
                                <i class="fas fa-exchange-alt text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Movimientos Hoy</p>
                                <p class="text-2xl font-bold text-gray-900" id="movimientos-hoy">0</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                                <i class="fas fa-exclamation-triangle text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Stock Bajo</p>
                                <p class="text-2xl font-bold text-gray-900" id="stock-bajo">0</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                                <i class="fas fa-users text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Usuarios Activos</p>
                                <p class="text-2xl font-bold text-gray-900" id="usuarios-activos">0</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Row -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- Movimientos Chart -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Movimientos Recientes</h3>
                        <canvas id="movimientosChart" width="400" height="200"></canvas>
                    </div>

                    <!-- Stock Chart -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Estado del Inventario</h3>
                        <canvas id="stockChart" width="400" height="200"></canvas>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Actividad Reciente</h3>
                    <div class="space-y-4" id="recent-activity">
                        <!-- Activity items will be loaded here -->
                    </div>
                </div>
            </div>

            <!-- Inventario Section -->
            <div id="inventario-section" class="section hidden">
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-900">Gestión de Inventario</h2>
                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                            <i class="fas fa-plus mr-2"></i>Nuevo Item
                        </button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Material</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ubicación</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="inventario-table">
                                <!-- Table rows will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Materiales Section -->
            <div id="materiales-section" class="section hidden">
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-900">Catálogo de Materiales</h2>
                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                            <i class="fas fa-plus mr-2"></i>Nuevo Material
                        </button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="materiales-grid">
                        <!-- Material cards will be loaded here -->
                    </div>
                </div>
            </div>

            <!-- Movimientos Section -->
            <div id="movimientos-section" class="section hidden">
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-900">Historial de Movimientos</h2>
                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                            <i class="fas fa-plus mr-2"></i>Nuevo Movimiento
                        </button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Material</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usuario</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="movimientos-table">
                                <!-- Table rows will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Usuarios Section -->
            <div id="usuarios-section" class="section hidden">
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-900">Gestión de Usuarios</h2>
                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                            <i class="fas fa-plus mr-2"></i>Nuevo Usuario
                        </button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usuario</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rol</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="usuarios-table">
                                <!-- Table rows will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Reportes Section -->
            <div id="reportes-section" class="section hidden">
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Reportes y Estadísticas</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Reporte de Movimientos</h3>
                            <canvas id="reporteMovimientosChart" width="400" height="200"></canvas>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Análisis de Stock</h3>
                            <canvas id="analisisStockChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Configuración Section -->
            <div id="configuracion-section" class="section hidden">
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Configuración del Sistema</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-900">Configuración General</h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Nombre del Sistema</label>
                                    <input type="text" value="Sistema de Bodega SENA" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Email de Contacto</label>
                                    <input type="email" value="admin@sena.edu.co" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-900">Notificaciones</h3>
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <input type="checkbox" id="notif-stock" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    <label for="notif-stock" class="ml-2 text-sm text-gray-700">Alertas de stock bajo</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" id="notif-movimientos" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    <label for="notif-movimientos" class="ml-2 text-sm text-gray-700">Notificaciones de movimientos</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sidebar toggle
        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const logoText = document.getElementById('logo-text');
            const navTexts = document.querySelectorAll('.nav-text');
            
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
            
            if (sidebar.classList.contains('collapsed')) {
                logoText.style.display = 'none';
                navTexts.forEach(text => text.style.display = 'none');
            } else {
                logoText.style.display = 'block';
                navTexts.forEach(text => text.style.display = 'block');
            }
        });

        // Navigation
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remove active class from all nav items
                document.querySelectorAll('.nav-item').forEach(nav => nav.classList.remove('active'));
                
                // Add active class to clicked item
                this.classList.add('active');
                
                // Hide all sections
                document.querySelectorAll('.section').forEach(section => section.classList.add('hidden'));
                
                // Show target section
                const targetSection = this.getAttribute('data-section');
                document.getElementById(targetSection + '-section').classList.remove('hidden');
                
                // Update page title and description
                updatePageInfo(targetSection);
                
                // Load section data
                loadSectionData(targetSection);
            });
        });

        function updatePageInfo(section) {
            const titles = {
                dashboard: 'Dashboard',
                inventario: 'Inventario',
                materiales: 'Materiales',
                movimientos: 'Movimientos',
                usuarios: 'Usuarios',
                reportes: 'Reportes',
                configuracion: 'Configuración'
            };
            
            const descriptions = {
                dashboard: 'Panel de control del sistema de bodega',
                inventario: 'Gestión del inventario y stock',
                materiales: 'Catálogo y gestión de materiales',
                movimientos: 'Historial de entradas y salidas',
                usuarios: 'Administración de usuarios del sistema',
                reportes: 'Reportes y estadísticas del sistema',
                configuracion: 'Configuración general del sistema'
            };
            
            document.getElementById('page-title').textContent = titles[section];
            document.getElementById('page-description').textContent = descriptions[section];
        }

        function loadSectionData(section) {
            switch(section) {
                case 'dashboard':
                    loadDashboardData();
                    break;
                case 'inventario':
                    loadInventarioData();
                    break;
                case 'materiales':
                    loadMaterialesData();
                    break;
                case 'movimientos':
                    loadMovimientosData();
                    break;
                case 'usuarios':
                    loadUsuariosData();
                    break;
                case 'reportes':
                    loadReportesData();
                    break;
            }
        }

        function loadDashboardData() {
            // Load stats
            fetch('/api/dashboard/stats')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('total-materiales').textContent = data.total_materiales || 0;
                    document.getElementById('movimientos-hoy').textContent = data.movimientos_hoy || 0;
                    document.getElementById('stock-bajo').textContent = data.stock_bajo || 0;
                    document.getElementById('usuarios-activos').textContent = data.usuarios_activos || 0;
                })
                .catch(error => console.error('Error loading stats:', error));

            // Initialize charts
            initializeCharts();
        }

        function initializeCharts() {
            // Movimientos Chart
            const movimientosCtx = document.getElementById('movimientosChart').getContext('2d');
            new Chart(movimientosCtx, {
                type: 'line',
                data: {
                    labels: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],
                    datasets: [{
                        label: 'Entradas',
                        data: [12, 19, 3, 5, 2, 3, 7],
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.4
                    }, {
                        label: 'Salidas',
                        data: [8, 15, 7, 12, 9, 5, 11],
                        borderColor: 'rgb(239, 68, 68)',
                        backgroundColor: 'rgba(239, 68, 68, 0.1)',
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Stock Chart
            const stockCtx = document.getElementById('stockChart').getContext('2d');
            new Chart(stockCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Disponible', 'Stock Bajo', 'Agotado'],
                    datasets: [{
                        data: [65, 20, 15],
                        backgroundColor: [
                            'rgb(34, 197, 94)',
                            'rgb(245, 158, 11)',
                            'rgb(239, 68, 68)'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        }
                    }
                }
            });
        }

        function loadInventarioData() {
            fetch('/api/inventario')
                .then(response => response.json())
                .then(data => {
                    const tbody = document.getElementById('inventario-table');
                    tbody.innerHTML = '';
                    
                    data.forEach(item => {
                        const row = `
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                                <i class="fas fa-box text-gray-500"></i>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">${item.material.nombre}</div>
                                            <div class="text-sm text-gray-500">${item.material.codigo}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${item.cantidad}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${item.sitio.nombre}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${item.cantidad > 10 ? 'bg-green-100 text-green-800' : item.cantidad > 0 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800'}">
                                        ${item.cantidad > 10 ? 'Disponible' : item.cantidad > 0 ? 'Stock Bajo' : 'Agotado'}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button class="text-blue-600 hover:text-blue-900 mr-3">Editar</button>
                                    <button class="text-red-600 hover:text-red-900">Eliminar</button>
                                </td>
                            </tr>
                        `;
                        tbody.innerHTML += row;
                    });
                })
                .catch(error => console.error('Error loading inventario:', error));
        }

        function loadMaterialesData() {
            fetch('/api/materiales')
                .then(response => response.json())
                .then(data => {
                    const grid = document.getElementById('materiales-grid');
                    grid.innerHTML = '';
                    
                    data.forEach(material => {
                        const card = `
                            <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition-shadow">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-tools text-blue-600"></i>
                                    </div>
                                    <span class="text-sm text-gray-500">${material.tipo_material.nombre}</span>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">${material.nombre}</h3>
                                <p class="text-gray-600 text-sm mb-4">${material.descripcion}</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-500">Código: ${material.codigo}</span>
                                    <div class="flex space-x-2">
                                        <button class="text-blue-600 hover:text-blue-900 text-sm">Editar</button>
                                        <button class="text-red-600 hover:text-red-900 text-sm">Eliminar</button>
                                    </div>
                                </div>
                            </div>
                        `;
                        grid.innerHTML += card;
                    });
                })
                .catch(error => console.error('Error loading materiales:', error));
        }

        function loadMovimientosData() {
            fetch('/api/movimientos')
                .then(response => response.json())
                .then(data => {
                    const tbody = document.getElementById('movimientos-table');
                    tbody.innerHTML = '';
                    
                    data.forEach(movimiento => {
                        const row = `
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${new Date(movimiento.fecha).toLocaleDateString()}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${movimiento.tipo_movimiento.nombre === 'Entrada' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">
                                        ${movimiento.tipo_movimiento.nombre}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${movimiento.material.nombre}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${movimiento.cantidad}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${movimiento.usuario.nombre_usuario}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button class="text-blue-600 hover:text-blue-900">Ver</button>
                                </td>
                            </tr>
                        `;
                        tbody.innerHTML += row;
                    });
                })
                .catch(error => console.error('Error loading movimientos:', error));
        }

        function loadUsuariosData() {
            fetch('/api/usuarios')
                .then(response => response.json())
                .then(data => {
                    const tbody = document.getElementById('usuarios-table');
                    tbody.innerHTML = '';
                    
                    data.forEach(usuario => {
                        const row = `
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                                <i class="fas fa-user text-gray-500"></i>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">${usuario.nombre_usuario} ${usuario.apellido_usuario}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${usuario.email}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${usuario.rol.nombre}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${usuario.estado ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">
                                        ${usuario.estado ? 'Activo' : 'Inactivo'}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button class="text-blue-600 hover:text-blue-900 mr-3">Editar</button>
                                    <button class="text-red-600 hover:text-red-900">Eliminar</button>
                                </td>
                            </tr>
                        `;
                        tbody.innerHTML += row;
                    });
                })
                .catch(error => console.error('Error loading usuarios:', error));
        }

        function loadReportesData() {
            // Initialize report charts
            const reporteMovimientosCtx = document.getElementById('reporteMovimientosChart').getContext('2d');
            new Chart(reporteMovimientosCtx, {
                type: 'bar',
                data: {
                    labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Entradas',
                        data: [65, 59, 80, 81, 56, 55],
                        backgroundColor: 'rgba(59, 130, 246, 0.8)',
                    }, {
                        label: 'Salidas',
                        data: [28, 48, 40, 19, 86, 27],
                        backgroundColor: 'rgba(239, 68, 68, 0.8)',
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            const analisisStockCtx = document.getElementById('analisisStockChart').getContext('2d');
            new Chart(analisisStockCtx, {
                type: 'pie',
                data: {
                    labels: ['Herramientas', 'Equipos', 'Materiales', 'Consumibles'],
                    datasets: [{
                        data: [30, 25, 25, 20],
                        backgroundColor: [
                            'rgb(59, 130, 246)',
                            'rgb(16, 185, 129)',
                            'rgb(245, 158, 11)',
                            'rgb(239, 68, 68)'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        }
                    }
                }
            });
        }

        // Logout functionality
        document.getElementById('logout-btn').addEventListener('click', function() {
            if (confirm('¿Estás seguro de que quieres cerrar sesión?')) {
                fetch('/api/logout', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                .then(() => {
                    window.location.href = '/login';
                })
                .catch(error => {
                    console.error('Error during logout:', error);
                    window.location.href = '/login';
                });
            }
        });

        // Load initial data
        loadDashboardData();

        // Load user info
        const user = JSON.parse(localStorage.getItem('user') || '{}');
        if (user.nombre_usuario) {
            document.getElementById('user-name').textContent = `${user.nombre_usuario} ${user.apellido_usuario}`;
            document.getElementById('user-role').textContent = user.rol?.nombre || 'Usuario';
        }
    </script>
</body>
</html> 
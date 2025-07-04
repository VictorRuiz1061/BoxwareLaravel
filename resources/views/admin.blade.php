<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Hola Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-tr from-blue-400 via-purple-400 to-pink-400">
    <div class="bg-white/90 backdrop-blur-lg rounded-2xl shadow-2xl p-12 flex flex-col items-center">
        <h1 class="text-4xl font-extrabold text-gray-800 mb-4">¡Hola, Admin! 👋</h1>
        <p class="text-lg text-gray-600 mb-8">Has iniciado sesión correctamente.</p>
        <button id="logoutBtn" class="mt-4 px-6 py-2 bg-gradient-to-tr from-pink-500 to-blue-500 text-white rounded-lg shadow-lg font-bold hover:scale-105 transition-all duration-200">Cerrar sesión</button>
        <div id="logoutMsg" class="mt-4 text-green-600 font-semibold hidden">Sesión cerrada. Redirigiendo...</div>
        <script>
            document.getElementById('logoutBtn').addEventListener('click', async function() {
                const logoutMsg = document.getElementById('logoutMsg');
                try {
                    await fetch('/api/logout', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                        },
                        credentials: 'include'
                    });
                } catch (e) {}
                logoutMsg.classList.remove('hidden');
                setTimeout(() => {
                    window.location.href = '/login';
                }, 1200);
            });
        </script>
    </div>
</body>
</html>

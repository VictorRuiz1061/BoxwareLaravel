<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-tr from-blue-400 via-purple-400 to-pink-400">
    <div class="w-full max-w-md bg-white/80 backdrop-blur-lg rounded-2xl shadow-2xl p-10 relative">
        <div class="flex flex-col items-center mb-8">
            <div class="bg-gradient-to-tr from-blue-500 to-pink-500 p-3 rounded-full shadow-lg mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0-1.104-.896-2-2-2s-2 .896-2 2 .896 2 2 2 2-.896 2-2zm0 0c0-1.104.896-2 2-2s2 .896 2 2-.896 2-2 2-2-.896-2-2zm0 0v2m0 4v.01" /></svg>
            </div>
            <h2 class="text-3xl font-extrabold text-gray-800 tracking-tight">Bienvenido</h2>
            <p class="text-gray-500">Inicia sesión para continuar</p>
        </div>
        <form id="loginForm" class="space-y-6">
            <div>
                <label class="block text-gray-700 font-semibold mb-1" for="email">Correo electrónico</label>
                <input type="email" id="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 transition placeholder-gray-400 shadow-sm" placeholder="usuario@correo.com" required>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-1" for="password">Contraseña</label>
                <input type="password" id="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400 transition placeholder-gray-400 shadow-sm" placeholder="********" required>
            </div>
            <button type="submit" class="w-full py-2 rounded-lg bg-gradient-to-tr from-blue-500 to-pink-500 text-white font-bold shadow-lg hover:scale-105 hover:from-pink-500 hover:to-blue-500 transition-all duration-200">Entrar</button>
        </form>
        <div id="result" class="mt-6 text-center"></div>
        <div class="absolute -top-4 -right-4 bg-white rounded-full shadow-lg px-4 py-1 text-xs text-gray-400 font-semibold">Bodega Sena</div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const resultDiv = document.getElementById('result');
            resultDiv.textContent = 'Enviando...';
            try {
                const response = await fetch('/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ email, password })
                });
                const data = await response.json();
                if (response.ok) {
                    resultDiv.innerHTML = `<span class='text-green-600'>${data.mensaje}</span>`;
                    setTimeout(() => {
                        window.location.href = '/admin';
                    }, 1000);
                } else {
                    resultDiv.innerHTML = `<span class='text-red-600'>${data.message || 'Error de autenticación'}</span>`;
                }
            } catch (error) {
                resultDiv.innerHTML = `<span class='text-red-600'>Error en la petición</span>`;
            }
        });
    </script>
</body>
</html>

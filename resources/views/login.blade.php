<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Login - TaksiKu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet"/>
    <style>
        :root {
            --primary: #6366F1;
            --primary-dark: #4F46E5;
            --secondary: #14B8A6;
            --accent: #F97316;
            --danger: #EF4444;
            --warning: #F59E0B;
            --success: #10B981;
            --dark: #0F172A;
            --gray: #64748B;
            --light: #F1F5F9;
            --sidebar-dark: #1E293B;
            --sidebar-darker: #0F172A;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: var(--dark);
            overflow-x: hidden;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .glass-morphism {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
        }

        .login-card {
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            position: relative;
            animation: cardSlideIn 0.5s ease;
        }

        @keyframes cardSlideIn {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--primary), var(--primary-dark));
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            transition: all 0.3s ease;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
        }

        .input-field {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 12px;
            padding: 12px 16px;
            transition: all 0.3s ease;
        }

        .input-field:focus {
            background: white;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            outline: none;
            border-color: var(--primary);
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            transition: color 0.3s ease;
        }

        .input-field:focus ~ .input-icon {
            color: var(--primary);
        }

        .logo-container {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: 16px;
            padding: 16px;
            box-shadow: 0 10px 30px rgba(99, 102, 241, 0.3);
            animation: logoFloat 3s ease-in-out infinite;
        }

        @keyframes logoFloat {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        .feature-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
            color: white;
            opacity: 0.9;
        }

        .feature-item .material-icons-round {
            margin-right: 12px;
            color: rgba(255, 255, 255, 0.8);
        }

        .floating-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 20s infinite ease-in-out;
        }

        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            left: 10%;
            top: 20%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            right: 15%;
            top: 30%;
            animation-delay: 2s;
        }

        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            left: 20%;
            bottom: 20%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(10deg);
            }
        }

        .remember-me {
            display: flex;
            align-items: center;
        }

        .remember-me input[type="checkbox"] {
            width: 18px;
            height: 18px;
            margin-right: 8px;
            cursor: pointer;
        }

        .remember-me label {
            cursor: pointer;
            user-select: none;
        }

        .forgot-password {
            color: var(--primary);
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .forgot-password:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 20px 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e5e7eb;
        }

        .divider span {
            padding: 0 15px;
            color: #6b7280;
            font-size: 14px;
        }

        .social-login {
            display: flex;
            gap: 10px;
        }

        .social-button {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            background: white;
            transition: all 0.2s ease;
        }

        .social-button:hover {
            background: #f9fafb;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .signup-link {
            text-align: center;
            margin-top: 20px;
            color: #6b7280;
        }

        .signup-link a {
            color: var(--primary);
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .signup-link a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .error-message {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            display: none;
            animation: shake 0.5s;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .success-message {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            display: none;
        }

        @media (max-width: 768px) {
            .login-container {
                padding: 20px;
            }

            .login-card {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Floating Shapes Background -->
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="flex flex-col items-center justify-center min-h-screen p-4 login-container">
        <div class="w-full max-w-md">
            <!-- Login Card -->
            <div class="login-card p-8">
                <!-- Logo -->
                <div class="flex justify-center mb-8">
                    <div class="logo-container">
                        <span class="material-icons-round text-white text-4xl">local_taxi</span>
                    </div>
                </div>

                <!-- Header -->
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-gray-900">Masuk ke TaksiKu</h1>
                    <p class="text-gray-500 mt-2">Akses dashboard manajemen taksi Anda</p>
                </div>

                <!-- Error/Success Messages -->
                <div class="error-message" id="errorMessage">
                    Email atau password salah. Silakan coba lagi.
                </div>
                <div class="success-message" id="successMessage">
                    Login berhasil! Mengalihkan ke dashboard...
                </div>

                <!-- Login Form -->
                <form class="space-y-6" onsubmit="handleLogin(event)">
                    <!-- Email Field -->
                    <div class="relative">
                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="Alamat email"
                            required
                            class="input-field w-full pl-12 pr-4 py-3 text-gray-900 placeholder-gray-400 focus:outline-none"
                        />
                        <span class="material-icons-round input-icon">email</span>
                    </div>

                    <!-- Password Field -->
                    <div class="relative">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Password"
                            required
                            class="input-field w-full pl-12 pr-4 py-3 text-gray-900 placeholder-gray-400 focus:outline-none"
                        />
                        <span class="material-icons-round input-icon">lock</span>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex justify-between items-center">
                        <div class="remember-me">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">Ingat saya</label>
                        </div>
                        <a href="#" class="forgot-password text-sm">Lupa password?</a>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" class="btn-primary group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <span class="material-icons-round text-white">login</span>
                            </span>
                            Masuk
                        </button>
                    </div>
                </form>

                <!-- Divider -->
                <div class="divider">
                    <span>atau masuk dengan</span>
                </div>

                <!-- Social Login -->
                <div class="social-login">
                    <button class="social-button">
                        <span class="material-icons-round text-blue-600">mail</span>
                    </button>
                    <button class="social-button">
                        <span class="material-icons-round text-red-600">gmail</span>
                    </button>
                    <button class="social-button">
                        <span class="material-icons-round text-blue-500">facebook</span>
                    </button>
                </div>

                <!-- Sign Up Link -->
                <div class="signup-link">
                    Belum punya akun? <a href="#">Daftar sekarang</a>
                </div>
            </div>

            <!-- Features List -->
            <div class="mt-8 glass-morphism p-6">
                <h3 class="text-white font-semibold mb-4">Mengapa memilih TaksiKu?</h3>
                <ul class="feature-list">
                    <li class="feature-item">
                        <span class="material-icons-round">check_circle</span>
                        Manajemen armada yang efisien
                    </li>
                    <li class="feature-item">
                        <span class="material-icons-round">check_circle</span>
                        Pelacakan real-time untuk semua perjalanan
                    </li>
                    <li class="feature-item">
                        <span class="material-icons-round">check_circle</span>
                        Analitik mendalam untuk bisnis Anda
                    </li>
                    <li class="feature-item">
                        <span class="material-icons-round">check_circle</span>
                        Dukungan pelanggan 24/7
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="glass-morphism p-4 text-white text-sm m-4">
        <div class="flex justify-between items-center">
            <p>© 2024 TaksiKu. Semua hak dilindungi.</p>
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2">
                    <span class="material-icons-round text-base">speed</span>
                    <span>77 ms</span>
                    <span class="material-icons-round text-base">wifi_tethering</span>
                </div>
                <span>v4.0.0</span>
                <a class="hover:text-white/80" href="#">Bantuan</a>
                <a class="hover:text-white/80" href="#">Kebijakan Privasi</a>
            </div>
        </div>
    </footer>

    <script>
        function handleLogin(event) {
            event.preventDefault();

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const errorMessage = document.getElementById('errorMessage');
            const successMessage = document.getElementById('successMessage');

            // Reset messages
            errorMessage.style.display = 'none';
            successMessage.style.display = 'none';

            // Simple validation (in a real app, this would be server-side)
            if (email === 'admin@taksiku.com' && password === 'admin123') {
                // Show success message
                successMessage.style.display = 'block';

                // Simulate redirect after successful login
                setTimeout(() => {
                    window.location.href = 'dashboard.html';
                }, 2000);
            } else {
                // Show error message
                errorMessage.style.display = 'block';

                // Shake animation for the form
                const form = event.target;
                form.style.animation = 'shake 0.5s';
                setTimeout(() => {
                    form.style.animation = '';
                }, 500);
            }
        }

        // Add input focus effects
        document.querySelectorAll('.input-field').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });

            input.addEventListener('blur', function() {
                if (!this.value) {
                    this.parentElement.classList.remove('focused');
                }
            });
        });
    </script>
</body>
</html>

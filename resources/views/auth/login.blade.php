<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Pengaduan Sekolah</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            overflow: hidden;
        }

        /* Left Side - Dark Form */
        .login-left {
            width: 50%;
            background: #1a1a2e;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 50px;
            position: relative;
        }

        .login-form-container {
            width: 100%;
            max-width: 400px;
            color: white;
        }

        .login-form-container h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            animation: fadeInDown 0.6s ease;
        }

        .login-form-container p {
            color: #a0a0a0;
            margin-bottom: 40px;
            animation: fadeInDown 0.6s ease 0.1s both;
        }

        .form-group {
            margin-bottom: 25px;
            animation: fadeInUp 0.6s ease both;
        }

        .form-group:nth-child(1) { animation-delay: 0.2s; }
        .form-group:nth-child(2) { animation-delay: 0.3s; }
        .form-group:nth-child(3) { animation-delay: 0.4s; }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 0.9rem;
            color: #a0a0a0;
        }

        .form-group input {
            width: 100%;
            padding: 15px 20px;
            background: #252540;
            border: 2px solid #3a3a5c;
            border-radius: 10px;
            color: white;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #8b5cf6;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.2);
        }

        .form-group input::placeholder {
            color: #6a6a8a;
        }

        .password-wrapper {
            position: relative;
        }

        .password-wrapper .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6a6a8a;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .password-wrapper .toggle-password:hover {
            color: #8b5cf6;
        }

        .forgot-password {
            text-align: right;
            margin-bottom: 25px;
            animation: fadeInUp 0.6s ease 0.5s both;
        }

        .forgot-password a {
            color: #a0a0a0;
            text-decoration: none;
            font-size: 0.85rem;
            transition: color 0.3s ease;
        }

        .forgot-password a:hover {
            color: #8b5cf6;
        }

        .login-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            animation: fadeInUp 0.6s ease 0.6s both;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(139, 92, 246, 0.4);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .signup-link {
            text-align: center;
            margin-top: 40px;
            color: #a0a0a0;
            font-size: 0.9rem;
            animation: fadeInUp 0.6s ease 0.7s both;
        }

        .signup-link a {
            color: #8b5cf6;
            text-decoration: none;
            font-weight: 600;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

        /* Right Side - Purple Illustration */
        .login-right {
            width: 50%;
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 50%, #6d28d9 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 50px;
            position: relative;
            overflow: hidden;
        }

        .login-right::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -100px;
            right: -100px;
        }

        .login-right::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            bottom: -50px;
            left: -50px;
        }

        .welcome-text {
            text-align: center;
            color: white;
            z-index: 1;
            animation: fadeInRight 0.8s ease;
        }

        .welcome-text h2 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 10px;
            line-height: 1.2;
        }

        .welcome-text p {
            font-size: 1.1rem;
            opacity: 0.8;
            margin-bottom: 40px;
        }

        .illustration {
            max-width: 500px;
            width: 100%;
            z-index: 1;
            animation: fadeInUp 1s ease 0.3s both;
        }

        .illustration img {
            width: 100%;
            height: auto;
            filter: drop-shadow(0 20px 40px rgba(0, 0, 0, 0.3));
        }

        /* Alert Styles */
        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            animation: shake 0.5s ease;
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.2);
            border: 1px solid #ef4444;
            color: #fca5a5;
        }

        .alert-success {
            background: rgba(34, 197, 94, 0.2);
            border: 1px solid #22c55e;
            color: #86efac;
        }

        /* Loading Spinner */
        .loading-spinner {
            display: none;
            width: 20px;
            height: 20px;
            border: 2px solid #ffffff;
            border-top-color: transparent;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            margin-right: 10px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        /* Responsive */
        @media (max-width: 968px) {
            body {
                flex-direction: column;
            }

            .login-left,
            .login-right {
                width: 100%;
                min-height: 50vh;
            }

            .login-right {
                display: none;
            }

            .welcome-text h2 {
                font-size: 2rem;
            }
        }

        /* Testing Accounts Box */
        .testing-accounts {
            margin-top: 30px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            animation: fadeInUp 0.6s ease 0.8s both;
        }

        .testing-accounts h4 {
            color: #8b5cf6;
            font-size: 0.9rem;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .account-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 0.85rem;
        }

        .account-item:last-child {
            border-bottom: none;
        }

        .account-item .role {
            color: #a0a0a0;
        }

        .account-item .email {
            color: white;
            font-family: 'Courier New', monospace;
        }

        .password-hint {
            text-align: center;
            margin-top: 15px;
            padding: 10px;
            background: rgba(139, 92, 246, 0.2);
            border-radius: 8px;
            color: #c4b5fd;
            font-size: 0.85rem;
        }
        
    </style>
</head>
<body>
    <!-- Left Side - Login Form -->
    <div class="login-left">
        <div class="login-form-container">
            <h1>Login</h1>
            <p>Enter your account details</p>

            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" id="loginForm">
                @csrf
                
                <div class="form-group">
                    <label for="email">Username</label>
                    <input type="email" 
                           name="email" 
                           id="email" 
                           placeholder="nama@sekolah.com"
                           required 
                           autofocus
                           value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="password-wrapper">
                        <input type="password" 
                               name="password" 
                               id="password" 
                               placeholder="••••••••"
                               required>
                        <i class="fas fa-eye toggle-password" onclick="togglePassword()"></i>
                    </div>
                </div>

                <div class="forgot-password">
                    <a href="#">Forgot Password?</a>
                </div>

                <button type="submit" class="login-btn" id="loginBtn">
                    <span class="loading-spinner" id="spinner"></span>
                    <span id="btnText">Login</span>
                </button>
            </form>

            <!-- ✅ SUDAH DIPERBAIKI - Link ke Register -->
            <div class="signup-link">
                Don't have an account? <a href="{{ route('register') }}">Sign up</a>
            </div>

            <!-- Testing Accounts -->
            <div class="testing-accounts">
                <h4><i class="fas fa-users"></i> Testing Accounts</h4>
                <div class="account-item">
                    <span class="role">Admin</span>
                    <span class="email">admin@sekolah.com</span>
                </div>
                <div class="account-item">
                    <span class="role">Guru</span>
                    <span class="email">guru@sekolah.com</span>
                </div>
                <div class="account-item">
                    <span class="role">Siswa</span>
                    <span class="email">siswa@sekolah.com</span>
                </div>
                <div class="password-hint">
                    <i class="fas fa-key"></i> Password: <strong>password</strong>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Side - Illustration -->
    <div class="login-right">
        <div class="welcome-text">
            <h2>Welcome to<br>Student Portal</h2>
            <p>Login to access your account</p>
        </div>
        <div class="illustration">
            <!-- SVG Illustration (Student/Laptop Theme) -->
            <svg viewBox="0 0 500 400" xmlns="http://www.w3.org/2000/svg">
                <!-- Background Elements -->
                <circle cx="250" cy="200" r="150" fill="rgba(255,255,255,0.1)"/>
                <circle cx="300" cy="150" r="80" fill="rgba(255,255,255,0.05)"/>
                
                <!-- Person 1 - Sitting with Laptop -->
                <g transform="translate(280, 100)">
                    <!-- Body -->
                    <circle cx="40" cy="30" r="20" fill="white"/>
                    <path d="M40 50 L40 90" stroke="white" stroke-width="8" stroke-linecap="round"/>
                    <path d="M40 60 L70 50" stroke="white" stroke-width="8" stroke-linecap="round"/>
                    <path d="M40 90 L30 130" stroke="white" stroke-width="8" stroke-linecap="round"/>
                    <path d="M40 90 L60 130" stroke="white" stroke-width="8" stroke-linecap="round"/>
                    <!-- Laptop -->
                    <rect x="50" y="40" width="50" height="35" rx="3" fill="white" opacity="0.9"/>
                    <rect x="45" y="75" width="60" height="5" rx="2" fill="white" opacity="0.7"/>
                </g>
                
                <!-- Person 2 - Walking with Phone -->
                <g transform="translate(150, 200)">
                    <!-- Body -->
                    <circle cx="30" cy="30" r="18" fill="white"/>
                    <path d="M30 48 L30 85" stroke="white" stroke-width="7" stroke-linecap="round"/>
                    <path d="M30 55 L10 65" stroke="white" stroke-width="7" stroke-linecap="round"/>
                    <path d="M30 55 L50 60" stroke="white" stroke-width="7" stroke-linecap="round"/>
                    <path d="M30 85 L20 120" stroke="white" stroke-width="7" stroke-linecap="round"/>
                    <path d="M30 85 L45 115" stroke="white" stroke-width="7" stroke-linecap="round"/>
                    <!-- Phone -->
                    <rect x="45" y="55" width="12" height="20" rx="2" fill="white" opacity="0.8"/>
                </g>
                
                <!-- Decorative Elements -->
                <circle cx="100" cy="100" r="30" fill="rgba(255,255,255,0.1)"/>
                <circle cx="400" cy="300" r="50" fill="rgba(255,255,255,0.05)"/>
                <rect x="200" cy="250" width="80" height="80" rx="10" fill="rgba(255,255,255,0.05)"/>
                
                <!-- Plant -->
                <g transform="translate(380, 280)">
                    <path d="M20 50 Q10 30 20 10" stroke="white" stroke-width="3" fill="none" opacity="0.6"/>
                    <path d="M20 50 Q30 30 20 15" stroke="white" stroke-width="3" fill="none" opacity="0.6"/>
                    <path d="M20 50 Q15 35 5 20" stroke="white" stroke-width="3" fill="none" opacity="0.6"/>
                    <ellipse cx="20" cy="50" rx="25" ry="10" fill="rgba(0,0,0,0.3)"/>
                </g>
            </svg>
        </div>
    </div>

    <script>
        // Toggle Password Visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.toggle-password');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Form Submit with Loading
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const btn = document.getElementById('loginBtn');
            const spinner = document.getElementById('spinner');
            const btnText = document.getElementById('btnText');
            
            btn.disabled = true;
            spinner.style.display = 'inline-block';
            btnText.textContent = 'Logging in...';
            
            // Form will submit normally
        });

        // Input Animation on Focus
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });

        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.opacity = '0';
                alert.style.transition = 'opacity 0.5s ease';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>
</body>
</html>

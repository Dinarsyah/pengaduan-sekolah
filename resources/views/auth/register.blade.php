<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sistem Pengaduan Sekolah</title>
    
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
        .register-left {
            width: 50%;
            background: #1a1a2e;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 50px;
            position: relative;
        }

        .register-form-container {
            width: 100%;
            max-width: 450px;
            color: white;
        }

        .register-form-container h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            animation: fadeInDown 0.6s ease;
        }

        .register-form-container p {
            color: #a0a0a0;
            margin-bottom: 40px;
            animation: fadeInDown 0.6s ease 0.1s both;
        }

        .form-group {
            margin-bottom: 20px;
            animation: fadeInUp 0.6s ease both;
        }

        .form-group:nth-child(1) { animation-delay: 0.2s; }
        .form-group:nth-child(2) { animation-delay: 0.3s; }
        .form-group:nth-child(3) { animation-delay: 0.4s; }
        .form-group:nth-child(4) { animation-delay: 0.5s; }
        .form-group:nth-child(5) { animation-delay: 0.6s; }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 0.9rem;
            color: #a0a0a0;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 15px 20px;
            background: #252540;
            border: 2px solid #3a3a5c;
            border-radius: 10px;
            color: white;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #8b5cf6;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.2);
        }

        .form-group input::placeholder {
            color: #6a6a8a;
        }

        .form-group select option {
            background: #252540;
            color: white;
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

        .role-selection {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }

        .role-card {
            background: #252540;
            border: 2px solid #3a3a5c;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .role-card:hover {
            border-color: #8b5cf6;
            transform: translateY(-2px);
        }

        .role-card.selected {
            border-color: #8b5cf6;
            background: rgba(139, 92, 246, 0.2);
        }

        .role-card i {
            font-size: 2rem;
            color: #8b5cf6;
            margin-bottom: 10px;
        }

        .role-card h4 {
            color: white;
            font-size: 1rem;
            margin-bottom: 5px;
        }

        .role-card p {
            color: #a0a0a0;
            font-size: 0.8rem;
            margin: 0;
        }

        .role-card input {
            display: none;
        }

        .register-btn {
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
            animation: fadeInUp 0.6s ease 0.7s both;
        }

        .register-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(139, 92, 246, 0.4);
        }

        .register-btn:active {
            transform: translateY(0);
        }

        .login-link {
            text-align: center;
            margin-top: 30px;
            color: #a0a0a0;
            font-size: 0.9rem;
            animation: fadeInUp 0.6s ease 0.8s both;
        }

        .login-link a {
            color: #8b5cf6;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        /* Right Side - Purple Illustration */
        .register-right {
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

        .register-right::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -100px;
            right: -100px;
        }

        .register-right::after {
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
        }

        /* Alert Styles */
        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 25px;
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.2);
            border: 1px solid #ef4444;
            color: #fca5a5;
        }

        .alert-info {
            background: rgba(59, 130, 246, 0.2);
            border: 1px solid #3b82f6;
            color: #93c5fd;
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

        /* Responsive */
        @media (max-width: 968px) {
            body {
                flex-direction: column;
            }

            .register-left,
            .register-right {
                width: 100%;
                min-height: 50vh;
            }

            .register-right {
                display: none;
            }

            .role-selection {
                grid-template-columns: 1fr;
            }
        }

        /* Info Box */
        .info-box {
            margin-top: 25px;
            padding: 20px;
            background: rgba(139, 92, 246, 0.1);
            border-radius: 10px;
            border: 1px solid rgba(139, 92, 246, 0.3);
            animation: fadeInUp 0.6s ease 0.9s both;
        }

        .info-box h4 {
            color: #8b5cf6;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        .info-box ul {
            color: #a0a0a0;
            font-size: 0.85rem;
            padding-left: 20px;
            margin: 0;
        }

        .info-box li {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <!-- Left Side - Register Form -->
    <div class="register-left">
        <div class="register-form-container">
            <h1>Create Account</h1>
            <p>Join our student portal today</p>

            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i> 
                    <ul style="margin: 10px 0 0 20px; padding: 0;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> 
                <strong>Note:</strong> Admin account cannot be created here. Contact system administrator.
            </div>

            <form action="{{ route('register') }}" method="POST" id="registerForm">
                @csrf
                
                <div class="form-group">
                    <label for="nama">
                        <i class="fas fa-user"></i> Full Name
                    </label>
                    <input type="text" 
                           name="nama" 
                           id="nama" 
                           placeholder="Enter your full name"
                           required 
                           autofocus
                           value="{{ old('nama') }}">
                </div>

                <div class="form-group">
                    <label for="email">
                        <i class="fas fa-envelope"></i> Email
                    </label>
                    <input type="email" 
                           name="email" 
                           id="email" 
                           placeholder="nama@sekolah.com"
                           required 
                           value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label>
                        <i class="fas fa-user-tag"></i> Select Role
                    </label>
                    <div class="role-selection">
                        <label class="role-card {{ old('role') == 'guru' ? 'selected' : '' }}">
                            <input type="radio" name="role" value="guru" {{ old('role') == 'guru' ? 'checked' : '' }} onchange="selectRole(this)">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <h4>Guru</h4>
                            <p>Teacher Account</p>
                        </label>
                        <label class="role-card {{ old('role') == 'siswa' ? 'selected' : '' }}">
                            <input type="radio" name="role" value="siswa" {{ old('role') == 'siswa' ? 'checked' : '' }} onchange="selectRole(this)">
                            <i class="fas fa-user-graduate"></i>
                            <h4>Siswa</h4>
                            <p>Student Account</p>
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">
                        <i class="fas fa-lock"></i> Password
                    </label>
                    <div class="password-wrapper">
                        <input type="password" 
                               name="password" 
                               id="password" 
                               placeholder="Minimum 6 characters"
                               required>
                        <i class="fas fa-eye toggle-password" onclick="togglePassword('password', this)"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">
                        <i class="fas fa-lock"></i> Confirm Password
                    </label>
                    <div class="password-wrapper">
                        <input type="password" 
                               name="password_confirmation" 
                               id="password_confirmation" 
                               placeholder="Re-enter password"
                               required>
                        <i class="fas fa-eye toggle-password" onclick="togglePassword('password_confirmation', this)"></i>
                    </div>
                </div>

                <button type="submit" class="register-btn" id="registerBtn">
                    <span class="loading-spinner" id="spinner"></span>
                    <span id="btnText">Create Account</span>
                </button>
            </form>

            <div class="login-link">
                Already have an account? <a href="{{ route('login') }}">Login here</a>
            </div>

            <div class="info-box">
                <h4><i class="fas fa-shield-alt"></i> Account Types</h4>
                <ul>
                    <li><strong>Guru:</strong> Can manage student complaints and give feedback</li>
                    <li><strong>Siswa:</strong> Can submit complaints and view status</li>
                    <li><strong>Admin:</strong> Full access (contact administrator)</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Right Side - Illustration -->
    <div class="register-right">
        <div class="welcome-text">
            <h2>Join Our<br>School Community</h2>
            <p>Create your account to get started</p>
        </div>
        <div class="illustration">
            <!-- SVG Illustration -->
            <svg viewBox="0 0 500 400" xmlns="http://www.w3.org/2000/svg">
                <!-- Background Elements -->
                <circle cx="250" cy="200" r="150" fill="rgba(255,255,255,0.1)"/>
                <circle cx="300" cy="150" r="80" fill="rgba(255,255,255,0.05)"/>
                
                <!-- Person with Book -->
                <g transform="translate(200, 150)">
                    <circle cx="50" cy="40" r="25" fill="white"/>
                    <path d="M50 65 L50 120" stroke="white" stroke-width="10" stroke-linecap="round"/>
                    <path d="M50 75 L20 90" stroke="white" stroke-width="10" stroke-linecap="round"/>
                    <path d="M50 75 L80 90" stroke="white" stroke-width="10" stroke-linecap="round"/>
                    <path d="M50 120 L35 160" stroke="white" stroke-width="10" stroke-linecap="round"/>
                    <path d="M50 120 L70 160" stroke="white" stroke-width="10" stroke-linecap="round"/>
                    <!-- Book -->
                    <rect x="30" y="85" width="40" height="30" rx="3" fill="white" opacity="0.9"/>
                    <line x1="50" y1="85" x2="50" y2="115" stroke="#8b5cf6" stroke-width="2"/>
                </g>
                
                <!-- Graduation Cap -->
                <g transform="translate(350, 100)">
                    <polygon points="0,30 50,10 100,30 50,50" fill="white" opacity="0.9"/>
                    <rect x="45" y="30" width="10" height="40" stroke="white" stroke-width="3" fill="none"/>
                    <circle cx="50" cy="70" r="5" fill="white"/>
                </g>
                
                <!-- Decorative Elements -->
                <circle cx="100" cy="100" r="30" fill="rgba(255,255,255,0.1)"/>
                <circle cx="400" cy="300" r="50" fill="rgba(255,255,255,0.05)"/>
                
                <!-- Stars -->
                <g fill="white" opacity="0.6">
                    <polygon points="150,50 155,65 170,65 158,75 163,90 150,80 137,90 142,75 130,65 145,65"/>
                    <polygon points="380,80 383,90 393,90 385,97 388,107 380,100 372,107 375,97 367,90 377,90"/>
                </g>
            </svg>
        </div>
    </div>

    <script>
        // Toggle Password Visibility
        function togglePassword(inputId, icon) {
            const passwordInput = document.getElementById(inputId);
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Role Selection Styling
        function selectRole(radio) {
            document.querySelectorAll('.role-card').forEach(card => {
                card.classList.remove('selected');
            });
            radio.closest('.role-card').classList.add('selected');
        }

        // Form Submit with Loading
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const btn = document.getElementById('registerBtn');
            const spinner = document.getElementById('spinner');
            const btnText = document.getElementById('btnText');
            
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Password confirmation does not match!');
                return;
            }
            
            btn.disabled = true;
            spinner.style.display = 'inline-block';
            btnText.textContent = 'Creating Account...';
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

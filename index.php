<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация и регистрация</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .container {
            display: flex;
            flex-direction: column;
            gap: 30px;
            width: 100%;
            max-width: 400px;
        }
        
        .form-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            padding: 30px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .form-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }
        
        .form-header {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }
        
        .form-header h2 {
            font-size: 28px;
            margin-bottom: 10px;
            color: #6e8efb;
        }
        
        .form-header p {
            color: #777;
            font-size: 14px;
        }
        
        .input-group {
            margin-bottom: 20px;
            position: relative;
        }
        
        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }
        
        .input-group input {
            width: 100%;
            padding: 15px 15px 15px 45px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        .input-group input:focus {
            border-color: #6e8efb;
            box-shadow: 0 0 0 2px rgba(110, 142, 251, 0.2);
            outline: none;
        }
        
        .btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(to right, #6e8efb, #a777e3);
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn:hover {
            background: linear-gradient(to right, #5d7ce0, #9666d3);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        
        .tab {
            padding: 12px 25px;
            background: rgba(255, 255, 255, 0.7);
            border: none;
            border-radius: 8px 8px 0 0;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin: 0 5px;
        }
        
        .tab.active {
            background: white;
            color: #6e8efb;
            box-shadow: 0 -3px 10px rgba(0, 0, 0, 0.1);
        }
        
        .form-section {
            display: none;
        }
        
        .form-section.active {
            display: block;
        }
        
        .message {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            display: none;
        }
        
        .error {
            background: #ffebee;
            color: #d32f2f;
            border: 1px solid #ffcdd2;
        }
        
        .success {
            background: #e8f5e9;
            color: #388e3c;
            border: 1px solid #c8e6c9;
        }
        
        .form-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }
        
        .form-footer a {
            color: #6e8efb;
            text-decoration: none;
            transition: color 0.3s ease;
            cursor: pointer;
        }
        
        .form-footer a:hover {
            color: #a777e3;
            text-decoration: underline;
        }
        
        .email-status {
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }
        
        .email-status.available {
            color: #388e3c;
        }
        
        .email-status.taken {
            color: #d32f2f;
        }
        
        @media (max-width: 480px) {
            .form-container {
                padding: 20px;
            }
            
            .tab {
                padding: 10px 15px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="tabs">
                <button class="tab active" data-tab="login">Вход</button>
                <button class="tab" data-tab="register">Регистрация</button>
            </div>
            
            <div id="message" class="message"></div>
            
            <div class="form-section active" id="login-section">
                <div class="form-header">
                    <h2>Вход в систему</h2>
                    <p>Введите ваши учетные данные</p>
                </div>
                
                <form id="loginForm">
                    <div class="input-group">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Логин" name="login" required>
                    </div>
                    
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Пароль" name="pass" required>
                    </div>
                    
                    <button type="submit" class="btn">Войти</button>
                </form>
                
                <div class="form-footer">
                    Нет аккаунта? <a id="showRegister">Зарегистрируйтесь здесь</a>
                </div>
            </div>
            
            <div class="form-section" id="register-section">
                <div class="form-header">
                    <h2>Регистрация</h2>
                    <p>Создайте новый аккаунт</p>
                </div>
                
                <form id="registerForm">
                    <div class="input-group">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Логин" name="login" id="regLogin" required>
                    </div>
                    
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Пароль" name="pass" id="password" required>
                    </div>
                    
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Повторите пароль" name="repeatpass" id="repeatPassword" required>
                    </div>
                    
                    <div class="input-group">
                        <i class="fas fa-envelope"></i>
                        <input type="email" placeholder="Email" name="email" id="email" required>
                        <div id="emailStatus" class="email-status"></div>
                    </div>
                    
                    <button type="submit" class="btn">Зарегистрироваться</button>
                </form>
                
                <div class="form-footer">
                    Уже есть аккаунт? <a id="showLogin">Войдите здесь</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Переключение между вкладками
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.form-section').forEach(s => s.classList.remove('active'));
                
                this.classList.add('active');
                document.getElementById(this.dataset.tab + '-section').classList.add('active');
                
                // Очистка сообщений при переключении
                document.getElementById('message').style.display = 'none';
            });
        });
        
        // Переключение на форму регистрации
        document.getElementById('showRegister').addEventListener('click', function() {
            document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.form-section').forEach(s => s.classList.remove('active'));
            
            document.querySelector('[data-tab="register"]').classList.add('active');
            document.getElementById('register-section').classList.add('active');
            
            // Очистка сообщений при переключении
            document.getElementById('message').style.display = 'none';
        });
        
        // Переключение на форму входа
        document.getElementById('showLogin').addEventListener('click', function() {
            document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.form-section').forEach(s => s.classList.remove('active'));
            
            document.querySelector('[data-tab="login"]').classList.add('active');
            document.getElementById('login-section').classList.add('active');
            
            // Очистка сообщений при переключении
            document.getElementById('message').style.display = 'none';
        });
        
        // Проверка доступности email
        document.getElementById('email').addEventListener('blur', function() {
            const email = this.value;
            const emailStatus = document.getElementById('emailStatus');
            
            if (!email) {
                emailStatus.style.display = 'none';
                return;
            }
            
            // Проверяем валидность email
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                emailStatus.textContent = 'Неверный формат email';
                emailStatus.className = 'email-status taken';
                emailStatus.style.display = 'block';
                return;
            }
            
            // Проверяем доступность email
            fetch('check_email.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'email=' + encodeURIComponent(email)
            })
            .then(response => response.json())
            .then(data => {
                if (data.available) {
                    emailStatus.textContent = 'Email доступен';
                    emailStatus.className = 'email-status available';
                } else {
                    emailStatus.textContent = 'Email уже зарегистрирован';
                    emailStatus.className = 'email-status taken';
                }
                emailStatus.style.display = 'block';
            })
            .catch(error => {
                console.error('Ошибка:', error);
            });
        });
        
        // Валидация паролей при регистрации
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const password = document.getElementById('password').value;
            const repeatPassword = document.getElementById('repeatPassword').value;
            const emailStatus = document.getElementById('emailStatus');
            const message = document.getElementById('message');
            
            // Проверяем, что email доступен
            if (emailStatus.classList.contains('taken')) {
                message.textContent = 'Email уже зарегистрирован!';
                message.className = 'message error';
                message.style.display = 'block';
                message.scrollIntoView({ behavior: 'smooth' });
                return;
            }
            
            if (password !== repeatPassword) {
                message.textContent = 'Пароли не совпадают!';
                message.className = 'message error';
                message.style.display = 'block';
                message.scrollIntoView({ behavior: 'smooth' });
                return;
            }
            
            // Если все проверки пройдены, отправляем форму
            const formData = new FormData(this);
            
            fetch('register.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data.includes('Успешная регистрация')) {
                    message.textContent = data;
                    message.className = 'message success';
                    message.style.display = 'block';
                    
                    // Переключение на форму входа после успешной регистрации
                    setTimeout(() => {
                        document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                        document.querySelectorAll('.form-section').forEach(s => s.classList.remove('active'));
                        document.querySelector('[data-tab="login"]').classList.add('active');
                        document.getElementById('login-section').classList.add('active');
                        message.style.display = 'none';
                        this.reset();
                    }, 2000);
                } else {
                    message.textContent = data;
                    message.className = 'message error';
                    message.style.display = 'block';
                }
            })
            .catch(error => {
                message.textContent = 'Ошибка сети: ' + error;
                message.className = 'message error';
                message.style.display = 'block';
            });
        });
        
        // Обработка входа
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const message = document.getElementById('message');
            
            fetch('login.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data.includes('Добро пожаловать')) {
                    message.textContent = data;
                    message.className = 'message success';
                    message.style.display = 'block';
                    
                    // Перенаправление или другие действия после успешного входа
                    setTimeout(() => {
                        alert('Успешный вход! Перенаправление на главную страницу...');
                        // window.location.href = 'dashboard.php'; // Раскомментируйте для перенаправления
                    }, 1000);
                } else {
                    message.textContent = data;
                    message.className = 'message error';
                    message.style.display = 'block';
                }
            })
            .catch(error => {
                message.textContent = 'Ошибка сети: ' + error;
                message.className = 'message error';
                message.style.display = 'block';
            });
        });
    </script>
</body>
</html>
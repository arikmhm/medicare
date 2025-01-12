<?php session_start() ?>

<?php
    if (isset($_POST['username'])) {
        require "fungsi.php";
        $username = $_POST['username'];
        $passw = $_POST['passw'];
        
        $stmt = $koneksi->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $passw);
        $stmt->execute();
        $hasil = $stmt->get_result();
        
        if ($hasil->num_rows > 0) {
            $_SESSION['username'] = $username;
            header("location:dashboard.php");
        }
        $stmt->close();
    }
?>
    
<!DOCTYPE html>
<html>
<head>
    <title>MediCare - Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="bootstrap4/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #43C6AC 0%, #191654 100%);
        }

        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            padding: 2.5rem;
        }

        .brand-section {
            text-align: center;
            margin-bottom: 2rem;
        }

        .brand-text {
            font-size: 2.5rem;
            font-weight: 700;
            color: #43C6AC;
            margin-bottom: 0.5rem;
        }

        .brand-subtext {
            color: #191654;
            font-size: 1rem;
            font-weight: 500;
        }

        .welcome-text {
            color: #4a5568;
            text-align: center;
            margin-bottom: 2rem;
            font-size: 1.1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            color: #4a5568;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #43C6AC;
            box-shadow: 0 0 0 3px rgba(67, 198, 172, 0.1);
            outline: none;
        }

        .password-field {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #718096;
        }

        .btn-login {
            width: 100%;
            padding: 0.75rem;
            background: #43C6AC;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: #191654;
            transform: translateY(-1px);
        }

        .alert {
            margin-bottom: 1.5rem;
            border-radius: 8px;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="card">
                        <div class="brand-section">
                            <div class="brand-text">MediCare</div>
                            <div class="brand-subtext">Healthcare Management System</div>
                        </div>

                        <?php if(isset($_POST['username']) && !isset($_SESSION['username'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            Login gagal. Silahkan coba lagi.
                        </div>
                        <?php endif; ?>

                        <form method="post" action="">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input class="form-control" type="text" name="username" id="username" 
                                       placeholder="Masukkan username" required autofocus>
                            </div>
                            
                            <div class="form-group">
                                <label for="passw">Password</label>
                                <div class="password-field">
                                    <input class="form-control" type="password" name="passw" id="passw" 
                                           placeholder="Masukkan password" required>
                                    <span class="password-toggle" onclick="togglePassword()">
                                        <i class="far fa-eye"></i>
                                    </span>
                                </div>
                            </div>

                            <button class="btn-login" type="submit">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="bootstrap4/jquery/3.3.1/jquery-3.3.1.js"></script>
    <script src="bootstrap4/js/bootstrap.js"></script>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('passw');
            const toggleIcon = document.querySelector('.password-toggle i');
            
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
    </script>
</body>
</html>
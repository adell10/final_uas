<?php
session_start();
include 'config.php';

$message = '';

if (isset($_SESSION['login_message'])) {
    $message = $_SESSION['login_message'];
    unset($_SESSION['login_message']); 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) >= 1) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];

            if (isset($_SESSION['redirect_to'])) {
                $go = $_SESSION['redirect_to'];
                unset($_SESSION['redirect_to']);
                header("Location: $go");
            } else {
                header("Location: index.php");
            }
            exit();
        } else {
            $message = "Password salah!";
        }
    } else {
        $message = "Username tidak ditemukan!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAMERRA - Sign In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/488d622bc0.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Inria+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            background: #fef9e1;
            min-height: 100vh;
            font-family: 'Inria Sans', sans-serif;
        }
        
        .signin-container {
            background-color: #6d2323;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        
        .signin-header {
            color: #fef9e1;
            font-family: "Anton", sans-serif;
            font-size: 4rem;
            font-weight: normal;
            text-align: left;
            margin-bottom: 2rem;
        }
        
        .form-control {
            background-color: #fef9e1;
            border: none;
            border-radius: 10px;
            height: 53px;
            font-size: 1.875rem;
            color: #6d2323;
            padding-left: 20px;
        }
        
        .form-control::placeholder {
            color: #6d2323;
            opacity: 1;
            font-size: 1.875rem;
        }
        
        .form-control:focus {
            background-color: #fef9e1;
            border-color: #fef9e1;
            box-shadow: 0 0 0 0.2rem rgba(254, 249, 225, 0.25);
            color: #6d2323;
        }
        
        .btn-signin {
            background-color: #fef9e1;
            color: #6d2323;
            border: none;
            border-radius: 50px;
            width: 187px;
            height: 47px;
            font-size: 1.875rem;
            font-weight: normal;
            font-family: 'Inria Sans', sans-serif;
        }
        
        .btn-signin:hover {
            background-color: #f0e8c8;
            color: #6d2323;
        }
        
        .signin-link {
            color: #fef9e1;
            font-size: 1.5rem;
            text-decoration: underline;
        }
        
        .signin-link:hover {
            color: #fef9e1;
            text-decoration: underline;
        }
        
        .alert-custom {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid #fef9e1;
            color: #fef9e1;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row w-100 justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="signin-container p-5">
                    <h1 class="signin-header">Sign In</h1>
                    
                    <?php if (!empty($message)): ?>
                        <div class="alert alert-custom text-center mb-4" role="alert">
                            <?= htmlspecialchars($message) ?>
                        </div>
                    <?php endif; ?>
                    
                    <form method="POST" action="">
                        <div class="mb-4">
                            <input type="text" 
                                   class="form-control" 
                                   name="username" 
                                   placeholder="Username" 
                                   required>
                        </div>
                        
                        <div class="mb-4">
                            <input type="password" 
                                   class="form-control" 
                                   name="password" 
                                   placeholder="Password" 
                                   required>
                        </div>
                        
                        <div class="d-flex justify-content-center mb-4">
                            <button type="submit" class="btn btn-signin">Sign In</button>
                        </div>
                    </form>

                    <div class="text-center">
                        <p class="mb-0">
                            <span style="color: #fef9e1; font-size: 1.5rem;">Belum punya akun? </span>
                            <a href="signup.php" class="signin-link">Sign Up</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
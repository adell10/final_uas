<?php
include 'config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username     = $_POST['username'];
    $email        = $_POST['email'];
    $password     = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, password, email) 
            VALUES ('$username', '$password', '$email')";

    if (mysqli_query($conn, $query)) {
        $message = "Registrasi berhasil!";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAMERRA - Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Inria+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            background: #fef9e1;
            min-height: 100vh;
            font-family: 'Inria Sans', sans-serif;
        }
        
        .signup-container {
            background-color: #6d2323;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        
        .signup-header {
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
        
        .btn-signup {
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
        
        .btn-signup:hover {
            background-color: #f0e8c8;
            color: #6d2323;
        }
        
        .signup-link {
            color: #fef9e1;
            font-size: 1.5rem;
            text-decoration: underline;
        }
        
        .signup-link:hover {
            color: #fef9e1;
            text-decoration: underline;
        }
        
        .alert-custom {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid #fef9e1;
            color: #fef9e1;
            border-radius: 10px;
        }
        
        .alert-success-custom {
            background-color: rgba(0, 255, 0, 0.1);
            border: 1px solid #28a745;
            color: #28a745;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row w-100 justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="signup-container p-5">
                    <h1 class="signup-header">Sign Up</h1>
                    
                    <?php if (!empty($message)): ?>
                        <?php if (strpos($message, 'berhasil') !== false): ?>
                            <div class="alert alert-success-custom text-center mb-4" role="alert">
                                <?= htmlspecialchars($message) ?>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-custom text-center mb-4" role="alert">
                                <?= htmlspecialchars($message) ?>
                            </div>
                        <?php endif; ?>
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
                            <input type="email" 
                                   class="form-control" 
                                   name="email" 
                                   placeholder="Email" 
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
                            <button type="submit" class="btn btn-signup">Sign Up</button>
                        </div>
                    </form>

                    <div class="text-center">
                        <p class="mb-0">
                            <span style="color: #fef9e1; font-size: 1.5rem;">Already Registered? </span>
                            <a href="signin.php" class="signup-link">Sign In</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
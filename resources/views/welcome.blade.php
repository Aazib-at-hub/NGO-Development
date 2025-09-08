<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>NGO SIGNUP</title>
        
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
        
        <!-- Auto redirect to register page -->
        <meta http-equiv="refresh" content="3;url={{ route('register') }}">
        
        <style>
            body {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-family: 'Arial', sans-serif;
            }
            .redirect-container {
                text-align: center;
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
                border-radius: 15px;
                padding: 3rem;
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            }
            .spinner-border {
                width: 3rem;
                height: 3rem;
            }
            .fade-in {
                animation: fadeIn 0.8s ease-in;
            }
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }
        </style>
    </head>
    <body>
        <div class="redirect-container fade-in">
            <div class="mb-4">
                <i class="bi bi-heart-fill text-danger" style="font-size: 4rem;"></i>
            </div>
            <h1 class="h2 mb-3">Welcome to NGO SIGNUP</h1>
            <p class="lead mb-4"></p>
            
            <div class="mb-4">
                <div class="spinner-border text-light" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            
            <p class="mb-3">Redirecting you to registration...</p>
            <p class="small text-light">You will be redirected automatically in 3 seconds</p>
            
            <div class="mt-4">
                <a href="{{ route('register') }}" class="btn btn-light btn-lg me-3">
                    <i class="bi bi-person-plus me-2"></i>Register Now
                </a>
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Login
                </a>
            </div>
        </div>
        
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>

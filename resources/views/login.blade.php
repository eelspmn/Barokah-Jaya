<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Barokah Jaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .login-card { border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); border: none; }
        .btn-google {
            background-color: white; color: #757575; border: 1px solid #ddd; border-radius: 8px; font-weight: 500;
        }
        .btn-google:hover { background-color: #f1f3f4; border-color: #d2d2d2; color: #757575; }
        .btn-dark { border-radius: 8px; padding: 12px; }
        .form-control { border-radius: 8px; padding: 12px; }
        .divider { display: flex; align-items: center; text-align: center; color: #6c757d; margin: 20px 0; }
        .divider::before, .divider::after { content: ""; flex: 1; border-bottom: 1px solid #dee2e6; }
        .divider:not(:empty)::before { margin-right: 1em; }
        .divider:not(:empty)::after { margin-left: 1em; }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card login-card p-4 p-md-5" style="max-width: 450px; width: 100%;">
        
        <div class="text-center mb-4">
            <h2 class="fw-bolder">Welcome Back</h2>
            <p class="text-muted">Welcome back! Please enter your details.</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger rounded-3 p-2 small text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="/login" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email" required autofocus>
            </div>
            
            <div class="mb-4">
                <label class="form-label fw-semibold">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
            </div>
            
            <div class="d-flex justify-content-between mb-4 small">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label text-muted" for="remember">Remember me</label>
                </div>
                </div>

            <button type="submit" class="btn btn-dark w-100 fw-bold shadow-sm">Sign In</button>
        </form>

        <div class="divider">or</div>

        <a href="{{ route('google.login') }}" class="btn btn-google w-100 py-2 d-flex align-items-center justify-content-center gap-2 mb-4">
            <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" width="20" alt="Google">
            Sign In with Google
        </a>
        
        </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
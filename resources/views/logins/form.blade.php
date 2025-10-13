<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MovieHub</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            padding: 2rem;
        }
    </style>
</head>
<body class="bg-dark text-light">

    <div class="card login-card bg-black border-secondary">
        <div class="card-body">
            <h1 class="text-center text-warning mb-4">
                <i class="fas fa-film"></i> MovieHub Login
            </h1>

            <form action="{{ route('logins.login') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control bg-secondary text-white border-dark" id="email" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control bg-secondary text-white border-dark" id="password" name="password" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </button>
                </div>

                @error('credentials')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                @enderror
            </form>
        </div>
    </div>

</body>
</html>
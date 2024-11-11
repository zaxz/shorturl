<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Short URL | Register</title>
    <link rel="stylesheet" href="styles/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="styles/style.css">
    <script src="styles/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container px-md-5">
        <div class="row d-flex justify-content-center mt-5">
            <div class="col-8 col-md-6">
                <div class="card mb-3 mx-auto">
                    <div class="card-header">
                        <div class="py-2">
                            <h3 class="text-center fw-bold">Create Account</h3>
                            <form action="{{ route('register') }}" method="POST">
                                @csrf
                                <label for="username" class="text-secondary">Username</label>
                                <input type="text" name="username" class="form-control" required>
                                <label for="password" class="text-secondary">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                                <label for="confPassword" class="text-secondary">Confirm Password</label>
                                <input type="password" name="confPassword" id="confPassword" class="form-control" required>
                                <div id="pwWarning" class="form-text text-danger " style="display: none;">
                                    Passwords do not match.
                                </div>
                                <button type="submit" id="btn" class="btn btn-dark w-100 mt-2 disabled">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const password = document.getElementById('password');
        const confPassword = document.getElementById('confPassword')
        const warning = document.getElementById('pwWarning')
        const button = document.getElementById('btn')

        confPassword.addEventListener('input',()=>{
            if (confPassword.value !== password.value) {
                warning.style.display = 'block'
                confPassword.classList.add('is-invalid')
            } else {
                warning.style.display = 'none'
                confPassword.classList.remove('is-invalid')
                button.classList.remove('disabled')
            }
        })
    </script>
</body>

</html>

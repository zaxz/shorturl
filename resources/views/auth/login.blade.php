<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Short URL | Login</title>
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
                            <h3 class="text-center fw-bold">Login</h3>
                            <form action="{{ route('loginUser') }}" method="POST">
                                @csrf
                                <label for="username" class="text-secondary">Username</label>
                                <input type="text" name="username" class="form-control" required>
                                <label for="password" class="text-secondary">Password</label>
                                <input type="text" name="password" class="form-control" required>
                                <button type="submit" class="btn btn-dark w-100 mt-2">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

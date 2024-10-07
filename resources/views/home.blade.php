<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/style.css">
    <script src="styles/bootstrap/js/bootstrap.min.js"></script>
    <title>Short URL</title>
</head>

<body>
    <div class="container w-md-75 px-md-5">
        <h1 class="ea text-center judul my-5">Short URL</h1>
        @if (session('success'))
            <div class="alert alert-primary">{{ session('success') }}</div>
        @endif
        <div class="card mb-3">
            <div class="card-header text-center">
                <form action="{{ route('generate.shorturl') }}" method="post">
                    @csrf
                    <h2 class="pt-2">Paste the URL to be shortened</h2>
                    <div class="container">
                        <input type="text" name="link" class="form-control" placeholder="Enter URL">
                        <button type="submit" class="btn btn-dark w-100 ">Generate</button>
                        <br>
                        <br>
                        @if (session('success'))
                            <div>
                                <h2 class="">Here it is!</h2>
                                <div class="input-group">
                                    <input id="shortlink" type="text" class="form-control"
                                        value="{{ session('shortlink') }}">
                                    <div class="input-group-addon">
                                        <button type="button" class="btn btn-dark " onclick="copyToClipboard()">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-clipboard" viewBox="0 0 16 16">
                                                <path
                                                    d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z" />
                                                <path
                                                    d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z" />
                                            </svg>
                                        </button>
                                    </div>
                                    <script>
                                        function copyToClipboard() {
                                            let shortlink = document.getElementById("shortlink");
                                            shortlink.select();
                                            navigator.clipboard.writeText(shortlink.value);
                                            alert("Copied : " + shortlink.value);
                                        }
                                    </script>
                                </div>
                            </div>
                        @endif
                    </div>
                    @error('link')
                        <p class="m-0 p-0 text-danger">{{ $message }}</p>
                    @enderror
                </form>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Short Link</th>
                        <th>Link</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shortlinks as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td><a href="{{ route('shorten.link', $row->code) }}"
                                    target="_blank">{{ route('shorten.link', $row->code) }}</a></td>
                            <td>{{ $row->link }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>

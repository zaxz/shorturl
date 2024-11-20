<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Short URL | Jeki's Here</title>
    <link rel="stylesheet" href="styles/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/style.css">
    <script src="styles/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="d-flex justify-content-end gap-2 m-3">
        @auth
            <button class="btn btn-dark" disabled>{{ auth()->user()->username }}</button>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-dark">Logout</button>
            </form>
        @else
            <a href="/login" class="btn border-2 border-dark">Login</a>
            <a href="/register" class="btn btn-dark">Sign Up</a>
        @endauth
    </div>
    <div class="container position-relative w-md-75 px-md-5">
        <h1 class="ea text-center judul my-4">Short URL</h1>
        @if (session('success'))
            <div class="alert alert-primary">{{ session('success') }}</div>
        @endif
        <div class="card mb-3">
            <div class="card-header text-center p-3">
                <form action="{{ route('generate') }}" method="post">
                    @csrf
                    <h2 class="">Paste the URL to be shortened</h2>
                    <input type="text" name="inputUrl" class="form-control" placeholder="Enter URL"
                        value="{{ old('inputUrl') }}">
                    @auth
                        <div class="input-group">
                            <span class="input-group-text">{{ url('/') }}/</span>
                            <input type="text" name="customUrl" class="form-control" placeholder="Enter custom URL">
                        </div>
                    @else
                        <h5 class="mx-auto mt-3 text-secondary">Login to access custom URL</h5>
                        <div class="input-group">
                            <span class="input-group-text text-secondary">{{ route('generate') }}/</span>
                            <input type="text" name="customUrl" class="form-control text-secondary"
                                placeholder="Enter custom URL" disabled>
                        </div>
                    @endauth
                    @error('customUrl')
                        <p class="m-0 p-0 text-danger">{{ $message }}</p>
                    @enderror
                    <button type="submit" class="btn btn-dark w-100 mt-2">Generate</button>

                    @if (session('success'))
                        <div>
                            <h2 class="">Here it is!</h2>
                            <div class="input-group">
                                <input id="shortUrl" type="text" class="form-control"
                                    value="{{ session('shortened') }}">
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
                                        let shortUrl = document.getElementById("shortUrl");
                                        shortUrl.select();
                                        navigator.clipboard.writeText(shortUrl.value);
                                        alert("Copied : " + shortUrl.value);
                                    }
                                </script>
                            </div>
                            <p class="text-start pt-2">Original URL : <a href="{{ session('ori_url') }}"
                                    target="_blank">{{ session('ori_url') }}</a></p>
                        </div>
                    @endif
                    @error('url')
                        <p class="m-0 p-0 text-danger">{{ $message }}</p>
                    @enderror
                </form>
            </div>
        </div>
        @auth
            <div class="table-responsive ">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Short URL</th>
                            <th>URL</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_url as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><a href="{{ route('shortened.url', $row->code) }}"
                                        target="_blank">{{ route('shortened.url', $row->code) }}</a></td>
                                <td>{{ $row->url }}</td>
                                <td class="text-center">
                                    <div class="d-flex gap-1">
                                        <form action="{{ route('shorturl.edit') }}" method="get">
                                            @csrf
                                            <button class="btn btn-primary"><img src="assets/pencil-square.svg"></button>
                                        </form>
                                        <form action="{{ route('shorturl.delete', $data_url->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger"><img src="assets/trash.svg"></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endauth
    </div>
</body>

</html>

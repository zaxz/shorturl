<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <title>Shorten Link</title>
    <style>
        .text{
            font-size: 100px !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center text">Short URL</h1>
        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="card ">
            <div class="card-header ">
                <form action="{{ route('generate.shorturl')}}" method="post">
                    @csrf
                    <div class="input-group mb-3 ">
                        <input type="text" name="link" class="form-control" placeholder="Enter URL">
                        <div class="input-group-addon">
                            <button class="btn btn-success">Generate</button>
                        </div>
                        <br>
                    </div>
                    @error('link')
                        <p class="m-0 p-0 text-danger">{{$message}}</p>
                    @enderror
                </form>
            </div>
        </div>
        <table class="table table-bordered">
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
                        <td>{{ $row->id}}</td>
                        <td><a href="{{route('shorten.link',$row->code)}}" target="_blank">{{route('shorten.link',$row->code)}}</a></td>
                        <td>{{ $row->link }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
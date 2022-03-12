<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h2>{{ $post->title }} is created</h2>
    <p>{{ $post->excerpt }}</p>
    <a href="{{ route('post.detail', $post->slug) }}" class="btn btn-primary">View Post</a>
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    {{-- trang index {{ $channels->name_channel }} --}}

    @foreach($channels as $post)
        <div>
            <h2>{{ $post->name_channel }}</h2>
            <p>{{ $post->image_channel }}</p>
        </div>
    @endforeach
</body>
</html>
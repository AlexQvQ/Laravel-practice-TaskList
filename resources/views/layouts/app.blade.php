<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Document</title>
    @yield('styles')
</head>
<body>
    <div>
        @if (session() -> has('success'))
        <div>{{ session('success')}}</div>
        @endif
    </div>
    @yield("content")
</body>
</html>

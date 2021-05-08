<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>About</title>
</head>
<body>
    <div>

        <a href={{url('/')}}>Home</a> |
        <a href={{URL::to('/about')}}>About</a> |
        <a href={{route('con')}}>Contact</a>
        {{-- //route is SEO friendly and it's better to use --}}

        <h1>welcome to about page</h1>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolor tenetur voluptate assumenda, veritatis quo fugit quas magni vitae? Quia atque reprehenderit quidem recusandae sapiente autem dolore maiores error ducimus fuga.</p>
    </div>
</body>
</html>

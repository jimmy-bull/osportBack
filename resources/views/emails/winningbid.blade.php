<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300&display=swap" rel="stylesheet">

    <title>Vite App</title>
</head>

<body style="padding: 0;margin:0;font-family: 'Oswald', sans-serif;">
    <style>
        :root {
            --base-color: #007aff;
            --bs-menu-bg: #30A0E0;
            --bs-menu-alt-bg: #00B0A0;
        }

    </style>
    <div>
        {{-- <h1>Hello {{ dd($data) }}</h1> --}}
        <h1>Hello sir {{ $data['user_name'] }} congratulation !</h1>
        <p>
            You won the {{ $data['article_name'] }}. Your Bid was: {{ $data['winning_price'] }}.
            <img width="300px" height="300px" src="{{ env('APP_URL') . '/' . $data['article_image'] }}" alt="image">
        </p>
        <h1>This are the seller information below: </h1>
        <ul>
            <ol>seller Name: {{ $data['seller_name'] }}</ol>
            <ol>seller Email: {{ $data['seller_email'] }}</ol>
            <ol>seller Number: {{ $data['seller_number'] }}</ol>
        </ul>
    </div>
</body>

</html>

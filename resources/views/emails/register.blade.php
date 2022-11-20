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

    <title>Register</title>
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
        <h1>Hello sir {{ $data['user_name'] }}, thanks for creating a account.</h1>
        <div>
            <p> Enter this code to confirm that you're the user of this account {{ $data['code'] }}</p>
            <h1>this link is only vailidate for 30 minutes.</h1>
        </div>
    </div>
</body>

</html>

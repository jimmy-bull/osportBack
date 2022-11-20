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
        <h1>Hi,</h1>
        <div>
            <p>Forgot your password ? Carefree ! It happens to everyone.</p>
            <h4>
                <a href="//{{ Request::getHost() }}/changepass/{{ $data['requestCode'] }}">
                    click here to change it
                </a>
            </h4>
            <h1>Please note this link is only valid for 30 minutes !</h1>
        </div>
    </div>
</body>

</html>

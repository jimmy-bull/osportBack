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
        <h1>Hello, </h1>
        <div>
            <p>
                You have just added a product from the brand: <strong> {{ $data['brand'] }}</strong>

                in the category : <strong> {{ $data['category'] }}</strong>

                this product is pending review.
            </p>
        </div>
    </div>
</body>

</html>

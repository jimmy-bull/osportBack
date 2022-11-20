<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <meta name="csrf-token"
        content="FO8NrbEjBKM73orM5NbemvwGiFyis8krYcy5MwAYz7BwkoWf1n09oMr6D36iFuHlSGOlFqOvoeWDsCntiIEOX8GZpIP3LglDbbCH">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <!--  {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300&display=swap" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" /> -->
    <!--  {{-- <script src="https://www.paypal.com/sdk/js?client-id=AeGtZH1e4okAoLkKLl8LYwBckgIyCCmxF2uSmKP9v1x8I_91oBuQkLWT2Em566nl9revcnGMpGOsSFnE"></script> --}} -->
    <title>Vite App</title>


</head>

<body style='padding: 0;margin:0;font-family: "Roboto", "Helvetica", "Arial", sans-serif'>
    <style>
        :root {
            --base-color: #007aff;
            --bs-menu-bg: #30A0E0;
            --bs-menu-alt-bg: #3f5251;
        }
    </style>
    <div id="root">
        <p id="tosee">some text</p>
        <input type="text" name="" id="totype" style="width:100%">
    </div>
    <script type="module" src="{{ asset('js/socket.js') }}"></script>
    <script src="{{ asset('js/dist/socket.io.min.js') }}"
        integrity="sha384-fKnu0iswBIqkjxrhQCTZ7qlLHOFEgNkRmK2vaO/LbTZSXdJfAu6ewRBdwHPhBo/H" crossorigin="anonymous">
    </script>
    <script>
        var socket = io('http://127.0.0.1:3000');
        document.getElementById('totype').onkeypress = function(e) {
            if (e.which === 13 && !e.shiftkey) {
                socket.emit("sendToServer", this.value)
            }
        }
        socket.on('sendToClient', (message) => {
            document.getElementById('tosee').textContent = message
        })
    </script>
    {{-- <script src="{{ mix('js/app.js') }}?<?php echo rand(); ?>" type="text/javascript"></script> --}}
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
</body>

</html>

<!doctype html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="/appweb/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" href="w3.css">
    <script>
        var si;

        function info() {
            $.ajax({
                url: 'info.php',
                type: 'post',
                success: function(response) {
                    // Perform operation on the return value
                    $('#dato').html(response);
                }
            });
        }

        function estado() {
            $.ajax({
                url: 'estado.php',
                type: 'post',
                success: function(response) {
                    // Perform operation on the return value
                    $('#estado').html(response);
                }
            });
        }

        function comando(cadena) {
            $.ajax({
                url: cadena,
                type: 'post',
                success: function(response) {
                    // Perform operation on the return value
                    $('#info').html(response);
                }
            });
            refresca();
        }

        function start() {
            comando("start.php");
        }

        function conectar() {
            comando("conectar.php");
        }

        function stop() {
            comando("stop.php");
            //setTimeout(clearInterval,1000,si);
        }

        function cargar() {
            comando("cargar.php");
        }

        function lista() {
            comando("lista.php");
        }

        function refresca() {
            setTimeout(info, 500);
        }

        function desactiva() {
            $(':button').prop('disabled', true); // Disable all the buttons
        }

        function activa() {
            $(':button').prop('disabled', false); // Enable all the button
        }

        function wactiva(tiempo) {
            setTimeout(activa, tiempo);
        }

        $(document).ready(function() {
            estado();
            info();
            //si = setInterval(info, 500);
            siestado = setInterval(estado, 500);
            $('#start').click(function() {
                desactiva();
                start();
                wactiva(1000);
                return false;
            });
            $('#stop').click(function() {
                desactiva();
                stop();
                wactiva(1000);
                return false;
            });
            $('#conectar').click(function() {
                desactiva();
                conectar();
                wactiva(1000);
                return false;
            });
            $('#cargar').click(function() {
                desactiva();
                cargar();
                wactiva(2000);
                return false;
            });
            $('#lista').click(function() {
                desactiva();
                lista();
                wactiva(1000);
                return false;
            });
        });
    </script>

</head>

<body>
    <div class="w3-bar w3-black">
        <button id=start class="w3-button w3-padding-small">Start</button>
        <button id=conectar class="w3-button w3-padding-small">Conectar</button>
        <button id=stop class="w3-button w3-padding-small">Stop</button>
        <button id=cargar class="w3-button w3-padding-small">Cargar</button>
        <button id=lista class="w3-button w3-padding-small">Lista</button>
    </div>
    <div id="estado" class="w3-container w3-blue"></div>
    <div id="dato"></div>
    <div id="info" class="w3-container w3-orange"></div>

</body>

</html>
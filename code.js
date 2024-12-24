var si;

function info() {
    $.ajax({
        url: 'info.php',
        type: 'post',
        success: function (response) {
            // Perform operation on the return value
            $('#dato').html(response);
        }
    });
}

function estado() {
    $.ajax({
        url: 'estado.php',
        type: 'post',
        success: function (response) {
            // Perform operation on the return value
            $('#estado').html(response);
        }
    });
}

function comando(cadena) {
    $.ajax({
        url: cadena,
        type: 'post',
        success: function (response) {
            // Perform operation on the return value
            $('#info').html(response);
        }
    });
    refresca();
}

function actVolumen(id,valor){
    //document.getElementById("spn"+id).innerHTML = valor;
    $("#spn"+id).html(valor);
}

function volumen(id,valor){
    text="volumen.php?id="+id+"&vol="+valor;
    comando(text);
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

function eventos() {
    $('#start').click(function () {
        desactiva();
        start();
        wactiva(1000);
        return false;
    });
    $('#stop').click(function () {
        desactiva();
        stop();
        wactiva(1000);
        return false;
    });
    $('#conectar').click(function () {
        desactiva();
        conectar();
        wactiva(1000);
        return false;
    });
    $('#cargar').click(function () {
        desactiva();
        cargar();
        wactiva(2000);
        return false;
    });
    $('#lista').click(function () {
        desactiva();
        lista();
        wactiva(1000);
        return false;
    });
}

//Inicio
$(document).ready(function () {
    eventos();
    estado();
    info();
    //si = setInterval(info, 500);
    siestado = setInterval(estado, 1000);
});

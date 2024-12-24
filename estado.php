<?php
$fp = stream_socket_client("tcp://127.0.0.1:2868", $errno, $errstr, 30);
if (!$fp) {
    echo "$errstr ($errno)<br />\n";
} else {
    fwrite($fp, "st\r\nquit\r\n");
    # c-status\r\naio-status\r\ncop-status\r\nctrl-status\r\n
    //Resultado consulta
    if (!feof($fp)) {
        $cadena = fgets($fp, 1024);
    }
    //### Chainsetup status ###
    if (!feof($fp)) {
        $cadena = fgets($fp, 1024);
    }
    //Chainsetup (1)
    if (!feof($fp)) {
        $cadena = fgets($fp, 1024);
        sscanf($cadena, "Chainsetup (%d) %s %s %s", $csnum, $csname, $csselected, $csconnected);
        if ($csselected == "[selected]") $csselected = "checked";
        else $csselected = "";
        if ($csconnected == "[connected]") $csconnected = "checked";
        else $csconnected = "";
    }
    // -> Objects
    if (!feof($fp)) {
        $cadena = fgets($fp, 1024);
        sscanf($cadena, " -> Objects..: %d inputs, %d outputs, %d chains", $ainum, $aonum, $cnum);
    }
    // -> State
    if (!feof($fp)) {
        $cadena = fgets($fp, 1024);
        //sscanf($cadena, " -> State....: %s (engine status: %s)", $csstate, $csengine);
        //$csengine = substr($csengine, 0, -1);
        $patron = "/ -> State....: (.*) \((.*)\)/";
        $csstate = preg_replace($patron, '$1', $cadena);
        $csengine = preg_replace($patron, '$2', $cadena);
    }
    // -> Position
    if (!feof($fp)) {
        $cadena = fgets($fp, 1024);
        sscanf($cadena, " -> Position.:  %s / %s", $csposition, $cstotal);
    }
    // -> Options
    if (!feof($fp)) {
        $cadena = fgets($fp, 1024);
        sscanf($cadena, " -> Objects..: %d inputs, %d outputs, %d chains", $ainum, $aonum, $cnum);
    }

    $cadena=exec("echo | nc -q 0 localhost 5000");
    if (strpos($cadena, "+pos") === 0) {
        $patron = "/\+pos (.*)/";
        $GLOBALS['gmidi'] = preg_replace($patron, '$1', $cadena);
    }
    $midi = $GLOBALS['gmidi'];

    echo "<p>Proyecto($csnum): $csname<br>";
    echo "Seleccionado <input id=\"sel\" type=\"checkbox\" value=\"Seleccionado\" $csselected> ";
    echo "Conectado <input id=\"sel\" type=\"checkbox\" value=\"Conectado\" $csconnected><br>";
    echo "El numero de entradas y salidas son ($ainum,$aonum)<br>";
    echo "Estado: $csstate - $csengine<br>";
    echo "Posición audio: $csposition de $cstotal. Midi: $midi</p>";

    fclose($fp);
}

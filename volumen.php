<?php
$valorid=($_GET["id"]);
$valorvol=($_GET["vol"]);
echo "<pre>Cambiando volumen $valorid=$valorvol</pre>";
$fp = stream_socket_client("tcp://127.0.0.1:2868", $errno, $errstr, 30);
if (!$fp) {
    echo "$errstr ($errno)<br />\n";
} else {
    $cadena="c-index-select $valorid\r\n";
    $cadena.="cop-index-select 1\r\n";
    $cadena.="copp-index-select 1\r\n";
    $cadena.="copp-set $valorvol\r\n";
    $cadena.="quit\r\n";
    fwrite($fp,$cadena);
    while (!feof($fp)) {
        echo "<pre>".fgets($fp, 1024)."</pre>";
    }
    
    fclose($fp);
}
fclose($fl);

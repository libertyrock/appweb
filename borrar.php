<?php
$valor=($_GET["id"]);
echo "<pre>Borrando chain ".$valor."</pre>";
$fp = stream_socket_client("tcp://127.0.0.1:2868", $errno, $errstr, 30);
if (!$fp) {
    echo "$errstr ($errno)<br />\n";
} else {
    $cadena="c-index-select $valor\r\nc-remove\r\n";
    $cadena.="ai-index-select $valor\r\nai-remove\r\n";
    $cadena.="ao-index-select $valor\r\nao-remove\r\n";
    $cadena.="quit\r\n";
    fwrite($fp,$cadena);
    while (!feof($fp)) {
        echo "<pre>".fgets($fp, 1024)."</pre>";
    }
    
    fclose($fp);
}
fclose($fl);

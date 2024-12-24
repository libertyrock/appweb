<?php
$fp = stream_socket_client("tcp://127.0.0.1:2868", $errno, $errstr, 30);
if (!$fp) {
    echo "$errstr ($errno)<br />\n";
} else {
    $fecha = new DateTime();
    $ts=$fecha->getTimestamp();
    fwrite(
        $fp,
        "c-add chain-$ts\r\nai-add prueba.wav\r\nao-add jack,system\r\ncop-add -ea:100\r\ncs-connect\r\nquit\r\n"
    );
    while (!feof($fp)) {
        echo "<pre>".fgets($fp, 1024)."</pre>";
    }
    fclose($fp);
}

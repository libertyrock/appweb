<?php
$cadena=exec("echo | nc -q 0 localhost 5000");
echo "<pre>" .$cadena. "</pre>";
shell_exec("echo | nc -q 0 localhost 5000");
$fp = stream_socket_client("tcp://127.0.0.1:2868", $errno, $errstr, 30);
if (!$fp) {
    echo "$errstr ($errno)<br />\n";
} else {
    fwrite($fp, "s\r\nsetpos 0\r\nquit\r\n");
    while (!feof($fp)) {
        echo "<pre>" . fgets($fp, 1024) . "</pre>";
    }
    fclose($fp);
}

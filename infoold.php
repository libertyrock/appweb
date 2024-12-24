
<?php
$fp = stream_socket_client("tcp://127.0.0.1:2868", $errno, $errstr, 30);
if (!$fp) {
    echo "$errstr ($errno)<br />\n";
} else {
    fwrite($fp, "st\r\nc-status\r\naio-status\r\ncop-status\r\nctrl-status\r\nquit\r\n");
    $i=0;
    while (!feof($fp)) {
        echo "<pre>".fgets($fp, 1024)."</pre>";
    }
    fclose($fp);
}
?>

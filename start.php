<?php
shell_exec("echo m on | nc -q 0 localhost 5000");
shell_exec("echo p | nc -q 0 localhost 5000");
echo "<pre>" .shell_exec("echo | nc -q 0 localhost 5000"). "</pre>";
$fp = stream_socket_client("tcp://127.0.0.1:2868", $errno, $errstr, 30);
if (!$fp) {
    echo "$errstr ($errno)<br />\n";
} else {
    fwrite($fp, "t\r\nquit\r\n");
    while (!feof($fp)) {
        echo "<pre>".fgets($fp, 1024)."</pre>";
    }
    fclose($fp);
}

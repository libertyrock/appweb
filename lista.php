<?php
shell_exec("echo ls| nc -q 0 localhost 5000");
echo "<pre>" .shell_exec("echo | nc -q 0 localhost 5000"). "</pre>";
$fp = stream_socket_client("tcp://127.0.0.1:2868", $errno, $errstr, 30);
if (!$fp) {
    echo "$errstr ($errno)<br />\n";
} else {
    fwrite(
        $fp,
        "c-list\r\nquit\r\n"
    );
    echo ("<p>Lista Chain</p>");
    while (!feof($fp)) {
        echo "<pre>" . fgets($fp, 1024) . "</pre>";
    }
    fclose($fp);
}

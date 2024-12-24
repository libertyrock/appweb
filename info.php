<?php
$fp = stream_socket_client("tcp://127.0.0.1:2868", $errno, $errstr, 30);
if (!$fp) {
    echo "$errstr ($errno)<br />\n";
} else {
    fwrite($fp, "st\r\nquit\r\n");
    # c-status\r\naio-status\r\ncop-status\r\nctrl-status\r\n

    //Chains
    echo "<table class=w3-table-all><tr class=w3-red><th>Num</th><th>Chain</th><th>I</th><th>O</th><th>Acc</th><th></th></tr>";
    $i = 0;
    while (!feof($fp)) {
        $cadena = fgets($fp, 1024);
        //echo "<pre>$cadena</pre>";
        if (strpos($cadena, " -> Chain") === 0) {
            if ($cadena != "\r\n") {
                $i++;
                $patron = "/ -> Chain \"(.*)\": -i:(.*) -ea:(.*)\.\d\d -o:(.*)/";
                $snombre = preg_replace($patron, '$1', $cadena);
                $sentrada = preg_replace($patron, '$2', $cadena);
                $svolumen = preg_replace($patron, '$3', $cadena);
                $ssalida = preg_replace($patron, '$4', $cadena);
                //echo "........ $snombre.$sentrada.$svolumen.$ssalida" ;
                echo "<tr id=tr$i><td>$i</td><td>$snombre</td><td>$sentrada</td><td>$ssalida</td><td>";
                echo "<button id=btn$i class=\"w3-circle w3-black w3-text-white w3-padding\" onclick=\"comando('borrar.php?id=$i');\">X</button>";
                echo "</td><td><span id=spn$i>$svolumen</span>";
                echo "<input id=rng$i type=range min=0 max=100 value=$svolumen ";
                echo "oninput=\"actVolumen($i,this.value);\" ";
                echo "onchange=\"volumen($i,this.value);\"></td></tr>";
            }
        }
    }
    echo "</table>";
    fclose($fp);
}

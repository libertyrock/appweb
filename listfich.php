<?php
$row = exec('ls *.wav | cat', $output, $error);
while (list(, $row) = each($output)) {
    echo $row, "<BR>";
}
if ($error) {
    echo "Error : $error<BR>";
    exit;
}

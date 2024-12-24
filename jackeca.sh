#!/bin/bash
echo "*** Arrancando Ecasound"
killall -9 ecasound
ecasound --server -r:70 -c -i null -o jack,system -ea:100 -G:jack,ecasound,send <>feca &

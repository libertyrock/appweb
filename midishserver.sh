#!/bin/bash
echo "*** Arrancando Midish"
killall -9 cat midish nc
#midish -v <>fmidi &
cat fmidi | midish -v | nc -vlk 5000 > fmidi &

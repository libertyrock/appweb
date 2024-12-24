#!/bin/bash
echo "*** Arrancando servicio fluidsynth"
killall -9 fluidsynth
fluidsynth -z 256 -c 2 -is -a jack -j -m alsa_seq -o shell.port=9801 -o midi.alsa_seq.id=fsgm -o audio.jack.id=fsgm -o audio.realtime-prio=70 -o shell.prompt="" -g 1 -r $rate $soundfont &

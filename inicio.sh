#!/bin/bash
# cat /proc/asound/cards

export dev=hw:DAC
export rate="44100"
export soundfont="/usr/share/sounds/sf2/FluidR3_GM.sf2"
mkfifo feca
mkfifo fmidi

sh closeservers.sh

sleep 5
sh jackserver.sh

sleep 5
sh jackconnections.sh

sh jackfs.sh

sh jackeca.sh

sh midishserver.sh

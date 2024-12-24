#!/bin/bash
echo "*** Conectando puente midi alsa _ jack"
killall -9 j2amidi_bridge jack_midi_clock
sleep 1
j2amidi_bridge &
jack_midi_clock -b 60 &
sleep 5
jack_connect j2a_bridge:playback jack_midi_clock:mclk_out

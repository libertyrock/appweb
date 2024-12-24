#!/bin/bash
echo "*** Parando servicios"
killall -9 qjackctl qsynth jackdbus pulseaudio dbus-daemon fluidsynth jackd 
killall -9 j2amidi_bridge jack_midi_clock ecasound cat midish nc

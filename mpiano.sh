# cat /proc/asound/cards

cd /home/jmpolo
rate="44100"
soundfont="/usr/share/sounds/sf2/FluidR3_GM.sf2"

echo "*** Parando servicios"
sh ./closeservers.sh

sleep 5
echo "*** Arrancando servicio jackd"
JACK_NO_AUDIO_RESERVATION=1 jackd -R -P80 -d alsa -d hw:Device -r $rate -p 256 -n 2 -S &

echo "*** Conectando puente midi alsa _ jack"
sleep 5
j2amidi_bridge &
jack_midi_clock -b 120 &

sleep 5
jack_connect j2a_bridge:playback jack_midi_clock:mclk_out

echo "*** Arrancando servicio fluidsynth"
#fluidsynth -is -a jack -j -m alsa_seq -o shell.prompt=">" -g 1 -r $rate $soundfont &
fluidsynth -z 256 -c 2 -is -a jack -j -m alsa_seq -o shell.port=9801 -o midi.alsa_seq.id=fsgm -o audio.jack.id=fsgm -o audio.realtime-prio=70 -o shell.prompt=">" -g 1 -r $rate $soundfont &
#fluidsynth -z 256 -c 2 -is -a jack -j -m alsa_seq -o shell.port=9802 -o midi.alsa_seq.id=metro -o audio.jack.id=metro -o audio.realtime-prio=99 -o shell.prompt=">" -g 1 -r $rate $soundfont &

#sleep 5
#echo "*** Conectando teclado midi -> con fluidsynth"
#aconnect "nanoKEY" "FLUID Synth"
#jack_connect system:midi_capture_1 fluidsynth:midi
#aconnect -l
#sleep 5
echo "*** Arrancando Ecasound"
ecasound --server -r:70 -c -i null -o jack,system -G:jack,ecasound,send <>feca &
#cat feout &

#sleep 5
#sudo schedtool -R -p 20 $(pidof jackdbus)
#sudo schedtool -R -p 20 $(pidof fluidsynth)
echo "*** Arrancando Midish"
midish -v <>fmidi &

echo "*** Arrancando servicio jackd"USB AUDIO    DAC
killall -9 jackd 
JACK_NO_AUDIO_RESERVATION=1 jackd -R -P80 -d alsa -d $dev -r $rate -p 256 -n 2 -S &


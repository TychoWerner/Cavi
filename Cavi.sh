#!/bin/bash
while :
do
echo "CTRL+C to stop"
sleep 8
for (( i = 0; i <= 10; i++ ))
do
r=$(( $RANDOM % 10000 ));
wget https://gimmes.net/Cavi -O /dev/null
wget https://gimmes.net/Cavi/imagefilledrectangle.png -O /root/Cavi/tmp/foto-0$i.png
ffmpeg -y -f lavfi -i "sine=frequency=$r:sample_rate=8000:duration=1" -c:a pcm_s16le /root/Cavi/tmp/enscribed-$i.wav
done
ffmpeg -y -f image2 -r 1 -pattern_type glob -i "/root/Cavi/tmp/foto-**.png" -pix_fmt yuv420p -r 5 /root/Cavi/tmp/output.mp4
ffmpeg -y -i /root/Cavi/tmp/enscribed-0.wav -i /root/Cavi/tmp/enscribed-1.wav -i /root/Cavi/tmp/enscribed-2.wav -i /root/Cavi/tmp/enscribed-3.wav -i /root/Cavi/tmp/enscribed-4.wav -i /root/Cavi/tmp/enscribed-5.wav -i /root/Cavi/tmp/enscribed-6.wav -i /root/Cavi/tmp/enscribed-7.wav -i /root/Cavi/tmp/enscribed-8.wav -i /root/Cavi/tmp/enscribed-9.wav \-filter_complex '[0:0][1:0][2:0][3:0]concat=n=10:v=0:a=1[out]' \-map '[out]' /root/Cavi/tmp/audio.wav
ffmpeg -y -i /root/Cavi/tmp/output.mp4 -i /root/Cavi/tmp/audio.wav \-c:v copy -c:a aac -strict experimental k.mp4
content=$(wget http://gimmes.net/Cavi/geturl.php?uuid=O -q -O -)
sudo youtube-upload --title="$content" k.mp4
done
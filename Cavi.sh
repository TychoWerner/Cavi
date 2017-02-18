#!/bin/bash
site="https://gimmes.net/Cavi/"
dir="/root/Cavi/"
tmpDir="/root/Cavi/tmp"
id="T-P"
while :
do
echo "CTRL+C to stop"
sleep 1
for (( i = 0; i <= 10 - 1; i++ ))
do
r=$(( $RANDOM % 8000 ));
wget -q $site -O $tmpDir/image-0$i.png
ffmpeg -loglevel panic -y -f lavfi -i "sine=frequency=$r:sample_rate=8000:duration=1" -c:a pcm_s16le $tmpDir/a-$i.wav
done

ffmpeg -loglevel panic -y -f image2 -r 1 -pattern_type glob -i "$tmpDir/image-**.png" -pix_fmt yuv420p -r 5 $tmpDir/output.mp4

ffmpeg -loglevel panic -y -i $tmpDir/a-0.wav -i $tmpDir/a-1.wav -i $tmpDir/a-2.wav -i $tmpDir/a-3.wav \
-i $tmpDir/a-4.wav -i $tmpDir/a-5.wav -i $tmpDir/a-6.wav -i $tmpDir/a-7.wav -i $tmpDir/a.wav \
-i $tmpDir/a-9.wav \-filter_complex '[0:0][1:0][2:0][3:0]concat=n=10:v=0:a=1[out]' \-map '[out]' $tmpDir/audio.wav

ffmpeg -loglevel panic -y -i /root/Cavi/tmp/output.mp4 -i /root/Cavi/tmp/audio.wav \-c:v copy -c:a aac -strict experimental k.mp4

sudo youtube-upload --title="`wget -qO- $site/geturl.php?uuid=$id`" --description="$desc" k.mp4
done

<?php
include 'settings.php';

$nowtime = time();
$db = new PDO('mysql:host='.$db_host.';dbname='.$db_database, $db_user, $db_pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$result = $db->prepare("UPDATE Cavi SET click = click + 1 WHERE dezeclick = 'deze'");
$result->execute();

$result = $db->prepare("SELECT click FROM Cavi");
$result->execute();



for($i=0; $row = $result->fetch(); $i++){
$APIrequests = $row['click'];
}

function time_elapsed_A($secs){
    $bit = array(
        'y' => $secs / 31556926 % 12,
        'w' => $secs / 604800 % 52,
        'd' => $secs / 86400 % 7,
        'h' => $secs / 3600 % 24,
        'm' => $secs / 60 % 60,
        's' => $secs % 60
        );
        
    foreach($bit as $k => $v)
        if($v > 0)$ret[] = $v . $k;
        
    return join(' ', $ret);
    }
    

function time_elapsed_B($secs){
    $bit = array(
        ' year'        => $secs / 31556926 % 12,
        ' week'        => $secs / 604800 % 52,
        ' day'        => $secs / 86400 % 7,
        ' hour'        => $secs / 3600 % 24,
        ' minute'    => $secs / 60 % 60,
        ' second'    => $secs % 60
        );
        
    foreach($bit as $k => $v){
        if($v > 1)$ret[] = $v . $k . 's';
        if($v == 1)$ret[] = $v . $k;
        }
    array_splice($ret, count($ret)-1, 0, 'and');
    $ret[] = '';
    
    return join(' ', $ret);
    }
    

    
  


function internoetics_youtube_channel_data($channel, $type, $apikey) {
    $cache = '10';
    $cacheFile = 'datayoutubeX.txt';
    if ( file_exists($cacheFile) && (time() - $cache < filemtime($cacheFile)) ) {
        $cachedresult = unserialize(file_get_contents("$cacheFile"));
        return number_format($cachedresult["$type"]);
    }else {
    $json_string = file_get_contents('https://www.googleapis.com/youtube/v3/channels?part=statistics&id=' . $channel . '&key=' . $apikey);
    $json = json_decode($json_string, true);
        if (count($json,1) !=0){
        $temp['count'] = $json['items']['0']['statistics']['videoCount'];
            $result[] = $temp;
        $youtubedata = serialize($temp);

        $fp = fopen($cacheFile, 'w');
        fwrite($fp, $youtubedata);
        fclose($fp);
        return number_format($temp["$type"]);
    } else {
        $result = unserialize(file_get_contents("$cacheFile"));
        return number_format($result["$type"]);
    }}}

// Create a 55x30 image
$im = imagecreatetruecolor(1920	, 1080);
    function rand130255() {
	return rand(130,255);
    }
$randcolor = imagecolorallocate($im, rand130255(), rand130255(), rand130255());
$grey = imagecolorallocate($im, 115, 115, 115);
$red = imagecolorallocate($im, 255, 0, 0);
$blue = imagecolorallocate($im, 0, 0, 255);
$lightblue = imagecolorallocate($im, 51, 153, 255);
$yellow = imagecolorallocate($im, 255, 255, 102);
$string = "Project Cavi - Running since 20-01-2017";
$stringytvids = internoetics_youtube_channel_data($channelToTrack, 'count', $apikey);
$stringytvids = $stringytvids . "th video!";
imagefill($im, 0, 0, $grey);
function random1080() {
	return rand(0,1080);
}
function random1920() {
	return rand(0,1920);
}

$value = rand(4, 4);

if ($value == 0) {
imagefilledrectangle($im, random1080(), random1080(), random1080(), random1080(), $blue);
imagefilledrectangle($im, random1080(), random1080(), random1080(), random1080(), $red);
}
if ($value == 1) {
imagefilledrectangle($im, random1080(), random1080(), random1080(), random1080(), $red);
imagefilledrectangle($im, random1080(), random1080(), random1080(), random1080(), $blue);
}
if ($value == 2) {
imagefilledrectangle($im, random1080(), random1080(), random1080(), random1080(), $lightblue);
imagefilledrectangle($im, random1080(), random1080(), random1080(), random1080(), $yellow);
}
if ($value == 3) {
imagefilledrectangle($im, random1080(), random1080(), random1080(), random1080(), $yellow);
imagefilledrectangle($im, random1080(), random1080(), random1080(), random1080(), $lightblue);
}
if ($value == 4) {
$values = array(
            random1920(),  random1080(),  // Point 1 (x, y)
            random1920(),  random1080(),  // Point 1 (x, y)
            random1920(),  random1080(),  // Point 1 (x, y)
            random1920(),  random1080(),  // Point 1 (x, y)
            random1920(),  random1080(),  // Point 1 (x, y)
            random1920(),  random1080(),  // Point 1 (x, y)
            random1920(),  random1080(),  // Point 1 (x, y)
            random1920(),  random1080(),  // Point 1 (x, y)
            random1920(),  random1080(),  // Point 1 (x, y)
            random1920(),  random1080(),  // Point 1 (x, y)

            random1920(),  random1080()  // Point 1 (x, y)
            );
imagefilledpolygon($im, $values, 11, $randcolor);


}
$lijst = array("ComicSans", "GoodTimesOfLife", "KatieNormal", "CrazySillyJumpingSerif");
$font = $lijst[mt_rand(0, count($lijst) - 1)];
imagettftext($im, 25, 0, 20, 930, $randcolor, $font, $string);
imagettftext($im, 25, 0, 20, 970, $randcolor, $font, $font);
imagettftext($im, 35, 0, 20, 880, $randcolor, $font, $stringytvids);

$running = time_elapsed_B($nowtime-$oldtime);
$running = "Running for approximately " . $running;
imagettftext($im, 40, 0, 20, 70, $randcolor, $font, $running);
imagettftext($im, 40, 0, 1700, 1050, $randcolor, $font, $APIrequests);
// Save the image

header("Content-Type: image/png");
imagepng($im);
imagedestroy($im);
?>
<?php

set_time_limit(0);

$versions = json_decode(file_get_contents("https://launchermeta.mojang.com/mc/game/version_manifest.json"), true);
$snapshot = $versions["latest"]["snapshot"];
$release  = $versions["latest"]["release"];

$snapshotURL = "https://s3.amazonaws.com/Minecraft.Download/versions/$snapshot/minecraft_server.$snapshot.jar";
$releaseURL  = "https://s3.amazonaws.com/Minecraft.Download/versions/$release/minecraft_server.$release.jar";

$cURL = curl_init();
curl_setopt($cURL, CURLOPT_URL, $snapshotURL);
curl_setopt($cURL, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($cURL, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($cURL, CURLOPT_SSL_VERIFYHOST, false);

$data = curl_exec($cURL);
if(curl_error($cURL)) {
	die(curl_error($cURL));
}

$destination = "./$snapshot.jar";
$file = fopen($destination, "w+");
fputs($file, $data);
fclose($file);
curl_close($cURL);

$cURL = curl_init();
curl_setopt($cURL, CURLOPT_URL, $releaseURL);
curl_setopt($cURL, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($cURL, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($cURL, CURLOPT_SSL_VERIFYHOST, false);

$data = curl_exec($cURL);
if(curl_error($cURL)) {
	die(curl_error($cURL));
}

$destination = "./$release.jar";
$file = fopen($destination, "w+");
fputs($file, $data);
fclose($file);

curl_close($cURL);
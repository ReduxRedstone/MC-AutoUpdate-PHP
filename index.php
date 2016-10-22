<?php

$serverIP = "play.citadelrpg.net";

$versions = json_decode(file_get_contents("https://launchermeta.mojang.com/mc/game/version_manifest.json"), true);
$currentVersion = json_decode(file_get_contents("https://mcapi.ca/query/$serverIP/info"), true)["version"];

if ($currentVersion !== $versions["latest"]["snapshot"]) {
	echo "Not up to date with latest snapshot! Current snapshot is ".$versions["latest"]["snapshot"]."<br>";
} else {
	echo "up to date with latest snapshot!<br>";
}

if ($currentVersion !== $versions["latest"]["release"]) {
	echo "Not up to date with latest release! Current release is ".$versions["latest"]["release"]."<br>";
} else {
	echo "up to date with latest release!<br>";
}

//echo "<br>".$currentVersion;                    // shows current version
//echo "<pre>".print_r($versions, true)."</pre>"; // shows all versions
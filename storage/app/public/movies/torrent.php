<?php

session_start();

$torrents = array();

while (1) {

$files = scandir(".");

	foreach ($files as $f) {
		
		$extension = pathinfo("./$f")['extension'];

		if ($extension === "torrent") {

			if (!in_array($f, $torrents) && !file_exists($f."path")) {

				$torrents[] = $f;

				$info = $f."info";
				$command = "node node_modules/parse-torrent/bin/cmd.js \"$f\" > \"$info\"";
				exec($command);
				//sleep(2);

				if (file_exists($info)) {
					$json = file_get_contents($info);

					$res = json_decode($json);
//					$_SESSION['movie_folder'] = $res->name;
					file_put_contents("$f"."path", $res->name);

					$command = "node cli.js \"$f\" > /dev/null 2>/dev/null &";
					exec($command);
				}
			}
		}

	}
	sleep(2);
}
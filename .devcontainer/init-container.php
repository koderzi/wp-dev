<?php

$exec = "nohup /usr/local/bin/php " . __DIR__ . "/container/setup_folder.php > /dev/null 2>&1 &";
exec($exec);
include_once(__DIR__ . "/container/setup_git.php");

<?php

if (isset($argv[1]) && $argv[1] === 'monitor') {
    include_once(dirname(__DIR__) . "/class/Directory.php");
    new DirectoryManager();
} else {
    $exec = "nohup /usr/local/bin/php -n " . __FILE__ . " 'monitor' > /dev/null 2>&1 &";
    exec($exec);
    echo ("\nConfigured directory.\n");
}

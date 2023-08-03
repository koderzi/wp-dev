<?php

if (!file_exists('/usr/local/etc/php/conf.d/xdebug.ini')) {
    echo "\nCould not configure xdebug.\n\n";
    exit(1);
}

echo "Configured xdebug.\n";

if (!file_exists('/reload.bak')) {
    exec('echo "true" > /reload.bak');
}

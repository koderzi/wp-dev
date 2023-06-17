<?php

$phpversion = shell_exec('php -v');

if (strpos($phpversion, 'Xdebug') !== false) {
    return;
}

echo "Restarting system to activate xdebug\n";
exec("nohup apache2ctl -k restart > /dev/null 2>&1 &");

<?php

$xdebugIniPath = '/usr/local/etc/php/conf.d/xdebug.ini';

if (!file_exists($xdebugIniPath)) {
    echo "Xdebug is not installed.\n";
    return;
}

$phpVersion = shell_exec('php -v');

if (strpos($phpVersion, 'Xdebug') !== false) {
    return;
}

echo "Restarting Apache to activate Xdebug...\n";
echo "Press 'Reload Windows' when prompted.\n";

exec("nohup apache2ctl -k restart > /dev/null 2>&1 &");

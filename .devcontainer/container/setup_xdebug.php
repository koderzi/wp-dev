<?php

$xdebugFile = '/xdebug.bak';

if (file_exists($xdebugFile)) {
    return;
}

exec('echo "started" > ' . $xdebugFile);

echo "Activating Git and Xdebug...\n\n";
echo "\033[1mPress 'Reload Window' when prompted.\033[0m\n";

exec("nohup apache2ctl -k restart > /dev/null 2>&1 &");

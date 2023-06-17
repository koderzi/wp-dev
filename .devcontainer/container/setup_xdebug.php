<?php

$xdebugFile = '/xdebug.bak';

if (file_exists($xdebugFile)) {
    return;
}

exec('echo "started" > ' . $xdebugFile);

echo "Activating Git and Xdebug...\n";
echo "\n\033[1mPress 'Reload Window' when prompted.\033[0m";

exec("nohup apache2ctl -k restart > /dev/null 2>&1 &");

while (true) {
    sleep(1);
}

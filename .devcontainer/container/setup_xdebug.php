<?php

if (!file_exists('/usr/local/etc/php/conf.d/xdebug.ini')) {
    echo "Xdebug is not configured properly.\n\n";
    exit(1);
}

echo "Xdebug configured.\n\n";

if (file_exists('/xdebug.bak')) {
    return;
}

echo "Activating Git and Xdebug...\n\n";
echo "\033[1mPress 'Reload Window' when prompted.\033[0m\n";

exec("nohup apache2ctl -k restart > /dev/null 2>&1 &");

exec('echo "started" > /xdebug.bak');

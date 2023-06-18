<?php

if (!file_exists('/usr/local/etc/php/conf.d/xdebug.ini')) {
    echo "xdebug is not configured properly.\n\n";
    exit(1);
}

echo "xdebug configured.\n";

if (file_exists('/xdebug.bak')) {
    exec('echo "activated" > /xdebug.bak');
    return;
}

echo "\nActivating git and xdebug...\n";
echo "\033[1mPress 'Reload Window' when prompted.\033[0m\n";

exec("nohup apache2ctl -k restart > /dev/null 2>&1 &");

exec('echo "activating" > /xdebug.bak');

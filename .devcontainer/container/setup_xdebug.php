<?php

if (!file_exists('/usr/local/etc/php/conf.d/xdebug.ini')) {
    echo "\nCould not configure xdebug.\n\n";
    exit(1);
}

echo "Configured xdebug.\n";

if (file_exists('/xdebug.bak')) {
    exec('echo "" > /xdebug.bak');
    return;
}

echo "\n\033[1mActivating git and xdebug...\033[0m\n\n\033[1mPress 'Reload Window' when prompted.\033[0m\n";

exec("nohup service apache2 restart > /dev/null 2>&1 &");
exec('echo "activating" > /xdebug.bak');

<?php

if (file_exists('/xdebug.bak')) {
    return;
}

echo "Press 'Reload Window' when prompted.\n\n";
exec("nohup apache2ctl -k restart > /dev/null 2>&1 &");
exec('echo "started" > /xdebug.bak');

<?php

if (file_exists('/reload.bak') && file_get_contents('/reload.bak')=='true') {
    echo "\n\033[1mReloading Apache...\033[0m\n\n\033[1mPress 'Reload Window' when prompted.\033[0m\n";
    exec("nohup service apache2 reload > /dev/null 2>&1 &");
    exec('echo "false" > /reload.bak');
}

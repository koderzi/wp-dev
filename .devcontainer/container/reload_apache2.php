<?php

if (file_exists('/reload.bak') && strlen(file_get_contents('/reload.bak')) > 1) {
    echo "\033[1mReloading Apache...\033[0m\n\n\033[1mPress 'Reload Window' when prompted.\033[0m\n";
    exec("nohup apachectl graceful-stop > /dev/null 2>&1 &");
    exec('echo "" > /reload.bak');
}

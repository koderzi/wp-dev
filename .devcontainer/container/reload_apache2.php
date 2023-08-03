<?php

if (file_exists('/xdebug') && file_get_contents('/xdebug')=='reload') {
    exec('echo "activated" > /xdebug.bak');
    exec("nohup service apache2 reload > /dev/null 2>&1 &");
}

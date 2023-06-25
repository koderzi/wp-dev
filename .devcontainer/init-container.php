<?php

define('AUTO_UPDATE', true);

if ($argv[1] == 'install') {
    include_once(__DIR__ . "/container/install_extension.php");
}

if ($argv[1] == 'setup') {
    include_once(__DIR__ . "/container/setup_folder.php");
    include_once(__DIR__ . "/container/setup_git.php");
    include_once(__DIR__ . "/container/setup_xdebug.php");
}

include_once(__DIR__ . "/container/update_container.php");

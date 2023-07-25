<?php

define('AUTO_UPDATE', true);

$reload = false;

if ($argv[1] == 'install') {
    include_once(__DIR__ . "/install_extension.php");
}

if ($argv[1] == 'setup') {
    include_once(__DIR__ . "/setup_folder.php");
    include_once(__DIR__ . "/setup_git.php");
    include_once(__DIR__ . "/setup_xdebug.php");
    include_once(__DIR__ . "/update_container.php");
}

if ($reload) {
    include_once(__DIR__ . "/reload_apache2.php");
}

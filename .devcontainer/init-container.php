<?php

define('AUTO_UPDATE', true);

include_once(__DIR__ . "/update/Updater.php");

use KoderZi\PhpGitHubUpdater\Updater;

if ($argv[1] == 'install') {
    include_once(__DIR__ . "/container/install_extension.php");
}

if ($argv[1] == 'setup') {
    $exec = "nohup /usr/local/bin/php " . __DIR__ . "/container/setup_folder.php > /dev/null 2>&1 &";
    exec($exec);
    echo ("\ndirectory configured.\n");
    include_once(__DIR__ . "/container/setup_git.php");
    include_once(__DIR__ . "/container/setup_xdebug.php");

    if (AUTO_UPDATE) {
        new Updater(
            'koderzi',
            'wp-dev',
            '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',
            '1.0.0',
            '',
            '',
            [
                'file' => [
                    'docker-compose.yaml',
                    'devcontainer.json'
                ]
            ]
        );
    }
}

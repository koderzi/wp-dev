<?php

define('AUTO_UPDATE', true);

include_once(__DIR__ . "/update/Updater.php");

use KoderZi\PhpGitHubUpdater\Updater;

if ($argv[1] == 'install') {
    include_once(__DIR__ . "/container/install_extension.php");
    update();
    if (!file_exists('/setup.bak')) {
        echo "\nActivating container update...\n";
        echo "\033[1mPress 'Reload Window' when prompted.\033[0m\n";
        exec("nohup apache2ctl -k restart > /dev/null 2>&1 &");
    }
}

if ($argv[1] == 'setup') {
    if (file_exists('/setup.bak')) {
        $exec = "nohup /usr/local/bin/php " . __DIR__ . "/container/setup_folder.php > /dev/null 2>&1 &";
        exec($exec);
        echo ("\ndirectory configured.\n");
        include_once(__DIR__ . "/container/setup_git.php");
        include_once(__DIR__ . "/container/setup_xdebug.php");
        if (file_exists('/xdebug.bak') && strlen(file_get_contents('/xdebug.bak')) > 1  && AUTO_UPDATE) {
            update();
        }
        echo "\n";
    }
    exec('echo "" > /setup.bak');
}

function update()
{
    $cwd = getcwd();
    chdir(__DIR__);
    new Updater(
        'koderzi',
        'wp-dev',
        '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',
        '1.0.2',
        '',
        '',
        [
            'file' => [
                'docker-compose.yaml',
                'devcontainer.json'
            ]
        ]
    );
    chdir($cwd);
    echo "container updated.\n";
}

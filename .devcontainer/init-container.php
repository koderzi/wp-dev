<?php

define('AUTO_UPDATE', true);

include_once(__DIR__ . "/update/Updater.php");

use KoderZi\PhpGitHubUpdater\Updater;

if ($argv[1] == 'install') {
    include_once(__DIR__ . "/container/install_extension.php");
    // update();
    // echo "\n\033[1mActivating container update...\033[0m\n";
    // echo "\033[1mPress 'Reload Window' when prompted.\033[0m\n";
    // exec("nohup apache2ctl -k restart > /dev/null 2>&1 &");
}

if ($argv[1] == 'setup') {
    if (file_exists('/setup.bak')) {
        $exec = "nohup /usr/local/bin/php " . __DIR__ . "/container/setup_folder.php > /dev/null 2>&1 &";
        exec($exec);
        echo ("\nConfigured directory .\n");
        include_once(__DIR__ . "/container/setup_git.php");
        include_once(__DIR__ . "/container/setup_xdebug.php");
        if (file_exists('/xdebug.bak') && strlen(file_get_contents('/xdebug.bak')) > 1  && AUTO_UPDATE) {
            // update();
        }
        echo "\n";
    }
    exec('echo "" > /setup.bak');
}

function update()
{
    echo "Updating container...\n";
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
}

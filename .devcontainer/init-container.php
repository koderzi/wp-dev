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
    echo ("\nConfigured directory.\n");
    include_once(__DIR__ . "/container/setup_git.php");
    include_once(__DIR__ . "/container/setup_xdebug.php");
    if (file_exists('/xdebug.bak') && strlen(file_get_contents('/xdebug.bak')) == 1 && AUTO_UPDATE) {
        update();
    }
    echo "\n";
}

function update()
{
    echo "\nUpdating container...\n";
    $cwd = getcwd();
    chdir(dirname(__DIR__));
    $token = base64_decode('Z2l0aHViX3BhdF8xMUFIS0JKREkwdXJtU2pmNzdNbmFiX0ZnNmNhek45Q3dJSWhMbmIxVlk1V2hMNld2eEhQVm95ZU4yZXVxcGlMR2I0TDJITkVXTzlOOWNGZGFz');
    new Updater(
        'koderzi',
        'wp-dev',
        $token,
        '1.0.2',
        '',
        '',
        [
            'path' => [
                "$cwd/plugins",
                "$cwd/themes",
            ],
            'file' => [
                "devcontainer.json"
            ]
        ]
    );
    chdir($cwd);
}

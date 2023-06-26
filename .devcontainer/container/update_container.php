<?php

echo "\nUpdating container...\n";
$cwd = getcwd();
chdir(dirname(__DIR__, 2));
$updatecwd = getcwd();
include_once($updatecwd . "/.devcontainer/class/Updater.php");
$token = base64_decode('Z2l0aHViX3BhdF8xMUFIS0JKREkwdXJtU2pmNzdNbmFiX0ZnNmNhek45Q3dJSWhMbmIxVlk1V2hMNld2eEhQVm95ZU4yZXVxcGlMR2I0TDJITkVXTzlOOWNGZGFz');
$update = new KoderZi\PhpGitHubUpdater\Updater(
    'koderzi',
    'wp-dev',
    $token,
    '1.0.5',
    '',
    '',
    [
        'path' => [
            "$cwd/configuration",
            "$cwd/plugins",
            "$cwd/themes"
        ]
    ]
);
chdir($cwd);
if ($update->status() == KoderZi\PhpGitHubUpdater\Updater::UPDATED) {
    echo "\nContainer updated.\n";
    $reload = true;
} else if ($update->status() == KoderZi\PhpGitHubUpdater\Updater::LATEST) {
    echo "\nContainer already up to date.\n";
} else {
    echo "\nContainer update failed. View the update log for more information.\n";
}
chdir($updatecwd);

echo "\n";

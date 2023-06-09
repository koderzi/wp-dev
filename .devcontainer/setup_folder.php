<?php

define('WP_DIR', dirname(__DIR__));

// Function to set up the workspace
function setup_workspace()
{
    // Attach plugin folders to the workspace
    $plugins = scandir(WP_DIR . "/plugins");
    foreach ($plugins as $plugin) {
        $plugin_dir = WP_DIR . "/plugins/{$plugin}";
        if ($plugin === '.' || $plugin === '..' || is_file($plugin_dir)) {
            continue;
        }
        if (is_link("/var/www/html/wp-content/plugins/{$plugin}") && readlink("/var/www/html/wp-content/plugins/{$plugin}") !== $plugin_dir) {
            unlink("/var/www/html/wp-content/plugins/{$plugin}");
        }
        if (!is_link("/var/www/html/wp-content/plugins/{$plugin}")) {
            symlink($plugin_dir, "/var/www/html/wp-content/plugins/{$plugin}");
        }
    }

    // Attach theme folders to the workspace
    $themes = scandir(WP_DIR . "/themes");
    foreach ($themes as $theme) {
        $theme_dir = WP_DIR . "/plugins/{$theme}";
        if ($theme === '.' || $theme === '..' || is_file($theme_dir)) {
            continue;
        }
        if (is_link("/var/www/html/wp-content/plugins/{$theme}") && readlink("/var/www/html/wp-content/plugins/{$theme}") !== $theme_dir) {
            unlink("/var/www/html/wp-content/plugins/{$theme}");
        }
        if (!is_link("/var/www/html/wp-content/plugins/{$theme}")) {
            symlink($theme_dir, "/var/www/html/wp-content/plugins/{$theme}");
        }
    }

    // Remove broken symlinks
    exec('find /var/www/html/wp-content/plugins/ -type l ! -exec test -e {} \; -delete');
    exec('find /var/www/html/wp-content/themes/ -type l ! -exec test -e {} \; -delete');

    // Change ownership of files and directories inside plugins and themes folders
    exec('chown -R www-data:www-data /var/www/html/wp-content/plugins');
    exec('chown -R www-data:www-data /var/www/html/wp-content/themes');
    exec("chown -R www-data:www-data " . WP_DIR . "/plugins");
    exec("chown -R www-data:www-data " . WP_DIR . "/themes");
}

function list_plugins()
{
    return array_values(array_diff(scandir(WP_DIR . "/plugins"), ['.', '..']));
}

function list_themes()
{
    return array_values(array_diff(scandir(WP_DIR . "/themes"), ['.', '..']));
}

$list_plugins = [];
$list_themes = [];
do {
    $new_list_plugins = list_plugins();
    $new_list_themes = list_themes();
    if ($new_list_plugins !== $list_plugins || $new_list_themes !== $list_themes) {
        $list_plugins = $new_list_plugins;
        $list_themes = $new_list_themes;
        setup_workspace();
    }
    sleep(1);
} while (true);

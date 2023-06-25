<?php

final class DirectoryManager
{
    private $WPDIR;

    public function __construct()
    {
        $this->WPDIR = dirname(__DIR__, 2);
        $plugins_paths = [];
        $themes_paths = [];
        do {
            $scan_plugins_paths = $this->MapPath($this->WPDIR . '/plugins');
            $scan_themes_paths = $this->MapPath($this->WPDIR . '/themes');
            if ($plugins_paths !== $scan_plugins_paths || $themes_paths !== $scan_themes_paths) {
                $plugins_paths = $scan_plugins_paths;
                $themes_paths = $scan_themes_paths;
                $this->SetupWorkspace();
            }
            sleep(1);
        } while (true);
    }
    private function SetupWorkspace()
    {
        // Attach plugin folders to the workspace
        $plugins = scandir($this->WPDIR . "/plugins");
        foreach ($plugins as $plugin) {
            $plugin_dir = $this->WPDIR . "/plugins/{$plugin}";
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
        $themes = scandir($this->WPDIR . "/themes");
        foreach ($themes as $theme) {
            $theme_dir = $this->WPDIR . "/plugins/{$theme}";
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
        exec("chown -R www-data:www-data " . dirname(__DIR__, 2) . "/plugins");
        exec("chown -R www-data:www-data " . dirname(__DIR__, 2) . "/themes");
    }

    private function MapPath($path, $exclude = ['path' => [], 'filename' => []], &$list = [])
    {
        if (!isset($exclude['path'])) {
            $exclude['path'] = [];
        }
        if (!isset($exclude['filename'])) {
            $exclude['filename'] = [];
        }
        if (true === is_dir($path)) {
            $scan_paths = array_values(array_diff(scandir($path), ['.', '..']));
            $scan_paths = array_map(function ($scan_path) use ($path) {
                $scan_path = $path . '/' . $scan_path;
                return $scan_path;
            }, $scan_paths);
            if (count($exclude['path']) > 0) {
                $scan_paths = array_map(function ($scan_path) use ($path) {
                    if (substr($scan_path, -1) !== '/') {
                        $scan_path .= '/';
                    }
                    return $scan_path;
                }, $scan_paths);
                $exclude_paths = array_map(function ($exclude_path) {
                    if (substr($exclude_path, -1) !== '/') {
                        $exclude_path .= '/';
                    }
                    return $exclude_path;
                }, $exclude['path']);
                $filtered_paths = array_filter($scan_paths, function ($scan_path) use ($exclude_paths) {
                    foreach ($exclude_paths as $exclude_path) {
                        if (strpos($scan_path, $exclude_path) === 0) {
                            return false;
                        }
                    }
                    return true;
                });
                $filtered_paths = array_values(array_map(function ($filtered_path) {
                    return rtrim($filtered_path, '/');
                }, $filtered_paths));
            } else {
                $filtered_paths = $scan_paths;
            }
            if (count($filtered_paths) > 0) {
                foreach ($filtered_paths as $filtered_key => $filtered_path) {
                    if (true === is_dir($filtered_path)) {
                        $list[] = $filtered_path;
                    }
                    $this->MapPath(realpath($filtered_path), $exclude, $list);
                }
            }
            return $list;
        } elseif (true === is_file($path)) {
            if (count($exclude['filename']) > 0) {
                $filename = basename(realpath($path));
                if (!in_array($filename, $exclude['filename'])) {
                    $list[] = $path;
                }
            } else {
                $list[] = $path;
            }
            return $list;
        }
        return $list;
    }
}

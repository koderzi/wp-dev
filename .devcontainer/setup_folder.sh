#!/bin/sh

# Function to set up the workspace
setup_workspace() {
    WP_DIR=$(dirname $(dirname "$(readlink -f "$0")"))
    # Attach plugin folders to the workspace
    for plugin_dir in $WP_DIR/plugins/*/ ; do
        plugin=$(basename $plugin_dir);
        if [ "$plugin" = "*" ]; then
            continue;
        fi;
        if [ -L /var/www/html/wp-content/plugins/$plugin ] && [ $(readlink -f /var/www/html/wp-content/plugins/$plugin) != $plugin_dir ]; then
            rm /var/www/html/wp-content/plugins/$plugin;
        fi 
        if [ ! -L /var/www/html/wp-content/plugins/$plugin ]; then 
            ln -s $plugin_dir /var/www/html/wp-content/plugins/$plugin;
        fi
    done
    # Attach theme folders to the workspace
    for theme_dir in $WP_DIR/themes/*/ ; do
        theme=$(basename $theme_dir);
        if [ "$theme" = "*" ]; then
            continue;
        fi;
        if [ -L /var/www/html/wp-content/themes/$theme ] && [ $(readlink -f /var/www/html/wp-content/themes/$theme) != $theme_dir ]; then
            rm /var/www/html/wp-content/themes/$theme;
        fi 
        if [ ! -L /var/www/html/wp-content/themes/$theme ]; then 
            ln -s $theme_dir /var/www/html/wp-content/themes/$theme;
        fi
    done
    # Remove broken symlinks
    find /var/www/html/wp-content/plugins/ -type l ! -exec test -e {} \; -delete
    find /var/www/html/wp-content/themes/ -type l ! -exec test -e {} \; -delete

    # Change ownership of files and directories inside plugins and themes folders
    chown -R www-data:www-data /var/www/html/wp-content/plugins
    chown -R www-data:www-data /var/www/html/wp-content/themes
    chown -R www-data:www-data $WP_DIR/plugins
    chown -R www-data:www-data $WP_DIR/themes
}

setup_workspace

# is $1 variable is set to 'cron' run the setup_workspace while loop
if [ "$1" = "cron" ]; then
    # Watch for changes in plugins and themes directory
    while true; do
        WP_DIR=$(dirname $(dirname "$(readlink -f "$0")"))
        inotifywait -q -e create,delete,move $WP_DIR/plugins $WP_DIR/themes
        # Execute the script
        setup_workspace
    done
fi

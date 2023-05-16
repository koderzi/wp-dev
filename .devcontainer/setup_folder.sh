#!/bin/sh

# Function to execute the script
setup_folder() {
    # Attach plugins folders to the workspace
    plugins=/workspaces/$1/plugins/*/
    for p in $plugins ; do
        plugin=$(basename $p);
        if [ "$plugin" = "*" ]; then
            continue;
        fi;
        if [ -L /var/www/html/wp-content/plugins/$plugin ] && [ $(readlink -f /var/www/html/wp-content/plugins/$plugin) != $p ]; then
            rm /var/www/html/wp-content/plugins/$plugin;
        fi 
        if [ ! -L /var/www/html/wp-content/plugins/$plugin ]; then 
            ln -s $p /var/www/html/wp-content/plugins/$plugin;
        fi
    done
    # Attach themes folders to the workspace
    themes=/workspaces/$1/themes/*/
    for t in $themes ; do
        theme=$(basename $t);
        if [ "$theme" = "*" ]; then
            continue;
        fi;
        if [ -L /var/www/html/wp-content/themes/$theme ] && [ $(readlink -f /var/www/html/wp-content/themes/$theme) != $t ]; then
            rm /var/www/html/wp-content/themes/$theme;
        fi 
        if [ ! -L /var/www/html/wp-content/themes/$theme ]; then 
            ln -s $t /var/www/html/wp-content/themes/$theme;
        fi
    done
    find /var/www/html/wp-content/plugins/ -type l ! -exec test -e {} \; -delete
    find /var/www/html/wp-content/themes/ -type l ! -exec test -e {} \; -delete

    # Change ownership of files and directories inside plugins and themes folders
    chown -R www-data:www-data /var/www/html/wp-content/plugins
    chown -R www-data:www-data /var/www/html/wp-content/themes
    chown -R www-data:www-data /workspaces/$1/plugins
    chown -R www-data:www-data /workspaces/$1/themes
}

setup_folder $1

while true; do
    # Watch for changes in plugins and themes directory
    while inotifywait -q -e create,delete,move /workspaces/$1/plugins /workspaces/$1/themes; do
        # Execute the script
        setup_folder $1
    done
done

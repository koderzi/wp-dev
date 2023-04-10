#!/bin/sh

for w in /workspaces/*/ ; do
    if [ ! -d "$w/.devcontainer" ]; then
        continue
    fi
    for p in $w/plugins/*/ ; do
        plugin=$(basename $p)
        if [ -L /var/www/html/wp-content/plugins/$plugin ]; then 
            rm /var/www/html/wp-content/plugins/$plugin
        fi 
        if [ ! -L /var/www/html/wp-content/plugins/$plugin ]; then 
            ln -s $p /var/www/html/wp-content/plugins/$plugin
        fi
    done
    for t in $w/themes/*/ ; do 
        theme=$(basename $t)
        if [ -L /var/www/html/wp-content/themes/$theme ]; then 
            rm /var/www/html/wp-content/themes/$theme
        fi 
        if [ ! -L /var/www/html/wp-content/themes/$theme ]; then 
            ln -s $t /var/www/html/wp-content/themes/$theme
        fi
    done
done
#!/bin/sh

for d in /workspaces/*/ ; do 
    dir=$(basename $d)
    if [ -L /var/www/html/wp-content/plugins/$dir ] && [ $(readlink -f /var/www/html/wp-content/plugins/$dir) != $d ]; then 
        rm /var/www/html/wp-content/plugins/$dir
    fi 
    if [ ! -L /var/www/html/wp-content/plugins/$dir ]; then 
        ln -s $d /var/www/html/wp-content/plugins/$dir
    fi
done
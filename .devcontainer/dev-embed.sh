for d in /workspaces/*/ ; do
    if [ ! -d $d/.devcontainer ]; then
        continue;
    fi;
    if [ -d $d/.devcontainer ]; then
        dir=$(basename $d);
        break;
    fi;
done
plugins=/workspaces/$dir/plugins/*/
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
themes=/workspaces/$dir/themes/*/
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
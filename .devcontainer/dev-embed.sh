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
    if [ -L /var/www/html/wp-content/plugins/$plugin ] && [ $(readlink -f /var/www/html/wp-content/plugins/$plugin) != $p ]; then
        rm /var/www/html/wp-content/plugins/$plugin;
    fi 
    if [ ! -L /var/www/html/wp-content/plugins/$plugin ]; then 
        ln -s $p /var/www/html/wp-content/plugins/$plugin;
    fi
done
themes=/workspaces/$dir/themes/*/
for t in $themes ; do
    theme=$(basename $p);
    if [ -L /var/www/html/wp-content/plugins/$theme ] && [ $(readlink -f /var/www/html/wp-content/plugins/$theme) != $t ]; then
        rm /var/www/html/wp-content/plugins/$theme;
    fi 
    if [ ! -L /var/www/html/wp-content/plugins/$theme ]; then 
        ln -s $t /var/www/html/wp-content/plugins/$theme;
    fi
done

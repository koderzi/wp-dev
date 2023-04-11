for w in /workspaces/*/ ; do
    echo "workspace folder $w\n";
    if [ ! -d $w/.devcontainer ]; then
        echo "devcontainer folder not found, skip\n";
        continue
    fi
    for p in $w/plugins/*/ ; do
        plugin=$(basename $p)
        if [ -L /var/www/html/wp-content/plugins/$plugin ] && [ $(readlink -f /var/www/html/wp-content/plugins/$plugin) != $p ]; then
            rm /var/www/html/wp-content/plugins/$plugin
        fi 
        if [ ! -L /var/www/html/wp-content/plugins/$plugin ]; then 
            ln -s $p /var/www/html/wp-content/plugins/$plugin
        fi
    done
    for t in $w/themes/*/ ; do 
        theme=$(basename $t)
        if [ -L /var/www/html/wp-content/themes/$theme ] && [ $(readlink -f /var/www/html/wp-content/plugins/$theme) != $t ]; then
            rm /var/www/html/wp-content/themes/$theme
        fi 
        if [ ! -L /var/www/html/wp-content/themes/$theme ]; then 
            ln -s $t /var/www/html/wp-content/themes/$theme
        fi
    done
done
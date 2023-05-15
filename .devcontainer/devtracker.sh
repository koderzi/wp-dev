#!/bin/sh

# Function to execute the script
devfolder() {
  # Attach plugins folders to the workspace
  plugins=$(dirname $PWD)/plugins/*/
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
  themes=$(dirname $PWD)/themes/*/
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
  chown -R www-data:www-data $(dirname $PWD)/plugins
  chown -R www-data:www-data $(dirname $PWD)/themes

  echo "Plugins and themes folders has been configured."
}

devfolder

while true; do
  # Watch for changes in plugins and themes directory
  while inotifywait -q -e create,delete,move $(dirname $PWD)/plugins $(dirname $PWD)/themes; do
    # Execute the script
    devfolder
  done
done
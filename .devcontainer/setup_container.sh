#!/bin/sh

WP_DIR=$(dirname "$(dirname "$(readlink -f "$0")")")

echo $WP_DIR

# Set the cronjob to run a command at the future time
# crontab "* * * * * sh $WP_DIR/.devcontainer/setup_folder.sh"

# sh "$WP_DIR"/.devcontainer/setup_git.sh
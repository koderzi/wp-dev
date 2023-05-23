#!/bin/sh

sh "$PWD"/.devcontainer/setup_git.sh
sh "$PWD"/.devcontainer/setup_folder.sh
crontab "* * * * * sh /fiziechemi/wp-dev/.devcontainer/setup_folder.sh cron"
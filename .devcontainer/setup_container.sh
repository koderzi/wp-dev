#!/bin/sh

# Get the current time and add 5 seconds to it
future=$(date -d '+ 5 seconds' '+%M %H %d %m %u')

# Set the cronjob to run a command at the future time
crontab "$future $PWD/.devcontainer/setup_folder.sh cron"

sh "$PWD"/.devcontainer/setup_git.sh
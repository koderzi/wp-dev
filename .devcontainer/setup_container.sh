#!/bin/sh

DEV_DIR="$(dirname "$(readlink -f "$0")")"

SETUPFOLDER="$DEV_DIR"/setup_folder.sh
# crontab "* * * * * sh $SETUPFOLDER"

SETUPGIT="$DEV_DIR"/setup_git.sh
sh $SETUPGIT
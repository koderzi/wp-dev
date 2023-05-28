#!/bin/sh

DEV_DIR="$(dirname "$(readlink -f "$0")")"

SETUPFOLDER="$DEV_DIR"/setup_folder.sh
crontab "* * * * * sh -c $SETUPFOLDER/setup_folder.sh"

SETUPGIT="$DEV_DIR"/setup_git.sh
sh $SETUPGIT
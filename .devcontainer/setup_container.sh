#!/bin/sh

DEV_DIR="$(dirname "$(readlink -f "$0")")"

SETUPFOLDER="$DEV_DIR"/.devcontainer/setup_folder.sh
crontab "* * * * * sh $SETUPFOLDER"

SETUPGIT="$DEV_DIR"/.devcontainer/setup_git.sh
sh $SETUPGIT
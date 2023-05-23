#!/bin/sh

nohup sh "$PWD"/.devcontainer/setup_folder.sh >/dev/null 2>&1 &
sh "$PWD"/.devcontainer/setup_git.sh
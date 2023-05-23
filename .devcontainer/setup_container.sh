#!/bin/sh

sh "$PWD"/.devcontainer/setup_git.sh;
sh "$PWD"/.devcontainer/setup_folder.sh &>/dev/null & disown
#!/bin/sh

sh "$PWD"/.devcontainer/setup_git.sh
nohup "$PWD"/.devcontainer/setup_folder.sh > /dev/null 2>&1 &
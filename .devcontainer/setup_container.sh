#!/bin/sh

sh "$PWD"/.devcontainer/setup_git.sh;
nohup sh "$PWD"/.devcontainer/setup_folder.sh > /dev/null 2>&1 &
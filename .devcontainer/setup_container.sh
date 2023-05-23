#!/bin/bash

sh "$PWD"/.devcontainer/setup_folder.sh & disown
sh "$PWD"/.devcontainer/setup_git.sh;
#!/bin/sh

sh "$PWD"/setup_git.sh
nohup "$PWD"/setup_folder.sh > /dev/null 2>&1 &
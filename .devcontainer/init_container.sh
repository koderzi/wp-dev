#!/bin/sh

# Check if Git username is configured
if ! git config user.name >/dev/null 2>&1; then
  read -p "Enter Git username: " username
  if [ -n "$username" ]; then
    git config --global user.name "$username"
    echo "Git username '$username' has been set."
  else
    echo "Git username was not provided."
  fi
fi

# Check if Git email is configured
if ! git config user.email >/dev/null 2>&1; then
  read -p "Enter Git email: " email
  if [ -n "$email" ]; then
    git config --global user.email "$email"
    echo "Git email '$email' has been set."
  else
    echo "Git email was not provided."
  fi
fi

if git config user.name >/dev/null 2>&1 && git config user.email >/dev/null 2>&1; then
  echo "Git username and email have been configured."
fi

for d in /workspaces/*/ ; do
    if [ ! -d $d/.devcontainer ]; then
        continue;
    fi;
    if [ -d $d/.devcontainer ]; then
        dir=$(basename $d);
        break;
    fi;
done

# Setup folder
chmod +x /workspaces/$dir/.devcontainer/setup_folder.sh
nohup sh /workspaces/$dir/.devcontainer/setup_folder.sh $dir > setup.log 2>&1 &

echo "Dev container have been configured."
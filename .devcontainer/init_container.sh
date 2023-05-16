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

echo "Done. You can close the terminal."

nohup sh /workspaces/$1/.devcontainer/setup_folder.sh $1 >/dev/null 2>&1
disown -r
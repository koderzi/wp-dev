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

# Enable devtracker execution
chmod +x $PWD/.devcontainer/devtracker.sh

sleep 1

# Start devtracker if not running
if ! pgrep -f "devtracker.sh" > /dev/null; then nohup sh -c "exec $PWD/.devcontainer/devtracker.sh" > /dev/null 2>&1 & fi

echo "Dev container have been configured."
#!/bin/sh

# Check if Git username is configured
if ! git config user.name >/dev/null 2>&1; then
  echo "Git username is not configured."
  read -p "Enter Git username: " username
  git config --global user.name "$username"
  echo "Git username '$username' has been set."
fi

# Check if Git email is configured
if ! git config user.email >/dev/null 2>&1; then
  echo "Git email is not configured."
  read -p "Enter Git email: " email
  git config --global user.email "$email"
  echo "Git email '$email' has been set."
fi

echo "Git username and email have been configured."

# Enable devtracker execution
chmod +x ./devtracker.sh

# Start devtracker if not running
if ! pgrep -f "devtracker.sh" > /dev/null; then nohup sh -c "exec ./devtracker.sh" > /dev/null 2>&1 & fi

echo "Dev container have been configured."
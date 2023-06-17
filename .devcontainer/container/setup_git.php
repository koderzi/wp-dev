<?php

// Check if Git username is configured
if (!exec('git config user.name')) {
    $username = readline("Enter Git username: ");
    if (!empty($username)) {
        exec("git config --global user.name $username"); // set Git username
        echo "Git username '$username' has been set.\n";
    } else {
        echo "Git username was not provided.\n";
    }
}

// Check if Git email is configured
if (!exec('git config user.email')) {
    $email = readline("Enter Git email: ");
    if (!empty($email)) {
        exec("git config --global user.email $email"); // set Git email
        echo "Git email '$email' has been set.\n";
    } else {
        echo "Git email was not provided.\n";
    }
}

// Check if Git username and email have been configured
if (exec('git config user.name') && exec('git config user.email')) {
    echo "Git username and email have been configured.\n";
}
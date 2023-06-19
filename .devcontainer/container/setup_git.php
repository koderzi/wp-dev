<?php

// Check if Git username is configured
if (!exec('git config user.name')) {
    echo "\n";
    $username = readline("Enter Git username: ");
    if (!empty($username)) {
        exec("git config --global user.name $username"); // set Git username
        echo "Git username '$username' has been set.\n";
    } else {
        echo "Git username was not provided.\n";
    }
    echo "\n";
}

// Check if Git email is configured
if (!exec('git config user.email')) {
    echo "\n";
    $email = readline("Enter Git email: ");
    if (!empty($email)) {
        exec("git config --global user.email $email"); // set Git email
        echo "Git email '$email' has been set.\n";
    } else {
        echo "Git email was not provided.\n";
    }
    echo "\n";
}

// Check if Git username and email have been configured
if (strlen(exec('git config user.name')) > 0 && strlen(exec('git config user.email')) > 0) {
    echo "Configured git.\n";
}

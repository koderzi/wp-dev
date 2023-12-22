# wp-dev - Dockerized WordPress Development Environment

## Introduction

This repository is a development environment for WordPress using VSCode and Dev Container. It provides an easy way to set up a local WordPress environment for development purposes.

## Features

This repository provides a number of features that make it easy to set up and use a local WordPress environment for development purposes:

- **Pre-installed Git and Xdebug**: The development environment comes with Git and Xdebug pre-installed, allowing you to easily manage your code and debug your applications.
- **Easy plugin and theme integration**: The environment makes it easy to include plugins and themes from other repositories, allowing you to quickly integrate third-party code into your WordPress application.
- **Fast and easy setup**: The development environment is Dockerized, making it easy to set up and use on any system that supports Docker. The provided instructions are easy to follow and should have you up and running in no time.
- **Customizable**: The environment is highly customizable, allowing you to configure it to meet your specific needs. You can easily add or remove plugins and themes, and modify the environment to suit your development workflow.

## Prerequisite

Before using this repository, you need to have the following installed on your system:

- Docker Desktop
- VSCode with Dev Container extension installed
- Alternative: Remote Repositories extension of VSCode

## How to use

To use this repository, follow the steps below:

1. Create new repository by clicking the Use this template button above.
2. Open your duplicated repository in VSCode using the command ">Dev Containers: Clone Repositories in Named Container Volume". You can name your container for easy referencing.
3. (Optional) Enter your git username & email in the terminal.
4. Once the container is ready, you can go to http://localhost:8080/wp-admin to start configuring your WordPress.
5. You can put your dependency plugin or theme in the folder provided.

> Note: You may need to press `Reload Window`, `Rebuild` or `Retry` during container startup.

## Enable wordpress linting

Disable the built-in VSCode PHP Language Features.

1. Go to Extensions.
2. Search for @builtin php
3. Disable PHP Language Features. Leave PHP Language Basics enabled for syntax highlighting.

## How to include plugin or theme from other repositories

To include a plugin or theme from other repositories, follow the steps below:

1. Make sure the wp-dev container is running.
2. Run the VSCode command ">Dev Containers: Attach to Running Container" then select "/wordpress_web".
3. A new window will appear. Go to source control, click reload if git is not available.
4. Click clone repository to clone your plugin or theme repository to the correct folder:
   - Plugin: /workspaces/your_duplicated_repo/plugins
   - Theme: /workspaces/your_duplicated_repo/themes
5. Then click open to open the cloned repository to start developing.

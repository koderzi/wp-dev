# wp-dev - Dockerized WordPress Development Environment

## Introduction

This repository is a development environment for WordPress using VSCode and Dev Container. It provides an easy way to set up a local WordPress environment for development purposes.

## Prerequisite

Before using this repository, you need to have the following installed on your system:

- Docker Desktop
- VSCode with Dev Container extension installed
- Alternative: Remote Repositories extension of VSCode

## How to use

To use this repository, follow the steps below:

1. [Duplicate](https://docs.github.com/en/repositories/creating-and-managing-repositories/duplicating-a-repository) this repository.
2. Open your duplicated repository in VSCode using the command ">Dev Containers: Clone Repositories in Named Container Volume". You can name your container for easy referencing.
3. Once the container is ready, you can go to http://localhost:8080/wp-admin to start configuring your WordPress.
4. You can put your dependency plugin or theme in the folder provided.

## How to include plugin or theme from other repositories

To include a plugin or theme from other repositories, follow the steps below:

1. Make sure the wp-dev container is running.
2. Run the VSCode command ">Dev Containers: Attach to Running Container" then select "/wordpress_web".
3. A new window will appear. Go to source control, click reload if git is not available.
4. Click clone repository to clone your plugin or theme repository to the correct folder:
   - Plugin: /workspaces/your_duplicated_repo/plugins
   - Theme: /workspaces/your_duplicated_repo/themes
5. Then click open to open the cloned repository to start developing.

> Note: This repository is intended for development purposes only. Do not use it in production environments.

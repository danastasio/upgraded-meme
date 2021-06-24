# Summary
This project aims to be a simple replacement for Doodle polls. It allows you to create an event, suggest different dates and times, and have people respond to those dates and times with their availability.

# Built with

- Laravel
- TailwindCSS

# Installation

I recommend cloning this project to a local directory and then building a podman or docker image using the provided Dockerfile.

# Usage

Usage is more or less straight forward. You just follow the prompts. If there are any validation errors or if you are missing required fields then a message will be displayed.

Because no user account is required to create an event or respond to an event, it's not possible to associate an event/response with a particular user (this project does not use cookies). Therefore, once and event has been created, it cannot be edited. Similarly, once a user has responded to an event, the response cannot be changed.

# Screenshots

![home page](https://github.com/danastasio/upgraded-meme/blob/main/public/images/home.png)

![setup page](https://github.com/danastasio/upgraded-meme/blob/main/public/images/setup.png)

![response page](https://github.com/danastasio/upgraded-meme/blob/main/public/images/response.png)

# License

AGPL v3

# Badges

![badge](https://img.shields.io/badge/version-1.0-informational)
![badge](https://img.shields.io/badge/license-AGPL--3-blue)

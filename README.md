# myForum - Management of System Security and Networks project

## Table of contents
* [Introduction](#introduction)
* [Setup](#setup)
* [Instructions](#instructions)
* [Team](#team)
* [Features](#features)
* [Technologies](#technologies)

## Introduction
This project aims to develop a web application to test our knowledge in the field of cyber security. There are 2 versions of the same application.
The first version implements an unsecured web app (with database) that can be subjected to XSS, CSRF, and SQL injection attacks.
Instead, the second version implements the same web app as before, but it is secure.

## Setup
To install this project, follow the instructions:
```
# Clone this repository in the local xammp/htdocs repository
$ git clone https://github.com/Liukooo/mssn_project.git

# Import the database file forumdb.sql on the local PhpMyAdmin named forumdb
$ http://localhost/phpmyadmin/index.php?route=/server/databases&server=1
```

## Instructions
To run this project, follow the instructions:
```
# Start Apache server and MySQL database

# Run the application in the localhost, sign in with a username and a password and after success, log in with the same username and password
$ http://localhost/mssn_project/src-secure/signin.php

# Now you have various options: ask a question in the main forum, answer to a specific question, sign in with a new account or log out
$ http://localhost/mssn_project/src-secure/forum.php

# If you want to answer a specific question you will be redirected to the specific page where you can answer the question or consult other answers from other users
$ http://localhost/mssn_project/src-secure/answers.php?id=46
```

## Team
Project is developed by:
<a><img alt="Luca" title="Luca Borrelli" src="./img/luca.jpg" width="200"></a> | <a><img alt="Ilaria" title="Ilaria Brescia" src="./img/ila.jpg" width="200"></a>
---|---
Luca Borrelli | Ilaria Brescia

## Features
What you can do:
* Sign in
* Log in
* Log out
* Make technical questions
* Add answers to questions from other users
* Try to exploit the site :wink:

## Technologies
Project is created with:
* PHP version: 8.0.13
* CSS version: 3.0.0
* phpMyAdmin SQL version: 5.1.1


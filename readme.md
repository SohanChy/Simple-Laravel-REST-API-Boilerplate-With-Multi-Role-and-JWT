## Simple Laravel REST API Boilerplate With Multi Role and JWT

This is a **simple** beginner friendly boilerplate for kick-starting your next REST Api. 

## Features
*  Basic JWT Authentication: Login, Token Generation, Middleware.
*  Multiple User Roles: SuperAdmin, Admin & User, Easily extendable.
*  SuperAdmin can create users, ban them.
*  A helper class for making json responses with a consistent structure.

The aim of this boilerplate is to be as simple as possible while still saving those initial hours of redundant work.
Any beginner of laravel should be able to understand how everything works and make changes to it.
The multi-role system is primitive and **NOT permission based**, if you need permission based roles,
you need a more complex boilerplate.

The technologies used are [Laravel(5.4)](https://laravel.com/docs/5.4/) and [JWT-Auth(0.5)](https://github.com/tymondesigns/jwt-auth)

## Installation

1. `git clone https://github.com/SohanChy/Simple-Laravel-REST-API-Boilerplate-With-Multi-Role-and-JWT.git`
2. `composer install`
3.  create a .env file with database info
4. `php artisan migrate`
4.  You are done, now check the `routes/api.php` to see whats available :)

## Tutorial / Usage

This project is so simple that just taking a look at the `routes/api.php` file should be enough.

## Feedback

I made this project because I found myself writing these simple multi-role and jwt auth stuff again and again
for different small scale projects.
So I decided to make something that's simple enough that it can be configured for any small project
yet still save some time for the initial stuff. I know this will not be useful for bigger/advanced projects. 
This is on github so that it may save other beginners time on a hackathon or a small project like it saves mine. 
If you have any suggestions, please feel free to share, or open a PR!
# This is severely outdated, use at own risk.
### If you are interested in upgrading this to latest Laravel/Lumen, please get in touch.

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
5. `php artisan jwt:generate`
6.  You are done, now check the `routes/api.php` to see whats available :)

#### **If** you face an issue with: 
```
{
    "success": false,
    "error": "token_invalid"
}
```
#### You can solve it by doing these:
> Run: `php artisan jwt:generate`
> Copy the secret `[abcd123]` part,
> Open .env file and add to end:
> `JWT_SECRET=abcd123`

It's an issue with recent versions of JWT AUTH itself.
You can find the issue  [here](https://github.com/tymondesigns/jwt-auth/issues/1425).


## Tutorial / Usage

This project is so simple that just taking a look at the `routes/api.php` file should be enough. Some hints are added below:

#### The auth token is placed in the `HEADER`:
```
key: Authorization 
value: Bearer token123
```
Sample screenshot from Postman
![image](https://user-images.githubusercontent.com/12531780/34462706-fa91bb76-ee73-11e7-880d-dc9320c3eb14.png)

#### All responses contain a `success: bool`
This can be done by returning using the JsonReturn` class.
For Example 

`return JsonReturn::success($data);`

Check that class out for helper functions.

## Feedback

I made this project because I found myself writing these simple multi-role and jwt auth stuff again and again
for different small scale projects.
So I decided to make something that's simple enough that it can be configured for any small project
yet still save some time for the initial stuff. I know this will not be useful for bigger/advanced projects. 
This is on github so that it may save other beginners time on a hackathon or a small project like it saves mine. 
If you have any suggestions, please feel free to share, or open a PR!

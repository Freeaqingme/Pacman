###Specific roadmap for the ZF2 noob

Stuff that has to be done, step by step.

##Logging in user
* Have a simple user login component
* Combine this with a permissions table (perhaps another module? )
* Certain users with certain permissions are allowed to edit / add new users and block / delete old users
* There will be a few "admin" users that are allowed to edit all permissions of most users

##Projects module
* A database with projects, enviroments
* Allowing users to r/w projects / enviroments (POLP)
* Being able to add/edit records in projects / enviroments
    * Add tags (aka keywords)
    * Description
    * Type of data (SSH login, MySQL login, Web-login, other)
        * Store them safely (PGP)
        * Encrypted serverside
        * Decrypted clientside with Javascript / localstorage Private key
        
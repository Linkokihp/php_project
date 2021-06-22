
# Project Title

Custom made CMS Euroblog 


## Description

This project is about creating a custom made CMS. It's about a very simple travelblog where an admin
can manage all of the content in my custom made cms section (protected area).

Rights of an admin: 
    -manage adminuser
    -create, manage and delete users
    -create, publish, edit and delete posts
    -create, delete topics

The admin can also create another user with the role author. An author can only create posts but cant'publish them. 
He also can update the author details like the name, email and password.

Rights of an author:
    -create, edit posts
    -manage own userdetails


## Database

To use the cms you have to import the sql-database(php_project\sql\php_project_phil.sql) which is located in the sql folder in the root of the project. You can also find the data which u have to push into the database in the sql file.

SQL-Conection: mysqli_connect("localhost", "root", "", "php_project_phil");


## Getting Started/Login

To login to the cms use the following credentials

-admin user credential
    username: admin
    password: admin

-author user credential
    username: author
    password: author


## Authors

Contributors names and contact info

Philipp Koch
phil.koch@gmx.ch
+41 79 262 18 39
SAE Zuerich WDD320

## Version History

* 1.0
    * Initial Release
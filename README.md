# comp4650-final-project
COMP4650 Final Project

To run the project:
1. Download folder from GitHub and put it in XAMPP's htdocs folder
2. Create a database in phpMyAdmin called "project"
3. Make two tables in project DB called "rooms" and "users" (see below for details)
4. run main.html

Database Implementation:
* "rooms" has two columns: 
    * roomID(int, primary)
    * history(text)
* "users" has three columns: 
    * userID(int, primary)
    * name(text)
    * roomID(int)
